<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DIE') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    .navbar-nav .nav-item {
        padding-left: 10px;
        padding-right: 10px;
    }
    </style>


    <!-- Importar las libreriass CSS y JavaScript de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    @toastr_css
    @yield('css')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @auth
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="btn btn-primary dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Relevamientos') }}
                            </a>
                            <div class="btn btn-primary dropdown-menu" aria-labelledby="navbarDropdown">
                                <div class="dropdown-header"><b>{{ __('Relevamientos en carga') }} </b></div>
                                @foreach ($periodo_en_carga[0] as $element =>$u)
                                @if ($u->momento !='C')
                                <a class="btn btn-primary dropdown-item"
                                    href="{{ url('/localizacion', $u->id_periodo) }}">{{$u->periodo}}</a>
                                @endif
                                @endforeach
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-header"><b> {{ __('Consulta de Relevamientos') }}</b></div>
                                @if ($periodo_en_carga[1]->count()<> 0)
                                    @foreach ($periodo_en_carga[1] as $element =>$u)
                                    @if ($u->momento !='C' && $u->id_periodo >= 100)
                                    <a class="btn btn-primary dropdown-item"
                                        href="{{ url('/localizacion', $u->id_periodo ) }}">{{$u->periodo}} </a>
                                    @endif
                                    @endforeach
                                    @endif
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="btn btn-primary dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Estadística') }}
                            </a>
                            <div class="btn btn-primary dropdown-menu" aria-labelledby="navbarDropdown">
                                <div class="dropdown-header"><b>{{ __('Relevamientos en carga') }} </b></div>
                                @foreach ($periodo_en_carga[0] as $element => $u)
                                @if ($u->momento != 'C')
                                <a class="btn btn-primary dropdown-item"
                                    href="{{ url('/estadistica', $u->id_periodo) }}">
                                    {{$u->periodo}}
                                </a>
                                @endif
                                @endforeach

                                <div class="dropdown-divider"></div>
                                <div class="dropdown-header"><b> {{ __('Consulta de Relevamientos') }}</b></div>
                                @if ($periodo_en_carga[1]->count()<> 0)
                                    @foreach ($periodo_en_carga[1] as $element =>$u)
                                    @if ($u->momento !='C' && $u->id_periodo >= 100)
                                    <a class="btn btn-primary dropdown-item"
                                        href="{{ url('/estadistica', $u->id_periodo ) }}">{{$u->periodo}} </a>
                                    @endif
                                    @endforeach
                                    @endif
                                    @role('admin|supervisor|editor|referente_dto|referente_region|jefe_dto|jefe-reg')
                                    <div class="dropdown-divider"></div>
                                    <div class="dropdown-header"><b>{{ __('Estado de carga') }} </b></div>
                                    @foreach ($periodo_en_carga[0] as $element =>$u)
                                    @if ($u->momento !='C')
                                    <a class="btn btn-primary dropdown-item"
                                        href="{{ url('/estadisticacarga', $u->id_periodo) }}">{{$u->periodo}} </a>
                                    @endif
                                    @endforeach
                            </div>
                            @endrole

                        </li>
                        {{--  @if (Auth::user()->slug != 'editor')
            @endif  --}}

                        @role('admin|supervisor|editor|referente_dto|referente_region|jefe_dto|jefe-reg')
                        <li class="nav-item dropdown">
                            <a class="btn btn-primary dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Planilla Altas y Bajas') }}
                            </a>
                            <div class="btn btn-primary dropdown-menu" aria-labelledby="navbarDropdown">
                                <div class="dropdown-header"><b> {{ __('Relevamientos en carga') }}</b></div>
                                @foreach ($periodo_en_carga[0] as $element =>$u)
                                <a class="btn btn-primary dropdown-item" href="{{ url('/pservicio', $u->id_periodo) }}">
                                    Altas y Bajas Servicio Educativo {{$u->periodo}}</a>
                                @endforeach
                                @if (Auth::user()->id == '12' | Auth::user()->id == '2' | Auth::user()->id == '25' |
                                Auth::user()->id == '22691' )
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-header"><b> {{ __('Relevamientos Finalizados') }}</b></div>

                                @foreach ($periodo_en_carga[1] as $element =>$u)
                                <a class="btn btn-primary dropdown-item" href="{{ url('/pservicio', $u->id_periodo) }}">
                                    Altas y Bajas Servicio Educativo {{$u->periodo}}</a>
                                @endforeach
                                @endif

                            </div>
                        </li>
                        @endrole
                        @role('admin|supervisor')
                        <!-- Procesos -->
                        <li class="nav-item dropdown">
                            <a class="btn btn-primary dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Procesos') }}
                            </a>
                            <div class="btn btn-primary dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="btn btn-primary dropdown-item"
                                    href="{{ url('/select_periodo',['$ruta'=>'proceso_articulacion', '$titulo'=>'Articular Relevamiento con Padron' ]) }}">{{ __('Articular') }}</a>
                                <a class="btn btn-primary dropdown-item"
                                    href="{{ url('/select_periodo',['$ruta'=>'confirmar_completos', '$titulo'=>'Confirmar Formularios Completos']) }}">{{ __('Confirmar Formularios') }}
                                </a>
                                <a class="btn btn-primary dropdown-item"
                                    href="{{ url('/select_periodo',['$ruta'=>'revisar_consistencias', '$titulo'=>'Revisar consistencias de todos los formularios']) }}">{{ __('Revisar consistencias de todos los formularios') }}
                                </a>
                                <a class="btn btn-primary dropdown-item"
                                    href="{{ url('/generar_formularios') }}">{{ __('Generar Formularios') }} </a>
                                <a class="btn btn-primary dropdown-item"
                                    href="{{ url('/actulizar_users') }}">{{ __('Actualizar usuarios RA') }} </a>
                            </div>
                        </li>
                        @endrole {{--  fin procesos  --}}

                        @role('admin|supervisor')
                        <!-- mailinf -->
                        <li class="nav-item dropdown">
                            <a class="btn btn-primary dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Envio de E-Mail') }}
                            </a>
                            <div class="btn btn-primary dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach ($periodo_en_carga[0] as $element =>$u)
                                @if ($u->momento !='C')
                                <a class="btn btn-primary dropdown-item"
                                    href="{{ url('/mailing', $u->id_periodo) }}">{{ __('Envio e-mail ') }}{{$u->periodo}}
                                </a>
                                @endif
                                @endforeach

                            </div>
                        </li>
                        @endrole {{--  fin mailing  --}}

                        @role('admin') {{--  usuarios  --}}
                        <li class="nav-item dropdown">
                            <a class="btn btn-primary dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Configuración') }}
                            </a>
                            <div class="btn btn-primary dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="btn btn-primary dropdown-item"
                                    href="{{ url('/usuarios') }}">{{ __('Usuarios') }}</a>
                                <a class="btn btn-primary dropdown-item"
                                    href="{{ url('/periodo') }}">{{ __('Periodos') }} </a>
                            </div>
                        </li>
                        @endrole {{--  fin usuarios  --}}

                    </ul>
                    @endauth
                    <ul class="navbar-nav ml-auto">
                        @guest
                        <!-- <li> <a class="btn btn-primary" href="{{ url('/') }}">{{ __('INICIO') }}</a> </li> -->
                        @else
                        <li class="nav-item dropdown">
                            @role('director_escuela')
                            <a id="navbarDropdown" class="btn btn-primary dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('Bienvenido ') }}{{ Auth::user()->username }} <span class="caret"></span>
                            </a>
                            @else
                            <a id="navbarDropdown" class="btn btn-primary dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('Bienvenido ') }}{{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            @endrole
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar Sesíon') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo_gba_footer.svg') }}" width="220">
            </a>
        </nav>
    </div>
    <main class="py-1">
        @yield('content')
    </main>
</body>
@jquery
@toastr_js
@toastr_render
<script>
document.addEventListener('keypress', function(evt) {
    if (evt.key !== 'Enter') {
        return;
    }
    let element = evt.target;
    if (!element.classList.contains('focusNext')) {
        return;
    }
    let tabIndex = element.tabIndex + 1;
    var next = document.querySelector('[tabindex="' + tabIndex + '"]');
    if (next) {
        next.focus();
        event.preventDefault();
    }
});
</script>
@yield('js')

</html>