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
            $table->unsignedBigInteger('event_id')->nullable()->after('id');

            $table->foreign('event_id')->references('id')->on('events')->onDelete('Set Null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audiences', function (Blueprint $table) {
            // $table->dropForeign('audiences_event_id_foreign');
            // $table->dropColumn('event_id');

            $table->dropColumn(['event_id']);
        });
    }
};
