<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // php artisan migrate --path=database/migrations/2025_01_23_143821_add_berkas_to_users_table.php
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('berkas')->nullable()->after('status_kerja');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('berkas');
        });
    }
};
