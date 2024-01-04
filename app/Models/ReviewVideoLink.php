<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewVideoLink extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'event_id',
        'link',
        'status',
    ];

    /**
     * Get the event that owns the review video link.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
