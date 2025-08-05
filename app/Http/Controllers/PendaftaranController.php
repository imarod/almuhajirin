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
        return view('formulir-siswa');
    }
    public function store(Request $request)
    {

        $request->validate([
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
        ], [
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
            'kategori_prestasi.required' => 'Kategori prestasi harus diisi jika ada',
            
        ]);
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
