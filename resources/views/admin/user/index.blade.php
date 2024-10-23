@extends('layouts.app')
@section('content')
  <div class="panel-body">        
    <div class="panel panel-default">    
      <h4 align="Center">LISTADO DE USUARIOS</h4>             
      <table>
        <tr>
          {!!Form::open(['url'=>'usuarios','method'=>'GET','class'=>'navbar-form navbar-left','role'=>'search'])!!}
          {!! csrf_field() !!} 
           <th>
            <label for="name">Nombre 
              <input name='name' type="text" value="{{$filter_user['filter_name']}}" class="form-control" placeholder="Nombre"></label>
            </th>
            <th>
              <label for="username">Nombre de usuario 
                <input name='username' type="text" value="{{$filter_user['filter_username']}}" class="form-control" placeholder="Nombre de usuario"></label>
            </th>
            <th>
            <label for="rol">Perfil
              <select value="" name="rol" id="rol" class="form-control">
                <option value="">Todas los perfiles</option>  
                  @foreach ($roles as $element =>$rol)
                    @if ($rol->name==$filter_user['filter_rol']) 
                      <option value="{{$rol->name}}" selected="selected">{{$rol->name}}</option>
                    @else   
                      <option value="{{$rol->name}}">{{$rol->name}}</option>
                    @endif
                  @endforeach
              </select></label>
            </th>

            <th>            
              {{Form::button('Aplicar filtro', array('type' => 'submit',   'name' => 'submitbutton',
              'value'=>'filter-user-true', 'class' => 'btn btn-primary', 'title'=>'Aplicar filtro a la grilla'))}}
            </th>
            <th>  
              @if ($filter_user['filter_user_aplicado'])
                {{Form::button('Quitar filtro', array('type' => 'submit',  'name' => 'submitbutton',
                 'value'=>'filter-user-false', 'class' => 'btn btn-primary', 'title'=>'Quitar filtro a la grilla'))}}     
             @endif 
            </th>

            
            <th>
              <a href="{{ url('/newuser') }}" class=  "btn btn-primary">Agregar usuario</a> 
            </th>
          {!! Form::close()!!}  
        </tr>
      </table>

        
    </div> 
    <div class="table-responsive">      
      <table class="table table-md table-hover">
        <caption>Usuarios</caption>
        <thead class="thead-dark">
          <tr >          
            <th>Nombre</th>
            <th>Nombre de usuario</th>
            <th>Perfil</th>  
            <th>E-mail</th>            
            <th colspan="3"></th>
        </tr> 
        </thead>  
        <tbody>         
          @foreach ($users as $element =>$u)  
                   <tr>
                     <td>{{$u->name}}</td>
                     <td>{{$u->username}}</td>
                     <td>{{$u->rol}}</td>
                     <td>{{$u->email}}</td>                     
                    <td>                          
                        <form action=" {{ url('edituser',[$u->id]) }}" method="POST">
                          {{ csrf_field() }}                       
                          {{Form::button('<i class="fa fa-edit"></i>', 
                            array('type' => 'submit', 'title'=>'Editar datos','value'=>'Editar',                                
                                 'class' => 'btn btn-primary'))}}
                        </form>    

                    </td>
                    <td>                                          
                        <form action=" {{ url('deleteuser',[$u->id]) }}" method="POST">
                          {{ csrf_field() }}     
                          {{Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', 
                            array('type' => 'submit', 'title'=>'Eliminar usuario',
                                 'value'=>'Eliminar',                                 
                                 'onclick'=>'return confirm("Esta seguro?")', 
                                 'class' => 'btn btn-danger'))}}
                        </form>           
                     </td>     
                     <td>
                      <form action=" {{ url('edituserpass',[$u->id]) }}" method="POST">
                          {{ csrf_field() }}                      
                          {{Form::button('<i class="fa fa-key"></i>', 
                            array('type' => 'submit', 'value'=>'EditarPass', 'title'=>'Cambiar password',
                                 'class' => 'btn btn-success'))}}

                        </form>  
                     </td>
                    </tr>
                @endforeach           
      </tbody>              
    </table>
    <ul class="pagination justify-content-center">       
        {!! $users->appends(Request::capture()->except('page'))->render() !!} 
    </ul>
  </div>
@endsection