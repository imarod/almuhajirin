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
    public $status;

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
                    $this->status = $pendaftaran->showStatusPendaftar();

                    if ($this->status === 'Diterima') {
                        $this->message = "Selamat, pendaftaran Anda Diterima!";
                    } elseif ($this->status === 'Ditolak') {
                        $this->message = "Mohon maaf, pendaftaran Anda Ditolak.";
                    } elseif ($this->status === 'Diproses') {
                        $this->message = "Pendaftaran Anda sedang diproses. Silakan cek status pendaftaran secara berkala.";
                    }else {
                        $this->status = 'Dikirim';
                        $this->message = "Pendaftaran Siswa Baru Berhasil Dikirim.";
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
