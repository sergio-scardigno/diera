@extends('layouts.app')
@section('content')
<div class="container-fluid">{{--  Container  --}}
    <div class="row justify-content-center">  {{--  Center  --}}
       <div class="col-sm-6">  {{--  Datos  --}}
          <div class="card">  {{--  Card  --}}
            <div class="card-header separa_datos"><b>Modificar Servicio</b></div>
             <ul class="list-group list-group-flush">
                <li class="list-group-item">      
                <form class="form-horizontal" action="{{ url('edit_pservicio',$servicios_educativos->id) }}" method="POST">
                    {{ csrf_field() }}
                    <input name='id_periodo' type="number" value="{{$servicios_educativos->id_periodo}}" hidden>
                    <ul class="list-group list-group-flush">           
                        <li class="list-group-item">
                        <div class="form-row">
                            <div class="col-3">
                            <label for="distrito">Distrito </label>
                            <select value="" name="distrito" id="distrito" class="form-control focusNext" tabindex="1" required autofocus>
                                <option value="">Todos los distritos</option>  
                                    @foreach ($partidos as $element =>$par)      
                                      @if ($servicios_educativos->distrito==$par->nombre)
                                        <option value="{{$par->c_departamento}}" selected="selected">{{$par->nombre}}</option>
                                       @else 
                                       <option value="{{$par->c_departamento}}">{{$par->nombre}}</option> 
                                     @endif                    
                                        
                                    @endforeach
                                </select>
                            </div>  
                            <div class="col-6">
                            <label for="rama">Rama de Enseñanza</label> 
                            <input name='rama' type="text" value="{{$servicios_educativos->rama}}" class="form-control focusNext"  placeholder="Rama de Enseñanza" tabindex="2" required> 
                            </div>
                        </div><br>
                        <div class="form-row">
                            <div class="col-3">
                            <label for="nroestab" >N° Establecimiento</label>
                            <input name='nroestab' type="text" value="{{$servicios_educativos->esc_nro}}" class="form-control focusNext" aria-describedby="nroestabHelp" placeholder="N° Establecimiento" tabindex="3" required> 
                            <small id="nroestabHelp" class="form-text text-muted">Si no tiene número consignar S/N (Sin número).</small>
                            </div>
                            <div class="col-9">    
                            <label for="nombre">Nombre</label>
                                <input name='nombre' type="text" value="{{$servicios_educativos->nombre}}" class="form-control focusNext" placeholder="Nombre" tabindex="4" required>
                            </div>    
                        </div> <br>
                        <div class="form-row">   
                            <div class="col-6"> 
                            <label for="domicilio">Calle</label>
                                <input name='domicilio' type="text" value="{{$servicios_educativos->calle}}" class="form-control focusNext" placeholder="Calle" tabindex="5" required >
                            </div>
                            <div class="col-3"> 
                            <label for="numero">Número</label>
                            <input name='numero' type="text" value="{{$servicios_educativos->nro}}" class="form-control focusNext" placeholder="Número" aria-describedby="numeroHelp" tabindex="6" required>      
                            <small id="numeroHelp" class="form-text text-muted">Si no tiene número de altura consignar S/N (Sin número).</small>
                            </div>
                        </div><br>
                        <div class="form-row">   
                            <div class="col-3"> 
                                <label for="gruopBaja_Alta"></label>
                                <div class="custom-control custom-radio">
                                 @if ($servicios_educativos->alta_baja =='ALTA')
                                  <input type="radio" class="custom-control-input focusNext" id="alta" name="gruopAlta_Baja" tabindex="7" value="ALTA" checked> 
                                  @else   
                                  <input type="radio" class="custom-control-input focusNext" id="alta" name="gruopAlta_Baja" tabindex="7" value="ALTA">
                                 @endif 
                                <label class="custom-control-label" for="alta">Alta</label>
                                </div>     
                                <div class="custom-control custom-radio">
                                @if ($servicios_educativos->alta_baja =='BAJA')
                                    <input type="radio" class="custom-control-input focusNext" id="baja" name="gruopAlta_Baja" tabindex="8" value="BAJA" checked>
                                @else       
                                    <input type="radio" class="custom-control-input focusNext" id="baja" name="gruopAlta_Baja" tabindex="8" value="BAJA">
                                @endif    
                                <label class="custom-control-label" for="baja">Baja</label>
                                </div>                      
                            </div>
                            <div class="col-6"> 
                                <label for="causa">Causa</label>
                                <input name='causa' type="text" value="{{$servicios_educativos->causa}}" class="form-control focusNext" placeholder="Causa del alta o baja" tabindex="9">    
                            </div>  
                            <div class="col-3"> 
                                <label for="fecha">Fecha (a partir de)</label>
                                <input name='fecha' type="date" value="{{$servicios_educativos->fecha}}" class="form-control focusNext" placeholder="Fecha del alta o baja" tabindex="10">  
                            </div>  
                            </div> <br>
                            <div class="form-row">
                            <div class="col-12">
                                <label for="observ">Observaciones</label>
                                <input name='observ' type="textarea" value="{{$servicios_educativos->observaciones}}" class="form-control focusNext" placeholder="Observaciones" tabindex="11">  
                            </div>
                            </div><br>  
                            @role('admin|supervisor|editor')
                            <div class="form-row">
                                <div class="col-4">
                                    <input name='nronota' type="number" value="{{$servicios_educativos->nronota}}" class="form-control focusNext" placeholder="Número de nota" aria-describedby="nronotaHelp" tabindex="12">      
                                    <small id="nronotaHelp" class="form-text text-muted">Nro de nota para uso interno.</small>
                                </div>
                                <div class="col-4">
                                    <input name='informado' type="text" value="{{$servicios_educativos->created_at}}" class="form-control focusNext" readonly>      
                                    <small id="numerodocHelp" class="form-text text-muted">Fecha de informe del acto</small>
                                 </div>
                              </div><br>
                            @endrole              
                            <div class="col-md-12 offset-md-5">   
                            {{Form::button('Modificar', array('type' => 'submit', 'value'=>'grabar', 'class' => 'btn btn-primary', 'title'=>'Grabar datos'))}}                     
                            <a class="btn btn-primary" href="{{ route('pservicio', $servicios_educativos->id_periodo) }}">Volver</a>
                            </div>       
                        </li>
                    </ul>    
                    <small class="form-text text-muted"> Consignar los servicios educativos que se han cerrado, creado o reabierto durante el corriente ciclo lectivo.</small>
                    {!! Form::close()!!} 
                </li>                
            </ul>
         </div>
      </div>
   </div>
</div> 
@endsection
