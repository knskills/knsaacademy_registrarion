<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

use App\Models\Message;
use App\Models\MessageTemplate;
use App\Models\audience as Audience;
use App\Models\WhatsappMessage;
use App\Models\WhatsappChatContact;
// use App\Models\Event;
use App\Mail\TempMail;
use Log;
// use PgSql\Lob;
use App\Models\WhtasappTemplate;

class SendScheduledMessages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $messages = $this->getScheduledMessages();

        foreach ($messages as $message) {
            $audiences = $this->getAudiences($message);
            // Log::info('Messages scheduled for today: ' . count($audiences));

            foreach ($audiences as $audienceIdentifier) {
                $audience = $this->getAudience($message->type, $audienceIdentifier);
                $messageTemplate = $this->getMessageTemplate($message->message_template_id);

                if (!$messageTemplate) {
                    continue;
                }

                $modifiedMessage = $this->getModifiedMessage($messageTemplate, $audience, $audienceIdentifier);

                $this->sendMessage($message, $messageTemplate, $audience, $audienceIdentifier, $modifiedMessage);
            }
        }
    }

    private function getScheduledMessages()
    {
        return Message::where('schedule_date', Carbon::now()->format('Y-m-d'))
            ->where('schedule_time', Carbon::now()->format('H:i'))
            ->get();
    }

    private function getAudiences($message)
    {
        return ($message->type == 'whatsapp' || $message->type == 'sms') ? $message->audience_numbers : $message->emails;
    }

    private function getAudience($type, $identifier)
    {
        return Audience::where($type == 'email' ? 'email' : 'phone', $identifier)->first();
    }

    private function getMessageTemplate($templateId)
    {
        return MessageTemplate::find($templateId);
    }

    private function getModifiedMessage($template, $audience, $identifier)
    {
        $placeholders = ['{name}', '{email}', '{phone}'];
        $replacements = $audience ? [$audience->name, $audience->email, $audience->phone] : ['sir/mam', $identifier, $identifier];

        return str_replace($placeholders, $replacements, $template->message);
    }

    private function sendMessage($message, $template, $identifier, $modifiedMessage, $audience)
    {
        switch ($message->type) {
            case 'whatsapp':
                if ($template->type == 'whatsapp') {
                    $this->sendWhatsAppMessage($message, $template, $identifier, $modifiedMessage, $audience);
                }
                break;
            case 'sms':
                if ($template->type == 'sms') {
                    $this->sendSmsMessage($message, $identifier, $modifiedMessage);
                }
                break;
            case 'email':
                if ($template->type == 'email') {
                    $this->sendEmailMessage($message, $template, $identifier, $modifiedMessage);
                }
                break;
        }
    }

    private function sendWhatsAppMessage($shedule, $template, $audience, $phone, $modifiedMessage)
    {
        // $this->sendTmpMessage($template->id, $phone);
        $temp_img = $template->media_file;

        $template = WhtasappTemplate::find($template->template_id);
        $replacements = [$audience->name ?? null, $audience->email ?? null, $audience->phone ?? null];
        $result = sendTempMessage($template, $phone, $replacements);

        if (isset($result['messages'])) {
            $messages = $result['messages'];

            foreach ($messages as $message) {
                $recipient_id = $result['contacts'][0]['wa_id'];
                $profile_name = $result['contacts'][0]['profile']['name'] ?? null;

                $contact_id = createContact($recipient_id, $profile_name);

                // Fetch the existing message if it exists
                $existingMessage = WhatsappMessage::where('recipient_id', $result['contacts'][0]['wa_id'])->whereNotNull('profile_name')->first();

                // Prepare the attributes for update or create
                $attributes = [
                    'contact_id' => $contact_id,
                    'whatsapp_message' => $modifiedMessage ?? 'Image Message',
                    'template_name' => null,
                    'template_type' => null,
                    'type' => 'send',
                    'status' => 'sent',
                    'image' => $temp_img ?? null,
                    'phone_number' => $result['contacts'][0]['wa_id'],
                    'from' => null,
                    'recipient_id' => $result['contacts'][0]['wa_id'],
                    'send_at' => null,
                ];

                // If the message exists, add the profile name
                if ($existingMessage) {
                    $attributes['profile_name'] = $existingMessage->profile_name;
                }

                // Update or create the record
                $message = WhatsappMessage::updateOrCreate(
                    ['message_id' => $message['id']],
                    $attributes
                );
            }
        }
    }

    private function sendSmsMessage($message, $phone, $modifiedMessage)
    {
        $result = sendSms($phone, $modifiedMessage);

        $this->updateMessageStatus($message, $result);
    }

    private function sendEmailMessage($message, $template, $to, $body)
    {
        // $toEmail = 'rohit@example.com';
        // $subject = 'Test Email';
        // $body = 'This is a test email sent from Laravel using the Mail class.';

        // Mail::raw($body, function ($message) use ($toEmail, $subject) {
        //     $message->to($toEmail)
        //             ->subject($subject);
        // });

        $subject = $template->subject;
        $cc = array_filter($template->cc) ?? [];
        $bcc = array_filter($template->bcc) ?? [];
        $attachmentPath = $template->media_file;

        $data = [
            "email" => $to,
            "subject" => $subject,
            "body" => $body,
            "cc" => $cc,
            "bcc" => $bcc,
            "attachmentPath" => $attachmentPath,
        ];

        try {
            $mail = Mail::to($to);
            if (!empty($cc)) $mail->cc($cc);
            if (!empty($bcc)) $mail->bcc($bcc);
            $mail->send(new TempMail($data));

            $this->updateMessageStatus($message, 'sent');
        } catch (\Exception $e) {
            $this->updateMessageStatus($message, 'failed');
            Log::error('Error sending email: ' . $e->getMessage());
        }
    }

    private function updateMessageStatus($message, $status)
    {
        $message->status = $status;
        $message->save();
    }

    function sendTmpMessage($templateId = null, $phone = null)
    {
        $template = MessageTemplate::find($templateId);
    }

    private function updateOrCreateWhatsAppMessages($data, $template)
    {
        foreach ($data['messages'] as $message) {
            $recipientId = $data['contacts'][0]['wa_id'];
            $existingMessage = WhatsappMessage::where('recipient_id', $recipientId)->whereNotNull('profile_name')->first();

            $attributes = [
                'whatsapp_message' => $template->message,
                'template_id' => $template->id,
                'type' => 'send',
                'status' => null,
                'phone_number' => $recipientId,
                'recipient_id' => $recipientId,
            ];

            if ($existingMessage) {
                $attributes['profile_name'] = $existingMessage->profile_name;
            }

            WhatsappMessage::updateOrCreate(
                ['message_id' => $message['id']],
                $attributes
            );
        }
    }
}
