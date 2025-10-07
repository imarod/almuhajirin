<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\ManajemenJadwalPpdb;
use App\Http\Requests\StoreJadwalPpdbRequest;
use App\Http\Requests\UpdateJadwalPpdbRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Spatie\SimpleExcel\SimpleExcelWriter;
use PDF;


class ManajemenJadwalPpdbController extends Controller
{
    public function index()
    {
        $jadwals = ManajemenJadwalPpdb::orderBy('created_at', 'desc')->get();
        $activeJadwal = ManajemenJadwalPpdb::active()->first();

        return view('admin.manajemen-jadwal-ppdb', compact('jadwals', 'activeJadwal'));
    }

    public function getDataJadwal()
    {
        $perPage = request()->input('per_page', 10);
        $query = ManajemenJadwalPpdb::orderBy('created_at', 'desc');

        if ($perPage > 0) {
            $jadwals = $query->paginate($perPage);
            return response()->json($jadwals);
        } else {
            $jadwals = $query->get();
            return response()->json([
                'data' => $jadwals,
                'current_page' => 1,
                'per_page' => $jadwals->count(),
                'last_page' => 1,
                'from' => 1,
                'to' => $jadwals->count(),
                'total' => $jadwals->count(),
                'links' => [
                    ['url' => null, 'label' => 'Previous', 'active' => false],
                    ['url' => null, 'label' => '1', 'active' => true],
                    ['url' => null, 'label' => 'Next', 'active' => false]
                ]
            ]);
        }
    }

    public function store(StoreJadwalPpdbRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $tahunAjaran = $validatedData['tahun_awal'] . '/' . $validatedData['tahun_akhir'];

            ManajemenJadwalPpdb::create([
                'thn_ajaran' => $tahunAjaran,
                'gelombang_pendaftaran' => $validatedData['gelombang_pendaftaran'],
                'kuota' => $validatedData['kuota'],
                'tgl_mulai' => $validatedData['tgl_mulai'],
                'tgl_berakhir' => $validatedData['tgl_berakhir'],
                'tgl_pengumuman' => $validatedData['tgl_pengumuman'],
            ]);

            return redirect()->to(route('admin.manajemen-jadwal-ppdb') . '#history')->with('success', 'Jadwal PPDB berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Penyimpanan jadwal gagal. ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $jadwal = ManajemenJadwalPpdb::findOrFail($id);
        $jadwals = ManajemenJadwalPpdb::orderBy('created_at', 'desc')->get();
        $jadwalAktif = ManajemenJadwalPpdb::active()->first();
        return view('admin.manajemen-jadwal-ppdb', compact('jadwal', 'jadwals', 'jadwalAktif'));
    }

    public function update(UpdateJadwalPpdbRequest $request, $id)
    {
        try {
            $jadwal = ManajemenJadwalPpdb::findOrFail($id);
            $validatedData = $request->validated();
            $tahunAjaran = $validatedData['tahun_awal'] . '/' . $validatedData['tahun_akhir'];

            $jadwal->update([
                'thn_ajaran' => $tahunAjaran,
                'gelombang_pendaftaran' => $validatedData['gelombang_pendaftaran'],
                'kuota' => $validatedData['kuota'],
                'tgl_mulai' => $validatedData['tgl_mulai'],
                'tgl_berakhir' => $validatedData['tgl_berakhir'],
                'tgl_pengumuman' => $validatedData['tgl_pengumuman'],
            ]);

            return redirect()->to(route('admin.manajemen-jadwal-ppdb') . '#history')->with('success', 'Jadwal PPDB berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Pembaruan jadwal gagal. ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $jadwal = ManajemenJadwalPpdb::findOrFail($id);

            foreach ($jadwal->pendaftaran as $pendaftaran) {
                $siswa = $pendaftaran->siswa;
                if ($siswa) {
                    $ortu = $siswa->orangTua;
                    $pendaftaran->delete();
                    $siswa->delete();
                    if ($ortu) {
                        $ortu->delete();
                    }
                }
            }
            $jadwal->delete();

            DB::commit();

            return redirect()->to(route('admin.manajemen-jadwal-ppdb') . '#history')->with('success', 'Jadwal PPDB berhasil Dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Jadwal tidak berhasil dihapus' . $e->getMessage());
        }
    }

    public function exportJadwalToCsv(Request $request)
    {
        $query = ManajemenJadwalPpdb::orderBy('created_at', 'desc');
        $jadwals = $query->get();
        $fileName = 'jadwal_ppdb_' . now()->format('Ymd_His') . '.csv';
        $writer = SimpleExcelWriter::create($fileName)->addHeader([
            'ID', 'Tahun Ajaran', 'Gelombang Pendaftaran', 'Kuota', 'Tanggal Mulai', 'Tanggal Berakhir', 'Tanggal Pengumuman', 'Status', 'Dibuat Pada', 'Diperbarui Pada'
        ]);

        foreach ($jadwals as $jadwal) {
            $writer->addRow([
                $jadwal->id,
                $jadwal->thn_ajaran,
                $jadwal->gelombang_pendaftaran,
                $jadwal->kuota,
                $jadwal->tgl_mulai->format('d-m-Y'),
                $jadwal->tgl_berakhir->format('d-m-Y'),
                $jadwal->tgl_pengumuman->format('d-m-Y'),
                $jadwal->status,
                // $jadwal->created_at,
                // $jadwal->updated_at,
            ]);
        }

        $writer->close();

        return response()->download($fileName)->deleteFileAfterSend(true);
    }

    public function exportJadwalToPdf(Request $request)
    {
        $query = ManajemenJadwalPpdb::orderBy('created_at', 'desc');
        $jadwals = $query->get();

        $pdf = PDF::loadView('admin.cetak-jadwal-ppdb', compact('jadwals'));
        $fileName = 'jadwal_ppdb_' . now()->format('Ymd_His') . '.pdf';

        return $pdf->download($fileName);
    }
}
