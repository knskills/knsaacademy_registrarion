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

    // /**
    //  * Execute the job.
    //  */
    // public function handle(): void
    // {
    //     $messages = Message::where('schedule_date', Carbon::now()->format('Y-m-d'))->where('schedule_time', Carbon::now()->format('H:i'))->get();

    //     // Log::info('Messages sheduled for today: ' . count($messages));

    //     foreach ($messages as $message) {
    //         $audience_ids = $message->audience_ids;

    //         foreach ($audience_ids as $key => $audience_id) {
    //             $audience = Audience::where('id', $audience_id)->first();
    //             $messageTemp = MessageTemplate::where('id', $message->message_template_id)->first();
    //             $message = $messageTemp->message;
    //             $message_type = $messageTemp->type;

    //             // replace variables in message
    //             $message = str_replace("{name}", $audience->name, $message);
    //             $message = str_replace("{email}", $audience->email, $message);
    //             $message = str_replace("{phone}", $audience->phone, $message);
    //             // $message = str_replace("{event}", $audience->event->name, $message);
    //             // $message = str_replace("{date}", $audience->event->date, $message);
    //             // $message = str_replace("{time}", $audience->event->time, $message);

    //             // send message
    //             if ($message_type == 'whatsapp') {
    //                 $reasult = sendWhatsAppMessage($audience->phone, $message);
    //             } else {
    //                 $reasult = sendSms($audience->phone, $message);
    //             }
    //         }
    //     }
    // }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $messages = Message::where('schedule_date', Carbon::now()->format('Y-m-d'))
            ->where('schedule_time', Carbon::now()->format('H:i'))
            ->get();

        foreach ($messages as $message) {
            $audience_ids = $message->audience_ids;

            foreach ($audience_ids as $key => $audience_id) {
                $audience = Audience::where('id', $audience_id)->first();
                $messageTemp = MessageTemplate::where('id', $message->message_template_id)->first();
                $originalMessage = $messageTemp->message;
                $message_type = $messageTemp->type;

                // replace variables in message
                $modifiedMessage = str_replace("{name}", $audience->name, $originalMessage);
                $modifiedMessage = str_replace("{email}", $audience->email, $modifiedMessage);
                $modifiedMessage = str_replace("{phone}", $audience->phone, $modifiedMessage);

                // send message
                if ($message_type == 'whatsapp') {
                    $result = sendWhatsAppMessage($audience->phone, $modifiedMessage);
                } else {
                    $result = sendSms($audience->phone, $modifiedMessage);
                }
            }
        }
    }
}
