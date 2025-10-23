<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Data Pendaftar</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 13px;
            margin: 0;
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
        }

        .report-title {
            font-size: 20px;
            font-weight: bold;
            margin: 10px 0;
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
            font-size: 11px;
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

    <h2>Data Seluruh Jadwal PPDB</h2>


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
                    <th style="width: 15%;">TAHUN AJARAN</th>
                    <th style="width: 10%;">GELOMBANG</th>
                    <th style="width: 8%;">KUOTA</th>
                    <th style="width: 20%;">TANGGAL MULAI</th>
                    <th style="width: 20%;">TANGGAL BERAKHIR</th>
                    <th style="width: 20%;">TANGGAL PENGUMUMAN</th>
                    <th style="width: 10%;">STATUS</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($jadwals as $jadwal)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jadwal->thn_ajaran }}</td>
                        <td>{{ $jadwal->gelombang_pendaftaran }}</td>
                        <td>{{ $jadwal->kuota }}</td>
                        <td>{{ $jadwal->tgl_mulai->format('d F Y') }}</td>
                        <td>{{ $jadwal->tgl_berakhir->format('d F Y') }}</td>
                        <td>{{ $jadwal->tgl_pengumuman->format('d F Y') }}</td>
                        <td>{{ $jadwal->status }}</td>
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
