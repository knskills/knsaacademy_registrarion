<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subject',
        'message',
        'type',
        'to',
        'cc',
        'bcc',
        'status',
        'event_name',
    ];
}
