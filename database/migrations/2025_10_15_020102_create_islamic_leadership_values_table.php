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
        // Ensure clean state in development environments
        Schema::dropIfExists('islamic_leadership_values');
        if (!Schema::hasTable('islamic_leadership_values')) {
            Schema::create('islamic_leadership_values', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('organizational_structure_id');
                $table->string('icon');
                $table->string('title');
                $table->longText('description');
                $table->timestamps();

                $table->foreign('organizational_structure_id', 'fk_ilv_os_id')
                    ->references('id')
                    ->on('organizational_structure')
                    ->cascadeOnDelete();
            });
        } else {
            Schema::table('islamic_leadership_values', function (Blueprint $table) {
                $table->foreign('organizational_structure_id', 'fk_ilv_os_id')
                    ->references('id')
                    ->on('organizational_structure')
                    ->cascadeOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('islamic_leadership_values');
    }
};