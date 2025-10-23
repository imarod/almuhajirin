@extends('layouts.adminlte-custom')

@section('content_header')
    @if (isset($pendaftaran))
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 font-weight-bold text-dark">Edit formulir pendaftaran siswa</h1>
                </div>
            </div>
        </div>
    @else
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 font-weight-bold text-dark">Formulir Pendaftaran Siswa</h1>
                </div>
            </div>
        </div>
    @endif

@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-start ">
            <div class="d-flex align-items-center mb-3">
                <a href="/siswa/pendaftaran" class="btn rounded-circle border mr-2">
                    <i class="fas fa-arrow-left text-black"></i>
                </a>
                <a href="/siswa/pendaftaran" style="text-decoration: none; color: black;">Kembali</a>
            </div>

            <div class="col-md-12">
                @if ($statusPendaftaran == 'open')
                    <form
                        action="{{ isset($pendaftaran) ? route('formulir.update', $pendaftaran->id) : route('pendaftaran.store') }}"
                        method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @if (isset($pendaftaran))
                            @method('PUT')
                        @endif

                        <div class="card ">
                            <div class="card-header bg-basic"
                                style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                                <h5 class="mb-0 font-weight-bold text-white">Data Pribadi</h5>
                            </div>
                            <div class="card-body" style="background-color: #ffffff;">
                                <small> <span class="text-danger font-weight-bold">*</span> Wajib Diisi</small>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="d-flex align-items-center gap-1">
                                                <span class="font-weight-medium text-dark">NISN</span>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('nisn') is-invalid @enderror"
                                                placeholder="Masukkan NISN" name="nisn" id="nisnInput"
                                                value="{{ isset($pendaftaran) ? $pendaftaran->siswa->nisn : old('nisn') }}"
                                                pattern="\d*" inputmode="numeric" required>

                                            @error('nisn')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="d-flex align-items-center gap-1">
                                                <span class="font-weight-medium text-dark">Tempat Lahir</span>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                placeholder="Masukkan Tempat Lahir" name="tempat_lahir"
                                                value="{{ isset($pendaftaran) ? $pendaftaran->siswa->tempat_lahir : old('tempat_lahir') }}"
                                                required>
                                            @error('tempat_lahir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="d-flex align-items-center gap-1">
                                                <span class="font-weight-medium text-dark">Nama Lengkap</span>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                placeholder="Masukkan Nama Lengkap" name="nama"
                                                value="{{ isset($pendaftaran) ? $pendaftaran->siswa->nama : old('nama') }}"
                                                required>
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="d-flex align-items-center gap-1">
                                                <span class="font-weight-medium text-dark">Tanggal Lahir</span>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <input type="date"
                                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                    name="tanggal_lahir"
                                                    value="{{ isset($pendaftaran) ? $pendaftaran->siswa->tanggal_lahir->format('Y-m-d') : old('tanggal_lahir') }}"
                                                    required>
                                                @error('tanggal_lahir')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="d-flex align-items-center gap-1">
                                                <span class="font-weight-medium text-dark">Email</span>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <small class="text-muted d-block invisible mt-md-3">Spacer</small>
                                            <input type="email"
                                                class="form-control  @error('email_siswa') is-invalid @enderror"
                                                placeholder="Masukkan Email Aktif" name="email_siswa"
                                                value="{{ isset($pendaftaran) ? $pendaftaran->siswa->email_siswa : old('email_siswa') }}"
                                                required>
                                            @error('email_siswa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="d-flex align-items-center gap-1">
                                                <span class="font-weight-medium text-dark">Nomor WhatsApp</span>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <small class="text-muted d-block mb-2">Masukkan nomor telepon diawali angka
                                                8, tanpa 0 atau +62</small>
                                            <style>

                                            </style>
                                            <div class="input-group">
                                                {{-- Menampilkan old value tanpa +62 atau 62 --}}
                                                @php
                                                    $noHpSiswa = isset($pendaftaran)
                                                        ? $pendaftaran->siswa->no_hp_siswa
                                                        : old('no_hp_siswa');
                                                    $displayedPhoneSiswa = str_replace(['+62', '62'], '', $noHpSiswa);
                                                    $displayedPhoneSiswa = ltrim($displayedPhoneSiswa, '0');
                                                @endphp

                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> +62</span>
                                                </div>

                                                <input type="text" id="phoneInput"
                                                    class="form-control @error('no_hp_siswa') is-invalid @enderror"
                                                    placeholder="Contoh: 8738773637" required
                                                    value="{{ $displayedPhoneSiswa }}">
                                                <input type="hidden" name="no_hp_siswa" id="hiddenPhoneInput"
                                                    value="{{ isset($pendaftaran) ? $pendaftaran->siswa->no_hp_siswa : old('no_hp_siswa') }}">
                                                <div id="no_hp_siswa-feedback" class="invalid-feedback"
                                                    style="display: none;"></div>
                                                @error('no_hp_siswa')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label class="d-flex align-items-center gap-1">
                                                <span class="font-weight-medium text-dark">Jenis Kelamin</span>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="form-check form-check-inline">
                                                <input
                                                    class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                                    type="radio" name="jenis_kelamin" value="Laki-laki" id="jk_laki"
                                                    {{ isset($pendaftaran) && $pendaftaran->siswa->jenis_kelamin == 'Laki-laki' ? 'checked' : (old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '') }}
                                                    required>
                                                <label class="form-check-label" for="jk_laki">Laki-laki</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                    value="Perempuan" id="jk_perempuan"
                                                    {{ isset($pendaftaran) && $pendaftaran->siswa->jenis_kelamin == 'Perempuan' ? 'checked' : (old('jenis_kelamin') == 'Perempuan' ? 'checked' : '') }}>
                                                <label class="form-check-label" for="jk_perempuan">Perempuan</label>
                                            </div>
                                            <div id="jenis_kelamin-feedback" class="text-danger"
                                                style="display: none; font-size: 80%;">Jenis kelamin harus dipilih</div>
                                            @error('jenis_kelamin')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="d-flex align-items-center gap-1">
                                                <span class="font-weight-medium text-dark">Alamat Lengkap</span>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <small class="text-muted d-block mb-2"> Format: Jalan, Desa, Kecamatan, Kabupaten/Kota, Provinsi.</small>
                                            <textarea
                                                class="form-control  @error('alamat_siswa') is-invalid @enderror"
                                                placeholder="Masukkan Alamat Lengkap" name="alamat_siswa"
                                                required>{{ isset($pendaftaran) ? $pendaftaran->siswa->alamat_siswa : old('alamat_siswa') }}</textarea>
                                            @error('alamat_siswa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card ">
                            <div class="card-header bg-basic"
                                style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                                <h5 class="mb-0 font-weight-bold text-white">Unggah Berkas</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="d-flex align-items-center gap-1">
                                                <span class="font-weight-medium text-dark">Scan Kartu
                                                    Keluarga</span>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <small class="text-muted d-block mb-2">Unggah dalam bentuk format PDf maks
                                                1 MB</small>
                                            @if (isset($pendaftaran) && $pendaftaran->kk)
                                                <div class="mb-3">
                                                    <p>Dokumen yang sudah diunggah:</p>
                                                    <a href="{{ Storage::url($pendaftaran->kk) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i> Lihat Dokumen
                                                    </a>
                                                </div>
                                            @endif

                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('kk') is-invalid @enderror"
                                                    id="kkInput" name="kk" accept=".pdf"
                                                    {{ !isset($pendaftaran) ? 'required' : '' }}>
                                                <label class="custom-file-label" for="kkInput">
                                                    {{ isset($pendaftaran) && $pendaftaran->kk ? 'Pilih Berkas untuk mengganti' : 'Unggah Dokumen' }}
                                                </label>
                                                @error('kk')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="d-flex align-items-center gap-1">
                                                <span class="font-weight-medium text-dark">Scan Ijazah</span>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <small class="text-muted d-block mb-2">Unggah dalam bentuk format PDf maks
                                                1 MB</small>
                                            @if (isset($pendaftaran) && $pendaftaran->ijazah)
                                                <div class="mb-3">
                                                    <p>Dokumen yang sudah diunggah:</p>
                                                    <a href="{{ Storage::url($pendaftaran->ijazah) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i> Lihat Dokumen
                                                    </a>
                                                </div>
                                            @endif

                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('ijazah') is-invalid @enderror"
                                                    id="ijazahInput" name="ijazah" accept=".pdf"
                                                    {{ !isset($pendaftaran) ? 'required' : '' }}>
                                                <label class="custom-file-label" for="ijazahInput">
                                                    {{ isset($pendaftaran) && $pendaftaran->ijazah ? 'Pilih Berkas untuk mengganti' : 'Unggah Dokumen' }}
                                                </label>
                                                @error('ijazah')
                                                    <div class="invalid-feedback">{{ $message }}</div> 
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-medium text-dark">Kategori Prestasi
                                                (Optional)</label>
                                            <br>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="kategori_prestasi_id" id="prestasi_none" value=""
                                                    {{ old('kategori_prestasi_id', $pendaftaran->kategori_prestasi_id ?? '') == '' ? 'checked' : '' }}>
                                                {{-- <label class="form-check-label" for="prestasi_none">Tidak Ada
                                                    Prestasi</label> --}}
                                            </div>

                                            @foreach ($kategoriPrestasiAktif as $kategori)
                                                @php
                                                    $selectedId = old(
                                                        'kategori_prestasi_id',
                                                        $pendaftaran->kategori_prestasi_id ?? '',
                                                    );
                                                @endphp
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="kategori_prestasi_id" id="prestasi_{{ $kategori->id }}"
                                                        value="{{ $kategori->id }}"
                                                        {{ $selectedId == $kategori->id ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="prestasi_{{ $kategori->id }}">
                                                        {{ $kategori->nama_prestasi }}
                                                    </label>
                                                </div>
                                            @endforeach

                                            @error('kategori_prestasi_id')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-medium text-dark mb-0">Scan Piagam Prestasi
                                                (Optional)</label>
                                            <small class="text-muted d-block mb-2">Unggah dalam bentuk format PDf maks
                                                1 MB</small>
                                            @if (isset($pendaftaran) && $pendaftaran->piagam)
                                                <div class="mb-3">
                                                    <p>Dokumen yang sudah diunggah:</p>
                                                    <a href="{{ Storage::url($pendaftaran->piagam) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i> Lihat Dokumen
                                                    </a>
                                                </div>
                                            @endif

                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('piagam') is-invalid @enderror"
                                                    id="piagamInput" name="piagam" accept=".pdf">
                                                <label class="custom-file-label" for="piagamInput">
                                                    {{ isset($pendaftaran) && $pendaftaran->piagam ? 'Pilih Berkas untuk mengganti' : 'Unggah Dokumen' }}
                                                </label>
                                                @error('piagam')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    @if ($jurusanAktif->count() > 0)
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="d-flex align-items-center gap-1">
                                                    <span class="font-weight-medium text-dark">Jurusan</span>
                                                    <span class="text-danger">*</span>
                                                </label>
                                                @foreach ($jurusanAktif as $jrs)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="jurusan_id"
                                                            id="jurusan-{{ $jrs->id }}" value="{{ $jrs->id }}"
                                                            {{ old('jurusan_id', $pendaftaran->jurusan_id ?? '') == $jrs->id ? 'checked' : '' }}
                                                            required>
                                                        <label class="form-check-label"
                                                            for="jurusan-{{ $jrs->id }}">
                                                            {{ $jrs->nama_jurusan }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                                <div id="jurusan_id-feedback" class="text-danger"
                                                    style="display: none; font-size: 70%;">Silakan pilih jurusan.</div>
                                                @error('jurusan_id')
                                                    <div class="text-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col-md-6">

                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>

                        </div>

                        <div class="card  mt-4">
                            <div class="card-header bg-basic"
                                style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                                <h5 class="mb-0 font-weight-bold text-white">Data Orang Tua / Wali</h5>
                            </div>
                            <div class="card-body" style="background-color: #ffffff;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="d-flex align-items-center gap-1">
                                                <span class="font-weight-medium text-dark">Nama Ayah</span>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('nama_ayah') is-invalid @enderror"
                                                placeholder="Masukkan Nama Ayah" name="nama_ayah"
                                                value="{{ isset($pendaftaran) ? $pendaftaran->siswa->orangTua->nama_ayah : old('nama_ayah') }}"
                                                required>
                                            @error('nama_ayah')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="d-flex align-items-center gap-1">
                                                <span class="font-weight-medium text-dark">Nama Ibu</span>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control @error('nama_ibu') is-invalid @enderror"
                                                placeholder="Masukkan Nama Ibu" name="nama_ibu"
                                                value="{{ isset($pendaftaran) ? $pendaftaran->siswa->orangTua->nama_ibu : old('nama_ibu') }}"
                                                required>
                                            @error('nama_ibu')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="row ">
                                    <div class="col-md-6 ">
                                        <div class="form-group  ">
                                            <label class="d-flex align-items-center gap-1">
                                                <span class="font-weight-medium text-dark">Alamat Lengkap</span>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <small class="text-muted d-block mb-2"> Format: Jalan, Desa, Kecamatan, Kabupaten/Kota, Provinsi.</small>
                                            <textarea 
                                                class="form-control @error('alamat_ortu') is-invalid @enderror"
                                                placeholder="Masukkan Alamat" name="alamat_ortu"
                                                required>{{ isset($pendaftaran) ? $pendaftaran->siswa->orangTua->alamat_ortu : old('alamat_ortu') }}</textarea>
                                            @error('alamat_ortu')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="d-flex align-items-center gap-1">
                                                <span class="font-weight-medium text-dark">Nomor WhatsApp</span>
                                                <span class="text-danger">*</span>
                                            </label>
                                            <small class="text-muted d-block mb-2">Masukkan nomor telepon diawali angka
                                                8, tanpa 0 atau +62</small>
                                            <div class="input-group">

                                                {{-- Menampilkan Old Value tanpa +62 atau 62 --}}
                                                @php
                                                    $noHpOrtu = isset($pendaftaran)
                                                        ? $pendaftaran->siswa->orangTua->no_hp_ortu
                                                        : old('no_hp_ortu');
                                                    $displayedPhoneOrtu = str_replace(['+62', '62'], '', $noHpOrtu);
                                                    $displayedPhoneOrtu = ltrim($displayedPhoneOrtu, '0');
                                                @endphp

                                                <span class="input-group-text"
                                                    style="background-color: #e9ecef; border-right: none; border-radius: 0.25rem 0 0 0.25rem">+62</span>
                                                <input type="text" id="phoneOrtuInput"
                                                    class="form-control @error('no_hp_ortu') is-invalid @enderror"
                                                    placeholder="Contoh: 81234567890" required
                                                    value="{{ $displayedPhoneOrtu }}">
                                                <input type="hidden" name="no_hp_ortu" id="hiddenOrtuInput"
                                                    value="{{ isset($pendaftaran) ? $pendaftaran->siswa->orangTua->no_hp_ortu : old('no_hp_ortu') }}">
                                                <div id="no_hp_ortu-feedback" class="invalid-feedback"
                                                    style="display: none;"></div>
                                                @error('no_hp_ortu')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="button" style="background-color: #31708F"
                                        class="btn text-white px-5 py-2 "
                                        id="submitButton"><strong>Kirim</strong></button>
                                </div>
                            </div>
                        </div>
                    </form>
                @else
                    <x-jadwal-ppdb-aktif />
                    @if ($statusPendaftaran === 'closed')
                        <div class="card border-bottom">
                            <div colspan="9" class="text-center py-5">
                                <i class="fas fa-history fa-3x text-muted mb-3" style="opacity: 0.3;"></i>
                                <h5 class="text-muted">{{ $message }}</h5>
                                <p class="text-muted ">Kembali ke menu Daftar</p>
                                <a href="{{ route('ajuan.pendaftaran') }}" class="btn  text-white"
                                    style="background-color: #31708F">Kembali</a>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // custom error messages client validation
            const customErrorMessages = {
                'required': 'Input ini wajib diisi.',
                'email': 'Format email tidak valid.',
                'numeric': 'NISN harus berupa angka.',
                'jenis_kelamin': 'Jenis kelamin harus dipilih.',
                'jurusan_id': 'Silakan pilih jurusan.',
                'file_max_size': 'Ukuran file maksimal 1 MB.',
                'file_mime_type': 'Hanya file PDF yang diizinkan.',
                'piagam_required_with': 'File piagam harus diunggah jika Kategori Prestasi dipilih selain "Tidak Ada Prestasi".',
                'phone_format': 'Nomor HP harus diawali dengan 8 dan berisi 9-12 digit.',
                'phone_required': 'Nomor WhatsApp wajib diisi.',
            };

            // Fungsi untuk menampilkan pesan error kustom (Bootstrap styling)
            function displayCustomError(element, message, feedbackElementId = null) {
                clearCustomError(element, feedbackElementId);

                element.classList.add('is-invalid');

                let feedbackElement = null;

                if (element.type === 'radio' && feedbackElementId) {
                    feedbackElement = document.getElementById(feedbackElementId);
                    if (feedbackElement) {
                        feedbackElement.textContent = message;
                        feedbackElement.style.display = 'block';
                    }
                } else if (element.id === 'phoneInput' || element.id === 'phoneOrtuInput') {
                    const phoneFieldId = element.id === 'phoneInput' ? 'no_hp_siswa-feedback' :
                        'no_hp_ortu-feedback';
                    feedbackElement = document.getElementById(phoneFieldId);
                    if (feedbackElement) {
                        feedbackElement.textContent = message;
                        feedbackElement.style.display = 'block';
                    }
                } else {
                    let parent = element.closest('.form-group') || element.closest('.custom-file') || element
                        .parentElement;
                    feedbackElement = parent.querySelector('.invalid-feedback');

                    if (!feedbackElement) {
                        feedbackElement = document.createElement('div');
                        feedbackElement.className = 'invalid-feedback';
                        (element.closest('.custom-file') || element).after(feedbackElement);
                    }
                    feedbackElement.textContent = message;
                }
            }

            // Fungsi untuk membersihkan error
            function clearCustomError(element, feedbackElementId = null) {
                element.classList.remove('is-invalid');

                if (element.type === 'radio' && feedbackElementId) {
                    const feedbackElement = document.getElementById(feedbackElementId);
                    if (feedbackElement) {
                        feedbackElement.style.display = 'none';
                    }
                } else if (element.id === 'phoneInput' || element.id === 'phoneOrtuInput') {
                    const phoneFieldId = element.id === 'phoneInput' ? 'no_hp_siswa-feedback' :
                        'no_hp_ortu-feedback';
                    const feedbackElement = document.getElementById(phoneFieldId);
                    if (feedbackElement) {
                        feedbackElement.style.display = 'none';
                    }
                } else {
                    let parent = element.closest('.form-group') || element.parentElement;
                    let existingFeedback = parent.querySelector(
                        '.invalid-feedback:not(.d-block)');
                    if (existingFeedback) {
                        existingFeedback.remove();
                    }
                }
            }

            // Fungsi untuk mendapatkan pesan error yang sesuai dari validasi HTML5
            function getHtml5ErrorMessage(input) {
                if (input.validity.valueMissing) {
                    return customErrorMessages.required;
                }
                if (input.validity.typeMismatch && input.type === 'email') {
                    return customErrorMessages.email;
                }
                if (input.validity.patternMismatch && input.name === 'nisn') {
                    return customErrorMessages.numeric;
                }
                return 'Input tidak valid.';
            }

            // FUNGSI VALIDASI REAL-TIME UNTUK INPUT BIASA (NISN, NAMA, TEMPAT LAHIR, DLL)
            function validateFieldRealTime(e) {
                const input = e.target;

                if (input.id === 'phoneInput' || input.id === 'phoneOrtuInput') {
                    validatePhoneInputRealTime(input);
                    return;
                }

                input.setCustomValidity('');

                if (!input.checkValidity()) {
                    const message = getHtml5ErrorMessage(input);
                    input.setCustomValidity(message);
                    displayCustomError(input, message);
                } else {
                    clearCustomError(input);
                }
            }

            // Daftarkan event listener untuk input yang menggunakan validasi HTML5 dan custom pesan
            document.querySelectorAll(
                'input:not([type="radio"]):not([type="file"]):not([id="phoneInput"]):not([id="phoneOrtuInput"]), textarea, select'
            ).forEach(input => {
                input.addEventListener('blur', validateFieldRealTime);
                input.addEventListener('input', function() {
                    clearCustomError(this);
                    this.setCustomValidity('');
                });
            });


            // 1. VALIDASI UNGGAH BERKAS (FILE INPUT) - (Logika ini tetap sama)
            document.querySelectorAll('.custom-file-input').forEach(function(input) {
                input.addEventListener('change', function(e) {
                    let file = e.target.files[0];
                    let label = e.target.nextElementSibling;
                    const maxFileSize = 1024 * 1024;

                    label.textContent = 'Pilih Berkas';
                    clearCustomError(this);

                    if (file) {
                        const fileSize = file.size;
                        const fileType = file.type;
                        let isValid = true;

                        // Validasi Ukuran
                        if (fileSize > maxFileSize) {
                            displayCustomError(this, customErrorMessages.file_max_size);
                            label.textContent = 'Ukuran file terlalu besar';
                            this.value = '';
                            isValid = false;
                        }

                        // Validasi Tipe
                        if (isValid && fileType !== 'application/pdf') {
                            displayCustomError(this, customErrorMessages.file_mime_type);
                            label.textContent = 'Tipe file tidak valid';
                            this.value = '';
                            isValid = false;
                        }

                        if (isValid) {
                            label.textContent = file.name;
                            clearCustomError(this);
                        }
                    }
                    validatePiagamRequired();
                });
            });


            // 2. LOGIKA INPUT NOMOR HP (PERBAIKAN TAMPILAN ERROR)
            const phoneInput = document.querySelector('#phoneInput')
            const hiddenPhoneInput = document.querySelector('#hiddenPhoneInput')
            const phoneOrtuInput = document.querySelector('#phoneOrtuInput')
            const hiddenOrtuInput = document.querySelector('#hiddenOrtuInput')

            // Fungsi Validasi No HP Real-Time yang sudah diperbaiki
            function validatePhoneInputRealTime(inputField) {
                const phoneRegex = /^[8][0-9]{8,11}$/;

                // A. Required check
                if (inputField.value.length === 0) {
                    const msg = customErrorMessages.phone_required;
                    displayCustomError(inputField, msg);
                    inputField.setCustomValidity(msg);
                }
                // B. Format check
                else if (!phoneRegex.test(inputField.value)) {
                    const msg = customErrorMessages.phone_format;
                    displayCustomError(inputField, msg);
                    inputField.setCustomValidity(msg);
                }
                // C. Valid
                else {
                    clearCustomError(inputField);
                    inputField.setCustomValidity('');
                }
            }


            function handlePhoneInput(inputField, hiddenField) {
                // Event saat user mengetik
                inputField.addEventListener('input', function() {
                    let value = inputField.value.replace(/[^0-9]/g, '');

                    if (value.startsWith('0')) {
                        value = value.substring(1);
                        inputField.value = value;
                    } else if (value.startsWith('62')) {
                        value = value.substring(2);
                        inputField.value = value;
                    }

                    if (value.length > 12) {
                        value = value.substring(0, 12);
                        inputField.value = value;
                    }
                    hiddenField.value = value ? '+62' + value : '';

                    // Panggil validasi real-time saat mengetik
                    validatePhoneInputRealTime(inputField);
                });

                // Mencegah input '0' atau '6' atau '+' di awal
                inputField.addEventListener('keypress', function(e) {
                    if (inputField.value.length === 0 && (e.key === '0' || e.key === '6' || e.key ===
                            '+')) {
                        e.preventDefault();
                    }
                });

                // Event saat kehilangan fokus untuk validasi akhir
                inputField.addEventListener('blur', function() {
                    validatePhoneInputRealTime(inputField);
                });
            }

            handlePhoneInput(phoneInput, hiddenPhoneInput);
            handlePhoneInput(phoneOrtuInput, hiddenOrtuInput);


            // 3. VALIDASI 'required_with' (PIAGAM) 
            const piagamInput = document.getElementById('piagamInput');
            const kategoriPrestasiRadios = document.querySelectorAll('input[name="kategori_prestasi_id"]');

            function validatePiagamRequired() {
                const isPrestasiSelected = document.querySelector('input[name="kategori_prestasi_id"]:checked')
                    .value !== '';

                const isPiagamUploaded = piagamInput.files.length > 0 || (piagamInput.dataset.uploaded === 'true' &&
                    piagamInput.files.length === 0);

                if ("{{ isset($pendaftaran) && $pendaftaran->piagam ? 'true' : 'false' }}" === 'true') {
                    piagamInput.dataset.uploaded = 'true';
                }

                if (isPrestasiSelected && !isPiagamUploaded) {
                    const msg = customErrorMessages.piagam_required_with;
                    piagamInput.setCustomValidity(msg);
                } else {
                    piagamInput.setCustomValidity('');
                }
            }

            kategoriPrestasiRadios.forEach(radio => {
                radio.addEventListener('change', validatePiagamRequired);
            });

            validatePiagamRequired();

            // 4. VALIDASI RADIO BUTTONS (JENIS KELAMIN & JURUSAN) - Real-time (PERBAIKAN TAMPILAN ERROR)
            function validateRadioGroups(e) {
                const groupName = e ? e.target.name : null;
                let isValid = true;

                // Validasi Jenis Kelamin
                const jkRadios = document.getElementsByName('jenis_kelamin');
                const jkFeedbackId = 'jenis_kelamin-feedback';
                if (!groupName || groupName === 'jenis_kelamin') {
                    const jkChecked = Array.from(jkRadios).some(radio => radio.checked);
                    if (!jkChecked) {
                        displayCustomError(jkRadios[0], customErrorMessages.jenis_kelamin, jkFeedbackId);
                        isValid = false;
                    } else {
                        clearCustomError(jkRadios[0], jkFeedbackId);
                    }
                }

                // Validasi Jurusan
                const jurusanRadios = document.getElementsByName('jurusan_id');
                const jurusanFeedbackId = 'jurusan_id-feedback';
                if (jurusanRadios.length > 0 && (!groupName || groupName === 'jurusan_id')) {
                    const jurusanChecked = Array.from(jurusanRadios).some(radio => radio.checked);
                    if (!jurusanChecked) {
                        displayCustomError(jurusanRadios[0], customErrorMessages.jurusan_id, jurusanFeedbackId);
                        isValid = false;
                    } else {
                        clearCustomError(jurusanRadios[0], jurusanFeedbackId);
                    }
                }
                return isValid;
            }

            document.getElementsByName('jenis_kelamin').forEach(radio => radio.addEventListener('change',
                validateRadioGroups));
            document.getElementsByName('jurusan_id').forEach(radio => radio.addEventListener('change',
                validateRadioGroups));


            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                let formIsInvalid = false;

                const isRadioValid = validateRadioGroups();
                validatePiagamRequired();
                validatePhoneInputRealTime(phoneInput);
                validatePhoneInputRealTime(phoneOrtuInput);


                if (!isRadioValid || phoneInput.checkValidity() === false || phoneOrtuInput
                    .checkValidity() === false || piagamInput.checkValidity() === false) {
                    formIsInvalid = true;
                }

                if (!this.checkValidity()) {
                    formIsInvalid = true;
                }

                if (formIsInvalid) {
                    e.preventDefault();

                    this.reportValidity();


                    const firstInvalid = this.querySelector('.is-invalid') || this.querySelector(
                        ':invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                }
            });

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}'
                });
            @endif

            @if ($errors->any())
                const validationErrors = @json($errors->all());
                const errorMessages = validationErrors.join('<br>');
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Mengirimkan Formulir!',
                    html: errorMessages,
                    confirmButtonText: 'Tutup',
                    confirmButtonColor: '#2E8B57'
                });
            @endif

            const submitButton = document.getElementById('submitButton');
            if (submitButton) {
                submitButton.addEventListener('click', function(event) {
                    const form = event.target.closest('form');
                    if (!form) return;

                    const submitEvent = new Event('submit', {
                        cancelable: true
                    });
                    form.dispatchEvent(submitEvent);

                    if (!submitEvent.defaultPrevented) {
                        Swal.fire({
                            title: 'Konfirmasi Pendaftaran',
                            text: 'Apakah Anda yakin ingin mengirim formulir ini? Pastikan semua data sudah benar.',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Kirim!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    }
                });
            }
        });
    </script>
@endpush
