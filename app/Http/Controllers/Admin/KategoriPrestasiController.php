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
        $validated = $request->validate(
            [
                'nama_prestasi' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('kategori_prestasi', 'nama_prestasi')->whereNull('deleted_at')

                ],
                'deskripsi' => 'required|string',
                'is_active' => 'nullable|boolean',
            ],
            [
                'nama_prestasi.required' => 'Nama prestasi wajib diisi.',
                'nama_prestasi.string'   => 'Nama prestasi harus berupa teks.',
                'nama_prestasi.max'      => 'Nama prestasi tidak boleh lebih dari 255 karakter.',
                'nama_prestasi.unique'   => 'Nama prestasi ini sudah ada.',
                'deskripsi.string'       => 'Deskripsi harus berupa teks.',
                'deskripsi.required'     => 'Reward prestasi harus diisi.',
                'is_active.boolean'      => 'Status aktif harus berupa true atau false.',
            ]
        );

        KategoriPrestasi::create($validated);

        return redirect()->route('admin.kategori-prestasi')->with('success', 'Kategori Prestasi berhasil ditambahkan!');
    }

    public function update(Request $request, KategoriPrestasi $kategoriPrestasi)
    {
        $validated = $request->validate(
            [
                'nama_prestasi' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('kategori_prestasi', 'nama_prestasi')->ignore($kategoriPrestasi->id)->whereNull('deleted_at')

                ],
                'deskripsi' => 'nullable|string',
                'is_active' => 'nullable|boolean',
            ],
            [
                'nama_prestasi.required' => 'Nama prestasi wajib diisi.',
                'nama_prestasi.string'   => 'Nama prestasi harus berupa teks.',
                'nama_prestasi.max'      => 'Nama prestasi tidak boleh lebih dari 255 karakter.',
                'nama_prestasi.unique'   => 'Nama prestasi ini sudah digunakan.',
                'deskripsi.string'       => 'Deskripsi harus berupa teks.',
                'is_active.boolean'      => 'Status aktif harus berupa true atau false.',
            ]
        );

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
