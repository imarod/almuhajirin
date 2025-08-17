@extends('layouts.adminlte-custom')
@section('content_header')
  <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 font-weight-bold text-dark">Data Seluruh Pendaftar</h1>
            </div>

        </div>
    </div>
@stop

@section('content')
        <div class="container-fluid">
            {{-- <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pendaftar</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Pendaftar</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row --> --}}

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
                                    <th>No HP</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendaftars as $pendaftar)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}.</td>
                                        <td>{{ $pendaftar->siswa->nama ?? '-' }}</td>
                                        <td>{{ $pendaftar->siswa->nisn ?? '-' }}</td>
                                        <td>{{$pendaftar->siswa->no_hp_siswa}}</td>
                                        <td><span
                                                class="status-badge status-diterima">{{ $pendaftar->status_aktual ?? '-' }}</span>
                                        </td>
                                        <td class="text-center action-icons">
                                            <a href="{{ route('admin.detail-pendaftar', ['id' => $pendaftar->id]) }}"><i
                                                    class="fas fa-eye text-secondary" title="Lihat"></i></a>
                                            <i class="fas fa-trash text-danger" title="Hapus"></i>
                                            <i class="fas fa-edit text-dark" title="Edit"></i>
                                        </td>
                                    </tr>
                                @endforeach
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
@endsection
