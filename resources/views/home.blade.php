@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
    <p>Student Registration Management System</p>
@stop

@section('content')
{{-- <div class="row">
    <!-- Data Calon Siswa -->
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header bg-primary">
                <h3 class="card-title">Data Calon Siswa</h3>
            </div>
            <div class="card-body">
                <p><strong>Nama Lengkap:</strong> Ahmad Rizki Pratama</p>
                <p><strong>NISN:</strong> 1234567890</p>
                <p><strong>Jenis Kelamin:</strong> Laki-laki</p>
                <p><strong>Tempat Lahir:</strong> Jakarta</p>
                <p><strong>Tanggal Lahir:</strong> 15 Mei 2008</p>
                <p><strong>Alamat:</strong> Jl. Merdeka No.123, Jakarta Pusat</p>

                <hr>
                <h5>Kontak & Dokumen</h5>
                <p><strong>No. Handphone:</strong> 081234567890</p>
                <p><strong>Kategori Prestasi:</strong> Akademik</p>
                <p><strong>Scan Kartu Keluarga:</strong> Uploaded</p>
                <p><strong>Scan Ijazah:</strong> Uploaded</p>
            </div>
        </div>
    </div>

    <!-- Data Orang Tua -->
    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header bg-success">
                <h3 class="card-title">Data Orang Tua</h3>
            </div>
            <div class="card-body">
                <p><strong>Nama Ayah:</strong> Budi Pratama</p>
                <p><strong>Nama Ibu:</strong> Siti Nurhaliza</p>
                <p><strong>Alamat:</strong> Jl. Merdeka No.123, Jakarta Pusat</p>
                <p><strong>No. Handphone:</strong> 081234567891</p>

                <div class="mt-3">
                    <a href="#" class="btn btn-success">
                        <i class="fas fa-edit"></i> Edit Data
                    </a>
                    <a href="#" class="btn btn-outline-secondary">
                        <i class="fas fa-print"></i> Print Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistik -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>1,234</h3>
                <p>Total Siswa</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-graduate"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>89</h3>
                <p>Pendaftar Baru</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
</div> --}}


{{-- tabel contoh --}}
{{-- <div class="container-fluid px-4">
    <div class="card ">
       
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-dark fw-semibold  ">No.</th>
                            <th scope="col" class="px-4 py-3 text-dark fw-semibold  ">Tahun Ajaran</th>
                            <th scope="col" class="px-4 py-3 text-dark fw-semibold  ">Gelombang</th>
                            <th scope="col" class="px-4 py-3 text-dark fw-semibold  ">Total Pendaftar</th>
                            <th scope="col" class="px-4 py-3 text-dark fw-semibold  ">Tanggal Mulai</th>
                            <th scope="col" class="px-4 py-3 text-dark fw-semibold  ">Tanggal Berakhir</th>
                            <th scope="col" class="px-4 py-3 text-dark fw-semibold  ">Status</th>
                            <th scope="col" class="px-4 py-3 text-dark fw-semibold  ">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-bottom">
                            <td class="px-4 py-2 text-muted">1.</td>
                            <td class="px-4 py-2 fw-medium">2024/2025</td>
                            <td class="px-4 py-2">1</td>
                            <td class="px-4 py-2 fw-semibold">222</td>
                            <td class="px-4 py-2 text-muted">23-04-2024</td>
                            <td class="px-4 py-2 text-muted">23-05-2024</td>
                            <td class="px-4 py-2">
                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-medium">Aktif</span>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <td class="px-4 py-2 text-muted">2.</td>
                            <td class="px-4 py-2 fw-medium">2023/2024</td>
                            <td class="px-4 py-2">2</td>
                            <td class="px-4 py-2 fw-semibold">343</td>
                            <td class="px-4 py-2 text-muted">23-05-2022</td>
                            <td class="px-4 py-2 text-muted">23-06-2022</td>
                            <td class="px-4 py-2">
                                <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill fw-medium">Selesai</span>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <td class="px-4 py-2 text-muted">3.</td>
                            <td class="px-4 py-2 fw-medium">2022/2023</td>
                            <td class="px-4 py-2">1</td>
                            <td class="px-4 py-2 fw-semibold">343</td>
                            <td class="px-4 py-2 text-muted">23-04-2022</td>
                            <td class="px-4 py-2 text-muted">23-05-2022</td>
                            <td class="px-4 py-2">
                                <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill fw-medium">Selesai</span>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <td class="px-4 py-2 text-muted">4.</td>
                            <td class="px-4 py-2 fw-medium">2021/2022</td>
                            <td class="px-4 py-2">2</td>
                            <td class="px-4 py-2 fw-semibold">343</td>
                            <td class="px-4 py-2 text-muted">23-05-2021</td>
                            <td class="px-4 py-2 text-muted">23-06-2021</td>
                            <td class="px-4 py-2">
                                <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill fw-medium">Selesai</span>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 text-muted">5.</td>
                            <td class="px-4 py-2 fw-medium">2021/2022</td>
                            <td class="px-4 py-2">1</td>
                            <td class="px-4 py-2 fw-semibold">222</td>
                            <td class="px-4 py-2 text-muted">23-04-2021</td>
                            <td class="px-4 py-2 text-muted">23-05-2021</td>
                            <td class="px-4 py-2">
                                <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill fw-medium">Selesai</span>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> --}}
{{-- 
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Bukti Pendaftaran</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <!-- Header Card -->
                <div class="card shadow-lg border-0 mb-4">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h2 class="mb-0 font-weight-bold">
                            <i class="fas fa-certificate mr-2"></i>
                            BUKTI PENDAFTARAN
                        </h2>
                        <p class="mb-0 mt-2">Formulir Pendaftaran Siswa Baru</p>
                    </div>
                </div>

                <!-- Main Content Card -->
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">
                        <!-- Registration Info -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="border rounded p-3 bg-light">
                                    <small class="text-muted">No. Pendaftaran</small>
                                    <h5 class="font-weight-bold text-primary mb-0">REG-2024-001</h5>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3 mt-md-0">
                                <div class="border rounded p-3 bg-light">
                                    <small class="text-muted">Status Pendaftaran</small>
                                    <h5 class="mb-0">
                                        <span class="badge badge-success badge-pill px-3 py-2">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            DITERIMA
                                        </span>
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <!-- Student Information -->
                        <div class="border-top pt-4">
                            <h5 class="text-primary mb-4">
                                <i class="fas fa-user mr-2"></i>
                                Informasi Pendaftar
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card border-left-primary">
                                        <div class="card-body py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="text-primary mr-3">
                                                    <i class="fas fa-user-tag fa-lg"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Nama Lengkap</small>
                                                    <strong>Ahmad Rizki Pratama</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="card border-left-info">
                                        <div class="card-body py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="text-info mr-3">
                                                    <i class="fas fa-id-card fa-lg"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">NISN</small>
                                                    <strong>1234567890</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="card border-left-warning">
                                        <div class="card-body py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="text-warning mr-3">
                                                    <i class="fas fa-calendar-alt fa-lg"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Tempat, Tanggal Lahir</small>
                                                    <strong>Jakarta, 15 Mei 2008</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="card border-left-success">
                                        <div class="card-body py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="text-success mr-3">
                                                    <i class="fas fa-phone fa-lg"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">No. HP</small>
                                                    <strong>081234567890</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="card border-left-secondary">
                                        <div class="card-body py-3">
                                            <div class="d-flex align-items-start">
                                                <div class="text-secondary mr-3 mt-1">
                                                    <i class="fas fa-map-marker-alt fa-lg"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Alamat</small>
                                                    <strong>Jl. Merdeka No. 123, RT 05/RW 02, Kelurahan Sumber Jaya, Kecamatan Kemayoran, Jakarta Pusat 10640</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Info -->
                        <div class="border-top pt-4 mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="alert alert-info mb-0">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        <strong>Tanggal Cetak:</strong> <span id="printDate"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3 mt-md-0">
                                    <div class="alert alert-warning mb-0">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>
                                        <strong>Simpan bukti ini dengan baik</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="text-center mt-4 pt-3 border-top">
                            <button class="btn btn-primary btn-lg mr-3 mb-2" onclick="window.print()">
                                <i class="fas fa-print mr-2"></i>
                                Cetak Bukti
                            </button>
                            <button class="btn btn-success btn-lg mb-2" onclick="downloadPDF()">
                                <i class="fas fa-download mr-2"></i>
                                Download PDF
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Verification Badge -->
                <div class="text-center mt-4">
                    <div class="badge badge-primary badge-pill px-4 py-2">
                        <i class="fas fa-shield-alt mr-2"></i>
                        Dokumen Terverifikasi
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Set current date
        document.getElementById('printDate').textContent = new Date().toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        function downloadPDF() {
            alert('Fitur download PDF akan segera tersedia');
        }
    </script>
</body>
</html> --}}

{{-- form container only --}}
{{-- <div class="container-fluid p-4" style="background-color: white;">
    <!-- Header with Letterhead -->
    <div class="row mb-4">
        <div class="col-2">
            <!-- Geometric shapes for letterhead -->
            <div class="d-flex flex-wrap">
                <div style="width: 40px; height: 40px; background: linear-gradient(45deg, #dc3545, #6c757d); margin: 2px;"></div>
                <div style="width: 40px; height: 40px; background-color: #6c757d; margin: 2px;"></div>
                <div style="width: 40px; height: 40px; background-color: #e9ecef; margin: 2px;"></div>
                <div style="width: 40px; height: 40px; background-color: #6c757d; margin: 2px;"></div>
            </div>
        </div>
        <div class="col-8 text-center">
            <h4 class="font-weight-bold mb-1" style="color: #dc3545;">BIMBINGAN BELAJAR</h4>
            <h4 class="font-weight-bold" style="color: #dc3545;">MERAH PUTIH</h4>
        </div>
        <div class="col-2">
            <!-- Logo placeholder -->
            <div class="d-flex justify-content-end">
                <div style="width: 60px; height: 60px; background-color: #dc3545; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <div style="width: 30px; height: 30px; background-color: white; border-radius: 50%;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Title -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="font-weight-bold">FORMULIR PENDAFTARAN</h2>
        </div>
    </div>

    <!-- Form Fields -->
    <div class="row">
        <div class="col-12">
            <!-- Nama Lengkap -->
            <div class="row mb-3">
                <div class="col-3">
                    <span>Nama Lengkap</span>
                </div>
                <div class="col-9">
                    <span class="d-block pb-1" style="border-bottom: 1px solid #000;">{{ $pendaftaran->siswa->nama }}</span>
                </div>
            </div>

            <!-- Tanggal Lahir -->
            <div class="row mb-3">
                <div class="col-3">
                    <span>Tanggal Lahir</span>
                </div>
                <div class="col-9">
                    <span class="d-block pb-1" style="border-bottom: 1px solid #000;">{{ \Carbon\Carbon::parse($pendaftaran->siswa->tanggal_lahir)->format('d F Y') }}</span>
                </div>
            </div>

            <!-- Jenis Kelamin -->
            <div class="row mb-3">
                <div class="col-3">
                    <span>Jenis Kelamin</span>
                </div>
                <div class="col-9">
                    <span class="d-block pb-1" style="border-bottom: 1px solid #000;">{{ $pendaftaran->siswa->jenis_kelamin }}</span>
                </div>
            </div>

            <!-- Kelas -->
            <div class="row mb-3">
                <div class="col-3">
                    <span>Kelas</span>
                </div>
                <div class="col-9">
                    <span class="d-block pb-1" style="border-bottom: 1px solid #000;">{{ $pendaftaran->siswa->kategori_prestasi ?? '-' }}</span>
                </div>
            </div>

            <!-- Alamat -->
            <div class="row mb-3">
                <div class="col-3">
                    <span>Alamat</span>
                </div>
                <div class="col-9">
                    <span class="d-block pb-1" style="border-bottom: 1px solid #000;">{{ $pendaftaran->siswa->alamat_siswa }}</span>
                </div>
            </div>

            <!-- Nama Orang Tua -->
            <div class="row mb-3">
                <div class="col-3">
                    <span>Nama Orang Tua</span>
                </div>
                <div class="col-9">
                    <span class="d-block pb-1" style="border-bottom: 1px solid #000;">{{ $pendaftaran->siswa->orangTua->nama_ayah }} / {{ $pendaftaran->siswa->orangTua->nama_ibu }}</span>
                </div>
            </div>

            <!-- Pekerjaan Orang Tua -->
            <div class="row mb-3">
                <div class="col-3">
                    <span>Pekerjaan Orang Tua</span>
                </div>
                <div class="col-9">
                    <span class="d-block pb-1" style="border-bottom: 1px solid #000;">-</span>
                </div>
            </div>

            <!-- No. Telepon Orang Tua -->
            <div class="row mb-3">
                <div class="col-3">
                    <span>No. Telepon Orang Tua</span>
                </div>
                <div class="col-9">
                    <span class="d-block pb-1" style="border-bottom: 1px solid #000;">{{ $pendaftaran->siswa->orangTua->no_hp_ortu }}</span>
                </div>
            </div>

            <!-- Program Kursus -->
            <div class="row mb-4">
                <div class="col-3">
                    <span>Program Kursus</span>
                </div>
                <div class="col-9">
                    <span class="d-block pb-1" style="border-bottom: 1px solid #000;">-</span>
                </div>
            </div>

            <!-- Hari Kursus -->
            <div class="row mb-3">
                <div class="col-3">
                    <span>Hari Kursus</span>
                </div>
                <div class="col-9">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="senin-kamis">
                        <label class="form-check-label" for="senin-kamis">Senin & Kamis</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="selasa-jumat">
                        <label class="form-check-label" for="selasa-jumat">Selasa & Jumat</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="rabu-sabtu">
                        <label class="form-check-label" for="rabu-sabtu">Rabu & Sabtu</label>
                    </div>
                </div>
            </div>

            <!-- Waktu Kursus -->
            <div class="row mb-4">
                <div class="col-3">
                    <span>Waktu Kursus</span>
                </div>
                <div class="col-9">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="waktu1">
                        <label class="form-check-label" for="waktu1">14.00 - 15.30</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="waktu2">
                        <label class="form-check-label" for="waktu2">16.00 - 17.30</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="waktu3">
                        <label class="form-check-label" for="waktu3">19.00 - 20.30</label>
                    </div>
                </div>
            </div>

            <!-- Mengetahui -->
            <div class="row mb-5">
                <div class="col-12">
                    <p>Mengetahui,</p>
                </div>
            </div>

            <!-- Signature Section -->
            <div class="row mb-5">
                <div class="col-6">
                    <div class="text-left">
                        <p class="mb-1">Orang Tua/Wali:</p>
                        <div style="height: 60px;"></div>
                        <div style="border-bottom: 1px solid #000; width: 200px; display: inline-block;"></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-right">
                        <p class="mb-1">Calon Siswa:</p>
                        <div style="height: 60px;"></div>
                        <div style="border-bottom: 1px solid #000; width: 200px; display: inline-block;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer with Contact Info -->
    <div class="row mt-5 pt-3" style="border-top: 1px solid #ddd;">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <span class="text-danger mr-2">📍</span>
                    <small>Jl. Duta Daun 117, Banjar, Jawa Barat 47433</small>
                </div>
                <div class="d-flex align-items-center">
                    <span class="text-danger mr-2">📞</span>
                    <small>0123456789</small>
                </div>
                <div class="d-flex align-items-center">
                    <span class="text-danger mr-2">✉️</span>
                    <small>halo@situsupercanggih.co.id</small>
                </div>
            </div>
            <!-- Decorative elements in footer -->
            <div class="d-flex justify-content-end mt-2">
                <div style="width: 30px; height: 30px; background-color: #dc3545; margin: 2px;"></div>
                <div style="width: 30px; height: 30px; background-color: #6c757d; margin: 2px;"></div>
                <div style="width: 30px; height: 30px; background-color: #e9ecef; margin: 2px;"></div>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto print when page loads
    window.onload = function() {
        window.print();
    };
</script> --}}

{{-- table style --}}


@stop
