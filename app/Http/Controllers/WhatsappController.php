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

    //================================ Cloud Api ============================//
    public function webhook(Request $request)
    {
        // Handle incoming webhook request
        $data = $request->all();

        // Verify webhook signature if required

        // Process incoming data

        // Respond to WhatsApp

        return response()->json(['status' => 'success']);
    }

    public function verifyWebhook(Request $request)
    {
        $hubVerifyToken = getenv("FB_METADATA_TOKEN");

        // Check if the request method is GET and it contains hub_challenge and hub_verify_token
        if ($request->isMethod('get') && $request->has('hub_challenge') && $request->has('hub_verify_token') && $request->input('hub_verify_token') === $hubVerifyToken) {
            return $request->input('hub_challenge');
        }
    }

    public function receiveMessage(Request $request)
    {
        // Process incoming messages
        if ($request->isMethod('post')) {
            $body = json_decode($request->getContent(), true);

            // Handle the incoming message data
            // Implement your logic to handle the incoming messages here
            // For example:
            $senderId = $body['entry'][0]['messaging'][0]['sender']['id'];
            $messageText = $body['entry'][0]['messaging'][0]['message']['text'];

            // Implement your response logic here
            // For example:
            $this->sendFacebookMessage($senderId, 'Hello from your Facebook Messenger bot!');
        }
    }

    private function sendFacebookMessage($recipientId, $message)
    {
        // You need to implement the logic to send Facebook messages here.
        // This could involve using Facebook Messenger API or any other platform-specific API.
        // For example:
        // 1. Using Facebook Messenger API
        // 2. Using a third-party service that provides Facebook Messenger integration
        // 3. Directly integrating with Facebook's APIs (requires approval and access)
        // Due to Facebook's policies, you can't send messages without proper authorization and using their official APIs.
        // Ensure you comply with Facebook's terms of service and guidelines.
    }

    public function sendWhatsappMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|string',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $phone_number = $request->input('phone_number');
        $message = $request->input('message');

        $client = new Client();
        $response = $client->request('POST', 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX', [
            'headers' => [
                'Authorization' => 'Bearer ' . getenv('FB_ACCESS_TOKEN'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'messaging_product' => 'whatsapp',
                'to' => $phone_number,
                'text' => [
                    'body' => $message,
                ],
            ],
        ]);
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

    //============================ Profile picture =============================
    /**
     * create profile picture session
     */
    public function createProfilePictureSession(Request $request)
    {
        try {
            $apiVersion = "v19.0";
            $appId = getenv("FB_APP_ID");
            $phoneNumberId = getenv("FB_PHONE_NUMBER");
            $accessToken = getenv("FB_METADATA_TOKEN");
            $fileLength = "";
            $fileType = "";

            $validator = Validator::make($request->all(), [
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();

                $path = 'template/img/' . $imageName;
                $image_path = public_path('template/img/' . $imageName);
                $image->move(public_path('template/img/'), $imageName);
            }

            // $response = Http::post("https://graph.facebook.com/{$apiVersion}/{$appId}/uploads", [
            //     'file_length' => $fileLength,
            //     'file_type' => $fileType,
            //     'access_token' => $accessToken,
            // ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get profile picture
     */
    public function uploadImage()
    {
        // Replace with your access token and upload ID
        $accessToken = 'YOUR_ACCESS_TOKEN';
        $uploadId = 'YOUR_UPLOAD_ID';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'image/jpeg',
            'file_offset' => '0',
        ])->attach('photo', file_get_contents('/Users/Sample.jpg'))
            ->post('https://graph.facebook.com/v19.0/' . $uploadId);

        if ($response->successful()) {
            return $response->json(); // If you expect JSON response
        } else {
            return "Error uploading image: " . $response->status();
        }
    }

    public function handleWebhook(Request $request)
    {
        // Instantiate the WhatsAppCloudApi WebHook class
        $webhook = new WebHook();

        // Parameters from the request
        $params = $request->all();

        // The verify token from your Laravel config or environment variables
        $verifyToken = getenv("FB_METADATA_TOKEN");

        // Verify the webhook request
        $verificationResult = $webhook->verify($params, $verifyToken);

        // Return the verification result
        return response()->json($verificationResult);
    }


    //======================================= Trail code =================================
    const VERIFY_TOKEN = 'LaravelToken';

    public function setupWebhook(Request $request)
    {
        Log::info($request->all());
        $hubMode = $request->query('hub_mode');
        $hubChallenge = $request->query('hub_challenge');
        $hubVerifyToken = $request->query('hub_verify_token');

        Log::info('WebHook with get executed.');
        Log::info("Parameters: hub_mode=$hubMode  hub_challenge=$hubChallenge  hub_verify_token=$hubVerifyToken");

        if ($hubVerifyToken !== self::VERIFY_TOKEN) {
            return response()->json(['error' => 'VerifyToken doesn\'t match'], 403);
        }

        // Remove double quotes from the received challenge value
        $cleanHubChallenge = trim($hubChallenge, '"');

        Log::info($cleanHubChallenge);

        // return response()->json($cleanHubChallenge);
        return response($hubChallenge);

    }


    public function receiveNotification(Request $request)
    {
        $data = $request->getContent();

        Log::info('WebHook with Post executed.');
        Log::info($data);

        return response()->json();
    }
}
