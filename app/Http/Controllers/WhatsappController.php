<?php

namespace App\Http\Controllers;

use App\Models\WhatsappApi;
use App\Models\WhatsappMessage;
use App\Models\MessageTemplate;
// use App\Models\WhatsappMessageReply;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Netflie\WhatsAppCloudApi\WebHook;
use GuzzleHttp\Client;

class WhatsappController extends Controller
{

    // create whatsapp api
    public function create(Request $request)
    {
        $data = WhatsappApi::first();
        return view('admin.whatsapp.create', compact('data'));
    }

    //======================================= Webhook =================================
    const VERIFY_TOKEN = 'LaravelToken';

    public function setupWebhook(Request $request)
    {
        Log::info($request->all());

        if ($request->isMethod('get')) {
            $hubMode = $request->query('hub_mode');
            $hubChallenge = $request->query('hub_challenge');
            $hubVerifyToken = $request->query('hub_verify_token');

            if ($hubVerifyToken !== self::VERIFY_TOKEN) {
                return response()->json(['error' => 'VerifyToken doesn\'t match'], 403);
            }

            // Log::info('WebHook with GET executed.');
            // Log::info("Parameters: hub_mode=$hubMode  hub_challenge=$hubChallenge  hub_verify_token=$hubVerifyToken");

            return response($hubChallenge);
        } elseif ($request->isMethod('post')) {
            $data = $request->all();
            $recipient_id = null;

            // Check if 'statuses' key exists in the request data
            if (isset($data['entry'][0]['changes'][0]['value']['statuses'])) {
                $statuses = $data['entry'][0]['changes'][0]['value']['statuses'];

                foreach ($statuses as $status) {
                    // Check if the message_id exists, then update, otherwise create a new record
                    WhatsappMessage::updateOrCreate(
                        ['message_id' => $status['id']], // Condition to check
                        [
                            // 'whatsapp_message' => json_encode($data),
                            'template_name' => $status['conversation']['origin']['type'] ?? null,
                            'template_type' => $status['conversation']['origin']['type'] ?? null,
                            'type' => 'send',
                            'status' => $status['status'],
                            'phone_number' => $data['entry'][0]['changes'][0]['value']['metadata']['display_phone_number'],
                            'from' => $data['entry'][0]['changes'][0]['value']['metadata']['phone_number_id'],
                            'recipient_id' => $status['recipient_id'],
                            'send_at' => isset($status['timestamp']) ? date('Y-m-d H:i:s', $status['timestamp']) : null,
                        ]
                    );

                    $recipient_id = $status['recipient_id'];
                }
            } else if (isset($data['entry'][0]['changes'][0]['value']['messages'])) {
                $messages = $data['entry'][0]['changes'][0]['value']['messages'];

                foreach ($messages as $message) {
                    // Extracting data
                    $message_id = $message['id'] ?? null;
                    $reply = $message['text']['body'] ?? null;
                    $profile_name = $data['entry'][0]['changes'][0]['value']['contacts'][0]['profile']['name'] ?? null;
                    $type = $message['type'] ?? null;
                    $reply_at = isset($message['timestamp']) ? date('Y-m-d H:i:s', $message['timestamp']) : null;
                    $status = 'received'; // or another status based on your requirements
                    $phone_number = $data['entry'][0]['changes'][0]['value']['metadata']['display_phone_number'] ?? null;
                    $recipient_sid = $message['from'] ?? null;
                    $from = $message['from'] ?? null;

                    // Creating the reply in the database
                    WhatsappMessage::create([
                        'message_id' => $message_id,
                        'whatsapp_message' => $reply,
                        'reply' => $message,
                        'profile_name' => $profile_name,
                        'type' => 'reply',
                        'reply_at' => $reply_at,
                        'status' => $status,
                        'phone_number' => $phone_number,
                        'recipient_id' => $recipient_sid,
                        'from' => $from,
                    ]);
                }

                $recipient_id = $message['from'];
            }

            // // Respond with 200 OK to acknowledge receipt of the message
            // return response()->json(['status' => 'Message received'], 200);

            return redirect()->route('whatsapp.chat.index', ['recipient_id' => $recipient_id]);
        } else {
            return response()->json(['error' => 'Invalid request method'], 405);
        }
    }

    // ==================================== Profile =================================//
    public function getProfile(Request $request)
    {
        $fromPhoneNumberId = getenv("FB_PHONE_NUMBER");
        $accessToken = getenv("FB_METADATA_TOKEN");

        $client = new Client([
            'base_uri' => 'https://graph.facebook.com/v19.0/',
        ]);

        try {
            $response = $client->request('GET', $fromPhoneNumberId . '/whatsapp_business_profile', [
                'query' => [
                    'fields' => 'about,address,description,email,profile_picture_url,websites,vertical',
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
            ]);

            $body = $response->getBody()->getContents();
            $profileData = json_decode($body, true);

            // Handle the profile data as needed
            return response()->json($profileData);
        } catch (\Exception $e) {
            // Handle errors
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateProfile(Request $request)
    {
        // Log::info($request->all());
        $phoneNumberId = getenv("FB_PHONE_NUMBER");
        $accessToken = getenv("FB_METADATA_TOKEN");

        $client = new Client([
            'base_uri' => 'https://graph.facebook.com/v19.0/',
        ]);

        try {
            $validator = Validator::make($request->all(), [
                'about' => 'required',
                'address' => 'required',
                'description' => 'required',
                'vartical' => 'required',
                'email' => 'required',
                'website_1' => 'nullable',
                'website_2' => 'nullable',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $response = $client->request('POST', $phoneNumberId . '/whatsapp_business_profile', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    "messaging_product" => "whatsapp",
                    "about" => $request->get('about'),
                    "address" => $request->get('address'),
                    "description" => $request->get('description'),
                    "vertical" => $request->get('vartical'),
                    "email" => $request->get('email'),
                    "websites" => [
                        $request->get('website_1'),
                        // $request->get('website_2'),
                    ],
                    // "profile_picture_handle" => "HANDLE_OF_PROFILE_PICTURE"
                ],
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode === 200) {
                // return response()->json(['success' => true], 200);
                // Log::info('WhatsApp profile updated successfully');
                return redirect()->back()->with('success', 'Whatsapp Profile updated successfully');
            } else {
                Log::error('Failed to update WhatsApp profile');
                // return response()->json(['error' => 'Failed to update WhatsApp profile'], $statusCode);
                return redirect()->back()->with('error', 'Something went wrong!');
            }
        } catch (\Exception $e) {
            Log::error('Failed to update WhatsApp profile: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!');
            // return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getSubscribedApps(Request $request)
    {
        $version = 'v19.0'; // Replace with your desired API version
        $wabaId = getenv("FB_ACCOUNT_ID"); // Replace with your WhatsApp Business Account ID
        $authorization = getenv("FB_METADATA_TOKEN"); // Replace with your authorization token

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $authorization,
            ])->post("https://graph.facebook.com/{$version}/{$wabaId}/subscribed_apps");

            // Check if the request was successful
            if ($response->successful()) {
                // Request was successful, handle response
                return $response->json();
            } else {
                // Request failed, handle error
                $errorCode = $response->status();
                return response()->json(['error' => "Request failed with status code {$errorCode}"], $errorCode);
            }
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    //========================== Other ===============================
    // public function markAsRead($messageId)
        // {
        //     Log::info($messageId);
        //     $fromPhoneNumberId = env('FB_ACCOUNT_ID');
        //     $accessToken = env('FB_METADATA_TOKEN');
        //     $version = 'v19.0';
        //     $messageId = 'wamid.HBgMOTE5NzcwMDE5MTQ4FQIAEhggNUU3QTI3MDc5MjJFNDM2MDlGOEZENDVENjRDQzhCQTUA';

        //     $response = Http::withHeaders([
        //         'Authorization' => 'Bearer ' . $accessToken,
        //         'Content-Type' => 'application/json',
        //     ])->post("https://graph.facebook.com/{$version}/{$fromPhoneNumberId}/messages", [
        //         'messaging_product' => 'whatsapp',
        //         'status' => 'read',
        //         'message_id' => $messageId,
        //     ]);

        //     Log::info($response);

        //     if ($response->successful()) {
        //         return response()->json(['status' => 'Message marked as read', 'response' => $response->json()], 200);
        //     } else {
        //         return response()->json(['error' => 'Failed to mark message as read', 'response' => $response->body()], $response->status());
        //     }
    // }

    //=========================== Templates ============================
    public function getMessageTemplate($templateName = null)
    {
        // Ref - https://developers.facebook.com/docs/graph-api/reference/whats-app-business-account/message_templates

        // Log::info('Fetching message templates...');
        Log::info('Template name: ' . $templateName);
        $version = 'v19.0'; // Replace with your desired API version
        $wabaId = getenv("FB_ACCOUNT_ID"); // Replace with your WhatsApp Business Account ID
        $token = getenv("FB_METADATA_TOKEN"); // Replace with your authorization token

        // Define the URL
        $url = 'https://graph.facebook.com/' . $version . '/' . $wabaId . '/message_templates?name=' . $templateName;

        // Make the HTTP request
        $response = Http::withToken($token)->get($url);

        // Log::info($response);

        // Check the response status
        if ($response->successful()) {

            // Get the response body
            $data = $response->json();
            // Log::info($data);

            $response_data = [];
            $lag = '';

            foreach ($data['data'] as &$item) {
                if ($item['name'] == $templateName && isset($item['components'])) {
                    // Log::info($item['name']);
                    foreach ($item['components'] as &$component) {
                        if (isset($component['text'])) {
                            $component['text'] = html_entity_decode($component['text'], ENT_QUOTES, 'UTF-8');
                            // Log::info($component);

                            // push component data into response_data array
                            array_push($response_data, $component);
                        }
                    }
                }

                if ($item['name'] == $templateName && isset($item['language'])) {
                    // push in the template
                    $lag =  $item['language'];
                }
            }

            // Log::info($response_data);
            // Log::info($lag);

            // Return or process the data as needed
            return response()->json($data);
        } else {
            // Handle the error
            return response()->json(['error' => 'Failed to fetch message templates'], $response->status());
        }
    }

    //============================= Messages ============================
    public function sendTextMessage(Request $request)
    {
        // Log::info($request->all());
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . getenv("FB_METADATA_TOKEN"),
            'Content-Type' => 'application/json',
        ])->post('https://graph.facebook.com/v19.0/' . getenv("FB_PHONE_NUMBER") . '/messages', [
            'messaging_product' => 'whatsapp',
            "recipient_type" => "individual",
            'to' => $request->recipient_id,
            'type' => 'text',
            'text' => [
                'preview_url' => false,
                'body' => $request->message,
            ]
        ]);

        Log::info($response);

        $data = json_decode($response, true);  // Assuming $response is a JSON string, decode it into an associative array

        if (isset($data['messages'])) {
            $messages = $data['messages'];

            // foreach ($messages as $message) {
            //     // Check if the wa_id exists, then update, otherwise create a new record
            //     WhatsappMessage::updateOrCreate(
            //         ['message_id' => $message['id']],
            //         [
            //             'whatsapp_message' => $request->message,
            //             'template_name' => null,
            //             'template_type' => null,
            //             'type' => 'send',
            //             'status' => null,
            //             'phone_number' => $data['contacts'][0]['wa_id'],
            //             'from' => null,
            //             'recipient_id' => $data['contacts'][0]['wa_id'],
            //             'send_at' => null,
            //         ]
            //     );
            // }

            foreach ($messages as $message) {
                // Fetch the existing message if it exists
                $existingMessage = WhatsappMessage::where('recipient_id', $data['contacts'][0]['wa_id'])->whereNotNull('profile_name')->first();


                // Prepare the attributes for update or create
                $attributes = [
                    'whatsapp_message' => $request->message,
                    'template_name' => null,
                    'template_type' => null,
                    'type' => 'send',
                    'status' => null,
                    'phone_number' => $data['contacts'][0]['wa_id'],
                    'from' => null,
                    'recipient_id' => $data['contacts'][0]['wa_id'],
                    'send_at' => null,
                ];

                // If the message exists, add the profile name
                if ($existingMessage) {
                    $attributes['profile_name'] = $existingMessage->profile_name;
                }

                // Update or create the record
                WhatsappMessage::updateOrCreate(
                    ['message_id' => $message['id']],
                    $attributes
                );
            }
        }


        // return $response;

        // Log::info($response);

        // return redirect()->route('whatsapp.chat.index', ['recipient_id' => $request->recipient_id]);

        return redirect()->route('whatsapp.chat.index');
    }

    public function sendTmpMessage(Request $request)
    {
        $template = MessageTemplate::find($request->template_id);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . getenv("FB_METADATA_TOKEN"),
            'Content-Type' => 'application/json',
        ])->post('https://graph.facebook.com/v19.0/' . getenv("FB_PHONE_NUMBER") . '/messages', [
            'messaging_product' => 'whatsapp',
            "recipient_type" => "individual",
            'to' => '+91' . $request->phone,
            'type' => 'template',

            'template' => [
                'name' => $template->name,
                'language' => [
                    'code' => 'en'
                ]
            ]
        ]);

        $data = json_decode($response, true);  // Assuming $response is a JSON string, decode it into an associative array

        if (isset($data['messages'])) {
            $messages = $data['messages'];

            foreach ($messages as $message) {
                // Check if the wa_id exists, then update, otherwise create a new record
                WhatsappMessage::updateOrCreate(
                    ['message_id' => $message['id']],
                    [
                        'whatsapp_message' => $request->message,
                        'template_name' => null,
                        'template_type' => null,
                        'type' => 'send',
                        'status' => null,
                        'phone_number' => $data['contacts'][0]['wa_id'],
                        'from' => null,
                        'recipient_id' => $data['contacts'][0]['wa_id'],
                        'send_at' => null,
                    ]
                );
            }
        }


        // return $response;

        // Log::info($response);

        return redirect()->route('whatsapp.chat.index', ['recipient_id' => $request->recipient_id]);
    }

    public function markAsRead($messageId)
    {
        $phoneNumberId = env('FB_PHONE_NUMBER');
        $accessToken = env('FB_METADATA_TOKEN');
        $version = 'v19.0';

        $url = "https://graph.facebook.com/{$version}/{$phoneNumberId}/messages";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ])->put($url, [
            'messaging_product' => 'whatsapp',
            'status' => 'read',
            'message_id' => $messageId,
        ]);

        Log::info('Response from Facebook API: ', $response->json());

        if ($response->successful()) {
            return response()->json(['status' => 'Message marked as read', 'response' => $response->json()], 200);
        } else {
            return response()->json(['error' => 'Failed to mark message as read', 'response' => $response->body()], $response->status());
        }
    }
}
