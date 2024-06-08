<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappChatContact extends Model
{
    use HasFactory;

    /**
     * Mass assign
     */
    protected $fillable = [
        'name',
        'number',
        'status',
        'profile_pic',
        'about',
        'search',
        'invite_code',
        'vcard_name',
    ];

    /**
     * Get whatsapp messages
     */
    public function messages()
    {
        return $this->hasMany(WhatsappMessage::class, 'contact_id', 'id');
    }
}
