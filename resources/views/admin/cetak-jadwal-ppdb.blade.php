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
            padding: 20px;
            color: #333;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #000000;
            padding-bottom: 20px;
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

        .stat-label {
            font-size: 8px;
            color: #64748b;
            font-weight: bold;
        }

        .stat-card.accepted { background-color: #dcfce7; border-color: #16a34a; }
        .stat-card.accepted .stat-number { color: #16a34a; }

        .stat-card.pending { background-color: #fef3c7; border-color: #d97706; }
        .stat-card.pending .stat-number { color: #d97706; }

        .stat-card.rejected { background-color: #fee2e2; border-color: #dc2626; }
        .stat-card.rejected .stat-number { color: #dc2626; }

        .stat-card.unprocessed { background-color: #f1f5f9; border-color: #64748b; }
        .stat-card.unprocessed .stat-number { color: #64748b; }

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

        .text-center { text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <div class="school-name">MAS AL MUHAJIRIN TUGUMULYO</div>
        <div class="report-title">Data Seluruh Jadwal PPDB</div>
        {{-- <div class="academic-year">Tahun Ajaran 2024/2025</div> --}}
    </div>

   <div class="info-section">       
        <div class="info-row">
            <div class="info-label">Total Pendaftar</div>
            <div class="info-value">:</div>
        </div>
        <div class="info-row">
            <div class="info-label">Tanggal Cetak</div>
            <div class="info-value">: </div>
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
                    <th style="width: 25%;">TAHUN AJARAN</th>
                    <th style="width: 15%;">GELOMBANG</th>
                    <th style="width: 8%;">KUOTA</th>
                    <th style="width: 15%;">TANGGAL MULAI</th>
                    <th style="width: 17%;">TANGGAL BERAKHIR</th>
                    <th style="width: 15%;">TANGGAL PENGUMUMAN</th>
                    <th style="width: 10%;">STATUS</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($jadwals as $jadwal)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$jadwal->thn_ajaran}}</td>
                    <td>{{$jadwal->gelombang_pendaftaran}}</td>
                    <td>{{$jadwal->kuota}}</td>
                    <td>{{$jadwal->tgl_mulai->format('d-m-Y')}}</td>
                    <td>{{$jadwal->tgl_berakhir->format('d-m-Y')}}</td>
                    <td>{{$jadwal->tgl_pengumuman->format('d-m-Y')}}</td>
                    <td>{{$jadwal->status}}</td>
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