<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriPrestasiController extends Controller
{
    public function index()
    {
        return view('admin.manajemen-jalur-prestasi');
    }

    
}
