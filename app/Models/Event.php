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
        'event_start_time',
        'event_end_time',
        'event_link',
        'event_image',
        'event_description',
        'youtube_link',
        'button_text',
        'price',
        'payment_link',
        'is_active',
        'whatsapp_link',
        'event_type',
        'event_language',
        'event_duration',
        'timer_time',
        'original_price',
        'slug',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // convert string to date format event_date
    public function setEventDateAttribute($value)
    {
        $this->attributes['event_date'] = date('Y-m-d', strtotime($value));
    }
}
