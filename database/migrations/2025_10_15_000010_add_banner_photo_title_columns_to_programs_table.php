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
        Schema::table('programs', function (Blueprint $table) {
            $table->string('title')->nullable()->after('name');
            $table->string('photo_description')->nullable()->after('curriculum');
            $table->string('banner_url')->nullable()->after('brochure_url');
            $table->string('photo_url')->nullable()->after('banner_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn(['title', 'photo_description', 'banner_url', 'photo_url']);
        });
    }
};