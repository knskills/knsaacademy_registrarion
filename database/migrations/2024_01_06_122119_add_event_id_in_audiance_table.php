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

            $table->timestamp('registration_date')->nullable()->after('event_id');
        });

        // Update existing records' registration_date with values from created_at
        DB::statement('UPDATE audiences SET registration_date = created_at');

        // If you want to maintain the column and its data integrity
        // Schema::table('audiences', function (Blueprint $table) {
        //     $table->timestamp('registration_date')->nullable(false)->change();
        // });
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
            $table->dropColumn(['registration_date']);
        });
    }
};
