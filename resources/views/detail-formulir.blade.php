@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Formulir Siswa</h2>

    <table class="table">
        <tr><th>Nama</th><td>{{ $pendaftaran->siswa->nama }}</td></tr>
        <tr><th>NISN</th><td>{{ $pendaftaran->siswa->nisn }}</td></tr>
        <tr><th>Jenis Kelamin</th><td>{{ $pendaftaran->siswa->jenis_kelamin }}</td></tr>
        <tr><th>Tempat Lahir</th><td>{{ $pendaftaran->siswa->tempat_lahir }}</td></tr>
        <tr><th>Tanggal Lahir</th><td>{{ $pendaftaran->siswa->tanggal_lahir }}</td></tr>
        <tr><th>Nama Ayah</th><td>{{ $pendaftaran->siswa->orangTua->nama_ayah }}</td></tr>
        <tr><th>Nama Ibu</th><td>{{ $pendaftaran->siswa->orangTua->nama_ibu }}</td></tr>
        <!-- Tambahkan data lainnya sesuai kebutuhan -->
    </table>

    <a href="{{ route('formulir.edit', $pendaftaran->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection
