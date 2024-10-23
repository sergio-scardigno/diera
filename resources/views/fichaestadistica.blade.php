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

<div class="container-fluid">  
    <ul class="list-group list-group-flush">
     <li class="list-group-item">
       <b> {{$formulario->nombre}} </b> -
       <b>Código jurisdiccional:</b> {{$formulario->codigo_jurisdiccional}} <b> - CUE Anexo:</b> {{$formulario->cueanexo}}
     </li>
    </ul>   

  <div class="row"> 
    <div class="col-sm-2">
        <a class="btn btn-primary" href="{{ route('formulario',[$id_localizacion_periodo]) }}">Regresar a la pantalla anterior </a>
    </div>
  </div>
  <!-- 3.16 -->
  <div class="row"> 
    <div class="col-sm-6">
    @if (isset($chart316_1))            
        {!! $chart316_1->render() !!}
      <p style="width: 600;">{{$detalle_3_16_1}}</p> 
    @endif 
    
    </div>
    <div class="col-sm-6">
    @if (isset($chart316_2))            
        {!! $chart316_2->render() !!}   
        <p style="width: 600;">{{$detalle_3_16_2}}</p>            
    @endif  
   
    </div>
    <div class="col-sm-6">
    @if (isset($chart316_3))            
        {!! $chart316_3->render() !!}   
        <p style="width: 600;">{{$detalle_3_16_3}}</p>        
    @endif  
  
    </div>
  </div>
  <br>
  <!-- 3.17 -->
  <div class="row"> 
    <div class="col-sm-6">
    @if (isset($chart317_1))            
        {!! $chart317_1->render() !!}     
        <p style="width: 600;">{{$detalle_3_17_1}}</p>      
    @endif   
    </div>
    <div class="col-sm-6">
    @if (isset($chart317_2))            
       {!! $chart317_2->render() !!}         
       <p style="width: 600;">{{$detalle_3_17_2}}</p>  
    @endif  
    </div>
    <div class="col-sm-6">
    @if (isset($chart317_3))            
        {!! $chart317_3->render() !!}         
        <p style="width: 600;">{{$detalle_3_17_3}}</p>  
    @endif  
    </div>
  </div>
  <!-- 3.18 -->
  <br>
  <div class="row"> 
    <div class="col-sm-6">
    @if (isset($chart318_1))            
        {!! $chart318_1->render() !!}    
        <p style="width: 600;">{{$detalle_3_18_1}}</p>       
    @endif   
    </div>
    <div class="col-sm-6">
    @if (isset($chart318_2))            
        {!! $chart318_2->render() !!}
        <p style="width: 600;">{{$detalle_3_18_2}}</p>  
    @endif  
    </div>
    <div class="col-sm-6">
    @if (isset($chart318_3))            
        {!! $chart318_3->render() !!}
        <p style="width: 600;">{{$detalle_3_18_3}}</p>           
    @endif  
    </div>
  </div>
  <br>
    <!-- 3.20 -->
    <div class="col-sm-6">
    @if (isset($chart320_1))            
        {!! $chart320_1->render() !!}
      <p style="width: 600;">{{$detalle_3_20_1}}</p> 
    @endif 
    @if (isset($chart320_2))            
        {!! $chart320_2->render() !!}
      <p style="width: 600;">{{$detalle_3_20_2}}</p> 
    @endif 
    @if (isset($chart320_3))            
        {!! $chart320_3->render() !!}
      <p style="width: 600;">{{$detalle_3_20_3}}</p> 
    @endif 

    </div>
    <br>
    <!-- 3.21 -->
   
  <div class="row"> 
    <div class="col-sm-6">    
    @if (isset($chart321_1))            
        {!! $chart321_1->render() !!}       
        <p style="width: 600;">{{$detalle_3_21_1}}</p>    
    @endif   
    </div>
    <div class="col-sm-6">
    @if (isset($chart321_2))            
        {!! $chart321_2->render() !!}
        <p style="width: 600;">{{$detalle_3_21_2}}</p>         
    @endif  
    </div>
    <div class="col-sm-6">
    @if (isset($chart321_3))            
        {!! $chart321_3->render() !!}         
        <p style="width: 600;">{{$detalle_3_21_3}}</p>
    @endif  
    </div>    
  </div>

  <br>
    <!-- 44.1 -->
    <div class="row"> 
    <div class="col-sm-6">
    @if (isset($chart441_1))            
        {!! $chart441_1->render() !!}       
        <p style="width: 600;">{{$detalle_4_41_1}}</p>    
    @endif   
    </div>
    <div class="col-sm-6">
    @if (isset($chart441_2))            
        {!! $chart441_2->render() !!}
        <p style="width: 600;">{{$detalle_4_41_2}}</p>         
    @endif  
    </div>
    <div class="col-sm-6">
    @if (isset($chart441_3))            
        {!! $chart441_3->render() !!}         
        <p style="width: 600;">{{$detalle_4_41_3}}</p>
    @endif  
    </div>
  </div>
  <div class="row"> 
    <div class="col-sm-2">
        <a class="btn btn-primary" href="{{ route('formulario',[$id_localizacion_periodo]) }}">Regresar a la pantalla anterior </a>
    </div>
  </div>
  


    <script type="text/javascript">
         $(window).on('load', function(){
            $(".loader").fadeOut("slow");
        });
    </script>
@endsection
