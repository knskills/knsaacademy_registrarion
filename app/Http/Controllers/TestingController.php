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
            // Fetch all messages
            $messages = WhatsappMessage::all();

            Log::info('Total messages: ' . $messages->count());

            foreach ($messages as $message) {
                // Check if contact already exists based on phone number
                $existing_contact = WhatsappChatContact::where('number', $message->recipient_id)->first();

                if ($existing_contact) {
                    // If contact exists, assign the existing contact ID to the message
                    $message->contact_id = $existing_contact->id;
                } else {
                    // If contact does not exist, create a new contact
                    $new_contact = WhatsappChatContact::create([
                        'name' => $message->profile_name,
                        'number' => $message->recipient_id,
                    ]);

                    // Assign the new contact ID to the message
                    $message->contact_id = $new_contact->id;
                }

                // Save the message with the updated contact_id
                $message->save();

            }


            return 'task completed';

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $e->getMessage();
        }
    }
}
