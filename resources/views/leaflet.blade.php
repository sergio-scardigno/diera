@extends('layouts.app')
@section('css')
  <link href="{{ asset('leaflet/leaflet.css') }}" rel="stylesheet">

  <style>
    #map2 {width: 600px; height: 460px;}
  </style>

  @stop
  @section('js')
  <script src="{{ asset('leaflet/leaflet.js') }}" ></script>
  <script>
    var map2 = L.map('map2', {
      center: [-36.6083, -60.1712],              
      maxZoom: 15,  minZoom: 6,
      maxBounds:[ 
          [-41.0363, -63.393 ], 
          [-33.2641, -56.6641]
          ], 
      zoom: 5});
  
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map2)
  </script>
@stop
@section('content')
  <div id ="map2"> </div>  


@stop   



{{--  
<!DOCTYPE html>
<html>
<head>
  <link href="{{ asset('leaflet/leaflet.css') }}" rel="stylesheet">
  <script src="{{ asset('leaflet/leaflet.js') }}" ></script>
  <style>
    #map2 {width: 600px; height: 460px;}
  </style>

  <title>Js</title>
</head>
<body>
    <div id ="map2"> </div>                 
  <script>
    var map2 = L.map('map2', {
      center: [-36.6083, -60.1712],              
      maxZoom: 15,  minZoom: 6,
      maxBounds:[ 
          [-41.0363, -63.393 ], 
          [-33.2641, -56.6641]
          ], 
      zoom: 5});
  
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map2);
  
  </script>


</body>
</html>  --}}
       