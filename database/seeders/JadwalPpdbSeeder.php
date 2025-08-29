<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\ManajemenJadwalPpdb;

class JadwalPpdbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ManajemenJadwalPpdb::Factory()->create([
            'thn_ajaran' => '2025/2026',
            'gelombang_pendaftaran' => 1,
            'kuota' => 100,
            'tgl_mulai' => Carbon::now(),
            'tgl_berakhir' => Carbon::now()->addDays(25),
            'tgl_pengumuman' => Carbon::now()->addDays(20),
        ]);
    }
}
