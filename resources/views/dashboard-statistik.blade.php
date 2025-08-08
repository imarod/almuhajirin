@extends('layouts.adminlte-custom')

@section('content') 
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard Statistik</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Pendaftar</li>
                    </ol>
                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>125</h3>
                                    <p>Total Pendaftar</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>113</h3>
                                    <p>Total Diterima</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>12</h3>
                                    <p>Total Ditolak</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown Tahun Ajaran -->
                    <div class="form-group">
                        <label for="tahunSelect">Tahun Ajaran</label>
                        <select class="form-control" id="tahunSelect">
                            <option>2021</option>
                            <option>2022</option>
                            <option>2023</option>
                            <option selected>2024</option>
                            <option>2025</option>
                            <option>2026</option>
                            <option>2027</option>
                        </select>
                    </div>

                    <!-- Grafik Pendaftaran -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Grafik Perbandingan Jumlah Pendaftar Tahun Ajaran 2024</h5>
                            <canvas id="chartPendaftar"></canvas>
                        </div>
                    </div>

                    <!-- Grafik Jenis Kelamin -->
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title text-center">Jumlah Pendaftar Berdasarkan Jenis Kelamin</h5>
                            <canvas id="chartGender"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
