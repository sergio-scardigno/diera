 {{ Html::style('css/'.$formulario->color.'.css')}}    
 {{ Html::style('css/die.css')}}    
 <style>
    .page-break {
        page-break-after: always;
    }    
</style>

<div class="container-fluid"> {{--  Container  --}}
  <!-- <div class="card-header separa_datos"> <b>{{$formulario->nombre}} - {{$formulario->esc_nombre}} </b></div> -->
  {!!Form::model($formulario,['id'=>'formulario', 'url'=>['grabarformulario/'],'method'=>'POST'])!!}     
  {!! csrf_field() !!}     
    <div class="panel panel-default"> 
    <div class="panel-heading-custom panel-heading heading">{{--  panel-heading-custom panel-heading heading --}}
      <div class="panel-body">  {{-- panel-body --}}
     
      <div class="container-fluid">    
          <div class="tit_direc">DGCyE - DIRECCIÓN DE INFORMACIÓN Y ESTADÍSTICA</div>  
            Teléfono: 0800-222-2338 / 0221-4836721 - RPV 21402 / 21340<br>E-mail: die.relevamientos@gmail.com
          </div>    
      <br>

<div class="card-header separa_datos">  {{-- Separa datos --}}
  <b>{{$formulario->nombre}} <br>
  {{$formulario->esc_nombre}} - CÓDIGO JURISDICCIONAL: {{ $formulario->codigo_jurisdiccional}} - CUE-ANEXO: {{ $formulario->cueanexo}}</b>
</div> {{-- Fin Separa datos --}} 
{!!Form::model($formulario,['id'=>'formulario', 'url'=>['grabarformulario/'],'method'=>'POST'])!!}     
    {!! csrf_field() !!}       
    @php $id=0; $color=$formulario->color; @endphp       
@foreach ($formulario->cuadros as $element =>$u) 
    @if ($color=="f_rosa" && (in_array($u->numero, [3, 5, 8, 11, 14, 20]))
          || $color=="f_marron" && (in_array($u->numero, [4,7,10])) 
          || $color=="f_violeta" && (in_array($u->numero, [8]))
          || $color=="f_celeste" && (in_array($u->numero, [4]))  
          || $color=="f_amarillo" && (in_array($u->numero, [4]))
          || $color=="f_verde" && (in_array($u->numero, [3])) 
          || $color=="f_naranja" && (in_array($u->numero, [6]))

       )  {{-- ) del if color  --}}
          <div class="page-break"></div>          
    @endif
 @if ($u->c_estado_cuadro!=87)
 <h5 align="left"> <b>{{ $u->numero }}) {{$u->nombre}}</b></h5>      

 <table class="table cuadro">
 <tbody>
   @for ($fil=0;$fil<count($u->celdas); $fil++)        
    <tr id="cuadro[{{$u->numero}}][{{$fil+1}}]">                 
      @for ($col=0;$col<count($u->celdas[$fil+1] );$col++) 
        @if ($u->celdas[$fil+1][$col+1]->tipo_dato !='null' ) 
         @if ($u->celdas[$fil+1][$col+1]->titulo)           
         @if ($u->nombre=='NOMENCLATURA CATASTRAL')
         <th colspan={{$u->celdas[$fil+1][$col+1]->colspan}} rowspan={{$u->celdas[$fil+1][$col+1]->rowspan}}>  
              <b>{{$u->celdas[$fil+1][$col+1]->valor}}</b>   
         </th>
        @else
          <th colspan={{$u->celdas[$fil+1][$col+1]->colspan}} rowspan={{$u->celdas[$fil+1][$col+1]->rowspan}} 
            class={{$u->celdas[$fil+1][$col+1]->estilos}} >  
            <b>{{$u->celdas[$fil+1][$col+1]->valor}}</b>   
        </th>         
        @endif   
            
         @elseif ($u->celdas[$fil+1][$col+1]->editable)    
           @if ($u->celdas[$fil+1][$col+1]->c_categoria_consistencia ==1)                    
             <td class="habilitada">                   
           @elseif ($u->celdas[$fil+1][$col+1]->c_categoria_consistencia ==2) 
             <td class="advertencia">
           @else  
             <td class="error">     
           @endif   
           @if ($u->celdas[$fil+1][$col+1]->tipo_dato =='number' )      
             <div align="center">
               <input name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]" type="text" value="{{$u->celdas[$fil+1][$col+1]->valor}}"
               style="{ text-align:right;  vertical-align: middle; width: 3.5em; height: 2.3em;}">     
            </div>
            @elseif ($u->celdas[$fil+1][$col+1]->tipo_dato =='combobox' ) 
               @foreach ($opciones_combos->where('id_combo', $u->celdas[$fil+1][$col+1]->valor_inicial) as $element =>$op)
                 @if ($u->celdas[$fil+1][$col+1]->valor==$op->id_opciones_combos)
                   {{$op->descripcion}}                                  
                @endif 
               @endforeach                      
            @elseif ($u->celdas[$fil+1][$col+1]->tipo_dato =='checkbox') 
              @if ($u->celdas[$fil+1][$col+1]->valor=='false')
               <input type="hidden"  name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]" value="false" >
               <input name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]" type="{{$u->celdas[$fil+1][$col+1]->tipo_dato}}" style="{ text-align:right;  vertical-align: middle; width: 1.5em;}"> 
             @else 
              <input type="hidden"  name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]" value="false" >
              <input name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]" type="{{$u->celdas[$fil+1][$col+1]->tipo_dato}}" checked  style="{ text-align:right;  vertical-align: middle; width: 1.5em;}">
             @endif
           @elseif ($u->celdas[$fil+1][$col+1]->tipo_dato =='radio')
               @php
               $opciones = explode(';', $u->celdas[$fil+1][$col+1]->valor_inicial);                            
               @endphp
               @foreach ($opciones as $index_opcion => $opcion)
                 <label style="{ text-align:right;  vertical-align: middle; width: 8em;}">
                 <input id="{{$id}}" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]" 
                           tabindex="{{$id}}" type="{{$u->celdas[$fil+1][$col+1]->tipo_dato}}"                                       
                           @if ($loop->iteration==$u->celdas[$fil+1][$col+1]->valor)   
                             checked                                         
                           @endif
                           value="{{$loop->iteration}}"  required >
                           {{$opcion}}
                 </label>                              
                 <br>   
               @endforeach

           @else  
             {{$u->celdas[$fil+1][$col+1]->valor }}  
           @endif  
           </td>   
           @else 

              @if($u->celdas[$fil+1][$col+1]->tipo_dato =='total_calculado')  
                  <td class="totales"> 
                  <div align="center">                         
                    <input aria-label="cuadros" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]" type="text" readonly value="{{$u->celdas[$fil+1][$col+1]->valor}}"
                    style="  { 
                      text-align:right;
                      vertical-align: middle;      
                        width: 3.5em; 
                        height: 2.3em;
                      }">
                  </div>                    
                 </td>
                  @else
                 <td class="deshabilitada"> 
                  <div align="center">                         
                    <input aria-label="cuadros" name="cuadros[{{$u->numero}}][{{$fil+1}}][{{$col+1}}]" type="text" readonly value="{{$u->celdas[$fil+1][$col+1]->valor}}" @{{     style="  { 
                      text-align:right;
                      vertical-align: middle;      
                        width: 3.5em; 
                        height: 2.3em;
                      }" }}>
                  </div>                    
                 </td>
               @endif                  
                
            @endif {{-- if titulo --}}
           @endif {{-- if null --}}

         @endfor  {{-- for-col --}}                     
         </tr> 
       @endfor  {{-- for-fil --}}
      </tbody>
     </table>  
     @endif {{-- cuadro 87 --}}
{{--      
     <br>
      @if ($u->msg_err != []) 
       <div class="alert alert-danger">               
       <ul>
       @foreach ($u->msg_err as $element =>$error) 
             <li>{{ $error }}</li>
         @endforeach
        </ul>
       </div>
      @endif 
      @if ($u->msg_adv != []) 
        <div class="alert alert-warning">               
       <ul>
       @foreach ($u->msg_adv as $element =>$error) 
             <li>{{ $error }}</li>
         @endforeach
        </ul>
       </div>
      @endif --}}

@endforeach 

{!! Form::close()!!} 
</div>


         
      </div>{{-- panel-body --}}
    </div>
  </div>      
  {!! Form::close()!!}   
</div>{{--  Container  --}}
