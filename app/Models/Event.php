<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * Mass assignable
     * @var array
     */
    protected $fillable = [
        'event_name',
        'event_date',
        'event_start_time',
        'event_end_time',
        'event_link',
        'event_image',
        'event_description',
        'event_type',
        'status',
        'payment_status',
        'youtube_link',
        'button_text',
        'price',
        'payment_link',
        'is_active',
        'whatsapp_link',
        'whstp_temp_name',
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

    public function setEventDateAttribute($value)
    {
        $this->attributes['event_date'] = date('Y-m-d', strtotime($value));
    }

    /**
     * Get Event content
     */
    public function eventContent()
    {
        return $this->hasOne(EventContent::class, 'event_id', 'id');
    }
}
