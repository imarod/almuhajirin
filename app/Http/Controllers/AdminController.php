<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class AdminController extends Controller
{
    public function index()
    {
        $pendaftar = Siswa::with(['orangTua', 'pendaftaran'])->latest()->get();
        return view('data-pendaftar', compact('pendaftar'));
    }
}
