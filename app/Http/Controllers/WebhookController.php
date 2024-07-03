<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;

use App\Models\WhatsappMessage;
use App\Models\WhatsappChatContact;
use App\Events\MessageReceived;
use App\Models\AutoReplyOption;

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
        // Log::info($data);
        Log::info(json_encode($data));
        $recipient_id = $this->processWebhookData($data);

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
            $recipient_id = $status['recipient_id'];
            $profile_name = null;

            $contact_id = createContact($recipient_id, $profile_name);

            $whatsappMessage = WhatsappMessage::updateOrCreate(
                ['message_id' => $status['id']],
                [
                    'contact_id' => $contact_id ?? null,
                    'template_name' => $status['conversation']['origin']['type'] ?? null,
                    'template_type' => $status['conversation']['origin']['type'] ?? null,
                    'type' => 'send',
                    'status' => $status['status'],
                    'phone_number' => $data['entry'][0]['changes'][0]['value']['metadata']['display_phone_number'],
                    'from' => $data['entry'][0]['changes'][0]['value']['metadata']['phone_number_id'],
                    'recipient_id' => $recipient_id,
                    'send_at' => isset($status['timestamp']) ? date('Y-m-d H:i:s', $status['timestamp']) : null,
                ]
            );

            $isStatusUpdate = $whatsappMessage->wasRecentlyCreated ? false : true;
            // Log::info($isStatusUpdate);
            broadcast(new MessageReceived($whatsappMessage, $isStatusUpdate))->toOthers();
            // broadcast(new MessageReceived($whatsappMessage))->toOthers();
        }

        return end($statuses)['recipient_id'];
    }

    private function handleMessages(array $messages, array $data)
    {
        foreach ($messages as $message) {
            $recipient_id = $message['from'];
            $profile_name = $data['entry'][0]['changes'][0]['value']['contacts'][0]['profile']['name'] ?? null;

            $contact_id = createContact($recipient_id, $profile_name);

            $attributes = [
                'contact_id' => $contact_id ?? null,
                'message_id' => $message['id'] ?? null,
                'profile_name' => $profile_name ?? null,
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
                $img_attributes = $this->getImage($message);
                $attributes = array_merge($img_attributes, $attributes);
            }

            $whatsappMessage = WhatsappMessage::create($attributes);
            $this->handleAutoReply($whatsappMessage);
            // broadcast(new MessageReceived($whatsappMessage))->toOthers();
        }

        return end($messages)['from'];
    }

    private function getImage($message = null)
    {
        $attributes['whatsapp_message'] = $message['image']['caption'] ?? null;

        $mime = $message['image']['mime_type'] ?? 'image/jpeg';
        $extension = $this->getExtensionFromMimeType($mime);

        $imageId = $message['image']['id'];

        $whatsappCloudApi = new WhatsAppCloudApi([
            'from_phone_number_id' => env('FB_PHONE_NUMBER'),
            'access_token' => env('FB_METADATA_TOKEN'),
        ]);

        try {
            $mediaResponse = $whatsappCloudApi->downloadMedia($imageId);
            $imageContent = $mediaResponse->body();

            $imagePath = 'whatsapp/images/' . $imageId . '.' . $extension;

            Storage::disk('public')->put($imagePath, $imageContent);

            $storedImageUrl = Storage::disk('public')->url($imagePath);

            $imageName = '/storage/whatsapp/images/' . $imageId . '.' . $extension;

            $attributes['image'] = $imageName;

            return $attributes;
        } catch (\Exception $e) {
            Log::error("Failed to download or store image: " . $e->getMessage());
        }
    }

    private function getExtensionFromMimeType(string $mime): string
    {
        $mimeTypes = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/bmp' => 'bmp',
            'image/webp' => 'webp',
        ];

        return $mimeTypes[$mime] ?? 'jpg';
    }

    // public function createContact($phone_number, $profile_name)
    // {
    //     $contact = WhatsappChatContact::updateOrCreate(
    //         ['number' => $phone_number],
    //         ['name' => $profile_name]
    //     );
    //     return $contact->id;
    // }

    // public function createContact($phone_number, $profile_name)
    // {
    //     $contact = WhatsappChatContact::where('number', $phone_number)->first();
    //     if (!$contact) {
    //         $contact = WhatsappChatContact::create([
    //             'name' => $profile_name,
    //             'number' => $phone_number,
    //         ]);
    //     }
    //     return $contact->id;
    // }

    private function handleAutoReply($whatsappMessage)
    {
        $autoReplyOption = AutoReplyOption::where('keyword', $whatsappMessage->whatsapp_message)->first();

        if (!$autoReplyOption || !$autoReplyOption->reply) {
            // throw new \Exception('No auto-reply found for the given keyword.');
            return;
        }

        $reply = $autoReplyOption->reply;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . getenv("FB_METADATA_TOKEN"),
            'Content-Type' => 'application/json',
        ])->post('https://graph.facebook.com/' . getenv("FB_API_VERSION") . '/' . getenv("FB_PHONE_NUMBER") . '/messages', [
            'messaging_product' => 'whatsapp',
            "recipient_type" => "individual",
            'to' => $whatsappMessage->recipient_id,
            'type' => 'text',
            'text' => [
                'preview_url' => false,
                'body' => $reply,
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        if (isset($data['contacts'][0]['wa_id'])) {
            $recipientId = $data['contacts'][0]['wa_id'];
            $contactId = createContact($recipientId, $profile_name = null);

            if (isset($data['messages'])) {
                foreach ($data['messages'] as $messageData) {
                    $existingMessage = WhatsappMessage::where('recipient_id', $recipientId)->whereNotNull('profile_name')->first();

                    $attributes = [
                        'contact_id' => $contactId,
                        'whatsapp_message' => $reply ?? null,
                        'template_name' => null,
                        'template_type' => null,
                        'type' => 'send',
                        'status' => null,
                        // 'image' => $request->hasFile('media_image') ? $imagePath : null,
                        'phone_number' => $recipientId,
                        'from' => null,
                        'recipient_id' => $recipientId,
                        'send_at' => null,
                        'profile_name' => $existingMessage->profile_name ?? null,
                    ];

                    $message = WhatsappMessage::updateOrCreate(
                        ['message_id' => $messageData['id']],
                        $attributes
                    );

                    // broadcast(new MessageReceived($message))->toOthers();
                }
            }
        }
    }
}
