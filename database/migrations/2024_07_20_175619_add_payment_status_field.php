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
            // add payment status
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('audiences', function (Blueprint $table) {
            // drop payment status
            $table->dropColumn('payment_status');
        });
    }
};
