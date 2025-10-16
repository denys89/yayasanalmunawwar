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
        // For SQLite, we need to recreate the table to modify enum
        Schema::table('users', function (Blueprint $table) {
            // Drop the old role column
            $table->dropColumn('role');
        });
        
        Schema::table('users', function (Blueprint $table) {
            // Add the new role column with parent option
            $table->enum('role', ['admin', 'editor', 'parent'])->default('editor')->after('email_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'editor'])->default('editor')->after('email_verified_at');
        });
    }
};