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
        if (Schema::hasTable('explores')) {
            Schema::table('explores', function (Blueprint $table) {
                if (!Schema::hasColumn('explores', 'summary')) {
                    $table->text('summary')->nullable()->after('content');
                }
                if (!Schema::hasColumn('explores', 'status')) {
                    $table->enum('status', ['draft', 'published'])->default('draft')->after('image_url');
                }
                if (!Schema::hasColumn('explores', 'order')) {
                    $table->integer('order')->default(0)->after('status');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('explores')) {
            Schema::table('explores', function (Blueprint $table) {
                if (Schema::hasColumn('explores', 'order')) {
                    $table->dropColumn('order');
                }
                if (Schema::hasColumn('explores', 'status')) {
                    $table->dropColumn('status');
                }
                if (Schema::hasColumn('explores', 'summary')) {
                    $table->dropColumn('summary');
                }
            });
        }
    }
};