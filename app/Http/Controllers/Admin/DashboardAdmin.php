<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Pendaftaran;

class DashboardAdmin extends Controller
{
    public function index()
    {
        return view('admin.dashboard-statistik');
    }
    public function getTotalPendaftar()
    {
        $totalPendaftar = Pendaftaran::count();
        $totalDiterima = Pendaftaran::where('status_aktual', 'Diterima')->count();
        $totalDitolak = Pendaftaran::where('status_aktual', 'Ditolak')->count();
        $belumDiperiksa = Pendaftaran::whereNull('status_aktual')->count();

        return response()->json([
            'totalPendaftar' => $totalPendaftar,
            'totalDiterima' => $totalDiterima,
            'totalDitolak' => $totalDitolak,
            'belumDiperiksa' => $belumDiperiksa
        ]);
    }
    public function getPendaftarByGender()
    {
        $maleCount = Siswa::where('jenis_kelamin', 'Laki-laki')->count();
        $femaleCount =  Siswa::where('jenis_kelamin', 'Perempuan')->count();
        return response()->json([
            'labels' => ['Laki-laki', 'Perempuan'],
            'data' => [$maleCount, $femaleCount]
        ]);
    }
    public function getPendaftarByPrestasi()
    {
        $dataPrestasi = Pendaftaran::select('kategori_prestasi_id')
            ->whereNotNull('kategori_prestasi_id')
            ->with('kategoriPrestasi')
            ->get()
            ->groupBy('kategoriPrestasi.nama_prestasi')
            ->map(function ($items, $key) {
                return $items->count();
            });
        if ($dataPrestasi->isEmpty()) {
            return response()->json([
                'labels' => [],
                'data' => []
            ]);
        }

        return response()->json([
            'labels' => $dataPrestasi->keys()->toArray(),
            'data' => $dataPrestasi->values()->toArray()
        ]);
    }

    public function getPendaftarByJurusan()
    {
        $dataJurusan = Pendaftaran::select('jurusan_id')
            ->whereNotNull('jurusan_id')
            ->with('jurusan')
            ->get()
            ->groupBy('jurusan.nama_jurusan')
            ->map(function ($items, $key) {
                return $items->count();
            });
        if ($dataJurusan->isEmpty()) {
            return response()->json([
                'labels' => [],
                'data' => []
            ]);
        }

        return response()->json([
            'labels' => $dataJurusan->keys()->toArray(),
            'data' => $dataJurusan->values()->toArray()
        ]);
    }

    public function getPendaftarByYearAndWave()
    {
        $data = Pendaftaran::selectRaw('
       jadwal_ppdb.thn_ajaran as tahun, jadwal_ppdb.gelombang_pendaftaran as gelombang, Count(pendaftaran.id) as total')

            ->join('jadwal_ppdb', 'pendaftaran.jadwal_id', '=', 'jadwal_ppdb.id')
            ->groupBy('tahun', 'gelombang')
            ->orderBy('tahun', 'asc')
            ->get();

        $labels = $data->pluck('tahun')->unique()->sort()->values();
        $gelombang1 = $labels->map(function ($tahun) use ($data) {
            $record = $data->where('tahun', $tahun)->where('gelombang', 1)->first();
            return $record ? $record->total : 0;
        });

        $gelombang2 = $labels->map(function ($tahun) use ($data) {
            $record = $data->where('tahun', $tahun)->where('gelombang', 2)->first();
            return $record ? $record->total : 0;
        });

        return response()->json([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Gelombang 1',
                    'data' => $gelombang1,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.6)',
                ],
                [
                    'label' => 'Gelombang 2',
                    'data' => $gelombang2,
                    'backgroundColor' => 'rgba(255, 0, 0, 1)',
                ]
            ]
        ]);
    }
}
