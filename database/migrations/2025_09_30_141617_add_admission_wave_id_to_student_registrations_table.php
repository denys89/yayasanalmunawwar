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
            $table->unsignedBigInteger('admission_wave_id')->nullable()->after('registration_type');
            $table->foreign('admission_wave_id')->references('id')->on('admission_waves')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_registrations', function (Blueprint $table) {
            $table->dropForeign(['admission_wave_id']);
            $table->dropColumn('admission_wave_id');
        });
    }
};
