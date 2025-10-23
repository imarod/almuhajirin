@extends('layouts.adminlte-custom')

@section('content_header')
    <div class="container-fluid mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 font-weight-bold" style="color:#333333">Detail Pendaftaran</h1>
            </div>

        </div>
    </div>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <a href="{{ route('admin.pendaftar') }}?thn_ajaran={{ $lastFilters['thn_ajaran'] ?? '' }}&gelombang={{ $lastFilters['gelombang_pendaftaran'] ?? '' }}&status={{ $lastFilters['status_aktual'] ?? '' }}&page={{ $lastFilters['page'] ?? '' }}&per_page={{ $lastFilters['per_page'] ?? '' }}&search={{ $lastFilters['search'] ?? '' }}"
                    class="btn rounded-circle  border">
                    <i class="fas fa-arrow-left text-black"></i>
                </a>
                <div class="row d-flex ml-auto">
                    <form id="form-terima" class="mr-2" action="{{ route('admin.update-status', $pendaftars->id) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_aktual" value="Diterima">
                        <input type="hidden" name="thn_ajaran" value="{{ $lastFilters['thn_ajaran'] ?? '' }}">
                        <input type="hidden" name="gelombang_pendaftaran"
                            value="{{ $lastFilters['gelombang_pendaftaran'] ?? '' }}">
                        <input type="hidden" name="page" value="{{ $lastFilters['page'] ?? '' }}">
                        <input type="hidden" name="per_page" value="{{ $lastFilters['per_page'] ?? '' }}">
                        <input type="hidden" name="search" value="{{ $lastFilters['search'] ?? '' }}">
                        <button type="button" id="btn-terima" class="btn btn-success">
                            <i class="fas fa-check"></i> Terima
                        </button>
                    </form>
                    <form action="" class="mr-2">
                        <div>
                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                data-target="#modalPerbaikan">Perbaikan</button>
                        </div>
                    </form>
                    <form id="form-tolak" action="{{ route('admin.update-status', $pendaftars->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_aktual" value="Ditolak">
                        <input type="hidden" name="thn_ajaran" value="{{ $lastFilters['thn_ajaran'] ?? '' }}">
                        <input type="hidden" name="gelombang_pendaftaran"
                            value="{{ $lastFilters['gelombang_pendaftaran'] ?? '' }}">
                        <input type="hidden" name="page" value="{{ $lastFilters['page'] ?? '' }}">
                        <input type="hidden" name="per_page" value="{{ $lastFilters['per_page'] ?? '' }}">
                        <input type="hidden" name="search" value="{{ $lastFilters['search'] ?? '' }}">
                        <button type="button" id="btn-tolak" class="btn btn-danger">
                            <i class="fas fa-times"></i> Tolak
                        </button>
                    </form>

                </div>
            </div>


            {{-- Kolom Kiri --}}
            <div class="col-md-12">
                <div class="p-3">
                    <h5 class="mb-3" style="color: #2E8B57;"><strong>Data Calon Siswa</strong> </h5>
                    <div class="card">
                        <div class="row p-3">
                            <div class="col-md-4 mb-3  border-bottom">
                                {{-- <i class="fa fa-user text-success fs-3 me-2"></i> --}}
                                <p class="text-muted mb-1">Nama</p>
                                <strong class="text-dark">{{ $pendaftars->siswa->nama }}</strong>
                            </div>

                            <div class="col-md-4 mb-3 border-bottom">
                                {{-- <i class="fa fa-id-card text-success fs-3 me-2"></i> --}}
                                <p class="text-muted mb-1">NISN</p>
                                <strong class="text-dark">{{ $pendaftars->siswa->nisn }}</strong>
                            </div>

                            <div class="col-md-4 mb-3 border-bottom">
                                {{-- <i class="fa fa-venus-mars text-success fs-3 me-2"></i> --}}
                                <p class="text-muted mb-1">Jenis Kelamin</p>
                                <strong class="text-dark">{{ $pendaftars->siswa->jenis_kelamin }}</strong>
                            </div>

                            <div class="col-md-4 mb-3 border-bottom">
                                {{-- <i class="fa fa-map-marker-alt text-success fs-3 me-2"></i> --}}
                                <p class="text-muted mb-1">Tempat Lahir</p>
                                <strong class="text-dark">{{ $pendaftars->siswa->tempat_lahir }}</strong>
                            </div>

                            <div class="col-md-4 mb-3 border-bottom">
                                {{-- <i class="fa fa-calendar-alt text-success fs-3 me-2"></i> --}}
                                <p class="text-muted mb-1">Tanggal Lahir</p>
                                <strong class="text-dark">{{ $pendaftars->siswa->tanggal_lahir->format('d F Y') }}</strong>
                            </div>

                            <div class="col-md-4 mb-3 border-bottom">
                                {{-- <i class="fa fa-phone text-success fs-3 me-2"></i> --}}
                                <p class="text-muted mb-1">Nomor WhatsApp Siswa </p>
                                <strong class="text-dark">{{ $pendaftars->siswa->no_hp_siswa }}</strong>
                            </div>

                            <div class="col-md-4 mb-3">
                                {{-- <i class="fa fa-home text-success fs-3 me-2"></i> --}}

                                <p class="text-muted mb-1">Jurusan</p>
                                <strong class="text-dark">{{ $pendaftars->jurusan->nama_jurusan ?? '-' }}</strong>

                            </div>

                            <div class="col-md-4 mb-3">
                                {{-- <i class="fa fa-star text-success fs-3 me-2"></i> --}}
                                <p class="text-muted mb-1">Kategori Prestasi</p>
                                <strong
                                    class="text-dark">{{ $pendaftars->kategoriPrestasi->nama_prestasi ?? '-' }}</strong>
                            </div>

                            <div class="col-md-4 mb-3">
                                {{-- <i class="fa fa-envelope text-success fs-3 me-2"></i> --}}
                                <p class="text-muted mb-1">Email </p>
                                <strong class="text-dark">{{ $pendaftars->siswa->email_siswa }}</strong>
                            </div>

                            <div class="col-md-4 mb-3">
                                <p class="text-muted mb-1">Alamat Siswa</p>
                                <strong class="text-dark">{{ $pendaftars->siswa->alamat_siswa }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="p-3 bg-white">
                    <h5 class="mb-3" style="color: #2E8B57;"> <strong>Data Orang Tua/Wali</strong></h5>
                    <div class="card">
                        <div class="row p-3">
                            <div class="col-md-4 mb-3 border-bottom">
                                {{-- <i class="fa fa-user text-success fs-5 mr-3"></i> --}}
                                <p class="text-muted mb-1">Nama Ayah/Wali</p>
                                <strong class="text-dark">{{ $pendaftars->siswa->orangTua->nama_ayah }}</strong>
                            </div>
                            <div class="col-md-4 mb-3 border-bottom">
                                {{-- <i class="fa fa-user text-success fs-3 me-2"></i> --}}
                                <p class="text-muted mb-1">Nama Ibu</p>
                                <strong class="text-dark">{{ $pendaftars->siswa->orangTua->nama_ibu }}</strong>
                            </div>
                            <div class="col-md-4 mb-3 border-bottom">
                                {{-- <i class="fa fa-home text-success fs-3 me-2"></i> --}}
                                <p class="text-muted mb-1">Alamat Orang Tua/Wali</p>
                                <strong class="text-dark">{{ $pendaftars->siswa->orangTua->alamat_ortu }}</strong>
                            </div>
                            <div class="col-md-4 mb-3">
                                {{-- <i class="fa fa-phone text-success fs-3 me-2"></i> --}}
                                <p class="text-muted mb-1">Nomor WhatsApp Orang Tua/Wali</p>
                                <strong class="text-dark">{{ $pendaftars->siswa->orangTua->no_hp_ortu }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="p-3 bg-white">
                    <h5 class="mb-3" style="color: #2E8B57;"><strong>Dokumen Siswa</strong> </h5>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-file-pdf fa-2x text-danger mr-3"></i>
                            <div>
                                <div class="font-weight-bold">Ijazah</div>
                                <small class="text-muted">PDF - Maks 1 Mb</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            @if ($pendaftars->ijazah)
                                <button type="button" class="btn btn-outline-success btn-sm"
                                    onclick="showPdfModal('{{ asset('storage/' . $pendaftars->ijazah) }}', 'Ijazah - {{ $pendaftars->siswa->nama }}')">
                                    <i class="fas fa-eye"></i> Lihat
                                </button>
                            @else
                                <span class="text-muted">Tidak ada file</span>
                            @endif
                        </div>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-file-pdf fa-2x text-danger mr-3"></i>
                            <div>
                                <div class="font-weight-bold">Kartu Keluarga</div>
                                <small class="text-muted">PDF - Maks 1 Mb</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            @if ($pendaftars->kk)
                                <button type="button" class="btn btn-outline-success btn-sm"
                                    onclick="showPdfModal('{{ asset('storage/' . $pendaftars->kk) }}', 'Kartu Keluarga - {{ $pendaftars->siswa->nama }}')">
                                    <i class="fas fa-eye"></i> Lihat
                                </button>
                            @else
                                <span class="text-muted">Tidak ada file</span>
                            @endif
                        </div>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-file-pdf fa-2x text-danger mr-3"></i>
                            <div>
                                <div class="font-weight-bold">Piagam Penghargaan</div>
                                <small class="text-muted">PDF - Maks 1 Mb</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            @if ($pendaftars->piagam)
                                <button type="button" class="btn btn-outline-success btn-sm"
                                    onclick="showPdfModal('{{ asset('storage/' . $pendaftars->piagam) }}','Piagam Penghargaan - {{ $pendaftars->siswa->nama }}')">
                                    <i class="fas fa-eye"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada file</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="pdfPreviewModal" tabindex="-1" aria-labelledby="pdfPreviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl dialog-centered" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="" id="pdfPreviewModalLabel">Pratinjau Dokumen</h5>
                    <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe id="pdfFrame" style="width:100%; height:100%; border:0;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalPerbaikan" tabindex="-1" role="dialog" aria-labelledby="modalPerbaikanLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPerbaikanLabel">Tambah Catatan Perbaikan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formPerbaikan" action="{{ route('admin.update-perbaikan-status', $pendaftars->id) }}"
                        method="POST">
                        @csrf

                        <input type="hidden" name="thn_ajaran" value="{{ $lastFilters['thn_ajaran'] ?? '' }}">
                        <input type="hidden" name="gelombang_pendaftaran"
                            value="{{ $lastFilters['gelombang_pendaftaran'] ?? '' }}">
                        <input type="hidden" name="page" value="{{ $lastFilters['page'] ?? '' }}">
                        <input type="hidden" name="per_page" value="{{ $lastFilters['per_page'] ?? '' }}">
                        <input type="hidden" name="search" value="{{ $lastFilters['search'] ?? '' }}">

                        <div class="form-group">
                            <label for="catatan">Catatan Perbaikan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3"
                                placeholder="Contoh: Dokumen Kartu Keluarga kurang jelas, mohon upload ulang dengan kualitas lebih baik." required></textarea>
                        </div>

                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <button type="submit" form="formPerbaikan" class="btn"
                        style="background-color:  #31708F; color:white;">Simpan</button>
                    <button type="button" class="btn btn-default mr-2" data-dismiss="modal">Batal</button>

                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        function showPdfModal(url, title) {
            document.getElementById('pdfPreviewModalLabel').textContent = title;
            document.getElementById('pdfFrame').src = url;
            $('#pdfPreviewModal').modal('show');
        }


        $('#pdfPreviewModal').on('hidden.bs.modal', function() {
            document.getElementById('pdfFrame').src = '';
        });

        document.getElementById('btn-terima').addEventListener('click', function(e) {
            e.preventDefault()
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Status pendaftaran akan diubah menjadi 'Diterima'.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Terima!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Konfirmasi penerimaan berhasil. Anda akan diarahkan ke halaman pendaftar.',
                        icon: 'success',
                        timer: 1000,
                        timerProgressBar: true,
                        showConfirmButton: false,

                    }).then(() => {
                        document.getElementById('form-terima').submit();
                    })
                }
            })
        })

        document.getElementById('btn-tolak').addEventListener('click', function(e) {
            e.preventDefault()
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Status pendaftaran akan diubah menjadi 'Ditolak'.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Tolak!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Konfirmasi penolakan berhasil. Anda akan diarahkan ke halaman pendaftar.',
                        icon: 'success',
                        timer: 1000,
                        timerProgressBar: true,
                        showConfirmButton: false,

                    }).then(() => {
                        document.getElementById('form-tolak').submit();
                    });
                }
            });
        });

        $('#formPerbaikan').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            Swal.fire({
                title: 'Kirim Catatan Perbaikan?',
                text: "Status pendaftaran akan diubah menjadi 'Perbaikan' dan catatan akan dikirim.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Kirim ',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mengirim...',
                        text: 'Silakan tunggu sebentar.',
                        icon: 'info',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    form.submit();
                }
            });
        });

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}"
            });
        @endif

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}"
            });
        @endif
    </script>
@endpush
