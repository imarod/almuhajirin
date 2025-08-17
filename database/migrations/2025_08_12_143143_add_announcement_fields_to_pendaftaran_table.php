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
        Schema::table('pendaftaran', function (Blueprint $table) {
            //status pendaftaran aktual di admin
            $table->string('status_aktual')->nullable()->after('status_verifikasi');

            //cek status pengumuman
            $table->boolean('is_announced')->default(false)->after('status_aktual');

            //cek status pengiriman notifikasi wa
            $table->boolean('pesan_whatsapp')->default(false)->after('is_announced');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
        $table->dropColumn(['status_aktual','tgl_pengumuman','is_announced','pesan_whatsapp']);
        });
    }
};
