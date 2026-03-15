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

                <div class="card p-4 border-0 shadow-sm rounded-lg" style="background-color: #f8f9fa;">
                    <div class="d-flex align-items-center mb-3">
                        <div>
                            <h5 class="font-weight-bold mb-0" style="color: #2E8B57;">Selamat Datang di Portal PPDB Online!
                            </h5>
                            <p class="text-secondary small mb-0">Sebelum memulai proses pendaftaran, mohon pastikan Anda
                                telah menyiapkan dokumen-dokumen sesuai dengan syarat pendaftaran</p>
                        </div>
                    </div>

                     <div class="card mb-3 p-3 border-0 shadow-sm h-100 d-flex flex-column"
                            style="background-color: #D8EEDD">
                            <p class="mb-0 text-success font-weight-bold">Perhatian!</p>
                            <ul>
                                <li>Data yang telah dikirim masih bisa dilakukan perubahan selama belum diverifikasi oleh
                                    panitia PPDB.</li>
                                <li>Fitur "Edit Formulir" akan hilang setelah data diverifikasi oleh panitia.</li>
                                <li>Panitia dapat meminta pengiriman ulang jika ada perbaikan.</li>
                                <li>Kirimkan data perbaikan sebelum batas waktu pendaftaran berakhir.</li>
                                <li>Hasil seleksi diumumkan melalui email peserta.</li>
                            </ul>

                        </div>


                </div>

                <div class="card">
                    <div class="card-header bg-basic text-white">
                        <h5 class="mb-0 font-weight-bold">Data Pendaftaran</h5>
                    </div>
                    <div class="card-body">
                        @if (isset($pendaftarans) && $pendaftarans->isEmpty())
                            <tr>
                                <x-jadwal-ppdb-aktif />

                                <td colspan="" class="text-center">
                                    <div colspan="9" class="text-center py-3">
                                        <i class="fas fa-history fa-2x text-muted mb-3" style="opacity: 0.3;"></i>
                                        <h5 class="text-muted">Belum ada data pendaftaran.</h5>
                                        <p class="text-muted ">Buat pendaftaran baru</p>

                                        <a href="{{ route('formulir-siswa') }}" class="btn text-white px-4"
                                            style="background-color: #31708F;">Daftar</a>
                                    </div>
                                </td>
                            </tr>
                        @else
                            @foreach ($pendaftarans as $pendaftaran)
                                @php
                                    $status = $pendaftaran->showStatusPendaftar();
                                    $statusClass = 'status-badge status-' . str_replace(' ', '', strtolower($status));
                                @endphp
                                <x-jadwal-ppdb-aktif />


                                <div class="row px-3">
                                    <div class="col-md-4 mb-3 border-bottom">
                                        <p class="text-muted mb-1">Nama</p>
                                        <strong class="text-dark">{{ $pendaftaran->siswa->nama }}</strong>
                                    </div>
                                    <div class="col-md-4 mb-3 border-bottom">
                                        <p class="text-muted mb-1">NISN</p>
                                        <strong class="text-dark">{{ $pendaftaran->siswa->nisn }}</strong>
                                    </div>
                                    <div class="col-md-4 mb-3 border-bottom">
                                        <p class="text-muted mb-1">Status Pendaftaran</p>
                                        <span class="{{ $statusClass }}">
                                            {{ $status }}
                                        </span>
                                    </div>

                                </div>

                                <div class="row px-3">
                                    <div class="col-md-4 mb-3 border-bottom">
                                        <p class="text-muted mb-1">Tanggal Daftar</p>
                                        <strong class="text-dark">{{ $pendaftaran->created_at->format('d F Y') }}</strong>
                                    </div>
                                    <div class="col-md-4 mb-3 border-bottom">
                                        <p class="text-muted mb-1">Catatan Perbaikan</p>
                                        <strong class="text-dark"> {{ $pendaftaran->catatan ?? '-' }}</strong>
                                    </div>

                                </div>

                                <div class="d-flex flex-column flex-sm-row gap-3 mt-3">
                                    @php
                                        $jadwalSelesai =
                                            $pendaftaran->jadwal &&
                                            \Carbon\Carbon::parse($pendaftaran->jadwal->tgl_berakhir)->isPast();
                                    @endphp
                                    @if ($pendaftaran->status_aktual === null && !$jadwalSelesai)
                                        <a href="{{ route('formulir.edit', $pendaftaran->id) }}"
                                            class="btn px-4 mr-2 mb-2 mb-sm-0"
                                            style="background-color: #31708F; color: white;">
                                            Edit Formulir
                                        </a>
                                    @else
                                        {{-- <button class="btn btn-secondary px-4 mr-2 mb-2 mb-sm-0" title="Tidak dapat diedit">Tidak Dapat Diedit</button> --}}
                                    @endif
                                    <form action="{{ route('pendaftaran.destroy', $pendaftaran->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger px-4 delete-btn w-100 w-md-auto"
                                            title="Hapus">Hapus Formulir
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

@stop

@section('js')


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
