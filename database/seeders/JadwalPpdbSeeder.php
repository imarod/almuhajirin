<?php

namespace Database\Seeders;

use App\Models\ManajemenJadwalPpdb;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Pendaftaran;

class JadwalPpdbSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        $startYear = now()->year - 5;
        $currentYear = Carbon::now()->year;

        for ($year = $startYear; $year <= $currentYear; $year++) {
            // Tahun ajaran dalam format "YYYY/YYYY+1"
            $thnAjaran = "{$year}/" . ($year + 1);
            $kuota = fake()->numberBetween(2, 7);

            $tglMulaiGel1 = Carbon::create($year, 1, 1);
            $this->createJadwalWithPendaftaran($thnAjaran, 1, $tglMulaiGel1, $kuota, 30);

            // --- Gelombang 2 ---
            $tglMulaiGel2 = Carbon::create($year, 3, 1);
            $this->createJadwalWithPendaftaran($thnAjaran, 2, $tglMulaiGel2, $kuota, 30);
        }
    }


    private function createJadwalWithPendaftaran(string $thnAjaran, int $gelombang, Carbon $tglMulai, int $kuota, int $durationDays): void
    {
        // Cek apakah jadwal dengan tahun ajaran dan gelombang ini sudah ada
        $existingJadwal = ManajemenJadwalPpdb::where('thn_ajaran', $thnAjaran)
            ->where('gelombang_pendaftaran', $gelombang)
            ->first();

        if ($existingJadwal) {
            return;
        }

        $tglBerakhir = (clone $tglMulai)->addDays($durationDays - 1);
        $tglPengumuman = (clone $tglBerakhir)->addWeek();

        // 2. Cek OVERLAP:
        $isOverlapping = ManajemenJadwalPpdb::query()
            ->overlapse($tglMulai, $tglBerakhir)
            ->exists();

        // Buat jadwal baru
        if (!$isOverlapping) {            
            $jadwal = ManajemenJadwalPpdb::factory()->create([
                'thn_ajaran' => $thnAjaran,
                'gelombang_pendaftaran' => $gelombang,
                'kuota' => $kuota,
                'tgl_mulai' => $tglMulai,
                'tgl_berakhir' => $tglBerakhir,
                'tgl_pengumuman' => $tglPengumuman,
            ]);

            // Tentukan jumlah pendaftar yang akan dibuat secara acak
            $jumlahPendaftar = fake()->numberBetween(min(2, $kuota), min(7, $kuota));

            Pendaftaran::factory()->count($jumlahPendaftar)->create([
                'jadwal_id' => $jadwal->id,
                'status_verifikasi' => fake()->randomElement(['Dikirim']),
            ]);
        }
    }
}
