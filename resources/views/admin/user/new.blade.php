@extends('layouts.app')

@section('content')
<div class="container-fluid">{{--  Container  --}}
    <div class="row justify-content-center">  {{--  Center  --}}
       <div class="col-sm-6">  {{--  Datos  --}}
          <div class="card">  {{--  Card  --}}
            <div class="card-header separa_datos"><b>Agregar un nuevo usuario</b></div>
             <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <form class="form-horizontal" action="{{ url('adduser') }}" method="POST">
                        {!! csrf_field() !!} 
                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="col-md-4 control-label">Nombre</label>
                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                              @if ($errors->has('name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                          <label for="username" class="col-md-4 control-label">Usuario</label>

                          <div class="col-md-6">
                              <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                              @if ($errors->has('username'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('username') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">                    
                         {!!Form::label('email', 'E-Mail', ['class' => 'col-md-4 control-label']); !!}
                          <div class="col-md-6">
                              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                              @if ($errors->has('email'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <label for="password" class="col-md-4 control-label">Contraseña</label>
                          <div class="col-md-6">
                              <input id="password" type="password" class="form-control" name="password" required>
                              @if ($errors->has('password'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña</label>
                          <div class="col-md-6">
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                          </div>
                      </div>

                    <div class="form-group{{ $errors->has('activo') ? ' has-error' : '' }}">
                      {!!Form::label('activo', 'Activo', ['class' => 'col-md-4 control-label']); !!}                     
                        {{ Form::checkbox('activo', 1, true, ['class' => 'field']) }}                                         
                    </div>

                     <div class="form-group{{ $errors->has('id_perfil') ? ' has-error' : '' }}">
                          <label for="id_perfil" class="col-md-4 control-label">Perfil</label>

                          <div class="col-md-6">
                              <select name="id_perfil" id="id_perfil" class="form-control">                                
                                    @foreach ($perfil as $perfil)
                                      <option value="{{ $perfil->id }}">{{ $perfil->name }}</option>                  
                                    @endforeach
                              </select>  
                              @if ($errors->has('id_perfil'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('id_perfil') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                         <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-primary">
                                  Registrar
                              </button>              
                            <a class="btn btn-primary" href="{{ url('/usuarios') }}">Volver</a>
                          </div>
                      </div>
                     
                  </form>         
                </li>             
             </ul>
          </div>
       </div>
    </div>
</div> 
@endsection