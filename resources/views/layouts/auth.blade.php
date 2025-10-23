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

<body style="background: linear-gradient(135deg, #2E8B57 0%, #1a5a3a 20%, #3da366 50%, #2E8B57 80%, #1a5a3a 100%); 
             background-attachment: fixed; 
             background-size: 300% 300%; 
             position: relative; 
             min-height: 100vh;
             margin: 0;
             padding: 0;
             overflow-x: hidden;">
    <div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center p-3 p-md-5">
       <div class="row w-100 bg-white rounded-xl" style="max-width: 500px; min-height: 500px; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);">
            {{-- <div
                class="col-lg-6 bg-basic text-white rounded-xl p-5 d-none d-lg-flex justify-content-center align-items-center flex-column">
                <h3 class="text-center font-weight-bold">The Chainsmokerssss🔥</h3>
                <p class="text-center small">Ilustrasi Kanan (Membutuhkan CSS dan Gambar Kustom)</p>
            </div> --}}
            <div class="d-flex flex-column" style="padding-top: 5rem !important;">
                <header class="text-center">
                    <a href="{{ url('/') }}" class="h3 font-weight-bold "
                        style="color: #000000; text-decoration: none;"><b>PPDB MAS Al Muhajirin Tugumulyo</b></a>

                </header>

            </div>
            <div class="p-5 d-flex flex-column justify-content-center" >
                <main class="mb-4" >
                    @yield('content')
                </main>
            </div>

        </div>
    </div>
    @yield('js')
</body>

</html>
