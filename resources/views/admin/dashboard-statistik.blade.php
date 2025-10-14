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
                            <h3 class="font-weight-bold mb-0" id="totalPendaftar" style="color: #5E7CE3"></h3>
                            <div class="ml-auto" style="color: #5E7CE3">
                                <i class="fas fa-user-plus fa-2x"></i>
                            </div>
                        </div>
                        <p class="mb-0 text-muted">Total Pendaftar</p>
                    </div>
                    <div class="card-footer p-2 text-white bg-basic">
                        <div class="d-flex align-items-center py-2">

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="card p-0 h-100">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-center mb-2">
                            <h3 class="font-weight-bold mb-0" id="totalDiterima" style="color: #10B981;"></h3>
                            <div class="ml-auto " style="color: #10B981;">
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                        </div>
                        <p class="mb-0 text-muted">Total Diterima</p>
                    </div>
                    <div class="card-footer p-2 text-white " style="background: #10B981;">
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
                            <h3 class="font-weight-bold mb-0" id="belumDiperiksa" style="color: #FF7A30;"></h3>
                            <div class="ml-auto " style="color: #FF7A30;">
                                <i class="fas fa-check-circle fa-2x"></i>
                            </div>
                        </div>
                        <p class="mb-0 text-muted">Belum Diperiksa</p>
                    </div>
                    <div class="card-footer p-2 text-white " style="background: #FF7A30;">
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
                            <h3 class="font-weight-bold mb-0" style="color: #EF4444" id="totalDitolak"></h3>
                            <div class="ml-auto" style="color: #EF4444">
                                <i class="fas fa-times-circle fa-2x"></i>
                            </div>
                        </div>
                        <p class="mb-0 text-muted">Total Ditolak</p>
                    </div>
                    <div class="card-footer p-2 text-white" style="background: #EF4444">
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

                {{-- Prestasi Siswa --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-body">                                
                                <div id="highchart2" style=""></div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="row gx-4">
                    {{-- jenis_kelamin --}}
                    <div class="col-lg-6 col-md-6 col-sm-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">                                
                                <div id="highchart1" style="min-width: 250px; height: 300px; margin: 0 auto"></div>
                            </div>
                        </div>
                    </div>
                    {{-- jurusan --}}
                    <div class="col-lg-6 col-md-6 col-sm-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div id="highchart3" style="min-width: 250px; height: 300px; margin: 0 auto"></div>
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
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- chart donut --}}
    <script>
        function createHighchartsPie(containerId, chartTitle, seriesName, seriesData) {
            const total = seriesData.reduce((sum, point) => sum + point.y, 0);

            Highcharts.chart(containerId, {
                chart: {
                    type: 'pie',
                    custom: {},
                    events: {
                        render() {
                            const chart = this,
                                series = chart.series[0];
                            let customLabel = chart.options.chart.custom.label;

                            if (!customLabel) {
                                customLabel = chart.options.chart.custom.label =
                                    chart.renderer.label(
                                        'Total<br/>' +
                                        '<strong>' + total.toLocaleString() + '</strong>'
                                    )
                                    .css({
                                        color: 'var(--highcharts-neutral-color-100, #000)',
                                        textAnchor: 'middle'
                                    })
                                    .add();
                            }

                            const x = series.center[0] + chart.plotLeft,
                                y = series.center[1] + chart.plotTop -
                                (customLabel.attr('height') / 2);

                            customLabel.attr({
                                x,
                                y
                            });
                            customLabel.css({
                                fontSize: `${series.center[2] / 12}px`
                            });
                        }
                    }
                },
                title: {
                    text: chartTitle
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'
                },
                legend: {
                    enabled: true,
                    align: 'center',
                    verticalAlign: 'bottom',
                    layout: 'horizontal'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        innerSize: '50%',
                        dataLabels: [{
                            enabled: true,
                            distance: 15,
                            format: '{point.name}'
                        }, {
                            enabled: true,
                            distance: -30,
                            format: '{point.percentage:.0f}%',
                            style: {
                                fontSize: '0.9em'
                            }
                        }],
                        showInLegend: true
                    },
                    series: {
                        point: {
                            events: {
                                legendItemClick: function() {
                                    return true;
                                }
                            }
                        }
                    }
                },
                series: [{
                    name: seriesName,
                    colorByPoint: true,
                    data: seriesData
                }]
            });
        }

        fetch('{{ route('admin.dashboard.data-counts') }}')
            .then(response => response.json())
            .then(data => {
                document.getElementById('totalPendaftar').innerText = data.totalPendaftar;
                document.getElementById('totalDiterima').innerText = data.totalDiterima;
                document.getElementById('totalDitolak').innerText = data.totalDitolak;
                document.getElementById('belumDiperiksa').innerText = data.belumDiperiksa;
            })
            .catch(error => console.error('Error fetching dashboard counts:', error));


        fetch('{{ route('admin.dashboard.data-gender') }}')
            .then(response => response.json())
            .then(data => {
                const seriesData = data.labels.map((label, index) => ({
                    name: label,
                    y: data.data[index],
                    color: index === 0 ? '#36A2EB' : '#FF6384'
                }));

                createHighchartsPie('highchart1',
                    'Perbandingan jumlah pendaftar laki laki dan perempuan secara keseluruhan',
                    'Jumlah Pendaftar', seriesData);
            })
            .catch(error => console.error('Error fetching gender data:', error));



        fetch('{{ route('admin.dashboard.data-prestasi') }}')
            .then(response => response.json())
            .then(data => {
                const backgroundColors = ['#4BC0C0', '#9966FF', '#FF9F40', '#dshgdhsgsdhdgsh', '#FFCE56', '#C9CBCE'];

                if (data.labels && data.data && data.labels.length > 0) {
                    const seriesData = data.labels.map((label, index) => ({
                        name: label,
                        y: data.data[index],
                        color: backgroundColors[index % backgroundColors.length]
                    }));

                    createHighchartsPie(
                        'highchart2',
                        'Perbandingan Kategori Prestasi Siswa',
                        'Kategori Prestasi',
                        seriesData
                    );
                } else {
                    console.log('Tidak ada data prestasi yang ditemukan.');
                    document.getElementById('highchart2').innerHTML =
                        '<div class="text-center p-5 text-muted">Tidak ada data prestasi yang tercatat.</div>';
                }
            })
            .catch(error => console.error('Error fetching prestasi data:', error));

        fetch('{{ route('admin.dashboard.data-jurusan') }}')
            .then(response => response.json())
            .then(data => {
                const backgroundColors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'];
                if (data.labels && data.data && data.labels.length > 0) {
                    const seriesData = data.labels.map((label, index) => ({
                        name: label,
                        y: data.data[index],
                        color: backgroundColors[index % backgroundColors.length]
                    }));

                    createHighchartsPie(
                        'highchart3',
                        'Perbandingan Jumlah Pendaftar Berdasarkan Jurusan',
                        'Jurusan',
                        seriesData
                    );
                } else {
                    console.log('Tidak ada data jurusan yang ditemukan.');
                    document.getElementById('highchart3').innerHTML =
                        '<div class="text-center p-5 text-muted">Tidak ada data jurusan yang tercatat.</div>';
                }
            })
            .catch(error => console.error('Error fetching jurusan data:', error));
    </script>


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
