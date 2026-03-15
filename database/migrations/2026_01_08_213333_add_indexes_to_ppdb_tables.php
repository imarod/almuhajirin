<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function down(): void
    {
       // Cek dan drop index hanya jika benar-benar ada
        
        // Users - skip karena kemungkinan tidak ada atau unique index
        if ($this->indexExists('users', 'users_email_index')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropIndex('users_email_index');
            });
        }

        // Siswa - skip orang_tua_id karena foreign key
        if ($this->indexExists('siswa', 'siswa_user_id_index')) {
            Schema::table('siswa', function (Blueprint $table) {
                $table->dropIndex('siswa_user_id_index');
            });
        }

        // Pendaftaran
        if ($this->indexExists('pendaftaran', 'pendaftaran_siswa_id_index')) {
            Schema::table('pendaftaran', function (Blueprint $table) {
                $table->dropIndex('pendaftaran_siswa_id_index');
            });
        }

        if ($this->indexExists('pendaftaran', 'pendaftaran_jadwal_id_index')) {
            Schema::table('pendaftaran', function (Blueprint $table) {
                $table->dropIndex('pendaftaran_jadwal_id_index');
            });
        }

        if ($this->indexExists('pendaftaran', 'pendaftaran_jurusan_id_index')) {
            Schema::table('pendaftaran', function (Blueprint $table) {
                $table->dropIndex('pendaftaran_jurusan_id_index');
            });
        }

        if ($this->indexExists('pendaftaran', 'pendaftaran_kategori_prestasi_id_index')) {
            Schema::table('pendaftaran', function (Blueprint $table) {
                $table->dropIndex('pendaftaran_kategori_prestasi_id_index');
            });
        }

        // Master tables
        if ($this->indexExists('kategori_prestasi', 'kategori_prestasi_is_active_index')) {
            Schema::table('kategori_prestasi', function (Blueprint $table) {
                $table->dropIndex('kategori_prestasi_is_active_index');
            });
        }

        if ($this->indexExists('jurusan', 'jurusan_is_active_index')) {
            Schema::table('jurusan', function (Blueprint $table) {
                $table->dropIndex('jurusan_is_active_index');
            });
        }
    }

    /**
     * Cek apakah index ada di database
     */
    private function indexExists(string $table, string $index): bool
    {
        $connection = Schema::getConnection();
        $database = $connection->getDatabaseName();
        
        $exists = DB::select(
            "SELECT COUNT(*) as count 
             FROM information_schema.statistics 
             WHERE table_schema = ? 
             AND table_name = ? 
             AND index_name = ?",
            [$database, $table, $index]
        );
        
        return $exists[0]->count > 0;
    }
    
};
