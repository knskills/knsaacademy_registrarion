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
        Schema::create('event_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->string('title');

            $table->string('contanor1_heading')->nullable();
            $table->string('contanor1_sub_heading')->nullable();
            $table->string('contanor1_col1_contant_type')->nullable();
            $table->string('contanor1_col1_contant')->nullable();

            $table->string('contanor2_heading')->nullable();
            $table->string('contanor2_sub_heading')->nullable();
            $table->json('contanor2_data')->nullable();

            $table->string('contanor3_heading')->nullable();
            $table->string('contanor3_sub_heading')->nullable();
            $table->json('contanor3_data')->nullable();

            $table->string('contanor4_heading')->nullable();
            $table->string('contanor4_sub_heading')->nullable();
            $table->json('contanor4_data')->nullable();

            $table->string('contanor5_heading')->nullable();
            $table->string('contanor5_sub_heading')->nullable();
            $table->json('contanor5_data')->nullable();

            $table->string('contanor6_heading')->nullable();
            $table->string('contanor6_sub_heading')->nullable();
            $table->json('contanor6_data')->nullable();

            $table->string('trainer_heading')->nullable();
            $table->string('trainer_sub_heading')->nullable();
            $table->json('trainer_data')->nullable();

            $table->string('bonus_heading')->nullable();
            $table->string('bonus_sub_heading')->nullable();
            $table->string('bonus_price')->nullable();
            $table->json('bonus_data')->nullable();

            $table->string('learn_heading')->nullable();
            $table->string('learn_sub_heading')->nullable();
            $table->json('learn_data')->nullable();

            $table->string('achivers_heading')->nullable();
            $table->string('achivers_sub_heading')->nullable();
            $table->string('achivers_paragraph')->nullable();
            $table->json('achivers_data')->nullable();

            $table->string('review_heading')->nullable();
            $table->string('review_sub_heading')->nullable();
            $table->string('review_paragraph')->nullable();
            $table->json('review_data')->nullable();
            $table->timestamps();

            // foreign key
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_contents');
    }
};
