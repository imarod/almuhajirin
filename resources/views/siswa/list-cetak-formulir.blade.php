{{-- resources/views/siswa/daftar-formulir.blade.php --}}

@extends('layouts.adminlte-custom')

@section('content_header')
    <div class="container-fluid justify-content-between align-items-center">
        <div class="d-flex">
            <div>
                <h1>Daftar Formulir Pendaftaran</h1>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">           
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="text-center align-middle" style="width: 5%;">No</th>
                            <th class="text-center align-middle">Nama</th>
                            <th class="text-center align-middle" style="width: 15%;">File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarPendaftaran as $index => $pendaftaran)
                            <tr>
                                <td class="text-center align-middle">{{ $index + 1 }}.</td>
                                <td class="align-middle">{{ $pendaftaran->siswa->nama }}</td>
                                <td class="text-center align-middle">
                                    {{-- Tombol untuk mengunduh formulir --}}
                                    <a href="{{ route('cetak.formulir', $pendaftaran->id) }}" class="btn btn-sm btn-warning"
                                        >
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@stop
