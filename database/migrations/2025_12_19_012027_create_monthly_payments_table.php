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
        Schema::create('monthly_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            
            // Payment Period (Year-Month format: 2025-01)
            $table->string('payment_period', 7); // Format: YYYY-MM
            $table->unsignedTinyInteger('payment_month'); // 1-12
            $table->unsignedSmallInteger('payment_year'); // e.g., 2025
            
            // Payment Details
            $table->decimal('amount', 12, 2);
            $table->enum('status', ['unpaid', 'pending', 'paid', 'overdue'])->default('unpaid');
            
            // Payment Proof (if student uploads)
            $table->string('proof_url')->nullable();
            $table->timestamp('proof_uploaded_at')->nullable();
            
            // Due date for payment
            $table->date('due_date');
            $table->date('paid_at')->nullable();
            
            // Confirmation
            $table->foreignId('confirmed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('confirmed_at')->nullable();
            $table->text('notes')->nullable();
            
            $table->timestamps();
            
            // Unique constraint: one payment per student per month
            $table->unique(['student_id', 'payment_period']);
            
            // Indexes for faster queries
            $table->index('payment_period');
            $table->index('status');
            $table->index(['payment_year', 'payment_month']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_payments');
    }
};
