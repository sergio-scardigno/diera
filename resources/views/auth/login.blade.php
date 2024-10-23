@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>{{ __('INICIAR SESIÓN') }}</b></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf   
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de usuario') }}</label>

                            <div class="col-md-3">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-3">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordarme') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Acceder') }}
                                </button>

                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Olvidaste tu password?') }}
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                        <br>
                        <blockquote class="blockquote mb-0">
                          <p> Para acceder a la carga el sistema solicita un usuario y contraseña. <br>
                            {{-- Como usuario deberá transcribir el Código Provincial (SIN ESPACIOS Y CON LETRAS EN MAYUSCULA)(ej: 0002PP0080) y en contraseña el CUE (9 dígitos sin guión). --}}
                          </p>
                          <footer class="blockquote-footer">Dirección de Información y Estadística <br>
                            Calle 8 N° 713 0800-222-2338 (0221)483-6721 RPV 21402/21340 die.relevamientos@gmail.com</footer>
                        </blockquote>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
