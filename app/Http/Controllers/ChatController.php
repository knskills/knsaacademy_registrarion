<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\WhatsappMessage;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Log::info($request->all());
        try {
            // Fetch the chat list grouped by recipient_id with the latest message time
            $chatList = WhatsappMessage::select(
                'recipient_id',
                \DB::raw('MAX(created_at) as latest_message_time'),
                \DB::raw('SUBSTRING_INDEX(GROUP_CONCAT(profile_name ORDER BY created_at DESC), ",", 1) as profile_name')
            )
                ->where('type', 'reply')
                ->groupBy('recipient_id')
                ->orderBy('latest_message_time', 'desc')
                ->get();

            // Log::info($chatList);

            // Determine the user to fetch messages for
            if ($request->has('recipient_id')) {
                $recipient = WhatsappMessage::where('recipient_id', $request->recipient_id)->first();
                $user = $recipient;

                // Check if recipient exists
                if ($recipient) {
                    $user_id = $recipient->recipient_id;
                } else {
                    // If recipient_id is provided but not found, handle accordingly
                    return redirect()->back()->withErrors('Recipient not found');
                }
            } else {
                // If no recipient_id is provided, use the latest recipient from the chat list
                if ($chatList->isEmpty()) {
                    // Handle the case where chat list is empty
                    return redirect()->back()->withErrors('No chat messages found');
                }
                $user_id = $chatList->first()->recipient_id;
                $user = $chatList->first();
            }

            // Fetch messages for the determined user_id
            $messages = WhatsappMessage::where('recipient_id', $user_id)->get();

            // Log::info($messages);

            return view('admin.chat.index', compact('chatList', 'messages', 'user'));
        } catch (\Exception $e) {
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
    {
        //
    }
}
