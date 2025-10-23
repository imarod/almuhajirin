<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Data Pendaftar</title>
    <style>
        /* Font yang kompatibel dengan dompdf */
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding-top: 20px;
            padding-bottom: 20px;
            padding-left: 0px;
            padding-right: 0px;
            color: #333;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .school-name {
            font-size: 16px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 5px;
            text-align: center;
        }

        .report-title {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }

        .academic-year {
            font-size: 12px;
            color: #64748b;
        }

        .info-section {
            padding: 8px;
            margin: 10px 0;
        }

        .info-row {
            display: table;
            width: 100%;
            margin: 3px 0;
        }

        .info-label {
            display: table-cell;
            width: 120px;
            font-weight: bold;
            font-size: 12px;
            padding-right: 10px;
        }

        .info-value {
            display: table-cell;
            font-size: 12px;
        }

        .stats-container {
            margin-bottom: 25px;
        }

        .stats-grid {
            display: table;
            width: 100%;
            border-collapse: separate;
            border-spacing: 10px 0;
        }

        .stat-card {
            display: table-cell;
            background-color: #f1f5f9;
            border: 1px solid #cbd5e1;
            padding: 12px;
            text-align: center;
            width: 25%;
        }

        .stat-number {
            font-size: 18px;
            font-weight: bold;
            color: #1e293b;
            display: block;
            margin-bottom: 4px;
        }

        .table-section {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .section-subtitle {
            font-size: 9px;
            color: #64748b;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 8px;
        }

        th {
            text-align: center !important;
            padding: 4px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
            border: 1px solid #d1d5db;
        }

        td {
            padding: 4px;
            border: 1px solid #d1d5db;
            text-align: center;
            font-size: 10px;
        }

        tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
            font-size: 8px;
            color: #64748b;
        }

        .footer-content {
            display: table;
            width: 100%;
        }

        .footer-left {
            display: table-cell;
            text-align: left;
        }

        .footer-right {
            display: table-cell;
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
         @php
                $type = pathinfo(public_path('images/kopsurat.png'), PATHINFO_EXTENSION);
                $data = file_get_contents(public_path('images/kopsurat.png'));
                $base64_image = 'data:image/' . $type . ';base64,' . base64_encode($data);
            @endphp

            <img src="{{ $base64_image }}" alt="Kop Surat" style="width: 100%; height: auto;">
    </div>

    <div class="report-title">Laporan Data Pendaftar Peserta Didik Baru</div>

    <div class="info-section">
        <div class="info-row">
            <div class="info-label">Total Pendaftar</div>
            <div class="info-value">: {{ $totalPendaftar }} Siswa</div>
        </div>
        <div class="info-row">
            <div class="info-label">Tanggal Cetak</div>
            <div class="info-value">: {{ $tanggalCetak }}</div>
        </div>
    </div>

    {{-- 
    <div class="stats-container">
        <div class="stats-grid">
            <div class="stat-card accepted">
                <span class="stat-number">89</span>
                <span class="stat-label">DITERIMA</span>
            </div>
            <div class="stat-card pending">
                <span class="stat-number">34</span>
                <span class="stat-label">PENDING</span>
            </div>
            <div class="stat-card rejected">
                <span class="stat-number">21</span>
                <span class="stat-label">DITOLAK</span>
            </div>
            <div class="stat-card unprocessed">
                <span class="stat-number">12</span>
                <span class="stat-label">BELUM DIPROSES</span>
            </div>
        </div>
    </div> --}}

    <div class="table-section">
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">NO.</th>
                    <th style="width: 15%;">NAMA LENGKAP</th>
                    <th style="width: 12%;">NISN</th>
                    <th style="width: 8%;">L/P</th>
                    <th style="width: 15%;">NO. HP</th>
                    <th style="width: 28%;">ALAMAT</th>

                    <th style="width: 15%;">GELOMBANG</th>
                    <th style="width: 17%;">STATUS</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($pendaftars as $pendaftaran)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pendaftaran->siswa->nama }}</td>
                        <td>{{ $pendaftaran->siswa->nisn }}</td>
                        <td>{{ $pendaftaran->siswa->jenis_kelamin }}</td>
                        <td>{{ $pendaftaran->siswa->no_hp_siswa }}</td>
                        <td>{{ $pendaftaran->siswa->alamat_siswa }}</td>

                        <td>{{ $pendaftaran->jadwal->gelombang_pendaftaran }} ({{ $pendaftaran->jadwal->thn_ajaran }})
                        </td>
                        @php
                            $statusPendaftar = $pendaftaran->status_aktual;
                            if (is_null($statusPendaftar)) {
                                if ($pendaftaran->status_verifikasi === 'Perbaikan') {
                                    $statusPendaftar = 'Perbaikan';
                                } else {
                                    $statusPendaftar = 'Belum diproses';
                                }
                            }
                        @endphp
                        <td>{{ $statusPendaftar }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <div class="footer">
        <div class="footer-content">
            <div class="footer-left">
                <strong>Dicetak oleh:</strong> Admin Sekolah<br>
                MAS AL MUHAJIRIN TUGUMULYO
            </div>
            <div class="footer-right">
                © 2025 Sistem Informasi Sekolah
            </div>
        </div>
    </div>
</body>

</html>
