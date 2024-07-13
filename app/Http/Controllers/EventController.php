<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventContent;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
            $events = Event::all();
            return view('admin.events.create', compact('events'));
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
        // Log::info($request->all());

        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'youtube_link' => 'nullable',
            'price' => 'required',
            'payment_link' => 'nullable',
            'is_active' => 'nullable',
            'whatsapp_link' => 'nullable',
        ]);

        if ($validator->fails()) {
            Log::error($validator->errors());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $slug = Str::slug($request->event_name, '_');

            $eventData = $request->only([
                'event_name', 'youtube_link', 'button_text', 'price', 'payment_link',
                'whatsapp_link', 'event_date', 'event_start_time', 'event_end_time',
                'event_link', 'event_description', 'is_active', 'event_image',
                'event_type', 'event_language', 'event_duration', 'timer_time',
                'original_price'
            ]);
            $eventData['slug'] = $slug;

            $event = Event::create($eventData);

            $contanor1_col1_contant = $this->handleContent($request->contanor1_col1_contant, $request->contanor1_col1_contant_type);

            $eventContentData = [
                'event_id' => $event->id,
                'title' => $request->title,
                'contanor1_heading' => $request->contanor1_heading,
                'contanor1_sub_heading' => $request->contanor1_sub_heading,
                'contanor1_col1_contant_type' => $request->contanor1_col1_contant_type,
                'contanor1_col1_contant' => $contanor1_col1_contant,
                'contanor2_heading' => $request->contanor2_heading,
                'contanor2_sub_heading' => $request->contanor2_sub_heading,
                'contanor2_data' => $request->contanor2_data,
                'contanor3_heading' => $request->contanor3_heading,
                'contanor3_sub_heading' => $request->contanor3_sub_heading,
                'contanor3_data' => $this->handleMultipleContent($request->contanor3_data),
                'contanor4_heading' => $request->contanor4_heading,
                'contanor4_sub_heading' => $request->contanor4_sub_heading,
                'contanor4_data' => $request->contanor4_data,
                'contanor5_heading' => $request->contanor5_heading,
                'contanor5_sub_heading' => $request->contanor5_sub_heading,
                'contanor5_data' => $request->contanor5_data,
                'contanor6_heading' => $request->contanor6_heading,
                'contanor6_sub_heading' => $request->contanor6_sub_heading,
                'contanor6_data' => $this->handleMultipleContent($request->contanor6_data),
                'trainer_heading' => $request->trainer_heading,
                'trainer_sub_heading' => $request->trainer_sub_heading,
                'trainer_data' => $request->trainer_data,
                'bonus_heading' => $request->bonus_heading,
                'bonus_sub_heading' => $request->bonus_sub_heading,
                'bonus_price' => $request->bonus_price,
                'bonus_data' => $this->handleMultipleContent($request->bonus_data),
                'learn_heading' => $request->learn_heading,
                'learn_sub_heading' => $request->learn_sub_heading,
                'learn_data' => $request->learn_data,
                'achivers_heading' => $request->achivers_heading,
                'achivers_sub_heading' => $request->achivers_sub_heading,
                'achivers_paragraph' => $request->achivers_paragraph,
                'achivers_data' => $request->achivers_data,
                'review_heading' => $request->review_heading,
                'review_sub_heading' => $request->review_sub_heading,
                'review_paragraph' => $request->review_paragraph,
                'review_data' => $request->review_data,
            ];

            EventContent::create($eventContentData);

            return redirect()->route('ad-events.index')->with('success', 'Event created successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    private function handleContent($content, $type)
    {
        if ($type === 'image') {
            return uploadFile($content, 'events/files/');
        }
        return $content;
    }

    private function handleMultipleContent($content)
    {
        if (empty($content) || count($content) <= 0) {
            return null;
        }

        $processedContent = [];
        foreach ($content as $data) {
            $image = uploadFile($data, 'events/files/');
            array_push($processedContent, $image);
        }
        return $processedContent;
    }


    /**
     * Display the specified resource.
     */
    public function show($event_name)
    {
        // Log::info($event_name);
        $event = Event::with('eventContent')->where('event_name', $event_name)->first();
        // LOg::info($event);
        return view('admin.events.show', compact('event'));
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

            return redirect()->route('ad-events.index')->with('success', 'Event updated successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $event = Event::find($id);
            $event->delete();
            return redirect()->back()->with('success', 'Event deleted successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    //============================================================================================//
    //=====================================Custom methods=========================================//
    //============================================================================================//

    /**
     * get events acording to event type
     */
    public function getEvents(Request $request)
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

            $events = $event->get();

            return response()->json([
                'success' => true,
                'events' => $events,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
