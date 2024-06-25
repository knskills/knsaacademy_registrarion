<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\WhatsappMessage;
use App\Models\MessageTemplate;
use App\Models\WhtasappTemplate;
use App\Models\WhatsappChatContact;

use Illuminate\Support\Facades\Log;

class TestingController extends Controller
{
    public function getContacts()
    {
        try {
            // Fetch contacts with their messages, ordered by the latest message timestamp
            $content = WhatsappChatContact::with(['messages' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }])
                ->whereHas('messages') // Ensuring we only get contacts with messages
                ->withCount(['messages' => function ($query) {
                    $query->select(\DB::raw('MAX(created_at)'));
                }])
                ->get();

            return response()->json([
                'contacts' => $content,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // // Fetch contacts with their messages, ordered by the latest message timestamp
            // $content = WhatsappChatContact::with(['messages' => function ($query) {
            //     $query->orderBy('created_at', 'asc');
            // }])
            // ->whereHas('messages') // Ensuring we only get contacts with messages
            // ->withCount(['messages' => function ($query) {
            //     $query->select(\DB::raw('MAX(created_at)'));
            // }])
            // ->get();

            // if ($request->ajax()) {
            //     Log::info('ajax request');
            //     return response()->json([
            //         'contacts' => $content,
            //     ]);
            // }

            return view('chat.index');
        } catch (\Exception $e) {
            // Log the error and return an error response
            Log::error($e->getMessage());
            return redirect()->back()->withErrors('An error occurred while fetching chat messages');
        }
    }


    public function getContactMessages(string $id)
    {
        try {
            // Log the contact ID
            Log::info($id);

            // get all messages where contact_id is id from WhatsappMessage
            $messages = WhatsappMessage::where('contact_id', $id)->get();
            // Log::info($messages);

            return response()->json([
                'code' => 200,
                'messages' => $messages,
            ]);
        } catch (\Exception $e) {
            // Log the error and return an error response
            Log::error($e->getMessage());
            return response()->json([
                'code' => 500,
                'message' => 'An error occurred while fetching chat messages'
            ]);
        }
    }
}
