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

        @if ($statusPendaftaran === 'open' && $jadwalAktif)
        <x-jadwal-ppdb-aktif />
            {{-- <div class="card mb-4 border-left-primary shadow-sm" style="border-left: 4px solid #5E7CE3 !important;">
                <div class="card-body" style="background: linear-gradient(135deg, #e3f2fd 0%, #e8eaf6 100%);">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 mr-3">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px; background-color: rgba(0, 123, 255, 0.1) !important;">
                                <i class="fas fa-bell" style="color: #5E7CE3;"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="font-weight-bold text-dark mb-1">Pendaftaran Tahun Ajaran
                                {{ $jadwalAktif->thn_ajaran }}
                                Gelombang {{ $jadwalAktif->gelombang_pendaftaran }} Telah
                                Dibuka
                            </h5>
                            <p class="text-muted mb-0 small">Periode pendaftaran berlangsung hingga tanggal
                                {{ \Carbon\Carbon::parse($jadwalAktif->tgl_berakhir)->format('d-m-Y') }}</p>
                        </div>
                    </div>
                </div>
            </div> --}}
        @endif

        <div class="row justify-content-start">
           
            <div class="col-md-12">
                @if ($statusPendaftaran == 'open')
                    <form
                        action="{{ isset($pendaftaran) ? route('formulir.update', $pendaftaran->id) : route('pendaftaran.store') }}"
                        method="POST" enctype="multipart/form-data">
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


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-medium text-dark">NISN</label>
                                            <input type="text" class="form-control @error('nisn') is-invalid @enderror"
                                                placeholder="Masukkan NISN" name="nisn" id="nisnInput"
                                                style="border: 1px solid #ced4da; border-radius: 4px;"
                                                value="{{ isset($pendaftaran) ? $pendaftaran->siswa->nisn : old('nisn') }}"
                                                pattern="\d*" inputmode="numeric">

                                            @error('nisn')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-medium text-dark">Tempat Lahir</label>
                                            <input type="text"
                                                class="form-control @error('tempat_lahir') is-invalid @enderror"
                                                placeholder="Masukkan Tempat Lahir" name="tempat_lahir"
                                                style="border: 1px solid #ced4da; border-radius: 4px;"
                                                value="{{ isset($pendaftaran) ? $pendaftaran->siswa->tempat_lahir : old('tempat_lahir') }}">
                                            @error('tempat_lahir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-medium text-dark">Nama Lengkap</label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                                placeholder="Masukkan Nama Lengkap" name="nama"
                                                style="border: 1px solid #ced4da; border-radius: 4px;"
                                                value="{{ isset($pendaftaran) ? $pendaftaran->siswa->nama : old('nama') }}">
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <style>
                                        .date-wrapper {
                                            position: relative;
                                            display: inline-block;
                                            width: 100%;
                                        }

                                        .date-wrapper input[type="date"] {
                                            padding-left: 35px;
                                        }

                                        .date-wrapper input[type="date"]::-webkit-calendar-picker-indicator {
                                            position: absolute;
                                            left: 8px;
                                            top: 50%;
                                            transform: translateY(-50%);
                                            cursor: pointer;
                                        }
                                    </style>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <div class="date-wrapper">
                                                <input type="date"
                                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                    name="tanggal_lahir"
                                                    value="{{ isset($pendaftaran) ? $pendaftaran->siswa->tanggal_lahir->format('Y-m-d') : old('tanggal_lahir') }}">
                                                @error('tanggal_lahir')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label>Jenis Kelamin</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                                    type="radio" name="jenis_kelamin" value="Laki-laki"
                                                    {{ isset($pendaftaran) && $pendaftaran->siswa->jenis_kelamin == 'Laki-laki' ? 'checked' : (old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '') }}>
                                                <label class="form-check-label">Laki-laki</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                    value="Perempuan"
                                                    {{ isset($pendaftaran) && $pendaftaran->siswa->jenis_kelamin == 'Perempuan' ? 'checked' : (old('jenis_kelamin') == 'Perempuan' ? 'checked' : '') }}>
                                                <label class="form-check-label">Perempuan</label>
                                            </div>
                                            @error('jenis_kelamin')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-medium text-dark mb-0">No Telepon</label>
                                            <small class="text-muted d-block mb-2">Masukkan nomor telepon diawali angka
                                                8, tanpa 0 atau +62</small>
                                            <style>
                                                .input-group-text {
                                                    padding: 0.375rem 0.75rem;
                                                    font-size: 1rem;
                                                    line-height: 1.5;
                                                    color: #495057;
                                                }

                                                .input-group>.form-control {
                                                    border-left: none;
                                                    border-radius: 0 0.25rem 0.025rem 0;
                                                }
                                            </style>
                                            <div class="input-group">

                                                <span class="input-group-text"
                                                    style="background-color: #e9ecef; border-right: none; border-radius: 0.25rem 0 0 0.25rem;">+62</span>
                                                <input type="text" id="phoneInput"
                                                    class="form-control @error('no_hp_siswa') is-invalid @enderror"
                                                    placeholder="Masukkan No Handphone" name="no_hp_siswa"
                                                    value="{{ isset($pendaftaran) ? $pendaftaran->siswa->no_hp_siswa : old('no_hp_siswa_display') }}">
                                                <input type="hidden" name="no_hp_siswa" id="hiddenPhoneInput"
                                                    value="{{ isset($pendaftaran) ? $pendaftaran->siswa->no_hp_siswa : old('no_hp_siswa') }}">
                                                @error('no_hp_siswa')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-medium text-dark">Alamat Lengkap</label>
                                            <input type="text"
                                                class="form-control  @error('alamat_siswa') is-invalid @enderror"
                                                placeholder="Masukkan Alamat Lengkap" name="alamat_siswa"
                                                style="border: 1px solid #ced4da; border-radius: 4px;"
                                                value="{{ isset($pendaftaran) ? $pendaftaran->siswa->alamat_siswa : old('alamat_siswa') }}">
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
                                            <label class="font-weight-medium text-dark mb-0">Scan Kartu
                                                Keluarga</label>
                                            <small class="text-muted d-block mb-2">Unggah dalam bentuk format PDf maks
                                                1 mb</small>
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('kk') is-invalid @enderror"
                                                    id="kkInput" name="kk" accept=".pdf">

                                                <label class="custom-file-label" for="kkInput">Unggah Dokumen</label>
                                                @error('kk')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-medium text-dark mb-0">Scan Ijazah</label>
                                            <small class="text-muted d-block mb-2">Unggah dalam bentuk format PDf maks
                                                1 mb</small>
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('ijazah') is-invalid @enderror"
                                                    id="ijazahInput" name="ijazah" accept=".pdf">
                                                <label class="custom-file-label" for="ijazahInput">Unggah
                                                    Dokumen</label>
                                                @error('ijazah')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-medium text-dark">Kategori Prestasi (Jika
                                        Ada)</label><br>
                                    @php
                                        $prestasi = isset($pendaftaran)
                                            ? explode(',', $pendaftaran->siswa->kategori_prestasi)
                                            : [];
                                    @endphp
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="Hafidz Qur'an 1-3 Juz" name="kategori_prestasi[]"
                                                    {{ in_array('Hafidz Qur\'an 1-3 Juz', $prestasi) ? 'checked' : '' }}>
                                                <label class="form-check-label">Hafidz Qur'an 1-3 Juz</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="Hafidz Qur'an 4-5 Juz" name="kategori_prestasi[]"
                                                    {{ in_array('Hafidz Qur\'an 4-5 Juz', $prestasi) ? 'checked' : '' }}>
                                                <label class="form-check-label">Hafidz Qur'an 4-5 Juz</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Peringkat 1-5"
                                                    name="kategori_prestasi[]"
                                                    {{ in_array('Peringkat 1-5', $prestasi) ? 'checked' : '' }}>
                                                <label class="form-check-label">Peringkat 1-5</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="Prestasi Non Akademik Tingkat Kabupaten"
                                                    name="kategori_prestasi[]"
                                                    {{ in_array('Prestasi Non Akademik Tingkat Kabupaten', $prestasi) ? 'checked' : '' }}>
                                                <label class="form-check-label">Prestasi Non Akademik Tingkat
                                                    Kabupaten</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-medium text-dark mb-0">Scan Piagam Prestasi (Jika
                                                Ada)</label>
                                            <small class="text-muted d-block mb-2">Unggah dalam bentuk format PDf maks
                                                1 mb</small>
                                            <div class="custom-file">
                                                <input type="file"
                                                    class="custom-file-input @error('piagam') is-invalid @enderror"
                                                    id="piagamInput" name="piagam" accept=".pdf">
                                                <label class="custom-file-label" for="piagamInput">Unggah
                                                    Dokumen</label>
                                                @error('piagam')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
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
                                            <label class="font-weight-medium text-dark">Nama Ayah</label>
                                            <input type="text"
                                                class="form-control @error('nama_ayah') is-invalid @enderror"
                                                placeholder="Masukkan Nama Ayah" name="nama_ayah"
                                                style="border: 1px solid #ced4da; border-radius: 4px;"
                                                value="{{ isset($pendaftaran) ? $pendaftaran->siswa->orangTua->nama_ayah : old('nama_ayah') }}">
                                            @error('nama_ayah')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-medium text-dark">Nama Ibu</label>
                                            <input type="text"
                                                class="form-control @error('nama_ibu') is-invalid @enderror"
                                                placeholder="Masukkan Nama Ibu" name="nama_ibu"
                                                style="border: 1px solid #ced4da; border-radius: 4px;"
                                                value="{{ isset($pendaftaran) ? $pendaftaran->siswa->orangTua->nama_ibu : old('nama_ibu') }}">
                                            @error('nama_ibu')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row ">
                                    <div class="col-md-6 ">
                                        <div class="form-group  ">
                                            <label class="font-weight-medium text-dark ">Alamat Lengkap</label>
                                            <small class="text-muted d-block invisible">Spacer</small>
                                            <input type="text"
                                                class="form-control @error('alamat_ortu') is-invalid @enderror"
                                                placeholder="Masukkan Alamat" name="alamat_ortu"
                                                style="border: 1px solid #ced4da; border-radius: 4px;"
                                                value="{{ isset($pendaftaran) ? $pendaftaran->siswa->orangTua->alamat_ortu : old('alamat_ortu') }}">
                                            @error('alamat_ortu')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-medium text-dark mb-0">No HP</label>
                                            <small class="text-muted d-block mb-2">Masukkan nomor telepon diawali angka
                                                8, tanpa 0 atau +62</small>
                                            <div class="input-group">
                                                <span class="input-group-text"
                                                    style="background-color: #e9ecef; border-right: none; border-radius: 0.25rem 0 0 0.25rem">+62</span>
                                                <input type="text" id="phoneOrtuInput"
                                                    class="form-control @error('no_hp_ortu') is-invalid @enderror"
                                                    placeholder="Contoh: 81234567890" name="no_hp_ortu"
                                                    value="{{ isset($pendaftaran) ? $pendaftaran->siswa->orangTua->no_hp_ortu : old('no_hp_ortu_display') }}">
                                                <input type="hidden" name="no_hp_ortu" id="hiddenOrtuInput"
                                                    value="{{ isset($pendaftaran) ? $pendaftaran->siswa->orangTua->no_hp_ortu : old('no_hp_ortu') }}">
                                                @error('no_hp_ortu')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="button" class="btn btn-primary px-5 py-2 bg-basic"
                                        id="submitButton"><strong>Kirim</strong></button>
                                </div>
                            </div>
                        </div>
                    </form>
                 @else
                    {{-- <div class="card mb-4 border-left-primary shadow-sm"
                        style="border-left: 4px solid #ff0000 !important;">
                        <div class="card-body" style="background: linear-gradient(135deg, #fde3e3 0%, #f6e8e8 100%);">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 mr-3">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px; background-color: rgba(255, 25, 0, 0.1) !important;">
                                        <i class="fas fa-bell text-danger"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="font-weight-bold text-dark mb-1">{{ $message }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>  --}}
                    <x-jadwal-ppdb-aktif />
                    
                    <div class=" card border-bottom">
                        <div colspan="9" class="text-center py-5">
                            <i class="fas fa-history fa-3x text-muted mb-3" style="opacity: 0.3;"></i>
                            <h5 class="text-muted">Pendaftaran tidak tersedia saat ini.</h5>
                            <p class="text-muted ">Kembali ke menu Daftar</p>
                            <a href="{{ route('ajuan.pendaftaran') }}" class="btn bg-basic text-white">Kembali</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.custom-file-input').forEach(function(input) {
                input.addEventListener('change', function(e) {
                    let file = e.target.files[0];
                    let label = e.target.nextElementSibling;
                    const maxFileSize = 1024 * 1024;

                    // Reset label dan class
                    label.textContent = 'Pilih Berkas';
                    this.classList.remove('is-invalid');
                    let feedbackDiv = this.nextElementSibling.nextElementSibling;
                    if (feedbackDiv && feedbackDiv.classList.contains('invalid-feedback')) {
                        feedbackDiv.remove();
                    }

                    if (file) {
                        const fileSize = file.size;
                        const fileType = file.type;

                        if (fileSize > maxFileSize) {
                            this.classList.add('is-invalid');
                            label.textContent = 'Ukuran file terlalu besar';
                            let feedback = document.createElement('div');
                            feedback.className = 'invalid-feedback';
                            feedback.textContent = 'Ukuran file maksimal 1 MB.';
                            this.parentNode.appendChild(feedback);
                            this.value = '';
                            return;
                        }

                        if (fileType !== 'application/pdf') {
                            this.classList.add('is-invalid');
                            label.textContent = 'Tipe file tidak valid';
                            let feedback = document.createElement('div');
                            feedback.className = 'invalid-feedback';
                            feedback.textContent = 'Hanya file PDF yang diizinkan.';
                            this.parentNode.appendChild(feedback);
                            this.value = '';
                            return;
                        }

                        label.textContent = file.name;
                    }
                });
            });

            // validasi mencegah input no hp tidak valid
            const phoneInput = document.querySelector('#phoneInput')
            const hiddenPhoneInput = document.querySelector('#hiddenPhoneInput')
            const phoneOrtuInput = document.querySelector('#phoneOrtuInput')
            const hiddenOrtuInput = document.querySelector('#hiddenOrtuInput')

            function handlePhoneInput(inputField, hiddenField) {
                inputField.addEventListener('input', function() {
                    inputField.addEventListener('keypress', function(e) {
                        if (inputField.value.length === 0 && (e.key === '6' || e.key === '+')) {
                            e.preventDefault();
                        }
                    });

                    let value = inputField.value.replace(/[^0-9]/g, '')

                    if (value.startsWith('0')) {
                        value = value.substring(1);
                        inputField.value = value
                    } else if (value.startsWith('62')) {
                        value = value.substring(2);
                        inputField.value = value
                    }

                    if (value.length > 12) {
                        value = value.substring(0, 12)
                        inputField.value = value
                    }
                    hiddenField.value = value ? '+62' + value : ''
                })
                inputField.addEventListener('keypress', function(e) {
                    if (inputField.value === '' && e.key === '0') {
                        e.preventDefault()
                    }
                })
            }

            handlePhoneInput(phoneInput, hiddenPhoneInput)
            handlePhoneInput(phoneOrtuInput, hiddenOrtuInput)

            // validasi no telepon siswa dan ortu
            document.querySelector('form').addEventListener('submit', function(e) {
                const phoneRegex = /^[8][0-9]{8,11}$/;

                let isValid = true;

                // Validasi Nomor HP Siswa
                if (phoneInput.value && !phoneRegex.test(phoneInput.value)) {
                    e.preventDefault();
                    phoneInput.classList.add('is-invalid');
                    let feedback = phoneInput.parentElement.querySelector('.invalid-feedback');
                    if (!feedback) {
                        feedback = document.createElement('div');
                        feedback.className = 'invalid-feedback';
                        phoneInput.parentElement.appendChild(feedback);
                    }
                    feedback.textContent = 'Nomor HP siswa harus diawali dengan 8 dan berisi 9-12 digit.';
                    isValid = false;
                } else {
                    phoneInput.classList.remove('is-invalid');
                }

                // Validasi Nomor HP Orang Tua
                if (phoneOrtuInput.value && !phoneRegex.test(phoneOrtuInput.value)) {
                    e.preventDefault();
                    phoneOrtuInput.classList.add('is-invalid');
                    let feedback = phoneOrtuInput.parentElement.querySelector('.invalid-feedback');
                    if (!feedback) {
                        feedback = document.createElement('div');
                        feedback.className = 'invalid-feedback';
                        phoneOrtuInput.parentElement.appendChild(feedback);
                    }
                    feedback.textContent =
                        'Nomor HP Orang Tua harus diawali dengan 8 dan berisi 9-12 digit.';
                    isValid = false;
                } else {
                    phoneOrtuInput.classList.remove('is-invalid');
                }
                if (!isValid) {
                    e.preventDefault();
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
                    confirmButtonText: 'Tutup'
                });
            @endif

            // Add event listener for the confirmation modal
            const submitButton = document.getElementById('submitButton');
            if (submitButton) {
                submitButton.addEventListener('click', function(event) {
                    // Get the form element
                    const form = event.target.closest('form');
                    if (!form) return;

                    // Perform form validation before showing the modal
                    if (!form.checkValidity()) {
                        form.reportValidity();
                        return; // Stop if form is not valid
                    }

                    // Show the confirmation modal
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
                            // If user clicks "Ya, Kirim!", submit the form
                            form.submit();
                        }
                    });
                });
            }
        });
    </script>
@endpush
