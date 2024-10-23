<!doctype html>
<html lang="{{ config('app.locale') }}">
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">  
  <meta http-equiv="Cache-Control" content="no-store">
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="-1" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="Relevamiento Inicial, Relevamiento Final, Dirección de Información y Estadística, mapaescolar">
  <meta name="description" content="Sistema de carga del Relevamiento Inicial y Final de la Dirección de Información y Estadística">
  <title>{{config('app.name')}}</title> 
   <link rel="stylesheet" href="../page_inicial/css/page_ini.min.css">
   <link rel="stylesheet" href="../page_inicial/js/fancybox/jquery.fancybox.min.css"> 
   <link rel="stylesheet" href="../page_inicial/css/style.min.css">   
</head>
<body>
  <header>
    <div class="main-menu">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
              <img src="../images/logo_gba_footer.svg" width="150">
          </div>
          <div class="col-md-8">
            <div class="dropdown">
              <ul class="nav nav-pills">                                
                <li class="active"> <a href="/diera/home/">Volver</a></li>                     
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- column content -->
  @php $path="../pdf/".str_replace(' ', '',$periodo); $p=strtoupper($periodo); @endphp
  <div id="main-content">
    <div class="container">
    	<div class="col-lg-12"><h4>FORMULARIOS DEL RELEVAMIENTO {{$p}}</h4></div>	<br>
      <div class="row">
        <div class="big-box">

          <div class="col-lg-12">
            <div class="col-md-3">              
              <div class="box-bg">
                <div class="wow bounceInLeft" data-wow-duration="2s" data-wow-delay="0.9s">
                  <div class="align-center">
                   {{-- style="color:Tomato">	 --}}
                    <a href="{{$path}}/01 Ed. Inicial.pdf" download><i class="fa fa-file-pdf-o fa-2x"></i></a>
                    <h4 class="text-bold">EDUCACIÓN INICIAL</h4>                     
                  </div>
                </div>
              </div>
          </div>
            <div class="col-md-3">   	         
              <div class="box-bg">
                <div class="wow bounceInLeft" data-wow-duration="2s" data-wow-delay="0.9s">
                  <div class="align-center">
                    <a href="{{$path}}/02 Ed. Primaria.pdf" download><i class="fa fa-file-pdf-o fa-2x"></i></a>
                    <h4 class="text-bold">EDUCACIÓN PRIMARIA</h4>                                   
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="box-bg">
                <div class="wow bounceInLeft" data-wow-duration="2s" data-wow-delay="0.6s">
                  <div class="align-center">                    
                    <a href="{{$path}}/03 Ed. Secundaria.pdf" download><i class="fa fa-file-pdf-o fa-2x"></i></a>
                    <h4 class="text-bold">EDUCACIÓN SECUNDARIA</h4>                                     
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="box-bg">
                <div class="wow bounceInLeft" data-wow-duration="2s" data-wow-delay="0.6s">
                  <div class="align-center">                    
                    <a href="{{$path}}/04 Ed. Superior.pdf" download><i class="fa fa-file-pdf-o fa-2x"></i></a>
                    <h4 class="text-bold">EDUCACIÓN SUPERIOR</h4>                                     
                  </div>
                </div>
              </div>
            </div>


          </div>
{{--  --}}
         <div class="col-lg-12">
            <div class="col-md-3">              
              <div class="box-bg">
                <div class="wow bounceInLeft" data-wow-duration="2s" data-wow-delay="0.9s">
                  <div class="align-center">
                    <a href="{{$path}}/05 Ed. de Adultos (EPA).pdf" download><i class="fa fa-file-pdf-o fa-2x"></i></a>
                    <h4 class="text-bold">EDUCACIÓN PRIMARIA DE ADULTOS</h4>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3">         
              <div class="box-bg">
                <div class="wow bounceInLeft" data-wow-duration="2s" data-wow-delay="0.9s">
                  <div class="align-center">
                    <a href="{{$path}}/06 CENS-CEBAS.pdf" download><i class="fa fa-file-pdf-o fa-2x"></i></a>
                    <h4 class="text-bold">EDUCACIÓN SECUNDARIA DE ADULTOS</h4>                                   
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="box-bg">
                <div class="wow bounceInLeft" data-wow-duration="2s" data-wow-delay="0.6s">
                  <div class="align-center">                    
                    <a href="{{$path}}/07 Ed. Especial.pdf" download><i class="fa fa-file-pdf-o fa-2x"></i></a>
                    <h4 class="text-bold">EDUCACIÓN ESPECIAL</h4>                                     
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="box-bg">
                <div class="wow bounceInLeft" data-wow-duration="2s" data-wow-delay="0.6s">
                  <div class="align-center">                    
                    <a href="{{$path}}/08 Ed. Artística.pdf" download><i class="fa fa-file-pdf-o fa-2x"></i></a>
                    <h4 class="text-bold">EDUCACIÓN ARTÍSTICA</h4>                                     
                  </div>
                </div>
              </div>
            </div>


          </div>
{{--  --}}
{{--  --}}
         <div class="col-lg-12">
            <div class="col-md-3">              
              <div class="box-bg">
                <div class="wow bounceInLeft" data-wow-duration="2s" data-wow-delay="0.9s">
                  <div class="align-center">
                    <a href="{{$path}}/09 Form. Profesional.pdf" download><i class="fa fa-file-pdf-o fa-2x"></i></a>
                    <h4 class="text-bold">FORMACIÓN PROFESIONAL</h4>                     
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3">            
              <div class="box-bg">
                <div class="wow bounceInLeft" data-wow-duration="2s" data-wow-delay="0.9s">
                  <div class="align-center">
                    <a href="{{$path}}/10 Centro Ed. Complementario.pdf" download><i class="fa fa-file-pdf-o fa-2x"></i></a>
                    <h4 class="text-bold">CENTRO EDUCATIVO COMPLEMENTARIO	</h4>                                    
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="box-bg">
                <div class="wow bounceInLeft" data-wow-duration="2s" data-wow-delay="0.6s">
                  <div class="align-center">                    
                    <a href="{{$path}}/11 Centros de Ed. Física.pdf" download><i class="fa fa-file-pdf-o fa-2x"></i></a>
                    <h4 class="text-bold">CENTROS DE EDUCACIÓN FÍSICA</h4>                                     
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="box-bg">
                <div class="wow bounceInLeft" data-wow-duration="2s" data-wow-delay="0.6s">
                  <div class="align-center">                    
                    <a href="{{$path}}/12 CIEs.pdf" download><i class="fa fa-file-pdf-o fa-2x"></i></a>
                    <h4 class="text-bold">CIE</h4>                                     
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
             Calle 54 N° 695 / 693</address>          
            0800-222-2338  (0221)483-6721 RPV 21402/21340 <br> <br>
            die.relevamientos@gmail.com 
           </h5>
          </div>
        </div>
        <div class="row align-center copyright">
          <div class="col-sm-12 text-center">
            <!-- Copyright &copy; DIE -->
            <img src="../images/logo_gba_footer.svg" width="150">
            <!-- <div class="credits">
                 <a href=""></a>
          </div> -->
        </div>
      </div>
    </section>
    <a href="#" class="scrollup"><i class="fa fa-chevron-up"> </i></a>
  </footer>
  
  <script src="../page_inicial/js/jquery.min.js"></script>
  <script src="../page_inicial/js/fancybox/jquery.fancybox.pack.js"></script>
  <script src="../page_inicial/js/wow.min.js"></script>
  <script type="text/javascript">
    new WOW().init();
  </script>
</body>
</html>