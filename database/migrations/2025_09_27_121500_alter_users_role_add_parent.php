<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add 'parent' to users.role enum
        DB::statement("ALTER TABLE `users` MODIFY `role` ENUM('admin','editor','parent') NOT NULL DEFAULT 'editor'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to original enum without 'parent'
        DB::statement("ALTER TABLE `users` MODIFY `role` ENUM('admin','editor') NOT NULL DEFAULT 'editor'");
    }
};