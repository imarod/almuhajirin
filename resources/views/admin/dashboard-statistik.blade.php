@extends('layouts.adminlte-custom')

@section('content_header')
    <div class="container-fluid mb-3 ">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 font-weight-bold">Dashboard Statistik</h1>
            </div>

        </div>
    </div>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4 ">
                <div class="card p-0 h-100">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-center mb-2">
                            <h3 class="font-weight-bold mb-0 text-primary">125</h3>
                            <div class="ml-auto text-primary">
                                <i class="fas fa-user-plus fa-2x"></i>
                            </div>
                        </div>
                        <p class="mb-0 text-muted">Total Pendaftar</p>
                    </div>
                    <div class="card-footer p-2 text-white"
                        style="background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);">
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
                            <h3 class="font-weight-bold mb-0 text-success">113</h3>
                            <div class="ml-auto text-success">
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                        </div>
                        <p class="mb-0 text-muted">Total Diterima</p>
                    </div>
                    <div class="card-footer p-2 text-white"
                        style="background: linear-gradient(to right, #43e97b 0%, #38b25c 100%);">
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
                            <h3 class="font-weight-bold mb-0 text-danger">12</h3>
                            <div class="ml-auto text-danger">
                                <i class="fas fa-times-circle fa-2x"></i>
                            </div>
                        </div>
                        <p class="mb-0 text-muted">Total Ditolak</p>
                    </div>
                    <div class="card-footer p-2 text-white"
                        style="background: linear-gradient(to right, #ff416c 0%, #ff4b2b 100%);">
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
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="tahunSelect">Tahun Ajaran</label>
                    <select class="form-control" id="tahunSelect">
                        <option>2021</option>
                        <option>2022</option>
                        <option>2023</option>
                        <option selected>2024</option>
                        <option>2025</option>
                        <option>2026</option>
                        <option>2027</option>
                    </select>
                </div>

                <div class="row gx-4">
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title text-center">Perbandingan jumlah pendaftar laki laki dan perempuan
                                    secara keseluruhan</h5>
                                <canvas id="doughnutChart1"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title text-center">Perbandingan Kategori Prestasi Siswa</h5>
                                <canvas id="doughnutChart2"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title text-center">Judul Chart 3</h5>
                                <canvas id="doughnutChart3"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Grafik Perbandingan Jumlah Pendaftar Tahun Ajaran 2024</h5>
                        <canvas id="chartPendaftar"></canvas>
                    </div>
                </div>

                <!-- Grafik Jenis Kelamin -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title text-center">Jumlah Pendaftar Berdasarkan Jenis Kelamin</h5>
                        <canvas id="chartGender"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- chart donut --}}
    <script>
        const data3 = {
            labels: ['Gray', 'Black', 'White'],
            datasets: [{
                label: 'My Third Dataset',
                data: [120, 180, 250],
                backgroundColor: ['#C9CBCE', '#444444', '#DDDDDD'],
                hoverOffset: 4
            }]
        };

        // Fungsi untuk membuat chart dengan konfigurasi kustom
        function createDoughnutChart(canvasId, chartData) {
            new Chart(
                document.getElementById(canvasId), {
                    type: 'doughnut',
                    data: chartData,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                usePointStyle: true,
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += context.parsed;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            )
        }



        // Ambil data untuk Chart 1 (Gender)
        fetch('{{ route('admin.dashboard.data-gender') }}')
            .then(response => response.json())
            .then(data => {
                const chartData = {
                    labels: data.labels,
                    datasets: [{
                        label: 'Jumlah Pendaftar',
                        data: data.data,
                        backgroundColor: ['#36A2EB', '#FF6384'],
                        hoverOffset: 4
                    }]
                };
                createDoughnutChart('doughnutChart1', chartData);
            })
            .catch(error => console.error('Error fetching gender data:', error));

        // Ambil data untuk Chart 2 (Prestasi)
        fetch('{{ route('admin.dashboard.data-prestasi') }}')
            .then(response => response.json())
            .then(data => {
                const backgroundColors = ['#4BC0C0', '#9966FF', '#FF9F40', '#dshgdhsgsdhdgsh', '#FFCE56', '#C9CBCE'];
                const chartData = {
                    labels: data.labels,
                    datasets: [{
                        label: 'Kategori Prestasi',
                        data: data.data,
                        backgroundColor: backgroundColors.slice(0, data.labels.length),
                        hoverOffset: 4
                    }]
                };
                createDoughnutChart('doughnutChart2', chartData);
            })
            .catch(error => console.error('Error fetching prestasi data:', error));


        createDoughnutChart('doughnutChart3', data3);
    </script>


    {{-- chart bar --}}
    {{-- chart bar --}}
    <script>
        fetch('{{ route('admin.dashboard.data-pendaftar-gelombang') }}')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const configPendaftar = {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: data.datasets,
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                        },
                    },
                };
                new Chart(
                    document.getElementById('chartPendaftar'),
                    configPendaftar
                );
            })
            .catch(error => console.error('Error fetching pendaftar data:', error));
    </script>
@endpush
