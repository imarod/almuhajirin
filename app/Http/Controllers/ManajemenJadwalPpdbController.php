<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManajemenJadwalPpdb;
use App\Http\Requests\StoreJadwalPpdbRequest;
use App\Http\Requests\UpdateJadwalPpdbRequest;
use Exception;
use Illuminate\Support\Facades\DB;


class ManajemenJadwalPpdbController extends Controller
{
    public function index()
    {
        $jadwals = ManajemenJadwalPpdb::orderBy('created_at', 'desc')->get();
        $activeJadwal = ManajemenJadwalPpdb::active()->first();

        return view('admin.manajemen-jadwal-ppdb', compact('jadwals', 'activeJadwal'));
    }
    public function store(StoreJadwalPpdbRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $tahunAjaran = $validatedData['tahun_awal'] . '/' . $validatedData['tahun_akhir'];

            ManajemenJadwalPpdb::create([
                'thn_ajaran' => $tahunAjaran,
                'gelombang_pendaftaran' => $validatedData['gelombang_pendaftaran'],
                'kuota' => $validatedData['kuota'],
                'tgl_mulai' => $validatedData['tgl_mulai'],
                'tgl_berakhir' => $validatedData['tgl_berakhir'],
                'tgl_pengumuman' => $validatedData['tgl_pengumuman'],
            ]);

            return redirect()->to(route('admin.manajemen-jadwal-ppdb') . '#history')->with('success', 'Jadwal PPDB berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Penyimpanan jadwal gagal. ' . $e->getMessage());
        }
    }
    // menampilkan form edit
    public function edit($id)
    {
        $jadwal = ManajemenJadwalPpdb::findOrFail($id);
        $jadwals = ManajemenJadwalPpdb::orderBy('created_at', 'desc')->get();
        $jadwalAktif = ManajemenJadwalPpdb::active()->first();
        return view('admin.manajemen-jadwal-ppdb', compact('jadwal', 'jadwals', 'jadwalAktif'));
    }
    // menyimpan perubahan di form edit
    public function update(UpdateJadwalPpdbRequest $request, $id)
    {
        try {
            $jadwal = ManajemenJadwalPpdb::findOrFail($id);
            $validatedData = $request->validated();
            $tahunAjaran = $validatedData['tahun_awal'] . '/' . $validatedData['tahun_akhir'];

            $jadwal->update([
                'thn_ajaran' => $tahunAjaran,
                'gelombang_pendaftaran' => $validatedData['gelombang_pendaftaran'],
                'kuota' => $validatedData['kuota'],
                'tgl_mulai' => $validatedData['tgl_mulai'],
                'tgl_berakhir' => $validatedData['tgl_berakhir'],
                'tgl_pengumuman' => $validatedData['tgl_pengumuman'],
            ]);

            return redirect()->to(route('admin.manajemen-jadwal-ppdb') . '#history')->with('success', 'Jadwal PPDB berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Pembaruan jadwal gagal. ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $jadwal = ManajemenJadwalPpdb::findOrFail($id);

            foreach ($jadwal->pendaftaran as $pendaftaran) {
                $siswa = $pendaftaran->siswa;
                if($siswa) {
                    $ortu = $siswa->orangTua;
                    $pendaftaran->delete();
                    $siswa->delete();
                    if($ortu) {
                        $ortu->delete();
                    }
                }
            }
            $jadwal->delete();

            DB::commit();

            return redirect()->to(route('admin.manajemen-jadwal-ppdb') . '#history')->with('success', 'Jadwal PPDB berhasil Dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Jadwal tidak berhasil dihapus' . $e->getMessage());
        }        
    }
}
