<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhtasappTemplate extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        "name",
        "response",
        "get_response",
        "header",
        "body",
        "buttons",
        "language",
        "status",
        "category",
        "temp_id"
    ];

    /**
     * Cast attributes.
     */
    protected $casts = [
        'response' => 'array',
        'get_response' => 'array',
        'header' => 'array',
        'body' => 'array',
        'buttons' => 'array',
    ];
}
