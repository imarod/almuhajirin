<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


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
        $validator = Validator::make($request->all(), [
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
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->is_admin,
        ]);

        return response()->json(['success' => true, 'message' => 'User berhasil ditambahkan!']);
    }
    public function getDataUser(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        }

        if ($request->filled('role')) {
            $role = $request->input('role');
            $query->where('is_admin', $role);
        }

        $query->orderByDesc('is_admin')
            ->orderByDesc('created_at');

        $perPage = $request->input('per_page', 10);
        if ($perPage > 0) {
            $users = $query->paginate($perPage);
            $users->getCollection()->transform(function ($user) {
                $user->created_at_formatted = $user->created_at->format('d F Y');
                return $user;
            });
            return response()->json($users);
        } else {
            $users = $query->get();
            $users->transform(function ($user) {
                $user->created_at_formatted = $user->created_at->format('d F Y');
                return $user;
            });
            return response()->json([
                'data' => $users,
                'current_page' => 1,
                'per_page' => $users->count(),
                'last_page' => 1,
                'from' => 1,
                'to' => $users->count(),
                'total' => $users->count(),
                'links' => [
                    ['url' => null, 'label' => 'Previous', 'active' => false],
                    ['url' => null, 'label' => '1', 'active' => true],
                    ['url' => null, 'label' => 'Next', 'active' => false]
                ]
            ]);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User tidak ditemukan'], 404);
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
            return response()->json(['success' => true, 'message' => 'User berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success' => true, 'message' => 'Gagal menghapus user'], 500);
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

        $validator = Validator::make($request->all(), [
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
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 422);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_admin = $request->is_admin;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return response()->json(['success' => true, 'message' => 'Data user berhasil di update!']);
    }
}
