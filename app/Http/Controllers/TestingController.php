<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\WhatsappMessage;
use App\Models\MessageTemplate;
use App\Models\WhtasappTemplate;
use App\Models\WhatsappChatContact;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class TestingController extends Controller
{
    /**
     * Handle the incoming request.
     * refresnce - https://platform.openai.com/docs/api-reference/introduction
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function askToChatGpt()
    {
        $message = "what is laravel";
        $response = $this->httpClient->post('chat/completions', [
            'json' => [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are'],
                    ['role' => 'user', 'content' => $message],
                ],
            ],
        ]);

        return json_decode($response->getBody(), true)['choices'][0]['message']['content'];
    }

    public function getContacts()
    {
        try {
            // Fetch all messages
            $messages = WhatsappMessage::all();

            Log::info('Total messages: ' . $messages->count());

            foreach ($messages as $message) {
                // Check if contact already exists based on phone number
                $existing_contact = WhatsappChatContact::where('number', $message->recipient_id)->first();

                if ($existing_contact) {
                    // If contact exists, assign the existing contact ID to the message
                    $message->contact_id = $existing_contact->id;
                } else {
                    // If contact does not exist, create a new contact
                    $new_contact = WhatsappChatContact::create([
                        'name' => $message->profile_name,
                        'number' => $message->recipient_id,
                    ]);

                    // Assign the new contact ID to the message
                    $message->contact_id = $new_contact->id;
                }

                // Save the message with the updated contact_id
                $message->save();
            }


            return 'task completed';
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }


    public function getMessageTemplate($templateName = null)
    {
        // Reference: https://developers.facebook.com/docs/graph-api/reference/whats-app-business-account/message_templates

        $version = getenv("FB_API_VERSION");
        $wabaId = getenv("FB_ACCOUNT_ID");
        $token = getenv("FB_METADATA_TOKEN");

        $url = "https://graph.facebook.com/$version/$wabaId/message_templates?name=$templateName";

        $response = Http::withToken($token)->get($url);

        Log::info($response->json());
        if ($response->successful()) {
            return response()->json([
                'response' => $response
            ]);
        } else {
            return response()->json([
                'error' => $response->json()
                // 'error' => $response->body()
            ]);
        }
    }

    public function sendTempMessage()
    {
        try {
            $url = 'https://graph.facebook.com/v19.0/' . getenv("FB_PHONE_NUMBER") . '/messages';
            $accessToken = getenv("FB_METADATA_TOKEN");
            $phoneNumber = '+919770019148';
            $templateName = 'knsa_test_temp';
            $languageCode = 'en';
            $imageUrl = 'https://registration.knsacademy.in/assets/img/learning/5.jpeg';

            $response = Http::withToken($accessToken)
                ->post($url, [
                    'messaging_product' => 'whatsapp',
                    'recipient_type' => 'individual',
                    'to' => $phoneNumber,
                    'type' => 'template',
                    'template' => [
                        'name' => $templateName,
                        'language' => [
                            'code' => $languageCode,
                        ],
                        // 'components' => [
                        //     [
                        //         'type' => 'header',
                        //         'parameters' => [
                        //             [
                        //                 'type' => 'image',
                        //                 'image' => [
                        //                     'link' => $imageUrl,
                        //                 ],
                        //             ],
                        //         ],
                        //     ],
                        //     // [
                        //     //     'type' => 'body',
                        //     //     'parameters' => [
                        //     //         [
                        //     //             'type' => 'text',
                        //     //             'text' => 'rohit kumar',
                        //     //         ],
                        //     //         [
                        //     //             'type' => 'text',
                        //     //             'text' => '24-06-2024',
                        //     //         ],
                        //     //         [
                        //     //             'type' => 'text',
                        //     //             'text' => 'https://registration.knsacademy.in/',
                        //     //         ],
                        //     //         // [
                        //     //         //     'type' => 'currency',
                        //     //         //     'currency' => [
                        //     //         //         'fallback_value' => $currencyValue,
                        //     //         //         'code' => $currencyCode,
                        //     //         //         'amount_1000' => $amount,
                        //     //         //     ],
                        //     //         // ],
                        //     //         // [
                        //     //         //     'type' => 'date_time',
                        //     //         //     'date_time' => [
                        //     //         //         'fallback_value' => $fallbackDate,
                        //     //         //     ],
                        //     //         // ],
                        //     //     ],
                        //     // ]
                        // ],
                    ],
                ]);
            Log::info($response->body());

            if ($response->successful()) {
                return response()->json(['message' => 'Message sent successfully'], 200);
            } else {
                return response()->json(['error' => 'Failed to send message', 'details' => $response->json()], $response->status());
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }
}
