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
            $table->enum('status', ['draft', 'active', 'inactive', 'closed'])
                  ->default('draft')
                  ->after('end_date')
                  ->comment('Status of the admission wave: draft, active, inactive, closed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admission_waves', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
