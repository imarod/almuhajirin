<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropForeign(['jurusan_id']);
            $table->foreign('jurusan_id')->references('id')->on('jurusan')
                  ->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropForeign(['jurusan_id']);
            $table->foreign('jurusan_id')->references('id')->on('kategori_prestasi')
                  ->onDelete('set null')->onUpdate('cascade');
        });
    }
};
