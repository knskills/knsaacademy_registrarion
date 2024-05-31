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

            // add event type with enum free and paid
            $table->enum('event_type', ['free', 'paid'])->default('free')->after('event_name');

            // add status
            $table->string('status')->default('active')->after('event_type');

            // add payment status
            $table->string('payment_status')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audiences', function (Blueprint $table) {
            // drop tables
            $table->dropColumn('event_type');
            $table->dropColumn('status');
            $table->dropColumn('payment_status');
        });
    }
};
