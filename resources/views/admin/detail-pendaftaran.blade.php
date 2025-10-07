@extends('layouts.adminlte-custom')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Pendaftaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Detail Pendaftaran</li>
                    </ol>
                </div>
            </div>


            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.pendaftar') }}?thn_ajaran={{ $lastFilters['thn_ajaran'] ?? '' }}&gelombang={{ $lastFilters['gelombang_pendaftaran'] ?? '' }}&status={{ $lastFilters['status_aktual'] ?? '' }}&page={{ $lastFilters['page'] ?? '' }}&per_page={{ $lastFilters['per_page'] ?? '' }}&search={{ $lastFilters['search'] ?? '' }}"
                        class="btn rounded-circle  border">
                        <i class="fas fa-arrow-left text-black"></i>
                    </a>
                    <div class="d-flex ms-auto gap-2">
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
                    <form id="form-terima" action="{{ route('admin.update-status', $pendaftars->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_aktual" value="Diterima">
                        <input type="hidden" name="thn_ajaran" value="{{ $lastFilters['thn_ajaran'] ?? '' }}">
                        <input type="hidden" name="gelombang_pendaftaran"
                            value="{{ $lastFilters['gelombang_pendaftaran'] ?? '' }}">
                        <input type="hidden" name="page" value="{{ $lastFilters['page'] ?? '' }}">
                        <input type="hidden" name="per_page" value="{{ $lastFilters['per_page'] ?? '' }}">
                        <input type="hidden" name="search" value="{{ $lastFilters['search'] ?? '' }}">
                        <button type="button" id="btn-terima" class="btn btn-primary">
                            <i class="fas fa-check"></i> Terima
                        </button>
                    </form>
                    </div>
                  
                </div>


                {{-- Kolom Kiri --}}
                <div class="col-md-12">
                    <div class="p-3">
                        <h5 class="text-primary mb-3"><strong>Data Calon Siswa</strong> </h5>
                        <div class="card">
                            <div class="row p-3">
                                <div class="col-md-4 mb-3  border-bottom">
                                    <i class="fa fa-user text-primary fs-3 me-2"></i>
                                    <p class="text-muted mb-1">Nama</p>
                                    <strong class="text-dark">{{ $pendaftars->siswa->nama }}</strong>
                                </div>

                                <div class="col-md-4 mb-3 border-bottom">
                                    <i class="fa fa-id-card text-primary fs-3 me-2"></i>
                                    <p class="text-muted mb-1">NISN</p>
                                    <strong class="text-dark">{{ $pendaftars->siswa->nisn }}</strong>
                                </div>

                                <div class="col-md-4 mb-3 border-bottom">
                                    <i class="fa fa-venus-mars text-primary fs-3 me-2"></i>
                                    <p class="text-muted mb-1">Jenis Kelamin</p>
                                    <strong class="text-dark">{{ $pendaftars->siswa->jenis_kelamin }}</strong>
                                </div>

                                <div class="col-md-4 mb-3 border-bottom">
                                    <i class="fa fa-map-marker-alt text-primary fs-3 me-2"></i>
                                    <p class="text-muted mb-1">Tempat Lahir</p>
                                    <strong class="text-dark">{{ $pendaftars->siswa->tempat_lahir }}</strong>
                                </div>

                                <div class="col-md-4 mb-3 border-bottom">
                                    <i class="fa fa-calendar-alt text-primary fs-3 me-2"></i>
                                    <p class="text-muted mb-1">Tanggal Lahir</p>
                                    <strong
                                        class="text-dark">{{ $pendaftars->siswa->tanggal_lahir->format('d-m-Y') }}</strong>
                                </div>

                                <div class="col-md-4 mb-3 border-bottom">
                                    <i class="fa fa-phone text-primary fs-3 me-2"></i>
                                    <p class="text-muted mb-1">No WhatsApp </p>
                                    <strong class="text-dark">{{ $pendaftars->siswa->no_hp_siswa }}</strong>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <i class="fa fa-home text-primary fs-3 me-2"></i>
                                    <p class="text-muted mb-1">Alamat </p>
                                    <strong class="text-dark">{{ $pendaftars->siswa->alamat_siswa }}</strong>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <i class="fa fa-star text-primary fs-3 me-2"></i>
                                    <p class="text-muted mb-1">Kategori Prestasi</p>
                                    <strong class="text-dark">{{ $pendaftars->siswa->kategori_prestasi ?? '-' }}</strong>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <i class="fa fa-envelope text-primary fs-3 me-2"></i>
                                    <p class="text-muted mb-1">Email </p>
                                    <strong class="text-dark">{{ $pendaftars->siswa->email_siswa }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="p-3 bg-white">
                        <h5 class="text-primary mb-3"> <strong>Data Orang Tua</strong></h5>
                        <div class="card">
                            <div class="row p-3">
                                <div class="col-md-4 mb-3 border-bottom">
                                    <i class="fa fa-user text-primary fs-5 mr-3"></i>
                                    <p class="text-muted mb-1">Nama Ayah</p>
                                    <strong class="text-dark">{{ $pendaftars->siswa->orangTua->nama_ayah }}</strong>
                                </div>
                                <div class="col-md-4 mb-3 border-bottom">
                                    <i class="fa fa-user text-primary fs-3 me-2"></i>
                                    <p class="text-muted mb-1">Nama Ibu</p>
                                    <strong class="text-dark">{{ $pendaftars->siswa->orangTua->nama_ibu }}</strong>
                                </div>
                                <div class="col-md-4 mb-3 border-bottom">
                                    <i class="fa fa-home text-primary fs-3 me-2"></i>
                                    <p class="text-muted mb-1">Alamat</p>
                                    <strong class="text-dark">{{ $pendaftars->siswa->orangTua->alamat_ortu }}</strong>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <i class="fa fa-phone text-primary fs-3 me-2"></i>
                                    <p class="text-muted mb-1">No. Handphone</p>
                                    <strong class="text-dark">{{ $pendaftars->siswa->orangTua->no_hp_ortu }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="p-3 bg-white">
                        <h5 class="text-primary mb-3"><strong>Dokumen Siswa</strong> </h5>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-file-pdf fa-2x text-danger mr-3"></i>
                                <div>
                                    <div class="font-weight-bold">Ijazah</div>
                                    <small class="text-muted">PDF - 2 Mb</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                @if ($pendaftars->ijazah)
                                    <button type="button" class="btn btn-outline-primary btn-sm"
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
                                    <small class="text-muted">PDF - 2 Mb</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                @if ($pendaftars->kk)
                                    <button type="button" class="btn btn-outline-primary btn-sm"
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
                                    <small class="text-muted">PDF - 2 Mb</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                @if ($pendaftars->piagam)
                                    <button type="button" class="btn btn-outline-primary btn-sm"
                                        onclick="showPdfModal('{{ asset('storage/' . $pendaftars->piagam) }}'">
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
    </div>

    <div class="modal fade" id="pdfPreviewModal" tabindex="-1" aria-labelledby="pdfPreviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="" id="pdfPreviewModalLabel">Pratinjau Dokumen</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe id="pdfFrame" class="embed-responsive-item" frameborder="0"></iframe>
                    </div>
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
    </script>
@endpush
