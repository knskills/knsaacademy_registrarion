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
        Schema::table('whtasapp_templates', function (Blueprint $table) {
            // add body params as a json
            $table->json('body_params')->nullable()->after('body');
            $table->json('template_content')->nullable()->after('response');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('whtasapp_templates', function (Blueprint $table) {
            // drop
            $table->dropColumn('body_params');
            $table->dropColumn('template_content');
        });
    }
};
