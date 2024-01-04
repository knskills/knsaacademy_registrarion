<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyReg extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'heading',
        'content',
    ];

    protected $casts = [
        'content' => 'array',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
