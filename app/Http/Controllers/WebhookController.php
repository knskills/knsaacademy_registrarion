<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

use App\Models\WhatsappMessage;

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
            $attributes = [
                'message_id' => $message['id'] ?? null,
                'profile_name' => $data['entry'][0]['changes'][0]['value']['contacts'][0]['profile']['name'] ?? null,
                'type' => 'reply',
                'reply_at' => isset($message['timestamp']) ? Carbon::createFromTimestamp($message['timestamp']) : null,
                'status' => 'received',
                'phone_number' => $data['entry'][0]['changes'][0]['value']['metadata']['display_phone_number'] ?? null,
                'recipient_id' => $message['from'] ?? null,
                'from' => $message['from'] ?? null,
            ];

            if ($message['type'] === 'text') {
                $attributes['whatsapp_message'] = $message['text']['body'] ?? null;
            } elseif ($message['type'] === 'image') {
                $attributes['whatsapp_message'] = null; // Clear text message field for image type
                // $attributes['image_id'] = $message['image']['id'] ?? null;
                $attributes['image'] = $message['image']['id'] ?? null;

                // Determine file extension based on MIME type
                $mime = $message['image']['mime_type'] ?? 'image/jpeg'; // Default to 'image/jpeg' if MIME type is not set
                $extension = $this->getExtensionFromMimeType($mime);

                // Optional: Download and store the image locally
                $imageUrl = 'https://graph.facebook.com/v19.0/' . $message['image']['id'];
                $accessToken = env("FB_METADATA_TOKEN");
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $accessToken
                ])->get($imageUrl, [
                    'access_token' => $accessToken
                ]);

                if ($response->successful()) {
                    $imagePath = 'whatsapp/images/' . $message['image']['id'] . '.' . $extension;
                    Storage::put($imagePath, $response->body());
                    $attributes['image_path'] = Storage::url($imagePath);
                }
            }

            WhatsappMessage::create($attributes);
        }

        return end($messages)['from'];
    }

    /**
     * Get file extension from MIME type
     *
     * @param string $mime
     * @return string
     */
    private function getExtensionFromMimeType(string $mime): string
    {
        $mimeTypes = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/bmp' => 'bmp',
            'image/webp' => 'webp',
            // Add more MIME types and their extensions as needed
        ];

        return $mimeTypes[$mime] ?? 'jpg'; // Default to 'jpg' if MIME type is not found
    }
}
