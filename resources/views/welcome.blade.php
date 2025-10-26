<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/tutwuri.png') }}" type="image/x-icon" loading="lazy">

    <title>PPDB | Al Muhajirin</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{-- @vite('resources/css/app.css') --}}

    <style>
        html {
            scroll-behavior: smooth;
        }

        section {
            scroll-margin-top: 80px;
        }

        #mainHeader {
            transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        #heroSection {
            min-height: 100vh;
            padding-top: 100px !important;
        }

        .frosted-header {
            background-color: rgba(255, 255, 255, 0.15) !important;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .hero-container {
            background-image:
                linear-gradient(rgba(57, 63, 69, 0.6)),
                url('{{ asset('images/bg-base.PNG') }}');
            background-size: cover;
            background-position: center;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            min-height: 100vh;
        }

        .blur {
            background-color: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);

            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .blur h1,
        .blur h2,
        .blur p {
            color: #ffffff !important;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }


        .nav-link:hover,
        .nav-link.active {
            color: var(--bs-success) !important;
        }


        .step-card {
            position: relative;
            margin-top: 40px;
        }

        .step-circle {
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
        }

        .equal-height {
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
        }

        .equal-height>[class*="col-"] {
            display: flex;
        }

        .equal-height>[class*="col-"]>div {
            flex: 1;
        }

        @media screen and (max-width: 767px) {

            .responsive-stack thead {
                display: none;
            }

            .responsive-stack tr {
                display: block;
                margin-bottom: .625em;
                border: 1px solid #ccc;
            }

            .responsive-stack td {
                display: block;
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            .responsive-stack td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 45%;
                padding-left: 10px;
                font-weight: bold;
                text-align: left;
            }

            .navbar-collapse.show,
            .navbar-collapse {
                background-color: #393939 !important;
                padding: 2rem;
            }

            /*Memastikan link di dalamnya tetap terlihat (teks putih)*/
            /* .navbar-collapse.show .nav-link, */
            .navbar-collapse .nav-link {
                color: #f8f9fa !important;
            }


            .main-header .navbar-toggler {
                color: #f8f9fa !important;
            }
        }

        @media screen and (max-width: 991px) {
            /* ... semua aturan CSS Anda sebelumnya ... */

            .responsive-stack thead {
                display: none;
            }

        
            .navbar-collapse.show,
            .navbar-collapse {
                background-color: #393939 !important;
                padding: 2rem;
            }

            .navbar-collapse .nav-link {
                color: #f8f9fa !important;
            }

            .main-header .navbar-toggler {
                color: #f8f9fa !important;
            }
        }
    </style>
</head>

<body class="bg-white">
    <header class="fixed-top" id="mainHeader">
        <nav class="navbar navbar-expand-lg navbar-light py-3">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('images/tutwuri.png') }}" style="width: 50px; height: 50px;" alt="Logo"
                        class="d-inline-block align-text-top me-3" loading="lazy">
                    <div class="d-flex flex-column lh-sm">
                        <span class="fw-bold">Penerimaan Peserta Didik Baru</span>
                        <span class="small">MAS Al-Muhajirin Tugumulyo</span>
                    </div>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav d-flex align-items-center me-3 mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex flex-column text-center lh-sm" href="#info-jadwal">
                                <span>Jadwal</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex flex-column text-center lh-sm" href="#alur">
                                <span>Alur</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#syarat">Syarat & Ketentuan</a>
                        </li>
                    </ul>

                    @if (Route::has('login'))
                        <div class="d-flex ms-lg-3">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-outline-success me-2">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-success me-2" id="loginBtn">
                                    Masuk
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-success px-4 font-weight-bold"
                                        style=" color: white;">
                                        Daftar
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero-section py-5 d-flex align-items-center" id="heroSection">
            <div class="container hero-container p-4 p-md-5 justify-content-center d-flex">
                <div class="row align-items-center w-100 gx-4">
                    <div class="col-lg-8 p-5 me-5">
                        <h2 class="text-warning"><strong>Penerimaan Peserta Didik Baru</strong></h2>
                        <h1 class="display-5 fw-bold mb-3 text-white">Selamat Datang Calon Siswa Baru</h1>
                        <h5 class="mt-5 mb-4" style="color: white; font-weight: bold;">MAS Al-Muhajirin Tugumulyo
                            memiliki
                            visi membentuk insan yang berakhlak mulia, disiplin, dan berprestasi untuk masa depan yang
                            cerah
                        </h5>
                        <a href="#" class="btn btn-lg text-white" style="background-color: #eda73d;">
                            <strong>Daftar Sekarang</strong></a>
                    </div>
                    @if ($jurusans->isNotEmpty())
                        <div class="col-lg-3 p-5 blur text-center">
                            <h2 class="text-warning"><strong>Program Studi</strong></h2>
                            @foreach ($jurusans as $jurusan)
                                <h5 class="mt-3 card mb-4 p-2 border-left-primary shadow-sm"
                                    style=" font-weight: bold; ">{{ $jurusan->nama_jurusan }}
                            @endforeach
                        @else
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <section class="py-5 mt-5" id="info-jadwal">
            <div class="container">
                <h2 class="text-center mb-5 text-uppercase" style="color:#198754; font-weight: 900;">Info Jadwal
                    Pendaftaran</h2>
                @if ($jadwals->isNotEmpty())
                    <div class="table-responsive-stack">
                        <table class="table table-hover ">
                            <thead class="text-center table-success">
                                <tr>
                                    <th class="p-3">Tahun Ajaran</th>
                                    <th class="p-3">Gelombang</th>
                                    <th class="p-3">Tanggal Pendaftaran</th>
                                    <th class="p-3">Tanggal Pengumuman</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwals as $jadwal)
                                    @php
                                        $tglMulai = $jadwal->tgl_mulai->isoFormat('D MMMM');

                                        // 2. Format Tanggal Berakhir (D MMMM YYYY)
                                        $tglBerakhir = $jadwal->tgl_berakhir->isoFormat('D MMMM YYYY');

                                        // 3. Format Tanggal Pengumuman (D MMMM YYYY), pastikan tidak null
                                        $tglPengumuman = $jadwal->tgl_pengumuman
                                            ? $jadwal->tgl_pengumuman->isoFormat('D MMMM YYYY')
                                            : '-';
                                    @endphp


                                    <tr class="text-center">
                                        <td data-label="Tahun Ajaran">{{ $jadwal->thn_ajaran }}</td>
                                        <td data-label="Gelombang">{{ $jadwal->gelombang_pendaftaran }}</td>
                                        <td data-label="Tanggal Pendaftaran">{{ $tglMulai }} - {{ $tglBerakhir }}
                                        </td>
                                        <td data-label="Tanggal Pengumuman">{{ $tglPengumuman }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info text-center" role="alert">
                        <p class="mb-0">Jadwal pendaftaran peserta didik baru belum dimulai atau belum diumumkan.</p>
                    </div>
                @endif


                {{-- <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <h4 class="card-title fw-bold mb-4">ALUR PENDAFTARAN</h4>
                                <ul class="list-unstyled">
                                    <li class="d-flex align-items-start mb-3">
                                        <span class="badge bg-primary rounded-circle me-3 mt-1">1</span>
                                        <div>
                                            <p class="mb-0 fw-bold">Lorem ipsum</p>
                                            <small class="text-muted">Lorem ipsum dolor sit amet consectetur.</small>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-start mb-3">
                                        <span class="badge bg-primary rounded-circle me-3 mt-1">2</span>
                                        <div>
                                            <p class="mb-0 fw-bold">Lorem ipsum</p>
                                            <small class="text-muted">Elementum nisl duis tortor sed.</small>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-start mb-3">
                                        <span class="badge bg-primary rounded-circle me-3 mt-1">3</span>
                                        <div>
                                            <p class="mb-0 fw-bold">Lorem ipsum</p>
                                            <small class="text-muted">Lorem ipsum dolor sit amet consectetur.</small>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <h4 class="card-title fw-bold mb-4">SYARAT PENDAFTARAN</h4>
                                <ul class="list-unstyled">
                                    <li class="d-flex align-items-start mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-3 mt-1"></i>
                                        Lorem ipsum dolor sit amet, consectetur.
                                    </li>
                                    <li class="d-flex align-items-start mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-3 mt-1"></i>
                                        Lorem ipsum dolor sit amet consectetur. Elementum nisl duis tortor sed.
                                    </li>
                                    <li class="d-flex align-items-start mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-3 mt-1"></i>
                                        Elementum nisl duis tortor sed, lorem ipsum dolor sit amet consectetur.
                                    </li>
                                    <li class="d-flex align-items-start mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-3 mt-1"></i>
                                        Lorem ipsum dolor sit amet consectetur. Elementum nisl duis tortor sed.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </section>

        {{-- alur pendaftaran secation --}}
        <section class=" py-5" id="alur">
            <div class="container">
                <h2 class="text-center mb-5 text-uppercase" style="color:#198754; font-weight: 900;">ALUR PENDAFTARAN
                </h2>
                <div class="row justify-content-center text-center g-4">
                    <div class="col-lg col-md-6 col-12 mb-4">
                        <div class="card shadow-sm h-100 border-0" style="background-color:#c4e0d3">
                            <div class="d-flex flex-column align-items-center m-3">
                                <div class="rounded-circle d-flex justify-content-center align-items-center text-white fw-bold fs-4"
                                    style="width: 60px; height: 60px; background-color: #4b6cb7;">
                                    1
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="card-title fw-bold mb-3">Masuk ke Website</h5>
                                <p class="card-text text-center">
                                    Kunjungi situs resmi PPDB MAS Al-Muhajirin Tugumulyo di
                                    <span><a class="text-decoration-none text-reset"
                                            href="https://ma-muhajirintgm.sch.id/">https://ma-muhajirintgm.sch.id/</a></span>
                                    untuk memulai proses pendaftaran.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg col-md-6 col-12 mb-4">
                        <div class="card shadow-sm h-100 border-0" style="background-color:#c4e0d3">
                            <div class="d-flex flex-column align-items-center m-3">
                                <div class="rounded-circle d-flex justify-content-center align-items-center text-white fw-bold fs-4"
                                    style="width: 60px; height: 60px; background-color: #007bff;">
                                    2
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="card-title fw-bold mb-3">Daftar</h5>
                                <p class="card-text text-center">
                                    Buat akun dengan mengisi e-mail dan password pada halaman pendaftaran.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg col-md-6 col-12 mb-4">
                        <div class="card shadow-sm h-100 border-0" style="background-color:#c4e0d3">
                            <div class="d-flex flex-column align-items-center m-3">
                                <div class="rounded-circle d-flex justify-content-center align-items-center text-white fw-bold fs-4"
                                    style="width: 60px; height: 60px; background-color: #198754;">
                                    3
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="card-title fw-bold mb-3">Login</h5>
                                <p class="card-text text-center">
                                    Masuk ke sistem PPDB menggunakan e-mail dan password yang telah dibuat sebelumnya.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg col-md-6 col-12 mb-4">
                        <div class="card shadow-sm h-100 border-0" style="background-color:#c4e0d3">
                            <div class="d-flex flex-column align-items-center m-3">
                                <div class="rounded-circle d-flex justify-content-center align-items-center text-white fw-bold fs-4"
                                    style="width: 60px; height: 60px; background-color: #f2d831;">
                                    4
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="card-title fw-bold mb-3">Isi Formulir</h5>
                                <p class="card-text text-center">
                                    Lengkapi data pribadi calon peserta didik, data orang tua atau wali dan dokumen
                                    wajib dengan benar dan lengkap.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg col-md-6 col-12 mb-4">
                        <div class="card shadow-sm h-100 border-0" style="background-color:#c4e0d3">
                            <div class="d-flex flex-column align-items-center m-3">
                                <div class="rounded-circle d-flex justify-content-center align-items-center text-white fw-bold fs-4"
                                    style="width: 60px; height: 60px; background-color: #eda73d;">
                                    5
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="card-title fw-bold mb-3">Mengikuti Tes Seleksi</h5>
                                <p class="card-text text-center">
                                    Ikuti tes seleksi sesuai jadwal yang telah ditentukan oleh pihak sekolah.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg col-md-6 col-12 mb-4">
                        <div class="card shadow-sm h-100 border-0" style="background-color:#c4e0d3">
                            <div class="d-flex flex-column align-items-center m-3">
                                <div class="rounded-circle d-flex justify-content-center align-items-center text-white fw-bold fs-4"
                                    style="width: 60px; height: 60px; background-color: #EF4444;">
                                    6
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="card-title fw-bold mb-3">Pengumuman</h5>
                                <p class="card-text text-center">
                                    Lihat hasil seleksi penerimaan pada akun PPDB melalui situs
                                    <span><a class="text-decoration-none text-reset"
                                            href="https://ma-muhajirintgm.sch.id/">https://ma-muhajirintgm.sch.id/</a></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Ketentuan pendaftaran --}}
        <section class="py-5" id="syarat">
            <div class="container">
                <div class="row g-4 equal-height">
                    <div class="col-lg-6 col-md-12">
                        <div class="p-3 border rounded-3 shadow-sm">
                            <h2 class="text-center mb-5 text-uppercase" style="color:#198754; font-weight: 900;">
                                SYARAT PENDAFTARAN</h2>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3 d-flex">
                                    <span class="text-danger me-3 flex-shrink-0">&#9679;</span>
                                    <span>Mengisi Formulir Pendaftaran Pada Website PPDB MAS Al-Muhajirin</span>
                                </li>
                                <li class="mb-3 d-flex">
                                    <span class="text-danger me-3 flex-shrink-0">&#9679;</span>
                                    <span>Mengunggah dokumen-dokumen pendukung yang terdiri dari
                                        dokumen wajib (scan Kartu Keluarga dan scan Ijazah/SKL) Piagam Penghargaan jika
                                        ada.</span>
                                </li>
                                <li class="mb-3 d-flex">
                                    <span class="text-danger me-3 flex-shrink-0">&#9679;</span>
                                    <span>Mengikuti Proses Tes Seleksi.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="p-3 border rounded-3 shadow-sm">
                            <h2 class="text-center mb-5 text-uppercase" style="color:#198754; font-weight: 900;">
                                Reward khusus untuk peserta berprestasi</h2>
                            <ul style="list-style-type: disc; padding-left: 20px;">
                                @forelse ($kategoriPrestasi as $prestasi)
                                    <li class="mb-3 d-flex">
                                        <span class="text-danger me-3 flex-shrink-0">&#9679;</span>
                                        <span><strong>{{ $prestasi->nama_prestasi }}:</strong>
                                            {{ $prestasi->deskripsi }}</span>
                                    </li>
                                @empty
                                    <li class="mb-3 text-center text-muted">Belum ada jalur prestasi yang aktif saat
                                        ini.</li>
                                @endforelse


                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        {{-- <section class="py-5">
            <div class="container">
                <h3 class="text-center mb-5 fw-bold text-uppercase">PROFIL SEKOLAH</h3>
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="bg-secondary d-flex justify-content-center align-items-center text-white"
                            style="height: 300px;">
                            <h5 class="m-0">Photo</h5>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <h4 class="fw-bold mb-4">Madrasah Aliyah Swasta Al-Muhajirin</h4>

                        <div class="d-flex align-items-start mb-3">
                            <i class="bi bi-bookmark-fill me-3 mt-1 text-primary fs-5"></i>
                            <div>
                                <p class="mb-0 fw-bold">AKREDITASI A</p>
                                <small>Kementerian Agama</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="bi bi-book-fill me-3 mt-1 text-primary fs-5"></i>
                            <div>
                                <p class="mb-0 fw-bold">Program Studi</p>
                                <small>IPA, IPS, Keagamaan</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="bi bi-building-fill me-3 mt-1 text-primary fs-5"></i>
                            <div>
                                <p class="mb-0 fw-bold">Fasilitas</p>
                                <small>Deskripsi: Kampus A & B, Gedung Kampus B, Lab. Komputer, Internet gratis 100Mbps,
                                    Panjat Dinding, Perpustakaan, Ruang UKS, Musholla, Kantin</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="bi bi-geo-alt-fill me-3 mt-1 text-primary fs-5"></i>
                            <div>
                                <p class="mb-0 fw-bold">Lokasi</p>
                                <small>Jl. Jend. Sudirman F No.Desa, TriKoyo, Kec. Tugumulyo, Kabupaten Musi Rawas,
                                    Sumatera</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        <section class="py-5 mb-5 bg-light">
            <div class="container position-relative">
                <h2 class="text-center mb-5 text-uppercase" style="color:#198754; font-weight: 900;">GALERI</h2>

                <div id="galeriCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                    <div class="carousel-inner">

                        {{-- Slide 1 --}}
                        <div class="carousel-item active ">
                            <div class="d-md-none">
                                <div class="col-12">
                                    <img src="{{ asset('images/edit1.JPG') }}" class="d-block w-100 rounded shadow"
                                        alt="Foto 1" loading="lazy">
                                </div>
                            </div>

                            <div class="d-none d-md-flex row justify-content-center g-3">
                                <div class="col-md-4">
                                    <img src="{{ asset('images/edit1.JPG') }}" class="d-block w-100 rounded shadow"
                                        alt="Foto 1" loading="lazy">
                                </div>
                                <div class="col-md-4">
                                    <img src="{{ asset('images/edit2.jpeg') }}" class="d-block w-100 rounded shadow"
                                        alt="Foto 2" loading="lazy">
                                </div>
                                <div class="col-md-4">
                                    <img src="{{ asset('images/edit6.JPG') }}" class="d-block w-100 rounded shadow"
                                        alt="Foto 6" loading="lazy">
                                </div>
                            </div>
                        </div>

                        {{-- Slide 2 --}}
                        <div class="carousel-item">
                            <div class="d-md-none">
                                <div class="col-12">
                                    <img src="{{ asset('images/edit4.JPG') }}" class="d-block w-100 rounded shadow"
                                        alt="Foto 4" loading="lazy">
                                </div>
                            </div>
                            <div class="d-none d-md-flex row justify-content-center g-3">
                                <div class="col-md-4">
                                    <img src="{{ asset('images/edit4.JPG') }}" class="d-block w-100 rounded shadow"
                                        alt="Foto 4" loading="lazy">
                                </div>
                                <div class="col-md-4">
                                    <img src="{{ asset('images/edit5.JPG') }}" class="d-block w-100 rounded shadow"
                                        alt="Foto 5" loading="lazy">
                                </div>
                                <div class="col-md-4">
                                    <img src="{{ asset('images/edit3.jpeg') }}" class="d-block w-100 rounded shadow"
                                        alt="Foto 3" loading="lazy">
                                </div>
                            </div>
                        </div>

                        {{-- Slide 3 --}}
                        <div class="carousel-item">
                            <div class="d-md-none">
                                <div class="col-12">
                                    <img src="{{ asset('images/bg-base.PNG') }}" class="d-block w-100 rounded shadow"
                                        alt="Foto 4" loading="lazy">
                                </div>
                            </div>
                            <div class="d-none d-md-flex row justify-content-center g-3">
                                <div class="col-md-4">
                                    <img src="{{ asset('images/bg-base.PNG') }}" class="d-block w-100 rounded shadow"
                                        alt="Foto 4" loading="lazy">
                                </div>
                                <div class="col-md-4">
                                    <img src="{{ asset('images/edit7.png') }}" class="d-block w-100 rounded shadow"
                                        alt="Foto 5" loading="lazy">
                                </div>
                                <div class="col-md-4">
                                    <img src="{{ asset('images/edit8.png') }}" class="d-block w-100 rounded shadow"
                                        alt="Foto 6" loading="lazy">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="carousel-control-prev custom-arrow" type="button"
                        data-bs-target="#galeriCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Sebelumnya</span>
                    </button>
                    <button class="carousel-control-next custom-arrow" type="button"
                        data-bs-target="#galeriCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Berikutnya</span>
                    </button>
                </div>
            </div>
        </section>

        <style>
            #galeriCarousel img {
                height: 250px;
                object-fit: cover;
            }

            .custom-arrow {
                width: 5%;
                top: 50%;
                transform: translateY(-50%);
            }

            .carousel-control-prev.custom-arrow {
                left: -60px;
            }

            .carousel-control-next.custom-arrow {
                right: -60px;
            }

            .carousel-control-prev-icon {
                background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 16 16'%3E%3Cpath d='M11 1 3 8l8 7' stroke='%23000' stroke-width='3' fill='none'/%3E%3C/svg%3E");
                background-size: 70% 70%;
                width: 2.5rem;
                height: 2.5rem;
                filter: drop-shadow(0 0 5px rgba(0, 0, 0, 0.5));
                color: #007bff;
            }

            .carousel-control-next-icon {
                background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 16 16'%3E%3Cpath d='M5 1l8 7-8 7' stroke='%23000' stroke-width='3' fill='none'/%3E%3C/svg%3E");
                background-size: 70% 70%;
                width: 2.5rem;
                height: 2.5rem;
                filter: drop-shadow(0 0 5px rgba(0, 0, 0, 0.5));
            }


            .custom-arrow:hover .carousel-control-prev-icon,
            .custom-arrow:hover .carousel-control-next-icon {
                transform: scale(1.1);
                transition: transform 0.2s ease;
            }

            @media (max-width: 768px) {
                .carousel-control-prev.custom-arrow {
                    left: 0;
                    background: linear-gradient(to right, rgba(255, 255, 255, 0.5), transparent);
                }

                .carousel-control-next.custom-arrow {
                    right: 0px;
                    background: linear-gradient(to left, rgba(255, 255, 255, 0.5), transparent);
                }

                .custom-arrow {
                    width: 15%;
                }
            }

            @media (min-width: 769px) {
                .carousel-control-prev.custom-arrow {
                    left: -60px;
                    background: none;
                }

                .carousel-control-next.custom-arrow {
                    right: -60px;
                    background: none;
                }


            }
        </style>


    </main>

    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container">
            <div class="row align-items-start">
                <!-- Alamat -->
                <div class="col-lg-3 mb-4 mb-lg-0">
                    <h5 class="fw-bold">Alamat</h5>
                    <small>
                        Jl. Jend. Sudirman Trikoyo Tugumulyo<br>
                        Kab. Musi Rawas, Sumatera Selatan
                    </small>
                    <div class="list-unstyled mt-3">
                        <h6 class="fw-bold mb-1">Website</h6>
                        <li><i class="fa-solid fa-globe me-2"></i> <a href="https://ma-muhajirintgm.sch.id"
                                class="text-white text-decoration-none small" target="_blank">
                                ma-muhajirintgm.sch.id
                            </a></li>

                    </div>
                    <div class="list-unstyled mt-3">
                        <h6 class="fw-bold mb-1">Email</h6>
                        <li><i class="fas fa-envelope me-2"></i><a href="mailto:ma.almuhajirintgm@gmail.com"
                                class="text-white text-decoration-none small">
                                ma.almuhajirintgm@gmail.com
                            </a></li>
                    </div>
                    <div class="list-unstyled mt-2">
                        <h6 class="fw-bold mb-1">Telepon</h6>
                        <li><i class="fas fa-phone me-2"></i> <small>(0733) 37740</small></li>

                    </div>
                </div>

                <div class="col-lg-3 mb-4 mb-lg-0">
                    <h5 class="fw-bold">Contact Person (WhatsApp)</span></h5>
                    <ul class="list-unstyled small mb-0">
                        <li><i class="fab fa-whatsapp me-2"></i>0815 4651 7917</li>
                        <li><i class="fab fa-whatsapp me-2"></i>0822 1078 5255</li>
                        <li><i class="fab fa-whatsapp me-2"></i>0852 6702 7514</li>
                        <li><i class="fab fa-whatsapp me-2"></i>0821 8613 0502</li>
                    </ul>
                </div>


                <!-- Peta Lokasi -->
                <div class="col-lg-6">
                    <h5 class="fw-bold">Peta Lokasi</h5>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.639397621482!2d102.94456687575936!3d-3.1891394967861255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e30fbe767efac19%3A0xf14f17f1b308aa18!2sMAS%20Al-Muhajirin%20Tugumulyo!5e0!3m2!1sid!2sid!4v1760964333475!5m2!1sid!2sid"
                        width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <hr class="border-light mt-4">
            <div class="text-center small">
                &copy; 2025 MA Al-Muhajirin Tugumulyo.
            </div>
        </div>
    </footer>


</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.getElementById('mainHeader');
        const loginBtn = document.getElementById('loginBtn');
        const scrollTrigger = 100;

        function changeHeaderClass() {
            if (window.scrollY > scrollTrigger) {
                header.classList.add('scrolled', 'frosted-header', 'shadow');
            } else {
                header.classList.remove('scrolled', 'frosted-header', 'shadow');
            }
        }

        changeHeaderClass();

        window.addEventListener('scroll', changeHeaderClass);
    });
</script>

</html>
