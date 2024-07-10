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
        'razorpay_signature',
        'user_id',
        'amount',
        'currency',
        'status',
        'receipt',
        'notes'
    ];
}
