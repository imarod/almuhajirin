@extends('layouts.adminlte-custom')

@section('content_header')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 font-weight-bold text-dark">Pendaftaran</h1>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-start">
            <div class="col-md-12">
                <x-jadwal-ppdb-aktif />
                <div class="card p-4 border-0 shadow-sm rounded-lg" style="background-color: #f8f9fa;">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle p-2 d-flex justify-content-center align-items-center mr-3"
                            style="background-color: rgba(94, 124, 227, 0.3); width: 40px; height: 40px;">
                            <i class="far fa-check-circle text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <div>
                            <h5 class="font-weight-bold mb-0 text-primary">Selamat Datang di Portal PPDB Online!</h5>
                            <p class="text-secondary small mb-0">Sebelum memulai proses pendaftaran, mohon pastikan Anda
                                telah menyiapkan dokumen-dokumen berikut:</p>
                        </div>
                    </div>

                    <div class="row text-center my-4">
                        <div class="col-md-4 mb-3">
                            <div class="card p-3 border-0 shadow-sm rounded-lg h-100 d-flex flex-column align-items-center"
                                style="background-color: rgba(94, 124, 227, 0.1);">
                                <div class="rounded-circle p-2 d-flex justify-content-center align-items-center"
                                    style="background-color: rgba(94, 124, 227, 0.3); width: 50px; height: 50px; position: relative;">
                                    <h5 class="text-white mb-0"
                                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">1
                                    </h5>
                                    <i class="fas fa-user text-white" style="font-size: 2rem;"></i>
                                </div>
                                <div class="mt-3">
                                    <p class="mb-0">Kartu Keluarga</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card p-3 border-0 shadow-sm rounded-lg h-100 d-flex flex-column align-items-center"
                                style="background-color: rgba(60, 179, 113, 0.1);">
                                <div class="rounded-circle p-2 d-flex justify-content-center align-items-center"
                                    style="background-color: rgba(60, 179, 113, 0.3); width: 50px; height: 50px; position: relative;">
                                    <h5 class="text-white mb-0"
                                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">2
                                    </h5>
                                    <i class="fas fa-file-alt text-white" style="font-size: 2rem;"></i>
                                </div>
                                <div class="mt-3">
                                    <p class="mb-0">Ijazah</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card p-3 border-0 shadow-sm rounded-lg h-100 d-flex flex-column align-items-center"
                                style="background-color: rgba(255, 165, 0, 0.1);">
                                <div class="rounded-circle p-2 d-flex justify-content-center align-items-center"
                                    style="background-color: rgba(255, 165, 0, 0.3); width: 50px; height: 50px; position: relative;">
                                    <h5 class="text-white mb-0"
                                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">3
                                    </h5>
                                    <i class="fas fa-trophy text-white" style="font-size: 2rem;"></i>
                                </div>
                                <div class="mt-3">
                                    <p class="mb-0">Piagam (Opsional)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert text-center rounded-lg d-flex align-items-center justify-content-center mb-0"
                        style="background-color: #f0f4ff;">
                        <i class="fas fa-lightbulb text-warning mr-2"></i>
                        <p class="text-muted mb-0 small">Ikuti setiap langkah dengan teliti dan pastikan data yang diisi
                            sudah benar.</p>
                    </div>
                </div>

                <div class="card">

                    <div class="card-body" style="margin-top: -10px;">
                        <div class="row" style="margin-left: 4px; margin-bottom: -0px;">
                            <p><strong> Data Pendaftaran</strong></p>

                        </div>
                        <div class="table-responsive">
                            <table id="pendaftaranTable" class="table table-striped table-hover">
                                <thead class="bg-basic">
                                    <tr>
                                        <th class="border-0 text-white" style=" border-top-left-radius: 0.5rem !important">
                                            No
                                        </th>
                                        <th class="border-0 text-white">Nama Lengkap</th>
                                        <th class="border-0 text-white">NISN</th>
                                        <th class="border-0 text-white">Jenis Kelamin</th>
                                        <th class="border-0 text-white">Tgl Daftar</th>
                                        <th class="border-0 text-white">Status</th>
                                        <th class="border-0 text-white" style="border-top-right-radius: 0.5rem !important">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($pendaftarans) && $pendaftarans->isEmpty())
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <div colspan="9" class="text-center py-3">
                                                    <i class="fas fa-history fa-2x text-muted mb-3"
                                                        style="opacity: 0.3;"></i>
                                                    <h5 class="text-muted">Belum ada data pendaftaran.</h5>
                                                    <p class="text-muted ">Buat pendaftaran baru</p>

                                                    <a href="{{ route('formulir-siswa') }}"
                                                        class="btn bg-basic text-white px-4">Daftar</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($pendaftarans as $pendaftaran)
                                            @php
                                                $status = $pendaftaran->showStatusPendaftar();
                                                $statusClass = 'status-badge status-' . str_replace(' ', '', strtolower($status));
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pendaftaran->siswa->nama }}</td>
                                                <td>{{ $pendaftaran->siswa->nisn }}</td>
                                                <td>{{ $pendaftaran->siswa->jenis_kelamin }}</td>
                                                <td class="text-muted">{{ $pendaftaran->created_at->format('d-m-Y') }}</td>
                                                <td><span class="{{ $statusClass }}">
                                                    {{ $status }}
                                                </span></td>
                                                <td class="action-icons">
                                                    @php
                                                        $jadwalSelesai =
                                                            $pendaftaran->jadwal &&
                                                            \Carbon\Carbon::parse(
                                                                $pendaftaran->jadwal->tgl_berakhir,
                                                            )->isPast();
                                                    @endphp
                                                    @if ($pendaftaran->status_aktual === null && !$jadwalSelesai)
                                                        <a href="{{ route('formulir.edit', $pendaftaran->id) }}">
                                                            <i class="fas fa-edit text-primary me-2" title="Edit"></i>
                                                        </a>
                                                    @else
                                                        <i class="fas fa-edit text-muted me-2"
                                                            title="Tidak dapat diedit"></i>
                                                    @endif
                                                    <form action="{{ route('pendaftaran.destroy', $pendaftaran->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link p-0 delete-btn"
                                                            title="Hapus">
                                                            <i class="fas fa-trash text-danger"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
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

           

            $('.delete-btn').on('click', function(e) {
                e.preventDefault();
                const form = $(this).closest('form');
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
                        form.submit();
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
    </script>
@stop
