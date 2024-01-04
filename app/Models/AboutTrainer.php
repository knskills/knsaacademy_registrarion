<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutTrainer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'event_id',
        'heading',
        'description',
        'image',
        'btn_uper_text',
        'btn_text',
        'btn_lower_text',
        'status',
    ];

    /**
     * Get the event that owns the about event.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
