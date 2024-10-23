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
@if (isset($chartcarga))            
        {!! $chartcarga->render() !!}     
@endif 

    <script type="text/javascript">
         $(window).on('load', function(){
            $(".loader").fadeOut("slow");
        });
    </script>
@endsection

