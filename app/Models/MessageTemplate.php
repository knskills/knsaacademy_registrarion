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
        'whtsp_msg',
        'lang_code',
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
        'whtsp_msg' => 'array',
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

    /**
     * Get whatsapp template
     */
    public function getWhatsappTemplate()
    {
        return $this->hasOne(WhtasappTemplate::class, 'id', 'template_id');
    }


}
