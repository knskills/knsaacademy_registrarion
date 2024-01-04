<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info2Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'heading',
        'content_1',
        'content_2',
        'button_text',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
