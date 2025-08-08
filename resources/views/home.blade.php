@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
    <p>Student Registration Management System</p>
@stop

@section('content')
<div class="row">
    <!-- Data Calon Siswa -->
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header bg-primary">
                <h3 class="card-title">Data Calon Siswa</h3>
            </div>
            <div class="card-body">
                <p><strong>Nama Lengkap:</strong> Ahmad Rizki Pratama</p>
                <p><strong>NISN:</strong> 1234567890</p>
                <p><strong>Jenis Kelamin:</strong> Laki-laki</p>
                <p><strong>Tempat Lahir:</strong> Jakarta</p>
                <p><strong>Tanggal Lahir:</strong> 15 Mei 2008</p>
                <p><strong>Alamat:</strong> Jl. Merdeka No.123, Jakarta Pusat</p>

                <hr>
                <h5>Kontak & Dokumen</h5>
                <p><strong>No. Handphone:</strong> 081234567890</p>
                <p><strong>Kategori Prestasi:</strong> Akademik</p>
                <p><strong>Scan Kartu Keluarga:</strong> Uploaded</p>
                <p><strong>Scan Ijazah:</strong> Uploaded</p>
            </div>
        </div>
    </div>

    <!-- Data Orang Tua -->
    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header bg-success">
                <h3 class="card-title">Data Orang Tua</h3>
            </div>
            <div class="card-body">
                <p><strong>Nama Ayah:</strong> Budi Pratama</p>
                <p><strong>Nama Ibu:</strong> Siti Nurhaliza</p>
                <p><strong>Alamat:</strong> Jl. Merdeka No.123, Jakarta Pusat</p>
                <p><strong>No. Handphone:</strong> 081234567891</p>

                <div class="mt-3">
                    <a href="#" class="btn btn-success">
                        <i class="fas fa-edit"></i> Edit Data
                    </a>
                    <a href="#" class="btn btn-outline-secondary">
                        <i class="fas fa-print"></i> Print Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistik -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>1,234</h3>
                <p>Total Siswa</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-graduate"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>89</h3>
                <p>Pendaftar Baru</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
</div>
@stop
