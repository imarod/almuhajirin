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
        DB::statement("ALTER TABLE pendaftaran MODIFY status_verifikasi ENUM('Dikirim', 'Diterima', 'Ditolak', 'Perbaikan') DEFAULT 'Dikirim'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE pendaftaran MODIFY status_verifikasi ENUM('Dikirim', 'Perbaikan') DEFAULT 'Dikirim'");
    }
};
