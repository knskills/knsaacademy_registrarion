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
        Schema::table('whatsapp_messages', function (Blueprint $table) {
            $table->unsignedBigInteger('contact_id')->nullable()->after('id');
            $table->foreign('contact_id')->references('id')->on('whatsapp_chat_contacts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('whatsapp_messages', function (Blueprint $table) {
            $table->dropForeign(['contact_id']); // Corrected foreign key reference
            $table->dropColumn(['contact_id']);  // Corrected column name

        });
    }
};

