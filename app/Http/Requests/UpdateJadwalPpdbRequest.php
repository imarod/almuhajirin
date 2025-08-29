<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\ManajemenJadwalPpdb;

class UpdateJadwalPpdbRequest extends FormRequest
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
        $jadwalId= $this->route('id');
        return [            
            'tahun_awal' => 'required|integer|digits:4|min:2000|max:2050',
            'tahun_akhir' => 'required|integer|digits:4|min:2000|max:2050|after:tahun_awal',
            'gelombang_pendaftaran' => 'required|integer|min:1',
            'kuota' => 'required|integer|min:1',
            'tgl_mulai' => [
                'required',
                'date',
                function($attribute, $value, $fail) use ($jadwalId) {
                    $tgl_berakhir = $this->input('tgl_berakhir');
                    $activeJadwal = ManajemenJadwalPpdb::overlapse($value, $tgl_berakhir, $jadwalId)->count(); 
                    if($activeJadwal > 0) {
                        $fail('Tidak dapat memperbarui jadwal. Terdapat jadwal yang masih berlangsung');
                    }
                },
            ],
            'tgl_berakhir' => 'required|date|after_or_equal:tgl_mulai',
            'tgl_pengumuman' => 'required|date|after_or_equal:tgl_berakhir',
        ];
    }
}
