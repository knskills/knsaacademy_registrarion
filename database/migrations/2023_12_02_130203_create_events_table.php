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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name')->comment('event name')->nullable();
            $table->string('event_date')->comment('event date')->nullable();
            $table->string('event_time')->comment('event time')->nullable();
            $table->string('event_link')->comment('event link')->nullable();
            $table->string('event_image')->comment('event image')->nullable();
            $table->text('event_description')->comment('event description')->nullable();
            $table->string('youtube_link')->comment('youtube link')->nullable();
            $table->string('button_text')->comment('button text')->nullable();
            $table->decimal('price', 8, 2)->comment('price')->nullable();
            $table->string('payment_link')->comment('payment link')->nullable();
            $table->boolean('is_active')->default(true)->comment('is active');
            $table->string('whatsapp_link')->comment('whatsapp link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
