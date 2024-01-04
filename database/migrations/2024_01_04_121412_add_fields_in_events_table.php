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
        Schema::table('events', function (Blueprint $table) {
            // add slug
            $table->string('slug')->unique()->nullable();

            // change event_time to event_start_time
            $table->renameColumn('event_time', 'event_start_time');

            // add event_end_time
            $table->string('event_end_time')->nullable();

            // add event_type
            $table->enum('event_type', ['free', 'paid'])->default('free');

            // add event language
            $table->string('event_language')->nullable();

            // add event duration
            $table->string('event_duration')->nullable();

            // timer time in minutes
            $table->integer('timer_time')->nullable();

            // add origanal price after price
            $table->decimal('original_price', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            //
        });
    }
};
