<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\ManajemenJadwalPpdb;
use App\Models\Pendaftaran;
use App\Models\Siswa;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class JadwalPpdbAktif extends Component
{
    /**
     * Create a new component instance.
     */
    public $jadwalAktif;
    public $message;
    public $isRegistered;
    public $statusPendaftaran;

    public function __construct()
    {
        $this->jadwalAktif = ManajemenJadwalPpdb::active()->first();
        $this->isRegistered = false;

        if (Auth::check()) {
            $siswa = Auth::user()->siswa()->whereNull('deleted_at')->first();
            if ($siswa) {
                $pendaftaran = Pendaftaran::where('siswa_id', $siswa->id)->first();
                if ($pendaftaran) {
                    $this->isRegistered = true;
                    $jadwal = $pendaftaran->jadwal;

                    // Logika Baru: Prioritaskan status 'Diproses' atau hasil final
                    if ($pendaftaran->status_aktual === null) {
                        // Kondisi 1: Pendaftaran baru, belum diproses admin
                        $this->statusPendaftaran = 'baru';
                        $this->message = "Pendaftaran Siswa Baru Berhasil Dikirim.";
                    } else {
                        // Kondisi 2: Pendaftaran sudah diproses oleh admin
                        // Cek apakah tanggal pengumuman sudah tiba atau lewat
                        if ($jadwal && $jadwal->tgl_pengumuman && ($jadwal->tgl_pengumuman->isToday() || $jadwal->tgl_pengumuman->isPast())) {
                            if ($pendaftaran->status_aktual === 'Diterima') {
                                $this->statusPendaftaran = 'diterima';
                                $this->message = "Selamat, pendaftaran Anda *Diterima*!";
                            } else { // status_aktual === 'Ditolak'
                                $this->statusPendaftaran = 'ditolak';
                                $this->message = "Mohon maaf, pendaftaran Anda *Ditolak*.";
                            }
                        } else {
                            // Tanggal pengumuman belum tiba, tapi status sudah tidak null
                            $this->statusPendaftaran = 'diproses';
                            $this->message = "Pendaftaran Anda sedang diproses. Silakan cek status pendaftaran secara berkala.";
                        }
                    }
                }
            }
        }

        // Logika untuk Admin atau pengguna yang belum terdaftar
        if (!$this->isRegistered) {
            if (!$this->jadwalAktif) {
                $this->message = "Pendaftaran belum dibuka atau sudah ditutup. ";
            } else {
                $jumlahPendaftar = Pendaftaran::where('jadwal_id', $this->jadwalAktif->id)->count();

                if ($jumlahPendaftar >= $this->jadwalAktif->kuota) {
                    $this->message = "Pendaftaran telah DITUTUP. Kuota pendaftar sudah penuh.";
                    $this->jadwalAktif = null;
                } else {
                    $this->message = "Pendaftaran Tahun Ajaran " . $this->jadwalAktif->thn_ajaran . " Gelombang " . $this->jadwalAktif->gelombang_pendaftaran . " Telah Dibuka";
                }
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.jadwal-ppdb-aktif');
    }
}
