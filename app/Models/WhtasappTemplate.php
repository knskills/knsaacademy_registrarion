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
        "template_content",
        "get_response",
        "header",
        "body",
        "body_params",
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
        'template_content' => 'array',
        'get_response' => 'array',
        'header' => 'array',
        'body' => 'array',
        'body_params' => 'array',
        'buttons' => 'array',
    ];
}
