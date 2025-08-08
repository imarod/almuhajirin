@extends('adminlte::page')


@section('css')
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('js')
    {{-- page dashboard-statistik --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
