@extends('layouts.app')
@section('css')
  {!! Charts::assets() !!} 
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
    table.cuadro, table.cuadro tbody {
        background-color: white;
        border-collapse: collapse;
        border-width: 2px;
        /*border-style: solid;*/
        border-spacing: 0;
        clear:both;
        font-size: 11px;   
        width: 0;
    }

    table.cuadro tbody tr th {
        border-width: 1px;
        border-style: solid;
        padding: 3px;
    }

    table.cuadro tbody tr th.titulo1 {
        text-align: center; 
        width: 6em;
        vertical-align: middle;
        display: table-cell;    
        word-wrap: break-word;
    }
    table.cuadro tbody tr th.titulo2 {
        text-align: left;
        width: 20em;
        vertical-align: middle;         
    }

 </style>
@show  
@section('content') 

 <div class="container-fluid">   <div class="loader"></div>
  <div class="panel panel-default">
    
      @php $excel=true;  @endphp      
       <h2 align="Center">Estado de carga al {{date('d-m-Y')}} - {{$periodo->periodo}} </h2>    
      <form action=" {{ url('estadistica',[$periodo,$excel]) }}" method="GET"> 
      {!! csrf_field() !!}
       <!-- {{Form::button('<i class="fa fa-file-excel-o fa-2x" aria-hidden="true"></i>', 
          array('type' => 'submit', 'value'=>'true', 'title'=>'Descargar estadistica en XLS'))}} -->
     </form>         
  
       <div class="table-responsive">      
        <table class="table table-md table-hover cuadro">
               <tr>      
               <thead class="thead-dark">    
                <th>Formulario</th>
                <th>Total</th>
                <th>Vacios</th>
                <th>% Vacios</th>
                <th>Con error de padrón</th>
                <th>% Con error de padrón</th>
                <th>En carga con error</th>
                <th>% En carga con error</th>
                <th>En carga</th>
                <th>% En carga</th>  
                <th>Completos</th>
                <th>% Completos</th>  
                <th>Confirmados</th>              
                <th>% Confirmados</th>
               </thead> 
              </tr>
                @foreach ($data as $element =>$u)  
                 @php $porc_vacio=number_format(($u->vacio*100/$u->total),2); 
                      $porc_err_padron=number_format(($u->con_error_de_padron*100/$u->total),2); 
                      $porc_err_carga=number_format(($u->en_carga_con_error*100/$u->total),2); 
                      $porc_en_carga=number_format(($u->en_carga*100/$u->total),2); 
                      $porc_completo=number_format(($u->completo*100/$u->total),2); 
                      $porc_confirmado=number_format(($u->confirmado*100/$u->total),2); 
                 @endphp
                  <tr>
                   <td align="left"><b>{{$u->formulario}}</b></td>
                   <td align="center"><b>{{$u->total}}</b></td>
                   <td align="center">{{$u->vacio}}</td>
                   <td align="center">{{$porc_vacio}}</td>
                   <td align="center">{{$u->con_error_de_padron}}</td>
                   <td align="center">{{$porc_err_padron}}</td>
                   <td align="center">{{$u->en_carga_con_error}}</td>
                   <td align="center">{{$porc_err_carga}}</td>               
                   <td align="center">{{$u->en_carga}}</td>
                   <td align="center">{{$porc_en_carga}}</td>
                   <td align="center">{{$u->completo}}</td>
                   <td align="center">{{$porc_completo}}</td>
                   <td align="center">{{$u->confirmado}}</td>             
                   <td align="center">{{$porc_confirmado}}</td>
                @endforeach        
           </table>      
        </div>
  
      <div class="col-sm-12">   
        
             {!! $chart->render() !!}
     
      </div>      
     @php 
        $v_zoom=6;  
        $centrado='[-36.6083, -60.1712]';
        if (Auth::user()->level() ==5 || Auth::user()->level() == 7)  {
          $v_zoom= 9;
          $centrado='['.$center_pol[0]->latitud.','. $center_pol[0]->longitud.']';              
        }        
     @endphp 
               
     @if (Auth::user()->level()!=4 && Auth::user()->level()!=6 ) 
      <div class="col-sm-12">   
   
        <!DOCTYPE html>
        <html>
        <head>
         
         <link href="{{ asset('leaflet/leaflet.css') }}" rel="stylesheet">   
          <style>
             html, body {height: 100%; margin: 0;}
             #map {width: 600px; height: 460px;}
            .legend {line-height: 18px; color: #555;}
            .legend i {width: 18px; height: 18px; float: left; margin-right: 8px; opacity: 0.7; }
          </style>
          <title>Js</title>
        </head>
        <body>
          <div id ="map"> </div> 
          <script src="{{ asset('leaflet/leaflet.js') }}" ></script>
          <script>
            var map = L.map('map', {          
              center: @php echo $centrado; @endphp,              
              maxZoom: 15,  minZoom: 6,
              maxBounds:[ 
                  [-41.0363, -63.393 ], 
                  [-33.2641, -56.6641]
                  ], 
              zoom: @php echo $v_zoom; @endphp
            });
          var info = L.control();
          info.onAdd = function (map) {
            this._div = L.DomUtil.create('div', 'info');
            this.update();
            return this._div;
          };
          info.update = function (props) {
            this._div.innerHTML = '<h4>Porcentaje de carga x Distrito</h4>' +  (props ?
              '<b>' + props.nombre + '</b><br />' + '<b> Total Formularios ' + props.total + '</b><br />'+ props.porcentaje_cargados + ' % cargados'+ '</b><br />'
              : 'Desplazarse por un distrito');
          };
          info.addTo(map);
          function getColor(d) {
             return d > 95 ? '#004529' :
             d > 60  ? '#006837' :
             d > 50  ? '#238443' :
             d > 40  ? '#41ab5d' :
             d > 30   ? '#78c679' :
             d > 20   ? '#addd8e' :
             d > 10   ? '#d9f0a3' :
             d > 1   ? '#f7fcb9' :
                        '#ffffe5';
         }
         function style(feature) {
             return {
                    fillColor: getColor(feature.properties.porcentaje_cargados),
                    weight: 2,
                    opacity: 1,
                    color: 'white',
                    dashArray: '3',
                    fillOpacity: 0.7
                };
            }

            function highlightFeature(e) {
              var layer = e.target;
              layer.setStyle({
                weight: 5,
                color: '#666',
                dashArray: '',
                fillOpacity: 0.7
              });
              if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {layer.bringToFront();}
              info.update(layer.feature.properties);
          }

          var geojson;
          function resetHighlight(e) {
            geojson.resetStyle(e.target);
            info.update();
          }

          function zoomToFeature(e) {
            map.fitBounds(e.target.getBounds());
          }

          function onEachFeature(feature, layer) {
            layer.on({
              mouseover: highlightFeature,
              mouseout: resetHighlight,
              click: zoomToFeature
            });
          }

          geojson = L.geoJson(@php echo $statesData;@endphp, {
            style: style,
            onEachFeature: onEachFeature
          }).addTo(map);
          var legend = L.control({position: 'bottomright'});

          legend.onAdd = function (map) {

            var div = L.DomUtil.create('div', 'info legend'),
              grades = [0, 1, 10, 25, 50, 75, 95],
              labels = [],
              from, to;

            for (var i = 0; i < grades.length; i++) {
              from = grades[i];
              to = grades[i + 1];

              labels.push(
                '<i style="background:' + getColor(from + 1) + '"></i> ' +
                from + (to ? '&ndash;' + to : '+'));
            }

            div.innerHTML = labels.join('<br>');
            return div;
          };

          legend.addTo(map);
          </script>
        </body>
        </html>
 
    </div>
    @endif
    <br><br> 
    <center>
    <h2 align="Center"  >Totales por Distrito y Dependencias</h2>
    <div class="col-sm-12">   
    <div class="table-responsive">            
      <table class="table table-md table-hover cuadro">           
           <tr>    
           <thead class="thead-dark">          
            <th>Región</th>
            <th>Distrito</th>
            <th>Total</th>
            <th>Cargados</th>
            <th>% Cargados</th>
            <th>Total Estatal</th>
            <th>Cargados Estatal</th>
            <th>% Cargados Estatal</th>
            <th>Total DIPREGEP</th>
            <th>Cargados DIPREGEP</th>
            <th>% Cargados DIPREGEP</th>
            </thead>
          </tr>
            @foreach ($distrito as $element =>$u)  
              <tr>
               <td align="left"><b>{{$u->region}}</b></td>
               <td align="left"><b>{{$u->nombre}}</b></td>
               <td align="center"><b>{{$u->total}}</b></td>
               <td align="center">{{$u->cargados}}</td>
               <td align="center">{{$u->porcentaje_cargados}}</td>
               <td align="center"><b>{{$u->estatal_total}}</b></td>
               <td align="center">{{$u->estatal_cargados}}</td>
               <td align="center">{{$u->estatal_porcentaje_cargados}}</td>

               <td align="center"><b>{{$u->dipregep_total}}</b></td>
               <td align="center">{{$u->dipregep_cargados}}</td>
               <td align="center">{{$u->dipregep_porcentaje_cargados}}</td>
              </tr> 
            @endforeach        
       </table>      

   <br> 
    <h2 align="Center">Totales por Región Educativa</h2>
    <div class="col-sm-12">   
    <div class="table-responsive">            
      <table class="table table-md table-hover cuadro">          
           <tr>         
           <thead class="thead-dark">  
            <th>Región</th>            
            <th>Total</th>
            <th>Cargados</th>
            <th>% Cargados</th>

            <th>Total Estatal</th>
            <th>Cargados Estatal</th>
            <th>% Cargados Estatal</th>

            <th>Total DIPREGEP</th>
            <th>Cargados DIPREGEP</th>
            <th>% Cargados DIPREGEP</th>
            </thead>
          </tr>
            @foreach ($region as $element =>$u)  
              <tr>
               <td align="left"><b>{{$u->region}}</b></td>             
               <td align="center"><b>{{$u->total}}</b></td>
               <td align="center">{{$u->cargados}}</td>
               <td align="center">{{$u->porcentaje_cargados}}</td>
               <td align="center"><b>{{$u->estatal_total}}</b></td>
               <td align="center">{{$u->estatal_cargados}}</td>
               <td align="center">{{$u->estatal_porcentaje_cargados}}</td>

               <td align="center"><b>{{$u->dipregep_total}}</b></td>
               <td align="center">{{$u->dipregep_cargados}}</td>
               <td align="center">{{$u->dipregep_porcentaje_cargados}}</td>
              </tr> 
            @endforeach        
       </table>      
  
    </div>
    </div>

<!--  -->
 @if (Auth::user()->level()!=4 && Auth::user()->level()!=6 ) 
    <div class="col-sm-12">   
   
        <!DOCTYPE html>
        <html>
        <head>
          <link href="{{ asset('leaflet/leaflet.css') }}" rel="stylesheet">   
          <style>
            html, body {height: 100%; margin: 0;}
            #map2 {width: 600px; height: 460px;}
            .legend2 {line-height: 18px; color: #555;}
            .legend2 i {width: 18px; height: 18px; float: left; margin-right: 8px; opacity: 0.7;}
          </style>
         <title>Js</title>
        </head>
        <body>
            <div id ="map2"> </div> 
            <script src="{{ asset('leaflet/leaflet.js') }}" ></script>        
          <script>
            var map2 = L.map('map2', {
             center: @php echo $centrado; @endphp,              
              maxZoom: 15,  minZoom: 6,
              maxBounds:[ 
                  [-41.0363, -63.393 ], 
                  [-33.2641, -56.6641]
                  ], 
              zoom: @php echo $v_zoom; @endphp});
          var info2 = L.control();

          info2.onAdd= function (map) {
            this._div = L.DomUtil.create('div', 'info2');
            this.update();
            return this._div;
          };

          info2.update = function (props) {
            this._div.innerHTML = '<h4>Porcentaje de carga x Región Educativa</h4>' +  (props ?
              '<b> Región:' + props.region + '</b><br />' + '<b> Total Formularios ' + props.total + '</b><br />'+ props.porcentaje_cargados + ' % cargados'+ '</b><br />'
              : 'Desplazarse por la región');
          };

          info2.addTo(map2);
          function getColor2(d) {
             return d > 95 ? '#54278f' :
             d > 75  ? '#756bb1' :
             d > 50  ? '#9e9ac8' :
             d > 25   ? '#bcbddc' :          
             d > 1   ? '#dadaeb' :
                        '#f2f0f7';
         }
            function style2(feature) {
                return {
                    fillColor: getColor2(feature.properties.porcentaje_cargados),
                    weight: 2,
                    opacity: 1,
                    color: 'white',
                    dashArray: '3',
                    fillOpacity: 0.7
                };
            }

           function highlightFeature2(e) {
            var layer2 = e.target;

            layer2.setStyle({
              weight: 5,
              color: '#666',
              dashArray: '',
              fillOpacity: 0.7
            });

            if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
              layer2.bringToFront();
            }

            info2.update(layer2.feature.properties);
          }

          var geojson2;
          function resetHighlight2(e) {
            geojson2.resetStyle(e.target);
            info2.update();
          }

          function zoomToFeature2(e) {
            map2.fitBounds(e.target.getBounds());
          }

          function onEachFeature2(feature, layer) {
            layer.on({
              mouseover: highlightFeature2,
              mouseout: resetHighlight2,
              click: zoomToFeature2
            });
          }

          geojson2 = L.geoJson(@php echo $geojson_region;@endphp, {
            style: style2,
            onEachFeature: onEachFeature2
          }).addTo(map2);

          var legend2 = L.control({position: 'bottomright'});

          legend2.onAdd = function (map) {

            var div = L.DomUtil.create('div', 'info legend'),
              grades = [0, 1, 25, 50, 75, 95],
              labels = [],
              from, to;

            for (var i = 0; i < grades.length; i++) {
              from = grades[i];
              to = grades[i + 1];

              labels.push(
                '<i style="background:' + getColor2(from + 1) + '"></i> ' +
                from + (to ? '&ndash;' + to : '+'));
            }

            div.innerHTML = labels.join('<br>');
            return div;
          };

          legend2.addTo(map2);
          </script>
        </body>
        </html>
 
    </div>
   @endif
    {{--  --}}
  </div>
</div>
    <script type="text/javascript">
         $(window).on('load', function(){
            $(".loader").fadeOut("slow");
        });
    </script>
@endsection
