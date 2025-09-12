<?php

namespace Database\Seeders;

use App\Models\ManajemenJadwalPpdb;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\Siswa;

class JadwalPpdbSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        // Tentukan tahun ajaran awal secara acak (misal: antara 2010 hingga 5 tahun yang lalu dari tahun sekarang)
        $startYear = fake()->numberBetween(2010, Carbon::now()->year - 5);
        $currentYear = Carbon::now()->year;

        for ($year = $startYear; $year <= $currentYear; $year++) {
            // Tahun ajaran dalam format "YYYY/YYYY+1"
            $thnAjaran = "{$year}/" . ($year + 1);

            // -- Gelombang 1 --
            $this->createJadwalWithPendaftaran($thnAjaran, 1, Carbon::create($year + 1, 1, 1), fake()->numberBetween(50, 100));

            // -- Gelombang 2 --
            $this->createJadwalWithPendaftaran($thnAjaran, 2, Carbon::create($year + 1, 6, 1), fake()->numberBetween(50, 100));
        }
    }

    /**
     * Fungsi helper untuk membuat jadwal dan pendaftar terkait.
     *
     * @param string $thnAjaran
     * @param int $gelombang
     * @param Carbon $tglMulai
     * @param int $kuota
     */
    private function createJadwalWithPendaftaran(string $thnAjaran, int $gelombang, Carbon $tglMulai, int $kuota): void
    {
        // Cek apakah jadwal dengan tahun ajaran dan gelombang ini sudah ada
        $existingJadwal = ManajemenJadwalPpdb::where('thn_ajaran', $thnAjaran)
            ->where('gelombang_pendaftaran', $gelombang)
            ->first();

        // Jika jadwal belum ada, buat jadwal dan pendaftar
        if (!$existingJadwal) {
            $tglBerakhir = (clone $tglMulai)->addMonth();
            $tglPengumuman = (clone $tglBerakhir)->addWeek();

            // Buat jadwal baru
            $jadwal = ManajemenJadwalPpdb::factory()->create([
                'thn_ajaran' => $thnAjaran,
                'gelombang_pendaftaran' => $gelombang,
                'kuota' => $kuota,
                'tgl_mulai' => $tglMulai,
                'tgl_berakhir' => $tglBerakhir,
                'tgl_pengumuman' => $tglPengumuman,
            ]);

            // Tentukan jumlah pendaftar yang akan dibuat secara acak
            $jumlahPendaftar = fake()->numberBetween(min(50, $kuota), min(100, $kuota));

            // Buat pendaftaran dummy untuk jadwal ini
            Pendaftaran::factory()->count($jumlahPendaftar)->create([
                'jadwal_id' => $jadwal->id,
                'status_verifikasi' => fake()->randomElement(['Dikirim', 'Diterima', 'Ditolak']),
            ]);
        }
    }
}