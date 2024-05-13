<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\audience as Audience;
use App\Models\Event;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Http;
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;

class PageController extends Controller
{
    public function index()
    {
        return view('web.home');
    }

    public function beginnertobillionaire()
    {
        return view('web.ads.beginortobillinior');
    }

    public function sales()
    {
        return view('web.ads.sales');
    }

    public function billionaire()
    {
        return view('web.ads.bilinear');
    }

    public function terms()
    {
        return view('web.terms');
    }

    public function privacy()
    {
        return view('web.privacy');
    }

    /**
     * Whatsapp page
     */
    public function whatsapp(Request $request)
    {
        // if ($request->has('phone')) {
        //     $phone = $request->phone;
        //     $message = $request->message;
        //     $url = 'https://api.whatsapp.com/send?phone=' . $phone . '&text=' . $message;
        //     return redirect($url);
        // }
        return view('web.whatsapp');
    }


    //========================================================================================
    //====================================== Admin pages =====================================
    //========================================================================================

    /*
     * Dashboard
     */
    public function dashboard()
    {
        $audience = Audience::count();
        $events = Event::count();
        $messages = Message::count();
        return view('admin.dashboard.index')->with([
            'audience' => $audience,
            'events' => $events,
            'messages' => $messages,
        ]);
    }


    /**
     * Send test email
     */
    public function sendTestEmail()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'test@gmail.com',
            'subject' => 'Test Email',
            'body' => 'This is a test email'
        ];

        Mail::send('admin.mails.temp', $data, function ($message) use ($data) {
            $message->to($data['email'], $data['name'])->subject($data['subject']);
        });

        return "Test email sent successfully";


        // return redirect()->back()->with('success', 'Test email sent successfully');
    }

    function sendMessage()
    {
        try {
            $sid = getenv("TWILIO_ACCOUNT_SID");
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilioNumber = getenv("TWILIO_NUMBER");
            $twilio = new Client($sid, $token);

            Log::info(getenv("TWILIO_ACCOUNT_SID"));

            $message = $twilio->messages
                ->create(
                    "whatsapp:+919770019148", // to
                    [
                        "body" => "Hello rohit!",
                        "from" => "whatsapp:+14155238886", // from
                    ]
                );

            Log::info($message->sid);

            return $message->sid;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    //======================================= Whatsapp Cloud api ==============================//
    public function sendFBMessage(Request $request)
    {

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
            'to' => '+919770019148',
            'type' => 'template',
            // 'template' => [
            //     'name' => 'hello_world',
            //     'language' => [
            //         'code' => 'en_US'
            //     ]
            // ]

            'template' => [
                'name' => 'testing',
                'language' => [
                    'code' => 'hi'
                ]
            ]
        ]);

        return $response->body();
    }


    public function sendTempMessage(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . getenv("FB_METADATA_TOKEN"),
            'Content-Type' => 'application/json',
        ])->post('https://graph.facebook.com/v19.0/' . getenv("FB_PHONE_NUMBER") . '/messages', [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => 'PHONE_NUMBER',
            'type' => 'template',
            'template' => [
                'name' => 'TEST',
                'language' => [
                    'code' => 'en_US'
                ],
                'components' => [
                    [
                        'type' => 'body',
                        'parameters' => [
                            [
                                'type' => 'text',
                                'text' => 'text-string'
                            ],
                            [
                                'type' => 'currency',
                                'currency' => [
                                    'fallback_value' => 'VALUE',
                                    'code' => 'USD',
                                    'amount_1000' => 'NUMBER'
                                ]
                            ],
                            [
                                'type' => 'date_time',
                                'date_time' => [
                                    'fallback_value' => 'DATE'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]);

        return $response->body();
    }

    public function sendPlainTextMessage()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . getenv("FB_METADATA_TOKEN"),
            'Content-Type' => 'application/json',
        ])->post('https://graph.facebook.com/v19.0/' . getenv("FB_PHONE_NUMBER") . '/messages', [
            'messaging_product' => 'whatsapp',
            "recipient_type" => "individual",
            'to' => '+919770019148',
            'type' => 'text',
            'text' => [
                'body' => "testing"
            ]
        ]);

        return $response->body();
    }

    public function sendWPMessage()
    {
        // Instantiate the WhatsAppCloudApi super class.
        $whatsapp_cloud_api = new WhatsAppCloudApi([
            'from_phone_number_id' => getenv("FB_PHONE_NUMBER"),
            'access_token' => getenv("FB_METADATA_TOKEN"),
        ]);

        // Replace the recipient phone number and message with your desired values.
        $recipientPhoneNumber = '+919770019148';
        $message = "Hey there! I'm using WhatsApp Cloud API. Visit https://www.netflie.es";

        // Send the text message.
        $response = $whatsapp_cloud_api->sendTextMessage($recipientPhoneNumber, $message);

        // Log::info($response);

        // Optionally, you can return a response or perform any other actions after sending the message.
        return response()->json(['message' => 'Message sent successfully']);
    }

    public function sendTemplateMessage()
    {
        // Instantiate the WhatsAppCloudApi super class.
        $whatsapp_cloud_api = new WhatsAppCloudApi([
            'from_phone_number_id' => getenv("FB_PHONE_NUMBER"),
            'access_token' => getenv("FB_METADATA_TOKEN"),
        ]);

        // Replace the recipient phone number, template name, and language with your desired values.
        $recipientPhoneNumber = '+919770019148';
        $templateName = 'hello_world';
        $language = 'en_US'; // Language is optional, remove this line if not needed.

        // Send the template message.
        $whatsapp_cloud_api->sendTemplate($recipientPhoneNumber, $templateName, $language);

        // Optionally, you can return a response or perform any other actions after sending the message.
        return response()->json(['message' => 'Template message sent successfully']);
    }
}
