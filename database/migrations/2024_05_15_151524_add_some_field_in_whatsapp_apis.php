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
        Schema::table('whatsapp_apis', function (Blueprint $table) {
            $table->unsignedBigInteger('business_id')->nullable()->after('image');
            $table->unsignedBigInteger('phone_number_id')->nullable()->after('business_id');
            $table->string('phone_number')->nullable()->after('phone_number_id');
            $table->unsignedBigInteger('app_id')->nullable()->after('phone_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('whatsapp_apis', function (Blueprint $table) {
            $table->dropColumn('app_id');
            $table->dropColumn('business_id');
            $table->dropColumn('phone_number_id');
            $table->dropColumn('phone_number');
        });
    }
};
