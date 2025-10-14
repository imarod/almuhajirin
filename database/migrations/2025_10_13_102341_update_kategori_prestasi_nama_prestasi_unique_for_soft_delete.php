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
        Schema::table('kategori_prestasi', function(Blueprint $table) {
            $table->dropUnique(['nama_prestasi']);
            $table->unique(['nama_prestasi', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kategori_prestasi', function(Blueprint $table) {
            $table->dropUnique(['nama_prestasi', 'deleted_at']);
            $table->unique(['nama_prestasi']);
        });
    }
};
