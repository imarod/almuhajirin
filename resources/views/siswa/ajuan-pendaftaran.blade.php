@extends('adminlte::page')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pendaftaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pendaftaran</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row justify-content-start">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                       @if (isset($pendaftaran) && $pendaftaran->isEmpty())
                            <div class="alert alert-info">
                                belum ada pengajuan pendaftaran.
                            </div>

                             <!-- Top controls -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>
                                        Show
                                        <select class="custom-select custom-select-sm form-control form-control-sm"
                                            style="width: auto; display: inline-block;">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                        </select>
                                        entries
                                    </label>
                                </div>
                                <div class="col-md-6 ms-auto">
                                    <div
                                        class="d-flex flex-md-row flex-column align-items-md-center align-items-start justify-content-md-end gap-2">
                                        <label class="d-flex align-items-center mb-0">
                                            Search:
                                            <input type="search" class="form-control form-control-sm ms-2" placeholder="">
                                        </label>
                                        <a href="{{ route('formulir-siswa') }}"
                                            class="btn btn-sm btn-primary mt-2 mt-md-0">Tambah</a>
                                    </div>
                                </div>


                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No. Pendaftaran</th>
                                            <th>Tgl Daftar</th>
                                            <th>Nama Lengkap</th>
                                            <th>NISN</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><strong></strong></td>
                                                <td></td>

                                                <td><span class="badge badge-warning"></span></td>
                                                <td class="text-center action-icons">
                                                    <a href="{{ route('pendaftaran.detail') }}">
                                                        <i class="fas fa-edit text-primary me-2" title="Edit"></i>
                                                    </a>
                                                    <i class="fas fa-trash text-danger" title="Hapus"></i>
                                                </td>
                                        </tr>
                                        <!-- Tambahkan baris lainnya sesuai kebutuhan -->
                                    </tbody>
                                </table>
                            </div>

                            <!-- Bottom controls -->
                            <div class="row mt-3">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info">Showing 1 to 10 of 52 entries</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <nav aria-label="Page navigation" class="float-right">
                                        <ul class="pagination pagination-sm mb-0">
                                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a>
                                            </li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        @else
                            <!-- Top controls -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>
                                        Show
                                        <select class="custom-select custom-select-sm form-control form-control-sm"
                                            style="width: auto; display: inline-block;">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                        </select>
                                        entries
                                    </label>
                                </div>
                                <div class="col-md-6 ms-auto">
                                    <div
                                        class="d-flex flex-md-row flex-column align-items-md-center align-items-start justify-content-md-end gap-2">
                                        <label class="d-flex align-items-center mb-0">
                                            Search:
                                            <input type="search" class="form-control form-control-sm ms-2" placeholder="">
                                        </label>
                                        <a href="{{ route('formulir-siswa') }}"
                                            class="btn btn-sm btn-primary mt-2 mt-md-0">Tambah</a>
                                    </div>
                                </div>


                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No. Pendaftaran</th>
                                             <th>Nama Lengkap</th>
                                            <th>NISN</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tgl Daftar</th>
                                           
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pendaftarans as $pendaftaran)
                                            <tr>
                                                <td>{{ $pendaftaran->siswa->id}}</td>
                                                 <td>{{ $pendaftaran->siswa->nama }}</td>
                                                <td><strong>{{ $pendaftaran->siswa->nisn }} </strong></td>
                                                <td>{{ $pendaftaran->siswa->jenis_kelamin }}</td>
                                                <td>{{ $pendaftaran->created_at->format('d-m-Y') }}</td>
                                               

                                                <td><span class="badge badge-warning">{{ $pendaftaran->status_verifikasi }}</span></td>
                                                <td class="text-center action-icons">
                                                    <a href="{{ route('pendaftaran.detail') }}">
                                                        <i class="fas fa-edit text-primary me-2" title="Edit"></i>
                                                    </a>
                                                    <i class="fas fa-trash text-danger" title="Hapus"></i>
                                                </td>
                                        @endforeach
                                        </tr>
                                        <!-- Tambahkan baris lainnya sesuai kebutuhan -->
                                    </tbody>
                                </table>
                            </div>

                            <!-- Bottom controls -->
                            <div class="row mt-3">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info">Showing 1 to 10 of 52 entries</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <nav aria-label="Page navigation" class="float-right">
                                        <ul class="pagination pagination-sm mb-0">
                                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a>
                                            </li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

@stop
