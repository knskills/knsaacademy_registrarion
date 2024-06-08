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
        $contacts = WhatsappMessage::all();

        foreach ($contacts as $contact) {
            // Check if contact already exists
            $existing_contact = WhatsappChatContact::where('number', $contact->phone_number)->first();

            if ($existing_contact) {
                // If contact exists, assign the existing contact ID to the message
                $contact->contact_id = $existing_contact->id;
            } else {
                // If contact does not exist, create a new contact
                $new_contact = new WhatsappChatContact();
                $new_contact->name = $contact->profile_name;
                $new_contact->number = $contact->phone_number;
                $new_contact->save();

                // Assign the new contact ID to the message
                $contact->contact_id = $new_contact->id;
            }

            // Save the message with the updated contact_id
            $contact->save();
        }
    }
}
