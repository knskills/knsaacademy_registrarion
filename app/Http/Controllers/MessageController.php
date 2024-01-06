<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Message;
use App\Models\MessageTemplate;
use App\Models\Audience;
use App\Models\Event;

class MessageController extends Controller
{

    // public function __construct()
    // {
    //     parent::__construct();
    // }

    public function index()
    {
        $messages = Message::all();
        return view('messages.index', compact('messages'));
    }

    public function create()
    {
        $templates = MessageTemplate::all();
        $events = Event::all();
        return view('admin.messages.create', compact('templates', 'events'));
    }

    public function sendMobileSms(Request $request)
    {
        $mobileNumber = $request->mobileNumber;
        $message = $request->message;
        $senderId = getenv("SMS_SENDER_ID");
        $serverUrl = getenv("SMS_SERVER_URL");
        $authKey = getenv("SMS_AUTH_KEY");
        $routeId = getenv("SMS_ROUTE");
        $this->sendsmsGET($mobileNumber, $senderId, $routeId, $message, $serverUrl, $authKey);
    }

    public function sendsmsGET($mobileNumber, $senderId, $routeId, $message, $serverUrl, $authKey)
    {
        $route = $routeId;
        $getData = 'mobileNos=' . $mobileNumber . '&message=' . urlencode($message) . '&senderId=' . $senderId . '&routeId=' . $routeId;

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

        Log::info($output);

        return $output;
    }

    public function sendSingleSms($params)
    {
        $mobileNumber = $params['to']; /*Separate mobile no with commas */
        $message = $params['message']; /* message */
        $senderId = "abcd"; /* Sender ID */
        $serverUrl = "msg.msgclub.net";
        $authKey = ""; /* Authentication key (get from sms service provider)*/
        $route = "1";
        $this->sendsmsGET($mobileNumber, $senderId, $route, $message, $serverUrl, $authKey);
    }

    public function sendEmail($params)
    {
        $to = $params['to'];
        $subject = $params['subject'];
        $message = $params['message'];
        $headers = "From: " . $params['from'] . "\r\n";
        $headers .= "Reply-To: " . $params['from'] . "\r\n";
        $headers .= "CC: " . $params['cc'] . "\r\n";
        $headers .= "BCC: " . $params['bcc'] . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; /* For HTML Email*/
        mail($to, $subject, $message, $headers);
    }

    public function sendWhatsapp($params)
    {
        $to = $params['to'];
        $message = $params['message'];
        $url = "https://api.whatsapp.com/send?phone=" . $to . "&text=" . $message;
        header("Location: $url");
    }

    public function sendTelegram($params)
    {
        $to = $params['to'];
        $message = $params['message'];
        $url = "https://api.telegram.org/bot" . $params['token'] . "/sendMessage?chat_id=" . $to . "&text=" . $message;
        header("Location: $url");
    }


    public function send($params)
    {
        $type = $params['type'];
        if ($type == 'sms') {
            $this->sendSingleSms($params);
        } else if ($type == 'email') {
            $this->sendEmail($params);
        } else if ($type == 'whatsapp') {
            $this->sendWhatsapp($params);
        } else if ($type == 'telegram') {
            $this->sendTelegram($params);
        }
    }

    public function sendBulk($params)
    {
        $type = $params['type'];
        if ($type == 'sms') {
            $this->sendMobileSms($params);
        } else if ($type == 'email') {
            $this->sendEmail($params);
        } else if ($type == 'whatsapp') {
            $this->sendWhatsapp($params);
        } else if ($type == 'telegram') {
            $this->sendTelegram($params);
        }
    }

    public function sendBulkSms(Request $request)
    {
        $params = $request->all();
        $this->sendBulk($params);
    }

    public function sendSms(Request $request)
    {
        $params = $request->all();
        $this->send($params);
    }

    public function sendEmails(Request $request)
    {
        $params = $request->all();
        $this->send($params);
    }

    public function sendWhatsapps(Request $request)
    {
        $params = $request->all();
        $this->send($params);
    }

    public function sendTelegrams(Request $request)
    {
        $params = $request->all();
        $this->send($params);
    }

    public function sendEmailsBulk(Request $request)
    {
        $params = $request->all();
        $this->sendBulk($params);
    }

    public function sendWhatsappsBulk(Request $request)
    {
        $params = $request->all();
        $this->sendBulk($params);
    }

    public function sendTelegramsBulk(Request $request)
    {
        $params = $request->all();
        $this->sendBulk($params);
    }

    public function sendBulkEmails(Request $request)
    {
        $params = $request->all();
        $this->sendBulk($params);
    }

    public function sendBulkWhatsapps(Request $request)
    {
        $params = $request->all();
        $this->sendBulk($params);
    }

    public function test()
    {
        $params = [
            'to' => '919999999999',
            'message' => 'Test message',
            'type' => 'sms'
        ];
        $this->send($params);
    }
}
