@extends('layouts.app')
@section('content')
<div class="container-fluid">{{--  Container  --}}  
  <div class="row justify-content-center">  {{--  Center  --}}
   <div class="col-sm-6">  {{--  Datos  --}}       
     <div class="card">  {{--  Card  --}}
      <div class="card-header separa_datos"><b> PLANILLAS DE ALTAS, BAJAS Y NOVEDADES DE SERVICIOS EDUCATIVOS  {{$periodo->periodo}}</b></div>
     
        <form class="form-horizontal" action="{{ url('new_pservicio') }}" method="GET">
        {{ csrf_field() }}
        <input name='id_periodo' type="number" value="{{$periodo->id_periodo}}" hidden>
          <ul class="list-group list-group-flush">           
            <li class="list-group-item">
              <div class="form-row">
                <div class="col-3">
                  <label for="distrito">Distrito </label>
                  <select value="" name="distrito" id="distrito" class="form-control focusNext" tabindex="1" required autofocus>
                      <option value="">Todos los distritos</option>  
                        @foreach ($partidos as $element =>$par)   
                            <option value="{{$par->c_departamento}}">{{$par->nombre}}</option>                             
                        @endforeach
                    </select>
                </div>  
                <div class="col-6">
                  <label for="rama">Rama de Enseñanza</label> 
                  <input name='rama' type="text" value="" class="form-control focusNext"  placeholder="Rama de Enseñanza" tabindex="2" required> 
                </div>
              </div><br>
              <div class="form-row">
                  <div class="col-3">
                   <label for="nroestab" >N° Establecimiento</label>
                   <input name='nroestab' type="text" value="" class="form-control focusNext" aria-describedby="nroestabHelp" placeholder="N° Establecimiento" tabindex="3" required> 
                   <small id="nroestabHelp" class="form-text text-muted">Si no tiene número consignar S/N (Sin número).</small>
                  </div>
                  <div class="col-9">    
                   <label for="nombre">Nombre</label>
                    <input name='nombre' type="text" value="" class="form-control focusNext" placeholder="Nombre" tabindex="4" required>
                   </div>    
              </div> <br>
              <div class="form-row">   
                <div class="col-6"> 
                  <label for="domicilio">Calle</label>
                    <input name='domicilio' type="text" value="" class="form-control focusNext" placeholder="Calle" tabindex="5" required >
                </div>
                <div class="col-3"> 
                  <label for="numero">Número</label>
                  <input name='numero' type="text" value="" class="form-control focusNext" placeholder="Número" aria-describedby="numeroHelp" tabindex="6" required>      
                   <small id="numeroHelp" class="form-text text-muted">Si no tiene número de altura consignar S/N (Sin número).</small>
                </div>
              </div><br>
              <div class="form-row">   
                  <div class="col-3"> 
                    <label for="gruopBaja_Alta"></label>
                    <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input focusNext" id="alta" name="gruopAlta_Baja" tabindex="7" value="ALTA" checked>
                      <label class="custom-control-label" for="alta">Alta</label>
                    </div>     
                    <div class="custom-control custom-radio">
                      <input type="radio" class="custom-control-input focusNext" id="baja" name="gruopAlta_Baja" tabindex="8" value="BAJA">
                      <label class="custom-control-label" for="baja">Baja</label>
                    </div>                      
                  </div>
                  <div class="col-6"> 
                    <label for="causa">Causa</label>
                    <input name='causa' type="text" value="" class="form-control focusNext" placeholder="Causa del alta o baja" tabindex="9">    
                  </div>  
                  <div class="col-3"> 
                    <label for="fecha">Fecha (a partir de)</label>
                     <input name='fecha' type="date" value="" class="form-control focusNext" placeholder="Fecha del alta o baja" tabindex="10">  
                  </div>  
                </div> <br>
                <div class="form-row">
                  <div class="col-12">
                    <label for="observ">Observaciones</label>
                    <input name='observ' type="textarea" value="" class="form-control focusNext" placeholder="Observaciones" tabindex="11">  
                  </div>
                </div><br>                
                <div class="col-md-12 offset-md-5">   
                  {{Form::button('Grabar', array('type' => 'submit', 'value'=>'grabar', 'class' => 'btn btn-primary', 'title'=>'Grabar datos'))}}
                  {{Form::button('Limpiar', array( 'id'=>'limpiar', 'class' => 'btn btn-primary', 'title'=>'Limpiar formulario'))}}
                  {{-- <input type="reset" value="Reset"> --}}
                </div>    
                   
            </li>
          </ul>    
          <small class="form-text text-muted"> Consignar los servicios educativos que se han cerrado, creado o reabierto durante el corriente ciclo lectivo.</small>
        {!! Form::close()!!} 
        {{-- </form>   --}}
      </div> {{-- div card --}}
    </div>  {{--  Datos  --}} 
  </div> {{--  Center  --}}

  <div class="row justify-content-center">  {{--  Center  --}}
    <div class="col-sm-12">  {{--  Datos  --}}       
      <div class="card">  {{--  Card  --}}
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <table>
              <tr>
                {!!Form::open(['id'=>'form_servicios','route'=>array('pservicio', $periodo->id_periodo ),'method'=>'GET','class'=>'navbar-form navbar-left','role'=>'search'])!!} 
                {!! csrf_field() !!} 
                <th>           
                      <label for="distrito">Distrito
                      <select value="" name="distrito" id="distrito" class="form-control">
                          <option value="">Todos los distritos</option>  
                            @foreach ($partidos as $element =>$par)
                              @if ($par->c_departamento==$filtro_servicio['filter_distrito'])
                                <option value="{{$par->c_departamento}}" selected="selected">{{$par->nombre}}</option>
                              @else 
                                <option value="{{$par->c_departamento}}">{{$par->nombre}}</option>
                              @endif
                            @endforeach              
                        </select>
                    </label>
                    </th> 
                <th width="100px">
                  <label for="nronota2">Nro de nota
                  <input name='nronota2' type="number" value="{{$filtro_servicio['filter_nronota']}}"  min="0" class="form-control"></label></th>
                <th>            
                    {{Form::button('Aplicar filtro', array('type' => 'submit',   'name' => 'submitbutton',
                    'value'=>'filter-true2', 'class' => 'btn btn-primary', 'title'=>'Aplicar filtro a la grilla'))}}
                </th>
                <th>  
                    @if ($filtro_servicio['filter_aplicado2'])
                      {{Form::button('Quitar filtro', array('type' => 'submit',  'name' => 'submitbutton',
                      'value'=>'filter-false2', 'class' => 'btn btn-primary', 'title'=>'Quitar filtro a la grilla'))}}     
                   @endif 
                </th>
                {!! Form::close()!!}     
                <th>
                    <form action="{{ url('grilla_excel_pservicios',[$periodo->id_periodo]) }}" method="GET"> 
                        {!! csrf_field() !!}                                   
                        <input name='distrito' type="text" value="{{$filtro_servicio['filter_distrito']}}" hidden>
                        <input name='nronota2' type="number" value="{{$filtro_servicio['filter_nronota']}}" hidden >
                            <th> {{Form::button('Exportar a Excel', array('type' => 'submit',  'name' => 'excel',
                              'value'=>'excel', 'class' => 'btn btn-primary', 'title'=>'Exportar grilla a excel'))}}   </th>
                      {!! Form::close()!!}    
                </th>
             </tr>
            </table>
            <div class="table-responsive">                   
              <table class="table table-md table-hover">                     
                <thead class="thead-dark">
                  <tr >          
                      <th>Distrito</th>
                      <th>Rama</th>
                      <th>N° Establecimiento</th>
                      <th>Nombre</th>                                       
                      <th>Responsable</th>
                      <th>Nro de nota</th>
                      <th colspan="4"></th>
                </tr> 
                </thead>  
                <tbody>
                    @foreach ($servicios_educativos as $element =>$u)  
                    <tr>
                    <td>{{$u->codigo_distrito}} - {{$u->distrito}}</td>
                     <td>{{$u->rama}}</td>
                     <td>{{$u->esc_nro}}</td>                    
                     <td>{{$u->nombre}}</td>     
                     <td>{{$u->name}}</td>
                     <td>{{$u->nronota}}</td>
                     <td>{{$u->alta_baja}}</td>               
                     @if ($u->nronota == 0)
                     <td>                
                      <form action=" {{ url('edit_servicio_educativo',[$u->id]) }}" method="POST">
                        {{ csrf_field() }}                       
                        {{Form::button('<i class="fa fa-edit"></i>', 
                          array('type' => 'submit', 'value'=>'Editar', 'title'=>'Modificar datos', 'class' => 'btn btn-primary'
                          ))}}
                      </form> 
                    </td>   
                    <td>          
                      <form action=" {{ url('eliminarservicio',[$u->id]) }}" method="POST">
                        {{ csrf_field() }}                      
                        {{Form::button('<i class="fa fa-trash-o icon-background2" style="font-size:20px; color:#e20909"></i>', 
                        array('type' => 'submit', 
                          'value'=>'eliminadatos', 'onclick'=>'return confirm("Eliminar el servicio?")','title'=>'Eliminar el servicio'
                        ))}}
                      </form> 
                     </td>
                   
                   @else 
                    @role('admin|supervisor|editor')
                      <td>                
                          <form action=" {{ url('edit_servicio_educativo',[$u->id]) }}" method="POST">
                            {{ csrf_field() }}                       
                            {{Form::button('<i class="fa fa-edit"></i>', 
                              array('type' => 'submit', 'value'=>'Editar', 'title'=>'Modificar datos', 'class' => 'btn btn-primary'
                              ))}}
                          </form> 
                        </td> 
                      @endrole    
                    @endif  
                    @role('admin|supervisor|editor')
                    <td>                
                        <form action=" {{ url('print_planilla_servicios',[$u->id]) }}" method="POST">                            
                          {{ csrf_field() }}                       
                          {{Form::button('<i class="fa fa-print"></i>', 
                            array('type' => 'submit', 'value'=>'print', 'title'=>'Imprimir planilla', 'class' => 'btn btn-primary'
                            ))}}
                        </form> 
                      </td> 
                    @endrole   
                   </tr>
                   @endforeach           
                </tbody>   
              </table>
            </div>
          </li>
        </ul>
        <ul class="pagination justify-content-center">       
            {!! $servicios_educativos->appends(Request::capture()->except('page'))->render() !!} 
        </ul>

      </div> {{-- div card --}}
    </div>  {{--  Datos  --}} 
   </div> {{--  Center  --}}
</div>  {{--  Container  --}}  

@stop
@section('js') 
  <script>
      $(document).ready(function() {
        $('#limpiar').click(function() {
          console.log('limpio');
          $('input[type="text"]').val('');
        });
      });
  </script> 
@stop
