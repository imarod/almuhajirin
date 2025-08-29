@extends('adminlte::page')


@section('css')
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('js')
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous">
    </script>
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
