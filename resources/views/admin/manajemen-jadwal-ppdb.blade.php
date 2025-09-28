@extends('layouts.adminlte-custom')

@section('content_header')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 font-weight-bold text-dark">Manajemen Jadwal PPDB</h1>
            </div>

        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">

        <x-jadwal-ppdb-aktif />
        <div class="btn-group dropright mb-3">
            <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="fas fa-print mr-1" title="Cetak"></i>
                Cetak
            </button>
            <div class="dropdown-menu">
                <button id="export-btn" class="dropdown-item btn-sm text-success">
                    <i class="fas fa-file-excel mr-1"></i>
                    CSV
                </button>

                <button id="export-pdf-btn" class="dropdown-item btn-sm text-danger">
                    <i class="fas fa-file-pdf mr-1"></i>
                    PDF
                </button>
            </div>
        </div>
        <div class="card ">


            <form
                action="{{ isset($jadwal) ? route('admin.update-jadwal-ppdb', $jadwal->id) : route('admin.store-jadwal-ppdb') }}"
                method="POST">
                @csrf
                @if (isset($jadwal))
                    @method('PUT')
                @endif


                <!-- Main Content Tabs -->

                <div class="card-header  p-0 pt-1">
                    <ul class="nav nav-tabs" id="ppdbTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center text-dark {{ !isset($jadwal) ? 'active' : '' }} "
                                id="settings-tab" data-toggle="tab" href="#settings" role="tab">
                                {{-- <i class="fas fa-cog mr-2"></i> --}}
                                Pengaturan PPDB
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center text-dark" id="history-tab" data-toggle="tab"
                                href="#history" role="tab">
                                {{-- <i class="fas fa-history mr-2"></i> --}}
                                Riwayat PPDB
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content" id="ppdbTabsContent">
                        {{-- tab setting jadwal --}}
                        <div class="tab-pane fade {{ !isset($jadwal) ? 'show active' : '' }}" id="settings"
                            role="tabpanel">
                            @if (isset($jadwal))
                                <div class="tab-pane fade show active" id="settings" role="tabpanel">
                                    <p class=" text-danger">Anda sedang berada di form edit
                                        jadwal.
                                        Untuk keluar dari mode edit klik tombol "Batal".
                                    </p>
                                </div>
                            @endif


                            <p class="font-weight-bold text-dark">Tahun Ajaran:
                            </p>

                            <div class="row" style="margin-top: -15px;">
                                <div class="col-md-3 mb-4">
                                    <label for="tahun-awal" class="form-label text-muted font-weight-normal ">Tahun
                                        Pertama</label>
                                    <input type="number" class="form-control" id="tahun-awal" name="tahun_awal"
                                        min="2000" max="2100"
                                        value="{{ old('tahun_awal', isset($jadwal) ? explode('/', $jadwal->thn_ajaran)[0] : '') }}">
                                    @error('tahun_awal')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-4">
                                    <label for="tahun-akhir" class="form-label text-muted font-weight-normal">Tahun
                                        Kedua</label>
                                    <input type="number" class="form-control" id="tahun-akhir" name="tahun_akhir"
                                        min="2000" max="2100"
                                        value="{{ old('tahun_akhir', isset($jadwal) ? explode('/', $jadwal->thn_ajaran)[1] : '') }}">
                                    @error('tahun_akhir')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="tgl_mulai" class="form-label font-weight-medium text-dark">Tanggal
                                        Mulai</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light border-right-0">
                                                <i class="fas fa-calendar text-muted"></i>
                                            </span>
                                        </div>
                                        <input type="date" class="form-control border-left-0" id="tgl_mulai"
                                            name="tgl_mulai"
                                            value="{{ old('tgl_mulai', isset($jadwal) ? $jadwal->tgl_mulai->format('Y-m-d') : '') }}">
                                    </div>
                                    @error('tgl_mulai')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="gelombang_pendaftaran"
                                        class="form-label font-weight-medium text-dark">Gelombang
                                        Pendaftaran</label>
                                    <select class="form-control" id="gelombang_pendaftaran" name="gelombang_pendaftaran">
                                        <option value="">Pilih gelombang</option>
                                        @php
                                            $selectedGelombang = old(
                                                'gelombang_pendaftaran',
                                                $jadwal->gelombang_pendaftaran ?? '',
                                            );
                                        @endphp
                                        <option value="1"{{ $selectedGelombang == 1 ? 'selected' : '' }}>
                                            Gelombang 1</option>
                                        <option value="2"{{ $selectedGelombang == 2 ? 'selected' : '' }}>
                                            Gelombang 2</option>
                                    </select>
                                    @error('gelombang_pendaftaran')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="tgl_berakhir" class="form-label font-weight-medium text-dark">Tanggal
                                        Berakhir</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light border-right-0">
                                                <i class="fas fa-calendar text-muted"></i>
                                            </span>
                                        </div>
                                        <input type="date" class="form-control border-left-0" id="tgl_berakhir"
                                            name="tgl_berakhir"
                                            value="{{ old('tgl_berakhir', isset($jadwal) ? $jadwal->tgl_berakhir->format('Y-m-d') : '') }}">
                                    </div>
                                    @error('tgl_berakhir')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="kuota" class="form-label font-weight-medium text-dark">Kuota
                                        Pendaftaran</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light border-right-0">
                                                <i class="fas fa-users text-muted"></i>
                                            </span>
                                        </div>
                                        <input type="number" class="form-control border-left-0" id="kuota"
                                            name="kuota" placeholder="Masukkan kuota"
                                            value="{{ old('kuota', $jadwal->kuota ?? '') }}">
                                    </div>
                                    @error('kuota')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="tgl_pengumuman" class="form-label font-weight-medium text-dark">Tanggal
                                        Pengumuman</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light border-right-0">
                                                <i class="fas fa-clock text-muted"></i>
                                            </span>
                                        </div>
                                        <input type="date" name="tgl_pengumuman" class="form-control border-left-0"
                                            id="tgl_pengumuman"
                                            value="{{ old('tgl_pengumuman', isset($jadwal) ? $jadwal->tgl_pengumuman->format('Y-m-d') : '') }}">
                                    </div>
                                    @error('tgl_pengumuman')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- button simpan/update --}}
                            <div class="border-top pt-4 mt-4">
                                <div class="d-flex flex-column flex-sm-row gap-2">
                                    <button type="submit" class="btn btn-primary px-4 mr-2 mb-2 mb-sm-0"
                                        href="{{ route('admin.manajemen-jadwal-ppdb') }}#settings">
                                        @if (isset($jadwal))
                                            Perbarui Jadwal
                                        @else
                                            Simpan Jadwal
                                        @endif
                                    </button>
                                    <a href="{{ route('admin.manajemen-jadwal-ppdb') }}#settings"
                                        class="btn btn-danger px-4">Batal</a>

                                </div>
                            </div>
                        </div>

                        <!-- History Tab -->
                        <div class="tab-pane fade" id="history" role="tabpanel">
                            <div class="card-header bg-white border-bottom">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="d-flex align-items-center flex-wrap">
                                            <div class="d-flex align-items-center mr-3">
                                                <span class="text-muted small">Show</span>
                                                <select id="show-entries" class="form-control form-control-sm mx-2"
                                                    style="width: auto;">
                                                    <option value="10">10 Baris</option>
                                                    <option value="25">25 Baris</option>
                                                    <option value="50">50 Baris</option>
                                                    <option value="100">100 Baris</option>
                                                    <option value="0">Semua Baris</option>
                                                </select>
                                                <span class="text-muted small">entries</span>
                                            </div>


                                        </div>
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Search..."
                                                style="padding-left: 2.5rem;">
                                            <i class="fas fa-search position-absolute text-muted"
                                                style="left: 0.75rem; top: 50%; transform: translateY(-50%);"></i>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th scope="col" class="px-2 py-3 text-whitefw-semibold  ">
                                                No.</th>
                                            <th scope="col" class="px-2 py-3 text-whitefw-semibold  ">
                                                Tahun Ajaran</th>
                                            <th scope="col" class="px-2 py-3 text-whitefw-semibold  ">
                                                Gelombang</th>
                                            <th scope="col" class="px-2 py-3 text-whitefw-semibold  ">
                                                Kuota
                                            </th>
                                            <th scope="col" class="px-2 py-3 text-whitefw-semibold  ">
                                                Tanggal Mulai
                                            </th>
                                            <th scope="col" class="px-2 py-3 text-whitefw-semibold  ">
                                                Tanggal Berakhir
                                            </th>
                                            <th scope="col" class="px-2 py-3 text-whitefw-semibold  ">
                                                Tanggal
                                                Pengumuman
                                            </th>
                                            <th scope="col" class="px-2 py-3 text-whitefw-semibold  ">
                                                Status</th>
                                            <th scope="col" class="px-2 py-3 text-whitefw-semibold">Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="jadwal-table-body">
                                        <tr colspan="9" class="text-center py-5 text-muted">

                                            {{-- @forelse ($jadwals as $jadwal)
                                            <tr class="border-bottom">
                                                <td class="px-2 py-2 text-muted">{{ $loop->iteration }}.
                                                </td>
                                                <td class="px-2 py-2 fw-medium">{{ $jadwal->thn_ajaran }}
                                                </td>
                                                <td class="px-2 py-2">{{ $jadwal->gelombang_pendaftaran }}
                                                </td>
                                                <td class="px-2 py-2 fw-semibold">{{ $jadwal->kuota }}
                                                </td>
                                                <td class="px-2 py-2 text-muted">
                                                    {{ $jadwal->tgl_mulai->format('d-m-Y') }}
                                                </td>
                                                <td class="px-2 py-2 text-muted">
                                                    {{ $jadwal->tgl_berakhir->format('d-m-Y') }}</td>
                                                <td class="px-2 py-2 text-muted">
                                                    {{ $jadwal->tgl_pengumuman->format('d-m-Y') }}</td>
                                                <td class="px-2 py-2">
                                                    <span
                                                        class="badge bg-success-subtle text-success py-2 rounded-pill fw-medium">
                                                        {{ $jadwal->status }}
                                                    </span>
                                                </td>
                                                <td class="px-2 py-2">
                                                    <a href="{{ route('admin.edit-jadwal-ppdb', $jadwal->id) }}"
                                                        class="btn btn-success btn-sm me-3" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm delete-btn"
                                                        title="Hapus" data-target="#deleteConfirmationModal"
                                                        data-id="{{ $jadwal->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="border-bottom">
                                                <td colspan="9" class="text-center py-5">
                                                    <i class="fas fa-history fa-3x text-muted mb-3"></i>
                                                    <h5 class="text-muted">Belum ada riwayat jadwal
                                                        PPDB</h5>
                                                    <button class="btn btn-primary text-white">
                                                        <a href="#">Buat
                                                            Jadwal</a>
                                                    </button>

                                                </td>
                                            </tr>
                                        @endforelse --}}
                                    </tbody>
                                </table>
                            </div>

                            <div class="row mt-3">
                                <div class="col-sm-12 col-md-5">
                                    <div id="jadwal-info" class="dataTables_info text-muted"></div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <nav aria-label="Page navigation" class="float-right">
                                        <ul class="pagination pagination-sm mb-0">
                                            {{-- Tautan paginasi akan dimuat di sini oleh JS --}}
                                        </ul>
                                    </nav>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

        </div>
    </div>


@stop
@section('css')
    <style>
        .nav-tabs .nav-link.active {
            font-weight: 700;
            box-shadow:
                inset 0 5px 6px -5px rgba(0, 0, 0, 0.5);
        }

        .nav-tabs .nav-link.active.text-dark {
            color: #5E7CE3 !important;
        }

        .nav-tabs .nav-link:hover {
            background-color: #efeff9;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }

        .form-control:focus {
            border-color: #c52424;
            box-shadow: 0 0 0 0.2rem rgba(255, 45, 4, 0.25);
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isEditing = {{ isset($jadwal) ? 'true' : 'false' }};

            if (isEditing) {
                document.getElementById('settings-tab').classList.add('active');
                document.getElementById('settings').classList.add('show', 'active');
                document.getElementById('history-tab').classList.remove('active');
                document.getElementById('history').classList.remove('show', 'active');
            }

            function activateTabHash() {
                const hash = window.location.hash;
                if (hash) {
                    document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
                    document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('show', 'active'));
                    const tabLink = document.querySelector(`a[href="${hash}"]`);
                    if (tabLink) {
                        const tabPane = document.querySelector(hash);
                        tabLink.classList.add('active');
                        tabPane.classList.add('show', 'active');
                    }
                }
            }

            activateTabHash();

            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    if (this.closest('.card-header')) {
                        const hash = this.getAttribute('href');
                        const currentUrl = window.location.href;
                        if (currentUrl.includes('/edit')) {
                            const cleanUrl = '{{ route('admin.manajemen-jadwal-ppdb') }}' + hash;
                            window.location.href = cleanUrl;
                            e.preventDefault();
                        } else {
                            window.history.pushState(null, '', hash);
                        }
                    }
                });
            });

            window.addEventListener('popstate', activateTabHash);

            // Fungsi baru untuk melakukan request AJAX dengan paginasi
            function fetchJadwalData(page = 1) {
                let perPage = $('#history').find('select#show-entries').val();
                const tableBody = $('#jadwal-table-body');
                const jadwalInfo = $('#jadwal-info');
                const pagination = $('#history').find('.pagination');

                $.ajax({
                    url: '{{ route('admin.manajemen-jadwal-ppdb.json') }}',
                    method: 'GET',
                    data: {
                        page: page,
                        per_page: perPage
                    },
                    success: function(response) {
                        let html = '';
                        if (response.data.length > 0) {
                            $.each(response.data, function(index, jadwal) {
                                let no = (response.current_page - 1) * response.per_page +
                                    index + 1;
                                let statusClass = '';
                                if (jadwal.status === 'Belum Dimulai') {
                                    statusClass = 'bg-secondary-subtle text-secondary';
                                } else if (jadwal.status === 'Aktif') {
                                    statusClass = 'bg-success-subtle text-success';
                                } else {
                                    statusClass = 'bg-danger-subtle text-danger';
                                }

                                html += `
                                <tr class="border-bottom">
                                    <td class="px-2 py-2 text-muted">${no}.</td>
                                    <td class="px-2 py-2 fw-medium">${jadwal.thn_ajaran}</td>
                                    <td class="px-2 py-2">${jadwal.gelombang_pendaftaran}</td>
                                    <td class="px-2 py-2 fw-semibold">${jadwal.kuota}</td>
                                    <td class="px-2 py-2 text-muted">${new Date(jadwal.tgl_mulai).toLocaleDateString('id-ID')}</td>
                                    <td class="px-2 py-2 text-muted">${new Date(jadwal.tgl_berakhir).toLocaleDateString('id-ID')}</td>
                                    <td class="px-2 py-2 text-muted">${new Date(jadwal.tgl_pengumuman).toLocaleDateString('id-ID')}</td>
                                    <td class="px-2 py-2">
                                        <span class="badge ${statusClass} py-2 rounded-pill fw-medium">${jadwal.status}</span>
                                    </td>
                                    <td class="px-2 py-2">
                                        <a href="/admin/manajemen-jadwal-ppdb/${jadwal.id}/edit" class="btn btn-success btn-sm me-3" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm delete-btn" title="Hapus" data-id="${jadwal.id}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            `;
                            });
                        } else {
                            html = `
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <i class="fas fa-history fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">Belum ada riwayat jadwal PPDB</h5>
                                    <a href="#settings" class="btn btn-primary text-white">Buat Jadwal</a>
                                </td>
                            </tr>
                        `;
                        }
                        tableBody.html(html);

                        let infoText =
                            `Menampilkan ${response.from ?? 0} hingga ${response.to ?? 0} dari ${response.total} data`;
                        jadwalInfo.text(infoText);

                        let paginationHtml = '';
                        if (response.last_page > 1) {
                            response.links.forEach(link => {
                                let disabledClass = link.url === null ? 'disabled' : '';
                                let activeClass = link.active ? 'active' : '';
                                let pageNumber;
                                let labelText = link.label;

                                if (link.label.includes('Previous')) {
                                    labelText = 'Sebelumnya';
                                    pageNumber = response.current_page - 1;
                                } else if (link.label.includes('Next')) {
                                    labelText = 'Selanjutnya';
                                    pageNumber = response.current_page + 1;
                                } else {
                                    pageNumber = link.label;
                                }

                                paginationHtml += `
                                <li class="page-item ${disabledClass} ${activeClass}">
                                    <a class="page-link" href="#" data-page="${pageNumber}" onclick="event.preventDefault(); fetchJadwalData(${pageNumber});">
                                        ${labelText}
                                    </a>
                                </li>
                            `;
                            });
                        }
                        pagination.html(paginationHtml);

                        $('.delete-btn').on('click', function(event) {
                            event.preventDefault();
                            var jadwalId = $(this).data('id');
                            var actionUrl = '{{ route('admin.destroy-jadwal-ppdb', ':id') }}';
                            actionUrl = actionUrl.replace(':id', jadwalId);
                            Swal.fire({
                                title: 'Apakah Anda yakin?',
                                text: "Penghapusan jadwal akan menghapus semua data pendaftaran siswa.\nJadwal yang dihapus tidak dapat dikembalikan!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#6c757d',
                                confirmButtonText: 'Ya, hapus!',
                                cancelButtonText: 'Batal'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    var form = document.createElement('form');
                                    form.setAttribute('method', 'POST');
                                    form.setAttribute('action', actionUrl);
                                    var csrfInput = document.createElement('input');
                                    csrfInput.setAttribute('type', 'hidden');
                                    csrfInput.setAttribute('name', '_token');
                                    csrfInput.setAttribute('value',
                                        '{{ csrf_token() }}');
                                    var methodInput = document.createElement('input');
                                    methodInput.setAttribute('type', 'hidden');
                                    methodInput.setAttribute('name', '_method');
                                    methodInput.setAttribute('value', 'DELETE');
                                    form.appendChild(csrfInput);
                                    form.appendChild(methodInput);
                                    document.body.appendChild(form);
                                    form.submit();
                                }
                            });
                        });
                    },
                    error: function(xhr, status, error) {
                        tableBody.html(
                            `<tr><td colspan="9" class="text-center py-5 text-danger">Gagal memuat data.</td></tr>`
                        );
                        console.error("Error fetching data:", error);
                    }
                });
            }

            $('#show-entries').on('change', function() {
                fetchJadwalData(1);
            });

            $(document).on('click', '.pagination .page-link', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                if (page) {
                    fetchJadwalData(page);
                }
            });

            $('#history-tab').on('click', function() {
                fetchJadwalData();
            });

            if (window.location.hash === '#history' && !isEditing) {
                fetchJadwalData();
            }

            $('#export-btn').on('click', function() {
                window.location.href = '{{ route('admin.cetak-jadwal.export-csv') }}';
            });

            $('#export-pdf-btn').on('click', function() {
                window.location.href = '{{ route('admin.cetak-jadwal.export-pdf') }}';
            });

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                });
            @endif
        });
    </script>
@endsection
