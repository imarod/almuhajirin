<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use Illuminate\Validation\Rule;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::latest()->get();
        return view('admin.manajemen-jurusan', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jurusan' => [
                'required',
                'string',
                'max:255',
                Rule::unique('jurusan', 'nama_jurusan')->whereNull('deleted_at')
            ],
            'is_active' => 'nullable|boolean',
        ]);

        Jurusan::create($validated);

        return redirect()->route('admin.manajemen-jurusan')->with('success', 'Jurusan berhasil ditambahkan!');
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $validated = $request->validate([
            'nama_jurusan' => [
                'required',
                'string',
                'max:255',
                Rule::unique('jurusan', 'nama_jurusan')->ignore($jurusan->id)->whereNull('deleted_at') // <--- BARIS PERBAIKAN
            ],
            'is_active' => 'nullable|boolean',
        ]);

        $jurusan->update($validated);

        return redirect()->route('admin.manajemen-jurusan')->with('success', 'Jurusan berhasil diperbarui!');
    }

    public function destroy(Jurusan $jurusan)
    {
        try {
            // Pengecekan relasi: Jika jurusan ini sudah digunakan oleh pendaftaran, jangan dihapus.
            if ($jurusan->pendaftarans()->exists()) {
                return redirect()->route('admin.manajemen-jurusan')->with('error', 'Gagal menghapus! Jurusan ini sedang digunakan oleh data pendaftar.');
            }

            $jurusan->delete();
            return redirect()->route('admin.manajemen-jurusan')->with('success', 'Jurusan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.manajemen-jurusan')->with('error', 'Gagal menghapus Jurusan: ' . $e->getMessage());
        }
    }
}
