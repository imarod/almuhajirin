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
        $prestasi = Siswa::select('kategori_prestasi')
            ->distinct()
            ->pluck('kategori_prestasi');
        if ($prestasi->isEmpty()) {
            return response()->json([
                'labels' => [],
                'data' => []
            ]);
        }

        $prestasiData = [];
        foreach ($prestasi as $label) {
            $count = Siswa::where('kategori_prestasi', $label)->count();
            $prestasiData[] = $count;
        }

        return response()->json([
            'labels' => $prestasi,
            'data' => $prestasiData
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
