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
        // Clean state for development retries
        Schema::dropIfExists('foundation_values');

        Schema::create('foundation_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('homepage_id');
            $table->string('icon');
            $table->string('title');
            $table->text('description');
            $table->timestamps();

            // Use short foreign key name to avoid MySQL identifier length issues
            $table->foreign('homepage_id', 'fk_fv_hp_id')
                ->references('id')
                ->on('homepage')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foundation_values');
    }
};