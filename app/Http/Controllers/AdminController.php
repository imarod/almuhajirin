<?php

namespace App\Http\Controllers;

use App\Models\ManajemenJadwalPpdb;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;
use Spatie\SimpleExcel\SimpleExcelWriter;
use PDF;

class AdminController extends Controller
{
    public function showDataPendaftar(Request $request)
    {
        $thnAjaran = ManajemenJadwalPpdb::select('thn_ajaran')->distinct()->orderBy('thn_ajaran', 'desc')->pluck('thn_ajaran');
        $gelombangPendaftaran = ManajemenJadwalPpdb::select('gelombang_pendaftaran')->distinct()->orderBy('gelombang_pendaftaran', 'asc')->pluck('gelombang_pendaftaran');

        $lastFilters = $request->session()->get('last_filters', []);
        $defaultThnAjaran = $request->input('thn_ajaran', $lastFilters['thn_ajaran'] ?? $thnAjaran->first());
        $defaultGelombang = $request->input('gelombang_pendaftaran', $lastFilters['gelombang_pendaftaran'] ?? $gelombangPendaftaran->first());
        $defaultStatus = $request->input('status_aktual', $lastFilters['status_aktual'] ?? '');
        $defaultPage = $request->input('page', $lastFilters['page'] ?? 1);
        $defaultPerPage = $request->input('per_page', $lastFilters['per_page'] ?? 10);
        $defaultSearch = $request->input('search', $lastFilters['search'] ?? '');

        $request->session()->forget('last_filters');

        return view('admin.data-pendaftar', compact(
            'thnAjaran',
            'gelombangPendaftaran',
            'defaultThnAjaran',
            'defaultGelombang',
            'defaultStatus',
            'defaultPage',
            'defaultPerPage',
            'defaultSearch'
        ));
    }

    public function getDataPendaftar(Request $request)
    {
        $query = Pendaftaran::query();
        $thnAjaran = $request->input('thn_ajaran');
        $gelombangPendaftaran = $request->input('gelombang_pendaftaran');
        $statusAktual = $request->input('status_aktual');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        // Logika pencarian form search
        if ($search) {
            $query->whereHas('siswa', function ($q) use ($search) {
                $q->where('nisn', 'like', '%' . $search . '%')
                    ->orWhere('nama', 'like', '%' . $search . '%');
            });
            $query->orWhereHas('siswa.user', function ($q) use ($search) {
                $q->where('email', 'like', '%' . $search . '%');
            });
        } else {
            if (!empty($thnAjaran) && $thnAjaran !== 'Semua') {
                $query->whereHas('jadwal', function ($q) use ($thnAjaran) {
                    $q->where('thn_ajaran', $thnAjaran);
                });
            }
            if (!empty($gelombangPendaftaran) && $gelombangPendaftaran !== 'Semua') {
                $query->whereHas('jadwal', function ($q) use ($gelombangPendaftaran) {
                    $q->where('gelombang_pendaftaran', $gelombangPendaftaran);
                });
            }
        }

        // Logika filter status aktual
        if ($statusAktual === 'Belum diproses') {
            $query->whereNull('status_aktual');
        } elseif ($statusAktual === 'Diterima' || $statusAktual === 'Ditolak') {
            $query->where('status_aktual', $statusAktual);
        } elseif ($statusAktual === 'Semua') {
        }

        if ($perPage > 0) {
            $pendaftars = $query->with(['siswa.user', 'siswa.orangTua', 'jadwal'])->paginate($perPage);
            return response()->json($pendaftars);
        } else {
            $pendaftars = $query->with(['siswa.user', 'siswa.orangTua', 'jadwal'])->get();
            return response()->json([
                'data' => $pendaftars,
                'current_page' => 1,
                'per_page' => $pendaftars->count(),
                'last_page' => 1,
                'from' => 1,
                'to' => $pendaftars->count(),
                'total' => $pendaftars->count(),
                'links' => [
                    ['url' => null, 'label' => 'Previous', 'active' => false],
                    ['url' => null, 'label' => '1', 'active' => true],
                    ['url' => null, 'label' => 'Next', 'active' => false]
                ]
            ]);
        }

        $pendaftars = $query->with(['siswa.user', 'siswa.orangTua', 'jadwal'])->paginate($perPage);
        return response()->json($pendaftars);
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

            return response()->json(['success' => 'Data pendaftaran berhasil dihapus oleh admin']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Gagal menghapus data ' . $e->getMessage()], 500);
        }
    }

    public function exportPendaftarToCsv(Request $request)
    {
        $query = Pendaftaran::query();
        $thnAjaran = $request->input('thn_ajaran');
        $gelombangPendaftaran = $request->input('gelombang_pendaftaran');
        $statusAktual = $request->input('status_aktual');
        $statusVerifikasi = $request->input('status_verifikasi');
        $search = $request->input('search');

        if ($search) {
            $query->whereHas('siswa', function ($q) use ($search) {
                $q->where('nisn', 'like', '%' . $search . '%')
                    ->orWhere('nama', 'like', '%' . $search . '%');
            });
            $query->orWhereHas('siswa.user', function ($q) use ($search) {
                $q->where('email', 'like', '%' . $search . '%');
            });
        } else {
            if (!empty($thnAjaran) && $thnAjaran !== 'Semua') {
                $query->whereHas('jadwal', function ($q) use ($thnAjaran) {
                    $q->where('thn_ajaran', $thnAjaran);
                });
            }
            if (!empty($gelombangPendaftaran) && $gelombangPendaftaran !== 'Semua') {
                $query->whereHas('jadwal', function ($q) use ($gelombangPendaftaran) {
                    $q->where('gelombang_pendaftaran', $gelombangPendaftaran);
                });
            }
        }

        if ($statusAktual === 'Belum diproses') {
            $query->whereNull('status_aktual');
        } elseif ($statusAktual === 'Diterima' || $statusAktual === 'Ditolak') {
            $query->where('status_aktual', $statusAktual);
        }

        $pendaftars = $query->with(['siswa.orangTua', 'jadwal'])->get();

        $records = $pendaftars->map(function ($pendaftar) {
            return [
                'Nama Lengkap' => $pendaftar->siswa->nama ?? 'Tidak ada data',
                'NISN' => $pendaftar->siswa->nisn ?? 'Tidak ada data',
                'Tempat Lahir' => $pendaftar->siswa->tempat_lahir ?? 'Tidak ada data',
                'Tanggal Lahir' => $pendaftar->siswa->tanggal_lahir->format('d-m-Y') ?? 'Tidak ada data',
                'Jenis Kelamin' => $pendaftar->siswa->jenis_kelamin ?? 'Tidak ada data',
                'Kategori Prestasi' => $pendaftar->siswa->kategori_prestasi ?? 'Tidak Ada',
                'No. HP Siswa' => "'" . $pendaftar->siswa->no_hp_siswa ?? 'Tidak ada data',
                'Email Siswa' => $pendaftar->siswa->email_siswa ?? 'Tidak ada data',
                'Alamat Siswa' => $pendaftar->siswa->alamat_siswa ?? 'Tidak ada data',
                'Nama Orang Tua' => $pendaftar->siswa->orangTua->nama_ayah ?? 'Tidak ada data',
                'No. HP Orang Tua' => "'" . $pendaftar->siswa->orangTua->no_hp_ortu ?? 'Tidak ada data',
                'Tahun Ajaran' => $pendaftar->jadwal->thn_ajaran ?? 'Tidak ada data',
                'Gelombang' => $pendaftar->jadwal->gelombang_pendaftaran ?? 'Tidak ada data',
                'Status' => $pendaftar->status_aktual ?? 'Belum diproses',
            ];
        });
        $filePath = 'data_pendaftar_' . now()->format('Ymd_His') . '.csv';
        $writer = SimpleExcelWriter::create($filePath)->addRows($records);


        return response()->download($filePath, $filePath, [
            'Content-Type' => 'text/csv',
        ])->deleteFileAfterSend(true);
    }

    public function exportPendaftarToPdf(Request $request)
    {
        $query = Pendaftaran::query();
        $thnAjaran = $request->input('thn_ajaran');
        $gelombangPendaftaran = $request->input('gelombang_pendaftaran');
        $statusAktual = $request->input('status_aktual');
        $search = $request->input('search');

        if ($search) {
            $query->whereHas('siswa', function ($q) use ($search) {
                $q->where('nisn', 'like', '%' . $search . '%')
                    ->orWhere('nama', 'like', '%' . $search . '%');
            })->orWhereHas('siswa.user', function ($q) use ($search) {
                $q->where('email', 'like', '%' . $search . '%');
            });
        } else {
            if (!empty($thnAjaran) && $thnAjaran !== 'Semua') {
                $query->whereHas('jadwal', function ($q) use ($thnAjaran) {
                    $q->where('thn_ajaran', $thnAjaran);
                });
            }
            if (!empty($gelombangPendaftaran) && $gelombangPendaftaran !== 'Semua') {
                $query->whereHas('jadwal', function ($q) use ($gelombangPendaftaran) {
                    $q->where('gelombang_pendaftaran', $gelombangPendaftaran);
                });
            }
        }

        if ($statusAktual === 'Belum diproses') {
            $query->whereNull('status_aktual');
        } elseif ($statusAktual === 'Diterima' || $statusAktual === 'Ditolak') {
            $query->where('status_aktual', $statusAktual);
        }

        $pendaftars = $query->with(['siswa.orangTua', 'jadwal'])->get();
        $totalPendaftar = $pendaftars->count();
        $tanggalCetak = now()->format('d F Y');

        $pdf = PDF::loadView('admin.cetak-data-pendaftar', compact('pendaftars', 'totalPendaftar', 'tanggalCetak'));
        return $pdf->download('data_pendaftar_' . now()->format('Ymd_His') . '.pdf');
    }
}
