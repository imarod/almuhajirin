<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ManajemenJadwalPpdb;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Pendaftaran;

class DashboardAdmin extends Controller
{
    public function index()
    {
        $tahunAjaran = ManajemenJadwalPpdb::select('thn_ajaran')
            ->distinct()
            ->pluck('thn_ajaran')
            ->sortDesc();

        $tahunAll = collect(['' => 'Semua Tahun'])->union($tahunAjaran->mapWithKeys(function ($item) {
            return [$item => $item];
        }));

        $tahunDefault = $tahunAjaran->first() ?? '';

        return view('admin.dashboard-statistik', [
            'tahunAjaran' => $tahunAll,
            'tahunDefault' => $tahunDefault
        ]);
    }
    public function getTotalPendaftar()
    {
        $totalPendaftar = Pendaftaran::count();
        $totalDiterima = Pendaftaran::where('status_aktual', 'Diterima')->count();
        $totalDitolak = Pendaftaran::where('status_aktual', 'Ditolak')->count();
        $totalPerbaikan = Pendaftaran::where('status_verifikasi', 'Perbaikan')->count();
        $belumDiperiksa = Pendaftaran::whereNull('status_aktual')->count();

        return response()->json([
            'totalPendaftar' => $totalPendaftar,
            'totalDiterima' => $totalDiterima,
            'totalDitolak' => $totalDitolak,
            'totalPerbaikan' => $totalPerbaikan,
            'belumDiperiksa' => $belumDiperiksa
        ]);
    }
    public function getPendaftarByGender(Request $request)
    {
        $tahun = $request->input('tahun');
        $query = Siswa::query();

        if ($tahun) {
            $query->whereHas('pendaftaran', function ($q) use ($tahun) {
                $q->whereHas('jadwal', function ($q2) use ($tahun) {
                    $q2->where('thn_ajaran', $tahun);
                });
            });
        }

        $maleCount = (clone $query)->where('jenis_kelamin', 'Laki-laki')->count();
        $femaleCount =  (clone $query)->where('jenis_kelamin', 'Perempuan')->count();

        return response()->json([
            'labels' => ['Laki-laki', 'Perempuan'],
            'data' => [$maleCount, $femaleCount]
        ]);
    }

    public function getPendaftarByPrestasi(Request $request)
    {
        $tahun = $request->input('tahun');

        $query = Pendaftaran::select('kategori_prestasi_id')
            ->whereNotNull('kategori_prestasi_id')
            ->with('kategoriPrestasi');

        if ($tahun) {
            $query->whereHas('jadwal', function ($q) use ($tahun) {
                $q->where('thn_ajaran', $tahun);
            });
        }

        $dataPrestasi = $query->get()
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

    public function getPendaftarByJurusan(Request $request)
    {
        $tahun = $request->input('tahun');
        $query = Pendaftaran::select('jurusan_id')
            ->whereNotNull('jurusan_id')
            ->with('jurusan');

        if ($tahun) {
            $query->whereHas('jadwal', function ($q) use ($tahun) {
                $q->where('thn_ajaran', $tahun);
            });
        }

        $dataJurusan = $query->get()
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

        $totalPerTahun = $labels->map(function ($tahun, $index) use ($gelombang1, $gelombang2) {
            return $gelombang1[$index] + $gelombang2[$index];
        });


        return response()->json([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Gelombang 1',
                    'data' => $gelombang1,
                    'backgroundColor' => '#36A2EB',
                ],
                [
                    'label' => 'Gelombang 2',
                    'data' => $gelombang2,
                    'backgroundColor' => '#9966FF ',
                ],
                [
                    'label' => 'Total Pendaftar',
                    'data' => $totalPerTahun,
                    'backgroundColor' => '#3F51B5', // hijau
                ],
            ]
        ]);
    }
}
