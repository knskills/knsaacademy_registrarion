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
                $reasult = sendWhatsAppMessage($audience->phone, $message);
            } else {
                $reasult = sendSms($audience->phone, $message);
            }
        }
        return redirect()->route('messages.index')->with('success', 'Message created successfully');
    }


}
