<!DOCTYPE html>
<html>
<head>
    <title>Pengumuman Kelulusan</title>
</head>
<body>
    <h1>Pengumuman Hasil PPDB</h1>
    <p>Halo, {{ $pendaftaran->siswa->nama }}!</p>
    
    @if($pendaftaran->status_aktual == 'Diterima')
        <p>Selamat! Anda dinyatakan **Diterima** dalam pendaftaran PPDB. Silakan cek dashboard pendaftaran untuk melihat status pendaftaran.</p>
    @else
        <p>Mohon maaf, Anda dinyatakan **Tidak Diterima** dalam pendaftaran PPDB. Tetap semangat!</p>
    @endif
    
    <p>Terima kasih atas partisipasinya.</p>
</body>
</html>