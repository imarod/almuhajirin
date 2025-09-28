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
                 Rule::unique('siswa', 'nisn')->ignore($siswaId)->whereNull('deleted_at'),
            ],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat_siswa' => 'required|string',
            'no_hp_siswa' => 'required|string|max:255',
            'email_siswa' => 'required|email|string|max:255',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'alamat_ortu' => 'required|string',
            'no_hp_ortu' => 'required|string|max:255',
            'kk' => 'nullable|file|mimes:pdf|max:1024',
            'ijazah' => 'nullable|file|mimes:pdf|max:1024',
            'piagam' => 'nullable|file|mimes:pdf|max:1024|required_with:kategori_prestasi',
            'kategori_prestasi' => 'nullable|array',
            'kategori_prestasi.*' => 'string|max:255|required_with:piagam',
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
            'email_siswa.required' => 'Email harus diisi',
            'email_siswa.email' => 'Format email tidak valid',
            'email_siswa.string' => 'Email harus berupa string',
            'email_siswa.max' => 'Panjang email maksimal 255 karakter',
            'nama_ayah.required' => 'Nama ayah harus diisi',
            'nama_ibu.required' => 'Nama ibu harus diisi',
            'alamat_ortu.required' => 'Alamat orang tua harus diisi',
            'no_hp_ortu.required' => 'Nomor HP orang tua harus diisi',
            'kk.file' => 'File KK harus berupa file',
            'kk.mimes' => 'File KK harus berupa file dengan format PDF',
            'kk.max' => 'Ukuran file KK tidak boleh melebihi 1 MB',
            'ijazah.file' => 'File ijazah harus berupa file',
            'ijazah.mimes' => 'File ijazah harus berupa file dengan format PDF',
            'ijazah.max' => 'Ukuran file ijazah tidak boleh melebihi 1 MB',
            'piagam.file' => 'File piagam harus berupa file',
            'piagam.mimes' => 'File piagam harus berupa file dengan format PDF',
            'piagam.max' => 'Ukuran file piagam tidak boleh melebihi 1 MB',
        ];
    }
}
