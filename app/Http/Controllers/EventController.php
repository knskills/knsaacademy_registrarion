<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $event = Event::query();

            if ($request->has('search')) {
                $searchTerm = $request->search;
                $event->where('name', 'like', '%' . $searchTerm . '%');
            } elseif ($request->has('event')) {
                $event = $request->event;
                $event->where('event_name', $event);
            } else {
                $event->orderBy('id', 'desc');
            }

            $events = $event->paginate(10);
            $events->appends($request->except('page'));

            // audinace by new to old
            return view('admin.events.index', compact('events'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.events.create');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $valitor = Validator::make($request->all(), [
                'event_name' => 'required',
                'youtube_link' => 'required',
                'button_text' => 'required',
                'price' => 'required',
                'payment_link' => 'required',
                'is_active' => 'required',
                'whatsapp_link' => 'required',
            ]);

            if ($valitor->fails()) {
                return redirect()->back()->withErrors($valitor)->withInput();
            }

            $event = new Event();
            $event->event_name = $request->event_name;
            $event->youtube_link = $request->youtube_link;
            $event->button_text = $request->button_text;
            $event->price = $request->price;
            $event->payment_link = $request->payment_link;
            $event->whatsapp_link = $request->whatsapp_link;
            $event->event_date = $request->event_date;
            $event->event_time = $request->event_time;
            $event->event_link = $request->event_link;
            $event->event_description = $request->event_description;
            $event->is_active = $request->is_active == 'on' ? 1 : 0;
            $event->event_image = $request->event_image;
            $event->save();

            return redirect()->route('events.index')->with('success', 'Event created successfully');

            // redirect https://rzp.io/l/lhX0k3r0m8

            // return redirect()->away('https://rzp.io/l/lhX0k3r0m8');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        try {
            $event->delete();
            return redirect()->back()->with('success', 'Event deleted successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
