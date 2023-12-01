<?php

namespace App\Http\Controllers;

use App\Models\AutianceSecond;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class AutianceSecondController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $audiences = AutianceSecond::paginate(10);
            return view('admin.audiance.second', compact('audiences'));
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
                'name' => 'required',
                'email' => 'required|email|unique:audiences|max:255',
                'phone' => 'required|unique:audiences',
            ]);

            if ($valitor->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $valitor->errors()->all()
                ]);
            }

            $audience = new AutianceSecond();
            $audience->name = $request->name;
            $audience->email = $request->email;
            $audience->phone = $request->phone;
            $audience->save();

            // Mail using template file
            Mail::send('web.resMail', ['name' => $request->name], function ($message) use ($request) {
                $message->to($request->email)->subject('Audience Registration');
            });

            return response()->json([
                'status' => 'success',
                'message' => 'You have been registered successfully. Please check your email for more details.'
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AutianceSecond $audience)
    {
        try {
            $audience->delete();
            return redirect()->back()->with('success', 'Audience deleted successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
