@extends('layouts.adminlte-custom')

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
                {{-- @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif --}}

                <div class="card">
                    <div class="card-body">
                        {{-- header table setting --}}
                        <div class="row align-items-center mb-6">
                            <div class="col-md-8">
                                <div class="d-flex align-items-center flex-wrap">
                                    <div class="d-flex align-items-center mr-3">
                                        <span class="text-muted">Show</span>
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
                                    <a href="{{ route('formulir-siswa') }}"
                                        class="btn btn-sm bg-basic text-white mt-0 d-flex align-items-center justify-content-center"><strong>Tambah</strong> </a>
                                </div>
                            </div>
                        </div>



                        <div class="table-responsive">
                            <table id="pendaftaranTable" class="table table-striped table-hover">
                                <thead class="bg-basic">
                                    <tr>
                                        <th class="border-0 text-white" style=" border-top-left-radius: 0.5rem !important">No
                                        </th>
                                        <th class="border-0 text-white" >Nama Lengkap</th>
                                        <th class="border-0 text-white">NISN</th>
                                        <th class="border-0 text-white">Jenis Kelamin</th>
                                        <th class="border-0 text-white">Tgl Daftar</th>
                                        <th class="border-0 text-white">Status</th>
                                        <th class="border-0 text-white" style="border-top-right-radius: 0.5rem !important">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    @if (isset($pendaftarans) && $pendaftarans->isEmpty())
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data pendaftaran</td>
                                        </tr>
                                    @else
                                        @foreach ($pendaftarans as $pendaftaran)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pendaftaran->siswa->nama }}</td>
                                                <td>{{ $pendaftaran->siswa->nisn }}</td>
                                                <td>{{ $pendaftaran->siswa->jenis_kelamin }}</td>
                                                <td class="text-muted">{{ $pendaftaran->created_at->format('d-m-Y') }}</td>
                                                <td><span
                                                        class="badge badge-warning text-white py-2 px-3">{{ $pendaftaran->showStatusPendaftar() }}</span>
                                                </td>
                                                <td class="action-icons">
                                                    <a href="{{ route('formulir.edit', $pendaftaran->id) }}">
                                                        <i class="fas fa-edit text-primary me-2" title="Edit"></i>
                                                    </a>
                                                    <i class="fas fa-trash text-danger delete-btn" title="Hapus"
                                                        data-id="{{ $pendaftaran->id }}"></i>
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
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data pendaftaran ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            let PendaftaranIdToDelete

            $('.delete-btn').on('click', function(e) {
                e.preventDefault()
                PendaftaranIdToDelete = $(this).data('id')
                let row = $(this).closest('tr');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan bisa mengembalikan data ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/pendaftaran/${PendaftaranIdToDelete}`,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    row.remove();
                                    Swal.fire(
                                        'Dihapus!',
                                        'Data pendaftaran berhasil dihapus.',
                                        'success'
                                    );
                                    if ($('#pendaftaranTable tbody tr').length === 0) {
                                        showNoDataMessage();
                                    }

                                } else {
                                    Swal.fire(
                                        'Gagal!',
                                        'Terjadi kesalahan saat menghapus data.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus data.',
                                    'error'
                                );
                                console.log(xhr.responseText);
                            }
                        });
                    }
                });
            });

            function showNoDataMessage() {
                const tableBody = $('#pendaftaranTable tbody');
                tableBody.empty();
                tableBody.append(`<tr><td colspan="7" class="text-center">Tidak ada data pendaftaran</td></tr>`);
            }

            if ($('#pendaftaranTable tbody tr').length === 0) {
                showNoDataMessage();
            }


        });

        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}'
                });
            @endif
        });
    </script>
@stop
