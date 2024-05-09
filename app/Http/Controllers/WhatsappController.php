<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

class WhatsappController extends Controller
{
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

    public function getProfile(Request $request)
    {
        $fromPhoneNumberId = 'FROM_PHONE_NUMBER_ID';
        $accessToken = 'ACCESS_TOKEN';

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
        $phoneNumberId = 'PHONE_NUMBER_ID';
        $accessToken = 'ACCESS_TOKEN';

        $client = new Client([
            'base_uri' => 'https://graph.facebook.com/v19.0/',
        ]);

        try {
            $response = $client->request('POST', $phoneNumberId . '/whatsapp_business_profile', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    "messaging_product" => "whatsapp",
                    "about" => "ABOUT",
                    "address" => "ADDRESS",
                    "description" => "DESCRIPTION",
                    "vertical" => "INDUSTRY",
                    "email" => "EMAIL",
                    "websites" => [
                        "https://WEBSITE-1",
                        "https://WEBSITE-2"
                    ],
                    "profile_picture_handle" => "HANDLE_OF_PROFILE_PICTURE"
                ],
            ]);

            $statusCode = $response->getStatusCode();

            if ($statusCode === 200) {
                return response()->json(['success' => true], 200);
            } else {
                return response()->json(['error' => 'Failed to update WhatsApp profile'], $statusCode);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
