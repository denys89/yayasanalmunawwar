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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_registration_id')->nullable()->constrained('student_registrations')->onDelete('cascade');
            $table->foreignId('admission_wave_id')->nullable()->constrained('admission_waves')->onDelete('set null');
            
            // Personal Information
            $table->string('full_name');
            $table->string('nickname')->nullable();
            $table->string('family_card_number');
            $table->string('national_id_number');
            $table->string('birthplace');
            $table->date('birthdate');
            $table->enum('gender', ['male', 'female']);
            
            // Sibling Information
            $table->string('sibling_name')->nullable();
            $table->string('sibling_class')->nullable();
            
            // Academic Information
            $table->enum('selected_class', ['kb', 'tk', 'sd']);
            $table->string('registration_type'); // New Student or Transfer
            
            // Previous School Information
            $table->string('previous_school_type');
            $table->string('previous_school_name');
            
            // Student Status
            $table->enum('status', ['active', 'inactive', 'graduated'])->default('active');
            $table->timestamp('enrolled_at')->nullable();
            
            // Audit Fields
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            
            $table->timestamps();
            
            // Indexes
            $table->index('student_registration_id');
            $table->index('admission_wave_id');
            $table->index('selected_class');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
