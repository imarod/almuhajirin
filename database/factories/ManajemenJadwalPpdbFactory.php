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
        $currentYear = now()->year;
        $thnAjaran = $currentYear . '/' . ($currentYear+1);

        $tgl_mulai = fake()->dateTimeBetween('-10 days', 'today');;
        $tgl_berakhir = Carbon::parse($tgl_mulai)->addDays(rand(5, 10));
        $tgl_pengumuman = Carbon::parse($tgl_berakhir)->addDays(rand(3, 7));

        return [
            'thn_ajaran' => $thnAjaran,
            'gelombang_pendaftaran' =>  fake()->numberBetween(1, 2),
            'kuota' => fake()->numberBetween(2, 7),
            'tgl_mulai' => $tgl_mulai,
            'tgl_berakhir' => $tgl_berakhir,
            'tgl_pengumuman' => $tgl_pengumuman,
        ];
    }
}
