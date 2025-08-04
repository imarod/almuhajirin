@extends('adminlte::page')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>

        <div class="row justify-content-start">
            <div class="col-md-12">
                <form action="">
                    <div class="card">
                        <div class="card-header bg-blue">Data Calon Siswa</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="text-primary">Nama</th>
                                        <td>{{ $pendaftaran->siswa->nama }}</td>
                                        <th class="text-primary">No Handphone</th>
                                        <td>{{ $pendaftaran->siswa->no_hp_siswa }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-primary">NISN</th>
                                        <td>{{ $pendaftaran->siswa->nisn }}</td>
                                        <th class="text-primary">Kategori Prestasi</th>
                                        <td>{{ $pendaftaran->siswa->kategori_prestasi }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-primary">Jenis Kelamin</th>
                                        <td>{{ $pendaftaran->siswa->jenis_kelamin }}</td>
                                        <th class="text-primary">Scan Kartu Keluarga</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="text-primary">Tempat Lahir</th>
                                        <td>{{ $pendaftaran->siswa->tempat_lahir }}</td>
                                        <th class="text-primary">Scan Ijazah</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="text-primary">Tanggal Lahir</th>
                                        <td>{{ $pendaftaran->siswa->tanggal_lahir }}</td>
                                        <th class="text-primary">Scan Ijazah</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="text-primary">Alamat</th>
                                        <td>{{ $pendaftaran->siswa->alamat_siswa }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-header bg-blue">Data Orang Tua</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="text-primary">Nama Ayah</th>
                                        <td>{{ $pendaftaran->siswa->orangTua->nama_ayah }}</td>
                                       
                                    </tr>
                                    <tr>
                                        <th class="text-primary">Nama Ibu</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="text-primary">Alamat</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="text-primary">No Handphone</th>
                                        <td></td>
                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>

                </form>

            </div>
        </div>


    </div>

    </div>
@stop
