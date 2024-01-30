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
        // $audience_ids = $request->audience_ids;
        // $audience = Audience::find($audience_ids);
        // $message->audience()->attach($audience);

        return redirect()->route('messages.index')->with('success', 'Message created successfully');
    }

    public function show($id)
    {
        $message = Message::with('messageTemplate', 'event')->findOrFail($id);
        return view('admin.messages.show', compact('message'));
    }

    public function edit($id)
    {
        $message = Message::findOrFail($id);
        $templates = MessageTemplate::all();
        $events = Event::all();
        return view('admin.messages.edit', compact('message', 'templates', 'events'));
    }


    public function update(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        $message->update($request->all());
        return redirect()->route('messages.index')->with('success', 'Message updated successfully');
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        return redirect()->route('messages.index')->with('success', 'Message deleted successfully');
    }
}
