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
        Schema::table('admission_waves', function (Blueprint $table) {
            // Add the new is_active column first
            $table->boolean('is_active')
                  ->default(false)
                  ->after('end_date')
                  ->comment('Whether the admission wave is active or not');
            
            // Drop the old status column
            $table->dropColumn('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admission_waves', function (Blueprint $table) {
            // Add back the status column with original enum values
            $table->enum('status', ['draft', 'active', 'inactive', 'closed'])
                  ->default('draft')
                  ->after('end_date')
                  ->comment('Status of the admission wave: draft, active, inactive, closed');
            
            // Drop the is_active column
            $table->dropColumn('is_active');
        });
    }
};
