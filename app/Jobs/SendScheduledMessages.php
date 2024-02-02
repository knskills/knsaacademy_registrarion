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
            Log::info($audiences);
            Log::info('Messages scheduled for today: ' . count($audiences));

            foreach ($audiences as $key => $audience_identifier) {
                Log::info('Sending message to: ' . $audience_identifier);

                $audience = Audience::where($message->type == 'email' ? 'email' : 'phone', $audience_identifier)->first();
                $messageTemp = MessageTemplate::find($message->message_template_id);

                if (!$messageTemp) {
                    continue; // Skip iteration if message template not found
                }

                $originalMessage = $messageTemp->message;
                $message_type = $messageTemp->type;

                if ($audience) {
                    // replace variables in message
                    $modifiedMessage = str_replace(["{name}", "{email}", "{phone}"], [$audience->name, $audience->email, $audience->phone], $originalMessage);
                } else {
                    $modifiedMessage = str_replace(["{name}", "{email}", "{phone}"], ["sir/mam", $audience_identifier, $audience_identifier], $originalMessage);
                }

                // send message
                if ($message_type == 'whatsapp' && $message->type == 'whatsapp') {
                    $result = sendWhatsAppMessage($audience_identifier, $modifiedMessage);
                    Log::info($result);
                } elseif ($message_type == 'sms' && $message->type == 'sms') {
                    $result = sendSms($audience_identifier, $modifiedMessage);
                    Log::info($result);
                } elseif ($message_type == 'email' && $message->type == 'email') {
                    // $result = sendEmail($audience_identifier, $messageTemp->subject, $modifiedMessage, $messageTemp->cc, $messageTemp->bcc);
                    // Log::info($result);

                    $to = $audience_identifier;
                    $subject = $messageTemp->subject;
                    $temp_message = $modifiedMessage;
                    $cc = $messageTemp->cc;
                    $bcc = $messageTemp->bcc;
                    $attachmentPath = null;

                    // convert array to string for cc and bcc
                    if ($cc) {
                        $cc = implode(',', $cc);
                    }

                    if ($bcc) {
                        $bcc = implode(',', $bcc);
                    }

                    // Log::info('Sending email to: ' . $to);
                    // Log::info('Sending email subject: ' . $subject);
                    // Log::info('Sending email message: ' . $temp_message);
                    // Log::info('Sending email cc: ' . $cc);
                    // Log::info('Sending email bcc: ' . $bcc);
                    // Log::info('Sending email attachmentPath: ' . $attachmentPath);



                    // $result = Mail::send('web.res', ['message' => $temp_message], function ($message) use ($audience_identifier, $subject, $cc, $bcc, $attachmentPath) {
                    //     $message->to($audience_identifier)
                    //         ->subject($subject);

                    //     // // Add CC and BCC
                    //     // if ($cc) {
                    //     //     $message->cc($cc);
                    //     // }

                    //     // if ($bcc) {
                    //     //     $message->bcc($bcc);
                    //     // }

                    //     // // Add attachment if provided
                    //     // if ($attachmentPath) {
                    //     //     $message->attach($attachmentPath);
                    //     // }
                    // });

                    // $result = Mail::raw($temp_message, function ($message) {
                    //     $message->to('test@test.com')
                    //         ->subject('This is a test email');
                    // });



                    $data = [
                        "email" => $audience_identifier,
                        "subject" => $subject,
                        "message" => $temp_message,
                        "cc" => $cc,
                        "bcc" => $bcc,
                        "attachmentPath" => $attachmentPath,
                    ];

                    Log::info('Sending email to: ' . $to);
                    Log::info('Sending email subject: ' . $subject);
                    Log::info('Sending email message: ' . $temp_message);
                    Log::info('Sending email cc: ' . $cc);
                    Log::info('Sending email bcc: ' . $bcc);
                    Log::info('Sending email attachmentPath: ' . $attachmentPath);

                    $result = Mail::send('admin.mails.temp', ['message' => $temp_message], function ($message) use ($audience_identifier, $subject, $cc, $bcc, $attachmentPath) {
                        $message->to($audience_identifier)
                            ->subject($subject);

                        // // Add CC and BCC
                        // if ($cc) {
                        //     $message->cc($cc);
                        // }

                        // if ($bcc) {
                        //     $message->bcc($bcc);
                        // }

                        // // Add attachment if provided
                        // if ($attachmentPath) {
                        //     $message->attach($attachmentPath);
                        // }
                    });
                }
            }
        }
    }
}
