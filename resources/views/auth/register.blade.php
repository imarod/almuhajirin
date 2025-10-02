{{-- @extends('adminlte::auth.register') --}}

@extends('layouts.auth')

@section('content')
    <h2 class="font-weight-bold h2 mb-4">Daftar Akun Baru</h2>

    <form action="{{ route('register') }}" method="post">
        @csrf

        <div class="form-group mb-3">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" required autofocus placeholder="Nama Lengkap">
            @error('name')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" required autofocus placeholder="Email">
            @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                value="{{ old('password') }}" required autofocus placeholder="Password">
            @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-group mb-4">
            <input type="password" name="password_confirmation" class="form-control" required placeholder="Ulangi Password">
        </div>
        <button type="submit" class="btn btn-primary btn-block mb-4 w-100"
            style="background-color: #5E7CE3; border-color: #5E7CE3;"> Daftar
        </button>
    </form>
    <footer class="d-flex justify-content-center">
        <small class="text-muted">
            Sudah punya akun? <a href="{{ route('login') }}" class="font-weight-bold" style="color: #5E7CE3;">Masuk</a>
        </small>
    </footer>
@endsection
