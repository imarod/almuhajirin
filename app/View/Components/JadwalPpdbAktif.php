<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\ManajemenJadwalPpdb;
use App\Models\Pendaftaran;

use Illuminate\Support\Facades\Auth;

class JadwalPpdbAktif extends Component
{
    /**
     * Create a new component instance.
     */
    public $jadwalAktif;
    public $message;
    public $isRegistered;
    public function __construct()
    {
        $this->jadwalAktif = ManajemenJadwalPpdb::active()->first();
        $this->isRegistered = false;

        if (Auth::check() && Auth::user()->siswa()->whereNull('deleted_at')->exists()) {
            $this->isRegistered = true;
            $this->message = "Pendaftaran Siswa Baru Berhasil Dikirim. ";
            $this->jadwalAktif = null; 
        } elseif (!$this->jadwalAktif) {
            $this->message = "Pendaftaran belum dibuka/sudah ditutup. Silahkan cek kembali jadwal pendaftaran.";
        } else {
            //kuota pendaftar
            $jumlahPendaftar = Pendaftaran::where('jadwal_id', $this->jadwalAktif->id)->count();

            if ($jumlahPendaftar >= $this->jadwalAktif->kuota) {
                $this->message = "Pendaftaran telah DITUTUP. Kuota pendaftar sudah penuh.";
                $this->jadwalAktif = null;
            } else {
                $this->message = "Pendaftaran Tahun Ajaran " . $this->jadwalAktif->thn_ajaran . " Gelombang " . $this->jadwalAktif->gelombang_pendaftaran . " Telah Dibuka";
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
