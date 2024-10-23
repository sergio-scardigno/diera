<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">  
        <meta http-equiv="Cache-Control" content="no-store">
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="-1" />        
        <meta name="keywords" content="Relevamiento Inicial, Relevamiento Final, Dirección de Información y Estadística, mapaescolar">
        <meta name="description" content="Sistema de carga del Relevamiento Inicial y Final de la Dirección de Información y Estadística">
        <title>{{config('app.name')}}</title>        
        <link rel="stylesheet" href="page_inicial/css/page_ini.min.css">
        <link rel="stylesheet" href="page_inicial/js/fancybox/jquery.fancybox.min.css"> 
        <link rel="stylesheet" href="page_inicial/css/style.min.css">  
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">  -->
    </head>
    <body>

        <header>
            <div class="main-menu">
              <div class="container">
                <div class="row">
                  <div class="col-md-4">
                      <img src="images/logo_gba_footer.svg" width="150">
                  </div>
                  <div class="col-md-8">
                    <div class="dropdown">
                      <ul class="nav nav-pills">
                        @if (Route::has('login'))
                          @if (Auth::check())                   
                             <li class="active"> <a href="home">Inicio</a></li>
                            @else
                             <li class="active"> <a href="{{ route('login') }}">Acceder</a></li> 
                            @endif
                        @endif
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </header>

          <div id="main-content">
              <div class="container">
                <div class="row">
                  <div class="big-box">
                    <div class="col-lg-12">
                      <div class="col-md-4">
                        <div class="box-bg">
                          <div class="wow bounceInLeft" data-wow-duration="2s" data-wow-delay="0.9s">
                            <div class="align-center">                   
                              <a href="http://mapaescolar.abc.gob.ar/ra2019/" target="_blank"><i class="fa fa-columns fa-5x"></i></a>
                              <h4 class="text-bold">RELEVAMIENTO ANUAL 2019</h4>
                               <p>RA WEB / Relevamiento Anual 2019.</p>                    
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="box-bg">
                          <div class="wow bounceInLeft" data-wow-duration="2s" data-wow-delay="0.9s">
                            <div class="align-center">
                              <a  href="{{ url('/localizacion', 83) }}"><i class="fa fa-table fa-5x"></i></a>
                              <h4 class="text-bold">RELEVAMIENTO INICIAL 2019</h4>
                               <p>Sistema de carga del relevamiento Inicial.</p>                    
                            </div>
                          </div>
                        </div>
                     </div>
          
                     <div class="col-md-4">
                        <div class="box-bg">
                          <div class="wow bounceInLeft" data-wow-duration="2s" data-wow-delay="0.9s">
                            <div class="align-center">
                              <a href="{{ route('planillas') }}"><i class="fa fa-download fa-5x"></i></a>
                              <h4 class="text-bold">Descarga de Planillas</h4>
                               <p>Descarga de las planilla del relevamiento Final 2023.</p>                    
                            </div>
                          </div>
                        </div>
                      </div>

                </div>
              <div class="col-lg-12">
                      <div class="col-md-6">
                        <div class="box-bg">
                          <div class="wow bounceInLeft" data-wow-duration="2s" data-wow-delay="0.6s">
                            <div class="align-center">                                     
                              <a href="{{ route('relant') }}"><i class="fa fa-search fa-5x"></i></a>
                              <h4 class="text-bold">CONSULTAS DE RELEVAMIENTOS ANTERIORES</h4>
                              <p>RELEVAMIENTO ANUAL.</p>
                           
                            </div>
                          </div>
                        </div>
                      </div>
      
                      <div class="col-md-6">
                        <div class="box-bg">
                          <div class="wow bounceInLeft" data-wow-duration="2s" data-wow-delay="0.2s">
                            <div class="align-center">
                              <a href="http://mapaescolar.abc.gob.ar/mapaescolar" target="_blank"><i class="fa fa-map-o fa-5x"></i></a>
                              <h4 class="text-bold">MAPAESCOLAR</h4>
                              
                              <p>El Mapa Escolar ubica Unidades Educativas y otros organismos educativos en cartografía digital y los vincula a distintas bases de datos a fin de generar información múltiple y contextualizada geográficamente.
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
          
          
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end column content -->
            <footer>
              <section id="footer" class="section footer">
                <div class="container">
                  <div class="row animated opacity mar-bot20" data-andown="fadeIn" data-animation="animation">
                    <div class="col-sm-12 align-center">
                      <h5 class="credits">
                    <address class="credits"><strong>Dirección de Información y Estadística</strong><br>           
                       Calle 8  N° 713</address>          
                      0800-222-2338  (0221)483-6721 RPV 21402/21340 <br> <br>
                      die.relevamientos@gmail.com 
                     </h5>
                    </div>
                  </div>
                  <div class="row align-center copyright">
                    <div class="col-sm-12 text-center">
                      <!-- Copyright &copy; DIE -->
                      <img src="images/logo_gba_footer.svg" width="150">
                      <!-- <div class="credits">
                           <a href=""></a>
                    </div> -->
                  </div>
                </div>
              </section>
              <a href="#" class="scrollup"><i class="fa fa-chevron-up"> </i></a>
            </footer>
            <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
             -->
            <script src="page_inicial/js/jquery.min.js"></script>
            <script src="page_inicial/js/fancybox/jquery.fancybox.pack.js"></script>
            <script src="page_inicial/js/wow.min.js"></script>
            


            <script type="text/javascript">                   
                // toastr["info"]("Relevamiento Anual 2019 habilitado para la carga.", "RELEVAMIENTO ANUAL 2019");
                // toastr.options = {
                //   "closeButton": true,
                //   "debug": false,
                //   "newestOnTop": false,
                //   "progressBar": false,
                //   "positionClass": "toast-top-center",
                //   "preventDuplicates": false,
                //   "onclick": null,
                //   "showDuration": "300",
                //   "hideDuration": "1000",
                //   "timeOut": "5000",
                //   "extendedTimeOut": "1000",
                //   "showEasing": "swing",
                //   "hideEasing": "linear",
                //   "showMethod": "fadeIn",
                //   "hideMethod": "fadeOut"
                // }   
              
              new WOW().init();
            </script>
            <script type='text/javascript' data-cfasync='false'>window.purechatApi = { l: [], t: [], on: function () { this.l.push(arguments); } }; (function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({c: 'bdee6a03-0247-42dd-a427-bf6185a67a24', f: true }); done = true; } }; })();</script>
    </body>
</html>
