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
            $table->integer('capacity')->default(0)->after('status')->comment('Capacity limit for admission wave. 0 means unlimited.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admission_waves', function (Blueprint $table) {
            $table->dropColumn('capacity');
        });
    }
};
