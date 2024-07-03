<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoReplyOption extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'keyword',
        'reply',
        'status',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];
}
