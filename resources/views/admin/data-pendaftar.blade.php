@extends('layouts.adminlte-custom')
@section('content_header')
    <div class="container-fluid mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 font-weight-bold">Data Seluruh Pendaftar</h1>
            </div>

        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3 col-md-12">
                    <div class="d-flex align-items-center flex-wrap">
                        <div class="d-flex align-items-center mr-3 mb-2 mb-lg-0">
                            <span class="text-dark">Tampilan</span>
                            <select id="show-entries" class="form-control form-control-sm mx-2" style="width: auto;">
                                <option value="10" {{ $defaultPerPage == 10 ? 'selected' : '' }}>10 Baris</option>
                                <option value="25" {{ $defaultPerPage == 25 ? 'selected' : '' }}>25 Baris</option>
                                <option value="50" {{ $defaultPerPage == 50 ? 'selected' : '' }}>50 Baris</option>
                                <option value="100" {{ $defaultPerPage == 100 ? 'selected' : '' }}>100 Baris</option>
                                <option value="0" {{ $defaultPerPage == 0 ? 'selected' : '' }}>Semua Baris</option>
                            </select>
                        </div>
                        <div class="btn-group dropright">
                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-print mr-1" title="Cetak"></i>
                                Cetak
                            </button>
                            <div class="dropdown-menu">
                                <button id="export-btn" class="dropdown-item btn-sm text-success">
                                    <i class="fas fa-file-excel mr-1"></i>
                                    CSV
                                </button>

                                <button id="export-pdf-btn" class="dropdown-item btn-sm text-danger">
                                    <i class="fas fa-file-pdf mr-1"></i>
                                    PDF
                                </button>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="row align-items-center mb-6">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <div class="input-group input-group-sm">

                            <input type="text" class="form-control" placeholder="Cari pendaftar ..." id="searchUser">
                            <div class="input-group-prepend">
                                <button class="btn input-group-text px-3" type="button" id="searchBtn">
                                    <i class="fas fa-search" title="Telusuri"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex flex-wrap justify-content-start justify-content-md-end align-items-center">
                            {{-- filter tahun ajaran --}}
                            <div class="form-inline mr-4 mb-3 mb-lg-0">
                                <label for="filter-thn-ajaran" class="mr-2">Tahun Ajaran</label>
                                <select name="thn_ajaran" id="filter-thn-ajaran" class="form-control form-control-sm">
                                    <option value="Semua" {{ $defaultThnAjaran == 'Semua' ? 'selected' : '' }}>Semua
                                    </option>
                                    @foreach ($thnAjaran as $thn)
                                        <option value="{{ $thn }}"
                                            {{ $thn == $defaultThnAjaran ? 'selected' : '' }}>
                                            {{ $thn }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-inline mr-4 mb-2 mb-lg-0">
                                <label for="filter-status" class="mr-2">Status</label>
                                <select name="status_aktual" id="filter-status" class="form-control form-control-sm">
                                    <option value=""{{ $defaultStatus == '' ? 'selected' : '' }}>Semua</option>
                                    <option value="Diterima" {{ $defaultStatus == 'Diterima' ? 'selected' : '' }}>Diterima
                                    </option>
                                    <option value="Ditolak" {{ $defaultStatus == 'Ditolak' ? 'selected' : '' }}>Ditolak
                                    </option>
                                    <option value="Perbaikan" {{ $defaultStatus == 'Perbaikan' ? 'selected' : '' }}>
                                        Perbaikan</option>
                                    <option value="Belum diproses"
                                        {{ $defaultStatus == 'Belum diproses' ? 'selected' : '' }}>Belum diproses</option>
                                </select>
                            </div>

                            {{-- filter gelombang --}}
                            <div class="form-inline">
                                <label for="filter-gelombang" class="mr-2">Gelombang</label>
                                <select name="gelombang_pendaftaran" id="filter-gelombang"
                                    class="form-control form-control-sm">
                                    <option value="Semua" {{ $defaultGelombang == 'Semua' ? 'selected' : '' }}>Semua
                                    </option>
                                    @foreach ($gelombangPendaftaran as $gelombang)
                                        <option value="{{ $gelombang }}"
                                            {{ $gelombang == $defaultGelombang ? 'selected' : '' }}>
                                            Gelombang{{ $gelombang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Tabel -->
                <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead class="bg-success">
                            <tr class="">
                                <th class="border-0 text-white" >No.</th>
                                <th class="border-0 text-white">Nama Lengkap</th>
                                <th class="border-0 text-white">NISN</th>
                                <th class="border-0 text-white">Jenis Kelamin</th>
                                <th class="border-0 text-white">No Handphone</th>
                                <th class="border-0 text-white">Gelombang</th>
                                <th class="border-0 text-white text-center">Status</th>
                                <th class="border-0 text-white text-center">Pengumuman</th>
                                <th class="border-0 text-white text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- ajax data --}}
                        </tbody>
                    </table>
                </div>

                {{-- pagination --}}
                <div class="row mt-3">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info text-muted"></div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <nav aria-label="Page navigation" class="float-right">
                            <ul class="pagination pagination-sm mb-0">
                                {{-- Tautan paginasi akan dimuat di sini oleh JS --}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        const defaultPage = "{{ $defaultPage }}";
        const defaultPerPage = "{{ $defaultPerPage }}";
        // Fungsi untuk melakukan request AJAX dengan paginasi
        function fetchData(page = defaultPage) {
            let thnAjaran = $('#filter-thn-ajaran').val();
            let gelombang = $('#filter-gelombang').val();
            let status = $('#filter-status').val();
            let perPage = $('select.form-control-sm').val();
            let searchQuery = $('#searchUser').val();



            $.ajax({
                url: "{{ route('admin.pendaftar.json') }}",
                type: "GET",
                data: {
                    thn_ajaran: thnAjaran,
                    gelombang_pendaftaran: gelombang,
                    status_aktual: status,
                    page: page,
                    per_page: perPage,
                    search: searchQuery
                },
                success: function(response) {
                    let pendaftars = response.data;
                    let pagination = response;

                    if (searchQuery) {
                        $('#filter-thn-ajaran').val('');
                        $('#filter-gelombang').val('');
                        $('#filter-status').val('');
                    }

                    let html = '';
                    if (pendaftars.length > 0) {
                        $.each(pendaftars, function(index, pendaftar) {
                            let no = (pagination.current_page - 1) * pagination.per_page +
                                index + 1;
                            let jadwalInfo = '-';
                            let statusClass = 'status-badge';

                            if (pendaftar.jadwal) {
                                jadwalInfo =
                                    `Gelombang ${pendaftar.jadwal.gelombang_pendaftaran} (${pendaftar.jadwal.thn_ajaran})`;
                            }

                            if (pendaftar.status_aktual) {
                                statusClass +=
                                    ` status-${pendaftar.status_aktual.toLowerCase().replace(/\s/g, '')}`;
                            }

                            let detailUrl = "{{ route('admin.detail-pendaftar', ':id') }}";
                            detailUrl = detailUrl.replace(':id', pendaftar.id);

                            html += `
                            <tr>
                                <td>${no}</td>
                                <td>${pendaftar.siswa?.nama ?? '-'}</td>
                                <td>${pendaftar.siswa?.nisn ?? '-'}</td>
                                <td>${pendaftar.siswa?.jenis_kelamin ?? '-'}</td>
                                <td>${pendaftar.siswa?.no_hp_siswa ?? '-'}</td>
                                <td>${jadwalInfo}</td>
                                <td class="text-center">
                                    <span class="${statusClass}">
                                        ${
                                            pendaftar.status_aktual 
                                                ? pendaftar.status_aktual 
                                                : (
                                                    pendaftar.status_verifikasi === 'Perbaikan' 
                                                        ? pendaftar.status_verifikasi 
                                                        : 'Belum Diproses' 
                                                    )
                                         }
                                    </span>
                                </td>
                                <td class="text-center">${pendaftar.pesan_email == 1 ? 'Terkirim' : '-'}</td>

                                <td class=" text-center action-icons">
                                    <a href="${detailUrl}?thn_ajaran=${thnAjaran}&gelombang=${gelombang}&status=${status}&page=${pagination.current_page}&per_page=${perPage}&search=${searchQuery}"><i class="fas fa-eye text-secondary" title="Lihat"></i></a>
                                    <i class="fas fa-trash text-danger delete-btn" data-id="${pendaftar.id}" title="Hapus"></i>
                                    <i class="fas fa-edit text-primary" title="Edit"></i>
                                </td>
                            </tr>
                        `;
                        });
                    } else {
                        html =
                            '<tr><td colspan="8" class="text-center">Belum ada pendaftar pada filter yang dipilih.</td></tr>';
                    }
                    $('table tbody').html(html);

                    let infoText =
                        `Menampilkan ${pagination.from ?? 0} hingga ${pagination.to ?? 0} dari ${pagination.total} data`;
                    $('.dataTables_info').text(infoText);

                    let paginationHtml = '';
                    pagination.links.forEach(link => {
                        let disabledClass = link.url === null ? 'disabled' : '';
                        let activeClass = link.active ? 'active' : '';
                        let pageNumber;

                        if (link.label.includes('Previous')) {
                            labelText = 'Sebelumnya';
                            pageNumber = pagination.current_page - 1;
                        } else if (link.label.includes('Next')) {
                            labelText = 'Selanjutnya';
                            pageNumber = pagination.current_page + 1;
                        } else {
                            labelText = link.label;
                            pageNumber = link.label;
                        }

                        paginationHtml += `
                        <li class="page-item ${disabledClass} ${activeClass}">
                            <a class="page-link" href="#" data-page="${pageNumber}" onclick="event.preventDefault(); fetchData(${pageNumber});">
                                ${labelText}
                            </a>
                        </li>
                    `;
                    });
                    $('.pagination').html(paginationHtml);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    $('table tbody').html(
                        '<tr><td colspan="8" class="text-center text-danger">Terjadi kesalahan saat mengambil data.</td></tr>'
                    );
                }
            });
        }
        $(document).ready(function() {

            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault()

                let pendaftaranIdToDelete = $(this).data('id')
                let deleteUrl = "{{ route('admin.data.pendaftar.destroy', ':id') }}"
                deleteUrl = deleteUrl.replace(':id', pendaftaranIdToDelete)

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data pendaftar akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: deleteUrl,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Dihapus!',
                                    response.success,
                                    'success'
                                );
                                fetchData(1);
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Gagal!',
                                    xhr.responseJSON.error ||
                                    'Terjadi kesalahan saat menghapus data.',
                                    'error'
                                );
                                console.log(xhr.responseText);
                            }
                        })
                    }
                })
            })

            $('#filter-thn-ajaran, #filter-gelombang, #filter-status, #show-entries').change(function() {
                fetchData(1);
            });
            $('#filter-status').val("{{ $defaultStatus }}");

            $('#show-entries').val(defaultPerPage);

            $('#searchBtn').click(function() {
                fetchData(1);
            });

            $('#searchUser').keypress(function(e) {
                if (e.which == 13) {
                    fetchData(1);
                }
            });

            $('#export-btn').click(function() {
                let thnAjaran = $('#filter-thn-ajaran').val();
                let gelombang = $('#filter-gelombang').val();
                let status = $('#filter-status').val();
                let searchQuery = $('#searchUser').val();

                let exportUrl = "{{ route('admin.pendaftar.export-csv') }}";
                let params = new URLSearchParams();
                if (thnAjaran) params.append('thn_ajaran', thnAjaran);
                if (gelombang) params.append('gelombang_pendaftaran', gelombang);
                if (status) params.append('status_aktual', status);
                if (searchQuery) params.append('search', searchQuery);

                window.location.href = exportUrl + '?' + params.toString();
            });

            $('#export-pdf-btn').click(function() {
                let thnAjaran = $('#filter-thn-ajaran').val();
                let gelombang = $('#filter-gelombang').val();
                let status = $('#filter-status').val();
                let searchQuery = $('#searchUser').val();

                let exportUrl = "{{ route('admin.pendaftar.export-pdf') }}";
                let params = new URLSearchParams();
                if (thnAjaran) params.append('thn_ajaran', thnAjaran);
                if (gelombang) params.append('gelombang_pendaftaran', gelombang);
                if (status) params.append('status_aktual', status);
                if (searchQuery) params.append('search', searchQuery);

                window.location.href = exportUrl + '?' + params.toString();
            });

            fetchData(defaultPage);
        });
    </script>
@stop
