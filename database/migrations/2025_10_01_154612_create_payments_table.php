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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_registration_id')->constrained('student_registrations')->onDelete('cascade');
            $table->foreignId('admission_wave_id')->constrained('admission_waves')->onDelete('cascade');
            $table->string('level');
            $table->decimal('amount', 12, 2);
            $table->enum('type', ['registration_fee', 'final_payment_fee']);
            $table->enum('status', ['unpaid', 'pending', 'paid'])->default('unpaid');
            $table->string('foto_bukti_transfer')->nullable();
            $table->foreignId('discount_id')->nullable()->constrained('discounts')->onDelete('set null');
            $table->foreignId('confirmed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
