@extends('adminlte::page')

@section('content')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pendaftar</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Pendaftar</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <div class="card">
            <div class="card-body">

                <!-- Filter dan Search -->
                <div class="row mb-3 filter-area">
                    <div class="col-md-6 d-flex">
                        <button class="btn btn-dark btn-sm">
                            <i class="fas fa-file-excel mr-1"></i> Download Excel
                        </button>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <input type="text" class="form-control form-control-sm mr-2" placeholder="Search">
                        <select class="form-control form-control-sm" style="max-width: 120px;">
                            <option>Filter</option>
                            <option>Diterima</option>
                            <option>Belum Diproses</option>
                        </select>
                    </div>
                </div>

                <!-- Tabel -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="bg-light">
                            <tr class="text-center">
                                <th style="width: 5%;">No.</th>
                                <th>Nama Lengkap</th>
                                <th>NISN</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1.</td>
                                <td>Balaji Nant</td>
                                <td>23432151</td>
                                <td><span class="status-badge status-diterima">Diterima</span></td>
                                <td class="text-center action-icons">
                                    <a href="{{ route('admin.detail-pendaftar') }}"><i class="fas fa-eye text-secondary" title="Lihat"></i></a>
                                    <i class="fas fa-trash text-danger" title="Hapus"></i>
                                    <i class="fas fa-edit text-dark" title="Edit"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2.</td>
                                <td>Nithya Menon</td>
                                <td>23432152</td>
                                <td><span class="status-badge status-belum">Belum Diprosesdsdssds</span></td>
                                <td class="text-center action-icons">
                                    <i class="fas fa-eye text-secondary" title="Lihat"></i>
                                    <i class="fas fa-trash text-danger" title="Hapus"></i>
                                    <i class="fas fa-edit text-dark" title="Edit"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3.</td>
                                <td>Meera Gonzalez</td>
                                <td>23432153</td>
                                <td><span class="status-badge status-belum">Belum Diproses</span></td>
                                <td class="text-center action-icons">
                                    <i class="fas fa-eye text-secondary" title="Lihat"></i>
                                    <i class="fas fa-trash text-danger" title="Hapus"></i>
                                    <i class="fas fa-edit text-dark" title="Edit"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">4.</td>
                                <td>Karthik Subramanian</td>
                                <td>23432154</td>
                                <td><span class="status-badge status-diterima">Diterima</span></td>
                                <td class="text-center action-icons">
                                    <i class="fas fa-eye text-secondary" title="Lihat"></i>
                                    <i class="fas fa-trash text-danger" title="Hapus"></i>
                                    <i class="fas fa-edit text-dark" title="Edit"></i>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">5.</td>
                                <td>Mithra B</td>
                                <td>23432155</td>
                                <td><span class="status-badge status-diterima">Diterima</span></td>
                                <td class="text-center action-icons ">
                                    <i class="fas fa-eye text-secondary" title="Lihat"></i>
                                    <i class="fas fa-trash text-danger" title="Hapus"></i>
                                    <i class="fas fa-edit text-dark" title="Edit"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-end align-items-center mt-3">
                    <small class="mr-3 text-muted">1 - 10 of 52</small>
                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                            <li class="page-item"><a class="page-link" href="#">›</a></li>
                        </ul>
                    </nav>
                </div>

            </div>


        </div>
        </div>
    </div>
@endsection