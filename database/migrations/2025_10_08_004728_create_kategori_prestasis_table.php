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
        Schema::create('kategori_prestasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_prestasi')->unique();
            $table->text('deskripsi')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('pendaftaran', function(Blueprint $table) {
            $table->foreignId('kategori_prestasi_id')->nullable()->after('ijazah')->constrained('kategori_prestasi');
        });

          Schema::table('siswa', function (Blueprint $table) {
            $table->dropColumn('kategori_prestasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->string('kategori_prestasi')->nullable()->after('email_siswa');
        });
        
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropConstrainedForeignId('kategori_prestasi_id');
        });
        
        Schema::dropIfExists('kategori_prestasi');
    }
};
