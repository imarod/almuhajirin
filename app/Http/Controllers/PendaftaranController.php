<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\OrangTua;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    // Siswa
    public function index()
    {
        return view('siswa.formulir-siswa');
    }
    public function store(\App\Http\Requests\FormulirPendaftaranStore $request)
    {

       
        DB::beginTransaction();
        try {
            $ortu = OrangTua::create([
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'alamat_ortu' => $request->alamat_ortu,
                'no_hp_ortu' => $request->no_hp_ortu,
            ]);

            $siswa = Siswa::create([           
                'user_id' => Auth::id(),
                'nama' => $request->nama,
                'nisn' => $request->nisn,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat_siswa' => $request->alamat_siswa,
                'no_hp_siswa' => $request->no_hp_siswa,
                'orang_tua_id' => $ortu->id,
                'kategori_prestasi' => $request->kategori_prestasi ? implode(', ', $request->kategori_prestasi) : null,
            ]);
            $kk = $request->file('kk')?->store('dokumen', 'public');
            $ijazah = $request->file('ijazah')?->store('dokumen', 'public');
            $piagam = $request->file('piagam')?->store('dokumen', 'public');

            $pendaftaran = Pendaftaran::create([
                'siswa_id' => $siswa->id,
                'kk' => $kk,
                'ijazah' => $ijazah,
                'piagam' => $piagam,
                'status_verifikasi' => 'Dikirim',
                'kategori_prestasi' => $request->kategori_prestasi ? implode(', ', $request->kategori_prestasi) : null,
            ]);
            DB::commit();
            return redirect()->route('ajuan.pendaftaran')->with('success', 'Pendaftaran berhasil dikirim');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Pendaftaran gagal: ' . $e->getMessage());
        }
    }

    public function ajuanPendaftaran()
    {
        $userId = Auth::id();

        $pendaftarans = Pendaftaran::with('siswa')
            ->whereHas('siswa', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();
        return view('siswa.ajuan-pendaftaran', compact('pendaftarans'));
    }

    public function detailPendaftaran()
    {


        return view('detail-pendaftaran');
    }

    public function edit($id)
    {
        $pendaftaran = Pendaftaran::with(['siswa.orangTua'])->findOrFail($id);
        return view('formulir-siswa', compact('pendaftaran'));
    }

    public function update(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::with(['siswa.orangTua'])->findOrFail($id);
        $pendaftaran->siswa->update($request->only(['nama', 'nisn', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat_siswa', 'no_hp_siswa', 'kategori_prestasi']));
        $pendaftaran->siswa->orangTua->update($request->only(['nama_ayah', 'nama_ibu', 'alamat_ortu', 'no_hp_ortu']));
        $pendaftaran->update([
            'kk' => $request->file('kk') ? $request->file('kk')->store('dokumen', 'public') : $pendaftaran->kk,
            'ijazah' => $request->file('ijazah') ? $request->file('ijazah')->store('dokumen', 'public') : $pendaftaran->ijazah,
            'piagam' => $request->file('piagam') ? $request->file('piagam')->store('dokumen', 'public') : $pendaftaran->piagam,
        ]);
        return redirect()->route('formulir-siswa')->with('success', 'Pendaftaran berhasil diperbarui');
    }
}
