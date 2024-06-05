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
        Schema::create('whtasapp_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->json('response')->nullable();
            $table->json('get_response')->nullable();
            $table->json('header')->nullable();
            $table->json('body')->nullable();
            $table->json('buttons')->nullable();
            $table->string('language')->nullable();
            $table->string('status')->nullable();
            $table->string('category')->nullable();
            $table->string('temp_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whtasapp_templates');
    }
};
