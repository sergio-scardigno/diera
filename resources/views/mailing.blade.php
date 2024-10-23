@extends('layouts.app')
@section('css')
     <style>             
      .loader {
         position: fixed;
         left: 0px;
         top: 0px;
         width: 100%;
         height: 100%;
         z-index: 9999;
         background: url('../../images/Preloader_3.gif') 50% 50% no-repeat rgb(249,249,249);
         opacity: .8;
      }
     </style>
@stop
@section('content')
  <div class="panel-body">        
    <div class="panel panel-default">       
      <div class="loader"></div>           
    </div> 
   
    <h3>Periodo seleccionado {{$periodo->periodo}}</h3>

    <table><tr>    
      {!!Form::open(['id'=>'form_localizacion','route'=>array('mailing', $periodo->id_periodo ),'method'=>'GET','class'=>'navbar-form navbar-left','role'=>'search'])!!} 
          {{--  {!! csrf_field() !!}   --}}
       
        <th width="130px">
            <label for="codigo_jurisdiccional">Código Jurisdiccional
          <input name='codigo_jurisdiccional' type="text" value="{{ $filtro['filter_clave'] }}" class="form-control" placeholder="Cod. Jurisdiccional"></label></th>
        <th><label for="nombre">Nombre
          <input name='nombre' type="text" value="{{ $filtro['filter_name'] }}" class="form-control" placeholder="Nombre"></label> </th>
          <th>           
            <label for="region">Region
            <select value="" name="region_educativa" id="region_educativa" class="form-control">
                <option value="">Todas las regiones</option>  
                  @foreach ($regiones as $element =>$reg)
                     @if ($reg->id_region_educativa==$filtro['filter_region_educativa'])
                      <option value="{{$reg->id_region_educativa}}" selected="selected">{{$reg->nombre}}</option>
                    @else 
                      <option value="{{$reg->id_region_educativa}}">{{$reg->nombre}}</option>
                    @endif
                  @endforeach              
              </select>
          </label>
          </th>   
          <th>       
            <label for="distrito">Distrito
            <select value="" name="distrito" id="distrito" class="form-control">
                <option value="">Todos los distritos</option>  
                  @foreach ($partidos as $element =>$par)
                     @if ($par->c_departamento==$filtro['filter_distrito'])
                      <option value="{{$par->c_departamento}}" selected="selected">{{$par->nombre}}</option>
                    @else 
                      <option value="{{$par->c_departamento}}">{{$par->nombre}}</option>
                    @endif
                  @endforeach              
              </select>
          </label>
          </th> 



        <th width="240px"> 
          <label for="rama">Nivel Educativo
            <select value="" name="rama" id="rama" class="form-control">
              <option value="">Todas los niveles</option>  
                @foreach ($definicion_formulario as $element =>$def)
                   @if ($def->nombre_corto==$filtro['filter_rama'])
                    <option value="{{$def->nombre_corto}}" selected="selected">{{$def->nombre_corto}}</option>
                  @else 
                    <option value="{{$def->nombre_corto}}">{{$def->nombre_corto}}</option>
                  @endif
                @endforeach
            </select></label>
        </th>
        <th width="220px"> 
        <label for="estado_formulario">Estado del Formulario
          <select value="" name="estado_formulario" id="estado_formulario" class="form-control">
            <option value="" style="color: #0430E1;">Todos los estados</option>  
            @if ($filtro['filter_estado']=='999')
             <option value="999" selected="selected" style="color: #0430E1;" >Distinto de Completo y Confirmado</option> 
             @else
             <option value="999" style="color: #0430E1;">Distinto de Completo y Confirmado</option> 
             @endif

              @foreach ($estado_formulario as $element =>$es)
                @if ($es->c_estado_formulario==$filtro['filter_estado'])
                  <option value="{{$es->c_estado_formulario}}" selected="selected">{{$es->descripcion}}</option>
                @else
                  <option value="{{$es->c_estado_formulario}}">{{$es->descripcion}}</option>
                @endif
              @endforeach              
          </select></label>           
          </th>
          <th width="150px"> 
              <label for="supervicion">Supervisión
              <select value="" name="supervicion" id="estado_formulario" class="form-control">                                
                <option value="">Oficial y Diegep </option>  
                @foreach ($supervicion as $element =>$sec)
                  @if ($sec==$filtro['filter_supervicion'])
                  <option value="{{$sec}}"selected="selected">{{$sec}} </option>
                  @else
                    <option value="{{$sec}}">{{$sec}}</option>
                  @endif  
                @endforeach
              </select>
            </label>
            </th>

          <th>            
              {{Form::button('Aplicar filtro', array('type' => 'submit',   'name' => 'submitbutton',
              'value'=>'filter-true', 'class' => 'btn btn-primary', 'title'=>'Aplicar filtro a la grilla'))}}
          </th>
           <th>  
            @if ($filtro['filter_aplicado'])
              {{Form::button('Quitar filtro', array('type' => 'submit',  'name' => 'submitbutton',
              'value'=>'filter-false', 'class' => 'btn btn-primary', 'title'=>'Quitar filtro a la grilla'))}}     
           @endif 
          </th>
          {!! Form::close()!!}     
          @role('admin') 
          <th>                               
             @php $codigo_jurisdiccional = null; @endphp             
            <form action="{{ url('enviodemail',  [$periodo->id_periodo,  $codigo_jurisdiccional ]) }}" method="GET"> 
                  {{Form::button('Reclamar Form. Incompletos', array('type' => 'submit', 'class' => 'btn btn-danger', 'title'=>'Envio de mail a los que tienen formulario incompleto o sin confirmar'))}}
             </form>
          </th>
          @endrole
         </tr>
        </table>     

    <div class="table-responsive">      
      <table class="table table-md table-hover" name="mail" id="mail">        
        <thead class="thead-dark">
          <tr>                           
          <th class="text-center">Código <br>Jurisdiccional</th>
          <th>Nombre</th>      
          <th>E-mail</th>
          <th>Estado</th>  
          <th>Responsable</th>   
          <th>E-mail Responsable</th>
          <th>Actualizado</th>
          <th>Fecha reclamo</th>       
          <th colspan="3"></th>                      
        </tr> 
        </thead>  
        <tbody>         
          @php $start=True; @endphp            
          @foreach ($datos_localizacion as $element =>$u)  
           <tr>
             <!-- <td>{{$u->cueanexo}}</td> -->
             <td>{{$u->codigo_jurisdiccional}}</td>
             <td>{{$u->nombre}}</td>
             <td>{{$u->email}}</td>             
             <td>{{$u->descripcion}}</td>
             <td>{{$u->responsable}}</td>
             <td>{{$u->email_resp}}</td>               
             <td>{{ date('d-m-Y', strtotime($u->fecha)) }}</td>
             @if ($u->fecha_envio_mail!= null)
               <td>{{ date('d-m-Y', strtotime($u->fecha_envio_mail)) }}</td>
             @else  <td></td>
             @endif
             <td>
              <form action=" {{ url('ver_verificacion_datos',[$u->codigo_jurisdiccional, $periodo->id_periodo]) }}" method="GET">              
                {{Form::button('<i class="fa fa-vcard-o" style="font-size:20px; color:#000"></i>', 
                    array('type' => 'submit', 'title'=>'Ver planilla de verificación de datos'))}}
              </form>
             </td>
            <td>     
              <form action=" {{ url('redactarmail',[$u->codigo_jurisdiccional, $periodo->id_periodo]) }}" method="GET">              
                {{Form::button('<i class="fa fa-envelope" style="font-size:20px; color:#f1a340"></i>', 
                    array('type' => 'submit', 'title'=>'Enviar e-mail'))}}
              </form>
           </td>
           <td>     
              <form action=" {{ url('enviodemail',[$periodo->id_periodo, $u->codigo_jurisdiccional]) }}" method="GET">              
                {{Form::button('<i class="fa fa-envelope" style="font-size:20px; color:#E11804"></i>', 
                    array('type' => 'submit', 'title'=>'Reclamar formulario'))}}
              </form>
           </td>
          </tr>  
        @endforeach             
      </tbody>              
    </table>
    <ul class="pagination justify-content-center">
        {!! $datos_localizacion->appends(Request::capture()->except('page'))->render() !!} 
    </ul>
  </div>
@endsection
@section('js')
   <script>
       $(window).on('load', function(){
          $(".loader").fadeOut("slow");
      });
      $(window).on('close', function(){
        $(".loader").fadeOut("slow");
     });
  </script>
  @stop