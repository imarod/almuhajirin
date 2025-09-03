<?php

namespace App\Http\Requests;

use App\Models\ManajemenJadwalPpdb;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class StoreJadwalPpdbRequest extends FormRequest
{

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
        $jadwalId = $this->route('id');
        return [
            'tahun_awal' => 'required|integer|digits:4|min:2000|max:2050',
            'tahun_akhir' => 'required|integer|digits:4|min:2000|max:2050|after:tahun_awal',
            'gelombang_pendaftaran' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('jadwal_ppdb')->where(function ($query) {
                    return $query->where('thn_ajaran', $this->input('tahun_awal') . '/' . $this->input('tahun_akhir'))
                                 ->whereNull('deleted_at');
                })->ignore($jadwalId),
            ],
            'kuota' => 'required|integer|min:1',
           'tgl_mulai' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $tgl_berakhir = $this->input('tgl_berakhir');
                    $activeJadwal = ManajemenJadwalPpdb::active()->where('id', '!=', $this->route('id'))
                                     ->whereBetween('tgl_mulai', [$value, $tgl_berakhir])
                                     ->orWhereBetween('tgl_berakhir', [$value, $tgl_berakhir])
                                     ->count();
                    
                    if($activeJadwal > 0) {
                        $fail('Tidak dapat membuat jadwal. Terdapat jadwal aktif di tanggal tersebut');
                    }
                    $tahunMulai = (int) Carbon::parse($value)->year;
                    if ($tahunMulai != (int) $this->input('tahun_awal')) {
                        $fail('Tahun pada tanggal mulai pendaftaran tidak sesuai dengan Tahun Ajaran yang ditentukan.');
                    }
                },
            ],
            'tgl_berakhir' => 'required|date|after_or_equal:tgl_mulai',
            'tgl_pengumuman' => 'required|date|after_or_equal:tgl_berakhir',
        ];
    }

    public function messages(): array
    {
        return [
            'tahun_awal.required' => 'Tahun awal ajaran harus diisi.',
            'tahun_awal.digits' => 'Tahun awal harus 4 digit.',
            'tahun_awal.integer' => 'Tahun awal harus berupa angka.',
            'tahun_akhir.required'  => 'Tahun akhir ajaran harus diisi.',
            'tahun_akhir.digits' => 'Tahun akhir harus 4 digit.',
            'tahun_akhir.integer' => 'Tahun akhir harus berupa angka.',
            'tahun_akhir.after' => 'Tahun akhir harus setelah tahun awal.',
            'gelombang_pendaftaran.required' => 'Gelombang pendaftaran harus diisi',
            'kuota.required' => 'Kuota harus diisi',
            'kuota.integer' => 'Kuota harus berupa angka',
            'kuota.min' => 'Kuota minimal harus 1',
            'tgl_mulai.required' => 'Tanggal mulai harus diisi',
            'tgl_mulai.after_or_equal' => 'Tanggal mulai harus hari ini atau setelahnya',
            'tgl_berakhir.required' => 'Tanggal berakhir harus diisi',
            'tgl_berakhir.after_or_equal' => 'Tanggal berakhir harus setelah tanggal mulai',
            'tgl_pengumuman.required' => 'Tanggal pengumuman harus diisi',
            'tgl_pengumuman.after_or_equal' => 'Tanggal pengumuman harus setelah tanggal berakhir',
        ];
    }
}
