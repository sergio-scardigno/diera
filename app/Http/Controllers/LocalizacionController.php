<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\UploadedFile;
use Session;
use Auth;
use DB;
use PDF;
use Charts;
use App\User;
use Carbon\Carbon;
// use Mail;

use App\Mail\FormularioCompleto;
use App\Mail\FormularioIncompleto;
use App\Mail\RelevamientoDIE;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Formulario\DatosFormularioController;


use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use Ultraware\Roles\Models\Role;
use App\Model\Periodos;
use App\Model\Logs;
use App\Model\Localizaciones_periodo;
use App\Model\Estado_formulario_tipo;
use App\Model\Datos_localizacion_periodo;
use App\Model\Opciones_combos;
use App\Model\Definicion_formulario;
use App\Model\Partidos;
use App\Model\regiones;
use App\Model\localidad_tipo;
use App\Model\p_servicios_educativos;

use App\Exports\Localizaciones_periodoExport;
use App\Exports\EstadisticaExport;
use App\Exports\PservicioExport;

use Maatwebsite\Excel\Facades\Excel;

class LocalizacionController extends Controller
{
    public function index(Request $request, $idperiodo)
    {
      if (!Auth::check()) {
        toastr()->info('Session expirada. Ingrese nuevamente!');
        return redirect('/home');
     }
   //  dd($request->submitbutton);
   switch($request->submitbutton) {  
      case 'filter-true': 
        $request->session()->put('filter', [
          'filter_name' => ($request->get('nombre') !== null ) ? $request->get('nombre') : '',
          'filter_cue' => ($request->get('cueanexo') !==null) ? $request->get('cueanexo') : ''  ,
          'filter_clave'=> ($request->get('codigo_jurisdiccional') !== null ) ? $request->get('codigo_jurisdiccional') : '',
          'filter_estado'=> ($request->get('estado_formulario') !== null ) ? $request->get('estado_formulario') : '',
          'filter_distrito'=> ($request->get('distrito') !== null) ? $request->get('distrito') : '',
          'filter_rama'=> ($request->get('rama') !== null) ? $request->get('rama') : '',
          'filter_supervicion'=> ($request->get('supervicion') !== null) ? $request->get('supervicion') : '', 
          'filter_region_educativa'=> ($request->get('region_educativa') !== null) ? $request->get('region_educativa') : '',
          'filter_aplicado'=>true
      ]);       
      break;
      case 'filter-false': 
        $request->session()->put('filter', [
          'filter_name' => '',         
          'filter_cue' => '',
          'filter_clave'=> '',
          'filter_rama'=> '',
          'filter_estado'=> '',          
          'filter_distrito'=> '',
          'filter_supervicion'=>'',
          'filter_region_educativa'=>'',
          'filter_aplicado'=>false
      ]);            
      break;
      
     }

//dd($request->submitbutton);
// if (($request->session()->get('filter') !== null) )  {
//           $request->session()->put('filter', [
//             'filter_name' => ($request->get('nombre') !== null ) ? $request->get('nombre') : '',
//             'filter_cue' => ($request->get('cueanexo') !==null) ? $request->get('cueanexo') : ''  ,
//             'filter_clave'=> ($request->get('codigo_jurisdiccional') !== null ) ? $request->get('codigo_jurisdiccional') : '',
//             'filter_estado'=> ($request->get('estado_formulario') !== null ) ? $request->get('estado_formulario') : '',
//             'filter_distrito'=> ($request->get('distrito') !== null) ? $request->get('distrito') : '',
//             'filter_rama'=> ($request->get('rama') !== null) ? $request->get('rama') : '',
//             'filter_supervicion'=> ($request->get('supervicion') !== null) ? $request->get('supervicion') : '', 
//             'filter_region_educativa'=> ($request->get('region_educativa') !== null) ? $request->get('region_educativa') : '',
//             'filter_aplicado'=>true
//           ]);
// }
// else        
//      if (($request->submitbutton == 'filter-false') or ($request->session()->get('filter') == null ))      
// {
//           $request->session()->put('filter', [
//             'filter_name' => '',         
//             'filter_cue' => '',
//             'filter_clave'=> '',
//             'filter_rama'=> '',
//             'filter_estado'=> '',          
//             'filter_distrito'=> '',
//             'filter_supervicion'=>'',
//             'filter_region_educativa'=>'',
//             'filter_aplicado'=>false
//         ]); 
// }
     /*
     else {
      $request->session()->put('filter', [
        'filter_name' => ($request->get('nombre') !== null ) ? $request->get('nombre') : '',
        'filter_cue' => ($request->get('cueanexo') !==null) ? $request->get('cueanexo') : ''  ,
        'filter_clave'=> ($request->get('codigo_jurisdiccional') !== null ) ? $request->get('codigo_jurisdiccional') : '',
        'filter_estado'=> ($request->get('estado_formulario') !== null ) ? $request->get('estado_formulario') : '',
        'filter_distrito'=> ($request->get('distrito') !== null) ? $request->get('distrito') : '',
        'filter_rama'=> ($request->get('rama') !== null) ? $request->get('rama') : '',
        'filter_supervicion'=> ($request->get('supervicion') !== null) ? $request->get('supervicion') : '', 
        'filter_region_educativa'=> ($request->get('region_educativa') !== null) ? $request->get('region_educativa') : '',
        'filter_aplicado'=>true
      ]);
     }
*/
      // pasamos el recues a una variable local $filtro
      $filtro = $request->session()->get('filter');
      
       
     // dd($request->submitbutton, $request->session(),$request->session()->get('filter'), $filtro);

      Session::forget('formulario');
      Session::forget('periodo');
      $periodo=Periodos::select('periodos.*')->where('id_periodo',$idperiodo)->first();
      Session::put('periodo', $periodo);
      $p=$periodo->id_periodo;

      

      if (Auth::user()->hasRole('admin') or (Auth::user()->hasRole('supervisor') or Auth::user()->hasRole('editor') or
       Auth::user()->hasRole('solo_lectura'))) {
       

      $localizacion=localizaciones_periodo::      
        join ('def_formulario_organizacion as dfo', 'dfo.c_organizacion','=','localizaciones_periodo.c_organizacion')      
        ->join ('definicion_formulario as df', function ($Join) use ($p)
                { $Join->on ('df.id_definicion_formulario','=','dfo.id_definicion_formulario')->whereRaw ('"df"."id_periodo" = '. $p); } )
        ->leftjoin('datos_formulario','datos_formulario.id_localizacion_periodo','=', 'localizaciones_periodo.id_localizacion_periodo')
        ->leftjoin('estado_formulario_tipo', 'estado_formulario_tipo.c_estado_formulario','=','datos_formulario.c_estado_formulario')
        ->leftjoin('partidos', 'partidos.c_departamento','=','localizaciones_periodo.c_departamento')    
        ->select( 'localizaciones_periodo.id_localizacion_periodo', 'localizaciones_periodo.id_localizacion',                   
                  'localizaciones_periodo.cueanexo', 'localizaciones_periodo.id_serv', 'localizaciones_periodo.codigo_jurisdiccional',
                  'localizaciones_periodo.nombre','localizaciones_periodo.departamento', 'id_region_educativa',
                  'df.nombre_corto', 'datos_formulario.c_estado_formulario',  
                  DB::raw ( "case when datos_formulario.c_estado_formulario is null then 'Vacio' else estado_formulario_tipo.descripcion end as descripcion"))
        ->where ('localizaciones_periodo.id_periodo','=', $periodo->id_periodo)
        ->orderBy('localizaciones_periodo.codigo_jurisdiccional', 'asc')
        ->Supervicion( $filtro['filter_supervicion'] )
        ->Name( $filtro['filter_name'])
        ->Cueanexo( $filtro['filter_cue'])
        ->Codigo_jurisdiccional( $filtro['filter_clave'])
        ->Estado_formulario( $filtro['filter_estado'])
        ->Departamento( $filtro['filter_distrito'] )
        ->Region( $filtro['filter_region_educativa'] )
        ->Rama( $filtro['filter_rama'])  
        ->Paginate(10)->onEachSide(5);       
        }
      else  {
       $id_usuario=Auth::user()->id;

       $localizacion=Localizaciones_periodo::
        join ('def_formulario_organizacion as dfo', 'dfo.c_organizacion','=','localizaciones_periodo.c_organizacion')      
        ->join ('definicion_formulario as df', function ($Join) use ($p)
                { $Join->on ('df.id_definicion_formulario','=','dfo.id_definicion_formulario')->whereRaw ('"df"."id_periodo" = '. $p); } )
        ->join('usuario_localizacion_assn as assn', function ($Join) use ($id_usuario)
              { $Join->on ('assn.id_localizacion','=','localizaciones_periodo.id_localizacion')->whereRaw ('"assn"."id_usuario" = '.$id_usuario); } )
        ->leftjoin('datos_formulario','datos_formulario.id_localizacion_periodo','=','localizaciones_periodo.id_localizacion_periodo')
        ->leftjoin('estado_formulario_tipo', 'estado_formulario_tipo.c_estado_formulario','=','datos_formulario.c_estado_formulario')
        ->leftjoin('partidos', 'partidos.c_departamento','=','localizaciones_periodo.c_departamento')
        ->select( 'localizaciones_periodo.id_localizacion_periodo', 'localizaciones_periodo.id_localizacion',                   
                  'localizaciones_periodo.cueanexo', 'localizaciones_periodo.id_serv', 'localizaciones_periodo.codigo_jurisdiccional',
                  'localizaciones_periodo.nombre','localizaciones_periodo.departamento', 'id_region_educativa',
                  'df.nombre_corto', 'datos_formulario.c_estado_formulario',        
                  DB::raw ( "case when datos_formulario.c_estado_formulario is null then 'Vacio' else estado_formulario_tipo.descripcion end as descripcion"))
        ->where ('localizaciones_periodo.id_periodo','=', $periodo->id_periodo)
        ->orderBy('localizaciones_periodo.codigo_jurisdiccional', 'asc')
        ->Supervicion( $filtro['filter_supervicion'])
        ->Name($filtro['filter_name'])
        ->Cueanexo( $filtro['filter_cue'])
        ->Codigo_jurisdiccional( $filtro['filter_clave'])
        ->Estado_formulario( $filtro['filter_estado'])
        ->Departamento( $filtro['filter_distrito'])
        ->Region($filtro['filter_region_educativa'])
        ->Rama( $filtro['filter_rama'])        
        ->Paginate(10)->onEachSide(5);
      }
      
      $supervicion=['Oficial','Diegep'];     
      $estado_formulario=Estado_formulario_tipo::orderBy('orden')->select('c_estado_formulario','descripcion','orden')->get();

      $regiones=regiones::orderBy('id_region_educativa')->select( 'id_region_educativa', 'nombre')->get();  

      if ($filtro['filter_region_educativa'] !=''){
        $partidos=Partidos::orderBy('nombre')->select('c_departamento','nombre')
        ->where( 'id_region_educativa', '=', $filtro['filter_region_educativa'] )
        ->where('codigo_distrito', '<' ,'900')->get(); }
      else {
          $partidos=Partidos::orderBy('nombre')->select('c_departamento','nombre')->where('codigo_distrito', '<' ,'900')->get(); 
      }
      
      $definicion_formulario=Definicion_formulario::orderBy('id_definicion_formulario')->select('nombre_corto')
      ->where('id_periodo','=', $periodo->id_periodo)->get();

      return view('localizacion', compact('localizacion', 'estado_formulario', 'periodo', 'filtro', 'definicion_formulario', 'partidos', 'regiones' ,'supervicion'));
    }

    public function formulario($id, $start = null)  { // Formulario Inicio
     
      if (!Auth::check()) { return redirect('/home');  }
        
 
      if (!$start){ $formulario=Session::get('formulario'); }

      else { $formulario = New DatosFormularioController($id);
   
        if ($formulario->id_definicion_formulario==null) { //no se encontro el formulario
       
          $loc=Localizaciones_periodo::select('cueanexo','codigo_jurisdiccional','c_organizacion','id_periodo')->where('id_localizacion_periodo',$id)->first();
          Session::flash('flash_message_error', 'No hay formulario para el CUE-Anexo:' . $loc->cueanexo . ' - ' . $loc->codigo_jurisdiccional.' Organización: ' . $loc->c_organizacion);
          return redirect('localizacion/'.$loc->id_periodo);
        }
              Session::put('formulario', $formulario);
              Session::save();
        }

  
       
      if ($formulario ==null){ return redirect('/home'); }     
      
      $periodo=Periodos::select('periodos.*')->where('id_periodo','=',$formulario->id_periodo)->first();      
      $partidos=Partidos::orderBy('nombre')->select('c_departamento', 'nombre')->where('codigo_distrito', '<' ,'900')->get();
    
      if (!Auth::user()->infocheck and Auth::user()->hasRole('director_escuela') and $periodo->en_carga  and $periodo->id_periodo == 103) {
        $localidad=localidad_tipo::orderBy('nombre')->select('c_localidad','c_departamento', 'nombre', 'tipo')
        ->where('cod_localidad', 'like' ,'06%')
        ->where('tipo', '!=' ,'BAJA')        
        ->orWhereNull('tipo')    
        ->Departamento( $formulario->c_departamento)
        ->get();        
           return view('verificar_info', compact('formulario', 'partidos', 'localidad'));        
        }
      else {    
       return view('formulario', compact('formulario', 'periodo') );
      }
    } //fin Formulario

    // Verificación de Datos
    public function verificacion_datos(Request $r, $id)    {   
            
      $loc_name=localidad_tipo::select('nombre')->where('c_localidad', '=' ,$r->localidad)->first(); // recupero nombre de la localidad
       
      $DL = Datos_localizacion_periodo::Where('id_localizacion_periodo',$id )
      ->update(['calle'=> $r->calle, 'nro'=>$r->numero, 'cod_postal'=> $r->cp,
      'calle_lateral_derecha' =>$r->calle_lateral_derecha, 'calle_lateral_izquierda' =>$r->calle_lateral_izquierda,
      'departamento'=>$r->departamento, 'c_localidad'=> $r->localidad,'localidad'=>$loc_name->nombre,
      'telefono_cod_area'=>$r->telefono_cod_area, 'telefono'=>$r->telefono,
      'email'=>$r->email,
      'email2'=>$r->email2, 'responsable'=>$r->responsable, 'email_resp'=>$r->email_resp
      ]);


      // cambiar en usar el infocheck a true
      $user= User::find(Auth::user()->id);
      $user->infocheck=1;
      $user->save();
      toastr()->success('Datos guardados correctamente!!');

      $formulario=Session::get('formulario');
      $periodo=Periodos::select('periodos.*')->where('id_periodo','=',$formulario->id_periodo)->first();
      return view('formulario', compact('formulario', 'periodo') );

    } // fin verificacion de datos

    public function update_verificacion_datos(Request $r, $id)    {    

      $loc_name=localidad_tipo::select('nombre')->where('c_localidad', '=' ,$r->localidad)->first(); // recupero nombre de la localidad

      $DL = Datos_localizacion_periodo::Where('id_localizacion_periodo',$id )
      ->update(['calle'=> $r->calle, 'nro'=>$r->numero, 'cod_postal'=> $r->cp,
      'calle_lateral_derecha' =>$r->calle_lateral_derecha, 'calle_lateral_izquierda' =>$r->calle_lateral_izquierda,
      'departamento'=>$r->departamento, 'c_localidad'=> $r->localidad,'localidad'=>$loc_name->nombre,
      'telefono_cod_area'=>$r->telefono_cod_area, 'telefono'=>$r->telefono,
      'email'=>$r->email,
      'email2'=>$r->email2, 'responsable'=>$r->responsable, 'email_resp'=>$r->email_resp
      ]);

      toastr()->success('Datos guardados correctamente!!');
     
      return  back();

    } // fin verificacion de datos

    public function eliminarformulario($id)  { /// Eliminar formulario
        DatosFormularioController::dat_formulario_delete($id);
      return back();
    }

    public function confirmarformulario($id)  { /// Confirmar formulario
      $formulario=Session::get('formulario');
      if ($formulario ==null){ $formulario = New DatosFormularioController($id); }
      if ($formulario->confirmarformulario()) {  toastr()->success('Formulario confirmado correctamente!!!'); }
      else {   toastr()->error('No es posible confirmar el formulario tiene errores!!!'); }
      return back();
    } /// Confirmar formulario

    public function desconfirmarformulario($id){  /// Desconfirmar formulario
      $formulario=Session::get('formulario');
      if ($formulario ==null){
          $formulario = New DatosFormularioController($id);
      }
      $formulario->desconfirmarformulario();

      toastr()->success('Formulario desconfirmado correctamente!!');

      return back();
    } // fin desconfimar formulario

    public function declaracionjurada($id) { // Declaración Jurada
       $formulario=Session::get('formulario');
       if ($formulario ==null){
          $formulario = New DatosFormularioController($id);
       }
      // Asi descargo el pdf
      $pdf = PDF::loadView('declaracionjurada', compact('formulario'));
      return $pdf->download('Declaracion Jurada '.$formulario->codigo_jurisdiccional.'.pdf');
    } // fin declaración Jurada


    public function show(Request $request, $id) {

      if ($id == null or ! session()->has('formulario'))
      { return redirect('/home'); }

      if ($id == Session()->get('formulario')->id_localizacion_periodo) // si no cambió el formulario en otro
        { $formulario=Session::get('formulario'); }
      else // vuelvo a recuperar el formulario porque se cambio en otro acceso de esta session
        { $formulario = New DatosFormularioController($id); }

       Session::forget('periodo');
       $periodo=Periodos::select('periodos.*')->where('id_periodo',$formulario->id_periodo)->first();
       Session::put('periodo', $periodo);

      $key_opcion_combo = 'opciones_combos_'.$formulario->id_definicion_formulario;
      if (Redis::get($key_opcion_combo)) {$opciones_combos = Redis::get($key_opcion_combo);}
      else {
        $opciones_combos = Opciones_combos::select('descripcion','id_opciones_combos', 'id_combo', 'id_definicion_formulario')->orderBy('orden')->where ('id_definicion_formulario','=',$formulario->id_definicion_formulario)->get();
          Redis::set($key_opcion_combo, $opciones_combos);
      }

      $opciones_combos=collect(json_decode($opciones_combos));
      $pageName = 'page';
      $page_filter=collect($formulario->cuadros);

      $filtered = $page_filter->whereNotIn('c_estado_cuadro', [87]);
      $filtered->all();
      $pageName = 'page';
      $page = Paginator::resolveCurrentPage($pageName);
      $page = $this->paginate($filtered, $perPage = 2, $page = null,  $options = ['path' => Paginator::resolveCurrentPath(), 'pageName' => $pageName]);
      return view('localizacion_formulario', compact('formulario', 'page', 'periodo'),  ['opciones_combos'=>$opciones_combos]);
    }

  public function paginate($items, $perPage = 2, $page = 1, $options = [])
  {
      $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
      $items = $items instanceof Collection ? $items : Collection::make($items);
      return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
  }


  public function grabarformulario(Request $request) 
  { 
      $edit_id=$request->id_localizacion_periodo; //trato de recuper el id del formulario editado
      if ($edit_id == null or ! session()->has('formulario'))
          { return redirect('/home'); }

      if ($edit_id == Session()->get('formulario')->id_localizacion_periodo) // si no cambió el formulario en otra vista concurrente
          { $formulario=Session::get('formulario'); }
      else // vuelvo a recuperar el formulario porque se cambio en otro acceso concurrente de esta session
          { $formulario = New DatosFormularioController($edit_id); }

      $result = collect($request->all());
   
      $cuadros_editados=$result->except("_token")->toArray()['cuadros'];
      
      $formulario->cargar_input($cuadros_editados);
      // dd($formulario);
      // toastr()->info('Consistiendo.....');

      $formulario->consistir_cuadros_editados($cuadros_editados);
      $formulario->save_cuadros_editados($cuadros_editados);
      Session::forget('formulario'); // elimino de la session
      Session::put('formulario',$formulario);  // lo guardamos en la session
      Session::save(); // this call is required in addition to put()
      toastr()->success('Cuadros grabados correctamente!!!');
      if ($formulario->c_estado_formulario ==80 OR $formulario->c_estado_formulario ==90){
          toastr()->info('El formulario esta completo, no se olvide de confirmarlo!!!');
      }
      return back();
  }

  public function impresion_formulario($id)
  {
      toastr()->info('Exportando.....');
      $formulario=Session::get('formulario');
      $key_opcion_combo='opciones_combos_'.$formulario->id_definicion_formulario;
      if (Redis::get($key_opcion_combo)) {
          $opciones_combos=Redis::get($key_opcion_combo);
      }
      else {
          $opciones_combos=Opciones_combos::select('descripcion','id_opciones_combos', 'id_combo', 'id_definicion_formulario')->orderBy('orden')->where ('id_definicion_formulario','=',$formulario->id_definicion_formulario)->get();
          Redis::set($key_opcion_combo, $opciones_combos);
      }
      $opciones_combos=collect(json_decode($opciones_combos));

      //  // Asi descargo el pdf
      // $pdf = PDF::loadView('formulariopdf', compact('formulario', 'page', 'opciones_combos'));
      // $pdf->setPaper('legal', 'landscape');
      // return $pdf->download('formulario.pdf');

      // Asi lo visualizo no lo puedo abrir en otra pestaña
      $view = \View::make('formulariopdf', compact('formulario', 'opciones_combos'))->render();
      $pdf = \App::make('dompdf.wrapper');
      $pdf->setPaper('legal', 'landscape');
      $pdf->loadHTML($view);
      
      return $pdf->download('Planilla '.$formulario->codigo_jurisdiccional.'.pdf');
  }

  // Grilla a excel
  public function grilla_excel(Request $r, $periodo )
  {  
      return (new Localizaciones_periodoExport($r, $periodo))->download('localizaciones.xlsx');
      return back();
  } //  fin grilla excel

  // PROCESOS
  public function select_periodo ($ruta,$title) 
  {  
      $periodo=Periodos::select('periodos.*')->orderBy('id_periodo')->where('en_carga','=',true)->get();
      return view('select_periodo', compact('periodo','ruta','title'));
  }

  // Confirmar formularios completos con fecha del dia anterior
  public function confirmar_completos($id_periodo) 
  {   
      $proc='confirmar_completos'; // proceso a realizar
      if (!Auth::check()) {
        toastr()->info('Session expirada. Ingrese nuevamente!');
        return redirect('/home');
      } 
      
      $p=Periodos::find($id_periodo); // rescato datos del periodo
      // verificamos que el Relevamiento este en carga
      if (!$p->en_carga)
      { // si el periodo no esta en carga no se pueden confirmar
          Session::flash('flash_message_error','El relevamiento está cerrado, no se permiten confirmaciones!!!');
          return back();
      }

      // busco la ultima confirmación
      $log_conf=Logs::where ('id_periodo','=',$id_periodo)->where('proc',$proc)->orderBy ('inicio','desc')->first();

      // Verificamos que no halla una confirmación en ejecución
      if (!is_null($log_conf) and is_null($log_conf->fin) )  {            
            toastr()->warning('Ya hay una confirmación en ejecución, espere que finalice, o limpie el logs!!');
            return back(); 
      }

      //$f_conf_inicio=is_null($log_conf) ? $fecha: new Carbon($log_conf->inicio); // recupero la fecha de inicio de la articulacion anterior
      // si es la primera confirmacion tomo la fecha de ahora


      // query para buscar las localizaciones sin confirmar y completadas hace mas de un dia
      $lote=DB::Select("select id_localizacion_periodo from datos_formulario df join localizaciones_periodo lp using (id_localizacion_periodo)
                             where (df.c_estado_formulario between 80 and 99) and df.updated_at + '1 day'::interval < now() 
                             and id_periodo=:id_periodo order by lp.id_serv " // limit 10 
                           , ['id_periodo' => $id_periodo] );

      // query para rechequear todas las que están confirmadas o no
      //  $lote=DB::Select("select id_localizacion_periodo from datos_formulario df join localizaciones_periodo lp using (id_localizacion_periodo)
      //                          where (lp.id_serv > 0) and id_periodo=:id_periodo order by lp.id_serv limit 10 "
      //                        , ['id_periodo' => $id_periodo] );

      // query para rechequear confirmación de formularios de especial
      // $lote=DB::Select("select id_localizacion_periodo from datos_formulario df join localizaciones_periodo lp using (id_localizacion_periodo)
      //                           where (df.id_definicion_formulario=7 and c_estado_formulario =100) and id_periodo=:id_periodo"
      //                           , ['id_periodo' => $id_periodo] );    
    
      // query para rechequear formularios en estado 20 "error de carga" y volver a consistirlos!
      // $lote=DB::Select("select id_localizacion_periodo from datos_formulario df join localizaciones_periodo lp using (id_localizacion_periodo)
      // where (df.c_estado_formulario=20) and df.updated_at > '2020-03-16' " );

      $lote=collect($lote);
      // Verificamos que halla localizaciones para migrar
      if ($lote->isEmpty() )
      {
        Session::flash('flash_message_error','No hay formularios completos para confirmar ('. $Carbon::now('America/Buenos_Aires')->Format('d/m/Y H:i:s') .')');
        return back();
      }
      $msg=[];
      $msg2='';

      $this->consistir_formularios($p, $lote, $proc, $msg, $msg2);

      $ruta=$proc; // 'confirmar_completos';
      $titulo='Confirmar Formularios Completos'; // mandamos el titulo para evitar pasarlo desde la vista
      return view('show_resultado', compact('msg', 'msg2','ruta','titulo'));
  } // FUNCTION confirmar_completos()

 
  // Revisar las consistencias y actualizar estado de todos los formularios, si encuentra error los desconfirma
  public function revisar_consistencias($id_periodo) 
  {  
      $proc='revisar_consistencias'; // proceso a realizar
      if (!Auth::check()) {
        toastr()->info('Session expirada. Ingrese nuevamente!');
        return redirect('/home');
      } 
     
      $p=Periodos::find($id_periodo); // rescato datos del periodo
      // verificamos que el Relevamiento este en carga
      if (!$p->en_carga)
      { // si el periodo no esta en carga no se puede migrar
          Session::flash('flash_message_error','El relevamiento está cerrado, no se permiten confirmaciones!!!');
          return back();
      }

      // busco la ultima confirmación
      $log_conf=Logs::where ('id_periodo','=',$id_periodo)->where('proc',$proc)->orderBy ('inicio','desc')->first();

      // Verificamos que no halla una confirmación en ejecución
      if (!is_null($log_conf) and is_null($log_conf->fin) )  {            
            toastr()->warning('Ya hay una confirmación en ejecución, espere que finalice, o limpie el logs!!');
            return back(); 
      }

      // query para rechequear todos las que están confirmadas o no
      $lote=DB::Select("select id_localizacion_periodo from datos_formulario df join localizaciones_periodo lp using (id_localizacion_periodo)
                          where (lp.id_serv > 0) and id_periodo=:id_periodo order by lp.id_serv " // limit 10 
                          , ['id_periodo' => $id_periodo] );

      $lote=collect($lote);
      // Verificamos que halla localizaciones para migrar
      if ($lote->isEmpty() )
      {
        Session::flash('flash_message_error','No hay formularios Revisar consistencias ('. Carbon::now('America/Buenos_Aires')->Format('d/m/Y H:i:s') .')');
        return back();
      }
      $msg=[];
      $msg2='';
      //procesamos el lote de formularios
      $this->consistir_formularios($p, $lote, $proc, $msg, $msg2);

      $ruta=$proc; //'revisar_consistencias'
      $titulo='Revisar consistencias de todos los formularios'; // mandamos el titulo para evitar pasarlo desde la vista
      return view('show_resultado', compact('msg', 'msg2','ruta','titulo'));
  } // FUNCTION revisar_consistencias()
 

// Revisar las consistencias o confirmar formularios de un lote 
public function consistir_formularios($p, $lote, $proc, &$msg, &$msg2) 
{  
      //Función para reconsistir o confirmar un lote de formularios
      // parametros:
      //   $p, registro del periodo
      //   $lote lote de formularios a proceesar
      //   $proc procesos a realizar 'confirmar_completos' o 'revisar_consistencias'
      //   &$msg devuelve resultado x cue
      //   &$msg2 devuelve totales

      ignore_user_abort(true);
      // set_time_limit(0); // ponemos el tiempo de ejecucion en forever del scrip
      ini_set('max_execution_time',0);
      // registramos  de inicio del procesamiento del nuevo lote de formularios a analizar
      $fecha = Carbon::now('America/Buenos_Aires'); //date("Y-m-d H:i:s", time());  // tomamos la fecha y hora de inicio
      $id_log_conf=Logs::insertGetId( [ 'proc'=>$proc, 'msg'=>'Total a confirmar:'.$lote->count(), 'id_periodo'=>$p->id_periodo
                                        , 'inicio'=>$fecha,'cant_localizaciones'=>0, 'id_usuario'=>Auth::user()->id, ], 'id_log');                                         
      $msg=[]; // resultado x cue 
      $cant_loc=0;  // contador de localizaciones procesadas

      // PRECESAMOS LAS LOCALIZACIONES QUE SE deben analizar ($lote)
      foreach ($lote as $key => $loc)
      {
          // levantamos el formulario en memoria
          $formulario = New DatosFormularioController($loc->id_localizacion_periodo);

          if($proc=='confirmar_completos') {
            $msg2 = ($formulario->confirmarformulario())? 'confirmado' : ' con errores';  // intentamos confirmar el formulario
          }
          else { //  revisar_consistencias
            $e0=$formulario->c_estado_formulario;
            $formulario->check_estado_formulario(); //forzamos revisión de las consistecias del formulario
            $e1d=Estado_formulario_tipo::select('descripcion')->where('c_estado_formulario', $formulario->c_estado_formulario)->first();            
            $msg2 = (($e0 == $formulario->c_estado_formulario) ? 'Sin Cambio ' : 'Cambio a ') . $e1d->descripcion;  // reportamos el estado del formulario
          }
          $cant_loc++;
          Logs::where ('id_log',$id_log_conf)->update (['msg'=>'Total a confirmar:'.$lote->count().' '.$formulario->codigo_jurisdiccional.' Estado: '.$msg2
                                                        ,'cant_localizaciones'=> $cant_loc]);
          $msg[]= [
                      'cueanexo'=> $formulario->cueanexo, //'CUEANEXO'=>
                      'codigo_jurisdiccional'=> $formulario->codigo_jurisdiccional, //'codigo_jurisdiccional'=>
                      'loca'=> $formulario->id_localizacion, //'id_localizacion='=>
                      'msg'=> $msg2, //'descripcion'=>
                  ];

          unset ($formulario);
      }
      // Cerramos el registro del procesamiento del lote de formularios analizados
      Logs::where ('id_log',$id_log_conf)->update ( [ 'fin'=>Carbon::now('America/Buenos_Aires')]);

      $msg2="RELEVAMIENTO ".$p->periodo." : REVISAR CONSISTENCIAS DE FORMULARIOS COMPLETADO : ". $lote->count() ." Formularios chequeados en "
            .$fecha->diffForHumans(Carbon::now('America/Buenos_Aires'),true);

      set_time_limit(60); // restablecemos el tiempo de ejecucion en 60' del scrip
} // Function consistir_formularios(...)


  // Planila de Servicios educativos
  public function pservicio(Request $r, $idperiodo) {  // Planilla de servicios Educativos
   
      if (!Auth::check()) {
          toastr()->info('Session expirada. Ingrese nuevamente!');
          return redirect('/home');
      } 
      // dd($r->nronota2);
      // dd($r->distrito);
      switch($r->submitbutton) {
          case 'filter-true2': 
              $r->session()->put('filter_servicio', [              
                                   'filter_nronota' => ($r->get('nronota2') !== null ) ? $r->get('nronota2') : '',                
                                   'filter_distrito' => ($r->get('distrito') !== null ) ? $r->get('distrito') : '',                               
                                  'filter_aplicado2'=>true
                                ]);       
          break;
          case 'filter-false2': 
              $r->session()->put('filter_servicio', [
                                  // 'filter_establecimiento' => '',
                                  'filter_distrito' => '',
                                  'filter_nronota' => null,         
                                  'filter_aplicado2'=>false
                                ]);            
          break;
      }
      
      $filtro_servicio = $r->session()->get('filter_servicio');

      $periodo=Periodos::select('periodos.*')->where('id_periodo',$idperiodo)->first();
      $regiones=regiones::orderBy('id_region_educativa')->select( 'id_region_educativa', 'nombre')->get();  
      $partidos=Partidos::orderBy('nombre')->select('c_departamento', 'nombre')->where('codigo_distrito', '<' ,'900')->get();   
 
      if (Auth::user()->hasRole('admin') or (Auth::user()->hasRole('supervisor') or Auth::user()->hasRole('editor') or
          Auth::user()->hasRole('solo_lectura'))) {        

          $servicios_educativos = p_servicios_educativos::select('p_servicios_educativos.id', 'p_servicios_educativos.id_periodo', 
          'p_servicios_educativos.calle', 'p_servicios_educativos.nro', 'p_servicios_educativos.alta_baja',
          'p_servicios_educativos.fecha', 'p_servicios_educativos.created_at', 'p_servicios_educativos.updated_at',
          'p_servicios_educativos.observaciones', 'p_servicios_educativos.causa',
          'p_servicios_educativos.rama', 'p_servicios_educativos.esc_nro', 'p_servicios_educativos.nombre', 'p_servicios_educativos.nronota', 
          'partidos.c_departamento', 'partidos.nombre as distrito', 'users.username', 'users.name')
          ->join('partidos', 'p_servicios_educativos.c_departamento', '=', 'partidos.c_departamento')      
          ->join('users', 'users.id', '=', 'p_servicios_educativos.id_usuario')    
          // ->Nronota(isset($filtro_servicio['filter_nronota']))       
          // ->Distrito(isset($filtro_servicio['filter_distrito']))         
          ->Nronota($filtro_servicio['filter_nronota'])    
          ->Distrito($filtro_servicio['filter_distrito']) 
         ->where('id_periodo', '=', $periodo->id_periodo)            
          ->Paginate(5);
          // dd($servicios_educativos);
    
      }  
      else {
          $id_usuario=Auth::user()->id;
          $servicios_educativos = p_servicios_educativos::select('p_servicios_educativos.id', 'p_servicios_educativos.id_periodo', 'p_servicios_educativos.rama', 'p_servicios_educativos.esc_nro', 'p_servicios_educativos.nombre',   'p_servicios_educativos.nronota',
             'partidos.c_departamento', 'partidos.codigo_distrito', 'partidos.nombre as distrito', 'users.username', 'users.name')
          ->join('partidos', 'p_servicios_educativos.c_departamento', '=', 'partidos.c_departamento')      
          ->join('users', 'users.id', '=', 'p_servicios_educativos.id_usuario')    
          ->Nronota($filtro_servicio['filter_nronota'])    
          ->Distrito($filtro_servicio['filter_distrito'])  
          ->where('id_periodo', '=', $periodo->id_periodo)
          ->where('id_usuario', '=', $id_usuario)    
          ->Paginate(5);    
      }      
  
      return view('pservicio', compact('regiones', 'partidos', 'periodo', 'servicios_educativos', 'filtro_servicio'));
  } // 

  // Grilla a excel
  public function grilla_excel_pservicios(Request $r, $periodo )
  {  
      return (new PservicioExport($r, $periodo))->download('planilla servicios.xlsx');
      return back();
  } //  fin grilla excel

  public function new_pservicio(Request $r)
  {

      // $allowedTypes = ['application/pdf'];
      // $fileType = $_FILES['archivo']['type'];
   
      $serv_edu= new p_servicios_educativos;
      $serv_edu->id_periodo= $r->id_periodo;
      $serv_edu->id_usuario =Auth::user()->id;    
      $serv_edu->c_departamento=$r->distrito;
      $serv_edu->rama=$r->rama;
      $serv_edu->esc_nro=$r->nroestab;
      $serv_edu->nombre=$r->nombre;
      $serv_edu->calle=$r->domicilio;
      $serv_edu->nro=$r->numero;
      $serv_edu->alta_baja=$r->gruopAlta_Baja;
      $serv_edu->causa= $r->causa;
      $serv_edu->fecha=$r->fecha;
      $serv_edu->observaciones= $r->observ;      
      $serv_edu->nronota= 0;
      // $r->nronota;      
     
      // if ($r->hasFile('archivo')) {  
      //   if (in_array($fileType, $allowedTypes)) {
      //     $file = $r->file('archivo');
      //     $filename = $file->getClientOriginalName();
      //     $file->storeAs('', $filename);            
      //     $file_path = '../public/uploads/'.$filename;
      //     if (file_exists($file_path)) {
      //         chmod($file_path, 0777); 
      //         // rename($file_path, $serv_edu->nombre.'-'. $serv_edu->esc_nro.'-'.$serv_edu->alta_baja);
      //     }                 
      //   } else { 
      //       toastr()->warning('Solo se permiten archivos PDF');
      //       return back();
      //   }        
      // }
     $serv_edu->save();      
     toastr()->info('Datos grabados correctamente');
     return back();
  }

  public function eliminarservicio($id)
  {
    //dd($id);
      p_servicios_educativos::destroy($id);        
      return back();
  }

  public function edit_servicio_educativo($id)  {   
      $servicios_educativos = p_servicios_educativos::select('p_servicios_educativos.id', 'p_servicios_educativos.id_periodo', 
      'p_servicios_educativos.calle', 'p_servicios_educativos.nro', 'p_servicios_educativos.alta_baja',
      'p_servicios_educativos.fecha', 'p_servicios_educativos.created_at', 'p_servicios_educativos.updated_at',
      'p_servicios_educativos.observaciones', 'p_servicios_educativos.causa',
      'p_servicios_educativos.rama', 'p_servicios_educativos.esc_nro', 'p_servicios_educativos.nombre', 'p_servicios_educativos.nronota', 
      'partidos.c_departamento', 'partidos.nombre as distrito', 'users.username', 'users.name')
      ->join('partidos', 'p_servicios_educativos.c_departamento', '=', 'partidos.c_departamento')      
      ->join('users', 'users.id', '=', 'p_servicios_educativos.id_usuario')            
      ->where('p_servicios_educativos.id', '=', $id)->first();
      //  dd($servicios_educativos);
      $partidos=Partidos::orderBy('nombre')->select('c_departamento', 'nombre')->where('codigo_distrito', '<' ,'900')->get();   

      // $public_path = public_path();
      // $url = $public_path.'/storage/'.$archivo;
      // //verificamos si el archivo existe y lo retornamos
      // if (Storage::exists($archivo))
      // {
      //   return response()->download($url);
      // }
      return view('servicio_edu_edit', compact('servicios_educativos', 'partidos'));  
  }

  public function  edit_pservicio (Request $r, $id) {     
      $serv_edu= p_servicios_educativos::find($id);    
      $serv_edu->id_periodo= $r->id_periodo;
      $serv_edu->c_departamento=$r->distrito;
      $serv_edu->rama=$r->rama;
      $serv_edu->esc_nro=$r->nroestab;
      $serv_edu->nombre=$r->nombre;
      $serv_edu->calle=$r->domicilio;
      $serv_edu->nro=$r->numero;
      $serv_edu->alta_baja=$r->gruopAlta_Baja;
      $serv_edu->causa= $r->causa;
      $serv_edu->fecha=$r->fecha;
      $serv_edu->observaciones= $r->observ;
      $serv_edu->nronota= $r->nronota;      
      $serv_edu->save();    
      $filtro_servicio = $r->session()->get('filter_servicio');

      $servicios_educativos = p_servicios_educativos::select('p_servicios_educativos.id', 'p_servicios_educativos.id_periodo', 
        'p_servicios_educativos.calle', 'p_servicios_educativos.nro', 'p_servicios_educativos.alta_baja',
        'p_servicios_educativos.fecha', 'p_servicios_educativos.created_at', 'p_servicios_educativos.updated_at',
        'p_servicios_educativos.observaciones', 'p_servicios_educativos.causa',
        'p_servicios_educativos.rama', 'p_servicios_educativos.esc_nro', 'p_servicios_educativos.nombre', 'p_servicios_educativos.nronota', 
        'partidos.c_departamento', 'partidos.nombre as distrito', 'users.username', 'users.name')
      ->join('partidos', 'p_servicios_educativos.c_departamento', '=', 'partidos.c_departamento')      
      ->join('users', 'users.id', '=', 'p_servicios_educativos.id_usuario')     
      ->where('p_servicios_educativos.id', '=', $id)->first();

      toastr()->info('Datos modifcados');
      
      $partidos=Partidos::orderBy('nombre')->select('c_departamento', 'nombre')->where('codigo_distrito', '<' ,'900')->get();   
      return view('servicio_edu_edit', compact('servicios_educativos', 'partidos'));  
  }

  public function print_planilla_servicios(Request $r, $id)   { 
      $filtro_servicio = $r->session()->get('filter_servicio');

      $servicios_educativos = p_servicios_educativos::select('p_servicios_educativos.id', 'p_servicios_educativos.id_periodo', 
        'p_servicios_educativos.calle', 'p_servicios_educativos.nro', 'p_servicios_educativos.alta_baja',
        'p_servicios_educativos.fecha', 'p_servicios_educativos.created_at', 'p_servicios_educativos.updated_at',
        'p_servicios_educativos.observaciones', 'p_servicios_educativos.causa',
        'p_servicios_educativos.rama', 'p_servicios_educativos.esc_nro', 'p_servicios_educativos.nombre', 'p_servicios_educativos.nronota', 
        'partidos.c_departamento', 'partidos.nombre as distrito', 'users.username', 'users.name')
        ->join('partidos', 'p_servicios_educativos.c_departamento', '=', 'partidos.c_departamento')      
      ->join('users', 'users.id', '=', 'p_servicios_educativos.id_usuario')
      ->join('periodos', 'periodos.id_periodo', '=', 'p_servicios_educativos.id_periodo')  
      ->Nronota($filtro_servicio['filter_nronota'])   
      // ->Establecimiento($filtro_servicio['filter_establecimiento'])         
      ->where('p_servicios_educativos.id', '=', $id)->first();
      
      $pdf = PDF::loadView('print_servicio_educativo', compact('servicios_educativos'));   
      return $pdf->download('Planilla_altas_bajas'.$servicios_educativos->esc_nro.'.pdf');
  } //Fin Planila de Servicios educativos

    //  Descargas de planillas 
    public function descargar_planillas($periodo)   
        { return view('descargar_planillas', compact('periodo')); }      


    public function relant() 
        { return view('relant'); }

    public function estadisticacarga($id_localizacion_periodo) {
     $periodo=Periodos::select('periodos.*')->where('id_periodo',$id_localizacion_periodo)->first();
      $datacarga = DB::Select("select * from public.v_actividad_carga where id_periodo = ".$id_localizacion_periodo." limit 30 ");      
      $chartcarga=collect($datacarga);
              foreach ($chartcarga as $u)  {                               
                  $cnt_created[]=$u->cnt_created;
                  $cnt_f_inicio[]=$u->cnt_f_inicio;
                  $cnt_f_fin[]=$u->cnt_f_fin;
                  $cnt_f_updated[]=$u->cnt_f_updated;
                  $dataset[]=$u->fecha;
            }  
           $chartcarga = Charts::multi('line', 'highcharts')
           ->title('Actividad de carga - '.$periodo->periodo)
           ->elementLabel('Cantidad')                        
           ->loaderColor ('#FD7424')                 
           ->colors(['#FD7424', '#00FFC5', '#0038FF', '#00FF05', '#1B9024', '#F000FF'])                
           ->dataset('Creado', $cnt_created) 
           ->dataset('Inicio', $cnt_f_inicio)
           ->dataset('Actualizado', $cnt_f_updated)
           ->dataset('Fin', $cnt_f_fin) 
           ->dimensions(1000,500)
           ->labels($dataset);           
           return view('estadisticacarga',compact('chartcarga'));    
    }
    public function fichaestadistica($id, $id_localizacion_periodo)
    {    
       
      if ($id == null or ! session()->has('formulario'))
      { return redirect('/home'); }
      
        $formulario=Session::get('formulario');
    
    
        $partidos=Partidos::select('codigo_distrito','id_region_educativa')->where('c_departamento',$formulario->c_departamento)->first();
        $cod_dto=$partidos->codigo_distrito;
        $cod_reg=str_pad($partidos->id_region_educativa, 2, "0", STR_PAD_LEFT);
      
    
        
        $data316 =  DB::connection('indicadores')->Select("select  i.indicador,i.idperiodo,cd.descripcion as dominio, valor,co.descripcionoferta, ci.descripcion, ci.detalle, cd.orden
        from indicadores i 
          join ts_cod_indicadores ci on ci.indicador=i.indicador
          join ts_cod_dominios cd on cd.Dominio=i.dominio
          join ts_cod_ofertas co on co.oferta=i.oferta
          where i.indicador = '3.16' and i.subind='T' and i.idperiodo in(101, 104) 
            and i.dependencia= (select max(dependencia) from indicadores 
                                           where indicador = '3.16' and subind='T' and idperiodo in(101, 104)and dominio='C' and cod_dominio='".$id."') --dependencia
            and ( (i.dominio='P' and i.cod_dominio='1')  -- provincia
                  or (i.dominio='R' and i.cod_dominio='".$cod_reg."') --reg de la esc.
                  or (i.dominio='D' and i.cod_dominio='".$cod_dto."') --cod dto
                  or (i.dominio='C' and i.cod_dominio='".$id."') --idserv
                )
            and i.oferta in (select (oferta) from indicadores where indicador = '3.16' and subind='T' 
                                                          and idperiodo in(101, 104)and oferta <> 302 and dominio='C' and cod_dominio='".$id."') --oferta de la escuela
         order by descripcionoferta, orden");
       
      
    
          $data317 =  DB::connection('indicadores')->Select("select i.indicador, i.idperiodo, cd.descripcion as dominio, valor,co.descripcionoferta,ci.descripcion, ci.detalle, cd.orden
          from indicadores i 
            join ts_cod_indicadores ci on ci.indicador=i.indicador
            join ts_cod_dominios cd on cd.Dominio=i.dominio
            join ts_cod_ofertas co on co.oferta=i.oferta
            where i.indicador = '3.17' and i.subind='T' and i.idperiodo in(101, 104)
              and i.dependencia= (select max(dependencia) from indicadores where  indicador = '3.17' and subind='T'
              and idperiodo in(101, 104)and dominio='C' and cod_dominio='".$id."') --dependencia
              and ((i.dominio='P' and i.cod_dominio='1')  -- provincia
                      or (i.dominio='R' and i.cod_dominio='".$cod_reg."') --reg de la esc.
                      or (i.dominio='D' and i.cod_dominio='".$cod_dto."') --cod dto
                      or (i.dominio='C' and i.cod_dominio='".$id."') --idserv
                    )
              and i.oferta in (select (oferta) from indicadores where  indicador = '3.17' and subind='T' and idperiodo in(101, 104)
                        and oferta <>302 and dominio='C'
                              and cod_dominio='".$id."'  
                              ) --oferta de la escuela     
                              order by descripcionoferta, orden"); 
    
            $data318 =  DB::connection('indicadores')->Select("select i.indicador, i.idperiodo, cd.descripcion as dominio, valor,co.descripcionoferta,ci.descripcion, ci.detalle, cd.orden
            from indicadores i 
              join ts_cod_indicadores ci on ci.indicador=i.indicador
              join ts_cod_dominios cd on cd.Dominio=i.dominio
              join ts_cod_ofertas co on co.oferta=i.oferta
              where i.indicador = '3.18' and i.subind='T' and i.idperiodo in(101, 104)  
                and i.dependencia= (select max(dependencia) from indicadores where  indicador = '3.18' and subind='T'
                and idperiodo in(101, 104) and dominio='C' and cod_dominio='".$id."') --dependencia
                and ((i.dominio='P' and i.cod_dominio='1')  -- provincia
                        or (i.dominio='R' and i.cod_dominio='".$cod_reg."') --reg de la esc.
                        or (i.dominio='D' and i.cod_dominio='".$cod_dto."') --cod dto
                        or (i.dominio='C' and i.cod_dominio='".$id."') --idserv
                      )
                and i.oferta in (select (oferta) from indicadores where  indicador = '3.18' and subind='T' and idperiodo in(101, 104)
                          and oferta <>302 and dominio='C'
                                and cod_dominio='".$id."'  
                                ) --oferta de la escuela  
                order by descripcionoferta, orden");
                    
              $data318 =  DB::connection('indicadores')->Select("select i.indicador, i.idperiodo, cd.descripcion as dominio, valor,co.descripcionoferta,ci.descripcion, ci.detalle, cd.orden
          from indicadores i 
            join ts_cod_indicadores ci on ci.indicador=i.indicador
            join ts_cod_dominios cd on cd.Dominio=i.dominio
            join ts_cod_ofertas co on co.oferta=i.oferta
            where i.indicador = '3.18' and i.subind='T' and i.idperiodo in(101, 104)
              and i.dependencia= (select max(dependencia) from indicadores where  indicador = '3.18' and subind='T'
              and idperiodo in(101, 104)and dominio='C' and cod_dominio='".$id."') --dependencia
              and ((i.dominio='P' and i.cod_dominio='1')  -- provincia
                      or (i.dominio='R' and i.cod_dominio='".$cod_reg."') --reg de la esc.
                      or (i.dominio='D' and i.cod_dominio='".$cod_dto."') --cod dto
                      or (i.dominio='C' and i.cod_dominio='".$id."') --idserv
                    )
              and i.oferta in (select (oferta) from indicadores where  indicador = '3.18' and subind='T' and idperiodo in(101, 104) 
                        and oferta <>302 and dominio='C'
                              and cod_dominio='".$id."'  
                              ) --oferta de la escuela
                              order by descripcionoferta, orden");
    
            $data441 = DB::connection('indicadores')->Select("select i.indicador, i.idperiodo, cd.descripcion as dominio, valor,co.descripcionoferta, ci.descripcion, ci.detalle, cd.orden
            from indicadores i 
              join ts_cod_indicadores ci on ci.indicador=i.indicador
              join ts_cod_dominios cd on cd.Dominio=i.dominio
              join ts_cod_ofertas co on co.oferta=i.oferta
              where i.indicador = '4.41' and i.subind='T' and i.idperiodo in(101, 104)
                and i.dependencia= (select max(dependencia) from indicadores where  indicador = '4.41' and subind='T'
                and idperiodo in(101, 104)and dominio='C' and cod_dominio='".$id."') --dependencia
                and ((i.dominio='P' and i.cod_dominio='1')  -- provincia
                        or (i.dominio='R' and i.cod_dominio='".$cod_reg."') --reg de la esc.
                        or (i.dominio='D' and i.cod_dominio='".$cod_dto."') --cod dto
                        or (i.dominio='C' and i.cod_dominio='".$id."') --idserv
                      )
                and i.oferta in (select (oferta) from indicadores where  indicador = '4.41' and subind='T' and idperiodo in(101, 104) 
                          and oferta <>302 and dominio='C'
                                and cod_dominio='".$id."'  
                                ) --oferta de la escuela
                                order by descripcionoferta, orden");
    
            $data320 = DB::connection('indicadores')->Select("select i.indicador, i.idperiodo, cd.descripcion as dominio, valor,co.descripcionoferta,ci.descripcion, ci.detalle, cd.orden
            from indicadores i 
              join ts_cod_indicadores ci on ci.indicador=i.indicador
              join ts_cod_dominios cd on cd.Dominio=i.dominio
              join ts_cod_ofertas co on co.oferta=i.oferta
              where i.indicador = '3.20' and i.subind='T' and i.idperiodo in(101, 104)
                and i.dependencia= (select max(dependencia) from indicadores where  indicador = '3.20' and subind='T'
                and idperiodo in(101, 104)and dominio='C' and cod_dominio='".$id."') --dependencia
                and ((i.dominio='P' and i.cod_dominio='1')  -- provincia
                        or (i.dominio='R' and i.cod_dominio='".$cod_reg."') --reg de la esc.
                        or (i.dominio='D' and i.cod_dominio='".$cod_dto."') --cod dto
                        or (i.dominio='C' and i.cod_dominio='".$id."') --idserv
                      )
                and i.oferta in (select (oferta) from indicadores where  indicador = '3.20' and subind='T' and idperiodo in(101, 104)
                          and oferta <>302 and dominio='C'
                                and cod_dominio='".$id."'  
                                ) --oferta de la escuela
                          order by descripcionoferta, orden");
    
            $data321 = DB::connection('indicadores')->Select("select i.indicador, i.idperiodo, cd.descripcion as dominio, valor,co.descripcionoferta,ci.descripcion, ci.detalle, cd.orden
            from indicadores i 
              join ts_cod_indicadores ci on ci.indicador=i.indicador
              join ts_cod_dominios cd on cd.Dominio=i.dominio
              join ts_cod_ofertas co on co.oferta=i.oferta
              where i.indicador = '3.21' and i.subind='T' and i.idperiodo in (102,105)
                and i.dependencia= (select max(dependencia) from indicadores where  indicador = '3.21' and subind='T'
                and idperiodo in (102,105)and dominio='C' and cod_dominio='".$id."') --dependencia
                and ((i.dominio='P' and i.cod_dominio='1')  -- provincia
                        or (i.dominio='R' and i.cod_dominio='".$cod_reg."') --reg de la esc.
                        or (i.dominio='D' and i.cod_dominio='".$cod_dto."') --cod dto
                        or (i.dominio='C' and i.cod_dominio='".$id."') --idserv
                      )
                and i.oferta in (select (oferta) from indicadores where  indicador = '3.21' and subind='T' and idperiodo in (102,105) 
                          and oferta <>302 and dominio='C'
                                and cod_dominio='".$id."'  
                                ) --oferta de la escuela
                                order by descripcionoferta, orden");                               
                                
                $cantidad_316=collect($data316)->count()/8;
                $cantidad_317=collect($data317)->count()/8;
                $cantidad_318=collect($data318)->count()/8;
                $cantidad_441=collect($data441)->count()/8;
                $cantidad_321=collect($data321)->count()/8;
                $cantidad_320=collect($data320)->count()/4;
    
    
                if ($cantidad_316==0 and $cantidad_317==0 and $cantidad_318 ==0 and $cantidad_441==0  and $cantidad_321==0 
                and $cantidad_320==0 ) {
                  toastr()->info('El establecimiento no tiene indicadores calculados');
                  return back();
                }
                // dd($data316);
          
             // 3.16
                for($i = 1;$i<=collect($data316)->count();$i++) {            
                 if ($i==1){ 
                   $chart316_1=collect($data316)->where('descripcionoferta', '===', $data316[0]->descripcionoferta);
                    foreach ($chart316_1 as $u)  {                               
                        $title_3_16_1=$u->descripcion;            
                        $tipo_oferta_3_16_1=$u->descripcionoferta;
                        $detalle_3_16_1=$u->detalle;
                        if ($u->idperiodo==101){
                          $valores_3_16_1_76[]=$u->valor;
                          $dominio_3_16_1_76[]=$u->dominio;                      
                        }
                        else {
                          $valores_3_16_1[]=$u->valor;
                          $dominio_3_16_1[]=$u->dominio;
                        }
                    }               // 
                    $chart316_1 = Charts::multi('bar', 'highcharts')
                    ->title($title_3_16_1.'. <br>'. $tipo_oferta_3_16_1)
                    ->elementLabel('%')               
                    ->dimensions(600,300)  
                    ->loaderColor ('#FD7424')                 
                    ->colors(['#FD7424', '#00FFC5'])                 
                    ->dataset('RA 2022', $valores_3_16_1_76) 
                    ->dataset('RA 2023', $valores_3_16_1)                
                    ->labels($dominio_3_16_1);                
                  }
                  elseif ($i==9){
                   
                    $chart316_2=collect($data316)->where('descripcionoferta', '===', $data316[8]->descripcionoferta);  
                    
                    
                    foreach ($chart316_2 as $u)  {                               
                        $title_3_16_2=$u->descripcion;            
                        $tipo_oferta_3_16_2=$u->descripcionoferta;
                        $detalle_3_16_2=$u->detalle;
                        if ($u->idperiodo==101){
                          $valores_3_16_2_76[]=$u->valor;
                          $dominio_3_16_2_76[]=$u->dominio;                      
                        }
                        else {
                        $valores_3_16_2[]=$u->valor;
                        $dominio_3_16_2[]=$u->dominio;  
                        } 
                    }
                    $chart316_2 = Charts::multi('bar', 'highcharts')
                    ->title($title_3_16_2. '. <br>'. $tipo_oferta_3_16_2)
                    ->elementLabel('%')
                    ->dimensions(600,300)    
                    ->loaderColor ('#FD7424')               
                    ->colors(['#FD7424', '#00FFC5', '#0038FF', '#00FF05', '#1B9024', '#F000FF'])       
                    ->dataset('RA 2022', $valores_3_16_2_76)
                    ->dataset('RA 2023', $valores_3_16_2)
                    ->labels($dominio_3_16_2); 
                  }
                   elseif ($i==17){
                     $chart316_3=collect($data316)->where('descripcionoferta', '===', $data316[16]->descripcionoferta);            
                     foreach ($chart316_3 as $u)  {                               
                        $title_3_16_3=$u->descripcion;  
                        $tipo_oferta_3_16_3=$u->descripcionoferta;
                        $detalle_3_16_3=$u->detalle;
                        if ($u->idperiodo==101){
                          $valores_3_16_3_76[]=$u->valor;
                          $dominio_3_16_3_76[]=$u->dominio;                      
                        }
                        else {
                          $valores_3_16_3[]=$u->valor;
                          $dominio_3_16_3[]=$u->dominio;    
                        } 
                    }
                    $chart316_3 = Charts::multi('bar', 'highcharts')                
                    ->title($title_3_16_3. '. <br>'. $tipo_oferta_3_16_3)
                    ->elementLabel('%')
                    ->dimensions(600,300)    
                    ->loaderColor ('#FD7424')               
                    ->colors(['#FD7424', '#00FFC5', '#0038FF', '#00FF05', '#1B9024', '#F000FF'])                 
                    ->dataset('RA 2022', $valores_3_16_3_76)
                    ->dataset('RA 2023', $valores_3_16_3)
                    ->labels($dominio_3_16_3); 
                   }
                } // 3.16
    
                
              // 3.17
              for($i = 1;$i<=collect($data317)->count();$i++) {
                if ($i==1){ $chart317_1=collect($data317)->where('descripcionoferta', '===', $data317[0]->descripcionoferta);
                   foreach ($chart317_1 as $u)  {                               
                     $title_3_17_1=$u->descripcion;            
                       $tipo_oferta_3_17_1=$u->descripcionoferta;
                       $detalle_3_17_1=$u->detalle;
                       if ($u->idperiodo==101){
                         $valores_3_17_1_76[]=$u->valor;
                         $dominio_3_17_1_76[]=$u->dominio;                      
                       }
                       else {
                         $valores_3_17_1[]=$u->valor;
                         $dominio_3_17_1[]=$u->dominio;
                       }
                   }               // 
                   $chart317_1 = Charts::multi('bar', 'highcharts')
                   ->title($title_3_17_1. '. <br>'. $tipo_oferta_3_17_1)
                   ->elementLabel('%')               
                   ->dimensions(600,300) 
                   ->loaderColor ('#fdd043')                  
                   ->colors(['#fdd043', '#e2598b', '#aa5c9f', '#7f4782'])
                   ->dataset('RA 2022', $valores_3_17_1_76) 
                   ->dataset('RA 2023', $valores_3_17_1)                
                   ->labels($dominio_3_17_1);                              
                 }
                 elseif ($i==9){
                   $chart317_2=collect($data317)->where('descripcionoferta', '===', $data317[8]->descripcionoferta);          
                   foreach ($chart317_2 as $u)  {                               
                       $title_3_17_2=$u->descripcion;            
                       $tipo_oferta_3_17_2=$u->descripcionoferta;
                       $detalle_3_17_2=$u->detalle;
                       if ($u->idperiodo==101){
                         $valores_3_17_2_76[]=$u->valor;
                         $dominio_3_17_2_76[]=$u->dominio;                      
                       }
                       else {
                       $valores_3_17_2[]=$u->valor;
                       $dominio_3_17_2[]=$u->dominio;  
                       } 
                   }
                   $chart317_2 = Charts::multi('bar', 'highcharts')
                   ->title($title_3_17_2. '. <br>'. $tipo_oferta_3_17_2)
                   ->elementLabel('%')
                   ->dimensions(600,300)       
                   ->loaderColor ('#fdd043')            
                   ->colors(['#fdd043', '#e2598b', '#aa5c9f', '#7f4782'])       
                   ->dataset('RA 2022', $valores_3_17_2_76) 
                   ->dataset('RA 2023', $valores_3_17_2)                       
                   ->labels($dominio_3_17_2); 
                 }
                  elseif ($i==17){
                    $chart317_3=collect($data317)->where('descripcionoferta', '===', $data317[16]->descripcionoferta);            
                    foreach ($chart317_3 as $u)  {                               
                       $title_3_17_3=$u->descripcion;            
                       $tipo_oferta_3_17_3=$u->descripcionoferta;
                       $detalle_3_17_3=$u->detalle;
                     if ($u->idperiodo==101){
                        $valores_3_17_3_76[]=$u->valor;
                        $dominio_3_17_3_76[]=$u->dominio;                      
                      }
                      else {
                        $valores_3_17_3[]=$u->valor;
                        $dominio_3_17_3[]=$u->dominio;
                      } 
                  
                   }
                   $chart317_3 = Charts::multi('bar', 'highcharts')               
                   ->title($title_3_17_3. '. <br>'. $tipo_oferta_3_17_3)
                   ->elementLabel('%')
                   ->dimensions(600,300)   
                   ->loaderColor ('#fdd043')              
                   ->colors(['#fdd043', '#e2598b', '#aa5c9f', '#7f4782'])              
                   ->dataset('RA 2022', $valores_3_17_3_76) 
                   ->dataset('RA 2023', $valores_3_17_3)   
                   ->labels($dominio_3_17_3); 
                  }
               } // 3.17
    
        // 3.18
        for($i = 1;$i<=collect($data318)->count();$i++) {
          if ($i==1){ $chart318_1=collect($data318)->where('descripcionoferta', '===', $data318[0]->descripcionoferta);
            foreach ($chart318_1 as $u)  {                               
                $title_3_18_1=$u->descripcion;            
                $tipo_oferta_3_18_1=$u->descripcionoferta;
                $detalle_3_18_1=$u->detalle;
                if ($u->idperiodo==101){
                  $valores_3_18_1_76[]=$u->valor;
                  $dominio_3_18_1_76[]=$u->dominio;                      
                }
                else {
                  $valores_3_18_1[]=$u->valor;
                  $dominio_3_18_1[]=$u->dominio;
                }
            }               // 
            
         $chart318_1 = Charts::multi('bar', 'highcharts')
         ->title($title_3_18_1. '. <br>'. $tipo_oferta_3_18_1)
         ->elementLabel('%')            
         ->loaderColor ('#9764c7')
         ->dimensions(600,300)                 
         ->colors(['#9764c7', '#099a97'])
         ->dataset('RA 2022', $valores_3_18_1_76) 
         ->dataset('RA 2023', $valores_3_18_1)          
         ->labels($dominio_3_18_1);                              
       }
       elseif ($i==9){
         $chart318_2=collect($data318)->where('descripcionoferta', '===', $data318[8]->descripcionoferta);          
         foreach ($chart318_2 as $u)  {                               
             $title_3_18_2=$u->descripcion;            
             $tipo_oferta_3_18_2=$u->descripcionoferta;
             $detalle_3_18_2=$u->detalle;
             if ($u->idperiodo==101){
               $valores_3_18_2_76[]=$u->valor;
               $dominio_3_18_2_76[]=$u->dominio;                      
             }
             else {
             $valores_3_18_2[]=$u->valor;
             $dominio_3_18_2[]=$u->dominio;  
             } 
         }
         $chart318_2 = Charts::multi('bar', 'highcharts')
         ->title($title_3_18_2.'. <br>'. $tipo_oferta_3_18_2)
         ->elementLabel('%')
         ->dimensions(600,300)     
         ->loaderColor ('#9764c7')                  
         ->colors(['#9764c7', '#099a97'])   
         ->dataset('RA 2022', $valores_3_18_2_76) 
         ->dataset('RA 2023', $valores_3_18_2)                
         ->labels($dominio_3_18_2); 
       }
        elseif ($i==17){
          $chart318_3=collect($data318)->where('descripcionoferta', '===', $data318[16]->descripcionoferta);            
          foreach ($chart318_3 as $u)  {                               
           $title_3_18_3=$u->descripcion;            
             $tipo_oferta_3_18_3=$u->descripcionoferta;
             $detalle_3_18_3=$u->detalle;
             if ($u->idperiodo==101){
              $valores_3_18_3_76[]=$u->valor;
              $dominio_3_18_3_76[]=$u->dominio;                      
            }
            else {
              $valores_3_18_3[]=$u->valor;
              $dominio_3_18_3[]=$u->dominio;
            } 
         }
         $chart318_3 = Charts::multi('bar', 'highcharts')     
         ->title($title_3_18_3. '. <br>'. $tipo_oferta_3_18_3)
         ->elementLabel('%')
         ->dimensions(600,300)      
         ->loaderColor ('#9764c7')                   
         ->colors(['#9764c7', '#099a97'])           
         ->dataset('RA 2022', $valores_3_18_3_76) 
         ->dataset('RA 2023', $valores_3_18_3)    
         ->labels($dominio_3_18_3); 
        }
     } // 3.18
    
    // 3.20 
    for($i = 1;$i<=collect($data320)->count();$i++) {
      if ($i==1){ 
        $chart320_1=collect($data320)->where('descripcionoferta', '===', $data320[0]->descripcionoferta);    
         foreach ($chart320_1 as $u)  {                               
             $title_3_20_1=$u->descripcion;            
             $tipo_oferta_3_20_1=$u->descripcionoferta;
             $detalle_3_20_1=$u->detalle;         
             if ($u->idperiodo==101){
               $valores_3_20_1_76[]=$u->valor;
               $dominio_3_20_1_76[]=$u->dominio;
              }
              else {
                $valores_3_20_1[]=$u->valor;
                $dominio_3_20_1[]=$u->dominio;
              }    
             
         }               // 
         $chart320_1 = Charts::multi('bar', 'highcharts')
         ->title($title_3_20_1. '. <br>'. $tipo_oferta_3_20_1)
         ->elementLabel('%')               
         ->dimensions(600,300)  
         ->loaderColor ('#556fb5')                 
         ->colors(['#556fb5', '#e4508f', '#aeddcd'])     
         ->dataset('RA 2022', $valores_3_20_1_76)
         ->dataset('RA 2023', $valores_3_20_1)      
         ->labels($dominio_3_20_1);
       }
       elseif ($i==9){
        $chart320_2=collect($data320)->where('descripcionoferta', '===', $data320[8]->descripcionoferta);    
        foreach ($chart320_2 as $u)  {                               
            $title_3_20_2=$u->descripcion;            
            $tipo_oferta_3_20_2=$u->descripcionoferta;
            $detalle_3_20_2=$u->detalle;     
            if ($u->idperiodo==101){    
              $valores_3_20_2_76[]=$u->valor;
              $dominio_3_20_2_76[]=$u->dominio;
            }
              else {
                $valores_3_20_2[]=$u->valor;
                $dominio_3_20_2[]=$u->dominio;
              }     
        }               // 
        $chart320_2 = Charts::multi('bar', 'highcharts')
        ->title($title_3_20_2. '. <br>'. $tipo_oferta_3_20_2)
        ->elementLabel('%')               
        ->dimensions(600,300)  
        ->loaderColor ('#556fb5')                 
        ->colors(['#556fb5', '#e4508f', '#aeddcd'])        
        ->dataset('RA 2022', $valores_3_20_2_76)     
        ->dataset('RA 2023', $valores_3_20_2)       
        ->labels($dominio_3_20_2);    
       }
       elseif ($i==17){
        $chart320_3=collect($data320)->where('descripcionoferta', '===', $data320[16]->descripcionoferta);    
        foreach ($chart320_3 as $u)  {                               
            $title_3_20_3=$u->descripcion;            
            $tipo_oferta_3_20_3=$u->descripcionoferta;
            $detalle_3_20_3=$u->detalle;         
            if ($u->idperiodo==101){
              $valores_3_20_3_76[]=$u->valor;
              $dominio_3_20_3_76[]=$u->dominio;
            }
            else {
              $valores_3_20_3[]=$u->valor;
              $dominio_3_20_3[]=$u->dominio;
            }     
            
        }               // 
        $chart320_3 = Charts::multi('bar', 'highcharts')
        ->title($title_3_20_3. '. <br>'. $tipo_oferta_3_20_3)
        ->elementLabel('%')               
        ->dimensions(600,300)  
        ->loaderColor ('#556fb5')                 
         ->colors(['#556fb5', '#e4508f', '#aeddcd'])       
        ->dataset('RA 2022', $valores_3_20_3_76)     
        ->dataset('RA 2023', $valores_3_20_3)       
        ->labels($dominio_3_20_3);
      }
      }
    
    //3.21
    for($i = 1;$i<=collect($data321)->count();$i++) {
    if ($i==1){ 
      $chart321_1=collect($data321)->where('descripcionoferta', '===', $data321[0]->descripcionoferta);
       foreach ($chart321_1 as $u)  {                               
           $title_3_21_1=$u->descripcion;      
           $tipo_oferta_3_21_1=$u->descripcionoferta;    
           $detalle_3_21_1=$u->detalle;
           if ($u->idperiodo==102){          
             $valores_3_21_1_74[]=$u->valor;
             $dominio_3_21_1_74[]=$u->dominio;                      
           }
           else {         
             $valores_3_21_1[]=$u->valor;
             $dominio_3_21_1[]=$u->dominio;
           }
       }               // 
       $chart321_1 = Charts::multi('bar', 'highcharts')
       ->title($title_3_21_1. '. <br>'. $tipo_oferta_3_21_1)   
       ->elementLabel('%')               
       ->dimensions(600,300)  
       ->loaderColor ('#e4c666')                 
       ->colors(['#e4c666', '#247e6c'])
       ->dataset('Final 2022', $valores_3_21_1_74) 
       ->dataset('Final 2023', $valores_3_21_1)    
       ->labels($dominio_3_21_1);
     }
     elseif ($i==9){
       $chart321_2=collect($data321)->where('descripcionoferta', '===', $data321[8]->descripcionoferta);          
       foreach ($chart321_2 as $u)  {                               
           $title_3_21_2=$u->descripcion;            
           $tipo_oferta_3_21_2=$u->descripcionoferta;
           $detalle_3_21_2=$u->detalle;
           if ($u->idperiodo==102){
             $valores_3_21_2_74[]=$u->valor;
             $dominio_3_21_2_74[]=$u->dominio;                      
           }
           else {
           $valores_3_21_2[]=$u->valor;
           $dominio_3_21_2[]=$u->dominio;  
           } 
       }
       $chart321_2 = Charts::multi('bar', 'highcharts')
       ->title($title_3_21_2. '. <br>'. $tipo_oferta_3_21_2)   
       ->elementLabel('%')
       ->dimensions(600,300)    
       ->loaderColor ('#FD7424')               
       ->colors(['#e4c666', '#247e6c'])
       ->dataset('Final 2022', $valores_3_21_2_74) 
       ->dataset('Final 2023', $valores_3_21_2)      
       ->labels($dominio_3_21_2); 
     }
      elseif ($i==17){
        $chart321_3=collect($data321)->where('descripcionoferta', '===', $data321[16]->descripcionoferta);            
        foreach ($chart321_3 as $u)  {                               
           $title_3_21_3=$u->descripcion;            
           $tipo_oferta_3_21_3=$u->descripcionoferta;
           $detalle_3_21_3=$u->detalle;
          if ($u->idperiodo==102){
            $valores_3_21_3_74[]=$u->valor;
            $dominio_3_21_3_74[]=$u->dominio;                      
          }
          else {
           $valores_3_21_3[]=$u->valor;
           $dominio_3_21_3[]=$u->dominio;  
        }     
       }
       $chart321_3 = Charts::multi('bar', 'highcharts')       
        ->title($title_3_21_3. '. <br>'. $tipo_oferta_3_21_3)   
       ->elementLabel('%')
       ->dimensions(600,300)    
       ->loaderColor ('#FD7424')               
       ->colors(['#e4c666', '#247e6c'])
       ->dataset('Final 2022', $valores_3_21_3_74) 
       ->dataset('Final 2023', $valores_3_21_3)           
       ->labels($dominio_3_21_3); 
      }
    } //3.21
    
    
      //4.41
      for($i = 1;$i<=collect($data441)->count();$i++) {
        if ($i==1){ 
          $chart441_1=collect($data441)->where('descripcionoferta', '===', $data441[0]->descripcionoferta);
           foreach ($chart441_1 as $u)  {                               
               $title_4_41_1=$u->descripcion;            
               $tipo_oferta_4_41_1=$u->descripcionoferta;
               $detalle_4_41_1=$u->detalle;
               if ($u->idperiodo==101){
                 $valores_4_41_1_76[]=$u->valor;
                 $dominio_4_41_1_76[]=$u->dominio;                      
               }
               else {
                 $valores_4_41_1[]=$u->valor;
                 $dominio_4_41_1[]=$u->dominio;
               }
           }               // 
           $chart441_1 = Charts::multi('bar', 'highcharts')
           ->title($title_4_41_1. '. <br>'. $tipo_oferta_4_41_1)
           ->elementLabel('%')               
           ->dimensions(600,300)  
           ->loaderColor ('#6b7b8e')                 
           ->colors(['#6b7b8e', '#8fbbaf', '#acdeaa', '#d6f8b8'])
           ->dataset('RA 2022', $valores_4_41_1_76) 
           ->dataset('RA 2023', $valores_4_41_1)                
           ->labels($dominio_4_41_1);
         }
         elseif ($i==9){
           $chart441_2=collect($data441)->where('descripcionoferta', '===', $data441[8]->descripcionoferta);          
           foreach ($chart441_2 as $u)  {                               
               $title_4_41_2=$u->descripcion;            
               $tipo_oferta_4_41_2=$u->descripcionoferta;
               $detalle_4_41_2=$u->detalle;
               if ($u->idperiodo==101){
                 $valores_4_41_2_76[]=$u->valor;
                 $dominio_4_41_2_76[]=$u->dominio;                      
               }
               else {
               $valores_4_41_2[]=$u->valor;
               $dominio_4_41_2[]=$u->dominio;  
               } 
           }
           $chart441_2 = Charts::multi('bar', 'highcharts')
           ->title($title_4_41_2. '. <br>'. $tipo_oferta_4_41_2)
           ->elementLabel('%')
           ->dimensions(600,300)    
           ->loaderColor ('#6b7b8e')                 
           ->colors(['#6b7b8e', '#8fbbaf', '#acdeaa', '#d6f8b8'])
           ->dataset('RA 2022', $valores_4_41_2_76)
           ->dataset('RA 2023', $valores_4_41_2)
           ->labels($dominio_4_41_2); 
         }
          elseif ($i==17){
            $chart441_3=collect($data441)->where('descripcionoferta', '===', $data441[16]->descripcionoferta);            
            foreach ($chart441_3 as $u)  {                               
             $title_4_41_3=$u->descripcion;            
               $tipo_oferta_4_41_3=$u->descripcionoferta;
               $detalle_4_41_3=$u->detalle;
               if ($u->idperiodo==101){
                $valores_4_41_3_76[]=$u->valor;
                $dominio_4_41_3_76[]=$u->dominio;                      
              }
              else {
               $valores_4_41_3[]=$u->valor;
               $dominio_4_41_3[]=$u->dominio;  
            }     
           }
           $chart441_3 = Charts::multi('bar', 'highcharts')       
           ->title($title_4_41_3. '. <br>'. $tipo_oferta_4_41_3)
           ->elementLabel('%')
           ->dimensions(600,300)    
           ->loaderColor ('#6b7b8e')                 
           ->colors(['#6b7b8e', '#8fbbaf', '#acdeaa', '#d6f8b8'])        
            ->dataset('RA 2022', $valores_4_41_3_76)
            ->dataset('RA 2023', $valores_4_41_3)
           ->labels($dominio_4_41_3); 
          }
       } //4.41
     
            return view('fichaestadistica',compact(
              (isset($chart316_1)) ? 'chart316_1' : 'i',
              (isset($chart316_2 )) ? 'chart316_2' : 'i',
              (isset($chart316_3 )) ? 'chart316_3' : 'i',
    
              (isset($chart317_1 )) ? 'chart317_1' : 'i',
              (isset($chart317_2 )) ? 'chart317_2' : 'i',
              (isset($chart317_3 )) ? 'chart317_3' : 'i',
    
              (isset($chart318_1 )) ? 'chart318_1' : 'i',
              (isset($chart318_2 )) ? 'chart318_2' : 'i',
              (isset($chart318_3 )) ? 'chart318_3' : 'i',
    
              (isset($chart441_1 )) ? 'chart441_1' : 'i',
              (isset($chart441_2 )) ? 'chart441_2' : 'i',
              (isset($chart441_3 )) ? 'chart441_3' : 'i',
    
              (isset($chart320_1 )) ? 'chart320_1' : 'i',
              (isset($chart320_2 )) ? 'chart320_2' : 'i',
              (isset($chart320_3 )) ? 'chart320_3' : 'i',
    
              (isset($chart321_1 )) ? 'chart321_1' : 'i',
              (isset($chart321_2 )) ? 'chart321_2' : 'i',
              (isset($chart321_3 )) ? 'chart321_3' : 'i',
    
              (isset($detalle_3_16_1 )) ? 'detalle_3_16_1' : 'i',
              (isset($detalle_3_16_2 )) ? 'detalle_3_16_2' : 'i',
              (isset($detalle_3_16_3 )) ? 'detalle_3_16_3' : 'i',
    
              (isset($detalle_3_17_1 )) ? 'detalle_3_17_1' : 'i',
              (isset($detalle_3_17_2 )) ? 'detalle_3_17_2' : 'i',
              (isset($detalle_3_17_3 )) ? 'detalle_3_17_3' : 'i',
    
              (isset($detalle_3_18_1 )) ? 'detalle_3_18_1' : 'i',
              (isset($detalle_3_18_2 )) ? 'detalle_3_18_2' : 'i',
              (isset($detalle_3_18_3 )) ? 'detalle_3_18_3' : 'i',
    
              (isset($detalle_4_41_1 )) ? 'detalle_4_41_1' : 'i',
              (isset($detalle_4_41_2 )) ? 'detalle_4_41_2' : 'i',
              (isset($detalle_4_41_3 )) ? 'detalle_4_41_3' : 'i',
    
              (isset($detalle_3_20_1 )) ? 'detalle_3_20_1' : 'i',
              (isset($detalle_3_20_2 )) ? 'detalle_3_20_2' : 'i',
              (isset($detalle_3_20_3 )) ? 'detalle_3_20_3' : 'i',
    
              (isset($detalle_3_21_1 )) ? 'detalle_3_21_1' : 'i',
              (isset($detalle_3_21_2 )) ? 'detalle_3_21_2' : 'i',
              (isset($detalle_3_21_3 )) ? 'detalle_3_21_3' : 'i',
    
              'formulario', 'id_localizacion_periodo'       
            ));
    }
    

public function estadistica($idperiodo, $excel = false) {
  $periodo=Periodos::select('periodos.*')->where('id_periodo',$idperiodo)->first(); 

  if (Auth::user()->hasRole('admin') or (Auth::user()->hasRole('supervisor') or Auth::user()->hasRole('editor') or
      Auth::user()->hasRole('solo_lectura')))
  {
     $filter_user=''; // no aplicamos filtro
     $param=['idperiodo' => $periodo->id_periodo ] ;
  }
  else
  { // cargo el filtro del usuario donde filtramos las localizaciones que puede ver 
    $filter_user=' inner join usuario_localizacion_assn u on u.id_localizacion=lp.id_localizacion and u.id_usuario=:id_usuario ';
    $param=['idperiodo' => $periodo->id_periodo, 'id_usuario' => Auth::user()->id ];
  }
$data = DB::select("select 'Total'::text as formulario,
     sum(1) as Total,
     sum( case when  (c_estado_formulario is null or c_estado_formulario between 70 and 79) then 1 else 0 end) as vacio,
     sum( case when (c_estado_formulario between  0 and 9 or c_estado_formulario = 110) then 1 else 0 end) as con_error_de_padron,
     sum( case when  c_estado_formulario between 10 and 29 then 1 else 0 end) as en_carga_con_error,
     sum( case when  c_estado_formulario between 30 and 69 then 1 else 0 end) as en_carga,
     sum( case when  c_estado_formulario between 80 and 99 then 1 else 0 end) as completo,
     sum( case when  c_estado_formulario = 100 then 1 else 0 end) as confirmado,0 as orden
from localizaciones_periodo lp ".$filter_user."-- le agrego el filtro del usuario
     inner join def_formulario_organizacion dfo using(c_organizacion)
     inner join definicion_formulario df on df.id_definicion_formulario=dfo.id_definicion_formulario and df.id_periodo=lp.id_periodo 
     left join datos_formulario ef on ef.id_localizacion_periodo=lp.id_localizacion_periodo
where lp.id_periodo=:idperiodo

union
   (select  nombre_corto,
           sum(1) as Total,
           sum( case when  (c_estado_formulario is null or c_estado_formulario between 70 and 79) then 1 else 0 end) as vacio,
           sum( case when (c_estado_formulario between  0 and 9 or c_estado_formulario = 110) then 1 else 0 end) as con_error_de_padron,
           sum( case when  c_estado_formulario between 10 and 29 then 1 else 0 end) as en_carga_con_error,
           sum( case when  c_estado_formulario between 30 and 69 then 1 else 0 end) as en_carga,
           sum( case when  c_estado_formulario between 80 and 99 then 1 else 0 end) as completo,
           sum( case when  c_estado_formulario = 100 then 1 else 0 end) as confirmado, row_number() over (order by nombre_corto) orden
      from localizaciones_periodo lp ".$filter_user."--le agrego el filtro del usuario
           inner join def_formulario_organizacion dfo using(c_organizacion)
           inner join definicion_formulario df on df.id_definicion_formulario=dfo.id_definicion_formulario and df.id_periodo=lp.id_periodo 
           left join datos_formulario ef on ef.id_localizacion_periodo=lp.id_localizacion_periodo
      where lp.id_periodo=:idperiodo 
      group by nombre_corto order by nombre_corto
     )
order by orden", $param );
       
 foreach ($data as $u)  {
  if ($u->formulario!='Total'){ 
   $formulario[]=$u->formulario;  
  }
 }

$data_chart=collect($data);
$data_chart = array_except($data_chart, [0]);

$chart = Charts::multi('bar', 'chartjs')
      ->title('Estado de carga')
      ->dimensions(1000,600)
        ->template("material")
         ->colors(['#FE2424', '#FD7424', '#FDE124', '#00FFC5', '#0038FF', '#00FF05', '#1B9024', '#F000FF'])
        // ->dataset('Total', [$data->pluck('total')])
        ->dataset('Vacios', $data_chart->pluck('vacio'))
        ->dataset('Con error de padron', $data_chart->pluck('con_error_de_padron'))
         ->dataset('En carga con error', $data_chart->pluck('en_carga_con_error'))
         ->dataset('En carga', $data_chart->pluck('en_carga'))
         ->dataset('Completos', $data_chart->pluck('completo'))
         ->dataset('Confirmados', $data_chart->pluck('confirmado'))
        ->labels($formulario);				



$distrito=DB::select("select  null::smallint as  region, '  ':: text as codigo_distrito, 'Total'::character varying(40) as nombre,
 sum(1) as Total,                              
 sum( case when  c_estado_formulario between 80 and 100 then 1 else 0 end) as cargados,
 round(sum( case when  c_estado_formulario between 80 and 100 then 1 else 0 end)::numeric   / sum(1)::numeric * 100,2) as porcentaje_cargados,
 sum(case when ('0.1.2' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end) as estatal_total,
 sum( case when ('0.1.2' like '%'||substring(codigo_jurisdiccional,1,1)||'%') and (c_estado_formulario between 80 and 100)  then 1 else 0 end) as estatal_cargados,
case when sum(case when ('0.1.2' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end)<>0
  then ( round(sum( case when ('0.1.2' like '%'||substring(codigo_jurisdiccional,1,1)||'%') and ( c_estado_formulario between 80 and 100) then 1 else 0 end) :: numeric / sum(case when ('0.1.2' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end)::numeric * 100,2))
  else 0 end as estatal_porcentaje_cargados,
 sum(case when ('3.4' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end) as dipregep_total,                              
 sum( case when ('3.4' like '%'||substring(codigo_jurisdiccional,1,1)||'%') and (c_estado_formulario between 80 and 100)  then 1 else 0 end) as dipregep_cargados,
case when sum(case when ('3.4' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end)<>0
  then ( round(sum( case when ('3.4' like '%'||substring(codigo_jurisdiccional,1,1)||'%') and ( c_estado_formulario between 80 and 100) then 1 else 0 end) :: numeric / sum(case when ('3.4' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end)::numeric * 100,2))
  else 0 end as dipregep_porcentaje_cargados,
'':: text as st_asgeojson,
0 as orden						        
from localizaciones_periodo lp
     ".$filter_user."-- le agrego el filtro del usuario
     inner join def_formulario_organizacion dfo using(c_organizacion)
     inner join definicion_formulario df on df.id_definicion_formulario=dfo.id_definicion_formulario and df.id_periodo=lp.id_periodo 
     left join datos_formulario ef using (id_localizacion_periodo)
     join partidos pa on pa.c_departamento=lp.c_departamento --substring (codigo_jurisdiccional,2,3)=codigo_distrito
where  lp.id_periodo=:idperiodo and pa.islas=0

union

(select  id_region_educativa región, substring (codigo_jurisdiccional,2,3) as codigo_distrito, pa.nombre , 									
  sum(1) as Total,                              
  sum( case when c_estado_formulario between 80 and 100 then 1 else 0 end) as cargados,
  round(sum( case when  c_estado_formulario between 80 and 100 then 1 else 0 end)::numeric / sum(1)::numeric * 100,2) as porcentaje_cargados,
  sum( case when ('0.1.2' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end) as estatal_total,                              
  sum( case when ('0.1.2' like '%'||substring(codigo_jurisdiccional,1,1)||'%') and (c_estado_formulario between 80 and 100)  then 1 else 0 end) as estatal_cargados,
  case when sum(case when ('0.1.2' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end)<>0
    then ( round(sum( case when ('0.1.2' like '%'||substring(codigo_jurisdiccional,1,1)||'%') and ( c_estado_formulario between 80 and 100) then 1 else 0 end) :: numeric / sum(case when ('0.1.2' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end)::numeric * 100,2))
    else 0 end as estatal_porcentaje_cargados,
  sum(case when ('3.4' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end) as dipregep_total,                              
  sum( case when ('3.4' like '%'||substring(codigo_jurisdiccional,1,1)||'%') and (c_estado_formulario between 80 and 100)  then 1 else 0 end) as dipregep_cargados,
  case when sum(case when ('3.4' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end)<>0
          then ( round(sum( case when ('3.4' like '%'||substring(codigo_jurisdiccional,1,1)||'%') and ( c_estado_formulario between 80 and 100) then 1 else 0 end) :: numeric / sum(case when ('3.4' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end)::numeric * 100,2))
      else 0 end as dipregep_porcentaje_cargados,		
  ST_AsGeoJSON(geom),
     pa.orden_conurbano as orden									
from localizaciones_periodo lp
     ".$filter_user."--le agrego el filtro del usuario
     inner join def_formulario_organizacion dfo using(c_organizacion)
     inner join definicion_formulario df on df.id_definicion_formulario=dfo.id_definicion_formulario and df.id_periodo=lp.id_periodo 
  left join datos_formulario ef using (id_localizacion_periodo)
  join partidos pa on pa.c_departamento=lp.c_departamento --substring (codigo_jurisdiccional,2,3)=codigo_distrito
where  lp.id_periodo=:idperiodo and pa.islas=0
group by 1,2 , pa.nombre, pa.geom,pa.orden_conurbano		
)
order by orden", $param );

$region=DB::select("select 'Total' :: character varying (10) as region,									
 sum(1) as Total,                              
 sum( case when  c_estado_formulario between 80 and 100 then 1 else 0 end) as cargados,
 round(sum( case when  c_estado_formulario between 80 and 100 then 1 else 0 end)::numeric   / sum(1)::numeric * 100,2) as porcentaje_cargados,
 sum(case when ('0.1.2' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end) as estatal_total,                              
 sum( case when ('0.1.2' like '%'||substring(codigo_jurisdiccional,1,1)||'%') and (c_estado_formulario between 80 and 100)  then 1 else 0 end) as estatal_cargados,
case when sum(case when ('0.1.2' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end)<>0
  then ( round(sum( case when ('0.1.2' like '%'||substring(codigo_jurisdiccional,1,1)||'%') and ( c_estado_formulario between 80 and 100) then 1 else 0 end) :: numeric / sum(case when ('0.1.2' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end)::numeric * 100,2))
  else 0 end as estatal_porcentaje_cargados,
 sum(case when ('3.4' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end) as dipregep_total,                              
 sum( case when ('3.4' like '%'||substring(codigo_jurisdiccional,1,1)||'%') and (c_estado_formulario between 80 and 100)  then 1 else 0 end) as dipregep_cargados,
case when sum(case when ('3.4' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end)<>0
  then ( round(sum( case when ('3.4' like '%'||substring(codigo_jurisdiccional,1,1)||'%') and ( c_estado_formulario between 80 and 100) then 1 else 0 end) :: numeric / sum(case when ('3.4' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end)::numeric * 100,2))
  else 0 end as dipregep_porcentaje_cargados,
''::text ST_AsGeoJSON,
0 as orden									
from localizaciones_periodo lp ".$filter_user."--le agrego el filtro del usuario
inner join def_formulario_organizacion dfo using(c_organizacion)
inner join definicion_formulario df on df.id_definicion_formulario=dfo.id_definicion_formulario and df.id_periodo=lp.id_periodo
left join datos_formulario ef using (id_localizacion_periodo)
join partidos pa on pa.c_departamento=lp.c_departamento 
join regiones r on r.id_region_educativa=pa.id_region_educativa
where  lp.id_periodo=:idperiodo

union
 (select  r.id_region_educativa::character varying (10) region ,					
    sum(1) as Total,                              
    sum( case when  c_estado_formulario between 80 and 100 then 1 else 0 end) as cargados,
    round(sum( case when  c_estado_formulario between 80 and 100 then 1 else 0 end)::numeric   / sum(1)::numeric * 100,2) as porcentaje_cargados,
    sum(case when ('0.1.2' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end) as estatal_total,                              
    sum( case when ('0.1.2' like '%'||substring(codigo_jurisdiccional,1,1)||'%') and (c_estado_formulario between 80 and 100)  then 1 else 0 end) as estatal_cargados,
    case when sum(case when ('0.1.2' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end)<>0
      then ( round(sum( case when ('0.1.2' like '%'||substring(codigo_jurisdiccional,1,1)||'%') and ( c_estado_formulario between 80 and 100) then 1 else 0 end) :: numeric / sum(case when ('0.1.2' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end)::numeric * 100,2))
      else 0 end as estatal_porcentaje_cargados,
    sum(case when ('3.4' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end) as dipregep_total,                              
    sum( case when ('3.4' like '%'||substring(codigo_jurisdiccional,1,1)||'%') and (c_estado_formulario between 80 and 100)  then 1 else 0 end) as dipregep_cargados,
    case when sum(case when ('3.4' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end)<>0
      then ( round(sum( case when ('3.4' like '%'||substring(codigo_jurisdiccional,1,1)||'%') and ( c_estado_formulario between 80 and 100) then 1 else 0 end) :: numeric / sum(case when ('3.4' like '%'||substring(codigo_jurisdiccional,1,1)||'%') then 1 else 0 end)::numeric * 100,2))
      else 0 end as dipregep_porcentaje_cargados,
    ST_AsGeoJSON(r.geom), 
    r.id_region_educativa as orden

   from localizaciones_periodo lp
      ".$filter_user."--le agrego el filtro del usuario
      inner join def_formulario_organizacion dfo using(c_organizacion)
      inner join definicion_formulario df on df.id_definicion_formulario=dfo.id_definicion_formulario and df.id_periodo=lp.id_periodo 
      left join datos_formulario ef using (id_localizacion_periodo)
      join partidos pa on pa.c_departamento=lp.c_departamento 
      join regiones r on r.id_region_educativa=pa.id_region_educativa
   where  lp.id_periodo=:idperiodo
   group by 1, r.geom,r.id_region_educativa		
)
order by orden", $param );

       $center_pol=null;    

       if (Auth::user()->level() ==5 || Auth::user()->level() == 7)  {
        foreach ($region as $u)  {
          if ($u->region!='Total'){                 
           $region_pol=$u->region; 
             $center_pol=DB::select("select id_region_educativa, ST_Y(ST_CENTROID(geom)) AS latitud,  ST_X(ST_CENTROID(geom)) AS longitud from regiones where id_region_educativa=:region_pol", 
        ['region_pol'=>$u->region]);

          }   
         }  
          
        }


   $statesData_2="";       
      foreach ($distrito as $key => $value) {
        if ($value->nombre!='Total') {
            $statesData_2=$statesData_2."{ 'type': 'Feature', 'properties': { 'nombre': '".$value->nombre."', 'cod_distrito': '".$value->codigo_distrito."', 'total':'".$value->total."', 'cargados':'".$value->cargados."', 'porcentaje_cargados':'".$value->porcentaje_cargados."' }, 'geometry': ".$value->st_asgeojson."},";
        }
      }
      $statesData="{'type': 'FeatureCollection', 'crs': {'type':'name', 'properties': { 'name': 'urn:ogc:def:crs:OGC:1.3:CRS84' } },'features': [".$statesData_2."]}";        
      
      //  regiones
      $geojson_2="";       
      foreach ($region as $key => $value) {
        if ($value->region!='Total') {
            $geojson_2=$geojson_2."{ 'type': 'Feature', 'properties': { 'region': '".$value->region."', 'total':'".$value->total."', 'cargados':'".$value->cargados."', 'porcentaje_cargados':'".$value->porcentaje_cargados."' }, 'geometry': ".$value->st_asgeojson."},";
        }
      }
      $geojson_region="{'type': 'FeatureCollection', 'crs': {'type':'name', 'properties': { 'name': 'urn:ogc:def:crs:OGC:1.3:CRS84' } },'features': [".$geojson_2."]}";     
      if( !$excel) {            
          return view('estadistica', compact('data', 'periodo', 'statesData', 'distrito', 'region', 'geojson_region', 
            'center_pol'), ['chart' => $chart]); 
        }
      else {
      return (new EstadisticaExport($param, $filter_user))->download('Estadistica de carga.xlsx');
      return back();

        // $filename   = "Estadistica de carga-".date('d-m-Y').'_'.time()  ;
      
      
        // Excel::create($filename, function($excel) use ($data, $periodo, $distrito, $region) {
        //       $excel->sheet('Estado de carga', function($sheet)  use ($data, $periodo){
        //           $sheet->loadView('estadisticaexcel', compact(array('data'), array('periodo')));                 
        //       });

        //       $excel->sheet('Totales x Distrito', function($sheet)  use ($periodo, $distrito){
        //           $sheet->loadView('formularioexceldistrito', compact( array('periodo'), array('distrito')));                 
        //       });   
        //      $excel->sheet('Totales x Región', function($sheet)  use ($periodo, $region){
        //           $sheet->loadView('formularioexcelregion', compact( array('periodo'), array('region')));                 
        //       });   


        //   })->export('xlsx');;         
        //   return back();
      }     
}

public function mailing(Request $request, $p){

  switch($request->submitbutton) {
    case 'filter-true': 
      $request->session()->put('filter', [
        'filter_name' =>      ($request->get('nombre') !== null ) ? $request->get('nombre') : '', 
        'filter_cue' =>       ($request->get('cueanexo') !== null ) ? $request->get('cueanexo') : '',
        'filter_clave'=>      ($request->get('codigo_jurisdiccional') !== null ) ? $request->get('codigo_jurisdiccional') : '',
        'filter_estado'=>     ($request->get('estado_formulario') !== null ) ? $request->get('estado_formulario') : '',
        'filter_distrito'=>   ($request->get('distrito') !== null ) ? $request->get('distrito') : '',
        'filter_rama'=>       ($request->get('rama') !== null ) ? $request->get('rama') : '',
        'filter_supervicion'=>($request->get('supervicion') !== null ) ? $request->get('supervicion') : '',
        'filter_region_educativa'=>($request->get('region_educativa') !== null ) ? $request->get('region_educativa') : '',
        'filter_aplicado'=>true
    ]);       
    break;
    case 'filter-false': 
      $request->session()->put('filter', [
        'filter_name' => '',
        'filter_cue' => '',
        'filter_clave'=> '',
        'filter_rama'=> '',
        'filter_estado'=> '',          
        'filter_distrito'=> '',
        'filter_supervicion'=>'',
        'filter_region_educativa'=>'',
        'filter_aplicado'=>false
    ]);            
    break;
   }
  
  $filtro = $request->session()->get('filter');
  $periodo=Periodos::select('periodos.*')->where('id_periodo',$p)->first();

  $datos_localizacion=localizaciones_periodo::      
  join ('def_formulario_organizacion as dfo', 'dfo.c_organizacion','=','localizaciones_periodo.c_organizacion')      
  ->join ('definicion_formulario as df', function ($Join) use ($p)
  { $Join->on ('df.id_definicion_formulario','=','dfo.id_definicion_formulario')->whereRaw ('"df"."id_periodo" = '. $p); } )
   ->leftjoin('datos_formulario','datos_formulario.id_localizacion_periodo','=', 'localizaciones_periodo.id_localizacion_periodo')
   ->leftjoin('partidos', 'partidos.c_departamento','=','localizaciones_periodo.c_departamento')
   ->leftjoin('estado_formulario_tipo', 'estado_formulario_tipo.c_estado_formulario','=','datos_formulario.c_estado_formulario')    
   ->leftjoin('datos_localizacion_periodo', 'datos_localizacion_periodo.id_localizacion_periodo','=','localizaciones_periodo.id_localizacion_periodo')

   ->select('localizaciones_periodo.id_localizacion_periodo','localizaciones_periodo.departamento',
      'localizaciones_periodo.id_localizacion',
      'localizaciones_periodo.nombre','localizaciones_periodo.cueanexo', 'localizaciones_periodo.id_serv',
      'localizaciones_periodo.codigo_jurisdiccional', 'df.nombre_corto',
      'datos_formulario.c_estado_formulario', 'estado_formulario_tipo.descripcion', 'datos_localizacion_periodo.responsable',
      'datos_localizacion_periodo.email', 'datos_localizacion_periodo.email_resp', 'datos_localizacion_periodo.updated_at as fecha',
      'datos_localizacion_periodo.fecha_envio_mail as fecha_envio_mail')    
    ->where ('localizaciones_periodo.id_periodo','=', $p)
    ->whereNotNull('responsable') 
    ->orderBy('datos_formulario.c_estado_formulario', 'asc')
    ->Supervicion( $filtro['filter_supervicion'])
    ->Name($filtro['filter_name'])
    ->Cueanexo( $filtro['filter_cue'])
    ->Codigo_jurisdiccional( $filtro['filter_clave'])
    ->Estado_formulario( $filtro['filter_estado'])
    ->Departamento( $filtro['filter_distrito'])
    ->Region( $filtro['filter_region_educativa'] )
    ->Rama( $filtro['filter_rama'])
    ->Paginate(10)->onEachSide(5);     
  
      $supervicion=['Oficial','Diegep'];     
      $estado_formulario=Estado_formulario_tipo::orderBy('orden')->select('c_estado_formulario','descripcion','orden')->get();
      $regiones=regiones::orderBy( 'id_region_educativa')->select( 'id_region_educativa', 'nombre')->get();  
      if ($filtro['filter_region_educativa'] !=''){
        $partidos=Partidos::orderBy('nombre')->select('c_departamento','nombre')
        ->where( 'id_region_educativa', '=', $filtro['filter_region_educativa'] )
        ->where('codigo_distrito', '<' ,'900')->get(); }
      else {
          $partidos=Partidos::orderBy('nombre')->select('c_departamento','nombre')->where('codigo_distrito', '<' ,'900')->get(); 
      }
    // dd($filtro['filter_region_educativa']) ; 
      
     
      $definicion_formulario=Definicion_formulario::orderBy('id_definicion_formulario')->select('nombre_corto')
      ->where('id_periodo','=', $periodo->id_periodo)->get();    
    return view('mailing', compact('datos_localizacion', 'periodo', 'estado_formulario', 'periodo', 'filtro', 'definicion_formulario',
     'regiones', 'partidos', 'supervicion'));
           
}

public function mail_personalizado(Request $request,  $codigo_jurisdiccional = null, $p) {
  
  switch($request->submitbutton) {
    case 'filter-true': 
      $request->session()->put('filter', [
        'filter_name' =>          ($request->get('nombre') !== null ) ? $request->get('nombre') : '',
        'filter_cue' =>           ($request->get('cueanexo') !== null ) ? $request->get('cueanexo') : '',
        'filter_clave'=>          ($request->get('codigo_jurisdiccional') !== null ) ? $request->get('codigo_jurisdiccional') : '',
        'filter_estado'=>         ($request->get('estado_formulario') !== null ) ? $request->get('estado_formulario') : '',
        'filter_distrito'=>       ($request->get('distrito') !== null ) ? $request->get('distrito') : '', 
        'filter_rama'=>           ($request->get('rama') !== null ) ? $request->get('rama') : '', 
        'filter_supervicion'=>    ($request->get('supervicion') !== null ) ? $request->get('supervicion') : '',
        'filter_region_educativa'=>($request->get('region_educativa') !== null ) ? $request->get('region_educativa') : '',
        'filter_aplicado'=>true
    ]);       
    break;
    case 'filter-false': 
      $request->session()->put('filter', [
        'filter_name' => '',
        'filter_cue' => '',
        'filter_clave'=> '',
        'filter_rama'=> '',
        'filter_estado'=> '',          
        'filter_distrito'=> '',
        'filter_supervicion'=>'',
        'filter_region_educativa'=>'',
        'filter_aplicado'=>false
    ]);            
    break;
   }

  $filtro = $request->session()->get('filter');  

  $periodo=Periodos::select('periodos.*')->where('id_periodo',$p)->first();
  $errorfind=$this->datos_para_mail($codigo_jurisdiccional, $p);
  $receivers=$request->get('Para');
  $moreUsers=$request->get('CC');
  $texto=$request->get('texto');
  if ($moreUsers){ Mail::to($receivers)->cc($moreUsers)->send(new RelevamientoDIE($texto));}
  else {  Mail::to($receivers)->send(new RelevamientoDIE($texto));}
  
  toastr()->info('Email enviado correctamente.');
  return back();
}

public function enviodemail(Request $request, $p, $codigo_jurisdiccional = null)  { 
  // Mail::to('josemlescano@gmail.com')->send(new FormularioIncompleto ('Prueba'));        
  // dd('envío ok');

     switch($request->submitbutton) {
      case 'filter-true': 
        $request->session()->put('filter', [
          'filter_name' =>      ($request->get('nombre') !== null ) ? $request->get('nombre') : '',
          'filter_cue' =>       ($request->get('cueanexo') !== null ) ? $request->get('cueanexo') : '',
          'filter_clave'=>      ($request->get('codigo_jurisdiccional') !== null ) ? $request->get('codigo_jurisdiccional') : '',
          'filter_estado'=>     ($request->get('estado_formulario') !== null ) ? $request->get('estado_formulario') : '',
          'filter_distrito'=>   ($request->get('distrito') !== null ) ? $request->get('distrito') : '',
          'filter_rama'=>       ($request->get('rama') !== null ) ? $request->get('rama') : '',
          'filter_supervicion'=>($request->get('supervicion') !== null ) ? $request->get('supervicion') : '',
          'filter_region_educativa'=>($request->get('region_educativa') !== null ) ? $request->get('region_educativa') : '',
          'filter_aplicado'=>true
      ]);       
      break;
      case 'filter-false': 
        $request->session()->put('filter', [
          'filter_name' => '',
          'filter_cue' => '',
          'filter_clave'=> '',
          'filter_rama'=> '',
          'filter_estado'=> '',          
          'filter_distrito'=> '',
          'filter_supervicion'=>'',
          'filter_region_educativa'=>'',
          'filter_aplicado'=>false
      ]);            
      break;
     }
     $filtro = $request->session()->get('filter');  
    
    $periodo=Periodos::select('periodos.*')->where('id_periodo',$p)->first(); 
   
  if ($codigo_jurisdiccional == null) {   
       $errorfind=localizaciones_periodo::      
     join ('def_formulario_organizacion as dfo', 'dfo.c_organizacion','=','localizaciones_periodo.c_organizacion')      
    ->join ('definicion_formulario as df', function ($Join) use ($p)
     { $Join->on ('df.id_definicion_formulario','=','dfo.id_definicion_formulario')->whereRaw ('"df"."id_periodo" = '. $p); } )
    ->leftjoin('datos_formulario','datos_formulario.id_localizacion_periodo','=', 'localizaciones_periodo.id_localizacion_periodo')
     ->leftjoin('estado_formulario_tipo', 'estado_formulario_tipo.c_estado_formulario','=','datos_formulario.c_estado_formulario')
    ->leftjoin('datos_localizacion_periodo', 'datos_localizacion_periodo.id_localizacion_periodo','=','localizaciones_periodo.id_localizacion_periodo')
     ->select('localizaciones_periodo.id_localizacion_periodo','localizaciones_periodo.departamento',
      'localizaciones_periodo.id_localizacion',
      'localizaciones_periodo.nombre','localizaciones_periodo.cueanexo', 'localizaciones_periodo.id_serv',
      'localizaciones_periodo.codigo_jurisdiccional', 'df.nombre as nombre_formulario', 'df.nombre_corto',
      'datos_formulario.c_estado_formulario', 'estado_formulario_tipo.descripcion', 'datos_localizacion_periodo.responsable',
      'datos_localizacion_periodo.email', 'datos_localizacion_periodo.email_resp', 'datos_localizacion_periodo.updated_at',
      'df.color',  'datos_localizacion_periodo.fecha_envio_mail')
    ->where ('localizaciones_periodo.id_periodo','=', $periodo->id_periodo)    
    ->whereNotNull('responsable') 
    ->Supervicion( $filtro['filter_supervicion'])
    ->Name($filtro['filter_name'])
    ->Cueanexo( $filtro['filter_cue'])
    ->Codigo_jurisdiccional( $filtro['filter_clave'])
    ->Estado_formulario( $filtro['filter_estado'])
    ->Departamento( $filtro['filter_distrito'])
    ->Rama( $filtro['filter_rama'])->get();
    
    foreach ($errorfind as $key => $value) { 
     if  (date("d-m-Y") != $value->updated_at->format('d-m-Y') and (Carbon::now() > Carbon::parse($value->fecha_envio_mail)->addDays(7) )
      or $value->fecha_envio_mail== null) {
    
        $receivers[] = $value->email_resp;
        if (($value->email_resp <> $value->email) and ($value->email1="")){ $receivers[] = $value->email; }

        if ($value->descripcion== 'Completo' OR $value->descripcion=='Completo con advertencias') {
          $completo=$errorfind->where( 'codigo_jurisdiccional', $value->codigo_jurisdiccional)->first();                            
          Mail::to($receivers)->send(new FormularioCompleto($completo, $periodo));
        }
        if ($value->descripcion=='En carga' OR  $value->descripcion=='En carga con advertencias' OR
           $value->descripcion=='En carga con errores' OR $value->descripcion=='Vacio') {
          $incompleto=$errorfind->where( 'codigo_jurisdiccional', $value->codigo_jurisdiccional)->first();           
          Mail::to($receivers)->send(new FormularioIncompleto($incompleto, $periodo));
        }
        
        $DL = Datos_localizacion_periodo::Where('id_localizacion_periodo',$value->id_localizacion_periodo )
        ->update(['fecha_envio_mail'=> date('d-m-Y') ]);       
        $receivers=[];
       } // fecha
    }

  }
else {
  $errorfind=localizaciones_periodo::      
  join ('def_formulario_organizacion as dfo', 'dfo.c_organizacion','=','localizaciones_periodo.c_organizacion')      
 ->join ('definicion_formulario as df', function ($Join) use ($p)
  { $Join->on ('df.id_definicion_formulario','=','dfo.id_definicion_formulario')->whereRaw ('"df"."id_periodo" = '. $p); } )
 ->leftjoin('datos_formulario','datos_formulario.id_localizacion_periodo','=', 'localizaciones_periodo.id_localizacion_periodo')
  ->leftjoin('estado_formulario_tipo', 'estado_formulario_tipo.c_estado_formulario','=','datos_formulario.c_estado_formulario')
 ->leftjoin('datos_localizacion_periodo', 'datos_localizacion_periodo.id_localizacion_periodo','=','localizaciones_periodo.id_localizacion_periodo')
  ->select('localizaciones_periodo.id_localizacion_periodo','localizaciones_periodo.departamento',
   'localizaciones_periodo.id_localizacion',
   'localizaciones_periodo.nombre','localizaciones_periodo.cueanexo', 'localizaciones_periodo.id_serv',
   'localizaciones_periodo.codigo_jurisdiccional', 'df.nombre as nombre_formulario', 'df.nombre_corto',
   'datos_formulario.c_estado_formulario', 'estado_formulario_tipo.descripcion', 'datos_localizacion_periodo.responsable',
   'datos_localizacion_periodo.email', 'datos_localizacion_periodo.email_resp', 'datos_localizacion_periodo.updated_at',
   'df.color',  'datos_localizacion_periodo.fecha_envio_mail') 
 ->where ('localizaciones_periodo.id_periodo','=', $periodo->id_periodo)
 ->Codigo_jurisdiccional($codigo_jurisdiccional )->get();
 
    foreach ($errorfind as $key => $value) { 
      // $receivers[] = "josemlescano@gmail.com";
       $receivers[] = $value->email_resp;
      if ($value->email_resp <> $value->email){ $receivers[] = $value->email; }

      $DL = Datos_localizacion_periodo::Where('id_localizacion_periodo',$value->id_localizacion_periodo )
     ->update(['fecha_envio_mail'=> date('d-m-Y') ]);
   
    if ($value->c_estado_formulario == 80 or $value->c_estado_formulario ==90 ) { 
      $completo=$value;                  
       Mail::to($receivers)->send(new FormularioCompleto($completo, $periodo));        
      }
    
      if ($value->c_estado_formulario >= 20 or $value->c_estado_formulario <=70 ) {     
        $incompleto=$value; 
         Mail::to($receivers)->send(new FormularioIncompleto($incompleto, $periodo));        
         
      }
    }
    
   } // fecha 

  toastr()->info('Email enviado correctamente.');
  return back();
}

public function ver_verificacion_datos($codigo_jurisdiccional, $p){     
   $enviar_a=$this->datos_para_mail($codigo_jurisdiccional, $p);
   $localidad=localidad_tipo::orderBy('nombre')->select('c_localidad','c_departamento', 'nombre', 'tipo')
    ->where('cod_localidad', 'like' ,'06%')
    ->where('tipo', '!=' ,'BAJA')
    ->orWhereNull('tipo')    
    ->Departamento( $enviar_a->c_departamento)
    ->get();       
   
  return view('ver_verificacion_datos', compact('enviar_a', 'localidad', 'p'));  

 }

 public function redactarmail($codigo_jurisdiccional, $p){
   
    $enviar_a=$this->datos_para_mail($codigo_jurisdiccional, $p);  
    return view('redactar_mail', compact('enviar_a', 'p'));       
}

public function datos_para_mail($codigo_jurisdiccional, $p){ 
  $periodo=Periodos::select('periodos.*')->where('id_periodo',$p)->first();
  $datos=localizaciones_periodo::      
  join ('def_formulario_organizacion as dfo', 'dfo.c_organizacion','=','localizaciones_periodo.c_organizacion')      
  ->join ('definicion_formulario as df', function ($Join) use ($p)
  { $Join->on ('df.id_definicion_formulario','=','dfo.id_definicion_formulario')->whereRaw ('"df"."id_periodo" = '. $p); } )
   ->leftjoin('datos_formulario','datos_formulario.id_localizacion_periodo','=', 'localizaciones_periodo.id_localizacion_periodo')
   ->leftjoin('estado_formulario_tipo', 'estado_formulario_tipo.c_estado_formulario','=','datos_formulario.c_estado_formulario')
   ->leftjoin('datos_localizacion_periodo', 'datos_localizacion_periodo.id_localizacion_periodo','=','localizaciones_periodo.id_localizacion_periodo')
   ->select('localizaciones_periodo.id_localizacion_periodo','localizaciones_periodo.departamento',
      'localizaciones_periodo.id_localizacion', 
      'localizaciones_periodo.nombre','localizaciones_periodo.cueanexo', 'localizaciones_periodo.id_serv',
      'localizaciones_periodo.codigo_jurisdiccional', 'df.nombre as nombre_formulario', 'df.nombre_corto',
      'datos_formulario.c_estado_formulario', 'estado_formulario_tipo.descripcion', 'datos_localizacion_periodo.responsable',
      'datos_localizacion_periodo.email', 'datos_localizacion_periodo.email_resp', 'datos_localizacion_periodo.updated_at',
      'datos_localizacion_periodo.departamento as depto', 'datos_localizacion_periodo.localidad', 
      'datos_localizacion_periodo.c_departamento', 'datos_localizacion_periodo.c_localidad', 
      'datos_localizacion_periodo.cod_postal',  'datos_localizacion_periodo.telefono_cod_area', 'datos_localizacion_periodo.telefono',
      'datos_localizacion_periodo.calle', 'datos_localizacion_periodo.nro',  'datos_localizacion_periodo.calle_lateral_derecha',
      'datos_localizacion_periodo.calle_lateral_derecha', 'datos_localizacion_periodo.calle_lateral_izquierda',
      'datos_localizacion_periodo.email2', 'datos_localizacion_periodo.updated_at',   
      'datos_localizacion_periodo.fecha_envio_mail',
      'df.color')
    ->where ('localizaciones_periodo.id_periodo','=', $periodo->id_periodo)    
    ->whereNotNull('responsable') 
    ->Codigo_jurisdiccional( $codigo_jurisdiccional)
    ->first();       
     return  $datos;
}

/**
* guarda un archivo en nuestro directorio local.
*
* @return Response
*/

  

} // fin
