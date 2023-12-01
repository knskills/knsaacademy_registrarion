<?php

namespace App\Http\Controllers;

use App\Models\audience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class AudienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $audianceQuery = Audience::query();

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
            return view('admin.audiance.dashboard', compact('audiences'));
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

            $audience = new audience();
            $audience->name = $request->name;
            $audience->email = $request->email;
            $audience->phone = $request->phone;
            $audience->event_name = $request->event_name;
            $audience->save();

            // mail to audience without view
            // Mail::raw('You have been registered successfully. Please join whatsapp group - https://chat.whatsapp.com/HFf0OwHFTg6Dw708ev9VNx', function ($message) use ($request) {
            //     $message->to($request->email)
            //         ->subject('Audience Registration');
            // });

            // Mail using template file
            Mail::send('web.resMail', ['name' => $request->name], function ($message) use ($request) {
                $message->to($request->email)
                    ->subject('Audience Registration');
            });

            // return redirect()->back()->with('success', 'Audience created successfully');
            return response()->json([
                'status' => 'success',
                'message' => 'You have been registered successfully. Please check your email for more details.'
            ]);

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
    //===========================================================================================//


    public function terms()
    {
        return view('web.terms');
    }

    public function privacy()
    {
        return view('web.privacy');
    }
}
