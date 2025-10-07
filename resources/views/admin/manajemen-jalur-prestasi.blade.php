@extends('layouts.adminlte-custom')
@section('content_header')
    <div class="container-fluid mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 font-weight-bold">Manajemen Jalur Prestasi</h1>
                <p>Kelola kategori prestasi untuk pendaftaran siswa baru.</p>
            </div>


        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{-- Notifikasi Error Validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Gagal menambahkan kategori. Silakan cek kembali input Anda.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <button class="btn btn-success mb-3" data-toggle="modal" data-target="#tambahKategoriModal">
                    Tambah Kategori
                </button>

                <table class="table table-hover table-bordered table-striped mb-0">
                    <thead>
                        <tr>
                            <th style="width: 20%;">Nama</th>
                            <th style="width: 45%;">Deskripsi</th>
                            <th style="width: 15%;">Status</th>
                            <th style="width: 20%;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div>
        </div>

    </div>

{{-- 
    <div class="modal fade" id="tambahKategoriModal" tabindex="-1" role="dialog"
        aria-labelledby="tambahKategoriModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahKategoriModalLabel">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-secondary">Isi detail kategori prestasi di bawah ini.</p>
                    <form id="formTambahKategori" action="{{ route('admin.kategori-prestasi.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_prestasi">Nama</label>
                            <input type="text" class="form-control @error('nama_prestasi') is-invalid @enderror"
                                id="nama_prestasi" name="nama_prestasi" placeholder="Contoh: Olimpiade Sains" required
                                value="{{ old('nama_prestasi') }}">
                            @error('nama_prestasi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi (opsional)</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                placeholder="Deskripsi singkat" value="{{ old('deskripsi') }}">
                        </div>
                        <div class="form-group form-check">
                            <input type="hidden" name="is_active" value="0">

                            <input type="checkbox" class="form-check-input" id="status_aktif" name="is_active"
                                value="1" checked>
                            <label class="form-check-label" for="status_aktif">Aktif</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-default mr-2" data-dismiss="modal">Batal</button>
                    {{-- Menggunakan type="submit" dan form="formTambahKategori" untuk tombol Simpan --}}
                    <button type="submit" form="formTambahKategori" class="btn btn-dark">Simpan</button>
                </div>
            </div>
        </div>
    </div> --}}
@stop
