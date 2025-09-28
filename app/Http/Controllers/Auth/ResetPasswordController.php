<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    protected function sendResetResponse(Request $request, $response)
    {
        // Periksa peran pengguna yang baru saja login setelah reset password
        if (Auth::user()->is_admin == 1) {
            return redirect()->route('admin.dashboard-statistik')->with('status', __($response));
        }

        return redirect()->route('ajuan.pendaftaran')->with('status', __($response));
    }
   
}
