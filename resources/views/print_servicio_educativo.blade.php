<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'DIE') }}</title>
    @section('css')  
		<style>
		.page-break {
		    page-break-after: always;
		}
		</style>         
    @show
</head>
<body><br> 

     <p> <font size="1">DIRECCIÓN GENERAL DE CULTURA Y EDUCACIÓN  - DIRECCIÓN DE INFORMACIÓN Y ESTADÍSTICA </font> 
        <img align="right" src="{{ asset('images/logo_provincia.jpg') }}" width="150">  </p>
        
		 <br><br>
		 <h3>PLANILLA DE ALTAS, BAJAS Y NOVEDADES DE SERVICIOS EDUCATIVOS</h3><br>
		<h3>{{$servicios_educativos->periodo}}</h3>

  	 <p>			 
		 Distrito:  {{$servicios_educativos->distrito}} <br>
		 Rama de enseñanza: {{$servicios_educativos->rama}} <br>
		 Número de Establecimiento:  {{$servicios_educativos->esc_nro}} <br>
		 Establecimiento:{{$servicios_educativos->nombre}}<br>
		 Calle:  {{$servicios_educativos->calle}}  Nro: {{$servicios_educativos->nro}} <br>
		 Movimiento: {{$servicios_educativos->alta_baja}} <br>
		 Motivo: {{$servicios_educativos->causa}} <br>
		 Fecha: {{$servicios_educativos->fecha}} <br>
		 Observaciones: {{$servicios_educativos->observaciones}} <br><br>

		 Planilla enviada por: {{$servicios_educativos->name}}  <br>
		 Nombre de usuario: {{$servicios_educativos->username}} <br>		 
   </p>

	 Numero de nota:  @if ($servicios_educativos->nronota != 0)  {{$servicios_educativos->nronota}} @endif <br>		 
	 
@php $now = new \DateTime();@endphp

<p>Impreso el @php echo $now->format('d-m-Y H:i:s');@endphp</p>

</body>
</html>    