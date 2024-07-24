<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RazorPay extends Model
{
    use HasFactory;

    /**
     * Mass assignable
     * @var array
     */
    protected $fillable = [
        'razorpay_order_id',
        'razorpay_payment_id',
        'payment_method',
        'razorpay_signature',
        'user_id',
        'amount',
        'currency',
        'status',
        'receipt',
        'notes',
        'payment_detail',
    ];

    /**
     * Cast
     */
    protected $casts = [
        'payment_detail' => 'array',
        'notes' => 'array',
    ];

    /**
     * Get payment
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getPaymentDetail()
    {
        return $this->hasOne(Payment::class, 'id', 'payment_id');
    }
}
