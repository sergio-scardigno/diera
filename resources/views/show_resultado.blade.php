@extends('layouts.app')
@section('content')  
<div class="container-fluid">{{--  Container  --}}  
  <div class="row justify-content-center">  {{--  Center  --}}
   <div class="col-sm-6">  {{--  Datos  --}}       
     <div class="card">  {{--  Card  --}}
         <div class="card-header separa_datos"><b>{{$msg2}}</b></div>
         <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <div class="table-responsive">      
              <table class="table table-md table-hover">                     
                <thead class="thead-dark">
                  <tr >          
                     <th>Cueanexo</th>
                     <th>Código Jurisdiccional</th>
                     <th>Localización</th>
                     <th>Estado</th>                                           
                     <th colspan="3"></th>
                </tr> 
                </thead>  
                <tbody>
                  @foreach ($msg as $key => $value)
                     <tr>
                        <td> {{$value['cueanexo']}} </td>
                        <td> {{$value['codigo_jurisdiccional']}} </td>
                        <td> {{$value['loca']}} </td>
                        <td> {{$value['msg']}} </td>         
                     </tr>                  
                   @endforeach      
                </tbody>
              </table>
            </div>
          </li>
        </ul>
        <ul class="pagination justify-content-center">            
        <br> 
              <a class="btn btn-primary" href="{{ url('/select_periodo',['$ruta'=>$ruta, '$titulo'=>$titulo ]) }}">Volver</a>                
        </ul>

      </div> {{-- div card --}}
    </div>  {{--  Datos  --}} 
  </div> {{--  Center  --}} 
</div>  
@endsection 