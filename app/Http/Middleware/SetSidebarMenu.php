<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class SetSidebarMenu
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->is_admin == 1) {
                Config::set('adminlte.menu', include config_path('menu_admin.php'));
            } else {
                Config::set('adminlte.menu', include config_path('menu_siswa.php'));
            }
        }

        return $next($request);
    }
}
