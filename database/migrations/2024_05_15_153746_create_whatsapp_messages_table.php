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
        Schema::create('whatsapp_messages', function (Blueprint $table) {
            $table->id();
            $table->string('message_id')->nullable();
            $table->foreignId('template_id')->nullable()->constrained('message_templates');
            $table->text('whatsapp_message')->nullable();
            $table->string('template_name')->nullable();
            $table->string('template_type')->nullable();
            $table->string('type')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('status')->nullable();
            $table->string('from')->nullable();
            $table->string('recipient_id')->nullable();
            $table->json('reply')->nullable();
            $table->string('profile_name')->nullable();
            $table->timestamp('send_at')->nullable();
            $table->timestamp('reply_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_messages');
    }
};
