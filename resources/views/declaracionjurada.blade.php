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
  	 <p>CUE-ANEXO: {{$formulario->cueanexo}} <br>
  	 Código Jurisdiccional:{{$formulario->codigo_jurisdiccional}} <br>
  	 Establecimiento:{{$formulario->esc_nombre}}<br>
  	 Carga Web Relevamiento: {{$formulario->nombre}}<br>

    <!-- {{$formulario->nombre_corto}}<br>
    {{$formulario->descripcion}}<br> -->
   </p>
<p align="center">DECLARACIÓN JURADA</p>

Declaro que:<br>
Los datos consignados en la planilla impresa del Relevamiento de  {{$formulario->nombre}} se corresponden totalmente con los ingresados en el sistema de carga Web. 
<br>
	Fecha de finalización de carga:{{$formulario->fecha_fin_carga}}	
 </p>
<br><br><br><br><br><br>

<p align="center"> Firma y Sello </p>
<br><br><br>
@php $now = new \DateTime();@endphp

<p>Impreso el @php echo $now->format('d-m-Y H:i:s');@endphp</p>

</body>
</html>    