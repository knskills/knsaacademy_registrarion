<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappMessage extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'contact_id',
        'message_id',
        'template_id',
        'whatsapp_message',
        'image',
        'template_name',
        'template_type',
        'type',
        'status',
        'phone_number',
        'from',
        'recipient_id',
        'reply',
        'profile_name',
        'send_at',
        'reply_at',
    ];

    /**
     * Cast attributes.
     */
    protected $casts = [
        'reply_at' => 'datetime',
        'send_at' => 'datetime',
        'reply' => 'array',
    ];

    /**
     * get the whtaspp template
     */
    function template()
    {
        return $this->belongsTo(MessageTemplate::class, 'template_id');
    }

    /**
     * get the contacts
     */
    function contact()
    {
        return $this->belongsTo(WhatsappChatContact::class, 'contact_id');
    }
}
