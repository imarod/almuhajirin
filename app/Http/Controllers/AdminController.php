<?php

namespace App\Http\Controllers;

use App\Models\ManajemenJadwalPpdb;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProcessingMailNotification;

class AdminController extends Controller
{
    public function showDataPendaftar(Request $request)
    {
        $thnAjaran = ManajemenJadwalPpdb::select('thn_ajaran')->distinct()->orderBy('thn_ajaran', 'desc')->pluck('thn_ajaran');
        $gelombangPendaftaran = ManajemenJadwalPpdb::select('gelombang_pendaftaran')->distinct()->orderBy('gelombang_pendaftaran', 'asc')->pluck('gelombang_pendaftaran');

        $defaultThnAjaran = $request->input('thn_ajaran', $thnAjaran->first());
        $defaultGelombang = $request->input('gelombang_pendaftaran', $gelombangPendaftaran->first());
        return view('admin.data-pendaftar', compact('thnAjaran', 'gelombangPendaftaran', 'defaultThnAjaran', 'defaultGelombang'));
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
            // Logika filter tahun ajaran dan gelombang tetap berjalan jika tidak ada pencarian.
            if ($thnAjaran || $gelombangPendaftaran) {
                $jadwalQuery = ManajemenJadwalPpdb::query();
                if ($thnAjaran) {
                    $jadwalQuery->where('thn_ajaran', $thnAjaran);
                }
                if ($gelombangPendaftaran) {
                    $jadwalQuery->where('gelombang_pendaftaran', $gelombangPendaftaran);
                }
                $jadwalIds = $jadwalQuery->pluck('id')->toArray();
                $query->whereIn('jadwal_id', $jadwalIds);
            }
        }

        // Logika filter status aktual
        if ($statusAktual === 'Belum diproses') {
            $query->whereNull('status_aktual');
        } elseif ($statusAktual === 'Diterima' || $statusAktual === 'Ditolak') {
            $query->where('status_aktual', $statusAktual);
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

    public function showDetailPendaftar($id)
    {

        $pendaftars = Pendaftaran::with(['siswa.orangTua'])->findOrFail($id);

        return view('admin.detail-pendaftaran', compact('pendaftars'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::with('siswa')->findOrFail($id);

         $oldStatus = $pendaftaran->status_aktual;
        $pendaftaran->update([
            'status_aktual' => $request->status_aktual,
        ]);

        if ($pendaftaran->wasChanged('status_aktual')) {
            Mail::to($pendaftaran->siswa->email_siswa)->send(new ProcessingMailNotification($pendaftaran, $pendaftaran->siswa));
        }

        return redirect()->route('admin.pendaftar', $pendaftaran->id)->with('success', 'Status pendaftaran berhasil diperbarui.');
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
}
