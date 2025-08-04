<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function home()
    {
        return view('home');
    }
    public function index()
    {
        return view('siswa.ajuan-pendaftaran');
    }
    


    // Admin
    public function adminDashboard()
    {
        return view('admin');
    }
    public function dataPendaftar()
    {
        return view('data-pendaftar');
    }
    public function detailPendaftar()
    {
        return view('detail-pendaftar');
    }
    public function dashboardStatistik()
    {
        return view('dashboard-statistik');
    }
    
}
