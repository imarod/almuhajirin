<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManajemenJadwalPpdb;
use App\Http\Requests\StoreJadwalPpdbRequest;
use App\Http\Requests\UpdateJadwalPpdbRequest;
use Exception;

class ManajemenJadwalPpdbController extends Controller
{
    public function index()
    {
        $jadwals = ManajemenJadwalPpdb::orderBy('created_at', 'desc')->get();

        return view('admin.manajemen-jadwal-ppdb', compact('jadwals'));
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

            return redirect()->route('admin.manajemen-jadwal-ppdb')->with('success', 'Jadwal PPDB berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Penyimpanan jadwal gagal. ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $jadwal = ManajemenJadwalPpdb::findOrFail($id);
        $jadwals = ManajemenJadwalPpdb::orderBy('created_at', 'desc')->get();
        return view('admin.manajemen-jadwal-ppdb', compact('jadwal', 'jadwals'));
    }

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

            return redirect()->route('admin.manajemen-jadwal-ppdb')->with('success', 'Jadwal PPDB berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Pembaruan jadwal gagal. ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $jadwal = ManajemenJadwalPpdb::findOrFail($id);
            $jadwal->delete();

            return redirect()->route('admin.manajemen-jadwal-ppdb')->with('success', 'Jadwal PPDB berhasil Dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Jadwal tidak berhasil dihapus' . $e->getMessage());
        }        
    }
}
