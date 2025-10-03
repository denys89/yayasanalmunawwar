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
        Schema::create('student_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('nickname')->nullable();
            $table->string('family_card_number');
            $table->string('national_id_number');
            $table->string('birthplace');
            $table->date('birthdate');
            $table->enum('gender', ['male', 'female']);
            $table->string('sibling_name')->nullable();
            $table->string('sibling_class')->nullable();
            $table->string('school_choice');
            $table->string('registration_type');
            $table->string('selected_class');
            $table->string('track');
            $table->string('selection_method');
            $table->string('previous_school_type');
            $table->string('previous_school_name');
            $table->string('registration_info_source');
            $table->text('registration_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_registrations');
    }
};
