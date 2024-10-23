@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header separa_datos"><b>VERIFICACIÓN DE DATOS</b></div>
         <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <h3><b>{{$formulario->esc_nombre}}  <br>Código jurisdiccional: {{$formulario->codigo_jurisdiccional}} - Cueanexo {{$formulario->cueanexo}}</b></h3> 
            </li>
            <li class="list-group-item separa_datos">DOMICILIO INSTITUCIONAL</li>         
            {!!Form::model($formulario,['id'=>'id_localizacion_periodo', 'url'=>['verificacion_datos', $formulario->id_localizacion_periodo],'method'=>'POST'])!!}     
              {{ csrf_field() }}
            <li class="list-group-item">              
            
                <div class="form-row"><!-- div de form-row  -->
                  <div class="col-6">
                    <label for="calle">Calle</label>
                    <input type="text" class="form-control focusNext" name="calle" id="calle" aria-describedby="calleHelp" value="{{$formulario->calle}}" tabindex="1" required autofocus>
                    @if ($errors->has('calle'))
                      <span class="text-danger">{{ $errors->first('calle') }}</span>
                    @endif
                 </div> <!-- div de col  -->
                 <div class="col-2">
                    <label for="numero">Número</label>
                    <input type="text" class="form-control focusNext" name="numero" id="numero" aria-describedby="numeroHelp" value="{{$formulario->nro}}" tabindex="2" required>
                    <small id="numeroHelp" class="form-text text-muted">Si no tiene número de altura consignar S/N (Sin número).</small>
                    @if ($errors->has('numero'))
                    <span class="text-danger">{{ $errors->first('numero') }}</span>
                    @endif
                 </div> <!-- div de col  --> 
               </div> <!-- fin div de form-row  -->      
               <br>
               <div class="form-row"> <!-- div de form-row  -->        
                    <div class="col-6">
                        <label for="calle_lateral_derecha">Calle lateral derecha </label>
                        <input type="text" class="form-control focusNext" name="calle_lateral_derecha" id="calle_lateral_derecha" aria-describedby="calle_lateral_derechaHelp" value="{{$formulario->calle_lateral_derecha}}" tabindex="3">
                        <small id="calle_lateral_derechaHelp" class="form-text text-muted">Para completar la información de las calles laterales ubíquese de frente a la puerta de entrada del edificio.</small>
                        @if ($errors->has('calle_lateral_derecha'))
                        <span class="text-danger">{{ $errors->first('calle_lateral_derecha') }}</span>
                        @endif
                    </div> <!-- div de col  --> 
                    <div class="col-6">
                        <label for="calle_lateral_izquierda">Calle lateral izquierda </label>
                        <input type="text" class="form-control focusNext" name="calle_lateral_izquierda" id="calle_lateral_izquierda" aria-describedby="calle_lateral_izquierdaHelp" value="{{$formulario->calle_lateral_izquierda}}" tabindex="4">                       
                        @if ($errors->has('calle_lateral_izquierda'))
                        <span class="text-danger">{{ $errors->first('calle_lateral_izquierda') }}</span>
                        @endif
                    </div> <!-- div de col  --> 
               </div>  
                <br>
                    <div class="form-row"> <!-- div de form-row  -->       
                        <div class="col-4">
                            <label for="departamento">Distrito</label>
                            <input type="text" class="form-control focusNext" name="departamento" id="departamento" aria-describedby="departamentoHelp" 
                            value="{{$formulario->departamento}}" tabindex="6" readonly>
                            @if ($errors->has('departamento'))
                                <span class="text-danger">{{ $errors->first('departamento') }}</span>
                            @endif
                         <!--   <label for="distrito">Distrito </label>
                             <select value="" name="departamento" id="departamento" class="form-control focusNext" tabindex="1" required autofocus>                                
                                    @foreach ($partidos as $element =>$par)      
                                      @if ($formulario->c_departamento==$par->c_departamento)
                                        <option value="{{$par->c_departamento}}" selected="selected">{{$par->nombre}}</option>
                                       @else 
                                       <option value="{{$par->c_departamento}}">{{$par->nombre}}</option> 
                                     @endif                    
                                        
                                    @endforeach
                              </select> -->
                        

                        </div> <!-- div de col  -->
                        <div class="col-4">
                            <label for="localidad">Localidad</label>
                            <!-- <input type="text" class="form-control focusNext" name="localidad" id="localidad" aria-describedby="localidadHelp" value="{{$formulario->localidad}}" tabindex="7">
                            @if ($errors->has('localidad'))
                                <span class="text-danger">{{ $errors->first('localidad') }}</span>
                            @endif -->
                            <select value="" name="localidad" id="localidad" class="form-control focusNext" tabindex="1" required autofocus>
                                <!-- <option value="">Todos los distritos</option>   -->
                                    @foreach ($localidad as $element =>$local)      
                                      @if ($formulario->c_localidad==$local->c_localidad)
                                        <option value="{{$local->c_localidad}}" selected="selected">{{$local->nombre}}</option>
                                       @else 
                                       <option value="{{$local->c_localidad}}">{{$local->nombre}}</option> 
                                     @endif                    
                                        
                                    @endforeach
                              </select>

                        </div> <!-- div de col  -->
                        <div class="col-1">
                            <label for="cp">Código Postal</label>      
                            <input type="text" class="form-control focusNext" name ="cp" id="cp" aria-describedby="cpHelp" value="{{$formulario->cod_postal}}" tabindex="5">
                            @if ($errors->has('cp'))
                                <span class="text-danger">{{ $errors->first('cp') }}</span>
                            @endif
                        </div> <!-- div de col  -->

                    </div> <!-- div de form-row  -->     
                    <br>
                    <div class="form-row"> <!-- div de form-row  -->        
                    <div class="col-2">
                        <label for="telefono_cod_area">Código de área </label>
                        <input type="text" class="form-control focusNext" name="telefono_cod_area" id="telefono_cod_area" aria-describedby="telefono_cod_areaHelp" value="{{$formulario->telefono_cod_area}}" tabindex="8" required>                        
                        @if ($errors->has('telefono_cod_area'))
                        <span class="text-danger">{{ $errors->first('telefono_cod_area') }}</span>
                        @endif
                    </div> <!-- div de col  --> 
                    <div class="col-2">
                      <label for="telefono">Teléfono </label>
                        <input type="text" class="form-control focusNext" name="telefono" id="telefono" aria-describedby="telefonoHelp" value="{{$formulario->telefono}}" tabindex="9" required>                   
                        @if ($errors->has('telefono'))
                        <span class="text-danger">{{ $errors->first('telefono') }}</span>
                        @endif
                    </div> <!-- div de col  -->  
                  </div>  
                <br>         
                <div class="form-row"> <!-- div de form-row  -->              
                    <div class="col-6">
                      <label for="email">E-mail </label>
                        <input type="email" class="form-control focusNext" name="email" id="email" aria-describedby="emailHelp" value="{{$formulario->email}}" tabindex="10" required>                        
                        @if ($errors->has('email'))
                          <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div> <!-- div de col  --> 
                    <div class="col-6">
                      <label for="email2">Otro E-mail </label>
                        <input type="email" class="form-control focusNext"  name="email2" id="email2" aria-describedby="email2Help" value="{{$formulario->email2}}" tabindex="11">                        
                        @if ($errors->has('email2'))
                          <span class="text-danger">{{ $errors->first('email2') }}</span>
                        @endif
                    </div> <!-- div de col  --> 
                  </div>
            </li>
            <li class="list-group-item separa_datos">Responsable</li>            
            <li class="list-group-item">
              <div class="form-row"> <!-- div de form-row  -->              
                <div class="col-6">
                  <label for="responsable">Apellido y Nombre </label>
                    <input type="text" class="form-control focusNext" name="responsable" id="responsable" aria-describedby="responsableHelp" value="{{$formulario->responsable}}" tabindex="12" required>                        
                    @if ($errors->has('responsable'))
                      <span class="text-danger">{{ $errors->first('responsable') }}</span>
                    @endif
                </div> <!-- div de col  --> 
                <div class="col-6">
                  <label for="email_resp">E-mail </label>
                    <input type="email" class="form-control focusNext" name="email_resp" id="email_resp" aria-describedby="email_respHelp" value="{{$formulario->email_resp}}" tabindex="13" required>                        
                    @if ($errors->has('email2'))
                      <span class="text-danger">{{ $errors->first('email_resp') }}</span>
                    @endif
                </div> <!-- div de col  --> 
              </div>
            </li>        
              <div class="col-md-12 offset-md-5">   
                  {{Form::button('Confirmar datos', 
                  array('type' => 'submit',                   
                        'value'=>'grabar', 'class' => 'btn btn-primary', 'title'=>'Confirmar datos'))}}                            
              </div>                
            {!! Form::close()!!} 
         </ul>

       
     </div> 
    </div>
  </div>
</div>

@endsection
