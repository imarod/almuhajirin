<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\KategoriPrestasi;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KategoriPrestasi>
 */
class KategoriPrestasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = KategoriPrestasi::class;
    public function definition(): array
    {
        $prestasi = [
            'Juara OSN Matematika' => 'Potongan biaya gedung 50%',
            'Juara FLS2N' => 'Bebas biaya SPP 3 bulan',
            'Tahfidz Quran 5 Juz' => 'Beasiswa penuh sampai lulus',
            'Juara O2SN (Olahraga)' => 'Potongan biaya seragam',
            'Peringkat 1 Umum SMP' => 'Bebas biaya pendaftaran'
        ];
        $namaPrestasi = fake()->unique()->randomElement(array_keys($prestasi));
        
        return [
            'nama_prestasi'=> $namaPrestasi,
            'deskripsi' => $prestasi[$namaPrestasi],
            'is_active'=>true,
        ];
    }
}
