<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\OrangTua;
use App\Models\User;
use App\Traits\LoginTokenGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateFormulirRequest;
use App\Models\ManajemenJadwalPpdb;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\FormulirPendaftaranStore;
use App\Mail\SubmittedMailNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class PendaftaranController extends Controller
{
    use LoginTokenGenerator;

    public function index($id = null)
    {
        $statusPendaftaran = 'closed';
        $message = "Pendaftaran belum dibuka/sudah ditutup. Silahkan cek kembali jadwal pendaftaran.";
        $jadwalAktif = ManajemenJadwalPpdb::active()->first();
        $pendaftaran = null;
        $jumlahPendaftar = 0;
        // Jika ID pendaftaran diberikan, coba cari data pendaftaran untuk mode edit
        if ($id) {
            try {
                $pendaftaran = Pendaftaran::with(['siswa.orangTua'])->whereHas('siswa', function ($query) {
                    $query->where('user_id', Auth::id());
                })->findOrFail($id);

                //tidak boleh edit kalau pendaftaran sudah diproses atau jadwal selesai
                $jadwalSelesai = $pendaftaran->jadwal && Carbon::parse($pendaftaran->jadwal->tgl_berakhir)->isPast();
                if ($pendaftaran->status_aktual !== null || $jadwalSelesai) {
                    Session::flash('error', 'Formulir pendaftaran tidak dapat diubah karena sudah diproses atau jadwal sudah ditutup.');
                    return redirect()->route('ajuan.pendaftaran');
                }

                $statusPendaftaran = 'open';
                $message = "Anda sedang mengedit formulir pendaftaran.";
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                $message = "Data pendaftaran tidak ditemukan atau tidak memiliki akses.";
            }
        } else {
            // 'create' (pendaftaran baru)
            if (Auth::user()->siswa()->whereNull('deleted_at')->exists()) {
                $message = "Anda sudah terdaftar. Anda hanya bisa melakukan satu pendaftaran.";
            } elseif (!$jadwalAktif) {
                $message = "Formulir pendaftaran tidak tersedia saat ini.";
            } else {
                // Cek kuota pendaftar                
                $jumlahPendaftar = Pendaftaran::where('jadwal_id', $jadwalAktif->id)->count();
                if ($jadwalAktif->kuota <= $jumlahPendaftar) {
                    $message = "Pendaftaran telah DITUTUP. Kuota pendaftar sudah penuh.";
                } else {
                    //pendaftaran baru
                    $statusPendaftaran = 'open';
                    $message = "Pendaftaran periode " . $jadwalAktif->thn_ajaran . " Gelombang " . $jadwalAktif->gelombang_pendaftaran . "Telah dibuka";
                }
            }
        }

        return view('siswa.formulir-siswa', compact('statusPendaftaran', 'message', 'jadwalAktif', 'pendaftaran', 'jumlahPendaftar'));
    }
    public function store(FormulirPendaftaranStore $request)
    {
        $jadwalAktif = ManajemenJadwalPpdb::active()->first();

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
                'email_siswa' => $request->email_siswa,
                'orang_tua_id' => $ortu->id,
                'kategori_prestasi' => $request->kategori_prestasi ? implode(', ', $request->kategori_prestasi) : null,
            ]);
            $kk = $request->file('kk')?->store('dokumen', 'public');
            $ijazah = $request->file('ijazah')?->store('dokumen', 'public');
            $piagam = $request->file('piagam')?->store('dokumen', 'public');

            $pendaftaran = Pendaftaran::create([
                'siswa_id' => $siswa->id,
                'jadwal_id' => $jadwalAktif->id,
                'kk' => $kk,
                'ijazah' => $ijazah,
                'piagam' => $piagam,
                'status_verifikasi' => 'Dikirim',
                'kategori_prestasi' => $request->kategori_prestasi ? implode(', ', $request->kategori_prestasi) : null,
            ]);

            $user = User::findOrFail($siswa->user_id);
            $plainToken = $this->generateLoginToken($user);

            Mail::to($siswa->email_siswa)->queue(new SubmittedMailNotification($pendaftaran, $siswa, $plainToken));
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

    public function update(UpdateFormulirRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $pendaftaran = Pendaftaran::with(['siswa.orangTua'])->findOrFail($id);

            //tidak boleh edit kalau pendaftaran sudah diproses
            $jadwalSelesai = $pendaftaran->jadwal && Carbon::parse($pendaftaran->jadwal->tgl_berakhir)->isPast();
            if ($pendaftaran->status_aktual !== null || $jadwalSelesai) {
                DB::rollBack();
                return back()->with('error', 'Gagal memperbarui pendaftaran: Formulir sudah diproses dan tidak dapat diubah diproses atau jadwal sudah ditutup.');
            }

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
                'email_siswa' => $request->email_siswa,
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

            return redirect()->route('ajuan.pendaftaran')->with('success', 'Pendaftaran berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('ajuan.pendaftaran')->with('error', 'Gagal menghapus pendaftaran: ' . $e->getMessage());
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
