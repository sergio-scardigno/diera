@extends('layouts.app')
@section('content')

<div class="container-fluid">{{--  Container  --}}
    <div class="row justify-content-center">  {{--  Center  --}}
       <div class="col-sm-6">  {{--  Datos  --}}
          <div class="card">  {{--  Card  --}}
            <div class="card-header separa_datos"><b>Modificar usuario</b></div>
             <ul class="list-group list-group-flush">
                <li class="list-group-item">
      
                    {!!Form::model($user,['url'=>['saveuser',$user->id], 'class'=>'form-horizontal' ,'method'=>'POST']) !!}
                    {!! csrf_field() !!} 
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">                          
                    {!!Form::label('name', 'Nombre', ['class' => 'col-md-4 control-label']); !!}
                    <div class="col-md-6">
                        {!! Form::text('name', null, ['id'=>'name','class'=>'form-control']) !!}
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    </div>
                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        {!!Form::label('username', 'Usuario', ['class' => 'col-md-4 control-label']); !!}

                    <div class="col-md-6">
                            {!! Form::text('username', null, ['id'=>'username','class'=>'form-control']) !!}
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
                            {!! Form::email('email',null,['id'=>'email','class'=>'form-control']) !!}
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    </div>

                    <div class="form-group{{ $errors->has('activo') ? ' has-error' : '' }}">
                    {!!Form::label('activo', 'Activo', ['class' => 'col-md-4 control-label']); !!}
                    {{ Form::checkbox('activo', 1, null, ['class' => 'field']) }}
                    </div>

                    <div class="form-group{{ $errors->has('id_perfil') ? ' has-error' : '' }}">   
                    {!!Form::label('id_perfil', 'Perfil', ['class' => 'col-md-4 control-label']); !!}
                    <div class="col-md-6">                 
                    {!! Form::select('id_perfil',$perfil, $user->role_id, ['class'=>'form-control']) !!}
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
                            Modificar
                        </button>                                      
                        <a class="btn btn-primary" href="{{ route('usuarios') }}">Volver</a>
                    </div>
                    </div>

                    {!!Form::close()!!}
                </li>                
            </ul>
         </div>
      </div>
   </div>
</div> 
@endsection
