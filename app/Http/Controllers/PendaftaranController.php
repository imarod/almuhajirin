<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\OrangTua;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nisn'=> 'required|unique:siswa,nisn',
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
            'ijazah' => 'required|file|mimes:jpg,jpeg,pdf',
            'piagam' => 'nullable|file|mimes:jpg,jpeg,pdf',
            'kategori_prestasi' => 'nullable|array',
        ]);
        DB::beginTransaction();
        try {
             $ortu = OrangTua::create([
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'alamat_ortu' => $request->alamat_ortu,
                'no_hp_ortu' => $request->no_hp_ortu,
            ]);

            // 2. Buat siswa dan hubungkan ke orang tua
            $siswa = Siswa::create([
                'nama' => $request->nama,
                'nisn' => $request->nisn,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat_siswa' => $request->alamat_siswa,
                'no_hp_siswa' => $request->no_hp_siswa,
                'orang_tua_id' => $ortu->id,
                'kategori_prestasi' => json_encode($request->kategori_prestasi),
            ]);

            // upload
            $kk = $request->file('kk')?->store('dokumen', 'public');
            $ijazah = $request->file('ijazah')?->store('dokumen', 'public');
            $piagam = $request->file('piagam')?->store('dokumen', 'public');

            Pendaftaran::create([
                'siswa_id' => $siswa->id,
                'kk' => $kk,
                'ijazah' => $ijazah,
                'piagam' => $piagam,
                'status_verifikasi' => 'Dikirim',
                'kategori_prestasi' => json_encode($request->kategori_prestasi),
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Pendaftaran berhasil dikirim');
        }catch(\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Pendaftaran gagal: ' . $e->getMessage());
        }
    }
}
