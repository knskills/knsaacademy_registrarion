<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'event_name',
        'event_date',
        'event_time',
        'event_link',
        'event_image',
        'event_description',
        'youtube_link',
        'button_text',
        'price',
        'payment_link',
        'is_active',
        'whatsapp_link',
    ];
}
