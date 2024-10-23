<?php

namespace App\Http\Controllers\Formulario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Periodos;
use App\Model\Logs;
use App\Model\Migracion\Localizacion_periodo;
use App\Model\Datos_localizacion_periodo;
use App\Model\Oferta_periodo;
use App\Model\Datos_formulario;
use App\User;
use Ultraware\Roles\Models\Role;
use App\Http\Controllers\Formulario\DatosFormularioController;
use Illuminate\Support\Facades\App;
use Auth;
use Session;
use Carbon\Carbon;
use ConsoleProgressBar;

class InicializaPeriodoController extends Controller
{

    /* 
    Metodo para inicializar (crear los formularios vacios) un periodo, 
    */
    
   public function Inicializar_periodo($id_periodo,$id_localizacion_periodo=null) {
   /*CHECK Y ELIMINAR UN PERIODO /SIN dATOS)
    select count (*) from localizaciones_periodo where id_periodo=75
      delete from oferta_periodo 
      where id_localizacion_periodo in (select  id_localizacion_periodo from localizaciones_periodo where id_periodo=75);
      delete from localizaciones_periodo where id_periodo=75;
      delete from logs where id_periodo=75;
      select * from logs where proc='Inicializar_periodo';
    */      
      ignore_user_abort(true); 
      // set_time_limit(0); // ponemos el tiempo de ejecucion en forever del scrip
      ini_set('max_execution_time',0);
      $fecha = Carbon::now('America/Buenos_Aires'); //date("Y-m-d H:i:s", time());  // calculamos fecha a usar x la articulacion
      
      // $fecha=date_create('2017-10-18 14:03:00'); // reescribo la fecha para pruebas
      // $msg[]="";
      // $msg[]= "ARTICULANDO RELEVAMIENTO ".$f->periodo." : datos al ". $fecha_cortedealtas->format('d-m-Y');
      // $msg[]=""; $msg[]="";
      // rescato datos del periodo
      $p=Periodos::find($id_periodo); 

      // verificamos que el Relevamiento este en carga
      if (!$p->en_carga)  
         { // si el periodo no esta en carga no se puede minicializar
            Session::flash('flash_message_error','El relevamiento está cerrado, no se puede inicializar');
            return back();
         }

      // busco la ultima inicialización
      $log=Logs::where ('id_periodo','=',$id_periodo)->where ('proc','=','Inicializar_periodo')->orderBy ('inicio','desc')->first();

      // Verificamos que no halla una inicialización en ejecución
      if (!is_null($log) and is_null($log->fin) )
         {  //dd('ya');
            Session::flash('flash_message_error','Ya hay una inicialización en ejecución, espere que finalice');           
            return back(); 
         }
      

      // buscamos las localizaciones sin formulario generado para inicializar la base de carga
		$localizaciones=DB::Select(" 
               select id_localizacion_periodo 
						from localizaciones_periodo lp
						     left join datos_formulario df using (id_localizacion_periodo)
						where df.id_localizacion_periodo is null
						          and id_periodo=:id_periodo
            limit 3" ,  ['id_periodo' => $id_periodo] );
    // limit 1000

      $localizaciones=collect($localizaciones);
    
      //dd($localizaciones);


      // Verificamos que halla localizaciones para inicializar
      if ($localizaciones->isEmpty() )
      { 
         Session::flash('flash_message_error','No hay localizaciones con datos para inicializar ('. $fecha->Format('d/m/Y H:i:s') .')');
         return back(); 
      }
      

      // agregamos el inicio de una nueva inicialización
      $id_log=Logs::insertGetId( ['proc'=>'Inicializar_periodo', 'msg' =>'inicio de inicializacion', 'id_periodo'=>$id_periodo,
                                  'inicio'=>$fecha, 'id_usuario'=>Auth::user()->id ], 'id_log');

      // eliminar datos de inicializaciones anteriores   
      if ($localizaciones->count()>1)
      {
         // eliminamos todos los datos del periodo 
      } 
      else
      {
         // eliminamos los datos solos de la localizacion
      }

       $msg=[];

      // PRECESAMOS LAS LOCALZACIONES QUE SE deben inicializar ($localizaciones)
      foreach ($localizaciones as $key => $loc)
      {  

         // inicializar localizacion
        // dd($loc->id_localizacion_periodo);
        $formulario = New DatosFormularioController($loc->id_localizacion_periodo); 
        $formulario->save ();
         
         if (!isset($formulario->id_localizacion) )
         {
         	dd($loc,$formulario);
         }                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
         $msg[]= [
                   'cueanexo'=> $formulario->cueanexo, //'CUEANEXO'=> 
                   'codigo_jurisdiccional'=> $formulario->codigo_jurisdiccional, //'codigo_jurisdiccional'=>
                   'loca'=> $formulario->id_localizacion, //'id_localizacion='=>
                   'msg'=> 'inicializado', //'descripcion'=> 
      // cerramos el proceso de articulación
                 ];

         unset ($formulario);

      }



      Logs::where ( 'id_log',$id_log )
                        ->update ( [ 'msg' =>'inicializacion terminada','fin'=>Carbon::now('America/Buenos_Aires'),'cant_localizaciones'=>$localizaciones->count()]);

      $msg2="RELEVAMIENTO ".$p->periodo." : INICIALIZACIÓN FINALIZADA : ". $localizaciones->count() ." Localizaciones inicializadas en "
               .$fecha->diffForHumans(Carbon::now('America/Buenos_Aires'),true);

      // dd($msg,$msg2);

      set_time_limit(60); // restablecemos el tiempo de ejecucion en 60' del scrip                        

      // Session::flash('flash_message_ok','ARTICULACION FINALIZADA :' .$articulacion->count().' Localizaciones actualizadas en '.$fecha->diffForHumans(Carbon::now('America/Buenos_Aires'),true));
      // return back(); 
      $ruta='Incializar_periodo';
      $titulo='Generar formularios vacios de un relevamiento';
      return view('show_resultado', compact('msg', 'msg2','ruta','titulo'));

   } // FUNCTION inicializar_periodo()





         



   
}
