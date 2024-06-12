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
            // Base query to fetch contacts with their messages, ordered by the latest message timestamp
            $baseQuery = WhatsappChatContact::with(['messages' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }])
                ->whereHas('messages') // Ensuring we only get contacts with messages
                ->withCount(['messages' => function ($query) {
                    $query->select(\DB::raw('MAX(created_at)'));
                }])
                ->orderBy('messages_count', 'desc');

            // Check if there is a recipient_id filter
            $user = null;
            if ($request->has('recipient_id')) {
                $user = $baseQuery->find($request->recipient_id);
                if (!$user) {
                    return redirect()->back()->withErrors('Recipient not found');
                }
            }

            // Check if there is a phone_number filter
            if ($request->has('phone_number')) {
                $searchTerm = $request->phone_number;
                $baseQuery->where(function ($query) use ($searchTerm) {
                    $query->where('number', 'like', '%' . $searchTerm . '%')
                        ->orWhere('name', 'like', '%' . $searchTerm . '%');
                });
            }

            // Fetch all contacts based on the base query
            $contacts = $baseQuery->get();
            if ($contacts->isEmpty()) {
                return redirect()->back()->withErrors('No contacts found');
            }

            // If recipient_id was specified, ensure $user is set
            if ($request->has('recipient_id')) {
                $user = $contacts->firstWhere('id', $request->recipient_id);
            }

            // If no user has been found yet, set the first contact as the user
            if (!$user) {
                $user = $contacts->first();
            }

            // Get the messages of the found user
            $messages = $user->messages;

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
