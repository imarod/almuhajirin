{{-- @extends('adminlte::auth.passwords.reset') --}}

@extends('layouts.auth')
@section('content')
    <h2 class="font-weight-bold h2 mb-4">Atur Password Baru</h2>
    <form action="{{route('password.update')}}" method="post">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ $email ?? old('email') }}" required autofocus placeholder="Email">
            @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required
                placeholder="Password Baru">
            @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-group mb-4">
            <input type="password" name="password_confirmation" class="form-control" required
                placeholder="Ulangi Password Baru">
        </div>
        <button type="submit" class="btn btn-primary btn-block mb-4 w-100"
            style="background-color: #5E7CE3; border-color: #5E7CE3;"> Reset Password
        </button>
    </form>
@endsection
