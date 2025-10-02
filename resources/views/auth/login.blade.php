@extends('layouts.auth')

@section('content')
    <h2 class="font-weight-bold h2 mb-4">Masuk Akun</h2>
    {{-- <h1 class="font-weight-bold h2 mb-4">Selamat Datang Di </h1>
    <p class="text-muted mb-4 small">Hey, welcome back to your special place</p> --}}

    <form action="{{ route('login') }}" method="post">
        @csrf

        <div class="form-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" required autofocus placeholder="Email">
            @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required
                placeholder="Password">
            @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label small" for="rememberMe">
                    Ingat saya
                </label>
            </div>
            <a href="{{ route('password.request') }}" class="text-muted small">Lupa Password?</a>
        </div>

        <button type="submit" class="btn btn-primary btn-block mb-4 w-100"
            style="background-color: #5E7CE3; border-color: #5E7CE3;"> Masuk
        </button>
    </form>
    <footer class="d-flex justify-content-center">
        @if (Route::has('register'))
            <small class="text-muted ">
                Belum punya akun? <a href="{{ route('register') }}" class="font-weight-bold"
                    style="color: #5E7CE3;">Daftar</a>
            </small>
        @endif
    </footer>
    {{-- 
    <p class="mb-1">
        <a href="{{ route('password.request') }}">Saya lupa kata sandi saya</a>
    </p>
    @if (Route::has('register'))
        <p class="mb-0">
            <a href="{{ route('register') }}" class="text-center">Daftar anggota baru</a>
        </p>
    @endif --}}
@endsection
