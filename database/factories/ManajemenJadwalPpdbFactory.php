<?php

namespace Database\Factories;

use App\Models\ManajemenJadwalPpdb;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ManajemenJadwalPpdbFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ManajemenJadwalPpdb::class;
    public function definition(): array
    {
        $tgl_mulai = fake()->dateTimeBetween('-1 week', '+1 week');
        $tgl_berakhir = Carbon::parse($tgl_mulai)->addDays(rand(5, 10));
        $tgl_pengumuman = Carbon::parse($tgl_berakhir)->addDays(rand(3, 5));

        return [
            'thn_ajaran' => now()->year . '/' . (now()->year + 1),
            'gelombang_pendaftaran' => fake()->numberBetween(1, 3),
            'kuota' => fake()->numberBetween(50, 200),
            'tgl_mulai' => $tgl_mulai,
            'tgl_berakhir' => $tgl_berakhir,
            'tgl_pengumuman' => $tgl_pengumuman,
        ];
    }
}
