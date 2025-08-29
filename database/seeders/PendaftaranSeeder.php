<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\ManajemenJadwalPpdb;
use Carbon\Carbon;
use App\Models\Siswa;

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jadwalAktif = ManajemenJadwalPpdb::active()->first();
        if(!$jadwalAktif) {
           $jadwalAktif = ManajemenJadwalPpdb::factory()->create();
        }

       Pendaftaran::factory()->count(100)->create([
            'jadwal_id' => $jadwalAktif->id,
            'status_verifikasi' => 'Dikirim',
        ]);
    }
}
