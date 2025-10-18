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
        if (Schema::hasTable('explore_images')) {
            Schema::table('explore_images', function (Blueprint $table) {
                if (!Schema::hasColumn('explore_images', 'image_url')) {
                    $table->string('image_url')->after('explore_id');
                }
                if (!Schema::hasColumn('explore_images', 'caption')) {
                    $table->text('caption')->nullable()->after('image_url');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('explore_images')) {
            Schema::table('explore_images', function (Blueprint $table) {
                if (Schema::hasColumn('explore_images', 'caption')) {
                    $table->dropColumn('caption');
                }
                if (Schema::hasColumn('explore_images', 'image_url')) {
                    $table->dropColumn('image_url');
                }
            });
        }
    }
};