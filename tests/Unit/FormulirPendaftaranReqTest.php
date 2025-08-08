<?php

namespace Tests\Unit;

use Tests\TestCase ;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\FormulirPendaftaranStore as FormulirPendaftaranReq;

class FormulirPendaftaranReqTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_fails_if_required_fields_are_missing(): void
    {
        $request = new FormulirPendaftaranReq();
        $validator = validator::make([], $request->rules());
        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('nama', $validator->errors()->messages());
        $this->assertArrayHasKey('nisn', $validator->errors()->messages());
        $this->assertArrayHasKey('jenis_kelamin', $validator->errors()->messages());
        $this->assertArrayHasKey('tempat_lahir', $validator->errors()->messages());
        $this->assertArrayHasKey('tanggal_lahir', $validator->errors()->messages());
        $this->assertArrayHasKey('alamat_siswa', $validator->errors()->messages());
        $this->assertArrayHasKey('no_hp_siswa', $validator->errors()->messages());
        $this->assertArrayHasKey('nama_ayah', $validator->errors()->messages());
        $this->assertArrayHasKey('nama_ibu', $validator->errors()->messages());
        $this->assertArrayHasKey('alamat_ortu', $validator->errors()->messages());
        $this->assertArrayHasKey('no_hp_ortu', $validator->errors()->messages());
        $this->assertArrayHasKey('kk', $validator->errors()->messages());
        $this->assertArrayHasKey('ijazah', $validator->errors()->messages());
    }
    public function test_passes_with_valid_data(){
        $validData= [
            'nama' => 'John Doe',
            'nisn' => '1234567890',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2000-01-01',
            'alamat_siswa' => 'Jl. Contoh No. 1',
            'no_hp_siswa' => '08123456789',
            'nama_ayah' => 'Budi Doe',
            'nama_ibu' => 'Siti Doe',
            'alamat_ortu' => 'Jl. Contoh No. 2',
            'no_hp_ortu' => '08234567890',
            'kk' => UploadedFile::fake()->create('kk.pdf', 100, 'application/pdf'),
            'ijazah' => UploadedFile::fake()->create('ijazah.pdf', 100, 'application/pdf'),
            'piagam' => UploadedFile::fake()->create('piagam.pdf', 100, 'application/pdf'),
            'kategori_prestasi' => []
        ];
        $request = new FormulirPendaftaranReq();
        $validator = Validator::make($validData, $request->rules());
        $this->assertFalse($validator->fails());
    }
}
