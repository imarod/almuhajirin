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
                                    <h5 class="font-weight-bold mb-0">SMA Negeri 10 Surabaya</h5>
                                    <p class="mb-0 text-muted" style="font-size: 0.8rem;">Jalan Raya Candi Lontar No. 10, Surabaya</p>
                                    <p class="mb-0 text-muted" style="font-size: 0.8rem;">Telepon: (031) 1234567 | Email: info@sman10.sch.id</p>
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
                            <h5 class="font-weight-bold text-primary mb-3">Informasi Pribadi</h5>
                            <div class="row">
                                <div class="col-4">
                                    <p class="mb-2">NAMA LENGKAP</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">{{ $pendaftaran->siswa->nama }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="mb-2">NISN</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">{{ $pendaftaran->siswa->nisn }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="mb-2">JENIS KELAMIN</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">{{ $pendaftaran->siswa->jenis_kelamin }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="mb-2">TEMPAT, TANGGAL LAHIR</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">{{ $pendaftaran->siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftaran->siswa->tanggal_lahir)->format('d F Y') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="mb-2">ALAMAT SISWA</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">{{ $pendaftaran->siswa->alamat_siswa }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="mb-2">NOMOR HP SISWA</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">{{ $pendaftaran->siswa->no_hp_siswa }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="mb-2">KATEGORI PRESTASI</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">{{ $pendaftaran->siswa->kategori_prestasi ?? '-' }}</p>
                                </div>
                            </div>

                            {{-- Section: Informasi Orang Tua --}}
                            <h5 class="font-weight-bold text-primary mt-4 mb-3">Informasi Orang Tua</h5>
                            <div class="row">
                                <div class="col-4">
                                    <p class="mb-2">NAMA AYAH</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">{{ $pendaftaran->siswa->orangTua->nama_ayah }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="mb-2">NAMA IBU</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">{{ $pendaftaran->siswa->orangTua->nama_ibu }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="mb-2">ALAMAT ORANG TUA</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">{{ $pendaftaran->siswa->orangTua->alamat_ortu }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="mb-2">NOMOR HP ORANG TUA</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">{{ $pendaftaran->siswa->orangTua->no_hp_ortu }}</p>
                                </div>
                            </div>

                            {{-- Section: Informasi Tambahan --}}
                            <h5 class="font-weight-bold text-primary mt-4 mb-3">Informasi Tambahan</h5>
                            <div class="row">
                                <div class="col-4">
                                    <p class="mb-2">STATUS VERIFIKASI</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">{{ $pendaftaran->status_aktual ? 'Diproses' : $pendaftaran->status_verifikasi }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="mb-2">TANGGAL PENDAFTARAN</p>
                                </div>
                                <div class="col-8">
                                    <p class="mb-2 border-bottom border-secondary border-dotted">{{ \Carbon\Carbon::parse($pendaftaran->created_at)->format('d F Y') }}</p>
                                </div>
                            </div>
                        </div>
                        {{-- Footer Formulir --}}
                        <div class="card-footer text-muted d-flex justify-content-between">
                            <span>Dokumen ID: FP-{{ $pendaftaran->created_at->format('Y') }}-{{ str_pad($pendaftaran->id, 3, '0', STR_PAD_LEFT) }}</span>
                            <span>Dicetak pada: {{ \Carbon\Carbon::now()->format('d F Y') }} pukul {{ \Carbon\Carbon::now()->format('H.i') }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="container-fluid">
                    <p class="text-center">Tidak ada formulir pendaftaran yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>

@stop
