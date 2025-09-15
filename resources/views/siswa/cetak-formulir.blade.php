<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Data Form - PDF Optimized</title>
    <style>
        /* PDF-optimized styles for dompdf */
        @page {
            margin: 20mm;
            size: A4;
        }
        
        body {
            font-family: "Times New Roman", serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            color: #000;
        }
        
        .header-container {
            width: 100%;
            margin-bottom: 20px;
        }
        
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .logo-cell {
            width: 120px;
            vertical-align: top;
            padding-right: 20px;
        }
        
        .logo {
            width: 100px;
            height: 100px;
            background-color: #4A90E2;
            border-radius: 50%;
            display: block;
            text-align: center;
            line-height: 100px;
            color: white;
            font-weight: bold;
            font-size: 10px;
        }
        
        .header-text {
            text-align: center;
            vertical-align: top;
        }
        
        .ministry-title {
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        
        .university-title {
            font-size: 14px;
            font-weight: bold;
            color: #8B4513;
            margin-bottom: 8px;
        }
        
        .contact-info {
            font-size: 10px;
            line-height: 1.3;
        }
        
        .separator {
            width: 100%;
            height: 3px;
            background-color: #000;
            margin: 20px 0;
        }
        
        .form-title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin: 20px 0;
        }
        
        .section-title {
            font-size: 12px;
            font-weight: bold;
            margin: 15px 0 10px 0;
            text-decoration: underline;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .data-table td {
            padding: 2px 0;
            vertical-align: top;
        }
        
        .field-number {
            width: 25px;
            text-align: left;
        }
        
        .field-label {
            width: 200px;
            text-align: left;
        }
        
        .field-colon {
            width: 15px;
            text-align: center;
        }
        
        .field-value {
            text-align: left;
        }
        
        .participant-number {
            float: right;
            margin-top: -20px;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header-container">
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    <div class="logo">
                        LOGO<br>UNILA
                    </div>
                </td>
                <td class="header-text">
                    <div class="ministry-title">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</div>
                    <div class="university-title">UNIVERSITAS LAMPUNG</div>
                    <div class="contact-info">
                        Jalan Prof. Dr. Soemantri Brojonegoro No. 1 Bandar Lampung 35145<br>
                        Telepon (0721) 701609, 702673, 702971, 703475, 701252, Fax. (0721) 702767<br>
                        laman http://unila.ac.id
                    </div>
                </td>
            </tr>
        </table>
    </div>
    
    <div class="separator"></div>
    
    <!-- Form Title -->
    <div class="form-title">
        <strong>BORANG ISIAN DATA POKOK MAHASISWA</strong><br>
        <strong>TAHUN AKADEMIK 2021/2022</strong>
    </div>
    
    <div class="participant-number">
        <strong>Nomor Peserta : 121171160521</strong>
    </div>
    
    <!-- Section I: Student Biodata -->
    <div class="section-title">I. BIODATA CALON MAHASISWA</div>
    
    <table class="data-table">
        <tr>
            <td class="field-number">1.</td>
            <td class="field-label">NAMA LENGKAP </td>
            <td class="field-colon">:</td>
            <td class="field-value">{{ $pendaftaran->siswa->nama }}</td>
        </tr>
         <tr>
            <td class="field-number">2.</td>
            <td class="field-label">NISN</td>
            <td class="field-colon">:</td>
            <td class="field-value">{{ $pendaftaran->siswa->nisn }}</td>
        </tr>
        <tr>
            <td class="field-number">3.</td>
            <td class="field-label">TEMPAT LAHIR</td>
            <td class="field-colon">:</td>
            <td class="field-value">{{ $pendaftaran->siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftaran->siswa->tanggal_lahir)->format('d F Y') }}</td>
        </tr>
        <tr>
            <td class="field-number">4.</td>
            <td class="field-label">JENIS KELAMIN</td>
            <td class="field-colon">:</td>
            <td class="field-value">{{ $pendaftaran->siswa->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td class="field-number">5.</td>
            <td class="field-label">ALAMAT SISWA</td>
            <td class="field-colon">:</td>
            <td class="field-value">{{ $pendaftaran->siswa->alamat_siswa }}.</td>
        </tr>       
        <tr>
            <td class="field-number">6.</td>
            <td class="field-label">NOMOR HP</td>
            <td class="field-colon">:</td>
            <td class="field-value">{{ $pendaftaran->siswa->no_hp_siswa }}</td>
        </tr>
        <tr>
            <td class="field-number">7.</td>
            <td class="field-label">KATEGORI PRESTASI</td>
            <td class="field-colon">:</td>
            <td class="field-value">{{ $pendaftaran->siswa->kategori_prestasi ?? '-' }}</td>
        </tr>
        <tr>
            <td class="field-number">8.</td>
            <td class="field-label">STATUS PENDAFTARAN</td>
            <td class="field-colon">:</td>
            <td class="field-value">{{ $pendaftaran->status_verifikasi }}</td>
        </tr>
        <tr>
            <td class="field-number">9.</td>
            <td class="field-label">TANGGAL PENDAFTARAN</td>
            <td class="field-colon">:</td>
            <td class="field-value">{{ \Carbon\Carbon::parse($pendaftaran->created_at)->format('d F Y') }}</td>
        </tr>
      
    </table>
    
    <!-- Section II: Family Information -->
    <div class="section-title">II. DATA ORANG TUA</div>
    
    <table class="data-table">
        <tr>
            <td class="field-number">1.</td>
            <td class="field-label">NAMA AYAH/WALI</td>
            <td class="field-colon">:</td>
            <td class="field-value">{{ $pendaftaran->siswa->orangTua->nama_ayah }}</td>
        </tr>
        <tr>
            <td class="field-number">2.</td>
            <td class="field-label">NAMA IBU</td>
            <td class="field-colon">:</td>
            <td class="field-value">{{ $pendaftaran->siswa->orangTua->nama_ibu }}</td>
        </tr>
        <tr>
            <td class="field-number">3.</td>
            <td class="field-label">ALAMAT ORANG TUA/WALI</td>
            <td class="field-colon">:</td>
            <td class="field-value">{{ $pendaftaran->siswa->orangTua->alamat_ortu }}</td>
        </tr>      
       
        <tr>
            <td class="field-number">4.</td>
            <td class="field-label">NOMOR TELEPON AYAH/WALI</td>
            <td class="field-colon">:</td>
            <td class="field-value">{{ $pendaftaran->siswa->orangTua->no_hp_ortu }}</td>
        </tr>
       
    </table>
</body>
</html>