<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProcessingMailNotification;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Traits\LoginTokenGenerator;
use App\Mail\CorrectionMailNotification;

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
        $jadwal = $pendaftaran->jadwal;

        if ($pendaftaran->wasChanged('status_aktual')) {
            Mail::to($pendaftaran->siswa->email_siswa)->queue(new ProcessingMailNotification($pendaftaran, $siswa, $jadwal, $plainToken));
        }
        $lastFilters = $request->session()->get('last_filters');

        return redirect()->route('admin.pendaftar', $lastFilters)->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function updatePerbaikanStatus(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string|max:1000',
        ]);

        $pendaftaran = Pendaftaran::with('siswa')->findOrFail($id);

        if ($pendaftaran->status_aktual !== null) {
            $lastFilters = $request->session()->get('last_filters');
            return redirect()->route('admin.detail-pendaftar', ['id' => $id] + $lastFilters)
                ->with('error', 'Gagal: Pendaftaran sudah diproses (Diterima/Ditolak) dan tidak dapat diperbaiki.');
        }

        $pendaftaran->update([
            'status_verifikasi' => 'Perbaikan',
            'catatan' => $request->input('catatan'),
        ]);

        $lastFilters = $request->session()->get('last_filters');

        $siswa = $pendaftaran->siswa;
        $user = $siswa->user;
         $plainToken = $this->generateLoginToken($user);

  
    Mail::to($pendaftaran->siswa->email_siswa)->queue(new CorrectionMailNotification($pendaftaran, $siswa, $plainToken));

        return redirect()->route('admin.pendaftar', $lastFilters)
            ->with('success', 'Catatan perbaikan berhasil dikirim. Status pendaftaran diubah menjadi "Perbaikan".');
    }
}
