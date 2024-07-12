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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('audience_id')->nullable();
            $table->unsignedBigInteger('event_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->string('payment_gatway')->nullable();
            $table->string('payment_method');
            $table->decimal('amount', 8, 2);
            $table->date('payment_date');
            $table->string('receipt_number')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->nullable();
            $table->json('payment_data')->nullable();
            $table->foreign('audience_id')->references('id')->on('audiences')->onDelete('set null');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
