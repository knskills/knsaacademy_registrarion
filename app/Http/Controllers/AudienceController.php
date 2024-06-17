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

            $audianceQuery->where('event_name', 'Learn Marketing S2');
            // ->orWhere('event_name', 'Learn Marketing')

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
            $valitor = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|max:255',
                'phone' => 'required',
                // 'email' => 'required|email|unique:audiences|max:255',
                // 'phone' => 'required|unique:audiences',
            ]);

            if ($valitor->fails()) {
                // return redirect()->back()->withErrors($valitor)->withInput();
                return response()->json([
                    'status' => 'error',
                    'errors' => $valitor->errors()->all()
                ]);
            }

            // check if email and phone already exists in database
            // $audience = Audience::where('email', $request->email)->orWhere('phone', $request->phone)->first();

            $audience = Audience::where('email', $request->email)->where('phone', $request->phone)->where('event_name', $request->event_name)->first();
            $result = null;
            $modifiedMessage = null;

            if (!$audience) {
                $audience = new audience();
                $audience->name = $request->name;
                $audience->email = $request->email;
                $audience->phone = $request->phone;
                $audience->event_type = $request->event_type;
                $audience->event_name = $request->event_name;
                $audience->registration_date = Carbon::now();
                $audience->save();

                $template = WhtasappTemplate::where('name', 'welcome_first_message')->first();
                $modifiedMessage = MessageTemplate::where('name', 'welcome_first_message')->first()->message;
                // Log::info($template);
                if ($template) {
                    $result = sendTempMessage($template, $request->phone, $para = null);
                }

                // $audience = Audience::where('id', $audience->id)->first();
                // $messageTemp = MessageTemplate::where('name', 'Welcome whatsapp')->first();
                // $message = $messageTemp->message;
                // $message_type = $messageTemp->type;

                // // replace variables in message
                // $message = str_replace("{name}", $audience->name, $message);
                // $message = str_replace("{email}", $audience->email, $message);
                // $message = str_replace("{phone}", $audience->phone, $message);
                // // $message = str_replace("{event}", $audience->event->name, $message);
                // // $message = str_replace("{date}", $audience->event->date, $message);
                // // $message = str_replace("{time}", $audience->event->time, $message);

                // // // send message
                // // if ($message_type == 'whatsapp') {
                // //     sendWhatsAppMessage($audience->phone, $message);
                // // } else {
                // //     sendSms($audience->phone, $message);
                // // }
            } else {
                return back()->with('error', 'You are already registered for this event');

                // Log::info('Audience already exists');
                // update event name and registration date
                $audience->name = $request->name;
                $audience->email = $request->email;
                $audience->phone = $request->phone;
                $audience->event_type = $request->event_type;
                $audience->event_name = $request->event_name;
                $audience->registration_date = Carbon::now();
                $audience->save();

                $template = WhtasappTemplate::where('name', 'welcome_first_message')->first();
                $modifiedMessage = MessageTemplate::where('name', 'welcome_first_message')->first()->message;
                // Log::info($template);
                if ($template) {
                    $result = sendTempMessage($template, $request->phone, $para = null);
                }

                // return error if audience already exists
            }

            if (isset($result['messages'])) {
                $messages = $result['messages'];

                foreach ($messages as $message) {

                    $contact = WhatsappChatContact::updateOrCreate(
                        ['number' => $result['contacts'][0]['wa_id']],
                        ['name' => null]
                    );

                    // Fetch the existing message if it exists
                    $existingMessage = WhatsappMessage::where('recipient_id', $result['contacts'][0]['wa_id'])->whereNotNull('profile_name')->first();

                    // Prepare the attributes for update or create
                    $attributes = [
                        'contact_id' => $contact->id,
                        'whatsapp_message' => $modifiedMessage ?? 'Image Message',
                        'template_name' => null,
                        'template_type' => null,
                        'type' => 'send',
                        'status' => null,
                        'image' => $temp_img ?? null,
                        'phone_number' => $result['contacts'][0]['wa_id'],
                        'from' => null,
                        'recipient_id' => $result['contacts'][0]['wa_id'],
                        'send_at' => null,
                    ];

                    // If the message exists, add the profile name
                    if ($existingMessage) {
                        $attributes['profile_name'] = $existingMessage->profile_name;
                    }

                    // Update or create the record
                    $message = WhatsappMessage::updateOrCreate(
                        ['message_id' => $message['id']],
                        $attributes
                    );
                }
            }

            // Mail using template file
            if ($request->email) {
                Mail::send('web.resMail', ['name' => $request->name], function ($message) use ($request) {
                    $message->to($request->email)
                        ->subject('Audience Registration');
                });
            }

            return redirect()->away('https://rzp.io/l/networkmarketingkyakyukaise');


            // return redirect()->route('join-whatsapp');
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


    // public function handlePaymentResponse(Request $request)
    // {
    //     Log::info($request->all());

    //     // Extract payment details from the request
    //     $payment_id = $request->input('razorpay_payment_id');
    //     $order_id = $request->input('razorpay_order_id');
    //     $signature = $request->input('razorpay_signature');

    //     // You can verify the signature here if needed
    //     // Perform actions such as saving payment details to the database

    //     // Example: Logging payment details
    //     \Log::info('Payment ID: ' . $payment_id);
    //     \Log::info('Order ID: ' . $order_id);
    //     \Log::info('Signature: ' . $signature);

    //     // Return a response to the user
    //     return view('payment.success', compact('payment_id', 'order_id', 'signature'));
    // }
}
