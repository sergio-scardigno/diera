
@section('content') 
 <div class="container">
  <div class="panel panel-default">
   <div class="panel-heading-custom panel-heading heading">
    <div class="panel-body"> 
     <div class="table-responsive">            
      
       <table class="table table-hover table-condensed table-bordered cuadro"> 
         <!-- <tr><th colspan="14" class="titulo1">Listado</th></tr>                         -->
           <tr>          
            <th class="titulo1">Cue-Anexo</th>            
            <th class="titulo1">Código Jurisdiccional</th>
            <th class="titulo1">Nombre</th>
            <th class="titulo1">Distrito</th>
            <th class="titulo1">Estado</th>  
          </tr>
            
            @foreach ($localizacion as $element =>$u)  
              <tr>     
              <td align="left"><b>{{$u->cueanexo}}</b></td>
              <td align="left"><b>{{$u->codigo_jurisdiccional}}</b></td>
              <td align="left"><b>{{$u->nombre}}</b></td>
              <td align="left"><b>{{$u->departamento}}</b></td>
              <td align="left"><b>{{$u->descripcion}}</b></td>
             </tr> 
            @endforeach        
       </table>           
    

  </div> </div></div></div>
@endsection