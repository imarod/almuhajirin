<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class LoginTokenController extends Controller
{
    public function login($token)
    {
        $user = User::whereNotNull('login_token')
            ->where('token_expires_at', '>', Carbon::now())
            ->whereHas('siswa.pendaftaran', function ($query) {
                $query->where('status_aktual', '!=');
            })
            ->first();

        if ($user && Hash::check($token, $user->login_token)) {
            $user->login_token = null;
            $user->token_expires_at = null;
            $user->save();
            Auth::login($user);
             $redirectRoute = ($user->is_admin == 1) ? 'admin.dashboard-statistik' : 'ajuan.pendaftaran';

            return redirect()->intended(route($redirectRoute))->with('success', 'Login berhasil');
        }
        return redirect()->route('login')->with('error', 'Token login tidak valid atau sudah kedaluwarsa. Silahkan Login manual.');
    }
}
