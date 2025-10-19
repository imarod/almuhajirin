{{-- resources/views/siswa/daftar-formulir.blade.php --}}

@extends('layouts.adminlte-custom')

@section('content_header')
    <div class="container-fluid justify-content-between align-items-center">
        <div class="d-flex">
            <div>
                <h1 class="h3 mb-0 font-weight-bold text-dark">Cetak Formulir Pendaftaran</h1>
            </div>
        </div>
    </div>
@stop

@section('content')
    <style>
        /* body{
                 font-family: 'DejaVu Sans', Arial, sans-serif !important;
            } */
    </style>
    <div class="container-fluid">
        <div class="row">
            @forelse ($daftarPendaftaran as $pendaftaran)
                <div class="col-md-12 mb-4">
                    <div class="card h-100 ">
                        {{-- Header dan Tombol Download --}}
                        <div class="card-header d-flex justify-content-end align-items-center">
                            <a href="{{ route('cetak.formulir', $pendaftaran->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-download"></i> Download
                            </a>
                        </div>

                        <div class="p-3">
                            <div class="header text-center mb-3">
                                <div>
                                    <h5 class="font-weight-bold mb-0">MAS Al Muhajirin Tugumulyo</h5>
                                    <p class="mb-0 text-muted" style="font-size: 0.8rem;">Jalan Raya Candi Lontar No. 10,
                                        Surabaya</p>
                                    <p class="mb-0 text-muted" style="font-size: 0.8rem;">Telepon: (031) 1234567 | Email:
                                        info@sman10.sch.id</p>
                                </div>
                            </div>
                        </div>
                        {{-- Pratinjau Formulir --}}
                        <div class="card-body">
                            {{-- Header Formulir --}}
                            <div class="d-flex justify-content-center mb-3">
                                <div>
                                    <h4 class="font-weight-bold mb-0">FORMULIR BUKTI PENDAFTARAN SISWA BARU</h4>
                                </div>
                            </div>

                            {{-- Section: Informasi Pribadi --}}
                            <h5 class="font-weight-bold text-primary mb-3">I. BIODATA CALON MAHASISWA</h5>
                            <div class="row">
                                <div class="col-4">
                                    <p class="font-weight-bold mb-2">Nama Lengkap</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">
                                        {{ $pendaftaran->siswa->nama }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="font-weight-bold mb-2">NISN</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">
                                        {{ $pendaftaran->siswa->nisn }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="font-weight-bold mb-2">Jenis Kelamin</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">
                                        {{ $pendaftaran->siswa->jenis_kelamin }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="font-weight-bold mb-2">Tempat, Tanggal Lahir</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">
                                        {{ $pendaftaran->siswa->tempat_lahir }},
                                        {{ \Carbon\Carbon::parse($pendaftaran->siswa->tanggal_lahir)->format('d F Y') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="font-weight-bold mb-2">Alamat Siswa</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">
                                        {{ $pendaftaran->siswa->alamat_siswa }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="font-weight-bold mb-2">Nomor WhatsApp Siswa</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">
                                        {{ $pendaftaran->siswa->no_hp_siswa }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="font-weight-bold mb-2">Email Siswa</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">
                                        {{ $pendaftaran->siswa->email_siswa }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="font-weight-bold mb-2">Jurusan</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">
                                        {{ $pendaftaran->jurusan->nama_jurusan ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="font-weight-bold mb-2">Kategori Prestasi</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">
                                        {{ $pendaftaran->kategoriPrestasi->nama_prestasi ?? '-' }}</p>
                                </div>
                            </div>

                            {{-- Section: Informasi Orang Tua --}}
                            <h5 class="font-weight-bold text-primary mt-4 mb-3">II. DATA ORANG TUA/WALI</h5>
                            <div class="row">
                                <div class="col-4">
                                    <p class="font-weight-bold mb-2">Nama Ayah/Wali</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">
                                        {{ $pendaftaran->siswa->orangTua->nama_ayah }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="font-weight-bold mb-2">Nama Ibu</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">
                                        {{ $pendaftaran->siswa->orangTua->nama_ibu }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="font-weight-bold mb-2">Alamat Orang Tua/Wali</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">
                                        {{ $pendaftaran->siswa->orangTua->alamat_ortu }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="font-weight-bold mb-2">Nomor WhatsApp Orang Tua/Wali</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">
                                        {{ $pendaftaran->siswa->orangTua->no_hp_ortu }}</p>
                                </div>
                            </div>

                            {{-- Section: Informasi Tambahan --}}
                            <h5 class="font-weight-bold text-primary mt-4 mb-3">III. INFORMASI PENDAFTARAN</h5>

                            @php
                                $status = $pendaftaran->showStatusPendaftar();
                            @endphp
                            <div class="row">
                                <div class="col-4">
                                    <p class="font-weight-bold mb-2">Status Verifikasi</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">
                                        {{ $status }}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="font-weight-bold mb-2">Tanggal Pendaftaran</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">
                                        {{ \Carbon\Carbon::parse($pendaftaran->created_at)->format('d F Y') }}</p>
                                </div>
                            </div>
                        </div>
                        {{-- Footer Formulir --}}
                        <div class="card-footer text-muted d-flex justify-content-between">
                            {{-- <span>Dokumen ID:
                                FP-{{ $pendaftaran->created_at->format('Y') }}-{{ str_pad($pendaftaran->id, 3, '0', STR_PAD_LEFT) }}</span> --}}
                            <span>Dicetak pada: {{ \Carbon\Carbon::now()->format('d F Y') }} pukul
                                {{ \Carbon\Carbon::now()->format('H.i') }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="container-fluid">
                    <div class="card mb-4 border-left-primary shadow-sm"
                        style="border-left: 4px solid #eda73d !important;">
                        <div class="card-body" style="background: #fff3cd;">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 mr-3">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px; background-color: rgb(255, 255, 255) !important;">
                                        <i class="fas fa-file-alt" style="color: #eda73d;"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="font-weight-bold text-dark mb-1">Tidak Ada Formulir Pendaftaran </h5>
                                    {{-- <p class="text-muted mb-0 small">
                       Silakan cek kembali jadwal pendaftaran.
                    </p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

@stop
