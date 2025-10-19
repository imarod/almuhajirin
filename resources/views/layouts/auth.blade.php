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
        .min-vh-100 {
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center p-3 p-md-5">
        <div class="row w-100 bg-white rounded-xl shadow-lg" style="max-width: 500px; min-height: 600px;">
            {{-- <div
                class="col-lg-6 bg-basic text-white rounded-xl p-5 d-none d-lg-flex justify-content-center align-items-center flex-column">
                <h3 class="text-center font-weight-bold">The Chainsmokerssss🔥</h3>
                <p class="text-center small">Ilustrasi Kanan (Membutuhkan CSS dan Gambar Kustom)</p>
            </div> --}}
            <div class="d-flex flex-column" style="padding-top: 5rem !important;">
                <header class="text-center">
                    <h1 style="color: blueviolet">Website PPDB</h1>
                    <a href="{{ url('/') }}" class="h5 font-weight-bold "
                        style="color: rgb(251, 7, 169); text-decoration: none;"><b>MAS Al Muhajirin Tugumulyo</b></a>

                </header>

            </div>
            <div class="p-5  d-flex flex-column justify-content-center" >



                <main class="mb-4" >
                    @yield('content')
                </main>
            </div>

        </div>
    </div>
    @yield('js')
</body>

</html>
