<?php

namespace App\Http\Controllers;

use App\Models\ManajemenJadwalPpdb;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function showDataPendaftar(Request $request)
    {
        //thn_ajaran unik
        $thnAjaran = ManajemenJadwalPpdb::select('thn_ajaran')->distinct()->orderBy('thn_ajaran', 'desc')->pluck('thn_ajaran');
        //gelobang pendaftaran unik
        $gelombangPendaftaran = ManajemenJadwalPpdb::select('gelombang_pendaftaran')->distinct()->orderBy('gelombang_pendaftaran', 'asc')->pluck('gelombang_pendaftaran');
        //default data pendaftar
        $defaultThnAjaran = $request->input('thn_ajaran', $thnAjaran->first());
        $defaultGelombang = $request->input('gelombang_pendaftaran', $gelombangPendaftaran->first());
        $perPage = $request->input('per_page', 10);

        // id jadwal based on filter
        $jadwalId = ManajemenJadwalPpdb::where('thn_ajaran', $defaultThnAjaran)
            ->where('gelombang_pendaftaran', $defaultGelombang)
            ->first()->id ?? null;

        // data pendaftara based on filter
        $pendaftars = Pendaftaran::where('jadwal_id', $jadwalId)
            ->with(['siswa.user', 'siswa.orangTua', 'jadwal'])
            ->paginate($perPage);

        return view('admin.data-pendaftar', compact('pendaftars', 'thnAjaran', 'gelombangPendaftaran', 'defaultThnAjaran', 'defaultGelombang'));
    }

    public function getDataPendaftar(Request $request)
    {
        $query = Pendaftaran::query();
        $thnAjaran = $request->input('thn_ajaran');
        $gelombangPendaftaran = $request->input('gelombang_pendaftaran');
        $statusAktual = $request->input('status_aktual');
        $perPage = $request->input('per_page', 10);

        //filter
        if ($thnAjaran || $gelombangPendaftaran) {
            $jadwalQuery = ManajemenJadwalPpdb::query();
            if ($thnAjaran) {
                $jadwalQuery->where('thn_ajaran', $thnAjaran);
            }
            if ($gelombangPendaftaran) {
                $jadwalQuery->where('gelombang_pendaftaran', $gelombangPendaftaran);
            }
            //id yang cocok diambil
            $jadwalIds = $jadwalQuery->pluck('id')->toArray();
            //filter berdasarkan id jadwal
            $query->whereIn('jadwal_id', $jadwalIds);
        }

        if ($statusAktual) {
            if ($statusAktual == 'Belum diproses') {
                $query->whereNull('status_aktual');
            } else {
                $query->where('status_aktual', $statusAktual);
            }
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
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update([
            'status_aktual' => $request->status_aktual,
        ]);

        return redirect()->route('admin.pendaftar', $pendaftaran->id)->with('success', 'Status pendaftaran berhasil diperbarui.');
    }
    public function destroy($id)
    {
        DB::beginTransaction();

        try{
            $pendaftaran = Pendaftaran::findOrFail($id);
            $siswa = $pendaftaran->siswa;

            if($siswa) {
                $ortu = $siswa->orangTua;
                $pendaftaran->delete();
                $siswa->delete();

                if($ortu){
                    $ortu->delete();
                }
            }else{
                $pendaftaran->delete();
            }

            DB::commit();

            return response()->json(['success' => 'Data pendaftaran berhasil dihapus oleh admin']);
        } catch(\Exception $e) {
            DB::rollBack();
            return response()->json(['error'=>'Gagal menghapus data ' . $e->getMessage()], 500);
        }
    }
}
