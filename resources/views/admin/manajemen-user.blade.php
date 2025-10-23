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
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4 ">
                <div class="card p-0 h-100">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-center mb-2">
                            <h3 class="font-weight-bold mb-0 total-users-count" style="color: #3F51B5"></h3>
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
                            <h3 class="font-weight-bold mb-0 admin-count" style="color: #5E7CE3;"></h3>
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
                            <h3 class="font-weight-bold mb-0 siswa-count" style="color: #21ca5f;"></h3>
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
                    {{-- <li class="nav-item">
                        <a class="nav-link text-dark" id="manajemen-role-tab" data-toggle="pill" href="#manajemen-role"
                            role="tab" aria-controls="manajemen-role" aria-selected="false">Manajemen Role</a>
                    </li> --}}
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
                        <div class="row align-items-center mb-3">
                            <div class="col-md-4 mb-4 mb-md-0">
                                <div class="d-flex align-items-center flex-wrap">
                                    <div class="d-flex align-items-center">
                                        <span class="mr-2">Tampilkan</span>
                                        <select class="form-control form-control-sm" style="width: auto" id="show-entries">
                                            <option value="10">10 Baris</option>
                                            <option value="25">25 Baris</option>
                                            <option value="50">50 Baris</option>
                                            <option value="100">100 Baris</option>
                                            <option value="0">Semua Baris</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="row d-flex justify-content-end">
                                    <div class="col-md-3 mb-2 mb-md-0 d-flex justify-content-md-end align-items-center">
                                        <select class="form-control form-control-sm" id="roleFilter">
                                            <option value="">Semua Role</option>
                                            <option value="1">Admin</option>
                                            <option value="0">Siswa</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2 mb-md-0">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            </div>
                                            <input type="text" class="form-control"
                                                placeholder="Cari berdasarkan nama atau email..." id="searchUser">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table class="table  table-hover table-bordered">
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
                                    {{-- AJAX data --}}

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- paginasi --}}
                <div class="row mt-3">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info text-muted"></div>
                    </div>

                    <div class="col-sm-12 col-md-7">
                        <nav aria-label="Page navigation" class="float-right">
                            <ul class="pagination pagination-sm mb-0">
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahUserModal" tabindex="-1" role="dialog" aria-labelledby="tambahUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahUserModalLabel">Tambah User Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.manajemen.user.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="name" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="is_admin">Role</label>
                            <select class="form-control" id="is_admin" name="is_admin" required>
                                <option value="0">Siswa</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn"
                            style="background-color:  #31708F; color: white;">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editUserForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="editUserId" name="id">
                        <div class="form-group">
                            <label for="editName">Nama</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="editEmail">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="editPassword">Password (isi jika ingin mengubah)</label>
                            <input type="password" class="form-control" id="editPassword" name="password">
                        </div>
                        <div class="form-group">
                            <label for="editIsAdmin">Role</label>
                            <select class="form-control" id="editIsAdmin" name="is_admin" required>
                                <option value="0">Siswa</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function fetchUsers(page = 1) {
            const searchQuery = $('#searchUser').val();
            const roleFilter = $('#roleFilter').val();
            const perPage = $('#show-entries').val()

            $.ajax({
                url: '{{ route('admin.manajemen.user.json') }}',
                method: 'GET',
                data: {
                    search: searchQuery,
                    role: roleFilter,
                    page: page,
                    per_page: perPage
                },
                success: function(response) {
                    let users = response.data
                    let tableBody = $('.table tbody')
                    tableBody.empty()

                    if (users.length > 0) {
                        let offset = (response.current_page - 1) * response.per_page
                        $.each(users, function(index, user) {
                            let no = offset + index + 1;
                            let roleBadge = user.is_admin === 1 ?
                                '<span class="badge-admin">Admin</span>' :
                                '<span class="badge-siswa">Siswa</span>';
                            let row = `  
                        <tr>
                            <td>${no}</td>
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td>${roleBadge}</td>
                            <td>${user.created_at_formatted}</td>
                            <td class=" text-center action-icons">   
                                <i class="fas fa-edit text-primary edit-btn"  data-id="${user.id}" title="Edit"></i>                            
                                <i class="fas fa-trash text-danger delete-btn" title="Hapus" data-id="${user.id}"></i>
                                    
                            </td>
                            </tr>
                            `
                            tableBody.append(row)
                        })
                    } else {
                        tableBody.append(
                            '<tr><td colspan="6" class="text-center">Tidak ada data user yang ditemukan.</td></tr>'
                        )
                    }

                    let infoText =
                        `Menampilkan ${response.from ?? 0} hingga ${response.to ?? 0} dari ${response.total} data`
                    $('.dataTables_info').text(infoText)

                    let paginationHtml = ''
                    response.links.forEach(link => {
                        let disabledClass = link.url === null ? 'disabled' : ''
                        let activeClass = link.active ? 'active' : ''
                        let pageNumber

                        if (link.label.includes('Previous')) {
                            labelText = 'Sebelumnya';
                            pageNumber = response.current_page - 1
                        } else if (link.label.includes('Next')) {
                            labelText = 'Selanjutnya';
                            pageNumber = response.current_page + 1
                        } else {
                            labelText = link.label;
                            pageNumber = link.label
                        }

                        paginationHtml += `
                            <li class="page-item ${disabledClass} ${activeClass}">
                                <a class="page-link" href="#" data-page="${pageNumber}" onclick="event.preventDefault(); fetchUsers(${pageNumber});">
                                    ${labelText}
                                </a>
                            </li>
                        `;
                    })
                    $('.pagination').html(paginationHtml)
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error: ', status, error)
                }
            })
        }

        $(document).ready(function() {

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
            fetchUsers()

            $('#roleFilter , #show-entries, #searchUser').on('change keyup', function() {
                fetchUsers(1)
            })

            // Event handler untuk tombol hapus
            $(document).on('click', '.delete-btn', function() {
                const userId = $(this).data('id');
                const userRow = $(this).closest('tr');

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
                        $.ajax({
                            url: `/admin/manajemen-user/${userId}`,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Dihapus!',
                                        response.message,
                                        'success'
                                    );
                                    // Hapus baris dari tabel
                                    userRow.remove();
                                    fetchUsers();
                                } else {
                                    Swal.fire(
                                        'Gagal!',
                                        response.message,
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus user.',
                                    'error'
                                );
                                console.log('AJAX Error: ', status, error);
                            }
                        });
                    }
                });
            });

            // Event handler untuk tombol edit
            $(document).on('click', '.edit-btn', function() {
                const userId = $(this).data('id');

                $.ajax({
                    url: `{{ url('admin/manajemen-user') }}/${userId}/edit`,
                    method: 'GET',
                    success: function(user) {
                        $('#editUserId').val(user.id);
                        $('#editName').val(user.name);
                        $('#editEmail').val(user.email);
                        $('#editIsAdmin').val(user.is_admin);

                        $('#editUserModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat mengambil data user.',
                            'error'
                        );
                        console.log('AJAX Error: ', status, error);
                    }
                });
            });

            $('#tambahUserModal form').on('submit', function(e) {
                e.preventDefault();
                const formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('admin.manajemen.user.store') }}',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#tambahUserModal').modal('hide');
                        $('#tambahUserModal').on('hidden.bs.modal', function() {
                            $('.modal-backdrop').remove();
                            $('body').removeClass('modal-open').css('padding-right',
                            '');

                            Swal.fire(
                                'Berhasil!',
                                response.message,
                                'success'
                            );

                            $('#tambahUserModal form')[0].reset();
                            fetchUsers();
                            fetchUserCounts();

                            $(this).off('hidden.bs.modal');
                        });
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON.errors;
                        let errorHtml = '';
                        $.each(errors, function(key, value) {
                            errorHtml += `<li>${value}</li>`;
                        });
                        Swal.fire(
                            'Gagal!',
                            `Terjadi kesalahan validasi:<ul>${errorHtml}</ul>`,
                            'error'
                        );
                    }
                });
            });

            $('#editUserForm').on('submit', function(e) {
                e.preventDefault();

                const userId = $('#editUserId').val();
                const formData = $(this).serialize();

                $.ajax({
                    url: `{{ url('admin/manajemen-user') }}/${userId}`,
                    method: 'PUT',
                    data: formData,
                    success: function(response) {
                        Swal.fire(
                            'Berhasil!',
                            response.message,
                            'success'
                        );
                        $('#editUserModal').modal('hide');
                        fetchUsers();
                    },
                    error: function(xhr, status, error) {
                        const errors = xhr.responseJSON.errors;
                        let errorHtml = '';
                        $.each(errors, function(key, value) {
                            errorHtml += `<li>${value}</li>`;
                        });
                        Swal.fire(
                            'Gagal!',
                            `Terjadi kesalahan saat mengupdate user:<ul>${errorHtml}</ul>`,
                            'error'
                        );
                        console.log('AJAX Error: ', status, error, xhr.responseJSON.errors);
                    }
                });
            });
        })
    </script>
@endpush
