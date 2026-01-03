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
        return [
            //default
            'thn_ajaran' => now()->year . '/' . (now()->year + 1),
            'gelombang_pendaftaran' =>  fake()->numberBetween(1, 2),
            'kuota' => fake()->numberBetween(250, 350),
            'tgl_mulai' => now(),
            'tgl_berakhir' => now()->addDays(30),
            'tgl_pengumuman' => now()->addDays(37),
        ];
    }
}
