<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('razor_pays', function (Blueprint $table) {
            $table->id();
            $table->string('razorpay_order_id')->nullable();
            $table->string('razorpay_payment_id')->nullable();
            $table->string('razorpay_signature')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('user_id')->nullable();
            $table->double('amount', 8, 2)->nullable();
            $table->string('currency')->nullable();
            $table->string('receipt')->nullable();
            $table->string('status')->nullable();
            $table->json('notes')->nullable();
            $table->json('payment_detail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('razor_pays');
    }
};
