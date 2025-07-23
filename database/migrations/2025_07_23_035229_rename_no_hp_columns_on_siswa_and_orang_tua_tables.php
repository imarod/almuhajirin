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
        Schema::table('siswa', function (Blueprint $table) {
            $table->renameColumn('no_hp', 'no_hp_siswa');
        });
        Schema::table('orang_tua', function (Blueprint $table) {
            $table->renameColumn('no_hp', 'no_hp_ortu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa', function(Blueprint $table){
            $table->renameColumn('no_hp_siswa', 'no_hp');
        });
        Schema::table('orang_tua', function(Blueprint $table){
            $table->renameColumn('no_hp_ortu', 'no_hp');
        });
    }
};
