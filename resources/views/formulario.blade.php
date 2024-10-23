@extends('layouts.app')
@section('css')
   <link href="{{ asset('leaflet/leaflet.css') }}" rel="stylesheet">      
   <style>      
      #map2 {width: 550px; height: 400px;}       
      .loader {
         position: fixed;
         left: 0px;
         top: 0px;
         width: 100%;
         height: 100%;
         z-index: 9999;
         background: url('../..//images/Preloader_3.gif') 50% 50% no-repeat rgb(249,249,249);
         opacity: .8;
      }
     </style>

@stop

@section('content')
<div class="container-fluid">{{--  Container  --}}
  <div class="row justify-content-center">  {{--  Center  --}} 
  <!-- class="loader"b9^\ -->
  <div ></div>
     <div class="col-sm-6">  {{--  Datos  --}}
        <div class="card">  {{--  Card  --}}
          <div class="card-header separa_datos"><b>{{$formulario->esc_nombre}}</b></div>
           <ul class="list-group list-group-flush">
              <li class="list-group-item">
                  <b>Código jurisdiccional:</b> {{$formulario->codigo_jurisdiccional}}  <b> CUE Anexo:</b> {{$formulario->cueanexo}}
                  <div class="row">
                     <div class="col-sm-6">
                       <form action=" {{ url('fichaestadistica',[$formulario->id_serv, $formulario->id_localizacion_periodo]) }}" method="GET">
                         {!! csrf_field() !!}
                         {{Form::button('Ficha estadística del establecimiento', array('type' => 'submit',
                           'value'=>'declaracion', 'class' => 'btn btn-primary', 'title'=>'Ficha estadística del establecimiento'))}}                      
                       </form>
                     </div>
                  </div>                   
              </li>
              <li class="list-group-item separa_datos"><b>OFERTAS EDUCATIVAS</b></li>
              <li class="list-group-item">
                  <ul>
                      @foreach ($formulario->ofertas as $element =>$u)
                          <li><b> {{$u}}</b></li>
                      @endforeach
                    </ul>
               </li>

               {{--  Botones para grabar planilla  --}}
               <li class="list-group-item separa_datos"><b><h5>{{$formulario->nombre}}</h5></b>
                <div class="row">
                <div class="col-sm-2">
                  <form action=" {{ url('editformulario', [$formulario->id_localizacion_periodo]) }}/" method="GET">
                      {!! csrf_field() !!}
                      @if ($formulario->c_estado_formulario < 80  && (Auth::user()->level() < 3))
                      {{Form::button('Cargar Formulario', array('type' => 'submit',
                      'value'=>'verdatos_c', 'class' => 'btn btn-primary', 'title'=>'Cargar datos del formulario'))}}
                      @else
                      {{Form::button('Ver Formulario', array('type' => 'submit',
                            'value'=>'verdatos_c', 'class' => 'btn btn-primary', 'title'=>'Ver datos del formulario'))}}
                      @endif
                  </form>
               </div>

                  @if ($periodo->en_carga==True)
                  <div class="col-sm-3">
                  @if ($formulario->c_estado_formulario >= 80 and $formulario->c_estado_formulario <= 90 && (Auth::user()->level() < 6))
                  <form action=" {{ url('confirmarformulario',[$formulario->id_localizacion_periodo]) }}" method="POST">
                      {!! csrf_field() !!}
                        {{Form::button('Confirmar formulario',
                           array( 'class' => 'btn btn-primary', 'type' => 'submit', 'value'=>'confirmar', 'onclick'=>'return confirm("Confirmar el formulario?")','title'=>'Confirmar el formulario'))}}
                   </form>
                   @elseif ($formulario->c_estado_formulario >= 100 && (Auth::user()->level() < 3))
                    <form action=" {{ url('desconfirmarformulario',[$formulario->id_localizacion_periodo]) }}" method="POST">
                    {!! csrf_field() !!}
                       {{Form::button('Desconfirmar Formulario',
                           array( 'class' => 'btn btn-primary', 'type' => 'submit', 'value'=>'desconfirmar','onclick'=>'return confirm("Desconfirmar el formulario?")','title'=>'Desconfirmar el formulario'))}}
                   </form>
                   @endif
                  </div>
                 @endif
                 <div class="col-sm-2">
                    @if ($formulario->c_estado_formulario >= 100 && (Auth::user()->level() < 6))
                    <form action=" {{ url('declaracionjurada',[$formulario->id_localizacion_periodo]) }}" method="POST">
                    {!! csrf_field() !!}
                       {{Form::button('Declaración Jurada',
                           array('class' => 'btn btn-primary', 'type' => 'submit', 'value'=>'declaracion', 'title'=>'Descargar la declaración Jurada'))}}
                   </form>
                    @endif
                 </div>

                 <div class="col-sm-2">
                    <form action=" {{ url('formulariopdf',[$formulario->id_localizacion_periodo]) }}" method="POST">
                        {!! csrf_field() !!}
                        {{Form::button('Descargar PDF',
                           array('class' => 'btn btn-primary', 'type' => 'submit', 'value'=>'declaracion', 'title'=>'Descargar planilla en PDF'))}}
                      </form>
                  </div>
                  <div class="col-sm-2">
                      <a class="btn btn-primary" href="{{ route('localizacion', [$formulario->id_periodo]) }}">Volver página anterior </a>
                    </div>
                  {{--  <div class="col-sm-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ayuda"><i class="fa fa-info fa-1x"
                          aria-hidden="true"> Ayuda</i>
                  </div>  --}}

                </div>    {{--  Fin Row  --}}
               </li>
          
               <li class="list-group-item">
                  <p><b>Estado del Formulario:</b>
                  @if ($formulario->c_estado_formulario ==20 ) <font color="red">En carga con errores</font>
                  @elseif ($formulario->c_estado_formulario ==7)  <font color="red">Error por cambio de tipo de organización </font>
                  @elseif ($formulario->c_estado_formulario ==10) <font color="red">En carga con datos en celdas inactivas</font>
                  @elseif ($formulario->c_estado_formulario ==30) <font color="red">En carga con advertencias</font>
                  @elseif ($formulario->c_estado_formulario ==40) <font color="red">En carga</font>
                  @elseif ($formulario->c_estado_formulario ==70) <font color="red">Vacío</font>
                  @elseif ($formulario->c_estado_formulario ==80) <font color="green">Completo con advertencias</font>
                  @elseif ($formulario->c_estado_formulario ==90) <font color="green">Completo</font>
                  @elseif ($formulario->c_estado_formulario ==100) <font color="green">Confirmado</font>
                  @else ($formulario->c_estado_formulario == 110) <font color="red">No corresponde</font>
                  @endif
                  </li>  
                  @foreach ($formulario->cuadros as $element =>$u)
                    @if (($formulario->c_estado_formulario != 70) && ($u->c_estado_cuadro == 70) )                  
                     <b>Cuadro: {{$u->numero}}:  <font color="red">  Vacio</font></b>
                   @endif
                   @if ($u->msg_err != [] || ($u->msg_adv != []) )
                    <b>Cuadro: {{$u->numero}}</b>
                    
                  @endif
                   <font color="red">
                    <ul>
                   @foreach ($u->msg_err as $element =>$error)
                         <li>{{ $error}}   </li>
                    @endforeach
                   </ul>
                   </font>
                   <font color="#8a6d3b">
                    <ul>
                    @foreach ($u->msg_adv as $element =>$error)
                         <li>{{ $error}} </li>
                     @endforeach
                    </ul>
                  </font>
                  @endforeach
              
           </ul>
        </div>  {{--  Fin Card  --}}
     </div>  {{--  Fin Datos  --}}
     {{--    --}}
     <div class="col-sm-6">  {{--  Datos  --}}
        <div class="card">  {{--  Card  --}}
          <div class="card-header separa_datos"><b>UBICACIÓN GEOGRÁFICA</b></div>
           <ul class="list-group list-group-flush">
              <li class="list-group-item">

               {{--  if (xy_new !='') {xy=xy_new; zoom=16; }
               else  if (xy==''){xy=[-60.754 , -37.361]; zoom=6; }  --}}

                  {{--  $v_zoom=6;  
                  $centrado='[-36.6083, -60.1712]';  --}}
                  
                  @php 
                    $v_zoom= 18;
                    $centrado='['.$formulario->st_y.','. $formulario->st_x.']'; 
                    $filter_escuela="'".$formulario->codigo_jurisdiccional."'";    
                    $filter2='"clave=';                    
                    $filter3=$filter2.$filter_escuela.'"';

         

                  @endphp              
                  <b>Latitud:</b> {{$formulario->st_y}}  <b>Longitud:</b> {{$formulario->st_x}} <br>
                  <b>Calle: </b> {{$formulario->calle}}<b> N° </b> {{$formulario->nro}}<br>
                  <b>Nº de Teléfono: </b> ({{$formulario->telefono_cod_area }}) {{$formulario->telefono}}<br>
                
                  <!-- <b>Calle lateral derecha: </b> {{$formulario->calle_lateral_derecha}}<br>
                  <b>Calle lateral izquierda: </b> {{$formulario->calle_lateral_izquierda}}<br> -->
                  <b>Código Postal:</b> {{$formulario->cod_postal}}<br>
                  <b>Departamento:</b> {{$formulario->departamento}}  <b> Localidad:</b> {{$formulario->localidad}}<br> 
                  <div id ="map2"> </div>
              </li>
              {{--  <li class="list-group-item separa_datos">DOMICILIO INSTITUCIONAL</li>
              <li class="list-group-item">

                </li>  --}}

           </ul>
        </div>  {{--  Fin Card  --}}
     </div>  {{--  Fin Datos  --}}
     {{--    --}}
  </div>     {{--  Fin Center  --}}
</div>  {{--  Fin Container  --}}
@stop
@section('js')
   <script type="text/javascript">
       $(window).on('load', function(){
          $(".loader").fadeOut("slow");
      });
      $(window).on('close', function(){
        $(".loader").fadeOut("slow");
     });
  </script>

   <script src="{{ asset('leaflet/leaflet.js') }}" ></script>
   <script>
      var map2 = L.map('map2', {      
        center: @php echo $centrado;  @endphp,
        maxZoom: 18,  minZoom: 6,
        maxBounds:[
            [-41.0363, -63.393 ],
            [-33.2641, -56.6641]
            ],
        zoom:@php echo $v_zoom;  @endphp});

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
         attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
       }).addTo(map2);

      //  L.tileLayer.wms( "http://192.168.57.11:8081/geoserver/carto_base/wms", {
      //    layers: "carto_base:macizos_parcelas",      
      //    format: 'image/png', 
      //    transparent: true,
      //    version: '1.3.0',
      //    attribution: "DIE"
      // }).addTo(map2);


      var codigo='@php echo $formulario->codigo_jurisdiccional; @endphp';
      if (codigo.substr(4,1)=='J' && codigo.substr(1,1) !=4){
         $iconFeature='../..//images/symbols/inicialE.png'; 
      }
      else if (codigo.substr(4,1)=='P' && codigo.substr(1,1) != 4){ $iconFeature='../..//images/symbols/primarioE.png'; }
      else if (((codigo.substr(4,1) =='B' || (codigo.substr(4,1) =='M')  || codigo.substr(4,2) =='AS') &&  codigo.substr(4,2) !='MA')
      &&   codigo.substr(4,2) !='MF'  && codigo.substr(4,2) !='MT' && codigo.substr(4,2) !='MC'   &&  codigo.substr(1,1) != 4){
         $iconFeature='../..//images/symbols/polimodalE.png';}
      else if (codigo.substr(4,1)=='I'  &&  codigo.substr(1,1) != 4){
         $iconFeature='../..//images/symbols/superiorE.png'; }
      else if ((codigo.substr(4,2)=='MA' ||   codigo.substr(4,2)=='MF' || codigo.substr(4,2)=='MT' ||  codigo.substr(4,2)=='MC' ) &&  codigo.substr(1,1) != 4){
         $iconFeature='../..//images/symbols/tecnicoE.png'; }
      else if ((codigo.substr(4,2)=='DC' || codigo.substr(4,2)=='DA' || codigo.substr(4,2)=='DE') &&  codigo.substr(1,1) != 4){$iconFeature='../..//images/symbols/adultospE.png'; }
      else if (codigo.substr(4,2)=='DM' &&  codigo.substr(1,1) != 4){$iconFeature='../..//images/symbols/adultosmE.png'; }
      else if ((codigo.substr(4,2)=='DF' || codigo.substr(4,2)=='DB') &&  codigo.substr(1,1) != 4) {$iconFeature='../..//images/symbols/adultosfpE.png'; }
      else if (codigo.substr(4,1)=='E'  &&  codigo.substr(1,1) != 4){ $iconFeature='../..//images/symbols/especialpE.png'; }
      else if (codigo.substr(4,1)=='S'  &&  codigo.substr(1,1) != 4){ $iconFeature='../..//images/symbols/psicoE.png'; }
      else if (codigo.substr(4,1)=='A'  && codigo.substr(4,1 )!='AS'  &&  codigo.substr(1,1) != 4){ $iconFeature='../..//images/symbols/artisticaE.png';  }
      else if (codigo.substr(4,2)=='FC'  &&  codigo.substr(1,1) != 4){ $iconFeature='../..//images/symbols/fisicaE.png';}

      // Privado
      else if (codigo.substr(4,1)=='J'  &&  codigo.substr(1,1) ==  4){ $iconFeature='../..//images/symbols/inicialP.png';}
      else if (codigo.substr(4,1)=='P'  &&  codigo.substr(1,1) == 4){$iconFeature='../..//images/symbols/primarioE.png';}
      else if (codigo.substr(4,1)=='B' && codigo.substr(4,1)=='M' || codigo.substr(4,2) =='AS' 
      && codigo.substr(4,2)== 'MA' && codigo.substr(4,2)=='MF' && codigo.substr(4,2)=='MT' && codigo.substr(4,2)=='MC' && codigo.substr(1,1) == 4){
         $iconFeature='../..//images/symbols/polimodalP.png'; }
      else if (codigo.substr(4,2)=='I'  &&  codigo.substr(1,1) == 4){ $iconFeature='../..//images/symbols/superiorP.png';}
      else if ((codigo.substr(4,2)=='MA' || codigo.substr(4,2)=='MF' || codigo.substr(4,2)=='MT' || codigo.substr(4,2)=='MC' )&&  codigo.substr(1,1) == 4){
         $iconFeature='../..//images/symbols/tecnicoP.png'; }
      else if (codigo.substr(4,2)=='DC'  || codigo.substr(4,2)=='DA' || codigo.substr(4,2)=='DE'  &&  codigo.substr(1,1) ==4){
         $iconFeature='../..//images/symbols/adultosfppP.png';}
      else if (codigo.substr(4,2)=='DM' &&  codigo.substr(1,1) == 4){ $iconFeature='../..//images/symbols/adultosfpnmP.png';  }
      else if (codigo.substr(4,2)== 'DF' || codigo.substr(4,2)== 'DB' &&  codigo.substr(1,1) == 4){ $iconFeature='../..//images/symbols/adultosmE.png';}
      else if (codigo.substr(4,1)=='E'  &&  codigo.substr(1,1)== 4){ $iconFeature='../..//images/symbols/especialppP.png'; }
      else if (codigo.substr(4,1)=='S'  &&  codigo.substr(1,1)== 4){ $iconFeature='../..//images/symbols/psicoP.png';}
      else if  (codigo.substr(4,1)=='A'  && codigo.substr(4,2)!='AS'  &&  codigo.substr(1,1) == 4){ $iconFeature='../..//images/symbols/artisticaP.png';}
      else if (codigo.substr(4,2)=='FC'  &&  codigo.substr(1,1) == 4){ $iconFeature='../..//images/symbols/fisicaP.png';
      }
      
   var myIcon = L.icon({
      iconUrl: $iconFeature, 
      iconSize:     [20, 20]
      });

      L.marker([{{$formulario->st_y}},{{$formulario->st_x}} ], {icon: myIcon}).addTo(map2);

   //   L.tileLayer.wms( "http://192.168.57.11:8081/geoserver/mapa/wms", {
   //      layers: "mapa:Escuelas",
   //    //   cql_filter: @php echo $filter3; @endphp,
   //      styles:''
   //      format: 'image/png', 
   //      transparent: true,
   //      version: '1.3.0',
   //      attribution: "DIE"
   //   }).addTo(map2);

       
    </script>
@stop
