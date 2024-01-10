<?php

namespace App\Http\Controllers;

use App\Models\audience;
use App\Exports\AudienceExport;
use App\Imports\AudienceImport;
use App\Models\Event;
use App\Models\MessageTemplate;
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
            $audianceQuery = Audience::query();
            $events = Event::all();

            if ($request->has('search')) {
                $searchTerm = $request->search;
                $audianceQuery->where('name', 'like', '%' . $searchTerm . '%');
            } elseif ($request->has('event')) {
                $event = $request->event;
                $audianceQuery->where('event_name', $event);
            } else {
                $audianceQuery->orderBy('id', 'desc');
            }

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
            $audience = Audience::where('email', $request->email)->where('phone', $request->phone)->first();

            if (!$audience) {
                $audience = new audience();
                $audience->name = $request->name;
                $audience->email = $request->email;
                $audience->phone = $request->phone;
                $audience->event_name = $request->event_name;
                $audience->registration_date = Carbon::now();
                $audience->save();


                $audience = Audience::where('id', $audience->id)->first();
                $messageTemp = MessageTemplate::where('name', 'Welcome whatsapp')->first();
                $message = $messageTemp->message;
                $message_type = $messageTemp->type;
                // replace variables in message
                $message = str_replace("{name}", $audience->name, $message);
                $message = str_replace("{email}", $audience->email, $message);
                $message = str_replace("{phone}", $audience->phone, $message);
                // $message = str_replace("{event}", $audience->event->name, $message);
                // $message = str_replace("{date}", $audience->event->date, $message);
                // $message = str_replace("{time}", $audience->event->time, $message);

                // // send message
                // if ($message_type == 'whatsapp') {
                //     sendWhatsAppMessage($audience->phone, $message);
                // } else {
                //     sendSms($audience->phone, $message);
                // }
            }

            // Mail using template file
            if ($request->email) {
                Mail::send('web.resMail', ['name' => $request->name], function ($message) use ($request) {
                    $message->to($request->email)
                        ->subject('Audience Registration');
                });
            }

            return redirect()->route('whatsapp');
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
     */
    public function export(Request $request)
    {
        try {
            // return Excel::download(new AudienceExport, 'audience.xlsx');

            return Excel::download(new AudienceExport(''), 'audiance_' . date('d-m-Y_H-i-s') . '.xlsx');

            // $filetype = $request->filetype;
            // $filename = 'audience.' . $filetype;

            // if ($filetype == 'csv') {
            //     return Excel::download(new AudienceExport, $filename, \Maatwebsite\Excel\Excel::CSV);
            // } elseif ($filetype == 'xlsx') {
            //     return Excel::download(new AudienceExport, $filename, \Maatwebsite\Excel\Excel::XLSX);
            // } elseif ($filetype == 'xls') {
            //     return Excel::download(new AudienceExport, $filename, \Maatwebsite\Excel\Excel::XLS);
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
}
