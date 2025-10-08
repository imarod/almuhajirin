<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\ManajemenJadwalPpdb;
use App\Models\KategoriPrestasi; // <<< TAMBAHKAN MODEL INI

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
        // 1. Ambil semua ID KategoriPrestasi yang aktif dan tidak terhapus (SoftDeletes)
        // Metode `active()` sudah didefinisikan di KategoriPrestasi.php
        $activePrestasiIds = KategoriPrestasi::active()->pluck('id')->toArray();
        
        // 2. Gabungkan array ID dengan nilai null
        // Ini memungkinkan kolom 'kategori_prestasi_id' diisi null (tidak ada prestasi)
        $prestasiOptions = array_merge([null], $activePrestasiIds);

        return [
            'siswa_id' => Siswa::factory(),
            // Anda mungkin juga perlu menambahkan 'jadwal_id' di sini, contoh:
            // 'jadwal_id' => ManajemenJadwalPpdb::inRandomOrder()->first()->id ?? null,
            'kk' => 'dummy_dokumen/kk.pdf',
            'ijazah'=>'dummy_dokumen/ijazah.pdf',
            'piagam'=> 'dummy_dokumen/piagam.pdf',
            
            // Kolom baru/diperbaiki: Menggunakan ID Kategori Prestasi
            'kategori_prestasi_id' => fake()->randomElement($prestasiOptions),
            
            'status_verifikasi' => fake()->randomElement((['Dikirim'])),
            'status_aktual' => null, 
            'is_announced' => false,
            'pesan_whatsapp' => false,
            
            // Kolom 'kategori_prestasi' (yang berisi string) dari factory lama telah dihapus
        ];
    }
}