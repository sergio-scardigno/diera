@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header separa_datos"><b>Enviar E-Mail</b></div>
         <ul class="list-group list-group-flush">
            <li class="list-group-item">       

              <h3><b>{{$enviar_a->nombre}}  <br>Código jurisdiccional: {{$enviar_a->codigo_jurisdiccional}} - Cueanexo {{$enviar_a->cueanexo}}</b></h3>               
              <div class="form-row"> <!-- div de form-row  -->              
                <div class="col-6">
                  <label for="email">E-mail </label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" value="{{$enviar_a->email}}" readonly>                        
               
                </div> <!-- div de col  --> 
                <div class="col-6">
                  <label for="email2">Otro E-mail </label>
                    <input type="email" class="form-control"  name="email2" id="email2" value="{{$enviar_a->email2}}" readonly>                        
            
                </div> <!-- div de col  --> 
              </div>
              <li class="list-group-item separa_datos">Responsable</li>            
              <li class="list-group-item">
                <div class="form-row"> <!-- div de form-row  -->              
                  <div class="col-6">
                    <label for="responsable">Apellido y Nombre </label>
                      <input type="text" class="form-control" name="responsable" id="responsable" value="{{$enviar_a->responsable}}" readonly>
            
                  </div> <!-- div de col  --> 
                  <div class="col-6">
                    <label for="email_resp">E-mail </label>
                      <input type="email" class="form-control" name="email_resp" id="email_resp"  value="{{$enviar_a->email_resp}}" readonly>                        
         
                  </div> <!-- div de col  --> 
                </div>
              </li>
              <li class="list-group-item separa_datos">Redactar</li>  
              <!-- <form action=" {{ url('enviodemail',[$enviar_a->codigo_jurisdiccional]) }}" method="GET"> -->
              <form action=" {{ url('mail_personalizado',[$enviar_a->codigo_jurisdiccional, $p]) }}" method="GET">
              <li class="list-group-item">
                <div class="form-row"> <!-- div de form-row  -->              
                  <div class="col-6">
                      <label for="Para">Para (No ingresar mas de un e-mail) </label> 
                      {{-- poner un msj que separen las direcciones con ; --}}
                      <input type="email" class="form-control focusNext" name="Para" id="Para" aria-describedby="Para"
                      value="{{$enviar_a->email_resp}}" tabindex="1" required autofocus>
                      <br>
                      <label for="CC">CC (No ingresar mas de un e-mail)</label>
                      <input type="email" class="form-control focusNext" name="CC" id="CC" aria-describedby="CC"  value="" tabindex="2"  autofocus>
                      <br>
                      <textarea placeholder="Escribe aquí el texto..." name="texto" class="form-control focusNext" cols="85" rows="10" tabindex="3" required autofocus></textarea>  
  
                  </div>
                </div>
              </li> 
              </ul>
               <div class="col-md-6 offset-md-5"> 
                {{Form::button('Enviar', array('class' => 'btn btn-primary','type' => 'submit', 'title'=>'Enviar e-mail'))}}
                <a class="btn btn-primary" href="{{ route('mailing', $p) }}">Volver página anterior </a>                
              </div>      
            </form>
       
     </div> 
    </div>
  </div>
</div>

@endsection
