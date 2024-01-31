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
    ];
}
