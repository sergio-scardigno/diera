@extends('layouts.app')
@section('content')
<div class="container-fluid">{{--  Container  --}}

    <div class="row justify-content-center"> {{--  Center  --}}
        <div class="col-sm-6"> {{--  Datos  --}}
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title separa_datos"><b>RELEVAMIENTO INICIAL</b></h5>
                    <p class="card-text">
                        Se efectúa al comienzo del ciclo lectivo, con datos al 15 de marzo. Releva datos de matrícula
                        según año de estudio y sexo; secciones por establecimiento educativo de gestión estatal y
                        privada; Bibliotecas; Servicio Alimentario Escolar.
                    </p>
                    <h5 class="card-title separa_datos"><b>RELEVAMIENTO FINAL</b> </h5>
                    <p class="card-text">
                        Se efectúa al final del ciclo lectivo con datos al último día de clases. Releva datos de
                        matrícula por edad y sexo, año de estudio y cantidad de alumnos por secciones y turno. Servicio
                        Alimentario Escolar. Aporta datos significativos sobre la situación de la matrícula, egresados y
                        promovidos. Permite elaborar información sobre los movimientos interanuales de los alumnos.
                    </p>
                    <div><b>{{ __('Relevamientos en carga') }} </b></div>
                    @foreach ($periodo_en_carga[0] as $element =>$u)
                    @if ($u->momento !='C')
                    <a class="btn btn-primary" href="{{ url('/localizacion', $u->id_periodo) }}">{{$u->periodo}} </a>
                    @endif
                    @endforeach
                    <div><b> {{ __('Consulta de Relevamientos') }}</b></div>
                    @if ($periodo_en_carga[1]->count()<> 0)
                        @foreach ($periodo_en_carga[1] as $element =>$u)
                        @if ($u->momento !='C' && $u->id_periodo >= 100)
                        <a class="btn btn-primary" href="{{ url('/localizacion', $u->id_periodo ) }}">{{$u->periodo}}
                        </a>
                        @endif
                        @endforeach
                        @endif
                        <div><b> {{ __('Descarga de Planillas') }}</b></div>
                        @foreach ($periodo_en_carga[0] as $element =>$u)
                        @if ($u->momento !='C')
                        <a class="btn btn-primary"
                            href="{{ route('descargar_planillas',  $u->periodo) }}">{{$u->periodo}} </a>
                        @endif
                        @endforeach

                </div>
            </div>
            <!-- {{-- relevamiento Anual --}}
      <div class="card">
          {{-- style="width: 18rem;" --}}
      {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
      <div class="card-body">
        <h5 class="card-title separa_datos"><b>RELEVAMIENTO ANUAL</b></h5>
        <p class="card-text">
            Se efectúa a mediados del ciclo lectivo con datos al 30 de abril. Releva datos de matrícula, planta funcional y personal docente y no docente. Aporta datos de los alumnos por edad; sexo; año de estudio; nacionalidad; turno y sección. Registra el movimiento anual de los alumnos (promoción; repitencia; abandono y reinscripción) permitiendo la elaboración de un repertorio de indicadores y la comparación a nivel nacional.
            Desde el año 2012 se ha implementado la carga virtual del mismo, además de completar los Cuadernillos y de remitirlos a la Dirección como habitualmente se ha venido haciendo se les solicita a las escuelas  que efectúen la carga virtual de los  cuadernillos que corresponden a su establecimiento.
        </p>  
          <a class="btn btn-info" href="http://mapaescolar.abc.gob.ar/ra2019/" target="_blank">RA WEB / Relevamiento Anual 2019.</a>
          <a class="btn btn-primary" href="{{ route('relant') }}">CONSULTAS DE RELEVAMIENTOS ANTERIORES</a>
      </div>
      </div>   
  {{-- Mapa Escolar --}} -->
            <!-- <div class="card">
 
  <div class="card-body">
    <h5 class="card-title separa_datos"><b>MAPA ESCOLAR</b></h5>
    <p class="card-text">
        El Mapa Escolar ubica Unidades Educativas y otros organismos educativos en cartografía digital y los vincula a distintas bases de datos a fin de generar información múltiple y contextualizada geográficamente.
    </p>  
      <a class="btn btn-primary" href="http://mapaescolar.abc.gob.ar/mapaescolar/" target="_blank">Mapa Escolar</a>    
  </div>
  </div>  

    </div> 
  </div>
</div>  -->
            @stop
            @section('js')
            <script type='text/javascript' data-cfasync='false'>
            window.purechatApi = {
                l: [],
                t: [],
                on: function() {
                    this.l.push(arguments);
                }
            };
            (function() {
                var done = false;
                var script = document.createElement('script');
                script.async = true;
                script.type = 'text/javascript';
                script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript';
                document.getElementsByTagName('HEAD').item(0).appendChild(script);
                script.onreadystatechange = script.onload = function(e) {
                    if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState ==
                            'complete')) {
                        var w = new PCWidget({
                            c: 'bdee6a03-0247-42dd-a427-bf6185a67a24',
                            f: true
                        });
                        done = true;
                    }
                };
            })();
            </script>
            @stop