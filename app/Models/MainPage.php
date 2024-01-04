<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'slug',
        'title',
        'description',
        'content',
        'sub_title',
        'button_text',
    ];

    protected $casts = [
        'content' => 'array',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
