<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\ManajemenJadwalPpdb;

class JadwalPpdbAktif extends Component
{
    /**
     * Create a new component instance.
     */
    public $jadwalAktif;
    public $message;
    public function __construct()
    {
        $this->jadwalAktif = ManajemenJadwalPpdb::active()->first();

        $this->message = "Pendaftaran belum dibuka/sudah ditutup. Silahkan cek kembali jadwal pendaftaran.";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.jadwal-ppdb-aktif');
    }
}
