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
    public function index(Request $request)
    {
        try {
            $templates = MessageTemplate::paginate(10);

            $templates->appends($request->except('page'));

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
        try {
            $template = MessageTemplate::findOrFail($id);

            return view('admin.templates.edit', compact('template'));
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $valitor = Validator::make($request->all(), [
                'name' => 'required',
                'message' => 'required',
            ]);

            if ($valitor->fails()) {
                return redirect()->back()->withErrors($valitor)->withInput();
            }

            $template = MessageTemplate::findOrFail($id);
            $template->update([
                'name' => $request->name ?? '',
                'subject' => $request->subject ?? '',
                'message' => $request->message ?? '',
                'type' => $request->type ?? '',
                'status' => $request->status ?? '',
                'event_name' => $request->event_name ?? '',
            ]);

            return redirect()->route('templates.index')->with('success', 'Template updated successfully!');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $template = MessageTemplate::findOrFail($id);
            $template->delete();

            return redirect()->route('templates.index')->with('success', 'Template deleted successfully!');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
