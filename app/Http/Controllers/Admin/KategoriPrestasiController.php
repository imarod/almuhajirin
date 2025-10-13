<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriPrestasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class KategoriPrestasiController extends Controller
{
    public function index()
    {
        $kategoriPrestasi = KategoriPrestasi::latest()->get();
        return view('admin.manajemen-jalur-prestasi', compact('kategoriPrestasi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_prestasi' => 'required|string|max:255|unique:kategori_prestasi,nama_prestasi',
            'deskripsi' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        KategoriPrestasi::create($validated);

        return redirect()->route('admin.kategori-prestasi')->with('success', 'Kategori Prestasi berhasil ditambahkan!');
    }

    public function update(Request $request, KategoriPrestasi $kategoriPrestasi)
    {
        $validated = $request->validate([
            'nama_prestasi' => 'required|string|max:255|unique:kategori_prestasi,nama_prestasi,' . $kategoriPrestasi->id,
            'deskripsi' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $kategoriPrestasi->update($validated);

        return redirect()->route('admin.kategori-prestasi')->with('success', 'Kategori Prestasi berhasil diperbarui!');
    }

    public function destroy(KategoriPrestasi $kategoriPrestasi)
    {
        try {
            if ($kategoriPrestasi->pendaftarans()->exists()) {
                return redirect()->route('admin.kategori-prestasi')->with('error', 'Gagal menghapus! Kategori ini sedang digunakan oleh pendaftar.');
            }

            $kategoriPrestasi->delete();
            return redirect()->route('admin.kategori-prestasi')->with('success', 'Kategori Prestasi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.kategori-prestasi')->with('error', 'Gagal menghapus Kategori Prestasi: ' . $e->getMessage());
        }
    }
}
