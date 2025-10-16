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
        // In case a previous failed attempt left the table without the FK, ensure a clean state in dev
        Schema::dropIfExists('foundation_leadership_structures');
        if (!Schema::hasTable('foundation_leadership_structures')) {
            Schema::create('foundation_leadership_structures', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('organizational_structure_id');
                $table->string('icon');
                $table->string('title');
                $table->longText('description');
                $table->timestamps();

                $table->foreign('organizational_structure_id', 'fk_fls_os_id')
                    ->references('id')
                    ->on('organizational_structure')
                    ->cascadeOnDelete();
            });
        } else {
            Schema::table('foundation_leadership_structures', function (Blueprint $table) {
                // Ensure foreign key exists with a shorter name
                $table->foreign('organizational_structure_id', 'fk_fls_os_id')
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
        Schema::dropIfExists('foundation_leadership_structures');
    }
};