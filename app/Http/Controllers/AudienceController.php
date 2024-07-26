<?php

namespace App\Http\Controllers;

use App\Models\audience;
use App\Exports\AudienceExport;
use App\Imports\AudienceImport;
use App\Models\Event;
use App\Models\MessageTemplate;
use App\Models\WhtasappTemplate;
use App\Models\WhatsappChatContact;
use App\Models\WhatsappMessage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

class AudienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $audianceQuery = audience::query();
            $events = Event::all();

            // if ($request->has('search')) {
            //     $searchTerm = $request->search;
            //     $audianceQuery->where('name', 'like', '%' . $searchTerm . '%');
            // } elseif ($request->has('event')) {
            //     $event = $request->event;
            //     $audianceQuery->where('event_name', $event);
            // } else {
            //     $audianceQuery->orderBy('id', 'desc');
            // }

            $audianceQuery->with('payment')
                // ->where('event_name', 'Learn Marketing S2')
                ->orderBy('id', 'desc');
            // ->orWhere('event_name', 'Learn Marketing')
            // Log::info($audianceQuery->get());

            $audiences = $audianceQuery->paginate(10);

            $audiences->appends($request->except('page'));

            // audinace by new to old
            return view('admin.audiance.index', compact('audiences', 'events'));
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Log::info($request->all());
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|max:255',
                'phone' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()->all()
                ]);
            }

            $audience = Audience::where('email', $request->email)
                ->where('phone', $request->phone)
                ->where('event_name', $request->event_name)
                ->first();
            $event = Event::where('event_name', $request->event_name)->first();

            if (!$audience) {
                $audience = new Audience([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'event_type' => $event->event_type,
                    'event_name' => $event->event_name,
                    'registration_date' => now(),
                    'payment_status' => 'pending',
                ]);
                $audience->save();

                $template = WhtasappTemplate::where('name', $event->whstp_temp_name)->first();
                $modifiedMessage = MessageTemplate::where('name', $event->whstp_temp_name)->first()->message;

                if ($template) {
                    $result = sendTempMessage($template, $request->phone);
                    $this->handleWhatsappMessages($result, $modifiedMessage);
                }
            } elseif ($audience->payment_status == 'paid') {
                return back()->with('error', 'You are already registered for this event');
            } else {
                return redirect()->route('razorpay.index', [
                    'audience_id' => $audience->id,
                    'event_id' => $event->id,
                ]);
            }

            if ($request->email) {
                Mail::send('web.resMail', ['name' => $request->name], function ($message) use ($request) {
                    $message->to($request->email)
                        ->subject('Audience Registration');
                });
            }

            return redirect()->route('razorpay.index', [
                'audience_id' => $audience->id,
                'event_id' => $event->id,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(audience $audience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(audience $audience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, audience $audience)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(audience $audience)
    {
        try {
            $audience->delete();
            return redirect()->back()->with('success', 'Audience deleted successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    //===========================================================================================//
    //=================================== Import & Export =======================================//
    /**
     * Export audience data
     * Refrence - https://docs.laravel-excel.com/3.1/getting-started/
     */
    public function export(Request $request)
    {
        try {
            // return Excel::download(new AudienceExport, 'audience.xlsx');

            // return Excel::download(new AudienceExport($event), 'audience_' . date('d-m-Y_H-i-s') . '.xlsx');

            $event = $request->event_name;
            $filetype = $request->file_type;
            $filename = 'audience_' . date('d-m-Y_H-i-s') . '.' . $filetype;
            return Excel::download(new AudienceExport($event), $filename);

            // if ($filetype == 'csv') {
            //     return Excel::download(new AudienceExport($event), $filename);
            // } elseif ($filetype == 'xlsx') {
            //     return Excel::download(new AudienceExport($event), $filename);
            // } elseif ($filetype == 'xls') {
            //     return Excel::download(new AudienceExport($event), $filename);
            // }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Import audience data
     */
    public function import(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:xls,xlsx'
            ]);

            Excel::import(new AudienceImport, $request->file('file'));

            return redirect()->back()->with('success', 'Audience imported successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
    //===========================================================================================//
    //===========================================================================================//

    /**
     * get audiance acording to event id
     */
    public function getAudiance(Request $request)
    {
        try {
            $event = Event::where('id', $request->event_id)->first()->event_name;
            $audiences = Audience::where('event_name', $event)->get();

            return response()->json([
                'success' => true,
                'audiences' => $audiences,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Handle Whatsapp Messages
     */
    private function handleWhatsappMessages($result, $modifiedMessage)
    {
        if (isset($result['messages'])) {
            $messages = $result['messages'];

            foreach ($messages as $message) {
                $contact = WhatsappChatContact::updateOrCreate(
                    ['number' => $result['contacts'][0]['wa_id']],
                    ['name' => null]
                );

                $existingMessage = WhatsappMessage::where('recipient_id', $result['contacts'][0]['wa_id'])
                    ->whereNotNull('profile_name')
                    ->first();

                $attributes = [
                    'contact_id' => $contact->id,
                    'whatsapp_message' => $modifiedMessage ?? 'Image Message',
                    'template_name' => null,
                    'template_type' => null,
                    'type' => 'send',
                    'status' => null,
                    'image' => null,
                    'phone_number' => $result['contacts'][0]['wa_id'],
                    'from' => null,
                    'recipient_id' => $result['contacts'][0]['wa_id'],
                    'send_at' => null,
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
}
