<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class audience extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'event_id',
        'name',
        'email',
        'phone',
        'event_name',
        'registration_date',
    ];

    /**
     * Get the event that owns the audience.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
