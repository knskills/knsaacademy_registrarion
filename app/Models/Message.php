<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'event_id',
        'message_template_id',
        'type',
        'audience_numbers',
        'emails',
        'audience_ids',
        'schedule_date',
        'schedule_time',
        'status',
    ];

    /**
     * Cast attributes.
     */
    protected $casts = [
        'audience_ids' => 'array',
        'audience_numbers' => 'array',
        'emails' => 'array',
    ];

    /**
     * Get the messageTemplate that owns the Message
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function messageTemplate()
    {
        return $this->belongsTo(MessageTemplate::class);
    }

    /**
     * Get the event that owns the Message
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
