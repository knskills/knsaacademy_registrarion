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
        try {
            // Fetch the chat list grouped by recipient_id with the latest message time
            $chatList = WhatsappMessage::select(
                'recipient_id',
                \DB::raw('MAX(created_at) as latest_message_time'),
                \DB::raw('SUBSTRING_INDEX(GROUP_CONCAT(profile_name ORDER BY created_at DESC), ",", 1) as profile_name')
            )
                ->groupBy('recipient_id')
                ->orderBy('latest_message_time', 'desc')
                ->get();

            // Determine the user to fetch messages for
            if ($request->has('recipient_id')) {
                $user = WhatsappMessage::where('recipient_id', $request->recipient_id)->latest()->first();

                // Check if recipient exists
                if ($user) {
                    $user_id = $user->recipient_id;
                } else {
                    // If recipient_id is provided but not found, handle accordingly
                    return redirect()->back()->withErrors('Recipient not found');
                }
            } else {
                if ($chatList->isEmpty()) {
                    return redirect()->back()->withErrors('No chat messages found');
                }

                $user = $chatList->first();
                $user_id = $user->recipient_id;
            }

            // Fetch messages for the determined user_id
            $messages = WhatsappMessage::with('template')->where('recipient_id', $user_id)->get();

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
    {        // delete all messages where recipient_id = $id
        WhatsappMessage::where('recipient_id', $id)->delete();

        // return redirect()->back()->with('success', 'Chat deleted successfully');

        return redirect()->route('whatsapp.chat.index')->with('success', 'Chat deleted successfully!');
    }
}
