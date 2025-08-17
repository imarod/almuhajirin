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
        Schema::table('jadwal_ppdb', function (Blueprint $table) {
            $table->integer('thn_ajaran')->after('id')->nullable();
            $table->string('gelombang_pendaftaran')->after('thn_ajaran')->nullable();
            $table->string('kuota')->after('gelombang_pendaftaran')->nullable();
            $table->date('tgl_mulai')->after('kuota')->nullable();
            $table->date('tgl_berakhir')->after('tgl_mulai')->nullable();
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_ppdb', function (Blueprint $table) {
            $table->dropColumn([
                'thn_ajaran',
                'gelombang_pendaftaran',
                'kuota',
                'tgl_mulai',
                'tgl_berakhir'
            ]);
        });
    }
};
