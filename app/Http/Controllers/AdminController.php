<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class AdminController extends Controller
{
    public function showDataPendaftar()
    {
        $pendaftars = Pendaftaran::with(['siswa.user', 'siswa.orangTua'])->get();
        return view('admin.data-pendaftar', compact('pendaftars'));
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
