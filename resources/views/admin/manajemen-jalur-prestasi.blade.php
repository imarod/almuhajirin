
@extends('layouts.adminlte-custom')
@section('content_header')
    <div class="container-fluid mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 font-weight-bold">Manajemen Jalur Prestasi</h1>
                <p>Kelola kategori prestasi untuk pendaftaran siswa baru.</p>
            </div>
           
        </div>
    </div>
@stop

@section('content') 
    <div class="container-fluid">
        
        <div class="card">
            <div class="card-body">
                 {{-- Tombol Tambah --}}
            <button class="btn btn-success mb-4" data-toggle="modal" data-target="#modalTambahKategori">
               Tambah Kategori
            </button>
                <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Prestasi</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategoriPrestasi as $kategori)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kategori->nama_prestasi }}</td>
                                <td>{{ $kategori->deskripsi ?? '-' }}</td>
                                <td>
                                    @if ($kategori->is_active)
                                        <span class="badge badge-success px-3 py-2 ">Aktif</span> 
                                    @else
                                        <span class="badge badge-danger px-3 py-2">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm " data-toggle="modal"
                                        data-target="#modalEditKategori{{ $kategori->id }}">
                                        <i class="fas fa-edit text-primary"></i>
                                    </button>

                                    <form action="{{ route('admin.kategori-prestasi.destroy', $kategori->id) }}"
                                        method="POST" class="d-inline form-delete-prestasi">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm ">
                                            <i class="fas fa-trash text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            {{-- Modal Edit Kategori (Per Loop) --}}
                            <div class="modal fade" id="modalEditKategori{{ $kategori->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="modalEditKategoriLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEditKategoriLabel">Edit Kategori Prestasi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="formEditKategori{{ $kategori->id }}"
                                                action="{{ route('admin.kategori-prestasi.update', $kategori->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="nama_prestasi">Nama Prestasi</label>
                                                    <input type="text"
                                                        class="form-control @error('nama_prestasi') is-invalid @enderror"
                                                        id="nama_prestasi" name="nama_prestasi"
                                                        placeholder="Contoh: Juara Olimpiade Sains"
                                                        value="{{ old('nama_prestasi', $kategori->nama_prestasi) }}" required>
                                                    @error('nama_prestasi')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="deskripsi">Deskripsi (opsional)</label>
                                                    <input type="text" class="form-control" id="deskripsi"
                                                        name="deskripsi" placeholder="Deskripsi singkat"
                                                        value="{{ old('deskripsi', $kategori->deskripsi) }}">
                                                </div>
                                                <div class="form-group form-check">
                                                    <input type="hidden" name="is_active" value="0">

                                                    <input type="checkbox" class="form-check-input" id="status_aktif"
                                                        name="is_active" value="1"
                                                        {{ old('is_active', $kategori->is_active) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="status_aktif">Aktif</label>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-end">
                                            <button type="submit" form="formEditKategori{{ $kategori->id }}"
                                                class="btn btn-success">Simpan</button>
                                            <button type="button" class="btn btn-default mr-2"
                                                data-dismiss="modal">Batal</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    {{-- Modal Tambah Kategori (Di luar Loop) --}}
    <div class="modal fade" id="modalTambahKategori" tabindex="-1" role="dialog"
        aria-labelledby="modalTambahKategoriLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahKategoriLabel">Tambah Kategori Prestasi Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formTambahKategori" action="{{ route('admin.kategori-prestasi.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_prestasi">Nama Prestasi</label>
                            <input type="text" class="form-control @error('nama_prestasi') is-invalid @enderror"
                                id="nama_prestasi" name="nama_prestasi" placeholder="Contoh: Juara Olimpiade Sains"
                                value="{{ old('nama_prestasi') }}" required>
                            @error('nama_prestasi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi (opsional)</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                placeholder="Deskripsi singkat" value="{{ old('deskripsi') }}">
                        </div>
                        <div class="form-group form-check">
                            <input type="hidden" name="is_active" value="0">

                            <input type="checkbox" class="form-check-input" id="status_aktif" name="is_active"
                                value="1" checked>
                            <label class="form-check-label" for="status_aktif">Aktif</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <button type="submit" form="formTambahKategori" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-default mr-2" data-dismiss="modal">Batal</button>
                    
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        $(function () {
            try {
                $('#dataTable').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            } catch (error) {
                console.error("Error DataTable: Pastikan plugin Datatables di adminlte.php sudah aktif dan library ter-load.");
            }

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            @if (Session::has('success'))
                Toast.fire({
                    icon: 'success',
                    title: '{{ Session::get('success') }}'
                })
            @endif

            @if (Session::has('error') || $errors->any())
                @if (Session::has('error'))
                    Toast.fire({
                        icon: 'error',
                        title: 'Gagal! {{ Session::get('error') }}'
                    })
                @else
                    Toast.fire({
                        icon: 'error',
                        title: 'Gagal! Silakan cek kembali input Anda.'
                    })
                @endif
            @endif

            @if (Session::has('warning'))
                Toast.fire({
                    icon: 'warning',
                    title: '{{ Session::get('warning') }}'
                })
            @endif

            // 2. SweetAlert untuk Konfirmasi Hapus
            $(document).on('submit', '.form-delete-prestasi', function(e) {
                e.preventDefault(); 
                const form = this;

                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Kategori yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    })
                } else {
                    console.error("SweetAlert2 is not loaded. Submitting form directly.");
                    form.submit();
                }
            });

            @if ($errors->any())
                const isEditing = $('input[name="_method"]').val() === 'PUT';

                if (!isEditing) {
                    $('#modalTambahKategori').modal('show');
                } else {
                    @if (Session::has('edit_id'))
                        $('#modalEditKategori{{ Session::get('edit_id') }}').modal('show');
                    @endif
                }
            @endif
        });
    </script>
@endpush