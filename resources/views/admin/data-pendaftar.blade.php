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

                <div class="row align-items-center mb-6">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center flex-wrap">
                            <div class="d-flex align-items-center mr-3">
                                <span class="text-dark">Show</span>
                                <select class="form-control form-control-sm mx-2" style="width: auto;">
                                    <option>10</option>
                                    <option>25</option>
                                    <option>50</option>
                                </select>
                                <span class="text-muted small">entries</span>
                            </div>
                            <button class="btn btn-outline-secondary btn-sm d-flex align-items-center mr-2">
                                <i class="fas fa-filter text-muted mr-2"></i>
                                Filter
                            </button>
                            <button class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                                <i class="fas fa-download text-muted mr-2"></i>
                                Export
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4 mt-4 mt-md-0">
                        <div class="d-flex align-item-center gap-2">
                            <div class="position-relative w-100"> <input type="text" class="form-control"
                                    placeholder="Search..." style="padding-left: 2.5rem;">
                                <i class="fas fa-search position-absolute text-muted"
                                    style="left: 0.75rem; top: 50%; transform: translateY(-50%);"></i>
                            </div>
                            <select class="form-control form-control" style="max-width: 120px;">
                                <option>Filter</option>
                                <option>Diterima</option>
                                <option>Belum Diproses</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Tabel -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped ">
                        <thead class="bg-basic">
                            <tr class="">
                                <th class="border-0 text-white" style="border-top-left-radius: 0.5rem !important">No.</th>
                                <th class="border-0 text-white">Nama Lengkap</th>
                                <th class="border-0 text-white">NISN</th>
                                <th class="border-0 text-white">Jenis Kelamin</th>
                                <th class="border-0 text-white">No Handphone</th>
                                <th class="border-0 text-white text-center">Status</th>
                                <th class="border-0 text-white text-center"
                                    style="border-top-right-radius: 0.5rem !important">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($pendaftars) && $pendaftars->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data pendaftar</td>
                                </tr>
                            @else
                                @foreach ($pendaftars as $pendaftar)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $pendaftar->siswa->nama ?? '-' }}</td>
                                        <td>{{ $pendaftar->siswa->nisn ?? '-' }}</td>
                                        <td>{{ $pendaftar->siswa->jenis_kelamin ?? '-' }}</td>
                                        <td>{{ $pendaftar->siswa->no_hp_siswa }}</td>
                                        <td class="text-center"><span
                                                class="status-badge status-diterima ">{{ $pendaftar->status_aktual ?? '-' }}</span>
                                        </td>
                                        <td class=" text-center action-icons">
                                            <a href="{{ route('admin.detail-pendaftar', ['id' => $pendaftar->id]) }}"><i
                                                    class="fas fa-eye text-secondary" title="Lihat"></i></a>
                                            <i class="fas fa-trash text-danger" title="Hapus"></i>
                                            <i class="fas fa-edit text-primary" title="Edit"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                {{-- pagination --}}
                <div class="row mt-3">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info text-muted">Showing 1 to 10 of 52 entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <nav aria-label="Page navigation" class="float-right">
                            <ul class="pagination pagination-sm mb-0">
                                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>


        </div>
    </div>
@endsection
