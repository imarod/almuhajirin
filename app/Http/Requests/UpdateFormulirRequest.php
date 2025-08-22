<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFormulirRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       $pendaftaranId = $this->route('id'); 

        // Gunakan Pendaftaran::find() untuk mengambil model,
        // lalu ambil relasi 'siswa'
        $pendaftaran = \App\Models\Pendaftaran::find($pendaftaranId);
        $siswaId = $pendaftaran->siswa->id;

        return [
            'nama' => 'required|string|max:255',
            'nisn' => [
                'required',
                'numeric',
                Rule::unique('siswa', 'nisn')->ignore($siswaId),
            ],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat_siswa' => 'required|string',
            'no_hp_siswa' => 'required|string|max:255',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'alamat_ortu' => 'required|string',
            'no_hp_ortu' => 'required|string|max:255',
            'kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Nullable karena opsional saat update
            'ijazah' => 'nullable|file|mimes:pdf|max:2048', // Nullable karena opsional saat update
            'piagam' => 'nullable|file|mimes:pdf|max:2048', // Nullable karena opsional saat update
            'kategori_prestasi' => 'nullable|array',
            'kategori_prestasi.*' => 'string|max:255',
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
