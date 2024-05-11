<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappApi extends Model
{
    use HasFactory;

    /**
     * Mass assignment
     */
    protected $fillable = [
        'about',
        'address',
        'description',
        'vartical',
        'website_1',
        'website_2',
        'email',
        'image',
    ];
}
