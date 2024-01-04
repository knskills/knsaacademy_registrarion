<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'heading',
        'states',
        'content_1',
        'content_items',
        'subheading',
        'content_2',
    ];

    protected $casts = [
        'states' => 'array',
        'content_items' => 'array',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function getStatesAttribute($value)
    {
        return json_decode($value);
    }

    public function getContentItemsAttribute($value)
    {
        return json_decode($value);
    }

    public function setStatesAttribute($value)
    {
        $this->attributes['states'] = json_encode($value);
    }

    public function setContentItemsAttribute($value)
    {
        $this->attributes['content_items'] = json_encode($value);
    }
}
