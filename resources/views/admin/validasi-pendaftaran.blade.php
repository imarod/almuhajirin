@extends('adminlte::page')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Calon Siswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Pendaftar</li>
                    </ol>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="#" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                @foreach (['Nama Calon Siswa', 'Tempat Lahir', 'Tanggal Lahir', 'Jenis Kelamin', 'NISN', 'Alamat', 'No. Hp', 'Kategori Prestasi'] as $label)
                                    <div class="form-group">
                                        <label>{{ $label }}</label>
                                        <input type="text" class="form-control" placeholder="{{ $label }}">
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-md-6">
                                @foreach (['Scan Kartu Keluarga', 'Scan Ijazah', 'Scan Piagam Prestasi (Jika Ada)'] as $label)
                                    <div class="form-group text-center">
                                        <label>{{ $label }}</label>
                                        <div class="border rounded d-flex justify-content-center align-items-center"
                                            style="height: 120px; border-style: dashed;">
                                            <span class="text-muted">Lihat Dokumen</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <h5 class="mt-4"><strong>Data Orang Tua / Wali</strong></h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Ayah</label>
                                    <input type="text" class="form-control" placeholder="Nama Ayah">
                                </div>
                                <div class="form-group">
                                    <label>Nama Ibu</label>
                                    <input type="text" class="form-control" placeholder="Nama Ibu">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control" placeholder="Alamat Orang Tua">
                                </div>
                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="text" class="form-control" placeholder="No. HP Orang Tua">
                                </div>
                            </div>
                        </div>

                        <h5 class="mt-4"><strong>Status Verifikasi</strong></h5>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control">
                                <option value="">Status</option>
                                <option value="Diterima">Diterima</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </div>

                        <div class="form-group d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary">Batal</button>
                            <button type="submit" class="btn btn-dark">Konfirmasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
