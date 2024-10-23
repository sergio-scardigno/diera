@extends('layouts.app')
@section('content')
<div class="container-fluid">{{--  Container  --}}
  <div class="row justify-content-center">  {{--  Center  --}}
    <div class="col-sm-6">  {{--  Datos  --}}
      <div class="card">  {{--  Card  --}}
        <div class="card-header separa_datos"><b>Agregar un nuevo periodo de carga</b></div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <form class="form-horizontal" action="{{ url('addperiodo') }}" method="POST">
            {!! csrf_field() !!} 
            <div class="form-row"><!-- div de form-row  -->
                <div class="col-2">
             <div class="form-group{{ $errors->has('periodo') ? ' has-error' : '' }}">
                <label for="id_periodo">ID Periodo               
                <input id="id_periodo" type="text" class="form-control" name="id_periodo" value="{{ old('id_periodo') }}" required autofocus>
                @if ($errors->has('id_periodo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('idperiodo') }}</strong>
                    </span>
                @endif                               
            </div>
                </div>
            <div class="col-2">
            <div class="form-group{{ $errors->has('periodo') ? ' has-error' : '' }}">
                    <label for="periodo">Periodo                                   
                    <input id="periodo" type="text" class="form-control" name="periodo" value="{{ old('periodo') }}" required autofocus>          
                    @if ($errors->has('periodo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('periodo') }}</strong>
                        </span>
                    @endif                                                         
                </div>
            </div>   
            </div>  {{--  Div form row  --}}
            <div class="form-row">   {{--  div de form-row    --}}
            <div class="col-2">
                <div class="form-group{{ $errors->has('año') ? ' has-error' : '' }}">
                    <label for="año">Año                                   
                        <input id="año" type="number" class="form-control" name="año" value="{{ old('año') }}" required >
                        @if ($errors->has('año'))
                            <span class="help-block">
                                <strong>{{ $errors->first('año') }}</strong>
                            </span>
                        @endif                                     
                </div>
            </div>    
            <div class="col-2">
                <div class="form-group{{ $errors->has('momento') ? ' has-error' : '' }}">
                    <label for="momento">Momento                                   
                        <input id="momento" type="text" class="form-control" name="momento" value="{{ old('momento') }}" required >
                        @if ($errors->has('momento'))
                            <span class="help-block">
                                <strong>{{ $errors->first('momento') }}</strong>
                            </span>
                        @endif                                    
                </div> 
            </div>   
            <div class="col-2">
                <div class="form-group{{ $errors->has('en_carga') ? ' has-error' : '' }}">
                    <label for="en_carga">En carga                                   
                        <input id="en_carga" type="checkbox" class="form-control" name="en_carga" value="{{ old('en_carga') }}"  >
                        @if ($errors->has('en_carga'))
                            <span class="help-block">
                                <strong>{{ $errors->first('en_carga') }}</strong>
                            </span>
                        @endif                                     
                    </div>
            </div>   
            </div> {{--  Div form row  --}}
            <div class="form-row">   {{--  div de form-row    --}}
                <div class="col-2">   
                    <div class="form-group{{ $errors->has('fecha_cortedealtas') ? ' has-error' : '' }}">
                            <label for="fecha_cortedealtas">Fecha de corte alta                                   
                                <input id="en_carga" type="date" class="form-control" name="fecha_cortedealtas" value="{{ old('fecha_cortedealtas') }}"  >
                                @if ($errors->has('fecha_cortedealtas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha_cortedealtas') }}</strong>
                                    </span>
                                @endif                                   
                        </div>
                </div>   
                <div class="col-2">   
                    <div class="form-group{{ $errors->has('fecha_inicio') ? ' has-error' : '' }}">
                        <label for="fecha_inicio">Fecha de inicio                                   
                            <input id="en_carga" type="date" class="form-control" name="fecha_inicio" value="{{ old('fecha_inicio') }}"  >
                            @if ($errors->has('fecha_inicio'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fecha_inicio') }}</strong>
                                </span>
                            @endif                                     
                    </div>
                </div>   
                <div class="col-2">   
                    <div class="form-group{{ $errors->has('fecha_fin') ? ' has-error' : '' }}">
                        <label for="fecha_fin">Fecha fin                            
                            <input id="en_carga" type="date" class="form-control" name="fecha_fin" value="{{ old('fecha_fin') }}"  >
                            @if ($errors->has('fecha_fin'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fecha_fin') }}</strong>
                                </span>
                            @endif                            
                    </div>
                </div> 
            </div> {{--  Div form row  --}}
          
            <div class="form-row">   {{--  div de form-row    --}}
             <div class="col-8">
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Registrar
                        </button>              
                        <a class="btn btn-primary" href="{{ url('/periodo') }}">Volver</a>
                    </div>
                </div>
             </div>

        </div> {{--  Div form row  --}}     
                     
        </form>          
       </li>                
      </ul>
     </div>
    </div>
  </div>
</div> 

@endsection