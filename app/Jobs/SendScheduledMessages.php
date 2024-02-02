<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

use App\Models\Message;
use App\Models\MessageTemplate;
use App\Models\audience as Audience;
use App\Models\Event;
use App\Mail\TempMail;
use Log;
use PgSql\Lob;

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
        $messages = Message::where('schedule_date', Carbon::now()->format('Y-m-d'))
            ->where('schedule_time', Carbon::now()->format('H:i'))
            ->get();

        foreach ($messages as $message) {
            $audiences = ($message->type == 'whatsapp' || $message->type == 'sms') ? $message->audience_numbers : $message->emails;
            Log::info('Messages scheduled for today: ' . count($audiences));

            foreach ($audiences as $key => $audience_identifier) {
                $audience = Audience::where($message->type == 'email' ? 'email' : 'phone', $audience_identifier)->first();
                $messageTemp = MessageTemplate::find($message->message_template_id);

                if (!$messageTemp) {
                    continue; // Skip iteration if message template not found
                }

                $originalMessage = $messageTemp->message;
                $message_type = $messageTemp->type;
                $cc = $messageTemp->cc;
                $bcc = $messageTemp->bcc;

                // if($message->type == 'whatsapp' && $message->type == 'whatsapp') {
                //     $originalMessage = str_replace(["\r\n", "\r", "\n"], '%0a', $originalMessage);
                // }

                if ($audience) {
                    // replace variables in message
                    $modifiedMessage = str_replace(["{name}", "{email}", "{phone}"], [$audience->name, $audience->email, $audience->phone], $originalMessage);
                } else {
                    $modifiedMessage = str_replace(["{name}", "{email}", "{phone}"], ["sir/mam", $audience_identifier, $audience_identifier], $originalMessage);
                }

                // send message
                if ($message_type == 'whatsapp' && $message->type == 'whatsapp') {
                    $result = sendWhatsAppMessage($audience_identifier, $modifiedMessage);

                    // update message status
                    $message->status = $result;
                    $message->save();
                    Log::info($result);
                } elseif ($message_type == 'sms' && $message->type == 'sms') {
                    $result = sendSms($audience_identifier, $modifiedMessage);

                    // update message status
                    $message->status = $result;
                    $message->save();
                    Log::info($result);
                } elseif ($message_type == 'email' && $message->type == 'email') {

                    $to = $audience_identifier;
                    $subject = $messageTemp->subject;
                    $temp_message = $modifiedMessage;
                    $cc = $messageTemp->cc ?? [];
                    $bcc = $messageTemp->bcc ?? [];
                    $attachmentPath = null;

                    // // Convert array to string for cc and bcc
                    // $cc = implode(',', $cc);
                    // $bcc = implode(',', $bcc);

                    $data = [
                        "email" => $audience_identifier,
                        "subject" => $subject,
                        "body" => $temp_message,
                        "cc" => $cc,
                        "bcc" => $bcc,
                        "attachmentPath" => $attachmentPath,
                    ];

                    // Use try-catch for error handling during email sending
                    try {
                        // $result = Mail::send('admin.mails.temp', $data, function ($message) use ($to, $subject, $cc, $bcc, $attachmentPath) {
                        //     $message->to($to)
                        //         ->subject($subject);

                        //     // // Add CC and BCC
                        //     // if (!empty($cc)) {
                        //     //     $message->cc($cc);
                        //     // }

                        //     // if (!empty($bcc)) {
                        //     //     $message->bcc($bcc);
                        //     // }

                        //     // // Add attachment if provided
                        //     // if ($attachmentPath) {
                        //     //     $message->attach($attachmentPath);
                        //     // }
                        // });


                        $data = [
                            "email" => $audience_identifier,
                            "subject" => $subject,
                            "body" => $temp_message,
                            "cc" => $cc,
                            "bcc" => $bcc,
                            "attachmentPath" => $attachmentPath,
                        ];
                        Mail::to($to)
                        ->cc($cc)
                        ->bcc($bcc)
                        ->send(new TempMail($data));

                        // update message status
                        $message->status = 'sent';
                        $message->save();

                        Log::info('Email sent successfully.');
                    } catch (\Exception $e) {
                        Log::error('Error sending email: ' . $e->getMessage());
                    }
                }
            }
        }
    }
}
