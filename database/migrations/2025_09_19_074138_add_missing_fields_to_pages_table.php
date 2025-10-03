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
        Schema::table('pages', function (Blueprint $table) {
            // Add excerpt field
            $table->text('excerpt')->nullable()->after('content');
            
            // Add SEO fields
            $table->string('meta_title')->nullable()->after('excerpt');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->string('meta_keywords')->nullable()->after('meta_description');
            
            // Add page settings fields
            $table->string('featured_image')->nullable()->after('meta_keywords');
            $table->boolean('show_in_menu')->default(false)->after('featured_image');
            $table->integer('menu_order')->default(0)->after('show_in_menu');
            
            // Add published status tracking
            $table->boolean('is_published')->default(false)->after('menu_order');
            $table->timestamp('published_at')->nullable()->after('is_published');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            // Drop the added columns in reverse order
            $table->dropColumn([
                'published_at',
                'is_published',
                'menu_order',
                'show_in_menu',
                'featured_image',
                'meta_keywords',
                'meta_description',
                'meta_title',
                'excerpt'
            ]);
        });
    }
};
