<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\WhatsappMessage;
use App\Events\MessageReceived;

class WebhookController extends Controller
{
    const VERIFY_TOKEN = 'LaravelToken';

    public function setupWebhook(Request $request)
    {
        // Log::info('call webhook setup');

        if ($request->isMethod('get')) {
            return $this->handleGetRequest($request);
        } elseif ($request->isMethod('post')) {
            return $this->handlePostRequest($request);
        } else {
            return response()->json(['error' => 'Invalid request method'], 405);
        }
    }

    private function handleGetRequest(Request $request)
    {
        $hubVerifyToken = $request->query('hub_verify_token');

        if ($hubVerifyToken !== self::VERIFY_TOKEN) {
            return response()->json(['error' => 'VerifyToken doesnt match'], 403);
        }

        return response($request->query('hub_challenge'));
    }

    private function handlePostRequest(Request $request)
    {
        $data = $request->all();
        Log::info($data);
        $recipient_id = $this->processWebhookData($data);

        // Log::info('Recipient ID: ' . $recipient_id);

        if ($recipient_id) {
            return redirect()->route('whatsapp.chat.index', ['recipient_id' => $recipient_id]);
        }

        return response()->json(['status' => 'Message received'], 200);
    }

    private function processWebhookData(array $data)
    {
        if (isset($data['entry'][0]['changes'][0]['value']['statuses'])) {
            return $this->handleStatuses($data['entry'][0]['changes'][0]['value']['statuses'], $data);
        } elseif (isset($data['entry'][0]['changes'][0]['value']['messages'])) {
            return $this->handleMessages($data['entry'][0]['changes'][0]['value']['messages'], $data);
        }
        return null;
    }

    private function handleStatuses(array $statuses, array $data)
    {
        foreach ($statuses as $status) {
            WhatsappMessage::updateOrCreate(
                ['message_id' => $status['id']],
                [
                    'template_name' => $status['conversation']['origin']['type'] ?? null,
                    'template_type' => $status['conversation']['origin']['type'] ?? null,
                    'type' => 'send',
                    'status' => $status['status'],
                    'phone_number' => $data['entry'][0]['changes'][0]['value']['metadata']['display_phone_number'],
                    'from' => $data['entry'][0]['changes'][0]['value']['metadata']['phone_number_id'],
                    'recipient_id' => $status['recipient_id'],
                    'send_at' => isset($status['timestamp']) ? date('Y-m-d H:i:s', $status['timestamp']) : null,
                ]
            );
        }

        return end($statuses)['recipient_id'];
    }

    private function handleMessages(array $messages, array $data)
    {
        foreach ($messages as $message) {
            WhatsappMessage::create([
                'message_id' => $message['id'] ?? null,
                'whatsapp_message' => $message['text']['body'] ?? null,
                'reply' => $message,
                'profile_name' => $data['entry'][0]['changes'][0]['value']['contacts'][0]['profile']['name'] ?? null,
                'type' => 'reply',
                'reply_at' => isset($message['timestamp']) ? date('Y-m-d H:i:s', $message['timestamp']) : null,
                'status' => 'received',
                'phone_number' => $data['entry'][0]['changes'][0]['value']['metadata']['display_phone_number'] ?? null,
                'recipient_id' => $message['from'] ?? null,
                'from' => $message['from'] ?? null,
            ]);
        }

        // // Broadcast the event with the new message data
        // broadcast(new MessageReceived($data));

        return end($messages)['from'];
    }
}
