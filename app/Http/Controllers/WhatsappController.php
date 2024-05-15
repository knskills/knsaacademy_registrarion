<?php

namespace App\Http\Controllers;

use App\Models\WhatsappApi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Netflie\WhatsAppCloudApi\WebHook;

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
        // Log::info($request->all());

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
            $accessToken = $request->header('Authorization');

            // if ($accessToken !== 'Bearer ' . env('WEBHOOK_ACCESS_TOKEN')) {
            //     return response()->json(['error' => 'Unauthorized'], 401);
            // }

            $data = $request->json()->all();

            // Log the inbound message data for debugging purposes
            Log::info('Inbound message:', $data);

            // Respond with 200 OK to acknowledge receipt of the message
            return response()->json(['status' => 'Message received'], 200);
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

    public function receiveNotification(Request $request)
    {
        $data = $request->getContent();

        Log::info('WebHook with Post executed.');
        Log::info($data);

        return response()->json();
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
    public function markAsRead($messageId)
    {
        $fromPhoneNumberId = env('FB_ACCOUNT_ID');
        $accessToken = env('FB_METADATA_TOKEN');
        $version = 'v19.0';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ])->post("https://graph.facebook.com/{$version}/{$fromPhoneNumberId}/messages", [
            'messaging_product' => 'whatsapp',
            'status' => 'read',
            'message_id' => $messageId,
        ]);

        if ($response->successful()) {
            return response()->json(['status' => 'Message marked as read', 'response' => $response->json()], 200);
        } else {
            return response()->json(['error' => 'Failed to mark message as read', 'response' => $response->body()], $response->status());
        }
    }
}
