@extends('layouts.adminlte-custom')

@section('content_header')
    <div class="container-fluid mb-3 ">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 font-weight-bold" style="color:#333333">Dashboard Statistik</h1>
            </div>

        </div>
    </div>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6  ">
                <div class="card p-0 h-75">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-center mt-4">
                            <h3 class="font-weight-bold mb-0"
                                style="color:  #3F51B5;font-size: calc(1.325rem + 0.9vw) !important;" id="totalPendaftar">
                            </h3>
                            <div class="ml-auto" style="color: #3F51B5">
                                <i class="fas fa-user-plus fa-lg"></i>
                            </div>
                        </div>
                        <p class="mb-0" style="">Total Pendaftar</p>
                    </div>
                    <div class="card-footer p-2 text-white" style="background-color: #3F51B5">
                        <div class="d-flex align-items-center py-2">

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 ">
                <div class="card p-0 h-75">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-center mt-4">
                            <h3 class="font-weight-bold mb-0"
                                style="color:  #2E8B57;font-size: calc(1.325rem + 0.9vw) !important;" id="totalDiterima">
                            </h3>
                            <div class="ml-auto " style="color: #2E8B57;">
                                <i class="fas fa-check-circle fa-lg"></i>
                            </div>
                        </div>
                        <p class="mb-0">Total Diterima</p>
                    </div>
                    <div class="card-footer p-2 text-white " style="background: #2E8B57;">
                        <div class="d-flex align-items-center py-2">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 ">
                <div class="card p-0 h-75">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-center mt-4">
                            <h3 class="font-weight-bold mb-0"
                                style="color:  #FF9F40;font-size: calc(1.325rem + 0.9vw) !important;" id="belumDiperiksa">
                            </h3>
                            <div class="ml-auto " style="color: #FF9F40;">
                                <i class="fas fa-hourglass-half fa-lg"></i>
                            </div>
                        </div>
                        <p class="mb-0">Total Belum Diperiksa</p>
                    </div>
                    <div class="card-footer p-2 text-white" style="background-color: #FF9F40;">
                        <div class="d-flex align-items-center py-2">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 ">
                <div class="card p-0 h-75">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-center mt-4">
                            <h3 class="font-weight-bold mb-0"
                                style="color:  #FFCE56;font-size: calc(1.325rem + 0.9vw) !important;" id="totalPerbaikan">
                            </h3>
                            <div class="ml-auto " style="color: #FFCE56;">
                                <i class="fas fa-pen fa-lg"></i>
                            </div>
                        </div>
                        <p class="mb-0">Total Perbaikan Formulir</p>
                    </div>
                    <div class="card-footer p-2 text-white" style="background-color: #FFCE56;">
                        <div class="d-flex align-items-center py-2">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 ">
                <div class="card p-0 h-75">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-center mt-4">
                            <h3 class="font-weight-bold mb-0"
                                style="color:  #E53935;font-size: calc(1.325rem + 0.9vw) !important;" id="totalDitolak">
                            </h3>
                            <div class="ml-auto" style="color: #E53935">
                                <i class="fas fa-times-circle fa-lg"></i>
                            </div>
                        </div>
                        <p class="mb-0">Total Ditolak</p>
                    </div>
                    <div class="card-footer p-2 text-white" style="background-color: #E53935;">
                        <div class="d-flex align-items-center py-2">
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="card">
            <div class="card-body">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="tahunSelect">Tahun Ajaran</label>
                        <select class="form-control" id="tahunSelect">
                            @foreach ($tahunAjaran as $value => $label)
                                <option value="{{ $value }}" {{ $value == $tahunDefault ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Prestasi Siswa --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card shadow h-100 border border-5" style="border-color: #e1e1e1 !important;">
                            <div class="card-body">
                                <div id="highchart2" style=""></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row gx-4">
                    {{-- jenis_kelamin --}}
                    <div class="col-lg-6 col-md-6 col-sm-6 mb-4">
                        <div class="card shadow h-100 border border-5" style="border-color: #e1e1e1 !important;">
                            <div class="card-body">
                                <div id="highchart1" style="min-width: 250px; height: 300px; margin: 0 auto"></div>
                            </div>
                        </div>
                    </div>
                    {{-- jurusan --}}
                    <div class="col-lg-6 col-md-6 col-sm-6 mb-4">
                        <div class="card shadow h-100 border border-5" style="border-color: #e1e1e1 !important;">
                            <div class="card-body">
                                <div id="highchart3" style="min-width: 250px; height: 300px; margin: 0 auto"></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-body shadow h-100 border border-5" style="border-color: #e1e1e1 !important;">
                        <div id="chartPendaftar" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


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
        // chart donut
        function createHighchartsPie(containerId, chartTitle, seriesName, seriesData) {
            const total = seriesData.reduce((sum, point) => sum + point.y, 0);

            Highcharts.chart(containerId, {
                chart: {
                    type: 'pie',
                    custom: {},
                    events: {
                        render() {
                            const chart = this;
                            const series = chart.series[0];

                            if (!chart.customLabel) {
                                chart.customLabel = chart.renderer.label(
                                        'Total<br/><strong>' + total.toLocaleString() + '</strong>'
                                    )
                                    .css({
                                        color: 'var(--highcharts-neutral-color-100, #000)',
                                        textAnchor: 'middle',
                                        fontSize: `${series.center[2] / 12}px`,
                                        textAlign: 'center'
                                    })
                                    .add();
                            }

                            const x = series.center[0] + chart.plotLeft - 22;
                            const y = series.center[1] + chart.plotTop - (chart.customLabel.attr('height') / 2);

                            chart.customLabel.attr({
                                x,
                                y
                            });
                        },

                        // Export custom label
                        beforePrint() {
                            if (this.customLabel) {
                                this.customLabel.destroy();
                                this.customLabel = null;
                                this.render();
                            }
                        },
                        afterPrint() {
                            if (this.customLabel) {
                                this.customLabel.destroy();
                                this.customLabel = null;
                                this.render();
                            }
                        },
                        beforeExport() {
                            if (this.customLabel) {
                                this.customLabel.destroy();
                                this.customLabel = null;
                                this.render();
                            }
                        },
                        afterExport() {
                            if (this.customLabel) {
                                this.customLabel.destroy();
                                this.customLabel = null;
                                this.render();
                            }
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
                            distance: -25,
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
                }],
            });
        }

        // chart bar
        function createHighchartsBar(containerId, chartTitle, categories, seriesData) {
            Highcharts.chart(containerId, {
                chart: {
                    type: 'column'
                },
                title: {
                    text: chartTitle
                },
                xAxis: {
                    categories: categories,
                    title: {
                        text: 'Tahun Ajaran'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Jumlah Pendaftar'
                    }
                },
                tooltip: {
                    headerFormat: '<b>{point.x}</b><br/>',
                    pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                series: seriesData
            });
        }

        function getChartTitle(baseTitle, tahun) {
            return tahun ? `${baseTitle} - Tahun Ajaran ${tahun}` : baseTitle;
        }

        // fungsi untuk load data dashboard berdasarkan tahun
        function loadDashboardData(tahun = null) {
            const queryParam = tahun ? `?tahun=${tahun}` : '';
            const backgroundColors = [
                '#4BC0C0', '#36A2EB', '#3F51B5', '#9966FF', '#EF4444', '#FF9F40', '#FFCE56', '#A3D65C', '#43A047',
            ];

            const titleGender = getChartTitle('Perbandingan jumlah pendaftar laki-laki dan perempuan', tahun);
            const titlePrestasi = getChartTitle('Perbandingan Kategori Prestasi Siswa', tahun);
            const titleJurusan = getChartTitle('Perbandingan Jumlah Pendaftar Berdasarkan Jurusan', tahun);

            fetch('{{ route('admin.dashboard.data-gender') }}' + queryParam)
                .then(response => response.json())
                .then(data => {

                    const container = document.getElementById('highchart1');

                    if (container.chart) {
                        container.chart.destroy();
                    }

                    if (data.labels && data.data && data.labels.length > 0) {
                        const seriesData = data.labels.map((label, index) => ({
                            name: label,
                            y: data.data[index],
                            color: index === 0 ? '#36A2EB' : '#FF6384'
                        }));

                        createHighchartsPie(
                            'highchart1',
                            titleGender,
                            'Jumlah Pendaftar', seriesData);
                    } else {
                         container.innerHTML =
                            '<div class="text-center p-5 text-muted">Tidak ada data gender yang tercatat pada tahun ini.</div>';
                    }

                })
                .catch(error => console.error('Error fetching gender data:', error));

            fetch('{{ route('admin.dashboard.data-prestasi') }}' + queryParam)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('highchart2');

                    if (container.chart) {
                        container.chart.destroy();
                    }

                    if (data.labels && data.data && data.labels.length > 0) {
                        const seriesData = data.labels.map((label, index) => ({
                            name: label,
                            y: data.data[index],
                            color: backgroundColors[index % backgroundColors.length]
                        }));

                        createHighchartsPie(
                            'highchart2',
                            titlePrestasi,
                            'Kategori Prestasi',
                            seriesData
                        );
                    } else {
                        container.innerHTML =
                            '<div class="text-center p-5 text-muted">Tidak ada data kategori prestasi yang tercatat pada tahun ini.</div>';
                    }
                })
                .catch(error => console.error('Error fetching prestasi data:', error));


            fetch('{{ route('admin.dashboard.data-jurusan') }}' + queryParam)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('highchart3');

                    if (container.chart) {
                        container.chart.destroy();
                    }

                    if (data.labels && data.data && data.labels.length > 0) {
                        const seriesData = data.labels.map((label, index) => ({
                            name: label,
                            y: data.data[index],
                            color: backgroundColors[index % backgroundColors.length]
                        }));

                        createHighchartsPie(
                            'highchart3',
                            titleJurusan,
                            'Jurusan',
                            seriesData
                        );
                    } else {
                        container.innerHTML =
                            '<div class="text-center p-5 text-muted">Tidak ada data jurusan yang tercatat pada tahun ini.</div>';
                    }
                })
                .catch(error => console.error('Error fetching jurusan data:', error));

            fetch('{{ route('admin.dashboard.data-pendaftar-gelombang') }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    const seriesData = data.datasets.map(dataset => ({
                        name: dataset.label,
                        data: dataset.data.map(val => Number(val)),
                        color: dataset.backgroundColor
                    }));

                    createHighchartsBar(
                        'chartPendaftar',
                        'Grafik Perbandingan Jumlah Pendaftar Berdasarkan Gelombang',
                        data.labels,
                        seriesData
                    );

                })
                .catch(error => console.error('Error fetching pendaftar data gelombang:', error));
        }

        fetch('{{ route('admin.dashboard.data-counts') }}')
            .then(response => response.json())
            .then(data => {
                document.getElementById('totalPendaftar').innerText = data.totalPendaftar;
                document.getElementById('totalDiterima').innerText = data.totalDiterima;
                document.getElementById('totalDitolak').innerText = data.totalDitolak;
                document.getElementById('belumDiperiksa').innerText = data.belumDiperiksa;
                document.getElementById('totalPerbaikan').innerText = data.totalPerbaikan;
            })
            .catch(error => console.error('Error fetching dashboard counts:', error));


        document.addEventListener('DOMContentLoaded', function() {
            const tahunSelect = document.getElementById('tahunSelect');

            const initialTahun = tahunSelect.value;

            loadDashboardData(initialTahun);

            tahunSelect.addEventListener('change', function() {
                const selectedTahun = this.value;
                loadDashboardData(selectedTahun);
            });
        });
    </script>
@endpush
