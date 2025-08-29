<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\ManajemenJadwalPpdb;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pendaftaran>
 */
class PendaftaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Pendaftaran::class;
    public function definition(): array
    {
        return [
            'siswa_id' => Siswa::factory(),
            'kk' => 'dummy_dokumen/kk.pdf',
            'ijazah'=>'dummy_dokumen/ijazah.pdf',
            'piagam'=> 'dummy_dokumen/piagam.pdf',
            'status_verifikasi' => fake()->randomElement((['Dikirim'])),
            'status_aktual' => null, 
            'is_announced' => false,
            'pesan_whatsapp' => false,
        ];
    }
}
