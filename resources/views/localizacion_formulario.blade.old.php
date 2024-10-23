@extends('layouts.app')
@section('css')
  {{ Html::style('css/'.$formulario->color.'.css')}}
  {{ Html::style('css/die.css')}}  
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
  </style>
@stop

@section('content')
 <div class="container-fluid"> {{--  Container  --}} 
  <div class="loader"></div>
    <div class="card-header separa_datos">  {{-- Separa datos --}}
      <b>{{$formulario->nombre}} - {{$formulario->codigo_jurisdiccional}} - {{$formulario->cueanexo}} - {{$formulario->esc_nombre}} </b>
    </div> {{-- Fin Separa datos --}}
    
    {!!Form::model($formulario,['id'=>'formulario', 'url'=>['grabarformulario/'],'method'=>'POST'])!!}
    {!! csrf_field() !!}
    <input id="{{$formulario->id_localizacion_periodo}}" name="id_localizacion_periodo" type="number" value="{{$formulario->id_localizacion_periodo}}" hidden>
    <div class="panel panel-default">
      <div class="panel-heading-custom panel-heading heading">{{--  panel-heading-custom panel-heading heading --}}
        <div class="panel-body">  {{-- panel-body --}}
         @php $id=0; @endphp
         <div class="sucessMessages"></div>
          @foreach ($page as $element =>$u)
            @php $total_fil_titulos=0; $tot_fil_editables=0; $total_filas=0;@endphp
            <div class="card-header separa_datos"> <b>{{ $u->encabezado }}  {{ $u->numero }}) {{$u->nombre}}</b>
              @if ($u->ayuda<>'')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#help{{$u->numero}}">
                <i class="fa fa-question fa-lg" title="Ayuda del cuadro"></i>
                </button>
              @endif
            </div> <!-- separa datos -->

            <div class="modal" tabindex="-1" role="dialog"  id="help{{$u->numero}}" >
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title"><b>Cuadro {{ $u->numero }}) {{$u->nombre}}</b></h5>
                      <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        {{ $u->ayuda }}
                        <!-- <br><br>
                         @if ($u->encabezado =='DATOS DE LA INFRAESTRUCTURA')
                        <a href="https://www.carto.arba.gov.ar/cartoArba/" target="_blank">https://www.carto.arba.gov.ar/cartoArba/</a> <br><br>
                        <a href="../pdf/Instructivo BUSQUEDA de NOMENCLATURA CATASTRAL.pdf" download><i class="fa fa-file-pdf-o fa-2x"> Descargar Instructivo en PDF</i></a>
                        <br><br>
                        <img src="../images/arba/Arba-1.png" width="500"><br>
                        <img src="../images/arba/Arba-2.png" width="500"><br>
                        <img src="../images/arba/Arba-3.png" width="500"><br>
                        <img src="../images/arba/Arba-4.png" width="500"><br>
                        <img src="../images/arba/Arba-5.png" width="500"><br>
                        @endif  -->
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>

           <div class="table-responsive">
             @if (Auth::user()->level() < 6 and $formulario->c_estado_formulario <100 and $u->c_estado_cuadro!=87)
              @if ($u->c_criterio_completitud==2)
                @if ($u->c_estado_cuadro==85)
                  @if($u->c_tipo_cuadro!=4)
                    @php echo "<script> $(document).ready(function() {inhabilitar_cuadro($u->numero);});</script>"; @endphp
                    <input id="cuadros[{{$u->numero}}]" name="cuadros[{{$u->numero}}]" class="btn btn-primary focusNext" type="checkbox" checked onclick="inhabilitar_cuadro({{$u->numero}});">
                  @else
                    @php echo "<script> $(document).ready(function() {inhabilitar_cuadro_tipo4($u->numero);});</script>"; @endphp
                    <input id="cuadros[{{$u->numero}}]" name="cuadros[{{$u->numero}}]" class="btn btn-primary focusNext"  type="checkbox" checked onclick="inhabilitar_cuadro_tipo4({{$u->numero}});">
                  @endif
                  <label for="cuadros[{{$u->numero}}]"> Cuadro sin Información&nbsp;&nbsp;</label>
                @else
                  @if($u->c_tipo_cuadro!=4)
                    <input id="cuadros[{{$u->numero}}]" name="cuadros[{{$u->numero}}]"
                     class="btn btn-primary focusNext" type="checkbox" onclick="inhabilitar_cuadro({{$u->numero}});">
                  @else
                   <input id="cuadros[{{$u->numero}}]" name="cuadros[{{$u->numero}}]" class="focusNext"
                   type="checkbox" onclick="inhabilitar_cuadro_tipo4({{$u->numero}});">
                  @endif
                    <label for="cuadros[{{$u->numero}}]"> Cuadro sin Información&nbsp;&nbsp;</label>
                @endif
              @endif
              @if($u->c_tipo_cuadro!=4)
                <button id="agregar0{{$u->numero}}" type="button" class="btn btn-primary" onclick="agregar_ceros({{$u->numero}},{{$u->c_tipo_cuadro}});" title="Agregar cero/s (0) en las celdas vacias"><i class="fa fa-plus"></i> Agregar 0 </button>  &nbsp;&nbsp;
                <button id="quitar0{{$u->numero}}" type="button" class="btn btn-primary" onclick="quitar_ceros({{$u->numero}},{{$u->c_tipo_cuadro}});" title="Borrar cero/s (0) de las celdas"> <i class="fa fa-times"></i> Borrar 0 </button>  &nbsp;&nbsp;
              @endif
              
              @if($u->c_tipo_cuadro==2 or $u->c_tipo_cuadro==3 and Auth::user()->level() < 6 )
                 <button id="agregar_fila{{$u->numero}}" type="button" class="btn btn-primary" onclick="agregar_fila({{$u->numero}},{{$u->c_tipo_cuadro}});" title="Agregar una nueva fila en el cuadro" > <i class="fa fa-table"></i>  Nueva fila</button>  &nbsp;&nbsp;
              @endif
               <button id="limpiar_todo{{$u->numero}}" type="button" class="btn btn-primary" onclick="vaciar_cuadro({{$u->numero}},{{$u->c_tipo_cuadro}});" title="Limpiar todas las celdas del cuadro"> <i class="fa fa-eraser"></i> Limpiar cuadro </button>  &nbsp;&nbsp;
            @endif  {{-- (Auth::user()->level()  --}}
            <table id="tabla{{$u->numero}}" aria-describedby="tabla{{$u->numero}}Help" class="table table-bordered table-condensed cuadro">
              <tbody>
                @for ($fil=0; $fil<count($u->celdas); $fil++)
                  @if($u->c_tipo_cuadro==2)
                    @if ($u->celdas[$fil+1][1]->editable) @php  $tot_fil_editables=$tot_fil_editables+1; @endphp @endif
                    @if ($u->celdas[$fil+1][1]->titulo) @php  $total_fil_titulos=$total_fil_titulos+1; @endphp  @endif
                    @php $total_filas=$tot_fil_editables+$total_fil_titulos;@endphp
                  @endif
                  @if($u->c_tipo_cuadro==3)
                    @if ($u->celdas[$fil+1][1]->editable) @php $tot_fil_editables=$tot_fil_editables+1; @endphp @endif
                    @php $total_fil_titulos=count($u->celdas)-2; @endphp
                  @endif
                  <tr id="cuadros[{{$u->numero}}][{{$fil+1}}]" name="cuadros[{{$u->numero}}][{{$fil+1}}]">
                    @for ($col=0;$col<count($u->celdas[$fil+1] );$col++)
                      @if ($u->celdas[$fil+1][$col+1]->tipo_dato !='null' )
                        @if ($u->celdas[$fil+1][$col+1]->titulo)
                          <th colspan={{$u->celdas[$fil+1][$col+1]->colspan}} rowspan={{$u->celdas[$fil+1][$col+1]->rowspan}} class="{{$u->celdas[$fil+1][$col+1]->estilos}}" ><b>{{$u->celdas[$fil+1][$col+1]->valor}}</b>
                          </th>
                        @elseif ($u->celdas[$fil+1][$col+1]->editable)
                          @if ($u->celdas[$fil+1][$col+1]->c_categoria_consistencia ==1)
                            @if ($u->c_estado_cuadro==85)
                              <td class="deshabilitada">
                            @else
                            <td class="habilitada">
                            @endif
                          @elseif ($u->celdas[$fil+1][$col+1]->c_categoria_consistencia ==2)
                            <td class="advertencia">
                          @else
                            <td class="error">
                          @endif
                          @php $id=$id+1; @endphp
                          @if (Auth::user()->level() < 6 and $formulario->c_estado_formulario <100)
                           @if ($u->celdas[$fil+1][$col+1]->tipo_dato =='number')
                            <div align="center">
                              <input id="@php echo $id;@endphp" tabindex="@php echo $id;@endphp" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]" type="{{$u->celdas[$fil+1][$col+1]->tipo_dato}}" value="{{$u->celdas[$fil+1][$col+1]->valor }}" min="0"  style="text-align:right;"
                             class="form-control focusNext" title="{{$u->celdas[$fil+1][$col+1]->msg}}">
                            </div>
                           @elseif ($u->celdas[$fil+1][$col+1]->tipo_dato =='combobox' )
                            {{-- combobox       --}}
                          <!-- {{-- <input list="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]" id="@php echo $id;@endphp" tabindex="@php echo $id;@endphp"
                                class="form-control focusNext" title="{{$u->celdas[$fil+1][$col+1]->msg}}">
                            <datalist id="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]">                            
                                @foreach ($opciones_combos->wherein('id_combo', [$u->celdas[$fil+1][$col+1]->valor_inicial,0]) as $element =>$op)                                
                                  @if ($u->celdas[$fil+1][$col+1]->valor==$op->id_opciones_combos)
                                    <option value="{{$op->id_opciones_combos}}" selected="selected" label="{{$op->descripcion}}"> </option>
                                    @else<option value="{{$op->id_opciones_combos}}" label="{{$op->descripcion}}"> </option>
                                  @endif
                                @endforeach
                            </datalist>   --}} -->

<!-- {{-- <input list="suggestionList" id="@php echo $id;@endphp">
<datalist id="suggestionList"> 
  @foreach ($opciones_combos->wherein('id_combo', [$u->celdas[$fil+1][$col+1]->valor_inicial,0]) as $element =>$op)                                
    @if ($u->celdas[$fil+1][$col+1]->valor==$op->id_opciones_combos)
      <option data-value="{{$op->id_opciones_combos}}" value="{{$op->id_opciones_combos}}" selected="selected"> {{$op->descripcion}}" </option>
    @else<option data-value="{{$op->id_opciones_combos}}" value="{{$op->id_opciones_combos}}" label="{{$op->descripcion}}"> </option>
    @endif
  @endforeach
  
</datalist> 
<input type="text" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]" id="@php echo $id.'-hidden';@endphp" value="{{$op->id_opciones_combos}}">
<input type="text" name="answer" id="answerInput-hidden">  --}} -->


                               <select name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]" id="@php echo $id;@endphp" tabindex="@php echo $id;@endphp"
                                class="form-control focusNext" title="{{$u->celdas[$fil+1][$col+1]->msg}}">
                                @foreach ($opciones_combos->wherein('id_combo', [$u->celdas[$fil+1][$col+1]->valor_inicial,0]) as $element =>$op)
                                  @if ($u->celdas[$fil+1][$col+1]->valor==$op->id_opciones_combos)
                                    <option value="{{$op->id_opciones_combos}}" selected="selected">{{$op->descripcion}} </option>
                                    @else<option value="{{$op->id_opciones_combos}}">{{$op->descripcion}} </option>
                                  @endif
                                @endforeach
                              </select>

                              {{-- checkbox --}}
                           @elseif ($u->celdas[$fil+1][$col+1]->tipo_dato =='checkbox')
                              @if ($u->celdas[$fil+1][$col+1]->valor=='false')
                              <input  type="hidden" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]" value="false" >
                              <input  id="@php echo $id;@endphp" tabindex="@php echo $id;@endphp" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]"
                              type="{{$u->celdas[$fil+1][$col+1]->tipo_dato}}" title="{{$u->celdas[$fil+1][$col+1]->msg}}">
                              @else
                               <input type="hidden" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]" value="false" >
                                <input id="@php echo $id;@endphp" tabindex="@php echo $id;@endphp" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]"
                                  type="{{$u->celdas[$fil+1][$col+1]->tipo_dato}}" checked title="{{$u->celdas[$fil+1][$col+1]->msg}}">
                              @endif
                            {{-- radio  --}}
                          @elseif ($u->celdas[$fil+1][$col+1]->tipo_dato =='radio')
                            @php
                            $opciones = explode(';', $u->celdas[$fil+1][$col+1]->valor_inicial);
                            @endphp
                            @foreach ($opciones as $index_opcion => $opcion)
                                <label>
                                <input id="{{$id}}" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]"
                                        tabindex="{{$id}}" type="{{$u->celdas[$fil+1][$col+1]->tipo_dato}}"
                                        @if ($loop->iteration==$u->celdas[$fil+1][$col+1]->valor)
                                            checked
                                        @endif
                                        value="{{$loop->iteration}}" required >
                                        {{$opcion}}
                                </label>
                                <br>
                            @endforeach
                          {{-- fin radio button  --}}
                          @elseif ($u->celdas[$fil+1][$col+1]->tipo_dato =='date')
                          @if ($u->celdas[$fil+1][$col+1]->valor =='')
                            <input id="@php echo $id;@endphp" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]"
                              tabindex="@php echo $id;@endphp" type="{{$u->celdas[$fil+1][$col+1]->tipo_dato}}" value="0001-01-01" >
                          @else
                              <input id="@php echo $id;@endphp" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]"
                                tabindex="@php echo $id;@endphp" type="{{$u->celdas[$fil+1][$col+1]->tipo_dato}}" value="{{$u->celdas[$fil+1][$col+1]->valor }}" title="{{$u->celdas[$fil+1][$col+1]->msg}}">
                          @endif

                          @else  {{--  text--}}  {{-- textarea pasa por aca --}}
                            <input id="@php echo $id;@endphp" class="form-control focusNext" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]"  tabindex="@php echo $id;@endphp" type="{{$u->celdas[$fil+1][$col+1]->tipo_dato}}" value="{{$u->celdas[$fil+1][$col+1]->valor }}" title="{{$u->celdas[$fil+1][$col+1]->msg}}">
                          @endif {{-- if tipo de dato --}}
                        @else {{-- user level  > --}}

                          @if ($u->celdas[$fil+1][$col+1]->tipo_dato =='number' )
                            <div align="center">
                              <input  id="@php echo $id;@endphp" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]" type="{{$u->celdas[$fil+1][$col+1]->tipo_dato}}" value="{{$u->celdas[$fil+1][$col+1]->valor }}" min="0" align="right" style="text-align:right;" readonly title="{{$u->celdas[$fil+1][$col+1]->msg}}"
                               class="form-control focusNext">
                            </div>
                          @elseif ($u->celdas[$fil+1][$col+1]->tipo_dato =='combobox' )
                            <select id="@php echo $id;@endphp" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]" readonly title="{{$u->celdas[$fil+1][$col+1]->msg}}">
                              @foreach ($opciones_combos->where('id_combo', $u->celdas[$fil+1][$col+1]->valor_inicial) as $element =>$op)
                                @if ($u->celdas[$fil+1][$col+1]->valor==$op->id_opciones_combos)
                                  <option value="{{$op->id_opciones_combos}}" selected="selected" readonly> {{$op->descripcion}} </option>
                              @endif
                              @endforeach
                            </select>
                          @elseif ($u->celdas[$fil+1][$col+1]->tipo_dato =='checkbox')
                            @if ($u->celdas[$fil+1][$col+1]->valor=='false')
                            <input id="@php echo $id;@endphp" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]" readonly type="{{$u->celdas[$fil+1][$col+1]->tipo_dato}}" title="{{$u->celdas[$fil+1][$col+1]->msg}}">
                            @else
                              <input id="@php echo $id;@endphp" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]"
                                class="focusNext"
                                type="{{$u->celdas[$fil+1][$col+1]->tipo_dato}}" checked readonly title="{{$u->celdas[$fil+1][$col+1]->msg}}">
                            @endif

                              @elseif ($u->celdas[$fil+1][$col+1]->tipo_dato =='radio')
                            @php
                            $opciones = explode(';', $u->celdas[$fil+1][$col+1]->valor_inicial);
                            @endphp
                            @foreach ($opciones as $index_opcion => $opcion)
                                <label>
                                <input id="@php echo $id;@endphp" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]"
                                 class="focusNext"
                                  tabindex="{{$id}}" type="{{$u->celdas[$fil+1][$col+1]->tipo_dato}}"
                                     @if ($loop->iteration==$u->celdas[$fil+1][$col+1]->valor)
                                        checked
                                     @endif
                                     value="{{$loop->iteration}}"  required >
                                     {{$opcion}}
                                </label>
                                <br>
                            @endforeach

                            @elseif ($u->celdas[$fil+1][$col+1]->tipo_dato =='date')
                            @if ($u->celdas[$fil+1][$col+1]->valor =='')
                            <input id="@php echo $id;@endphp" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]"
                              class="form-control focusNext"
                              tabindex="@php echo $id;@endphp" type="{{$u->celdas[$fil+1][$col+1]->tipo_dato}}" value="0001-01-01">
                            @else
                              <input id="@php echo $id;@endphp" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]"
                              class="form-control focusNext"
                              tabindex="@php echo $id;@endphp" type="{{$u->celdas[$fil+1][$col+1]->tipo_dato}}" value="{{$u->celdas[$fil+1][$col+1]->valor }}" title="{{$u->celdas[$fil+1][$col+1]->msg}}">
                            @endif

                          @else  {{--  text--}}
                            <input id="@php echo $id;@endphp" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]" readonly type="{{$u->celdas[$fil+1][$col+1]->tipo_dato}}" value="{{$u->celdas[$fil+1][$col+1]->valor }}" title="{{$u->celdas[$fil+1][$col+1]->msg}}">
                          @endif {{-- if tipo de dato --}}
                        @endif {{-- user level < 6 --}}
                        </td>
                        @else
                          @if($u->celdas[$fil+1][$col+1]->tipo_dato =='total_calculado')
                          <td class="totales">
                          <div align="center">
                            <input name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]" type="number" readonly value="{{$u->celdas[$fil+1][$col+1]->valor}}">
                          </div>
                          </td>
                          @else
                          <td class="deshabilitada">
                          <div align="center">
                            <input name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]" type="number" readonly value="{{$u->celdas[$fil+1][$col+1]->valor}}">
                          </div>
                          </td>
                          @endif

                        @endif {{-- if titulo --}}
                      @endif {{-- if null --}}

                      @if (Auth::user()->level() < 6 and $formulario->c_estado_formulario <100)
                        {{-- Boton eliminar fila cuadro tipo 2 y 3 --}}
                          @if ($fil+1<=count($u->celdas))
                          @if ($col+1==count($u->celdas[$fil+1] ))
                            @if($u->c_tipo_cuadro==2)
                              @if (!$u->celdas[$fil+1][1]->titulo)
                                @if ($tot_fil_editables == 1)                
                                  <td style="display: none;">
                                    <button  type="button" class="btn btn-danger" onclick="eliminar_fila({{$u->numero}},{{$fil+1}});" ><i class="fa fa-trash-o"></i> </button>
                                  </td>
                                @elseif ($tot_fil_editables > 1 and  $tot_fil_editables < $total_filas )
                                  @if (Auth::user()->level() < 6)                            
                                    <td >                                     
                                      <button  type="button" class="btn btn-danger" onclick="eliminar_fila({{$u->numero}},{{$fil+1}});" ><i class="fa fa-trash-o"></i> </button>
                                    </td>
                                  @endif
                                @endif
                            @endif
                            @endif

                            @if($u->c_tipo_cuadro==3)
                              @if ($tot_fil_editables == 1)
                                <td style="display: none;">
                                 <button  type="button" class="btn btn-danger" onclick="eliminar_fila({{$u->numero}},{{$fil+1}});" ><i class="fa fa-trash-o"></i> </button>
                                </td>
                              @elseif ($tot_fil_editables > 1 )
                              @if (Auth::user()->level() < 6)
                              <td>
                                <button type="button" class="btn btn-danger" onclick="eliminar_fila({{$u->numero}},{{$fil+1}});" ><i class="fa fa-trash-o"></i></button>
                              </td>
                                @endif
                              @endif
                            @endif
                          @endif
                        @endif
                      {{-- fin boton eliminar celda --}}
                    @endif
                    @endfor  {{-- for-col --}}
                  </tr>
                @endfor  {{-- for-fil --}}
              </tbody>
              </table>
              <small id="tabla{{$u->numero}}Help" class="form-text text-muted"><b>{{ $u->indicaciones }}</b></small>

              @if ($u->msg_err != [])
              <!-- <div  class="navbar navbar-fixed-bottom justify-content-center">  -->
              <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class='fa fa-times-circle'></i> Por favor corrige los siguentes errores</strong>
                <ul>
                @foreach ($u->msg_err as $element =>$error)
                      <li>{{ $error }}</li>
                  @endforeach
                </ul>
                </div>
              {{-- </div> <div class="col-sm-4"> </div> --}}
              @endif

              @if ($u->msg_adv != [])
                {{-- <div class="col-sm-8">  --}}
                <!-- <div class="navbar navbar-fixed-bottom justify-content-center">  -->
                <div class="alert alert-warning">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong><i class='fa fa-warning'></i> Por favor verifique las siguentes advertencias</strong>
                <ul>
                  @foreach ($u->msg_adv as $element =>$error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
                </div>
                {{-- </div> <div class="col-sm-4"> </div> --}}
              @endif
            </div> {{-- table-responsive --}}


          {{-- <h5 align="left"> <b>{{ $u->indicaciones }}</b></h5> --}}
        @endforeach
       </div> {{-- Fin  panel-body --}}
      </div>  {{--Fin  panel-heading-custom panel-heading heading --}}
    </div> {{-- Fin  panel panel-default --}}

    <div align="center" class="navbar navbar-fixed-bottom justify-content-center">
        {{ $page->onEachSide(1)->links() }}
        <ul >
        &nbsp;&nbsp;
        @if ($formulario->c_estado_formulario <100 && Auth::user()->level() < 6 && $periodo->en_carga==true )
          {{Form::button('Grabar cuadro',   array('type' => 'submit', 
                'value'=>'grabar', 'class' => 'btn btn-primary', 'title'=>'Grabar cuadros'))}}
        @endif
        &nbsp;&nbsp;
        @php $start=True; @endphp
        <a class="btn btn-primary" href="{{ route('formulario',[$formulario->id_localizacion_periodo, $start]) }}">Salir de la Planilla</a>
      </ul>

    </div>
     {!! Form::close()!!}
  </div>  {{-- Fin Container  --}}

@stop
@section('js')
   <script src="{{ asset('js/die.js') }}" ></script>
   <script>
     $(':input[type="number"]:enabled:visible:not([readonly]):first').focus();     
</script>
   <script>
       $(window).on('load', function(){
          $(".loader").fadeOut("slow");
      });
      $(window).on('close', function(){
        $(".loader").fadeOut("slow");
     });
  </script>
@stop