<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/siswa/pendaftaran';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    public function login(Request $request)
    {
        // Validasi input
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'password.required' => 'Password wajib diisi',
            ]
        );

        // Cek login
        if (Auth::attempt($request->only('email', 'password'))) {
            if (Auth::user()->is_admin == 1) {
                return redirect()
                    ->route('admin.dashboard-statistik')
                    ->with('success', 'Login berhasil');
            }

            return redirect()
                ->route('ajuan.pendaftaran')
                ->with('success', 'Login berhasil');
        }

        //Login gagal
        return back()
            ->withErrors([
                'email' => 'Email atau password salah',
            ])
            ->withInput($request->except('password'));
    }
}
