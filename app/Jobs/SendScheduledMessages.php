<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

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
            $audience_numbers = $message->audience_numbers;
            Log::info('Messages sheduled for today: ' . count($audience_numbers));

            foreach ($audience_numbers as $key => $audience_number) {
                $audience = Audience::where('phone', $audience_number)->first();
                $messageTemp = MessageTemplate::where('id', $message->message_template_id)->first();
                $originalMessage = $messageTemp->message;
                $message_type = $messageTemp->type;


                if ($audience) {
                    // replace variables in message
                    $modifiedMessage = str_replace("{name}", $audience->name, $originalMessage);
                    // $modifiedMessage = str_replace("{email}", $audience->email, $modifiedMessage);
                    $modifiedMessage = str_replace("{email}", $audience->phone, $modifiedMessage);
                    $modifiedMessage = str_replace("{phone}", $audience->phone, $modifiedMessage);
                } else {
                    $modifiedMessage = str_replace("{name}", "sir/mam", $originalMessage);
                    $modifiedMessage = str_replace("{email}", $audience_number, $modifiedMessage);
                    $modifiedMessage = str_replace("{phone}", $audience_number, $modifiedMessage);
                }

                Log::info($modifiedMessage);

                // send message
                if ($message_type == 'whatsapp') {
                    $result = sendWhatsAppMessage($audience_number, $modifiedMessage);
                    Log::info($result);
                } elseif ($message_type == 'sms') {
                    $result = sendSms($audience_number, $modifiedMessage);
                    Log::info($result);
                }
            }
        }
    }
}
