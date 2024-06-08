@extends('auth.index')

@section('content')
<div class="login">
    <div class="row justify-content-center w-100 flex-column align-items-center">
        <div class="logo-login">
            <img src="{{ asset('images/logo/logo-v1.png')}}" alt="">
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" id="form">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('validation.attributes.email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('validation.attributes.password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Ingresar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection