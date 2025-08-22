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
                $menuItems = include config_path('menu_siswa.php');
                $processedMenu = $this->processMenuItems($menuItems);
                Config::set('adminlte.menu', $processedMenu);
            }
        }

        return $next($request);
    }

    private function processMenuItems($items)
    {
        return array_map(function($item){
            if(isset($item['url']) && is_callable($item['url'])) {
                $item['url'] = $item['url']();
            }
            if(isset($item['submenu'])){
                $item['submenu'] = $this->processMenuItems(($item['submenu']));
            }
            return $item;
        }, $items);
    }
}
