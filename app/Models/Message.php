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
        'name',
        'subject',
        'message',
        'type',
        'to',
        'template_id',
    ];

    /**
     * Cast attributes.
     */
    protected $casts = [
        'to' => 'array',
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
