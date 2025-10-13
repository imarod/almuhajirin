@extends('layouts.adminlte-custom')

@section('content')

{{-- Tombol untuk menampilkan modal --}}
<button class="btn btn-primary" data-toggle="modal" data-target="#riwayatModal">Tampilkan Riwayat Proses Pengajuan</button>

{{-- Modal Sederhana --}}
<div class="modal fade" id="riwayatModal" tabindex="-1" role="dialog" aria-labelledby="riwayatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="riwayatModalLabel">Riwayat Proses Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- Tabel Riwayat Proses Pengajuan --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 15%">Status</th>
                                <th style="width: 25%">Uraian</th>
                                <th style="width: 20%">Waktu</th>
                                <th style="width: 40%">Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>**Submit**</td>
                                <td>Mahasiswa $\rightarrow$ Dekanat</td>
                                <td>23 Jul 2023 -<br>20:56 WIB</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="text-danger">
                                        **Tolak<br>Dekanat**
                                    </span>
                                </td>
                                <td>Dekanat $\rightarrow$ Mahasiswa</td>
                                <td>4 Aug 2023 -<br>10:49 WIB</td>
                                <td>
                                    <span class="text-danger">
                                        Tidak memenuhi syarat pada SK Rektor nomor 2935
                                    </span>
                                </td>
                            </tr>
                            {{-- Anda bisa menambahkan baris lain di sini --}}
                        </tbody>
                    </table>
                </div>
                {{-- Akhir Tabel --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                {{-- Anda bisa menambahkan tombol aksi lain di sini jika diperlukan --}}
            </div>
        </div>
    </div>
</div>
{{-- Akhir Modal Sederhana --}}

@endsection