<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\OrangTua;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateFormulirRequest;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function listPendaftar()
    {
        $userId = Auth::id();

        $pendaftarans = Pendaftaran::with('siswa')
            ->whereHas('siswa', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();
        return view('siswa.ajuan-pendaftaran', compact('pendaftarans'));
    }

    public function edit($id)
    {
        $pendaftaran = Pendaftaran::with(['siswa.orangTua'])->findOrFail($id);
        return view('siswa.formulir-siswa', compact('pendaftaran'));
    }

    public function update(UpdateFormulirRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $pendaftaran = Pendaftaran::with(['siswa.orangTua'])->findOrFail($id);

            // Update data Orang Tua
            $pendaftaran->siswa->orangTua->update([
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'alamat_ortu' => $request->alamat_ortu,
                'no_hp_ortu' => $request->no_hp_ortu,
            ]);

            $pendaftaran->siswa->update([
                'nama' => $request->nama,
                'nisn' => $request->nisn,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat_siswa' => $request->alamat_siswa,
                'no_hp_siswa' => $request->no_hp_siswa,
                'kategori_prestasi' => $request->kategori_prestasi ? implode(', ', $request->kategori_prestasi) : null,
            ]);

            $dataPendaftaran = [
                'status_verifikasi' => 'Dikirim',
            ];

            if ($request->hasFile('kk')) {
                $dataPendaftaran['kk'] = $request->file('kk')->store('dokumen', 'public');
            }
            if ($request->hasFile('ijazah')) {
                $dataPendaftaran['ijazah'] = $request->file('ijazah')->store('dokumen', 'public');
            }
            if ($request->hasFile('piagam')) {
                $dataPendaftaran['piagam'] = $request->file('piagam')->store('dokumen', 'public');
            }

            $pendaftaran->update($dataPendaftaran);

            DB::commit();

            return redirect()->route('ajuan.pendaftaran')->with('success', 'Pendaftaran berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal memperbarui pendaftaran: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $pendaftaran = Pendaftaran::findOrFail($id);
            $siswa = $pendaftaran->siswa;

            if ($siswa) {
                $ortu = $siswa->orangTua;
                $pendaftaran->delete();
                $siswa->delete();

                if ($ortu) {
                    $ortu->delete();
                }
            } else {
                $pendaftaran->delete();
            }

            DB::commit();

            return response()->json(['success' => 'Data pendaftaran dan data terkait berhasil dihapus.']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Gagal menghapus data: ' . $e->getMessage()], 500);
        }
    }

      public function listCetakFormulir()
    {
        $userId = Auth::id();

        $daftarPendaftaran = Pendaftaran::with('siswa')
            ->whereHas('siswa', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();
        return view('siswa.list-cetak-formulir', compact('daftarPendaftaran'));
    }
    public function printPendaftaran($id)
    {
        $userId = Auth::id();
        $pendaftaran = Pendaftaran::with(['siswa.orangTua'])
        ->whereHas('siswa', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->findOrFail($id);

        $pdf = Pdf::loadView('siswa.cetak-formulir', compact('pendaftaran'));
        $namaFile = 'Formulir Pendaftaran_' . $pendaftaran->siswa->nama . '.pdf';
        return $pdf->download($namaFile);
    }
}
