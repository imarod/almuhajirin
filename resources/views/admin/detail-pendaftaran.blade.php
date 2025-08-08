@extends('layouts.adminlte-custom')


@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Pendaftaranbbb</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Detail Pendaftaran</li>
                    </ol>
                </div>

            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-end gap-2">
                    <a href="#" class="btn btn-success">
                        <i class="fas fa-edit"></i> Edit Data
                    </a>
                    <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">
                        <i class="fas fa-print"></i> Tolak
                    </button>
                    <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                        Terima
                    </button>
                </div>
                <div class="row g-3">
                    {{-- Kolom Kiri --}}
                    <div class="col-md-6">
                        <div class="p-4 bg-white">
                            <h5 class="text-primary mb-3"><strong>Data Calon Siswa</strong> </h5>
                            <div class="list-group-item d-flex justify-content-between align-items-center ">
                                <div class="d-flex align-items-center ">
                                    <i class="fa fa-user text-primary fs-3 mr-3"></i>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">Nama</p>
                                        <strong class="text-dark">{{ $pendaftars->siswa->nama }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center ">
                                <div class="d-flex align-items-center ">
                                    <i class="fa fa-id-card text-primary fs-3 mr-3"></i>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">NISN</p>
                                        <strong class="text-dark">{{ $pendaftars->siswa->nisn }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center ">
                                <div class="d-flex align-items-center ">
                                    <i class="fa fa-venus-mars text-primary fs-3 mr-3"></i>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">Jenis Kelamin</p>
                                        <strong class="text-dark">{{ $pendaftars->siswa->jenis_kelamin }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center ">
                                <div class="d-flex align-items-center ">
                                    <i class="fa fa-map-marker-alt text-primary fs-3 mr-3"></i>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">Tempat Lahir</p>
                                        <strong class="text-dark">{{ $pendaftars->siswa->tempat_lahir }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center ">
                                <div class="d-flex align-items-center ">
                                    <i class="fa fa-calendar-alt text-primary fs-3 mr-3"></i>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">Tanggal Lahir</p>
                                        <strong
                                            class="text-dark">{{ $pendaftars->siswa->tanggal_lahir->format('d-m-Y') }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center ">
                                <div class="d-flex align-items-center ">
                                    <i class="fa fa-calendar-alt text-primary fs-3 mr-3"></i>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">Kategori Prestasi</p>
                                        <strong class="text-dark">{{ $pendaftars->kategori_prestasi ?? '-' }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 bg-white">
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
                                            onclick="openViewer('{{ asset('storage/' . $pendaftars->ijazah) }}')">
                                            <i class="fas fa-eye"></i> Lihat
                                        </button>
                                    @else
                                        Tidak ada file
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
                                        <a href="{{ asset('storage/' . $pendaftars->kk) }}" target="_blank"
                                            class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    @else
                                        Tidak ada file
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
                                        <a href="{{ asset('storage/' . $pendaftars->piagam) }}" target="_blank"
                                            class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    @else
                                        Tidak ada file
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="col-md-6">
                        <div class=" p-4 bg-white">
                            <h5 class="text-primary mb-3"> <strong>Data Orang Tua</strong></h5>
                            <div class="list-group-item d-flex justify-content-between align-items-center ">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-user text-primary fs-5 mr-3"></i>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">Nama Ayah</p>
                                        <strong class="text-dark">{{ $pendaftars->siswa->orangTua->nama_ayah }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center ">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-user text-primary fs-5 mr-3"></i>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">Nama Ibu</p>
                                        <strong class="text-dark">{{ $pendaftars->siswa->orangTua->nama_ibu }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center ">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-home text-primary fs-5 mr-3"></i>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">Alamat</p>
                                        <strong class="text-dark">{{ $pendaftars->siswa->orangTua->alamat_ortu }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center ">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-phone text-primary fs-5 mr-3"></i>
                                    <div class="flex-grow-1">
                                        <p class="text-muted mb-1">No. Handphone</p>
                                        <strong class="text-dark">{{ $pendaftars->siswa->orangTua->no_hp_ortu }}</strong>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Overlay --}}
    <div id="docViewer" class="position-fixed top-0 start-0 w-100 h-100 bg-gray bg-opacity-10 d-none"
        style="z-index: 2000">
           <!-- Tombol close -->
    <button type="button" 
            class="btn btn-light rounded-circle position-absolute" 
            style="top: 20px; right: 20px; z-index: 100000; padding: 0.5rem 0.75rem; font-size: 1.5rem;" 
            onclick="closeViewer()">
        &times;
    </button>
        <div class="d-flex justify-content-center alihn-items-center h-100">
            <iframe id="docFrame" src="" class="bg-white rounded shadow"
                style="width: 80%; height:85%; border:none;" frameborder="0"></iframe>
        </div>
    </div>

    <script>
        function openViewer(url) {
            document.getElementById('docViewer').classList.remove('d-none')
            document.getElementById('docFrame').src = url
        }

        function closeViewer() {
            document.getElementById('docViewer').classList.add('d-none')
            document.getElementById('docFrame').src = ''
        }
    </script>
@stop
