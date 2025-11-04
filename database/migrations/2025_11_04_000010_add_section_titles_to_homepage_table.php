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
        if (Schema::hasTable('homepage')) {
            Schema::table('homepage', function (Blueprint $table) {
                if (!Schema::hasColumn('homepage', 'program_title')) {
                    $table->string('program_title')->nullable()->after('photo_title');
                }
                if (!Schema::hasColumn('homepage', 'explore_title')) {
                    $table->string('explore_title')->nullable()->after('program_title');
                }
                if (!Schema::hasColumn('homepage', 'news_title')) {
                    $table->string('news_title')->nullable()->after('explore_title');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('homepage')) {
            Schema::table('homepage', function (Blueprint $table) {
                if (Schema::hasColumn('homepage', 'news_title')) {
                    $table->dropColumn('news_title');
                }
                if (Schema::hasColumn('homepage', 'explore_title')) {
                    $table->dropColumn('explore_title');
                }
                if (Schema::hasColumn('homepage', 'program_title')) {
                    $table->dropColumn('program_title');
                }
            });
        }
    }
};