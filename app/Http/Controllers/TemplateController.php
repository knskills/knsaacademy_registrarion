<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\MessageTemplate;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $templates = MessageTemplate::all();
            return view('admin.templates.index', compact('templates'));
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.templates.create');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Log::info($request->all());
            $valitor = Validator::make($request->all(), [
                'name' => 'required',
                'message' => 'required',
            ]);

            if ($valitor->fails()) {
                return redirect()->back()->withErrors($valitor)->withInput();
            }

            $template = MessageTemplate::create([
                'name' => $request->name ?? '',
                'subject' => $request->subject ?? '',
                'message' => $request->message ?? '',
                'type' => $request->type ?? '',
                'to' => $request->to ?? '',
                'cc' => $request->cc ?? '',
                'bcc' => $request->bcc ?? '',
                'status' => $request->status ?? '',
                'event_name' => $request->event_name ?? '',
            ]);

            return redirect()->route('templates.index')->with('success', 'Template created successfully!');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
