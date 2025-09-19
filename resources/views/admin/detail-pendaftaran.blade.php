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

            <a href="{{ route('admin.pendaftar') }}?thn_ajaran={{ $lastFilters['thn_ajaran'] ?? '' }}&gelombang={{ $lastFilters['gelombang_pendaftaran'] ?? '' }}&status={{ $lastFilters['status_aktual'] ?? '' }}&page={{ $lastFilters['page'] ?? '' }}&per_page={{ $lastFilters['per_page'] ?? '' }}&search={{ $lastFilters['search'] ?? '' }}"
                class="btn rounded-circle mb-4 border">
                <i class="fas fa-arrow-left text-black"></i>
            </a>
            <div class="card">
                <div class="card-header d-flex justify-content-end gap-2">
                    <a href="#" class="btn btn-success">
                        <i class="fas fa-edit"></i> Edit Data
                    </a>
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
                                        onclick="openDocumentViewer('{{ asset('storage/' . $pendaftars->ijazah) }}', 'Ijazah - {{ $pendaftars->siswa->nama }}')">
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
                                        onclick="openDocumentViewer('{{ asset('storage/' . $pendaftars->kk) }}', 'Kartu Keluarga - {{ $pendaftars->siswa->nama }}')">
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
                                        onclick="openDocumentViewer('{{ asset('storage/' . $pendaftars->piagam) }}', 'Piagam Penghargaan - {{ $pendaftars->siswa->nama }}')">
                                        <i class="fas fa-eye"></i> Lihat
                                    </button>
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

    <div id="documentOverlay" class="document-overlay">
        <div class="document-toolbar">
            <h1 id="documentTitle" class="document-title"></h1>
            <div class="document-actions">
                <button onclick="downloadDocument()" title="Download" class="document-btn">
                    <i class="fas fa-download"></i>
                    <span class="d-none d-md-inline">Download</span>
                </button>
                <button onclick="printDocument()" title="Print" class="document-btn">
                    <i class="fas fa-print"></i>
                    <span class="d-none d-md-inline">Print</span>
                </button>
                <button onclick="toggleFullScreen()" title="Fullscreen" class="document-btn">
                    <i id="fullscreenIcon" class="fas fa-expand"></i>
                </button>
                <button id="closeFullscreen" class="exit-fullscren-btn" onclick="toggleFullScreen()"
                    title="Exit Fullscreen" style="display: none;">
                    <i class="fas  fa-compress"></i>
                </button>
                <button onclick="closeDocumentViewer()" title="Close" class="document-btn close-btn">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="document-container">
            <div class="document-viewer">
                <div id="loadingSpinner" class="loading-spinner">
                    <div class="text-center">
                        <i class="fas fa-spinner fa-spin fa-2x mb-2"></i>
                        <p>Memuat Dokumen...</p>
                    </div>
                </div>
                <iframe id="documentFrame" class="document-frame" style="display: none;" frameborder="0"></iframe>
            </div>
        </div>
    </div>

    <style>
        .document-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: none;
            flex-direction: column;
            overflow: hidden;
        }

        .document-overlay.show {
            display: flex;
        }

        .document-toolbar {
            background-color: rgba(71, 71, 73);
            color: white;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 60px;
        }

        .document-title {
            font-size: 16px;
            font-weight: 500;
            margin: 0;
            flex: 1;
            margin-right: 20px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .document-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .document-btn {
            background: none;
            border: none;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
        }

        .document-btn:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .document-btn.close-btn {
            padding: 8px;
            border-radius: 50%;
        }

        .document-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }

        .document-viewer {
            width: 100%;
            max-width: 900px;
            height: calc(100vh - 100px);
            background: white;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            position: relative;
        }

        .document-frame {
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 8px;
        }

        .loading-spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #666;
            font-size: 16px;
        }

        .document-overlay.fullscreen-mode .document-toolbar {
            display: none;
        }

        .document-overlay.fullscreen-mode .document-viewer {
            width: 100vw;
            height: 100vh;
            border-radius: 0;
        }

        @media (max-width: 768px) {
            .document-toolbar {
                padding: 10px 15px;
            }

            .document-title {
                font-size: 14px;
            }

            .document-btn {
                padding: 6px 8px;
                font-size: 12px;
            }

            .document-viewer {
                margin: 10px;
                height: calc(100vh - 100px);
            }
        }
    </style>

    <script>
        let currentDocumentUrl = '';
        let currentDocumentTitle = '';
        let isFullscreen = 'false';

        function openDocumentViewer(url, title = 'Document') {
            currentDocumentUrl = url;
            currentDocumentTitle = title;

            const overlay = document.getElementById('documentOverlay');
            const frame = document.getElementById('documentFrame');
            const titleElement = document.getElementById('documentTitle');
            const spinner = document.getElementById('loadingSpinner');

            titleElement.textContent = title;

            // Show overlay
            overlay.classList.add('show');
            document.body.style.overflow = 'hidden';

            // Show loading spinner
            spinner.style.display = 'block';
            frame.style.display = 'none';

            // Load document
            frame.onload = function() {
                spinner.style.display = 'none';
                frame.style.display = 'block';
            };

            frame.onerror = function() {
                spinner.innerHTML = `
                    <div class="text-center text-danger">
                        <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                        <p>Failed to load document</p>
                        <button onclick="closeDocumentViewer()" class="btn btn-danger btn-sm mt-2">
                            Close
                        </button>
                    </div>
                `;
            };

            frame.src = url;
        }

        function closeDocumentViewer() {
            const overlay = document.getElementById('documentOverlay');
            const frame = document.getElementById('documentFrame');
            const spinner = document.getElementById('loadingSpinner');

            overlay.classList.remove('show');
            document.body.style.overflow = '';

            spinner.innerHTML = `
                <div class="text-center">
                    <i class="fas fa-spinner fa-spin fa-2x mb-2"></i>
                    <p>Loading document...</p>
                </div>
            `;

            // Clear the frame source to stop loading
            frame.src = '';
            currentDocumentUrl = '';
            currentDocumentTitle = '';
        }

        function downloadDocument() {
            if (currentDocumentUrl) {
                const link = document.createElement('a');
                link.href = currentDocumentUrl;
                link.download = currentDocumentTitle;
                link.target = '_blank';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }

        function printDocument() {
            const frame = document.getElementById('documentFrame');
            if (frame.contentWindow) {
                try {
                    frame.contentWindow.print();
                } catch (e) {
                    // If printing from iframe fails, open in new window
                    window.open(currentDocumentUrl, '_blank');
                }
            } else {
                window.open(currentDocumentUrl, '_blank');
            }
        }

        // Close viewer when clicking outside the document
        document.getElementById('documentOverlay').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDocumentViewer();
            }
        });

        // Close viewer with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const overlay = document.getElementById('documentOverlay');
                if (overlay.classList.contains('show')) {
                    closeDocumentViewer();
                }
            }
        });

        // Prevent scrolling when overlay is open
        document.addEventListener('keydown', function(e) {
            const overlay = document.getElementById('documentOverlay');
            if (overlay.classList.contains('show') && (e.key === 'ArrowUp' || e.key === 'ArrowDown' || e.key ===
                    ' ')) {
                e.preventDefault();
            }
        });

        //KODE INI NANTI DIAKTIFKAN KALAU PERLU
        // function toggleFullScreen(){
        //     if(isFullscreen){

        //             overlay.classList.remove('fullscreen')
        //             if(document.exitFullscreen){
        //                 document.exitFullscreen()
        //             }

        //     }else{
        //         overlay.classList.add('fullscreen')
        //         if(overlay.requestFullscreen){
        //             overlay.requestFullscreen()
        //         }
        //     }
        // }
    </script>


@stop

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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
