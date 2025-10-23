<?php

namespace App\Http\Controllers;

use App\Models\ManajemenJadwalPpdb;
use App\Models\KategoriPrestasi;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LandingPageController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->is_admin == 1) {
                return redirect()->route('admin.dashboard-statistik');
            }
            return redirect()->route('ajuan.pendaftaran');
        }

        $kategoriPrestasi = KategoriPrestasi::active()
            ->select('nama_prestasi', 'deskripsi') 
            ->get();

        $jurusans = Jurusan::active()
        ->select('nama_jurusan')
        ->get();

        $today = Carbon::today();
        $jadwals = ManajemenJadwalPpdb::query()
            ->where(function ($query) use ($today) {
                $query->where('tgl_mulai', '<=', $today)
                    ->where('tgl_berakhir', '>=', $today);
            })
            ->orWhere('tgl_mulai', '>', $today)
            ->orderBy('tgl_mulai', 'asc')
            ->get();
        return view('welcome', compact('jadwals', 'kategoriPrestasi', 'jurusans'));
    }
}
