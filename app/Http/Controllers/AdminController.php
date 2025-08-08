<?php

namespace App\Http\Controllers;

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
}
