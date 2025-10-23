{{-- resources/views/siswa/daftar-formulir.blade.php --}}

@extends('layouts.adminlte-custom')

@section('content_header')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 font-weight-bold text-dark">Cetak Formulir Pendaftaran</h1>
            </div>
        </div>
    </div>
@stop

@section('content')
    <style>
        .kop-surat {
            width: 100%;
            max-height: 80px;
            object-fit: contain;
            display: block;
            margin: 0 auto 1rem;
        }

        .card {
            border-radius: 10px;
        }

        h4,
        h5 {
            font-size: 1.1rem;
        }

        p,
        .card-body p,
        .card-footer span {
            font-size: 0.95rem;
            line-height: 1.6;
        }

        @media (max-width: 992px) {

            h4,
            h5 {
                font-size: 1rem;
            }

            p {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 768px) {

            h4,
            h5 {
                font-size: 0.95rem;
                text-align: center;
            }

            .card-body .row {
                flex-direction: column;
            }

            .card-body .col-4,
            .card-body .col-8 {
                width: 100% !important;
            }

            .card-body .col-4 p {
                margin-bottom: 0.25rem;
            }

            p {
                font-size: 0.88rem;
            }
        }

        @media (max-width: 576px) {
            .card {
                padding: 1rem !important;
            }

            h4,
            h5 {
                font-size: 0.9rem;
            }

            p {
                font-size: 0.85rem;
            }
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            @forelse ($daftarPendaftaran as $pendaftaran)
                <div class="col-12 mb-4">
                    <div class="card shadow-sm p-3 p-md-4">
                        {{-- Header dan Tombol Download --}}
                        <div class="card-header bg-white border-0 d-flex justify-content-end align-items-center">
                            <a href="{{ route('cetak.formulir', $pendaftaran->id) }}"
                                class="btn btn-sm d-flex align-items-center" style="background-color: #31708F">
                                <i class="fas fa-download text-white" style="margin-right: 8px;"></i>
                                <span class="text-white">Download</span>
                            </a>
                        </div>
                        {{-- Pratinjau Formulir --}}
                        <div class="card-body">
                            {{-- Header Formulir --}}
                            <div class="text-center mb-3">
                                <h4 class="fw-bold font-weight-bold mb-0">FORMULIR BUKTI PENDAFTARAN SISWA BARU</h4>
                                <h4 class="fw-bold font-weight-bold mb-0">TAHUN AJARAN
                                    {{ $pendaftaran->jadwal->thn_ajaran }}</h4>
                            </div>

                            {{-- Section: Informasi Pribadi --}}
                            <h5 class="fw-bold font-weight-bold mb-3">I. BIODATA CALON MAHASISWA</h5>
                            @php
                                $biodata = [
                                    'Nama Lengkap' => $pendaftaran->siswa->nama,
                                    'NISN' => $pendaftaran->siswa->nisn,
                                    'Jenis Kelamin' => $pendaftaran->siswa->jenis_kelamin,
                                    'Tempat, Tanggal Lahir' =>
                                        $pendaftaran->siswa->tempat_lahir .
                                        ', ' .
                                        \Carbon\Carbon::parse($pendaftaran->siswa->tanggal_lahir)->format('d F Y'),
                                    'Alamat Siswa' => $pendaftaran->siswa->alamat_siswa,
                                    'Nomor WhatsApp Siswa' => $pendaftaran->siswa->no_hp_siswa,
                                    'Email Siswa' => $pendaftaran->siswa->email_siswa,
                                    'Jurusan' => $pendaftaran->jurusan->nama_jurusan ?? '-',
                                    'Kategori Prestasi' => $pendaftaran->kategoriPrestasi->nama_prestasi ?? '-',
                                ];
                            @endphp

                            @foreach ($biodata as $label => $value)
                                <div class="row mb-2">
                                    <div class="col-12 col-md-4">
                                        <p class="fw-semibold mb-1">{{ $label }}</p>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <p class="mb-1 border-bottom border-secondary border-dotted">{{ $value }}</p>
                                    </div>
                                </div>
                            @endforeach

                            {{-- Section: Informasi Orang Tua --}}
                            <h5 class="fw-bold font-weight-bold mt-4 mb-3">II. DATA ORANG TUA/WALI</h5>
                            @php
                                $ortu = [
                                    'Nama Ayah/Wali' => $pendaftaran->siswa->orangTua->nama_ayah,
                                    'Nama Ibu' => $pendaftaran->siswa->orangTua->nama_ibu,
                                    'Alamat Orang Tua/Wali' => $pendaftaran->siswa->orangTua->alamat_ortu,
                                    'Nomor WhatsApp Orang Tua/Wali' => $pendaftaran->siswa->orangTua->no_hp_ortu,
                                ];
                            @endphp

                            @foreach ($ortu as $label => $value)
                                <div class="row mb-2">
                                    <div class="col-12 col-md-4">
                                        <p class="fw-semibold mb-1">{{ $label }}</p>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <p class="mb-1 border-bottom border-secondary border-dotted">{{ $value }}</p>
                                    </div>
                                </div>
                            @endforeach

                            {{-- Section: Informasi Pendaftaran --}}
                            <h5 class="fw-bold font-weight-bold mt-4 mb-3">III. INFORMASI PENDAFTARAN</h5>
                            @php $status = $pendaftaran->showStatusPendaftar(); @endphp

                            <div class="row mb-2">
                                <div class="col-12 col-md-4">
                                    <p class="fw-semibold mb-1">Status Verifikasi</p>
                                </div>
                                <div class="col-12 col-md-8">
                                    <p class="mb-1 border-bottom border-secondary border-dotted">{{ $status }}</p>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12 col-md-4">
                                    <p class="fw-semibold mb-1">Tanggal Pendaftaran</p>
                                </div>
                                <div class="col-12 col-md-8">
                                    <p class="mb-1 border-bottom border-secondary border-dotted">
                                        {{ \Carbon\Carbon::parse($pendaftaran->created_at)->format('d F Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Footer Formulir --}}
                        {{-- <div class="card-footer text-muted d-flex justify-content-between flex-wrap small">
                            <span>Dicetak pada: {{ \Carbon\Carbon::now()->format('d F Y') }} pukul
                                {{ \Carbon\Carbon::now()->format('H.i') }}</span>
                        </div> --}}
                    </div>
                </div>
            @empty
                <div class="container-fluid">
                    <div class="card mb-4 border-left-primary shadow-sm" style="border-left: 4px solid #eda73d !important;">
                        <div class="card-body bg-warning-subtle text-center py-4">
                            <i class="fas fa-file-alt fa-2x mb-2" style="color: #eda73d;"></i>
                            <h5 class="fw-bold text-dark mb-1">Tidak Ada Formulir Pendaftaran</h5>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@stop
