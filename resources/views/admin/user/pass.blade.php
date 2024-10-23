@extends('layouts.app')

@section('content')
<div class="container-fluid">{{--  Container  --}}
    <div class="row justify-content-center">  {{--  Center  --}}
       <div class="col-sm-6">  {{--  Datos  --}}
          <div class="card">  {{--  Card  --}}
            <div class="card-header separa_datos"><b>Modificar usuario</b></div>
             <ul class="list-group list-group-flush">
                <li class="list-group-item">
                        {!!Form::model($user,['url'=>['saveuserpass',$user->id], 'class'=>'form-horizontal' ,'method'=>'POST']) !!}                                    
                        {!! csrf_field() !!}         

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
                       <div class="form-group">
                           <div class="col-md-6 col-md-offset-4">
                               <button type="submit" class="btn btn-primary">
                                   Modificar
                               </button>              
                             <a class="btn btn-primary" href="{{ url('/usuarios') }}">Volver</a>
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
