@extends('layouts.app')
@section('content')
  <div class="panel-body">        
    <div class="panel panel-default">    
      <h4 align="Center">PERIODOS</h4>             
      <table>
        <tr>
            {!!Form::open(['url'=>'periodos','method'=>'GET','class'=>'navbar-form navbar-left','role'=>'search'])!!}
            {!! csrf_field() !!} 
             <a href="{{ url('/newperiodo') }}" class=  "btn btn-primary">Nuevo Periodo</a>  
            {!! Form::close()!!}                      
        </tr>
      </table>

        
    </div> 
    <div class="table-responsive">      
      <table class="table table-md table-hover">
        <caption>Periodos</caption>
        <thead class="thead-dark">
          <tr >          
              <th>Periodo</th>
              <th>Año</th>
              <th>Momento</th>                   
              <th>En carga</th>
              <th>Fecha corte de alta</th>
              <th>Fecha inicio</th>
              <th>Fecha fin</th>            
             <th colspan="2"></th>
        </tr> 
        </thead>  
        <tbody>         
            @foreach ($periodos as $element =>$u)  
            <tr>
              <td>{{$u->periodo}}</td>
             <td>{{$u->año}}</td>
             <td>{{$u->momento}}</td>                    
             <td>{{$u->en_carga}}</td>
             <td>{{$u->fecha_cortedealtas}}</td>
             <td>{{$u->fecha_inicio}}</td>
             <td>{{$u->fecha_fin}}</td>		              			
             <td>                          
                 <form action=" {{ url('editperiodo',[$u->id_periodo]) }}" method="POST">
                   {{ csrf_field() }}                       
                   {{Form::button('<i class="fa fa-edit"></i>', 
                     array('type' => 'submit', 
                          'value'=>'Editar',                                
                          'class' => 'btn btn-primary'))}}
                 </form>    
             </td>
             </tr>
         @endforeach           
      </tbody>              
    </table>
    <ul class="pagination justify-content-center">       
        {!! $periodos->appends(Request::capture()->except('page'))->render() !!} 
    </ul>
  </div>
@endsection  