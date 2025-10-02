<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;
use App\Models\ManajemenJadwalPpdb;
use Carbon\Carbon;

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jadwalAktif = ManajemenJadwalPpdb::active()->first();
        if (!$jadwalAktif) {
            $currentYear = Carbon::now()->year;
            $thnAjaran = "{$currentYear}/" . ($currentYear + 1);

            $existingGelombang = ManajemenJadwalPpdb::where('thn_ajaran', $thnAjaran)
                ->pluck('gelombang_pendaftaran')
                ->toArray();

            $newGelombang = 1;
            if (!in_array(1, $existingGelombang)) {
                $newGelombang = 1;
            } elseif (!in_array(2, $existingGelombang)) {
                $newGelombang = 2;
            } else {
                $thnAjaran = ($currentYear + 1) . '/' . ($currentYear + 2);
                $newGelombang = 1;
            }

            $jadwalAktif = ManajemenJadwalPpdb::factory()->create([
                'thn_ajaran' => $thnAjaran,
                'gelombang_pendaftaran' => $newGelombang,
                'tgl_mulai' => Carbon::now()->subDays(5),
                'tgl_berakhir' => Carbon::now()->addDays(5),
            ]);
        }

        Pendaftaran::factory()->count(100)->create([
            'jadwal_id' => $jadwalAktif->id,
            'status_verifikasi' => 'Dikirim',
        ]);
    }
}
