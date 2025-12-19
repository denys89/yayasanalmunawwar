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
        Schema::table('payments', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['admission_wave_id']);
            
            // Modify the column to be nullable
            $table->foreignId('admission_wave_id')->nullable()->change();
            
            // Re-add the foreign key constraint
            $table->foreign('admission_wave_id')
                  ->references('id')
                  ->on('admission_waves')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['admission_wave_id']);
            
            // Modify the column to be not nullable
            $table->foreignId('admission_wave_id')->nullable(false)->change();
            
            // Re-add the foreign key constraint
            $table->foreign('admission_wave_id')
                  ->references('id')
                  ->on('admission_waves')
                  ->onDelete('cascade');
        });
    }
};
