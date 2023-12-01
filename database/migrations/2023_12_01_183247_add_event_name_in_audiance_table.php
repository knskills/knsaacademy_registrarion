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
        Schema::table('audiences', function (Blueprint $table) {
            $table->string('event_name')->default('first event')->after('phone')->comment('event name');

            // Drop unique constraint from email column
            $table->string('email')->nullable()->unique(false)->change();

            // Drop unique constraint from phone column
            $table->string('phone')->nullable()->unique(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audiences', function (Blueprint $table) {
            $table->dropColumn('event_name');
        });
    }
};
