@extends('layouts.app')
@section('content') 
<div class="container-fluid">{{--  Container  --}}
<div class="row justify-content-center">  {{--  Center  --}}
    <div class="col-sm-6">  {{--  Datos  --}}
      <div class="card">  {{--  Card  --}}
        <div class="card-header separa_datos"><b>{{strtoupper($title)}}</b></div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              @foreach ($periodo as $element =>$u)  
              @if ($u->momento !='C') 
                <form action=" {{ url($ruta,[$u->id_periodo]) }}" method="POST">         
                  <meta name="csrf-token" content="{{ csrf_token() }}">
                  {!! csrf_field() !!}
                  {{Form::button( $u->periodo.' <i class="fa fa-refresh" style="font-size:24px;"></i>',  
                          array('type' => 'submit', 'value'=>'.$ruta.', 'class' =>'btn btn-primary',                
                            "id"=>"BtnEnviar",  'title'=>$title.' Id: '.$u->id_periodo))}}          
                </form> 
                <br>
              @endif 
              @endforeach
              @if(Session::has('flash_message_error'))
                <div class="alert alert-warning" data-auto-dismiss="1500">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class='fa fa-exclamation-triangle'>  {{Session::get('flash_message_error')}} </i></strong>
                  </div>
              @endif
              @if(Session::has('flash_message_ok'))
              <div class="alert alert-success" role="alert" data-auto-dismiss="1500">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class='fa fa-check-circle'>  {{Session::get('flash_message_ok')}} </i></strong>
                  </div>
              @endif   
            </li>                
          </ul>
        </div>
       </div>
    </div>
</div> 
@endsection