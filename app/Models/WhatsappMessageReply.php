<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappMessageReply extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'message_id',
        'reply',
        'profile_name',
        'type',
        'reply_at',
        'status',
        'phone_number',
        'recipient_id',
        'from',
    ];

    /**
     * Cast attributes.
     */
    protected $casts = [
        'reply_at' => 'datetime',
        'reply' => 'array',
    ];
}
