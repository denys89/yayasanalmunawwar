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
        if (Schema::hasTable('homepage') && !Schema::hasColumn('homepage', 'youtube_embed')) {
            Schema::table('homepage', function (Blueprint $table) {
                $table->text('youtube_embed')->nullable()->after('photo_title');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('homepage') && Schema::hasColumn('homepage', 'youtube_embed')) {
            Schema::table('homepage', function (Blueprint $table) {
                $table->dropColumn('youtube_embed');
            });
        }
    }
};