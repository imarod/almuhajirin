<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masuk | {{ config('app.name', 'PPDB') }}</title>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <style>
        .rounded-xl {
            border-radius: 2rem !important;
        }

        .min-vh-100 {
            min-height: 100vh;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center p-3 p-md-5">
        <div class="row w-100 bg-white rounded-xl shadow-lg" style="max-width: 900px; min-height: 600px;">
            <div class="col-lg-6 p-5 bg-white d-flex flex-column justify-content-center">
                <header class="mb-5">
                    <div class="h5 font-weight-bold text-muted">
                        <a href="{{ url('/') }}"><b>Al Muhajirin</b></a>
                    </div>
                </header>

                <main class="mb-4">
                    @yield('content')
                </main>
            </div>
             <div
                class="col-lg-6 bg-basic text-white rounded-xl p-5 d-none d-lg-flex justify-content-center align-items-center flex-column">
                <h3 class="text-center font-weight-bold">The Chainsmokerssss🔥</h3>
                <p class="text-center small">Ilustrasi Kanan (Membutuhkan CSS dan Gambar Kustom)</p>
            </div>
        </div>
    </div>
    @yield('js')
</body>

</html>
