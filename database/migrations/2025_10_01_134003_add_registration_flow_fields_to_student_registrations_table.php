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
            $table->enum('registration_step', [
                'waiting_registration_fee',
                'registration_fee_confirmed',
                'observation',
                'parent_interview',
                'announcement',
                'waiting_final_payment_fee',
                'final_payment_confirmed_fee',
                'documents',
                'finished'
            ])->default('waiting_registration_fee')->after('registration_reason');
            
            $table->enum('registration_status', [
                'pending',
                'passed',
                'failed'
            ])->default('pending')->after('registration_step');
            
            $table->string('created_by')->nullable()->after('registration_status');
            $table->string('updated_by')->nullable()->after('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_registrations', function (Blueprint $table) {
            $table->dropColumn(['registration_step', 'registration_status', 'created_by', 'updated_by']);
        });
    }
};
