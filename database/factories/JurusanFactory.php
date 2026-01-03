<?php

namespace Database\Factories;

use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jurusan>
 */
class JurusanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Jurusan::class;
    public function definition(): array
    {

        $daftarJurusan = [
            'Teknik Komputer dan Jaringan',
            'Rekayasa Perangkat Lunak',
            'Multimedia',
            'Akuntansi',
            'Administrasi Perkantoran',
            'Pemasaran',
            'Bisnis Daring dan Pemasaran',
            'Otomatisasi dan Tata Kelola Perkantoran'
        ];
        return [
            'nama_jurusan' => fake()->unique()->randomElement($daftarJurusan),
            'is_active' => true,
        ];
    }
}
