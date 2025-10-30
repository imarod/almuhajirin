<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables; 


class ManajemenUser extends Controller
{
    public function index()
    {
        return view('admin.manajemen-user');
    }

    public function getTotalUser()
    {
        
        $totalUSer = User::count();
        $totalAdmin = User::where('is_admin', 1)->count();
        $totalUserBiasa = User::where('is_admin', 0)->count();

        return response()->json([
            'totalUser' => $totalUSer,
            'totalAdmin' => $totalAdmin,
            'totalUserBiasa' => $totalUserBiasa
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->where(function ($query) {
                        return $query->whereNull('deleted_at');
                    })
                ],
                'password' => 'required|string|min:8',
                'is_admin' => 'required|boolean',
            ],
            [
                'email.unique'  => 'Email sudah terdaftar, gunakan email lain',
                'password.min'  => 'Password minimal harus terdiri dari 8 karakter',
            ]

        );

        if ($validator->fails()) {
            return redirect()->route('admin.manajemen-user')->withErrors($validator)->withInput()->with('error', 'Gagal menambahkan user. Periksa kembali input Anda.');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->is_admin,
        ]);

        return redirect()->route('admin.manajemen-user')->with('success', 'User berhasil ditambahkan!');
    }

    public function getDataUser(Request $request)
    {
        if ($request->ajax()) {
            $query = User::orderBy('is_admin', 'desc')->orderBy('name','asc');

            return DataTables::of($query)
                ->addColumn('role', function ($user) {
                    return $user->is_admin == 1 ? '<span class="badge badge-primary px-3 py-2">Admin</span>' : '<span class="badge badge-success px-3 py-2">Siswa</span>';
                })
                ->addColumn('created_at_formatted', function ($user) {
                    return $user->created_at->format('d F Y');
                })
                ->addColumn('action', function ($user) {
                    $editUrl = route('admin.manajemen.user.edit', $user->id);
                    $deleteUrl = route('admin.manajemen.user.destroy', $user->id);

                    return '
                    <i class="fas fa-edit text-primary edit-btn mr-2" 
                        data-id="' . $user->id . '" 
                        data-url="' . $editUrl . '"
                        style="cursor: pointer;"
                        title="Edit"
                        data-toggle="modal" 
                        data-target="#editUserModal" ></i>
                    <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-link p-0 delete-btn"><i class="fas fa-trash text-danger" title="Hapus"></i></button>
                    </form>
                ';
                })
                ->rawColumns(['role', 'action'])
                ->make(true);
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($user->id)->where(function ($query) {
                        return $query->whereNull('deleted_at');
                    })
                ],
                'password' => 'nullable|string|min:8',
                'is_admin' => 'required|boolean',
            ],
            [
                'email.unique'  => 'Email sudah terdaftar, gunakan email lain',
                'password.min'  => 'Password minimal harus terdiri dari 8 karakter',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('admin.manajemen-user')->with('edit_error_id', $id)->withErrors($validator)->with('error', 'Gagal mengupdate user. Periksa kembali input Anda.');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_admin = $request->is_admin;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('admin.manajemen-user')->with('success', 'Data user berhasil di update!');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.manajemen-user')->with('error', 'User tidak ditemukan');
        }

        try {
            if ($user->siswa) {
                $siswa = $user->siswa;
                $ortu = $siswa->orangTua;

                if ($siswa->pendaftaran) {
                    $siswa->pendaftaran->delete();
                }

                $siswa->delete();

                if ($ortu) {
                    $ortu->delete();
                }
            }
            $user->delete();
            return redirect()->route('admin.manajemen-user')->with('success', 'User berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.manajemen-user')->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }
}
