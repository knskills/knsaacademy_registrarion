<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

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
    return result($result);

    return $response->body();
}


function result($result)
{
    $decodedResult = json_decode($result, true); // Assuming $result is a JSON response

    // Check if the responseCode is 3001
    if (isset($decodedResult['responseCode']) && $decodedResult['responseCode'] == '3001') {
        Log::info('WhatsApp message sent successfully. Response: ' . $result);
        return 'sent';
    } else {
        // Update message status to 'failed'
        Log::error('Error sending WhatsApp message. Response: ' . $result);
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
