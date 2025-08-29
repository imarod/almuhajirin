<?php

namespace App\Http\Controllers;

use App\Models\ManajemenJadwalPpdb;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;

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

        // id jadwal based on filter
        $jadwalId = ManajemenJadwalPpdb::where('thn_ajaran', $defaultThnAjaran)
            ->where('gelombang_pendaftaran', $defaultGelombang)
            ->first()->id ?? null;

        // data pendaftara based on filter
        $pendaftars = Pendaftaran::where('jadwal_id', $jadwalId)
            ->with(['siswa.user', 'siswa.orangTua', 'jadwal'])
            ->get();

        return view('admin.data-pendaftar', compact('pendaftars', 'thnAjaran', 'gelombangPendaftaran', 'defaultThnAjaran', 'defaultGelombang'));
    }

    public function getDataPendaftar(Request $request)
    {
       $query = Pendaftaran::query();
       $thnAjaran = $request->input('thn_ajaran');
       $gelombangPendaftaran = $request->input('gelombang_pendaftaran');

       //filter
       if($thnAjaran || $gelombangPendaftaran){
           $jadwalQuery = ManajemenJadwalPpdb::query();
           if($thnAjaran) {
            $jadwalQuery->where('thn_ajaran', $thnAjaran);
           }
           if($gelombangPendaftaran){
            $jadwalQuery->where('gelombang_pendaftaran', $gelombangPendaftaran);
           }
           //id yang cocok diambil
           $jadwalIds = $jadwalQuery->pluck('id') ->toArray();
           //filter berdasarkan id jadwal
           $query->whereIn('jadwal_id', $jadwalIds);
       }
       $pendaftars = $query->with(['siswa.user', 'siswa.orangTua', 'jadwal'])->get();
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

        return redirect()->route('admin.detail-pendaftar', $pendaftaran->id)->with('success', 'Status pendaftaran berhasil diperbarui.');
    }
}
