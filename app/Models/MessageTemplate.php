<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_id',
        'name',
        'subject',
        'message',
        'media_file',
        'type',
        'status',
        'event_name',
        'cc',
        'bcc',
    ];

    protected $casts = [
        'cc' => 'array',
        'bcc' => 'array',
    ];

    // decode cc and bcc
    public function getCcAttribute($value)
    {
        return json_decode($value);
    }

    public function getBccAttribute($value)
    {
        return json_decode($value);
    }


}
