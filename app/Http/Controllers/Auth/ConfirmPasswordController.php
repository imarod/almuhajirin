<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

  
    public function __construct()
    {
        $this->middleware('auth');
    }

     protected function sendConfirmationResponse(Request $request)
    {
        // Periksa peran pengguna yang sedang login
        if (Auth::user()->is_admin == 1) {
            return redirect()->route('admin.dashboard-statistik');
        }

        return redirect()->route('ajuan.pendaftaran');
    }
}
