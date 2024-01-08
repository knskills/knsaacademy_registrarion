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

            // audience by new to old
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
            $validator = Validator::make($request->all(), [
                'event_name' => 'required',
                'youtube_link' => 'nullable',
                'price' => 'nullable',
                'payment_link' => 'nullable',
                'is_active' => 'nullable',
                'whatsapp_link' => 'nullable',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                Log::error($validator->errors());
            }

            // $event = new Event();
            // $event->event_name = $request->event_name;
            // $event->youtube_link = $request->youtube_link;
            // $event->button_text = $request->button_text;
            // $event->price = $request->price;
            // $event->payment_link = $request->payment_link;
            // $event->whatsapp_link = $request->whatsapp_link;
            // $event->event_date = $request->event_date;
            // $event->event_time = $request->event_time;
            // $event->event_link = $request->event_link;
            // $event->event_description = $request->event_description;
            // $event->is_active = $request->is_active == 'on' ? 1 : 0;
            // $event->event_image = $request->event_image;
            // $event->save();

            $event = Event::create([
                'event_name' => $request->event_name,
                'youtube_link' => $request->youtube_link,
                'button_text' => $request->button_text,
                'price' => $request->price,
                'payment_link' => $request->payment_link,
                'whatsapp_link' => $request->whatsapp_link,
                'event_date' => $request->event_date,
                'event_start_time' => $request->event_start_time,
                'event_end_time' => $request->event_end_time,
                'event_link' => $request->event_link,
                'event_description' => $request->event_description,
                'is_active' => $request->is_active == 'on' ? 1 : 0,
                'event_image' => $request->event_image,
                'event_type' => $request->event_type,
                'event_language' => $request->event_language,
                'event_duration' => $request->event_duration,
                'timer_time' => $request->timer_time,
                'original_price' => $request->original_price,
                'slug' => $request->event_name,
            ]);

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
    public function edit($id)
    {
        try {
            $event = Event::find($id);
            return view('admin.events.edit', compact('event'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'event_name' => 'required',
                'youtube_link' => 'nullable',
                'price' => 'nullable',
                'payment_link' => 'nullable',
                'is_active' => 'nullable',
                'whatsapp_link' => 'nullable',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
                Log::error($validator->errors());
            }

            $event = Event::find($id);

            $event->event_name = $request->event_name;
            $event->youtube_link = $request->youtube_link;
            $event->button_text = $request->button_text;
            $event->price = $request->price;
            $event->payment_link = $request->payment_link;
            $event->whatsapp_link = $request->whatsapp_link;
            $event->event_date = $request->event_date;
            $event->event_start_time = $request->event_start_time;
            $event->event_end_time = $request->event_end_time;
            $event->event_link = $request->event_link;
            $event->event_description = $request->event_description;
            $event->is_active = $request->is_active == 'on' ? 1 : 0;
            $event->event_image = $request->event_image;
            $event->event_type = $request->event_type;
            $event->event_language = $request->event_language;
            $event->event_duration = $request->event_duration;
            $event->timer_time = $request->timer_time;
            $event->original_price = $request->original_price;
            $event->slug = $request->event_name;
            $event->save();

            return redirect()->route('events.index')->with('success', 'Event updated successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
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
