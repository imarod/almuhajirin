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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-b5S5C6k6vj2u0gN4eQpE6uQ6Jt1hE1F5+4VpM5i0F5pM5i0F5pM5i0F5pM5i0F5pM5i0F5pM5i0F5pM5i0F5pM5i0F5p"
        crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgBfA4z7o3E6w/sE2pQ5d5fE5y3T4Wq6U6pA6lA3I3aF5pM5i0F5pM5i0F5pM5i0F5pM5i0F5p"
        crossorigin="anonymous"></script>
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form
            action="{{ isset($jadwal) ? route('admin.update-jadwal-ppdb', $jadwal->id) : route('admin.store-jadwal-ppdb') }}"
            method="POST">
            @csrf
            @if (isset($jadwal))
                @method('PUT')
            @endif
            <div class="card mb-4 border-left-primary shadow-sm" style="border-left: 4px solid #007bff !important;">
                <div class="card-body" style="background: linear-gradient(135deg, #e3f2fd 0%, #e8eaf6 100%);">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 mr-3">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px; background-color: rgba(0, 123, 255, 0.1) !important;">
                                <i class="fas fa-bell text-primary"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="font-weight-bold text-dark mb-1">Pendaftaran Tahun Ajaran 2024 Gelombang 1 Telah
                                Dibuka
                            </h5>
                            <p class="text-muted mb-0 small">Periode pendaftaran berlangsung hingga akhir bulan ini</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Tabs -->
            <div class="card ">
                <div class="card-header bg-white border-bottom">
                @section('content')
                    <div class="container-fluid">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form
                            action="{{ isset($jadwal) ? route('admin.update-jadwal-ppdb', $jadwal->id) : route('admin.store-jadwal-ppdb') }}"
                            method="POST">
                            @csrf
                            @if (isset($jadwal))
                                @method('PUT')
                            @endif
                            <div class="card mb-4 border-left-primary shadow-sm"
                                style="border-left: 4px solid #007bff !important;">
                                <div class="card-body"
                                    style="background: linear-gradient(135deg, #e3f2fd 0%, #e8eaf6 100%);">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 mr-3">
                                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px; background-color: rgba(0, 123, 255, 0.1) !important;">
                                                <i class="fas fa-bell text-primary"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="font-weight-bold text-dark mb-1">Pendaftaran Tahun Ajaran 2024
                                                Gelombang 1 Telah
                                                Dibuka
                                            </h5>
                                            <p class="text-muted mb-0 small">Periode pendaftaran berlangsung hingga akhir
                                                bulan ini</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Main Content Tabs -->
                            <div class="card ">
                                <div class="card-header bg-white border-bottom">
                                    <ul class="nav nav-tabs card-header-tabs" id="ppdbTabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link {{ !isset($jadwal) ? 'active' : '' }} d-flex align-items-center"
                                                id="settings-tab" data-toggle="tab" href="#settings" role="tab">
                                                <i class="fas fa-cog mr-2"></i>
                                                Pengaturan PPDB
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link d-flex align-items-center" id="history-tab" data-toggle="tab"
                                                href="#history" role="tab">
                                                <i class="fas fa-history mr-2"></i>
                                                Riwayat PPDB
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <div class="tab-content" id="ppdbTabsContent">
                                        <div class="tab-pane fade {{ !isset($jadwal) ? 'show active' : '' }}" id="settings"
                                            role="tabpanel">
                                            <div class="mb-4">
                                                <p class="text-dark">Atur parameter pendaftaran siswa baru untuk tahun
                                                    ajaran yang akan
                                                    datang
                                                </p>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-3 mb-4">
                                                    <label for="tahun-awal"
                                                        class="form-label font-weight-medium text-dark">Tahun
                                                        awal</label>
                                                    <input type="number" class="form-control" id="tahun-awal"
                                                        name="tahun_awal" min="2000" max="2100"
                                                        value="{{ old('tahun_awal', isset($jadwal) ? explode('/', $jadwal->thn_ajaran)[0] : '') }}">
                                                    @error('tahun_awal')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3 mb-4">
                                                    <label for="tahun-akhir"
                                                        class="form-label font-weight-medium text-dark">Tahun
                                                        Akhir</label>
                                                    <input type="number" class="form-control" id="tahun-akhir"
                                                        name="tahun_akhir" min="2000" max="2100"
                                                        value="{{ old('tahun_akhir', isset($jadwal) ? explode('/', $jadwal->thn_ajaran)[1] : '') }}">
                                                    @error('tahun_akhir')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 mb-4">
                                                    <label for="tgl_mulai"
                                                        class="form-label font-weight-medium text-dark">Tanggal
                                                        Mulai</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light border-right-0">
                                                                <i class="fas fa-calendar text-muted"></i>
                                                            </span>
                                                        </div>
                                                        <input type="date" class="form-control border-left-0"
                                                            id="tgl_mulai" name="tgl_mulai"
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
                                                    <select class="form-control" id="gelombang_pendaftaran"
                                                        name="gelombang_pendaftaran">
                                                        <option value="">Pilih gelombang</option>
                                                        @php
                                                            $selectedGelombang = old(
                                                                'gelombang_pendaftaran',
                                                                $jadwal->gelombang_pendaftaran ?? '',
                                                            );
                                                        @endphp
                                                        <option
                                                            value="1"{{ $selectedGelombang == 1 ? 'selected' : '' }}>
                                                            Gelombang 1</option>
                                                        <option
                                                            value="2"{{ $selectedGelombang == 2 ? 'selected' : '' }}>
                                                            Gelombang 2</option>
                                                        <option
                                                            value="3"{{ $selectedGelombang == 3 ? 'selected' : '' }}>
                                                            Gelombang 3</option>
                                                    </select>
                                                    @error('gelombang_pendaftaran')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 mb-4">
                                                    <label for="tgl_berakhir"
                                                        class="form-label font-weight-medium text-dark">Tanggal
                                                        Berakhir</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light border-right-0">
                                                                <i class="fas fa-calendar text-muted"></i>
                                                            </span>
                                                        </div>
                                                        <input type="date" class="form-control border-left-0"
                                                            id="tgl_berakhir" name="tgl_berakhir"
                                                            value="{{ old('tgl_berakhir', isset($jadwal) ? $jadwal->tgl_berakhir->format('Y-m-d') : '') }}">
                                                    </div>
                                                    @error('tgl_berakhir')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 mb-4">
                                                    <label for="kuota"
                                                        class="form-label font-weight-medium text-dark">Kuota
                                                        Pendaftaran</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light border-right-0">
                                                                <i class="fas fa-users text-muted"></i>
                                                            </span>
                                                        </div>
                                                        <input type="number" class="form-control border-left-0"
                                                            id="kuota" name="kuota" placeholder="Masukkan kuota"
                                                            value="{{ old('kuota', $jadwal->kuota ?? '') }}">
                                                    </div>
                                                    @error('kuota')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 mb-4">
                                                    <label for="tgl_pengumuman"
                                                        class="form-label font-weight-medium text-dark">Tanggal
                                                        Pengumuman</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light border-right-0">
                                                                <i class="fas fa-clock text-muted"></i>
                                                            </span>
                                                        </div>
                                                        <input type="date" name="tgl_pengumuman"
                                                            class="form-control border-left-0" id="tgl_pengumuman"
                                                            value="{{ old('tgl_pengumuman', isset($jadwal) ? $jadwal->tgl_pengumuman->format('Y-m-d') : '') }}">
                                                    </div>
                                                    @error('tgl_pengumuman')
                                                        <div class="text-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="border-top pt-4 mt-4">
                                                <div class="d-flex flex-column flex-sm-row gap-2">
                                                    <button type="submit" class="btn btn-primary px-4 mr-2 mb-2 mb-sm-0">
                                                        @if (isset($jadwal))
                                                            perbarui Jadwal
                                                        @else
                                                            Simpan Jadwal
                                                        @endif

                                                        Simpan
                                                    </button>
                                                    <button type="button" class="btn btn-danger px-4">
                                                        Batal
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- History Tab -->
                                        <div class="tab-pane fade" id="history" role="tabpanel">

                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead class="table-secondary">
                                                        <tr>
                                                            <th scope="col" class="px-2 py-3 text-dark fw-semibold  ">
                                                                No.</th>
                                                            <th scope="col" class="px-2 py-3 text-dark fw-semibold  ">
                                                                Tahun Ajaran</th>
                                                            <th scope="col" class="px-2 py-3 text-dark fw-semibold  ">
                                                                Gelombang</th>
                                                            <th scope="col" class="px-2 py-3 text-dark fw-semibold  ">
                                                                Kuota
                                                            </th>
                                                            <th scope="col" class="px-2 py-3 text-dark fw-semibold  ">
                                                                Tanggal Mulai
                                                            </th>
                                                            <th scope="col" class="px-2 py-3 text-dark fw-semibold  ">
                                                                Tanggal Berakhir
                                                            </th>
                                                            <th scope="col" class="px-2 py-3 text-dark fw-semibold  ">
                                                                Tanggal
                                                                Pengumuman
                                                            </th>
                                                            <th scope="col" class="px-2 py-3 text-dark fw-semibold  ">
                                                                Status</th>
                                                            <th scope="col"
                                                                class="px-2 py-3 text-dark fw-semibold text-center ">Aksi
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($jadwals as $jadwal)
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
                                                                    {{-- Menampilkan badge status berdasarkan logika di model --}}
                                                                    <span
                                                                        class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-medium">
                                                                        {{ $jadwal->status }}
                                                                    </span> 
                                                                </td>
                                                                <td class="px-2 py-2 text-center">
                                                                    {{-- Tombol Edit --}}
                                                                    <a href="{{ route('admin.edit-jadwal-ppdb', $jadwal->id) }}"
                                                                        class="btn btn-success btn-sm me-3"
                                                                        title="Edit">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                    {{-- Tombol Hapus --}}
                                                                    <button type="button" class="btn btn-danger btn-sm"
                                                                        title="Hapus" data-toggle="modal"
                                                                        data-target="#deleteConfirmationModal"
                                                                        data-id="{{ $jadwal->id }}">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr class="border-bottom">
                                                                <td colspan="9" class="text-center py-5">
                                                                    <i class="fas fa-history fa-3x text-muted mb-3"
                                                                        style="opacity: 0.3;"></i>
                                                                    <h5 class="text-muted">Belum ada riwayat jadwal
                                                                        pendaftaran PPDB</h5>
                                                                    <p class="text-muted small">Data akan muncul setelah
                                                                        Anda menyimpan
                                                                        konfigurasi</p>
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @stop
            </div>

            <div class="card-body">
                <div class="tab-content" id="ppdbTabsContent">
                    <div class="tab-pane fade {{ !isset($jadwal) ? 'show active' : '' }}" id="settings"
                        role="tabpanel">
                        <div class="mb-4">
                            <p class="text-dark">Atur parameter pendaftaran siswa baru untuk tahun ajaran yang akan
                                datang
                            </p>
                        </div>


                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <label for="tahun-awal" class="form-label font-weight-medium text-dark">Tahun
                                    awal</label>
                                <input type="number" class="form-control" id="tahun-awal" name="tahun_awal"
                                    min="2000" max="2100"
                                    value="{{ old('tahun_awal', isset($jadwal) ? explode('/', $jadwal->thn_ajaran)[0] : '') }}">
                                @error('tahun_awal')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-4">
                                <label for="tahun-akhir" class="form-label font-weight-medium text-dark">Tahun
                                    Akhir</label>
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
                                    class="form-label font-weight-medium text-dark">Gelombang Pendaftaran</label>
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
                                    <option value="3"{{ $selectedGelombang == 3 ? 'selected' : '' }}>
                                        Gelombang 3</option>
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
                        <div class="border-top pt-4 mt-4">
                            <div class="d-flex flex-column flex-sm-row gap-2">
                                <button type="submit" class="btn btn-primary px-4 mr-2 mb-2 mb-sm-0">
                                    @if (isset($jadwal))
                                        perbarui Jadwal
                                    @else
                                        Simpan Jadwal
                                    @endif

                                    Simpan
                                </button>
                                <button type="button" class="btn btn-danger px-4">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- History Tab -->
                    <div class="tab-pane fade" id="history" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-secondary">
                                    <tr>
                                        <th scope="col" class="px-2 py-3 text-dark fw-semibold  ">No.</th>
                                        <th scope="col" class="px-2 py-3 text-dark fw-semibold  ">Tahun Ajaran</th>
                                        <th scope="col" class="px-2 py-3 text-dark fw-semibold  ">Gelombang</th>
                                        <th scope="col" class="px-2 py-3 text-dark fw-semibold  ">Kuota
                                        </th>
                                        <th scope="col" class="px-2 py-3 text-dark fw-semibold  ">Tanggal Mulai
                                        </th>
                                        <th scope="col" class="px-2 py-3 text-dark fw-semibold  ">Tanggal Berakhir
                                        </th>
                                        <th scope="col" class="px-2 py-3 text-dark fw-semibold  ">Tanggal
                                            Pengumuman
                                        </th>
                                        <th scope="col" class="px-2 py-3 text-dark fw-semibold  ">Status</th>
                                        <th scope="col" class="px-2 py-3 text-dark fw-semibold text-center ">Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jadwals as $jadwal)
                                        <tr class="border-bottom">
                                            <td class="px-2 py-2 text-muted">{{ $loop->iteration }}.</td>
                                            <td class="px-2 py-2 fw-medium">{{ $jadwal->thn_ajaran }}</td>
                                            <td class="px-2 py-2">{{ $jadwal->gelombang_pendaftaran }}</td>
                                            <td class="px-2 py-2 fw-semibold">{{ $jadwal->kuota }}</td>
                                            <td class="px-2 py-2 text-muted">{{ $jadwal->tgl_mulai->format('d-m-Y') }}
                                            </td>
                                            <td class="px-2 py-2 text-muted">
                                                {{ $jadwal->tgl_berakhir->format('d-m-Y') }}</td>
                                            <td class="px-2 py-2 text-muted">
                                                {{ $jadwal->tgl_pengumuman->format('d-m-Y') }}</td>
                                            <td class="px-2 py-2">
                                                {{-- Menampilkan badge status berdasarkan logika di model --}}
                                                <span
                                                    class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-medium">
                                                    {{ $jadwal->status }}
                                                </span>
                                            </td>
                                            <td class="px-2 py-2 text-center">
                                                {{-- Tombol Edit --}}
                                                <a href="{{ route('admin.edit-jadwal-ppdb', $jadwal->id) }}"
                                                    class="btn btn-success btn-sm me-3" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                {{-- Tombol Hapus --}}
                                                {{-- <button type="button" class="btn btn-danger btn-sm" title="Hapus"
                                                    data-toggle="modal" data-target="#deleteConfirmationModal"
                                                    data-id="{{ $jadwal->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button> --}}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="border-bottom">
                                            <td colspan="9" class="text-center py-5">
                                                <i class="fas fa-history fa-3x text-muted mb-3"
                                                    style="opacity: 0.3;"></i>
                                                <h5 class="text-muted">Belum ada riwayat jadwal pendaftaran PPDB</h5>
                                                <p class="text-muted small">Data akan muncul setelah Anda menyimpan
                                                    konfigurasi</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@stop

<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Konfirmasi Hapus</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Apakah Anda yakin ingin menghapus jadwal ini? Tindakan ini tidak dapat dibatalkan.
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
</div>
</div>

@section('css')
<style>
    .border-left-primary {
        border-left: 4px solid #007bff !important;
    }

    .nav-tabs .nav-link {
        border: none;
        color: #6c757d;
        font-weight: 500;
    }

    .nav-tabs .nav-link.active {
        background-color: transparent;
        border-bottom: 2px solid #007bff;
        color: #007bff;
        font-weight: 600;
    }

    .input-group-text {
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }



    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const isEditing = {{ isset($jadwal) ? 'true' : 'false' }}

        if (isEditing) {

            document.getElementById('settings-tab').classList.add('active');
            document.getElementById('settings').classList.add('show', 'active');

            document.getElementById('history-tab').classList.remove('active');
            document.getElementById('history').classList.remove('show', 'active');
        }

        $('#deleteConfirmationModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var jadwalId = button.data('id');
            var form = $(this).find('#deleteForm');

            var actionUrl = '{{ route('admin.destroy-jadwal-ppdb', ':id') }}';
            actionUrl = actionUrl.replace(':id', jadwalId);

            form.attr('action', actionUrl);
        });
    })
</script>
@endsection
