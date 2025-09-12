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
        {{-- <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pendaftar</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Pendaftar</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row --> --}}

        <div class="card">
            <div class="card-body">
                {{-- filter --}}
                <div class="row align-items-center mb-6">
                    <div class="col-md-4 mb-4 mb-md-0">
                        <div class="d-flex align-items-center flex-wrap">
                            <div class="d-flex align-items-center mr-3 mb-2 mb-lg-0">
                                <span class="text-dark">Tampilan</span>
                                <select id="show-entries" class="form-control form-control-sm mx-2" style="width: auto;">
                                    <option value="10">10 Baris</option>
                                    <option value="25">25 Baris</option>
                                    <option value="50">50 Baris</option>
                                    <option value="100">100 Baris</option>
                                    <option value="0">Semua Baris</option>
                                </select>
                            </div>
                            <button class="btn btn-outline-secondary btn-sm d-flex align-items-center ">
                                <i class="fas fa-download text-muted mr-2"></i>
                                Export
                            </button>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex flex-wrap justify-content-start justify-content-md-end align-items-center">
                            {{-- filter tahun ajaran --}}

                            <div class="form-inline mr-4 mb-3 mb-lg-0">
                                <label for="filter-thn-ajaran" class="mr-2">Tahun Ajaran</label>
                                <select name="thn_ajaran" id="filter-thn-ajaran" class="form-control form-control-sm">
                                    <option value="">Semua</option>
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
                                    <option value="">Semua</option>
                                    <option value="Diterima">Diterima</option>
                                    <option value="Ditolak">Ditolak</option>
                                    <option value="Diproses">Diproses</option>
                                    <option value="Belum diproses">Belum diproses</option>
                                </select>
                            </div>

                            {{-- filter gelombang --}}
                            <div class="form-inline">
                                <label for="filter-gelombang" class="mr-2">Gelombang</label>
                                <select name="gelombang_pendaftaran" id="filter-gelombang"
                                    class="form-control form-control-sm">
                                    <option value="">Semua</option>
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
                        <thead class="bg-basic">
                            <tr class="">
                                <th class="border-0 text-white" style="border-top-left-radius: 0.5rem !important">No.</th>
                                <th class="border-0 text-white">Nama Lengkap</th>
                                <th class="border-0 text-white">NISN</th>
                                <th class="border-0 text-white">Jenis Kelamin</th>
                                <th class="border-0 text-white">No Handphone</th>
                                <th class="border-0 text-white">Gelombang</th>
                                <th class="border-0 text-white text-center">Status</th>
                                <th class="border-0 text-white text-center"
                                    style="border-top-right-radius: 0.5rem !important">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @if (isset($pendaftars) && $pendaftars->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data pendaftar</td>
                                </tr>
                            @else
                                @foreach ($pendaftars as $pendaftar)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $pendaftar->siswa->nama ?? '-' }}</td>
                                        <td>{{ $pendaftar->siswa->nisn ?? '-' }}</td>
                                        <td>{{ $pendaftar->siswa->jenis_kelamin ?? '-' }}</td>
                                        <td>{{ $pendaftar->siswa->no_hp_siswa ?? '-' }}</td>
                                        <td>
                                            @if ($pendaftar->jadwal)
                                                Gelombang {{ $pendaftar->jadwal->gelombang_pendaftaran }}
                                                ({{ $pendaftar->jadwal->thn_ajaran }})
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center"><span
                                                class="status-badge status-{{ strtolower(str_replace(' ', '', $pendaftar->status_aktual ?? '')) }}">{{ $pendaftar->status_aktual ?? '-' }}</span>
                                        </td>
                                        <td class=" text-center action-icons">
                                            <a href="{{ route('admin.detail-pendaftar', ['id' => $pendaftar->id]) }}"><i
                                                    class="fas fa-eye text-secondary" title="Lihat"></i></a>
                                            <i class="fas fa-trash text-danger" title="Hapus"></i>
                                            <i class="fas fa-edit text-primary" title="Edit"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif --}}
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Fungsi untuk melakukan request AJAX dengan paginasi
        function fetchData(page = 1) {
            let thnAjaran = $('#filter-thn-ajaran').val();
            let gelombang = $('#filter-gelombang').val();
            let status = $('#filter-status').val();
            let perPage = $('select.form-control-sm').val();

            $.ajax({
                url: "{{ route('admin.pendaftar.json') }}",
                type: "GET",
                data: {
                    thn_ajaran: thnAjaran,
                    gelombang_pendaftaran: gelombang,
                    status_aktual: status,
                    page: page,
                    per_page: perPage
                },
                success: function(response) {
                    let pendaftars = response.data;
                    let pagination = response;

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
                                <td class="text-center"><span class="${statusClass}">${pendaftar.status_aktual ?? '-'}</span></td>
                                <td class=" text-center action-icons">
                                    <a href="${detailUrl}"><i class="fas fa-eye text-secondary" title="Lihat"></i></a>
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
                        `Showing ${pagination.from ?? 0} to ${pagination.to ?? 0} of ${pagination.total} entries`;
                    $('.dataTables_info').text(infoText);

                    let paginationHtml = '';
                    pagination.links.forEach(link => {
                        let disabledClass = link.url === null ? 'disabled' : '';
                        let activeClass = link.active ? 'active' : '';
                        let pageNumber;

                        if (link.label.includes('Previous')) {
                            pageNumber = pagination.current_page - 1;
                        } else if (link.label.includes('Next')) {
                            pageNumber = pagination.current_page + 1;
                        } else {
                            pageNumber = link.label;
                        }

                        paginationHtml += `
                        <li class="page-item ${disabledClass} ${activeClass}">
                            <a class="page-link" href="#" data-page="${pageNumber}" onclick="event.preventDefault(); fetchData(${pageNumber});">
                                ${link.label}
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

            // Tangkap perubahan pada semua dropdown filter
            $('#filter-thn-ajaran, #filter-gelombang, #filter-status, #show-entries').change(function() {
                fetchData(1); // Panggil fetchData dengan parameter halaman 1
            });

            // Panggil fetchData saat halaman dimuat pertama kali
            fetchData();

            // Tambahkan event listener untuk tombol hapus
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
                                fetchData(1); // Muat ulang data setelah penghapusan
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
        });
    </script>
@stop
