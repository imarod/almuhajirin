@extends('adminlte::page')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->

        </div>

        <div class="alert alert-dark d-flex align-items-left">
            <i class="fas fa-info-circle mr-2"></i>
            <span>Pastikan dokumen yang Anda unggah memiliki kualitas scan yang jelas dan mudah dibaca.</span>
        </div>


        {{-- Gunakan container-fluid agar penuh, px-3 untuk padding kiri-kanan --}}
        <div class="row justify-content-start "> {{-- mt-4 untuk memberi jarak dari atas --}}
            <div class="col-md-12"> {{-- Lebar card bisa diatur, misalnya 8 kolom dari 12 --}}
                {{-- <div class="card shadow-sm mt-4">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div> --}}

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {{-- 
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Data Calon Siswa -->
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h5 class="mb-0 text-white">Data Calon Siswa</h5>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="Masukkan Nama Lengkap" name="nama">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>NISN</label>
                                <input type="text" class="form-control @error('nisn') is-invalid @enderror"
                                    placeholder="Masukkan NISN" name="nisn">
                                @error('nisn')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group ">

                                <label>Jenis Kelamin</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                        type="radio" name="jenis_kelamin" value="Laki-laki">
                                    <label class="form-check-label">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan">
                                    <label class="form-check-label">Perempuan</label>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                    placeholder="Masukkan Tempat Lahir"name="tempat_lahir">
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    name="tanggal_lahir">
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control @error('alamat_siswa') is-invalid @enderror"
                                    placeholder="Masukkan Alamat" name="alamat_siswa">
                                @error('alamat_siswa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>No HP</label>
                                <input type="text" class="form-control @error('no_hp_siswa') is-invalid @enderror"
                                    placeholder="Masukkan No HP" name="no_hp_siswa">
                                @error('no_hp_siswa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Scan Kartu Keluarga</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('kk') is-invalid @enderror"
                                        name="kk">
                                    <label class="custom-file-label">Unggah Dokumen</label>
                                    @error('kk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Scan Ijazah</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('ijazah') is-invalid @enderror"
                                        name="ijazah">
                                    <label class="custom-file-label">Unggah Dokumen</label>
                                    @error('ijazah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Kategori Prestasi (Jika Ada)</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value=""
                                        name="kategori_prestasi[]">
                                    <label class="form-check-label">Hafidz Qur'an 1-3 Juz</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value=""
                                        name="kategori_prestasi[]">
                                    <label class="form-check-label">Hafidz Qur'an 4-5 Juz</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value=""
                                        name="kategori_prestasi[]">
                                    <label class="form-check-label">Peringkat 1-5</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value=""
                                        name="kategori_prestasi[]">
                                    <label class="form-check-label">Prestasi Non Akademik Tingkat Kabupaten</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Scan Piagam Prestasi (Jika Ada)</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('piagam') is-invalid @enderror"
                                        name="piagam">
                                    <label class="custom-file-label">Unggah Dokumen</label>
                                    @error('piagam')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Orang Tua / Wali -->
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h5 class="mb-0 text-white">Data Orang Tua / Wali</h5>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label>Nama Ayah</label>
                                <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror"
                                    placeholder="Masukkan Nama Ayah" name="nama_ayah">
                                @error('nama_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Nama Ibu</label>
                                <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror"
                                    placeholder="Masukkan Nama Ibu" name="nama_ibu">
                                @error('nama_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control @error('alamat_ortu') is-invalid @enderror"
                                    placeholder="Masukkan Alamat" name="alamat_ortu">
                                @error('alamat_ortu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>No HP</label>
                                <input type="text" class="form-control @error('no_hp_ortu') is-invalid @enderror"
                                    placeholder="Masukkan No HP" name="no_hp_ortu">
                                @error('no_hp_ortu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-dark px-5">Kirim</button>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->

    <script>
        document.querySelectorAll('.custom-file-input').forEach(function(input) {
            input.addEventListener('change', function(e) {
                let fileName = e.target.files[0]?.name || '';
                let label = e.target.nextElementSibling;
                if (label && fileName) {
                    label.textContent = fileName
                }
            });
        })
    </script>
@endsection
