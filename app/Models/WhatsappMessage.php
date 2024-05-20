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
        'message_id',
        'template_id',
        'whatsapp_message',
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
}
