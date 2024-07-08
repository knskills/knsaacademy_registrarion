<?php

namespace App\Http\Controllers;

use App\Models\WhatsappApi;
use App\Models\WhatsappMessage;
use App\Events\MessageReceived;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class WhatsappController extends Controller
{
    // create whatsapp api
    public function create(Request $request)
    {
        $data = WhatsappApi::first();
        return view('admin.whatsapp.create', compact('data'));
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

    //================================== Subscribed Apps =========================//
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

    //================================== Templates ===============================//
    public function getMessageTemplate($templateName = null)
    {
        // Reference: https://developers.facebook.com/docs/graph-api/reference/whats-app-business-account/message_templates

        $version = getenv("FB_API_VERSION");
        $wabaId = getenv("FB_ACCOUNT_ID");
        $token = getenv("FB_METADATA_TOKEN");

        $url = "https://graph.facebook.com/$version/$wabaId/message_templates?name=$templateName";

        $response = Http::withToken($token)->get($url);

        // Log::info($response->json());
        if ($response->successful()) {
            $data = $response->json();

            $components = [];
            $body_params = [];
            $header_img = null;
            $language = null;
            $response = $data['data'] ?? null;
            $template = [];

            foreach ($data['data'] as $item) {
                if ($item['name'] == $templateName && isset($item['components'])) {
                    foreach ($item['components'] as $component) {
                        $type = strtolower($component['type']);

                        if ($type === "header") {
                            $header = [
                                'type' => $type,
                                'parameters' => [
                                    'type' => strtolower($component['format']),
                                    strtolower($component['format']) => [
                                        'link' => $component['example']['header_handle'][0]
                                    ]
                                ]
                            ];
                            $components[] = $header;
                            $header_img = $component['example']['header_handle'][0] ?? null;
                        } else if ($type === "body") {

                            if (isset($component['text'])) {
                                $component['text'] = html_entity_decode($component['text'], ENT_QUOTES, 'UTF-8');

                                // Extract body parameters if available, otherwise set to an empty array
                                $body_params = $component['example']['body_text'][0] ?? [];

                                // Initialize body array
                                $body = [];

                                // Only add type and parameters if body_params is not empty
                                if (!empty($body_params)) {
                                    $body['type'] = $type;
                                    $body['parameters'] = array_map(function ($param) {
                                        return ['type' => 'text', 'text' => $param];
                                    }, $body_params);

                                }

                                // Add to components if body is not empty
                                if (!empty($body)) {
                                    $components[] = $body;
                                }

                                $body_params = $component['example']['body_text'][0] ?? null;
                                $body_text = $component['text'] ?? null;
                            }
                        }
                    }
                }

                if ($item['name'] == $templateName && isset($item['language'])) {
                    $language = $item['language'];
                }
            }

            $template['name'] = $templateName;
            $template['language']['code'] = $language;
            $template['components'] = $components;


            return response()->json([
                'components' => $components,
                'language' => $language ?? null,
                'body_params' => $body_params,
                'header_img' => $header_img,
                'response' => $response
            ]);
        } else {
            return null;
        }
    }

    //================================= Messages ===============================//
    public function markAsRead($messageId)
    {
        Log::info($messageId);
        $phoneNumberId = env('FB_PHONE_NUMBER');
        $accessToken = env('FB_METADATA_TOKEN');
        $version = 'v19.0';

        $response = Http::withToken($accessToken)
            ->post("https://graph.facebook.com/v19.0/{$phoneNumberId}/messages", [
                'messaging_product' => 'whatsapp',
                'status' => 'read',
                'message_id' => $messageId,
            ]);

        if ($response->successful()) {
            return response()->json(['message' => 'Message marked as read successfully.'], 200);
        }

        return response()->json(['error' => 'Failed to mark message as read.'], $response->status());
    }

    public function sendMessage(Request $request)
    {
        Log::info($request->all());
        try {
            // Validate the request
            $request->validate([
                'recipient_id' => 'required|string',
                'message' => 'required_without:media_image|string',
                'media_image' => 'sometimes|image',
            ]);

            $payload = [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $request->recipient_id,
            ];

            if ($request->hasFile('media_image')) {
                $image = $request->file('media_image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = 'whatsapp/images/' . $imageName;
                $image->move(public_path('whatsapp/images/'), $imageName);

                $imageUrl = asset('whatsapp/images/' . $imageName);

                $payload['type'] = 'image';
                $payload['image'] = [
                    'link' => $imageUrl,
                    'caption' => $request->message,
                ];
            }if ($request->hasFile('doc_file')) {
                $doc = $request->file('doc_file');
                $docName = time() . '_' . $doc->getClientOriginalName();
                $file_name = $doc->getClientOriginalName();
                $docPath = 'whatsapp/documents/' . $docName;
                $doc->move(public_path('whatsapp/documents/'), $docName);

                $docUrl = asset('whatsapp/documents/' . $docName);
                // $docUrl = 'https://registration.knsacademy.in/assets/img/learning/5.jpeg';

                $payload['type'] = 'document';
                $payload['document'] = [
                    'link' => $docUrl,
                    'caption' => $request->message,
                    'filename' => $file_name,
                ];
            }else {
                $payload['type'] = 'text';
                $payload['text'] = [
                    'preview_url' => false,
                    'body' => $request->message,
                ];
            }

            // Send the message via HTTP request
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env("FB_METADATA_TOKEN"),
                'Content-Type' => 'application/json',
            ])->post('https://graph.facebook.com/v19.0/' . env("FB_PHONE_NUMBER") . '/messages', $payload);

            $data = json_decode($response->getBody(), true);

            Log::info($data);
            if (isset($data['contacts'][0]['wa_id'])) {
                $recipientId = $data['contacts'][0]['wa_id'];
                $contactId = createContact($recipientId, $profile_name = null);

                if (isset($data['messages'])) {
                    foreach ($data['messages'] as $messageData) {
                        $existingMessage = WhatsappMessage::where('recipient_id', $recipientId)->whereNotNull('profile_name')->first();

                        $attributes = [
                            'contact_id' => $contactId,
                            'whatsapp_message' => $request->message ?? null,
                            'template_name' => null,
                            'template_type' => null,
                            'type' => 'send',
                            'status' => 'sent',
                            'image' => $request->hasFile('media_image') ? $imagePath : null,
                            'document' => $request->hasFile('doc_file') ? $docPath : null,
                            'phone_number' => $recipientId,
                            'from' => null,
                            'recipient_id' => $recipientId,
                            'send_at' => null,
                            'profile_name' => $existingMessage->profile_name ?? null,
                        ];

                        $message = WhatsappMessage::updateOrCreate(
                            ['message_id' => $messageData['id']],
                            $attributes
                        );

                        // broadcast(new MessageReceived($message))->toOthers();
                    }
                }
            }

            return redirect()->route('whatsapp.chat.index');

            // return response()->json(['status' => 'Message sent!']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors('An error occurred while sending the message');
        }
    }
}
