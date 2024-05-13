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
        Schema::create('whatsapp_apis', function (Blueprint $table) {
            $table->id();
            $table->string('about')->nullable();
            $table->string('address')->nullable();
            $table->string('description')->nullable();
            $table->string('vartical')->nullable();
            $table->string('website_1')->nullable();
            $table->string('website_2')->nullable();
            $table->string('email')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_apis');
    }
};
