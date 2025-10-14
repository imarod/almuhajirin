<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Jurusan;

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

        $jurusanAktifAda = Jurusan::active()->exists();

        $jurusanRule = $jurusanAktifAda
            ? ['required', 'exists:jurusan,id,is_active,1']
            : ['nullable', 'exists:jurusan,id,is_active,1'];
        $siswaId = Auth::id();
        return [
            'nama' => 'required',
            'nisn' => [
                'required',
                'numeric',
                Rule::unique('siswa', 'nisn')->ignore($siswaId)->whereNull('deleted_at'),
            ],
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            "tanggal_lahir" => 'required|date',
            'alamat_siswa' => 'required',
            'no_hp_siswa' => 'required',
            'email_siswa' => 'required|email|string|max:255',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'alamat_ortu' => 'required',
            'no_hp_ortu' => 'required',
            'kk' => 'required|file|mimes:pdf|max:1024',
            'ijazah' => 'required|file|mimes:pdf|max:1024',
            'piagam' => 'nullable|file|mimes:pdf|max:1024|required_with:kategori_prestasi',
            'jurusan_id' => $jurusanRule,
            //tabmbahkan required kalau wajib ada piagam
            'kategori_prestasi' => 'nullable|array',
            'kategori_prestasi.*' => 'integer|exists:kategori_prestasi,id',
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
            'kk.required' => 'File KK harus diunggah',
            'kk.file' => 'File KK harus berupa file',
            'kk.mimes' => 'File KK harus berupa file dengan format PDF',
            'kk.max' => 'Ukuran file KK tidak boleh melebihi 1 MB',
            'ijazah.required' => 'File ijazah harus diunggah',
            'ijazah.file' => 'File ijazah harus berupa file',
            'ijazah.mimes' => 'File ijazah harus berupa file dengan format PDF',
            'ijazah.max' => 'Ukuran file ijazah tidak boleh melebihi 1 MB',
            // 'piagam.required_with' => 'File piagam harus diunggah jika kategori prestasi diisi',
            'piagam.file' => 'File piagam harus berupa file',
            'piagam.mimes' => 'File piagam harus berupa file dengan format PDF',
            'piagam.max' => 'Ukuran file piagam tidak boleh melebihi 1 MB',
            'piagam.required_with' => 'Kategori prestasi harus dipilih jika piagam diunggah.',
            'kategori_prestasi.*.exists' => 'Salah satu kategori prestasi yang dipilih tidak ditemukan.',
            'jurusan_id.required' => 'Silakan pilih jurusan.',
            'jurusan_id.exists' => 'Pilihan jurusan tidak valid atau sudah tidak aktif.',
        ];
    }
}
