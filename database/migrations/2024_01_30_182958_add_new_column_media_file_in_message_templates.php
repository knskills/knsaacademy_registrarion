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
        Schema::table('message_templates', function (Blueprint $table) {
            $table->text('media_file')->nullable()->after('message');
            $table->unsignedBigInteger('template_id')->nullable()->after('id');
            $table->json('cc')->nullable()->after('media_file');
            $table->json('bcc')->nullable()->after('cc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('message_templates', function (Blueprint $table) {
            $table->dropColumn('media_file');
            $table->dropColumn('template_id');
            $table->dropColumn('cc');
            $table->dropColumn('bcc');
        });
    }
};
