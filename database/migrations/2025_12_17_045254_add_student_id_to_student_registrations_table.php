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
        Schema::table('student_registrations', function (Blueprint $table) {
            // Check if column doesn't exist before adding
            if (!Schema::hasColumn('student_registrations', 'student_id')) {
                // Add student_id without foreign key constraint to avoid circular dependency
                // The students table will reference student_registrations, not the other way around
                $table->unsignedBigInteger('student_id')->nullable()->after('updated_by');
                $table->index('student_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_registrations', function (Blueprint $table) {
            if (Schema::hasColumn('student_registrations', 'student_id')) {
                $table->dropIndex(['student_id']);
                $table->dropColumn('student_id');
            }
        });
    }
};
