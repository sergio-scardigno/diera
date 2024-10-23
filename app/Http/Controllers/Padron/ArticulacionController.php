<?php

namespace App\Http\Controllers\Padron;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use Auth;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;


use Ultraware\Roles\Models\Role;
use App\Model\Partidos;
use App\Model\Periodos;
use App\Model\Log_articulacion;
use App\Model\Localizaciones_periodo;
use App\Model\Oferta_periodo;
use App\Model\Datos_formulario;
use App\Model\Datos_localizacion_periodo;
use App\Model\Padron\Cambio_estado_oferta_local;
use App\Model\Usuario_localizacion_assn;
use App\Model\Padron\Localizacion_padron;
use App\Http\Controllers\Formulario\DatosFormularioController;

class ArticulacionController extends Controller
{
    public function proceso_articulacion($id)   {        
      if (!Auth::check()) {
         toastr()->info('Session expirada. Ingrese nuevamente!');
         return redirect('/home');
     } 
        $id_periodo=$id;         
         ignore_user_abort(true); 
        ini_set('max_execution_time',0);
        set_time_limit(0); // ponemos el tiempo de ejecucion en forever del scrip 
  
        
        $fecha = Carbon::now('America/Buenos_Aires'); //date("Y-m-d H:i:s", time());  // calculamos fecha a usar x la articulacion
        //      $fecha=date_create('2017-10-18 14:03:00'); // reescribo la fecha para pruebas
        // rescato datos del periodo
        $f=Periodos::find($id_periodo); 
        $fecha_cortedealtas=new Carbon($f->fecha_cortedealtas); // Fecha de corte del relevamiento recuperada de tabla de periodos
        $fecha_cortedealtas2= new Carbon($f->fecha_cortedealtas);  // Fecha de corte para ofertas de baja, un año atras de la fecha de corte del derelv.
        $fecha_cortedealtas2->SubYear(); // le restamos 1 año.
  
        $en_carga=$f->en_carga;
        // verificamos que el Relevamiento este en carga
        if (!$en_carga)  { // si el periodo no esta en carga no se puede articular              
              toastr()->error('El relevamiento está cerrado, no se permiten más articulaciones!!!');
             
              return back();
           }
  
        // busco la ultima articulacion
        $log_art=Log_articulacion::where ('id_periodo','=',$id_periodo)->orderBy ('inicio','desc')->first();
  
        // Verificamos que no halla una articulación en ejecución
        if (!is_null($log_art) and is_null($log_art->fin) )  {            
              toastr()->warning('Ya hay una articulación en ejecución, espere que finalice!!');
              return back(); 
           }
  
        $f_art_inicio=is_null($log_art) ? $fecha: new Carbon($log_art->inicio); // recupero la fecha de inicio de la articulacion anterior
                                                                    // si es la primera articulación tomo la fecha de ahora
        // buscamos el tipo de articulación a efectuar 
        // inicialización completa o solo actualizaciones
        if (is_null($log_art))  // si no hay articulaciones anteiores, hacemos una articulación completa
           { $articulacion=DB::connection('padron')->Select("Select l.* from bsas.v_localizacion_diera l
                           join (select distinct id_localizacion 
                                   from 	(SELECT  distinct on (col.id_oferta_local)  -- me quedo con el primer estado por oferta
                                                              id_localizacion, col.id_oferta_local, col.c_estado
                                                  FROM cambio_estado_oferta_local col 
                                                        JOIN oferta_local ol using(id_oferta_local)  
                                                        JOIN movimiento mov USING (id_movimiento)         
                                                  WHERE mov.fecha_vigencia<= :fecha_cortedealtas :: date
                                                  ORDER by col.id_oferta_local, mov.fecha_actualizacion desc, mov.fecha_vigencia desc 
                                            ) s1
                                    where  s1.c_estado=1
                                ) s2 using (id_localizacion)
                      order by id_localizacion" , ['fecha_cortedealtas' => $fecha_cortedealtas->format('Y-m-d')] );
           }
        else    //es una actualizacion
           { 
               $articulacion=DB::connection('padron')->Select(" select l.* from bsas.v_localizacion_diera l
                                 join (select distinct id_localizacion from localizacion l1
                                          inner join oferta_local ol using (id_localizacion)
                                          where (l1.fecha_actualizacion>= :f_actualizacion or ol.fecha_actualizacion>= :f_actualizacion)
                                       )s1 on s1.id_localizacion=l.id_localizacion
                                 order by l.id_localizacion", ['f_actualizacion' => $f_art_inicio->format('Y-m-d H:i:s')] );
           }
        $articulacion=collect($articulacion);       
         // Verificamos que halla localizaciones para articular
//         var_dump ($articulacion);
        if ($articulacion->isEmpty() ){                
           toastr()->info('No hay cambios en el Padrón desde la última articulación!('. $f_art_inicio->Format('d/m/Y H:i:s') .')');
            return back(); 
           } 
          // agregamos el inicio de nueva articulación
          $id_log_articulacion=Log_articulacion::insertGetId( [ 'inicio'=>$fecha, 'id_usuario'=>Auth::user()->id, 'id_periodo'=>$id_periodo ], 'id_log_articulacion');
  
        // PRECESAR LAS OFERTAS Y LOCALZACIONES QUE SE MODIFICARON ($articulacion)
        $cant=0; // contador de localizaciones actualizadas
        foreach ($articulacion as $key => $loc) {  
           // actualizamos o agregamos la localizacion si corresponde  
           Log_articulacion::where ( 'id_log_articulacion',$id_log_articulacion )->update ( ['cant_localizaciones'=> $loc->id_localizacion]);
           $id_localizacion_periodo=$this->actualiza_localzacion($loc, $id_periodo,$f_art_inicio,$ms);
              // recupero las ofertas de la localizacion  a la fecha del relevamiento (fecha_cortedealtas   )
           $ofertas=DB::connection('padron')->Select("
                  select  distinct on (col.id_oferta_local)  -- me quedo con el primer estado por oferta
                          id_localizacion, col.id_oferta_local, ol.c_oferta, col.c_estado, mov.fecha_actualizacion,mov.fecha_vigencia
                      FROM cambio_estado_oferta_local col 
                        join oferta_local ol using(id_oferta_local)  
                        JOIN movimiento mov USING (id_movimiento)         
                         WHERE mov.fecha_vigencia<= :fecha_cortedealtas :: date
                          and id_localizacion= :id_loc
                      order by col.id_oferta_local, mov.fecha_actualizacion desc, mov.fecha_vigencia desc"
                      , ['fecha_cortedealtas' => $fecha_cortedealtas->Format('Y-m-d'), 'id_loc'=> $loc->id_localizacion] );
           $ms1="";
           // actualizar las ofertas de la lcalización
           foreach ($ofertas as $okey => $oferta)
           {  // traemos las ofertas que se modificaron despues de la última articulación, o si es una inicialización traemos todas las activas o modificadas en el último año.
              // estamos usando la $fecha_cortedealtas para registrar las ofertas que se importan
              // se podrian pasar a $fecha_cortedealtas2 para importar del padron ofertas dadas de baja del último ano,
            $ms1=$ms1.$this->actualiza_oferta ($oferta, $id_localizacion_periodo, $log_art, $fecha_cortedealtas, $f_art_inicio);
           }  // buscar otra oferta para aticular
           if ($ms1<>"") {$ms1=" Ofertas/estados: ".$ms1; }
           // verificar que le quedan ofertas activas en la localizacion y actualiza estado de carga del formulario
           $this->actualiza_formulario($id_localizacion_periodo, $ms);
           //$msg[]=$ms." - Localizacion actualizada"; $msg[]="";
           $msg[]= [
                     'cueanexo'=> $loc->cueanexo, //'CUEANEXO'=> 
                     'codigo_jurisdiccional'=> $loc->codigo_jurisdiccional, //'codigo_jurisdiccional'=>
                     'loca'=> $loc->id_localizacion, //'id_localizacion='=>
                     'msg'=> $ms.$ms1, //'descripcion'=> 
                   ];
  
           // echo $ms."<BR>";
           unset ($id_localizacion_periodo,$ofertas,$ms1,$ms);
           // cerramos el proceso de articulación

           $cant=$cant + 1; // incremento contador de localizaciones actualizadas              
 //          Log_articulacion::where ( 'id_log_articulacion',$id_log_articulacion )->update ( ['cant_localizaciones'=>$cant]);
  
        }
        // cerramos el proceso de articulación
        Log_articulacion::where ( 'id_log_articulacion',$id_log_articulacion )
                          ->update ( [ 'fin'=>Carbon::now('America/Buenos_Aires'),'cant_localizaciones'=>$articulacion->count()]);
        $msg2="RELEVAMIENTO ".$f->periodo." : al ". $fecha_cortedealtas->format('d-m-Y'). "ARTICULACION FINALIZADA : ". $articulacion->count() ." Localizaciones actualizadas en "
                 .$fecha->diffForHumans(Carbon::now('America/Buenos_Aires'),true);
  
        set_time_limit(60); // restablecemos el tiempo de ejecucion en 60' del scrip                        
        
        $ruta='proceso_articulacion';
        $titulo='Articular Relevamiento con Padron'; // mandamos el titulo para evitar pasarlo desde la vista
        return view('show_resultado', compact('msg', 'msg2','ruta','titulo'));
     } // FUNCTION proceso_articulacion()









    public function actualiza_localzacion ( $loc, $id_periodo,$f_art_inicio,&$msg)  {       
        $msg="CUE-ANEXO";
        // recupero el id_localizacion_periodo
        $LP=Localizaciones_periodo::select ('id_localizacion_periodo')
                                 ->where('id_localizacion', $loc->id_localizacion)
                                 ->where('id_periodo',$id_periodo)->first();
        
        $id_localizacion_periodo= is_null($LP) ? null: $LP->id_localizacion_periodo;
        // si la localizacion no existe en el periodo o se modificó, la agregamos y/o la actualizamos  
        $loc_fecha_actualizacion=new Carbon($loc->fecha_actualizacion);
        if (is_null($id_localizacion_periodo) or $loc_fecha_actualizacion>$f_art_inicio) // si es nuevo o se actualiza
        { //  agregamos o actualizamos la localizacion en Localizaciones_periodo desde datos de $loc
           $loc_periodo=Localizaciones_periodo::updateOrCreate( 
                 ['id_localizacion'=>$loc->id_localizacion, 'id_periodo'=>$id_periodo], 
                 [             //'id_localizacion_periodo' => $loc->id_localizacion_periodo,
                               'id_localizacion' => $loc->id_localizacion,                                 
                               'id_serv'=> $loc->id_serv ,
                               'cueanexo' => $loc->cueanexo,                            
                               'codigo_jurisdiccional' => $loc->codigo_jurisdiccional,
                               //'id_periodo'=>$id_periodo,                                
                               'departamento' => $loc->departamento,
                               'c_departamento' => $loc->c_departamento, 
                               'esc_nro' => $loc->esc_nro,
                               'nombre' => $loc->nombre,
                               'calle' => $loc->calle,
                               'nro' => $loc->nro,
                               'localidad' => $loc->localidad,
                               'c_localidad' => $loc->c_localidad,                                
                               'referencia' => $loc->referencia,
                               'cod_postal' => $loc->cod_postal,
                               'telefono_cod_area' => $loc->telefono_cod_area,
                               'telefono' => $loc->telefono,
                               'email' => $loc->email,
                               'dependencia' => $loc->dependencia,
                               'c_organizacion' => $loc->c_organizacion,
                               'st_x' => $loc->x_longitud,
                               'st_y' => $loc->y_latitud,
                               'calle_lateral_derecha' => $loc->calle_lateral_derecha, 
                               'calle_lateral_izquierda' => $loc->calle_lateral_izquierda
                 ] );
           if (!is_null($id_localizacion_periodo)) //si la localizacion ya existia en el periodo
           {  //actualizamos datos del formulario grabado si existen
               $msg=$msg. " ACTUALIZADO;";
               //actualizamos los datos del formulario por si está grabado
  // desde final 2018 actualiza, respeta lo caragado por la escuela en el período.
               //   Datos_localizacion_periodo::where('id_localizacion_periodo',$id_localizacion_periodo)
               //         ->where ('codigo_jurisdiccional',$loc->codigo_jurisdiccional) // solo actualizo datos si no cambia ningun atributo de la clave!!!
               //         ->update ( [   //'id_localizacion_periodo' => $loc->id_localizacion_periodo,
               //               //'id_localizacion' => $loc->id_localizacion,                                 
               //               'id_serv'=> $loc->id_serv ,
               //               'cueanexo' => $loc->cueanexo,                            
               //               //'codigo_jurisdiccional' => $loc->codigo_jurisdiccional,
               //               //'id_periodo' => $id_periodo,
               //               //'departamento' => $loc->departamento,
               //               //'c_departamento' => $loc->c_departamento, 
               //               //'esc_nro' => $loc->esc_nro,
               //               'nombre' => $loc->nombre,
               //               'calle' => $loc->calle,
               //               'nro' => $loc->nro,
               //               'localidad' => $loc->localidad,
               //               'c_localidad' => $loc->c_localidad,                                
               //               'referencia' => $loc->referencia,
               //               'cod_postal' => $loc->cod_postal,
               //               'telefono_cod_area' => $loc->telefono_cod_area,
               //               'telefono' => $loc->telefono,
               //               'email' => $loc->email,
               //               //'dependencia' => $loc->dependencia,
               //               //'c_organizacion' => $loc->c_organizacion,                           
               //               'st_x' => $loc->x_longitud,
               //               'st_y' => $loc->y_latitud,
               //               'calle_lateral_derecha' => $loc->calle_lateral_derecha, 
               //               'calle_lateral_izquierda' => $loc->calle_lateral_izquierda,
               //               // 'new_st_y' => $loc->st_y,
               //               // 'new_st_x' => $loc->st_x 
               //         ] );
               // chequeamos alta/actalizacion de usuario (si cambia clave hay que agregar el usuario nuevo para que pueda ingresar con nuevo usuario)                  
               $this->alta_usuario ($loc,$id_periodo, $msg); // agregamos el usuario para el acceso (si no existia)          
           } 
           else
           {
              $msg=$msg. " AGREGADO;";
              // si la localizacion es nueva y no_hay_usuario
              $this->alta_usuario ($loc,$id_periodo, $msg); // agregamos el usuario para el acceso (si no existia)
           } 
        } // si es nuevo o se actualiza
        $id_localizacion_periodo=is_null($id_localizacion_periodo) ? $loc_periodo->id_localizacion_periodo : $id_localizacion_periodo;
        return $id_localizacion_periodo;
     }
  
  
    public function actualiza_oferta ( $oferta, $id_localizacion_periodo,$log_art, $fecha_cortedealtas2, $f_art_inicio)  { 
 //           $oferta_fecha_actualizacion= new Carbon($oferta->fecha_actualizacion); // convierto a carbo para comparaciones
            $oferta_fecha_vigencia= new Carbon($oferta->fecha_vigencia); // convierto a carbo para comparaciones
            $msg="";
  

 // dino cambie la logica de alta de ofertas 26/11/2020'
 // antes cmparaba con este if   y actualizaba ofertas...         
 /*       if  ( ( ( is_null($log_art) //es inicicializacion
                  and  ( $oferta->c_estado==1 //oferta activa
                        or $oferta_fecha_actualizacion > $fecha_cortedealtas2  // si se modificó hasta 1 año antes, tambien la recuperamos 
                       ) )
                 or $oferta_fecha_actualizacion>$f_art_inicio // si la oferta se modificó
              ) )
        { 
*/

         if ( ($oferta->c_estado==1) // esta activo
              or ($oferta_fecha_vigencia >= $fecha_cortedealtas2) // si el cambio es posterior a  $fecha_cortedealtas2, tambien la traemos 
                                                                  // y treemos tambien las bajas/inactivos posteriores a $fecha_cortedealtas2
            )
            {   // actualizamos o agregamos la oferta 
               Oferta_periodo::updateOrCreate(  ['id_localizacion_periodo'=>$id_localizacion_periodo, 'c_oferta' => $oferta->c_oferta],
                                                   [  'id_oferta_local'=>  $oferta->id_oferta_local,
                                                      'c_estado'=> $oferta->c_estado,
                                                      'fecha_actualizacion'=> $oferta->fecha_actualizacion,
                                                      'fecha_vigencia'=> $oferta->fecha_vigencia,
                                                   ]);
               $msg="(".$oferta->c_oferta."/".$oferta->c_estado.")";
            }
         elseif ( ($oferta_fecha_vigencia < $fecha_cortedealtas2) // Es baja o inactivo anterior a $fecha_cortedealtas2, y lo eliminamos
                  and (!is_null($log_art)) // No es inicicializacion                 
                )
            {   // intentamos deletear la oferta de baja/inactiva y antiguas
                  $result=Oferta_periodo::where('id_localizacion_periodo', $id_localizacion_periodo) //eliminamos oferta de la localizacion 
                                 ->where('c_oferta', $oferta->c_oferta) // estado oferta                           
                                 ->delete();
                  if ($result>0) {
                           $msg="(".$oferta->c_oferta."/".$oferta->c_estado.")";
                  }
                  else {
                          $msg=""; // es una oferta antigua no ponemos mensajes
                  }
            }           
       return $msg;
     } 
  
  
    public function actualiza_formulario ($id_localizacion_periodo, &$msg)  { 
     //recuperamos las ofertas activas de la localizacion
     $Loc_Ofertas=Oferta_periodo::select('oferta_periodo.c_oferta')
                    ->where('id_localizacion_periodo', $id_localizacion_periodo)
                    ->where('c_estado', 1) // estado activo
                    ->get();
     //recupero los datos del formulario si está grabado
     $Loc_formulario = Datos_formulario::select ('id_datos_formulario','c_estado_formulario')
                                               ->where('id_localizacion_periodo', $id_localizacion_periodo)
                                               ->first();//->id_definicion_formulario;          
     $msg=$msg." FORMULARIO";
     if ($Loc_Ofertas->count()!=0) // la localizacion tiene ofertas activas
        {  // aplicamos los cambios de oferta en el formulario por si cambio.
           $msg=$msg. " CON ". $Loc_Ofertas->count()." OFERTAS ACTIVAS;";
           if (!is_null($Loc_formulario)) // si el formulario está cargado
           {  // controlamos si el estado_formulario de carga cambia
  
              if ($Loc_formulario->c_estado_formulario>=10 and $Loc_formulario->c_estado_formulario<>70 ) // esta cargado
              {  //si la carga está iniciada recalculamos los estados de carga despues de los cambios de ofertas
  
                 $estaba_confirmado=($Loc_formulario->c_estado_formulario==100); // me guardo el estado antes de crear el formulario
                                                                            //  porque lo re-consiste durente el creado. 
                 $formulario = New DatosFormularioController($id_localizacion_periodo);  //crear y consistir el form
                 if ($estaba_confirmado)
                 { 
                    $formulario->confirmarformulario();
                 }   
                 $formulario->save();  //guardamos el nuevo estado del formulario
              }  // esta cargado
           } //el formulario está creado
        } // la localizacion tiene ofertas activas
     else  // no tiene más ofertas activas la borramos de localizaciones_periodo, (no se releva)
        {           
           if (is_null($Loc_formulario)) // no esta creado en datos
              {  // eliminamos del relevamiento
                 $msg=$msg.  " DELETED S/DATOS.";
                 Oferta_periodo::where('id_localizacion_periodo', $id_localizacion_periodo) //eliminamos.ofertas de la loc. no activas 
                                 ->delete();
                 Localizaciones_periodo::destroy($id_localizacion_periodo); // eliminamos detos de la localizacion periodo (sin ofertas)
              }
  
           elseif ( !($Loc_formulario->c_estado_formulario>=10 and $Loc_formulario->c_estado_formulario<>70 )) // creado sin carga
              {
                 $msg=$msg.  " DELETED C/DATOS.";
                // dd($Loc_formulario,$id_localizacion_periodo);
                 DatosFormularioController::dat_formulario_delete($id_localizacion_periodo); //eliminamos el formulario
                 Oferta_periodo::where('id_localizacion_periodo', $id_localizacion_periodo) //eliminamos ofertas de la localizacion 
                                 ->delete();
                 Localizaciones_periodo::destroy($id_localizacion_periodo); // eliminamos detos de la localizacion periodo (sin ofertas)
              } 
           else  // (el formulario tiene datos, no lo podemos borrar)
              {
                  $msg=$msg.  " MARCADO P/BORRAR CON DATOS.";
                 //cambiar el formulario a estado de error de padron
                 //marcar localizacion_para_borrar_pendiente 
                 $Loc_formulario->c_estado_formulario=6; // 6=Formulario para borrar, por baja en padrón
                 Datos_formulario::where('id_localizacion_periodo', $id_localizacion_periodo)
                                         ->update(['c_estado_formulario' => 6]);
              }   
        }  // no tiene ofertas activas  
  
         
  } // function actualiza_formulario
  
  
  public function alta_usuario ($loc,$id_periodo, &$msg)
  {   // buscamos el usuario de la localizacion username=codigo_jurisdiccional
        $user=User::where('username',$loc->codigo_jurisdiccional)->first();
        if (is_null($user)) 
        {     
              // agregamos nuevo usuario de la localizacion username=codigo_jurisdiccional
              $msg=$msg.' USR AGREGADO';
              //agrego el nuevo usuario director (username= codigo_jurisdiccional) de la localizacion           
              $user= new User;
              $user->name=$loc->nombre;
              $user->username=$loc->codigo_jurisdiccional;
              $user->email=$loc->email;
              $user->password=md5($loc->cueanexo); //bcrypt($r->password);
              $user->activo=true ;
              $user->save();
                          
              $user->attachRole(4); // agregamos el rol "director" level =3
        };  
        // agrego la asignacion del usuario con la localizacion
        $usr_loc=Usuario_localizacion_assn::FirstOrCreate( ['id_localizacion' => $loc->id_localizacion,'id_usuario' => $user->id ]);
  
        // si es una extension , se la asignamos tambien al director de la sede
        if (substr($loc->cueanexo,-2)!='00') // es una extension
        {  //buscar datos de la sede
              $loc0=Localizaciones_periodo::select('codigo_jurisdiccional','cueanexo','nombre','email')
                                            ->where('cueanexo',substr($loc->cueanexo,0,-2).'00')->where('id_periodo',$id_periodo)->first();
              if (is_null($loc0)) //?  Si No hay localizacion sede en el periodo lo traemos del padron
              {
                    $loc0=DB::connection('padron')->Select("select codigo_jurisdiccional, cueanexo, nombre, email from bsas.v_localizacion_diera l
                                where l.cueanexo = :cueanexo limit 1", ['cueanexo' => substr($loc->cueanexo,0,-2).'00'] );
                    $loc0=  !is_null($loc0) ? (object) $loc0[0] : null;   //convertir el array en objeto          
              }
  
              if (!is_null($loc0)) //?  hay localizacion sede
              {
                    // buscamos el usuario de la localizacion sede 
                    $user0=User::where('username',$loc0->codigo_jurisdiccional)->first();
                    if (is_null($user0)) // hay usuario de la sede
                    {     
                          // agregamos nuevo usuario de la localizacion sede 
                          $msg=$msg.' USR SEDE AGREGADO';
                          //agrego el nuevo usuario director (username= codigo_jurisdiccional) de la localizacion sede
                          // 
                          $user0= new User;
                          $user0->name=$loc0->nombre;
                          $user0->username=$loc0->codigo_jurisdiccional;
                          $user0->email=$loc0->email;
                          $user0->password=md5($loc0->cueanexo); //bcrypt($r->password);
                          $user0->activo=true ;
                          $user0->save();
                                      
                          $user0->attachRole(4); // agregamos el rol "director" level =3
                    }; // ? hay ususario de la sede
                    // agrego la asignacion del usuario sede con la localizacion
                    $usr0_loc=Usuario_localizacion_assn::FirstOrCreate( ['id_localizacion' => $loc->id_localizacion,'id_usuario' => $user0->id ],[]);
  
              } //?  hay localizacion sede
  
        } //? es extension
  
        // Recupero la región_educativa de la localizacion
        $partido=Partidos::select('id_region_educativa','codigo_distrito')->where ('c_departamento',$loc->c_departamento)->first();
  
        $cod_dto=$partido->codigo_distrito;  //sprintf('%$03d',$partido->codigo_distrito);
        $cod_reg=sprintf('%03d',$partido->id_region_educativa);
  
        if (strpos('.3.4.', substr($loc->codigo_jurisdiccional,0,1))===false )// ES sector estatal
        { // recupero los usuarios de referentes, jefes de dto y region  de ESTATAL
           $usuarios=User::select('id','username')->where ('username','like','RE'.$cod_dto.'%')
                                                   ->orwhere('username','like','JD'.$cod_dto.'%')
                                                   ->orwhere('username','like','JRE'.$cod_reg.'%')->get();
        }
        else
        { // recupero los usuarios de referentes, jefes de dto y region  de DIPREGEP
           $usuarios=User::select('id','username')->where ('username','like','RP'.$cod_reg.'%')
                                                   ->orwhere('username','like','JRP'.$cod_reg.'%')->get();
        }
        // les damos acceso  a la localizacion
        foreach ($usuarios as $key => $u)
        {
           // agrego la asignacion del usuario con la localizacion
           $usr_loc=Usuario_localizacion_assn::FirstOrCreate( ['id_localizacion' => $loc->id_localizacion,'id_usuario' => $u->id ],[]);
        }
        /*
        ESTATAL:
        RE00101 Referente distrital
        JD001 Jefe distrital
        JRE001 Jefe Regional
  
        DIPREGEP:
        RP02501 Referente Privado x region
        JRP001 Jefe Regional Privado
  
        */
  
  }  // function agregar_usuario
  
  
  
  // ==========================
  // ==========================
  
  
  
  /* 
        Método para regenerar las claves de los usuarios de director y la asignaciónes usuario->director y usuario->jefe...      
        de las localizaciones de un periodo. (agrega las que estén faltando que por algun problema no se hallan agregado cuando se articuló)
  */
  
  public function check_usuarios ($id_periodo)
        { 
              ignore_user_abort(true); 
              ini_set('max_execution_time',0);
              set_time_limit(0); // ponemos el tiempo de ejecucion en forever del scrip 
  
              $loc=Localizaciones_periodo::select('codigo_jurisdiccional','cueanexo','nombre','email','id_localizacion', 'id_localizacion_periodo','c_departamento')
                                                  ->where('id_periodo',$id_periodo)->get();
              $msg=[];
  
              // les damos acceso  a la localizacion
              foreach ($loc as $key => $l)
              {
                    // agrego la asignacion del usuario con la localizacion
                    $ms='';
                    $this->alta_usuario ($l,$id_periodo, $ms); // agregamos el usuario para el acceso (si no existia)
                    if ($ms!='')
                    {
                          $msg[]= [
                                      'cueanexo'=> $l->cueanexo, //'CUEANEXO'=> 
                                      'codigo_jurisdiccional'=> $l->codigo_jurisdiccional, //'codigo_jurisdiccional'=>
                                      'loca'=> $l->id_localizacion, //'id_localizacion='=>
                                      'msg'=> $ms, //'descripcion'=> 
                                  ];
                    }
  
              }
  
              set_time_limit(60); // restablecemos el tiempo de ejecucion en 60' del scrip
              
              $msg2="Chequeo de usuarios terminado";
              $ruta='check_usuarios';
              $titulo='Agregar Usuarios Faltantes'; // mandamos el titulo para evitar pasarlo desde la vista
              return view('show_resultado', compact('msg', 'msg2','ruta','titulo'));
        }

        public function actulizar_users(){
            $consulta = DB::connection('padron')->select("SELECT bsas.add_user_ra()");
            $info = "";
            if (count($consulta)<1){
               $info="No se actulizaron usuarios";
            }
            for ($i = 0; $i < count($consulta); $i++) {
               $parts = explode(',', str_replace(['(', ')'], '', $consulta[$i]->add_user_ra));
               $info .= $parts[0] . ': ' . $parts[1] . ' - ' . $parts[2] . "<br>";
            }
            return view('actualizaruser', ['info' => $info]);
       }     
  
  }
  /*
  
  OTRAS =
  en eliminar_formulario 
      agregar delete localizacion si tiene marcar localizacion_para_borrar_pendiente
  
  */