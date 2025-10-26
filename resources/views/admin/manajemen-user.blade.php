@extends('layouts.adminlte-custom')

@section('content_header')
    <div class="container-fluid mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 font-weight-bold" style="color:#333333">Manajemen User</h1>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            {{-- Statistik Cards tetap menggunakan AJAX untuk counts karena tidak ada cara Blade murni untuk counts real-time tanpa Datatables loading --}}
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4 ">
                <div class="card p-0 h-100">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-center mb-2">
                            <h3 class="font-weight-bold mb-0 total-users-count" style="color: #3F51B5">0</h3>
                            <div class="ml-auto" style="color: #3F51B5">
                                <i class="fas fa-user-plus fa-2x"></i>
                            </div>
                        </div>
                        <p class="mb-0 text-muted">Total User</p>
                    </div>
                    <div class="card-footer p-2 text-white " style="background: #3F51B5;">
                        <div class="d-flex align-items-center py-2">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="card p-0 h-100">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-center mb-2">
                            <h3 class="font-weight-bold mb-0 admin-count" style="color: #5E7CE3;">0</h3>
                            <div class="ml-auto " style="color: #5E7CE3;">
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                        </div>
                        <p class="mb-0 text-muted">Total User Admin</p>
                    </div>
                    <div class="card-footer p-2 text-white " style="background: #5E7CE3;">
                        <div class="d-flex align-items-center">
                            <p class="mb-0 small text-white">% change</p>
                            <div class="ml-auto">
                                <i class="fas fa-chart-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="card p-0 h-100">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-center mb-2">
                            <h3 class="font-weight-bold mb-0 siswa-count" style="color: #21ca5f;">0</h3>
                            <div class="ml-auto " style="color: #21ca5f;">
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                        </div>
                        <p class="mb-0 text-muted">Total User Siswa</p>
                    </div>
                    <div class="card-footer p-2 text-white " style="background: #21ca5f;">
                        <div class="d-flex align-items-center">
                            <p class="mb-0 small text-white">% change</p>
                            <div class="ml-auto">
                                <i class="fas fa-chart-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-dark" id="daftar-user-tab" data-toggle="pill" href="#daftar-user"
                            role="tab" aria-controls="daftar-user" aria-selected="true">Daftar User</a>
                    </li>
                </ul>
                <style>
                    .nav-tabs .nav-link.active {
                        font-weight: 700;
                        box-shadow:
                            inset 0 5px 6px -5px rgba(0, 0, 0, 0.5);
                    }

                    .nav-tabs .nav-link.active.text-dark {
                        color: #31708F !important;
                    }

                    .nav-tabs .nav-link:hover {
                        background-color: #efeff9;
                    }
                </style>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <a href="#" class="btn btn-sm mb-4" data-toggle="modal" data-target="#tambahUserModal"
                        style="background-color: #31708F; color: white;">
                        Tambah User
                    </a>
                    <div class="tab-pane fade show active" id="daftar-user" role="tabpanel"
                        aria-labelledby="daftar-user-tab">

                        {{-- Logika filter manual Dihapus, Datatables menanganinya --}}

                        <div class="table-responsive">
                            {{-- ID table diubah menjadi "user-table" untuk Datatables --}}
                            <table class="table table-hover table-bordered" id="user-table" style="width:100%">
                                <thead class="bg-basic text-white">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Data akan diisi oleh Datatables Server-Side --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Paginasi manual dihapus --}}
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH USER (Dipertahankan, AJAX store diganti Form biasa) --}}
    <div class="modal fade" id="tambahUserModal" tabindex="-1" role="dialog" aria-labelledby="tambahUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahUserModalLabel">Tambah User Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" data-focus="false" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- Form submit langsung ke route, bukan via AJAX --}}
                <form action="{{ route('admin.manajemen.user.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="is_admin">Role</label>
                            <select class="form-control @error('is_admin') is-invalid @enderror" id="is_admin"
                                name="is_admin" required>
                                <option value="0" {{ old('is_admin') == '0' ? 'selected' : '' }}>Siswa</option>
                                <option value="1" {{ old('is_admin') == '1' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('is_admin')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn"
                            style="background-color:  #31708F; color: white;">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            data-focus="false">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT USER  --}}
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-focus="false">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editName">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="editName"
                                name="name" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="editEmail">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="editEmail" name="email" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="editPassword">Password (isi jika ingin mengubah)</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="editPassword" name="password">
                            @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="editIsAdmin">Role</label>
                            <select class="form-control @error('is_admin') is-invalid @enderror" id="editIsAdmin"
                                name="is_admin" required>
                                <option value="0">Siswa</option>
                                <option value="1">Admin</option>
                            </select>
                            @error('is_admin')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            data-focus="false">Tutup</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {

            @if (session('success'))

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    showConfirmButton: true
                });
            @endif
            @if ($errors->any())
                Swal.fire({
                    icon: 'warning',
                    title: 'Gagal Menambahkan Jurusan!',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    showConfirmButton: true,
                    confirmButtonColor: '#d33'
                });
            @endif


            // Fetch User Counts 
            function fetchUserCounts() {
                $.ajax({
                    url: '{{ route('admin.manajemen.user.counts') }}',
                    method: 'GET',
                    success: function(response) {
                        $('.total-users-count').text(response.totalUser);
                        $('.admin-count').text(response.totalAdmin);
                        $('.siswa-count').text(response.totalUserBiasa);
                    },
                    error: function(xhr, status, error) {
                        console.error("Gagal mengambil data user counts: ", error);
                    }
                });
            }
            fetchUserCounts();

            // Datatables (Server-Side Processing)
            const userTable = $('#user-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.manajemen.user.json') }}',
                columns: [{
                        data: null,
                        name: 'no',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'role',
                        name: 'is_admin',
                        orderable: true,
                        searchable: true
                    }, 
                    {
                        data: 'created_at_formatted',
                        name: 'created_at',
                        searchable: false
                    }, 
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                ],
                order: [
                    [4, 'desc']
                ] // Order by created_at
            });

            
            $(document).on('click', '.edit-btn', function() {
                const userId = $(this).data('id');
                const editUrl = $(this).data('url');

                $('#editUserForm').attr('action', `{{ url('admin/manajemen-user') }}/${userId}`);

                $.ajax({
                    url: editUrl,
                    method: 'GET',
                    success: function(user) {
                        $('#editName').val(user.name);
                        $('#editEmail').val(user.email);
                        $('#editIsAdmin').val(user.is_admin);
                        $('#editPassword').val(''); 
                    },
                    error: function() {
                        Swal.fire('Gagal', 'Gagal memuat data user untuk diedit.', 'error');
                    }
                });

                $('#editUserForm .is-invalid').removeClass('is-invalid');
                $('#editUserForm .invalid-feedback').remove();
            });


            $(document).on('submit', 'form', function(e) {
                if ($(this).find('.delete-btn').length >
                    0) {
                    e.preventDefault();
                    const form = this;

                    if (typeof Swal !== 'undefined') { 
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Data user ini akan dihapus secara permanen!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    } else {
                        console.error("SweetAlert2 is not loaded. Submitting form directly.");
                        form.submit();
                    }

                }
            });

            // 5. Handle Error Validasi (untuk modal Add dan Edit)
            // window.addEventListener('load', function() {
            //     @if ($errors->any())
            //         @if (session('edit_error_id'))
            //             $('#editUserForm').attr('action',
            //                 `{{ url('admin/manajemen-user') }}/{{ session('edit_error_id') }}`);
            //             $('#editUserModal').modal('show');
            //         @else
            //             $('#tambahUserModal').modal('show');
            //         @endif
            //     @endif
            // });
        });
    </script>
@endpush
