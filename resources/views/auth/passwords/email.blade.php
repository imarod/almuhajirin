{{-- @extends('adminlte::auth.passwords.email') --}}

@extends('layouts.auth')
@section('content')
    <h4 class="font-weight-bold  mb-3">Reset Password</h4>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('password.email') }}" method="post">
        @csrf

        <div class="form-group mb-4">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" required autofocus placeholder="Email">
            @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-block mb-4 w-100"
            style="background-color: #2E8B57; border-color: #2E8B57;"> Kirim Tautan Reset Password
        </button>
    </form>

     <footer class="d-flex justify-content-center">
        <small class="text-muted">
            Kembali ke <a href="{{ route('login') }}" class="font-weight-bold" style="color: #2E8B57;;">Masuk</a>
        </small>
    </footer>
@endsection
