<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * Mass assignable fields
     * @var array
     */
    protected $fillable = [
        'audience_id',
        'event_id',
        'payment_method',
        'status',
        'payment_date',
        'receipt_number',
        'notes',
        'amount',
        'payment_id',
        'payment_gatway',
        'payment_data'
    ];

    /**
     * Cast
     */
    protected $casts = [
        'payment_data' => 'array'
    ];

    /**
     * Get the event that owns the payment
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * get the audience that owns the payment
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function audience()
    {
        return $this->belongsTo(Audience::class);
    }

    /**
     * Get Payment detail using payment_id from RazorPay
     */
    public function razarpay()
    {
        return $this->belongsTo(RazorPay::class, 'payment_id');
    }
}
