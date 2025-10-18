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
        if (!Schema::hasTable('explore_images')) {
            Schema::create('explore_images', function (Blueprint $table) {
                $table->id();
                $table->foreignId('explore_id')->constrained('explores')->cascadeOnDelete();
                $table->string('image_url');
                $table->text('caption')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('explore_images');
    }
};