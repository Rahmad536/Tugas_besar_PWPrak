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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'name')) {
                $table->string('name')->after('id')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'bio')) {
                $table->text('bio')->after('name')->nullable();
            }

            if (!Schema::hasColumn('users', 'profile_image')) {
                $table->string('profile_image')->after('bio')->nullable();
            }

            if (!Schema::hasColumn('users', 'background_image')) {
                $table->string('background_image')->after('profile_image')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom jika migration di-rollback
            $table->dropColumn(['name', 'bio', 'profile_image', 'background_image']);
        });
    }
};