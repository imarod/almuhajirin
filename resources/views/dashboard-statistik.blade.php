@extends('adminlte::page')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard Statistik</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Pendaftar</li>
                    </ol>
                </div><!-- /.col -->
            </div>


            <div class="card">
                <div class="card-body">
                    <!-- Kotak ringkasan -->
                    <div class="row">
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>125</h3>
                                    <p>Total Pendaftar</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>113</h3>
                                    <p>Total Diterima</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>12</h3>
                                    <p>Total Ditolak</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown Tahun Ajaran -->
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

                    <!-- Grafik Pendaftaran -->
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
    </div>


    <script>
        const labels = ['2021', '2022', '2023', '2024', '2025', '2026', '2027'];

        const dataPendaftar = {
            labels: labels,
            datasets: [{
                    label: 'Gelombang 1',
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    data: [63, 17, 34, 20, 54, 15, 57],
                },
                {
                    label: 'Gelombang 2',
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    data: [42, 50, 33, 62, 82, 23, 53],
                },
                {
                    label: 'Total Pendaftar',
                    backgroundColor: 'rgba(255, 159, 64, 0.6)',
                    data: [111, 67, 67, 82, 102, 70, 110],
                }
            ]
        };

        const configPendaftar = {
            type: 'bar',
            data: dataPendaftar,
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

        // Reuse data for gender if similar (you can modify if needed)
        new Chart(
            document.getElementById('chartGender'),
            configPendaftar
        );
    </script>
@endsection
