<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

function sendSms($phone, $message)
{
    try {
        $mobileNumber = $phone;
        $message =  $message;
        $senderId = getenv("MSGCLUB_SENDER_ID");
        $serverUrl = getenv("MSGCLUB_SERVER_URL");
        $authKey = getenv("MSGCLUB_AUTH_KEY");
        $routeId = getenv("MSGCLUB_SMS_ROUTE");
        $result = sendsmsGET($mobileNumber, $senderId, $routeId, $message, $serverUrl, $authKey);
        // Log::info('sendSms result: ' . $result);
        $result = result($result);
        return $result;
    } catch (\Exception $e) {
        Log::error($e->getMessage());
    }
}

function sendsmsGET($mobileNumber, $senderId, $routeId, $message, $serverUrl, $authKey)
{
    try {
        $route = $routeId;
        $getData = 'mobileNos=' . $mobileNumber . '&message=' . urlencode($message) . '&senderId=' . $senderId . '&routeId=' . $route;

        /* API URL */
        $url = "http://" . $serverUrl . "/rest/services/sendSMS/sendGroupSms?AUTH_KEY=" . $authKey . "&" . $getData;

        /* init the resource */
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0
        ));

        /* get response */
        $output = curl_exec($ch);

        /* Print error if any */
        if (curl_errno($ch)) {
            echo 'error:' . curl_error($ch);
        }

        curl_close($ch);

        return $output;
    } catch (\Exception $e) {
        Log::error($e->getMessage());
    }
}

function sendWhatsAppMessage($phone, $message)
{
    $authKey = getenv("MSGCLUB_AUTH_KEY");
    $whatsappNumber = getenv("MSGCLUB_AWHATSAPP_NO");
    $toNumber = $phone; // Replace with the recipient's WhatsApp number
    $bodyText = $message; // Replace with the message body text

    $url = 'http://msg.msgclub.net/rest/services/sendSMS/v2/sendtemplate?AUTH_KEY=' . $authKey;

    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Cookie' => 'JSESSIONID=23BD7D8B4F08B438F9A42E5334C2DDEB.node3',
    ])->post($url, [
        'senderId' => $whatsappNumber,
        'component' => [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $toNumber,
            'type' => 'text',
            'text' => [
                'preview_url' => true,
                'body' => $bodyText,
            ],
        ],
    ]);

    $result = $response->body();
    // Log::info('sendWhatsAppMessage result: ' . $result);
    return result($result);

    return $response->body();
}


function result($result)
{
    $decodedResult = json_decode($result, true); // Assuming $result is a JSON response

    // Check if the responseCode is 3001
    if (isset($decodedResult['responseCode']) && $decodedResult['responseCode'] == '3001') {
        Log::info('Message sent successfully. Response: ' . $result);
        return 'sent';
    } else {
        // Update message status to 'failed'
        Log::error('Error sending message. Response: ' . $result);
        return 'failed';
    }
}


// not used
function sendBulkWhatsAppMessages(array $phones, $message)
{
    $authKey = getenv("MSGCLUB_AUTH_KEY");
    $whatsappNumber = getenv("MSGCLUB_AWHATSAPP_NO");

    $url = 'http://msg.msgclub.net/rest/services/sendSMS/v2/sendtemplate?AUTH_KEY=' . $authKey;

    $responses = [];

    foreach ($phones as $phone) {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Cookie' => 'JSESSIONID=23BD7D8B4F08B438F9A42E5334C2DDEB.node3',
        ])->post($url, [
            'senderId' => $whatsappNumber,
            'component' => [
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $phone,
                'type' => 'text',
                'text' => [
                    'preview_url' => true,
                    'body' => $message,
                ],
            ],
        ]);

        $responses[] = $response->json();
    }

    return $responses;
}


function sendWhatsAppMessageWithMedia($phone, $message, $mediaFileName, $mediaFileData)
{
    $authKey = getenv("MSGCLUB_AUTH_KEY");
    $whatsappNumber = getenv("MSGCLUB_WHATSAPP_NO");
    $toNumber = $phone;
    $bodyText = $message;

    $url = 'http://msg.msgclub.net/rest/services/sendSMS/v2/sendtemplate?AUTH_KEY=' . $authKey;

    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Cookie' => 'JSESSIONID=23BD7D8B4F08B438F9A42E5334C2DDEB.node3',
    ])->post($url, [
        'senderId' => $whatsappNumber,
        'component' => [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $toNumber,
            'type' => 'media', // Set the type to 'media' for sending multimedia content
            'media' => [
                'preview_url' => true,
                'filename' => $mediaFileName,
                'filedata' => $mediaFileData,
                'caption' => $bodyText, // Caption for the media
            ],
        ],
    ]);

    return $response->body();
}
// not used


// send email
function sendEmail($to, $subject, $message, $cc = null, $bcc = null)
{
    Log::info('sendEmail');
    try {
        $from = getenv("MAIL_FROM_ADDRESS");
        $fromName = getenv("MAIL_FROM_NAME");
        // $data = [
        //     'to' => $to,
        //     'subject' => $subject,
        //     'message' => $message,
        //     'cc' => $cc,
        //     'bcc' => $bcc,
        // ];
        // Mail::send('emails.email', $data, function ($message) use ($from, $fromName, $to, $subject) {
        //     $message->from($from, $fromName);
        //     $message->to($to)->subject($subject);
        // });
    } catch (\Exception $e) {
        Log::error($e->getMessage());
    } catch (\Exception $e) {
        Log::error($e->getMessage());
    }
}


//============================================== TWILIO ========================================//
// send message
function sendMessage()
{
    try {
        $sid = getenv("TWILIO_ACCOUNT_SID");
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilioNumber = getenv("TWILIO_NUMBER");
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create(
                "whatsapp:+919770019148", // to +14155238886
                [
                    "body" => "This is a message that I want to send over WhatsApp with Twilio!",
                    "from" => "whatsapp:" . $twilioNumber,
                ]
            );

        return $message->sid;
    } catch (\Exception $e) {
        Log::error($e->getMessage());
    }
}

// send email
function sendEmailWithTwilio($to, $subject, $message, $cc = null, $bcc = null)
{
    Log::info('sendEmailWithTwilio');
    try {
        $from = getenv("MAIL_FROM_ADDRESS");
        $fromName = getenv("MAIL_FROM_NAME");
        $data = [
            'to' => $to,
            'subject' => $subject,
            'message' => $message,
            'cc' => $cc,
            'bcc' => $bcc,
        ];
        Mail::send('emails.email', $data, function ($message) use ($from, $fromName, $to, $subject) {
            $message->from($from, $fromName);
            $message->to($to)->subject($subject);
        });
    } catch (\Exception $e) {
        Log::error($e->getMessage());
    }
}

//======================================== Facebook =================================================//
function sendFBMessage($phone = null)
{
    // Log::info($phone);

    // $response = Http::withHeaders([
    //     'Authorization' => 'Bearer ' . getenv("FB_METADATA_TOKEN"),
    //     'Content-Type' => 'application/json',
    // ])->post('https://graph.facebook.com/v19.0/' . getenv("FB_PHONE_NUMBER") . '/messages', [
    //     'messaging_product' => 'whatsapp',
    //     'recipient_type' => 'individual',
    //     'to' => '+919770019148',
    //     'type' => 'text',
    //     'text' => [
    //         'body' => 'Welcome and congratulations!! This message demonstrates your ability to send a WhatsApp message notification from the Cloud API, hosted by Meta. Thank you for taking the time to test with us.'
    //     ]
    // ]);

    // return $response->body();

    // Log::info(getenv("FB_METADATA_TOKEN"));

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . getenv("FB_METADATA_TOKEN"),
        'Content-Type' => 'application/json',
    ])->post('https://graph.facebook.com/v19.0/' . getenv("FB_PHONE_NUMBER") . '/messages', [
        'messaging_product' => 'whatsapp',
        "recipient_type" => "individual",
        'to' => '+91' . $phone,
        'type' => 'template',
        // 'template' => [
        //     'name' => 'hello_world',
        //     'language' => [
        //         'code' => 'en_US'
        //     ]
        // ]

        // 'template' => [
        //     'name' => 'testing',
        //     'language' => [
        //         'code' => 'hi'
        //     ]
        // ]

        'template' => [
            'name' => 'welcome',
            'language' => [
                'code' => 'en'
            ]
        ]
    ]);

    Log::info($response->body());

    // return $response->body();
}


function getMessageTemplate($templateName = null)
{
    // Ref - https://developers.facebook.com/docs/graph-api/reference/whats-app-business-account/message_templates

    // Log::info($templateName);


    $version = 'v19.0'; // Replace with desired API version
    $wabaId = getenv("FB_ACCOUNT_ID"); // Replace with WhatsApp Business Account ID
    $token = getenv("FB_METADATA_TOKEN"); // Replace with authorization token

    // Define the URL
    $url = 'https://graph.facebook.com/' . $version . '/' . $wabaId . '/message_templates?name=' . $templateName;

    // Make the HTTP request
    $response = Http::withToken($token)->get($url);

    // Log::info($response);

    // Check the response status
    if ($response->successful()) {

        // Get the response body
        $data = $response->json();

        $response_data = [];

        foreach ($data['data'] as &$item) {
            if ($item['name'] == $templateName && isset($item['components'])) {
                // Log::info($item['name']);
                // array_push($response_data, $item['components']);

                foreach ($item['components'] as &$component) {
                    if (isset($component['text'])) {
                        $component['text'] = html_entity_decode($component['text'], ENT_QUOTES, 'UTF-8');
                        // Log::info($component);

                        // push component data into response_data array
                        array_push($response_data, $component);
                    }
                }
            } else {
                return null;
            }
        }

        return $response_data;
    } else {
        // Handle the error
        return response()->json(['error' => 'Failed to fetch message templates'], $response->status());
    }
}
