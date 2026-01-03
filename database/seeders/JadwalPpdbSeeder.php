<?php

namespace Database\Seeders;

use App\Models\{ManajemenJadwalPpdb, Pendaftaran, Siswa, User, OrangTua, Jurusan};
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use JeroenNoten\LaravelAdminLte\View\Components\Widget\Card;

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

            for ($gel = 1; $gel <= 2; $gel++) {
                //Gel 1 Jan, Gel 2 Juni
                $month = ($gel == 1) ? 1 : 6;
                $tglMulai = Carbon::create($year, $month, 1);
                $tglBerakhir = (clone $tglMulai)->addDays(29);


                if (!ManajemenJadwalPpdb::overlapse($tglMulai, $tglBerakhir)->exists()) {
                    $jadwal = ManajemenJadwalPpdb::factory()->create([
                        'thn_ajaran' => $thnAjaran,
                        'gelombang_pendaftaran' => $gel,
                        'kuota' => rand(220, 350),
                        'tgl_mulai' => $tglMulai,
                        'tgl_berakhir' => $tglBerakhir,
                        'tgl_pengumuman' => (clone $tglBerakhir)->addWeek(),
                    ]);
                    $jumlahPendaftar = rand(100, $jadwal->kuota);
                    $this->createPendaftarLengkap($jadwal, $jumlahPendaftar);
                }
            }
        }
    }


    private function createPendaftarLengkap($jadwal, $count)
    {
        for ($i = 0; $i < $count; $i++) {
            $user = User::factory()->create();
            $ortu = OrangTua::factory()->create();
            $siswa = Siswa::factory()->create([
                'user_id' => $user->id,
                'orang_tua_id' => $ortu->id,
            ]);
            Pendaftaran::factory()->create([
                'siswa_id' => $siswa->id,
                'jadwal_id' => $jadwal->id,
            ]);
        }
    }
}
