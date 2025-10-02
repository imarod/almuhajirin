<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PPDB | Al Muhajirin</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{-- @vite('resources/css/app.css') --}}
</head>

<body>
    <header class="shadow-sm">
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('images/tutwuri.png') }}" style="width: 50px; height: 50px;" alt="Logo"
                        class="d-inline-block align-text-top me-3">
                    <div class="d-flex flex-column lh-sm">
                        <span class="fw-bold">Penerimaan Peserta Didik Baru</span>
                        <span class="text-muted small">MAS Al Muhajirin</span>
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
                            <a class="nav-link d-flex flex-column text-center lh-sm" href="#">
                                <span>Info Pendaftaran</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex flex-column text-center lh-sm" href="#">
                                <span>Profil Sekolah</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kontak</a>
                        </li>
                    </ul>

                    @if (Route::has('login'))
                        <div class="d-flex ms-lg-3">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary me-2">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-secondary me-2">
                                    Masuk
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary">
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
        <section class="py-5 py-lg-0 bg-light d-flex align-items-center" style="min-height: 100vh;">
            <div class="container">
                <div class="row align-items-center w-100">
                    <div class="col-lg-7 py-5 py-lg-0">
                        <h1 class="display-5 fw-bold mb-3">Selamat Datang di Website PPDB</h1>
                        <h2 class="h3 mb-4">MAS Al Muhajirin</h2>
                        <a href="#" class="btn btn-primary btn-lg">Daftar Sekarang</a>
                    </div>
                    <div class="col-lg-5">
                        <div class="bg-secondary text-white d-flex justify-content-center align-items-center"
                            style="height: 350px;">
                            <h4 class="m-0">Banner</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5">
            <div class="container">
                <h3 class="text-center mb-5 fw-bold text-uppercase">Info Pendaftaran Gelombang 1 Tahun Ajaran 2025/2026
                </h3>

                <div class="row">
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
                </div>
            </div>
        </section>

        <section class="py-5 bg-light">
            <div class="container">
                <h4 class="fw-bold mb-4">REWARD PENDAFTARAN</h4>
                <div class="row">
                    <div class="col-md-6 col-lg-4 mb-3">
                        <p class="d-flex align-items-start"><i
                                class="bi bi-check-circle-fill text-primary me-3 mt-1"></i> Hafidz Quran 4-5 Juz Gratis
                            Biaya Pendidikan</p>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <p class="d-flex align-items-start"><i
                                class="bi bi-check-circle-fill text-primary me-3 mt-1"></i> Hafidz Quran 1-3 Juz Gratis
                            Buku Pembelajaran</p>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <p class="d-flex align-items-start"><i
                                class="bi bi-check-circle-fill text-primary me-3 mt-1"></i> Peringkat 1-5 Gratis Biaya
                            Pendidikan dan Pakaian Olahraga</p>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <p class="d-flex align-items-start"><i
                                class="bi bi-check-circle-fill text-primary me-3 mt-1"></i> Prestasi Non Akademik
                            Tingkat Kabupaten: Gratis Biaya Pendidikan & Pakaian Olahraga</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5">
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
        </section>

        <section class="py-5 bg-light">
            <div class="container">
                <h3 class="text-center mb-5 fw-bold text-uppercase">GALERI</h3>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="bg-secondary" style="height: 200px;"></div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="bg-secondary" style="height: 200px;"></div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="bg-secondary" style="height: 200px;"></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 mb-3 mb-lg-0">
                    <h5 class="fw-bold">MAS AL-MUHAJIRIN</h5>
                    <small>Social media</small>
                    <div class="d-flex mt-2">
                    </div>
                </div>
                <div class="col-lg-3 mb-3 mb-lg-0">
                    <h6 class="fw-bold">Kontak</h6>
                    <ul class="list-unstyled small">
                        <li><i class="bi bi-telephone me-2"></i> (0713) 324-100</li>
                        <li><i class="bi bi-whatsapp me-2"></i> 0852-3241-100</li>
                        <li><i class="bi bi-envelope me-2"></i> pendaftaransiswa@gmail.com</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <h6 class="fw-bold">Peta Lokasi</h6>
                    <div class="bg-secondary" style="height: 100px;">
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
