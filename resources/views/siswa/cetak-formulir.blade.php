<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Formulir Pendaftaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        .header img {
            height: 80px;
            margin-right: 20px;
        }
        .header-text {
            text-align: center;
            flex-grow: 1;
        }
        .header-text h3 {
            margin: 0;
            font-size: 1.2em;
        }
        .header-text p {
            margin: 0;
            font-size: 0.9em;
        }
        .form-title {
            text-align: center;
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .form-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .form-details {
            width: 70%;
        }
        .form-photo {
            width: 25%;
            text-align: right;
        }
        .form-photo img {
            width: 150px;
            height: 200px;
            border: 1px solid #ddd;
            object-fit: cover;
        }
        .form-row {
            display: flex;
            margin-bottom: 10px;
        }
        .label {
            font-weight: bold;
            width: 150px;
        }
        .data {
            flex-grow: 1;
            border-bottom: 1px solid #000;
            padding-left: 5px;
        }
        .signature-box {
            text-align: right;
            margin-top: 50px;
        }
        .signature-text {
            margin-bottom: 70px;
        }
        .signature-name {
            font-weight: bold;
            border-bottom: 1px solid #000;
            display: inline-block;
            padding-bottom: 5px;
        }

        @media print {
            body {
                background-color: #fff;
            }
            .container {
                box-shadow: none;
                border: 1px solid #000;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="http://googleusercontent.com/file_content/0" alt="Logo Sekolah"> 
            <div class="header-text">
                <h3>SMA Negeri 10 Surabaya</h3>
                <p>Jalan Raya Candi Lontar No. 10, Surabaya</p>
                <p>Telepon: (031) 1234567 | Email: info@sman10.sch.id</p>
            </div>
        </div>

        <div class="form-title">
            FORMULIR BUKTI PENDAFTARAN SISWA BARU
        </div>

        <div class="form-section">
            <div class="form-details">
                <div class="form-row">
                    <span class="label">Nama</span>
                    <span class="data">{{ $pendaftaran->siswa->nama }}</span>
                </div>
                <div class="form-row">
                    <span class="label">NISN</span>
                    <span class="data">{{ $pendaftaran->siswa->nisn }}</span>
                </div>
                <div class="form-row">
                    <span class="label">Jenis Kelamin</span>
                    <span class="data">{{ $pendaftaran->siswa->jenis_kelamin }}</span>
                </div>
                <div class="form-row">
                    <span class="label">Tempat, Tanggal Lahir</span>
                    <span class="data">{{ $pendaftaran->siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftaran->siswa->tanggal_lahir)->format('d F Y') }}</span>
                </div>
                <div class="form-row">
                    <span class="label">Alamat</span>
                    <span class="data">{{ $pendaftaran->siswa->alamat_siswa }}</span>
                </div>
                <div class="form-row">
                    <span class="label">Nomor HP Siswa</span>
                    <span class="data">{{ $pendaftaran->siswa->no_hp_siswa }}</span>
                </div>
                <div class="form-row">
                    <span class="label">Kategori Prestasi</span>
                    <span class="data">{{ $pendaftaran->siswa->kategori_prestasi ?? '-' }}</span>
                </div>
                <div class="form-row">
                    <span class="label">Nama Ayah</span>
                    <span class="data">{{ $pendaftaran->siswa->orangTua->nama_ayah }}</span>
                </div>
                <div class="form-row">
                    <span class="label">Nama Ibu</span>
                    <span class="data">{{ $pendaftaran->siswa->orangTua->nama_ibu }}</span>
                </div>
                <div class="form-row">
                    <span class="label">Alamat Orang Tua</span>
                    <span class="data">{{ $pendaftaran->siswa->orangTua->alamat_ortu }}</span>
                </div>
                <div class="form-row">
                    <span class="label">Nomor HP Orang Tua</span>
                    <span class="data">{{ $pendaftaran->siswa->orangTua->no_hp_ortu }}</span>
                </div>
                <div class="form-row">
                    <span class="label">Status Verifikasi</span>
                    <span class="data">{{ $pendaftaran->status_verifikasi }}</span>
                </div>
                <div class="form-row">
                    <span class="label">Tanggal Pendaftaran</span>
                    <span class="data">{{ \Carbon\Carbon::parse($pendaftaran->created_at)->format('d F Y') }}</span>
                </div>
            </div>
            
            <div class="form-photo">
                <img src="http://via.placeholder.com/150x200?text=Foto+Siswa" alt="Foto Siswa">
            </div>
        </div>
        
        <div class="signature-box">
            <div class="signature-text">Surabaya, {{ \Carbon\Carbon::now()->format('d F Y') }}</div>
            <div class="signature-text">Yang bersangkutan,</div>
            <div class="signature-text" style="margin-top: 50px;">
                <span class="signature-name">{{ $pendaftaran->siswa->nama }}</span>
            </div>
        </div>

    </div>
    <script>
        // Otomatis memicu jendela cetak saat halaman dimuat
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>