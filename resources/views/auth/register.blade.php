@extends('auth.index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registro</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" id="form">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('validation.attributes.name') }}</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="codigo" class="form-label">{{ __('validation.attributes.codigo') }}</label>
                                <input style="text-transform: uppercase;" id="codigo" type="text"
                                    class="form-control @error('codigo') is-invalid @enderror" name="codigo"
                                    value="{{ old('codigo') }}" required>
                                @error('codigo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('validation.attributes.email') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('validation.attributes.password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation"
                                    class="form-label">{{ __('validation.attributes.password_confirmation') }}</label>
                                <input id="password_confirmation" type="password" class="form-control"
                                    name="password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Enviar
                            </button>
                        </form>
                    </div>
                </div>
                <a href="{{ route('login') }}" class="btn btn-link mt-4 text-center w-100">Iniciar sesión</a>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#spinner').hide();
            });
        </script>
    @endsection
