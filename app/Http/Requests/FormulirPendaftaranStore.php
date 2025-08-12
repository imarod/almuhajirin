<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FormulirPendaftaranStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required',
            'nisn' => 'required|unique:siswa,nisn',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            "tanggal_lahir" => 'required|date',
            'alamat_siswa' => 'required',
            'no_hp_siswa' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'alamat_ortu' => 'required',
            'no_hp_ortu' => 'required',
            'kk' => 'required|file|mimes:jpg,jpeg,png,pdf',
            'ijazah' => 'required|file|mimes:pdf',
            'piagam' => 'nullable|file|mimes:pdf',
            'kategori_prestasi' => 'nullable|array',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama lengkap harus diisi',
            'nisn.required' => 'NISN harus diisi',
            'nisn.unique' => 'NISN sudah terdaftar',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih',
            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'alamat_siswa.required' => 'Alamat harus diisi',
            'no_hp_siswa.required' => 'Nomor HP siswa harus diisi',
            'nama_ayah.required' => 'Nama ayah harus diisi',
            'nama_ibu.required' => 'Nama ibu harus diisi',
            'alamat_ortu.required' => 'Alamat orang tua harus diisi',
            'no_hp_ortu.required' => 'Nomor HP orang tua harus diisi',
            'kk.required' => 'File KK harus diunggah',
            'kk.file' => 'File KK harus berupa file',
            'kk.mimes' => 'File KK harus berupa file dengan format PDF',
            'ijazah.required' => 'File ijazah harus diunggah',
            'ijazah.file' => 'File ijazah harus berupa file',
            'ijazah.mimes' => 'File ijazah harus berupa file dengan format PDF',
            'piagam.file' => 'File piagam harus berupa file',
            'piagam.mimes' => 'File piagam harus berupa file dengan format PDF',
        ];
    }
}
