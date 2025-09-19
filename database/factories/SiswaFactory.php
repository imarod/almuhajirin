<?php

namespace Database\Factories;

use App\Models\OrangTua;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Siswa;
use App\Models\User;

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

    private static $emails = [
        'dyahrodiyah1708@gmail.com',
        'thecasemb@gmail.com',
        'rodhiyatimardhiyyah@gmail.com',
        'testcode2703@gmail.com'
    ];

    public function definition(): array
    {
        $gender = fake()->randomElement(['Laki-laki', 'Perempuan']);
        $email = array_shift(self::$emails);
        
        return [
            'user_id' => User::factory(),
            'orang_tua_id' => OrangTua::factory(),
            'nama' => fake()->name($gender === 'Laki-laki' ? 'male' : 'female'),
            'nisn' => fake()->unique()->numerify('##########'),
            'jenis_kelamin' => $gender,
            'tempat_lahir' => fake()->city(),
            'tanggal_lahir' => fake()->date('Y-m-d', '2010-01-01'),
            'alamat_siswa' => fake()->address(),
            'no_hp_siswa' => '+628' . fake()->numerify('##########'),
            'email_siswa' => $email, 
            'kategori_prestasi' => fake()->randomElement([
                null,
                'Hafidz Qur\'an 1-3 Juz',
                'Peringkat 1-5',
                'Prestasi Non Akademik Tingkat Kabupaten',
            ]),
        ];
    }
}
