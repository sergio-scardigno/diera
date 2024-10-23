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
         background: url('../images/Preloader_3.gif') 50% 50% no-repeat rgb(249,249,249);
         opacity: .8;
      }
     </style>
@stop
@section('content')
  <div class="panel-body">        
    <div class="panel panel-default">       
      <div class="loader"></div>
      <h4 align="Center">Listado de Localizaciones / {{$periodo->periodo}}</h4>      
       
       <table><tr>
          {!!Form::open(['id'=>'form_localizacion','route'=>array('localizacion', $periodo->id_periodo ),'method'=>'GET','class'=>'navbar-form navbar-left','role'=>'search'])!!} 
          {!! csrf_field() !!} 
        <th width="100px">
          <label for="cueanexo">CUE-ANEXO
          <input name='cueanexo' type="text" value="{{ $filtro['filter_cue'] }}" class="form-control" placeholder="CUE-ANEXO"></label></th>
        <th width="130px">
            <label for="codigo_jurisdiccional">Cód. Jurisdiccional
          <input name='codigo_jurisdiccional' type="text" value="{{ $filtro['filter_clave'] }}" class="form-control" placeholder="Cod. Jurisdiccional"></label></th>
        <th><label for="nombre">Nombre
          <input name='nombre' type="text" value="{{$filtro['filter_name']}}" class="form-control" placeholder="Nombre"></label> </th>
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
              <select value="" name="supervicion" id="supervicion" class="form-control">                                
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
          <form action="{{ url('grilla_excel',[ $periodo->id_periodo]) }}" method="GET"> 
            {!! csrf_field() !!}             
                <input name='cueanexo' type="text" value="{{ $filtro['filter_cue'] }}" hidden>                
                <input name='codigo_jurisdiccional' type="text" value="{{ $filtro['filter_clave'] }}" hidden>
                <input name='nombre' type="text" value="{{$filtro['filter_name']}}" hidden>
                <input name='estado' type="text" value="{{$filtro['filter_estado']}}" hidden>
                <input name='distrito' type="text" value="{{$filtro['filter_distrito']}}" hidden>
                <input name='region_educativa' type="text" value="{{$filtro['filter_region_educativa']}}" hidden>
                <input name='rama' type="text" value="{{$filtro['filter_rama']}}" hidden>
                <input name='supervicion' type="text" value="{{$filtro['filter_supervicion']}}" hidden>
               <th> {{Form::button('Exportar a Excel', array('type' => 'submit',  'name' => 'excel',
                  'value'=>'excel', 'class' => 'btn btn-primary', 'title'=>'Exportar grilla a excel'))}}   </th>
            {!! Form::close()!!}    
         </tr>
        </table>         
            
    </div> 
    <div class="table-responsive">      
      <table class="table table-md table-hover">
        <caption>Listado de Localizaciones / {{$periodo->periodo}} </caption>
        <thead class="thead-dark">
          <tr >          
          <th>Cue-Anexo</th>
          <th>Código Jurisdiccional</th>
          <th>Nombre</th>
          <th>Distrito</th>
          <th>Estado </th>   
          <th colspan="4"></th>                      
        </tr> 
        </thead>  
        <tbody>         
          @php $start=True; @endphp            
        @foreach ($localizacion as $element =>$u)  
           <tr>
             <td>{{$u->cueanexo}}</td>
             <td>{{$u->codigo_jurisdiccional}}</td>
             <td>{{$u->nombre}}</td>
             <td>{{$u->departamento}}</td>             
             <td>{{$u->descripcion}}</td>              
             <td>           
              @if (($periodo->en_carga == True) or ($u->c_estado_formulario != 70)) 
                <form action=" {{ url('formulario',[$u->id_localizacion_periodo, $start]) }}" method="GET">                
                  {{Form::button('<i class="fa fa-pencil-square-o" style="font-size:20px; color:#f1a340"></i>', 
                        array('type' => 'submit', 'value'=>'verdatos','title'=>'Datos del formulario'))}}
                </form> 
              @endif   
            </td>
            <td>             
              @if ($periodo->en_carga==True) 
                @if (($u->c_estado_formulario >= 80 and $u->c_estado_formulario <= 90) && (Auth::user()->level() < 6))                      
                <form action=" {{ url('confirmarformulario',[$u->id_localizacion_periodo]) }}" method="POST">
                    {!! csrf_field() !!}
                    {{Form::button('<i class="fa fa-thumbs-o-up" style="font-size:20px; color:#af8dc3"></i>', 
                        array('type' => 'submit', 'value'=>'confirmar', 'onclick'=>'return confirm("Confirmar el formulario?")','title'=>'Confirmar el formulario'))}}
                </form>              
                @elseif ($u->c_estado_formulario >= 100 && (Auth::user()->level() < 3)) 
                  <form action=" {{ url('desconfirmarformulario',[$u->id_localizacion_periodo]) }}" method="POST">
                  {!! csrf_field() !!}
                    {{Form::button('<i class="fa fa-check-square-o" style="font-size:20px; color:#38761D"></i>', 
                        array('type' => 'submit', 'value'=>'desconfirmar','onclick'=>'return confirm("Desconfirmar el formulario?")','title'=>'Desconfirmar el formulario'))}}
                </form>
                @endif
              @endif  
            </td>  
            <td>
              @if ($u->c_estado_formulario >= 100 && (Auth::user()->level() < 6))                
                  <form action=" {{ url('declaracionjurada',[$u->id_localizacion_periodo]) }}" method="POST">
                  {!! csrf_field() !!}
                    {{Form::button('<i class="fa fa-sticky-note-o" style="font-size:20px;"></i>',  
                        array('type' => 'submit', 'value'=>'declaracion', 'title'=>'Descargar la declaración Jurada'))}}
                </form>
                @endif
              </td>  
              <td>
               @if ((Auth::user()->level() <=2) and (($periodo->en_carga == True) or ($u->c_estado_formulario != 70)) )                  
                <form action=" {{ url('eliminarformulario',[$u->id_localizacion_periodo]) }}" method="POST">
                    {{ csrf_field() }}                      
                  {{Form::button('<i class="fa fa-trash-o icon-background2" style="font-size:20px; color:#e20909"></i>', 
                        array('type' => 'submit', 
                        'value'=>'eliminadatos', 'onclick'=>'return confirm("Eliminar el formulario?")','title'=>'Eliminar el formulario'
                  ))}}
               </form>                                   
              @endif   
             </td>               
               
          </tr>  
        @endforeach             
      </tbody>              
    </table>
    <ul class="pagination justify-content-center">
        {!! $localizacion->appends(Request::capture()->except('page'))->render() !!} 
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