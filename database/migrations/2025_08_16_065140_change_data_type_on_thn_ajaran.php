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
             $table->string('thn_ajaran')->nullable()->change();
            $table->integer('gelombang_pendaftaran')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_ppdb', function (Blueprint $table) {
            $table->integer('tahun_ajaran')->nullable()->change();
            $table->string('gelombang_pendaftaran')->nullable()->change();
        });
    }
};
