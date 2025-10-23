@extends('layouts.adminlte-custom')

@section('content_header')
    <div class="container-fluid mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 font-weight-bold" style="color:#333333">Manajemen Jurusan </h1>
            </div>

        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-sm mb-4" style="background-color:  #31708F; color:white;" data-toggle="modal" data-target="#modalTambahJurusan">Tambah
                    Jurusan</button>

                <table id="dataTableJurusan" class="table table-bordered table-striped">
                    <thead class="bg-basic text-white text-center">
                        <tr>
                            <th class="text-left">No</th>
                            <th class="text-left">Nama Jurusan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($jurusan as $jrs)
                            <tr>
                                <td class="text-left">{{ $loop->iteration }}</td>
                                <td class="text-left">{{ $jrs->nama_jurusan }}</td>
                                <td>
                                    @if ($jrs->is_active)
                                        <span class="badge px-3 py-2 " style="background-color: #21ca5f; color: white;">Aktif</span>
                                    @else
                                        <span class="badge badge-danger px-3 py-2">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm " data-toggle="modal"
                                        data-target="#modalEditJurusan{{ $jrs->id }}">
                                        <i class="fas fa-edit text-primary"></i>
                                    </button>

                                    <form action="{{ route('admin.manajemen-jurusan.destroy', $jrs->id) }}" method="POST"
                                        class="d-inline form-delete-jurusan">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm ">
                                            <i class="fas fa-trash text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalEditJurusan{{ $jrs->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="modalEditJurusanLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEditJurusanLabel">Edit Jurusan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="formEditJurusan{{ $jrs->id }}"
                                                action="{{ route('admin.manajemen-jurusan.update', $jrs->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="form-group">
                                                    <label for="nama_jurusan">Nama Jurusan</label>
                                                    <input type="text"
                                                        class="form-control @error('nama_jurusan') is-invalid @enderror"
                                                        id="nama_jurusan" name="nama_jurusan"
                                                        placeholder="Contoh: Juara Olimpiade Sains"
                                                        value="{{ old('nama_jurusan', $jrs->nama_jurusan) }}" required>
                                                    @error('nama_jurusan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group form-check">
                                                    <input type="hidden" name="is_active" value="0">
                                                    <input type="checkbox" class="form-check-input" id="status_aktif"
                                                        name="is_active" value="1"
                                                        {{ old('is_active', $jrs->is_active) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="status_aktif">Aktif</label>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-end">
                                            <button type="submit" form="formEditJurusan{{ $jrs->id }}"
                                                class="btn " style="background-color:  #31708F; color:white;">Simpan
                                                Perubahan</button>
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

    <div class="modal fade" id="modalTambahJurusan" tabindex="-1" role="dialog" aria-labelledby="modalTambahJurusanLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahJurusanLabel">Tambah Jurusan Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formTambahJurusan" action="{{ route('admin.manajemen-jurusan.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_jurusan">Nama Jurusan</label>
                            <input type="text" class="form-control  @error('nama_jurusan') is-invalid @enderror"
                                id="nama_jurusan" name="nama_jurusan" placeholder="Contoh: IPS"
                                value="{{ old('nama_jurusan') }}" required>
                            @error('nama_jurusan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
                    <button type="submit" form="formTambahJurusan" class="btn" style="background-color:  #31708F; color:white;">Simpan</button>
                    <button type="button" class="btn btn-default mr-2" data-dismiss="modal">Batal</button>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(function() {
            try {
                $('#dataTableJurusan').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            } catch (error) {
                console.error(
                    "Error DataTable: Pastikan plugin Datatables di adminlte.php sudah aktif dan library ter-load."
                );
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

            $(document).on('submit', '.form-delete-jurusan', function(e) {
                e.preventDefault();
                const form = this;

                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Jurusan yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
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
                if ($('#formTambahJurusan .is-invalid').length > 0) {
                    $('#modalTambahJurusan').modal('show');
                }

                @foreach ($jurusan as $jrs)
                    @if (Session::get('edit_id') == $jrs->id || ($errors->has('nama_jurusan') && old('_method') === 'PUT'))
                        $('#modalEditJurusan{{ $jrs->id }}').modal('show');
                    @endif
                @endforeach
            @endif


        })
    </script>
@endpush
