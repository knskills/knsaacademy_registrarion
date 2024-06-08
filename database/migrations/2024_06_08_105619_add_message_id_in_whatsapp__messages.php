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
            if (!Schema::hasColumn('whatsapp_messages', 'contact_id')) {
                $table->unsignedBigInteger('contact_id')->nullable()->after('id');
                $table->foreign('contact_id')->references('id')->on('whatsapp_chat_contacts')->onDelete('cascade');
            }
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('whatsapp_messages', function (Blueprint $table) {
            // Check if the column exists before dropping the foreign key
            if (Schema::hasColumn('whatsapp_messages', 'contact_id')) {
                $table->dropForeign(['contact_id']); // Drop the foreign key constraint
                $table->dropColumn('contact_id'); // Drop the column
            }
        });
    }
};
