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
        if (Schema::hasTable('explore_images') && Schema::hasColumn('explore_images', 'image')) {
            Schema::table('explore_images', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('explore_images') && !Schema::hasColumn('explore_images', 'image')) {
            Schema::table('explore_images', function (Blueprint $table) {
                $table->string('image')->nullable()->after('explore_id');
            });
        }
    }
};