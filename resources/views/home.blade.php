<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Finnnger Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOaGihwPP00+dGwhK9It8xnaYpC7vY7K7Xj/8+j/QpC7vK5O2/TzQ" crossorigin="anonymous">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">

    <style>
        /* Untuk mendekati desain rounded corner besar pada container utama */
        .rounded-xl {
            border-radius: 2rem !important;
            /* Contoh radius besar */
        }

        /* Mengatur tinggi minimum container agar layout vertikal terlihat baik */
        .min-vh-100 {
            min-height: 100vh;
        }

        /* Mengatur background warna di sisi kanan, menggunakan warna utilitas Bootstrap */
    </style>
</head>

<body class="bg-light">
    <div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center p-3 p-md-5">
        <div class="row w-100 bg-white rounded-xl shadow-lg" style="max-width: 900px; min-height: 600px;">
            <div class="col-lg-6 p-5 bg-white d-flex flex-column justify-content-center">
                <header class="mb-4">
                    <p class="h5 font-weight-bold text-muted">Finnnger</p>
                </header>

                <main>
                    <h1 class="font-weight-bold h2 mb-2">Holla,</h1>
                    <h1 class="font-weight-bold h2 mb-4">Welcome Back</h1>
                    <p class="text-muted mb-4 small">Hey, welcome back to your special place</p>
                    <form>
                        <div class="form-group mb-3">
                            <input type="email" class="form-control" id="emailInput" placeholder="stanley@gmail.com"
                                value="stanley@gmail.com">
                        </div>

                        <div class="form-group mb-3">
                            <input type="password" class="form-control" id="passwordInput" placeholder="••••••••••••••"
                                value="••••••••••••••">
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label small" for="rememberMe">
                                    Remember me
                                </label>
                            </div>
                            <a href="{{ route('password.request') }}" class="text-muted small">Forgot Password?</a>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mb-4"
                            style="background-color: #794BC4; border-color: #794BC4;"> Sign In
                        </button>
                    </form>
                </main>

                <footer>
                     @if (Route::has('register'))
                    <small class="text-muted">
                        Don't have an account? <a href="{{ route('register') }}" class="font-weight-bold" style="color: #794BC4;">Sign
                            Up</a>
                    </small>
                    @endif
                </footer>
            </div>

            <div
                class="col-lg-6 bg-basic text-white rounded-xl p-5 d-none d-lg-flex justify-content-center align-items-center flex-column">
                <h3 class="text-center font-weight-bold">Akses Aman</h3>
                <p class="text-center small">Ilustrasi Kanan (Membutuhkan CSS dan Gambar Kustom)</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3R87bbG7f8o7oF2/M8WkR/kE9G1gN0D1N7yE4/M4T7P4W0n6yX4l8L2" crossorigin="anonymous"></script>
</body>

</html>
