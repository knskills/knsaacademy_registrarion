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
        // delete whatsapp_message_replies table
        Schema::dropIfExists('whatsapp_message_replies');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // // create whatsapp_message_replies table
        // Schema::create('whatsapp_message_replies', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('message_id');
        //     $table->string('reply_message_id');
        //     $table->timestamps();
        // });
    }
};
