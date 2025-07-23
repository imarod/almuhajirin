<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Siswa::class;
    public function definition(): array
    {
         return [
            'nama' => $this->faker->name,
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->date(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']), // Laki-laki / Perempuan
            'nisn' => $this->faker->unique()->numerify('##########'), // 10 digit acak
            'alamat_siswa' => $this->faker->address,
            'no_hp_siswa' => $this->faker->phoneNumber,
            'kategori_prestasi' => $this->faker->randomElement(['akademik', 'non-akademik', 'lainnya']),
        ];
    }
}
