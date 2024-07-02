<?php

namespace App\Http\Controllers;

use App\Models\AutoReplyOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AutoReplyOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $options = AutoReplyOption::orderBy('id', 'desc')->paginate(10);
            $options->appends($request->except('page'));

            return view('admin.option-replies.index', compact('options'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return  redirect()->back()->with('error', 'An error occurred while processing your request.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.option-replies.create');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return  redirect()->back()->with('error', 'An error occurred while processing your request.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            // Log::info($request->all());

            $valitor = Validator::make($request->all(), [
                'keyword' => 'required',
                'reply' => 'required',
            ]);

            if ($valitor->fails()) {
                return redirect()->back()->withErrors($valitor)->withInput();
                // return response()->json([
                //     'status' => 'error',
                //     'errors' => $valitor->errors()->all()
                // ]);
            }

            $option = new AutoReplyOption;
            $option->keyword = $request->keyword;
            $option->reply = $request->reply;
            $option->created_by = auth()->user()->id;
            $option->save();

            return redirect()->route('auto-reply-options.index')->with('success', 'Auto reply option created successfully.');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return  redirect()->back()->with('error', 'An error occurred while processing your request.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AutoReplyOption $autoReplyOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AutoReplyOption $autoReplyOption)
    {
        try{
            return view('admin.option-replies.edit', compact('autoReplyOption'));
        }catch (\Exception $e) {
            Log::error($e->getMessage());
            return  redirect()->back()->with('error', 'An error occurred while processing your request.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AutoReplyOption $autoReplyOption)
    {
        try{
            // Log::info($request->all());

            $valitor = Validator::make($request->all(), [
                'keyword' => 'required',
                'reply' => 'required',
            ]);

            if ($valitor->fails()) {
                return redirect()->back()->withErrors($valitor)->withInput();
            }

            $autoReplyOption->keyword = $request->keyword;
            $autoReplyOption->reply = $request->reply;
            $autoReplyOption->updated_by = auth()->user()->id;
            $autoReplyOption->save();

            return redirect()->route('auto-reply-options.index')->with('success', 'Auto reply option updated successfully.');

        }catch (\Exception $e) {
            Log::error($e->getMessage());
            return  redirect()->back()->with('error', 'An error occurred while processing your request.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AutoReplyOption $autoReplyOption)
    {
        try{
            $autoReplyOption->delete();
            return redirect()->route('auto-reply-options.index')->with('success', 'Auto reply option deleted successfully.');
        }catch (\Exception $e) {
            Log::error($e->getMessage());
            return  redirect()->back()->with('error', 'An error occurred while processing your request.');
        }
    }
}
