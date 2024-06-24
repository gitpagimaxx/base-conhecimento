<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ env('APP_NAME') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="container">
            <div class="row m-4 p-4">
                <div class="col">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header"><b>Registrar</b></div>

                                <div class="card-body">
                                <form method="POST" action="{{ route('register') }}">
                                @csrf

                                    <!-- Name -->
                                    <div class="form-group row">
                                        <label for="name" class="col-md-2 col-form-label text-md-left">{{ __('Nome') }}</label>

                                        <div class="col-md">
                                            <input id="email" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Seu nome" required autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Email Address -->
                                    <div class="form-group row">
                                        <label for="email" class="col-md-2 col-form-label text-md-left">{{ __('E-mail') }}</label>

                                        <div class="col-md">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Insira seu melhor e-mail" required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group row">
                                        <label for="password" class="col-md-2 col-form-label text-md-left">{{ __('Senha') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Informe uma senha" required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="form-group row">
                                        <label for="password_confirmation" class="col-md-2 col-form-label text-md-left">&nbsp;</label>

                                        <div class="col-md-6">
                                            <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confime a senha" value="{{ old('password') }}" required>

                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mt-4">
                                        <div class="col-md-8 offset-md-2">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Registrar') }}
                                            </button>

                                            <a class="btn btn-link" href="{{ route('login') }}">
                                                {{ __('Já está registrado?') }}
                                            </a>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>
