<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProcessingMailNotification;
use App\Models\Pendaftaran;
use App\Models\ManajemenJadwalPpdb;
use App\Traits\LoginTokenGenerator;

class VerifikasiController extends Controller
{
    use LoginTokenGenerator;

    public function showDetailPendaftar(Request $request, $id)
    {
        $thnAjaran = $request->input('thn_ajaran') ?? 'Semua';
        $gelombang = $request->input('gelombang') ?? 'Semua';
        $status = $request->input('status') ?? 'Semua';

        //simpan session filter terakhir
        $filters = [
            'thn_ajaran' => $request->input('thn_ajaran'),
            'gelombang_pendaftaran' => $request->input('gelombang'),
            'status_aktual' => $request->input('status'),
            'page' => $request->input('page'),
            'per_page' => $request->input('per_page'),
            'search' => $request->input('search'),
        ];

        $request->session()->put('last_filters', $filters);

        $pendaftars = Pendaftaran::with(['siswa.orangTua'])->findOrFail($id);
        $lastFilters = $request->session()->get('last_filters');

        return view('admin.detail-pendaftaran', compact('pendaftars', 'lastFilters'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::with('siswa')->findOrFail($id);
        $siswa = $pendaftaran->siswa;
        $user = $siswa->user;
        $newStatus = $request->input('status_aktual');
        $plainToken = $this->generateLoginToken($user);
        $pendaftaran->update([
            'status_aktual' => $newStatus,
        ]);

        if ($pendaftaran->wasChanged('status_aktual')) {
            Mail::to($pendaftaran->siswa->email_siswa)->queue(new ProcessingMailNotification($pendaftaran, $siswa, $plainToken));
        }
        $lastFilters = $request->session()->get('last_filters');

        return redirect()->route('admin.pendaftar', $lastFilters)->with('success', 'Status pendaftaran berhasil diperbarui.');
    }
}
