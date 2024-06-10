<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\WhatsappMessage;
use App\Models\WhatsappChatContact;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // Fetch all contacts with their messages, ordered by latest message timestamp
            $contacts = WhatsappChatContact::with(['messages' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }])->get();

            // Check if there are any contacts
            if ($contacts->isEmpty()) {
                return redirect()->back()->withErrors('No contacts found');
            }

            // Initialize user and messages with the first contact's data
            $user = $contacts->first();
            $messages = $user->messages;

            // Log the request data if needed
            // Log::info($request->all());

            // If a recipient ID is provided, fetch the corresponding contact and their messages
            if ($request->has('recipient_id')) {
                $user = WhatsappChatContact::with(['messages' => function ($query) {
                    $query->orderBy('created_at', 'asc');
                }])->find($request->recipient_id);

                // Check if the recipient exists
                if ($user) {
                    $messages = $user->messages;
                } else {
                    return redirect()->back()->withErrors('Recipient not found');
                }
            } else if ($request->has('phone_number')) {
                $user = WhatsappChatContact::with(['messages' => function ($query) {
                    $query->orderBy('created_at', 'asc');
                }])
                    ->where('number', 'like', '%' . $request->phone_number . '%')
                    ->orWhere('name', 'like', '%' . $request->phone_number . '%')
                    ->first();

                $contacts = WhatsappChatContact::with(['messages' => function ($query) {
                    $query->orderBy('created_at', 'asc');
                }])
                    ->where('number', 'like', '%' . $request->phone_number . '%')
                    ->orWhere('name', 'like', '%' . $request->phone_number . '%')
                    ->get();

                // Check if the recipient exists
                if ($user) {
                    $messages = $user->messages;
                } else {
                    return redirect()->back()->withErrors('Recipient not found');
                }
            }

            return view('admin.chat.index', compact('messages', 'user', 'contacts'));
        } catch (\Exception $e) {
            // Log the error and return an error response
            Log::error($e->getMessage());
            return redirect()->back()->withErrors('An error occurred while fetching chat messages');
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
        //
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
    {   // delete all messages where recipient_id = $id
        // WhatsappMessage::where('recipient_id', $id)->delete();

        $client = WhatsappChatContact::where('id', $id)->first();
        $messages = $client->messages;

        foreach ($messages as $message) {
            // delete image if it exists
            if ($message->image) {
                $filePath = public_path($message->image);
                if (\File::exists($filePath)) {
                    \File::delete($filePath);
                }
            }
        }

        $client->delete();

        // WhatsappChatContact::find($id)->delete();

        // return redirect()->back()->with('success', 'Chat deleted successfully');

        return redirect()->route('whatsapp.chat.index')->with('success', 'Chat deleted successfully!');
    }
}
