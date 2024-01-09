<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\Message;
use App\Models\MessageTemplate;
use App\Models\audience as Audience;
use App\Models\Event;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $messagesQuery = Message::with('messageTemplate', 'event');

        if ($request->has('search')) {
            $searchTerm = $request->search;
            // Assuming 'name' is a column in the 'messages' table
            $messagesQuery->where('name', 'like', '%' . $searchTerm . '%');
        } elseif ($request->has('event')) {
            $event = $request->event;
            // Assuming 'event_name' is a column in the 'messages' table
            $messagesQuery->whereHas('event', function ($query) use ($event) {
                $query->where('name', $event);
            });
        } else {
            $messagesQuery->orderBy('id', 'desc');
        }

        $messages = $messagesQuery->paginate(10);

        $messages->appends($request->except('page'));

        return view('admin.messages.index', compact('messages'));
    }

    public function create()
    {
        $templates = MessageTemplate::all();
        $events = Event::all();
        return view('admin.messages.create', compact('templates', 'events'));
    }

    public function store(Request $request)
    {
        $message = Message::create($request->all());
        $audience_ids = $request->audience_ids;

        foreach ($audience_ids as $key => $audience_id) {
            $audience = Audience::where('id', $audience_id)->first();
            $message = MessageTemplate::where('id', $request->message_template_id)->first()->message;

            // replace variables in message
            $message = str_replace("{name}", $audience->name, $message);
            $message = str_replace("{email}", $audience->email, $message);
            $message = str_replace("{phone}", $audience->phone, $message);
            // $message = str_replace("{event}", $audience->event->name, $message);
            // $message = str_replace("{date}", $audience->event->date, $message);
            // $message = str_replace("{time}", $audience->event->time, $message);

            if ($request->type == 'whatsapp') {
                $reasult = $this->sendWhatsAppMessage($audience->phone, $message);
            } else {
                $reasult = $this->sendSms($audience->phone, $message);
            }
        }
        return redirect()->route('messages.index')->with('success', 'Message created successfully');
    }

    public function sendSms($phone, $message)
    {
        try {
            $mobileNumber = $phone;
            $message =  $message;
            $senderId = getenv("MSGCLUB_SENDER_ID");
            $serverUrl = getenv("MSGCLUB_SERVER_URL");
            $authKey = getenv("MSGCLUB_AUTH_KEY");
            $routeId = getenv("MSGCLUB_SMS_ROUTE");
            $this->sendsmsGET($mobileNumber, $senderId, $routeId, $message, $serverUrl, $authKey);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function sendsmsGET($mobileNumber, $senderId, $routeId, $message, $serverUrl, $authKey)
    {
        $route = $routeId;
        $getData = 'mobileNos=' . $mobileNumber . '&message=' . urlencode($message) . '&senderId=' . $senderId . '&routeId=' . $route;

        /* API URL */
        $url = "http://" . $serverUrl . "/rest/services/sendSMS/sendGroupSms?AUTH_KEY=" . $authKey . "&" . $getData;

        Log::info($url);

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

        Log::info($output);

        return $output;
    }

    public function sendWhatsAppMessage($phone, $message)
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

        return $response->body();
    }
}
