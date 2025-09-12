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
        Schema::table('faqs', function (Blueprint $table) {
            $table->string('category', 100)->nullable()->after('answer');
            $table->integer('order')->default(0)->after('category');
            $table->boolean('is_active')->default(true)->after('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn(['category', 'order', 'is_active']);
        });
    }
};
