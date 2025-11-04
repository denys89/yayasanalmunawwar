<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Rename columns: icon -> photo, description -> position
        Schema::table('foundation_leadership_structures', function (Blueprint $table) {
            if (Schema::hasColumn('foundation_leadership_structures', 'icon')) {
                $table->renameColumn('icon', 'photo');
            }
            if (Schema::hasColumn('foundation_leadership_structures', 'description')) {
                $table->renameColumn('description', 'position');
            }
        });

        // Ensure text values fit into VARCHAR(255) before changing column type
        try {
            DB::table('foundation_leadership_structures')->select('id', 'position')->orderBy('id')->chunk(500, function ($rows) {
                foreach ($rows as $row) {
                    if (is_string($row->position) && strlen($row->position) > 255) {
                        DB::table('foundation_leadership_structures')
                            ->where('id', $row->id)
                            ->update(['position' => substr($row->position, 0, 255)]);
                    }
                }
            });
        } catch (\Throwable $e) {
            // If chunking fails, fallback to a direct update truncation for long values
            try {
                DB::statement("UPDATE foundation_leadership_structures SET position = SUBSTRING(position, 1, 255)");
            } catch (\Throwable $ignored) {
                // ignore - database may not support SUBSTRING; type change will still proceed for short values
            }
        }

        // Change column type of position to VARCHAR(255)
        Schema::table('foundation_leadership_structures', function (Blueprint $table) {
            if (Schema::hasColumn('foundation_leadership_structures', 'position')) {
                $table->string('position', 255)->change();
            }
            if (Schema::hasColumn('foundation_leadership_structures', 'photo')) {
                // Keep photo as a string path/link and allow NULL when no photo uploaded
                $table->string('photo', 255)->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert column type first
        Schema::table('foundation_leadership_structures', function (Blueprint $table) {
            if (Schema::hasColumn('foundation_leadership_structures', 'position')) {
                $table->longText('position')->change();
            }
            if (Schema::hasColumn('foundation_leadership_structures', 'photo')) {
                $table->string('photo', 255)->change();
            }
        });

        // Rename columns back: photo -> icon, position -> description
        Schema::table('foundation_leadership_structures', function (Blueprint $table) {
            if (Schema::hasColumn('foundation_leadership_structures', 'photo')) {
                $table->renameColumn('photo', 'icon');
            }
            if (Schema::hasColumn('foundation_leadership_structures', 'position')) {
                $table->renameColumn('position', 'description');
            }
        });
    }
};