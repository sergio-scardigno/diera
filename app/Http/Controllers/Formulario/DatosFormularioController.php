<?php

namespace App\Http\Controllers\Formulario;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Datos_formulario;
use App\Model\Datos_localizacion_periodo;
use App\Model\Datos_cuadro;
use App\Model\Datos_celda;
use App\Model\Datos_celda_infinitas;
use App\Http\Controllers\Formulario\DefinicionFormularioController;
use App\Http\Controllers\Formulario\DefinicionMapaCuadroController;
use App\Model\Localizaciones_periodo;
use App\Model\Definicion_formulario;
use App\Model\Definicion_celda;
use App\Model\Oferta_periodo;
use Auth;
use Session;
use Illuminate\Support\Facades\Redis;
use App\Model\Definicion_cuadro;



class DatosFormularioController extends Controller {
   //propiedades del objeto Formulario
    public 
        //propiedades guardadas en tabla Definicion_formulario
        $id_definicion_formulario, $nombre, $nombre_corto, $descripcion, $id_periodo, $color,
         //propiedades de datos
        $id_datos_formulario,
        //$id_definicion_formulario,
        $id_localizacion_periodo, $c_estado_formulario, $fecha_inicio_carga, $fecha_fin_carga, $fecha_recepcion_UE,
        $id_usuario_update, $id_usuario_confirma, $id_usuario_inicia, $cuadros=[], $ofertas=[],
        // propiedades en datos_localizacion
        $id_serv, $cueanexo, $codigo_jurisdiccional, $departamento, $c_departamento, $esc_nro, $esc_nombre,
        $calle, $nro, $localidad, $c_localidad, $referencia, $cod_postal, $telefono_cod_area, $telefono, $email, $email2,
        $dependencia, $c_organizacion, $st_y, $st_x, $new_st_y, $new_st_x,
        $calle_lateral_derecha, $calle_lateral_izquierda, $responsable, $email_resp;

     /**
     * Crea un formulario en memoria
     * de la class  (DefinicionFormularioController) 
     * si se da un $id_definicion_formulario que debe existir, recupera el formulario guardado
     * return objeto class DefinicionFormularioController
     * Ej: crear formulario:
     *    $F_nuevo = new DefinicionFormularioController(['nombre'=>'planilla prueba7','nombre_corto'=>'pru7','descripcion'=>'desc planilla prueba7','id_periodo'=>'1','color'=>'ROSA']);
     * Ej. Recuperar formulario:
     *    $F = new DefinicionFormularioController(1);
     */ 

// ver c_estado_formulario=7 //error en id_definicion_formulario

    public function __construct($id_localizacion_periodo) 
    {     

        $this->id_localizacion_periodo=$id_localizacion_periodo;
        $id_usuario=Auth::user()->id;   // recupero el usuario login en memoria        
        //
        // Para la ELECCION DEL id_definicion_formulario (osea , el formulario que le corresponde a una localizacion):
        // Como el tipo de formulario de una localizacion ya almacenada  y el que
        // corresponde segun la tabla de localizaciones actual pueden diferir
        // esto seria una situacion de error, y para poder acceder a los datos ya cargados optamos por utilizar el tipo de
        // formulario guardado 
        // intentar recuperar id_definicion_formulario del formulrio guardado si existe       
    
        $id_definicion_formulario1 =Datos_formulario::select ('id_definicion_formulario')
                                            ->where('id_localizacion_periodo', $id_localizacion_periodo)
                                            ->first();//->id_definicion_formulario;      
        $id_definicion_formulario2 = DB::select("select definicion_formulario.id_definicion_formulario from localizaciones_periodo 
                  inner join def_formulario_organizacion on def_formulario_organizacion.c_organizacion = localizaciones_periodo.c_organizacion 
                  inner join definicion_formulario on definicion_formulario.id_definicion_formulario = def_formulario_organizacion.id_definicion_formulario
               where localizaciones_periodo.id_localizacion_periodo = :id_localizacion_periodo
                     and definicion_formulario.id_periodo = localizaciones_periodo.id_periodo" , ['id_localizacion_periodo'=>$id_localizacion_periodo]);
        $id_definicion_formulario2= (count($id_definicion_formulario2)>0) ? $id_definicion_formulario2[0]->id_definicion_formulario  : null;
 
        if (isset($id_definicion_formulario1))  {  //utilizar el id_definicion_formulario que cooresponde al formulario guardado
            $this->id_definicion_formulario = $id_definicion_formulario1->id_definicion_formulario;
            if ($id_definicion_formulario1->id_definicion_formulario != $id_definicion_formulario2)
            {	$this->c_estado_formulario=7; //error en id_definicion_formulario
            } 
        }
        else {  
            if (!is_null($id_definicion_formulario2)) // si se encontró formulario
            { //utilizar el id_definicion_formulario que cooresponde por la tabla de localizaciones
               $this->id_definicion_formulario = $id_definicion_formulario2;
            }
            else {  // no se pudo encontrar un formulario para la localizacion.
               $this->id_definicion_formulario =null;
               $this->id_localizacion_periodo=null;
               return null;      
            }
        }

        // recuperar la definicion del formulario y los cuadros  desde la Cache
        $Key_Def_Formulario='Def_Formulario_'.$this->id_definicion_formulario;
        $Key_Def_Cuadros ='Def_Cuadros_'.$this->id_definicion_formulario;

        if (Redis::get($Key_Def_Formulario))  {        
            $Def_Formulario=Redis::get($Key_Def_Formulario); 
            $Def_Cuadros=Redis::get($Key_Def_Cuadros); 
        }
        else  {
            $Def_Formulario=Definicion_formulario::findOrFail($this->id_definicion_formulario); 
            Redis::set($Key_Def_Formulario, $Def_Formulario);
            $Def_Cuadros= definicion_cuadro::Select('definicion_cuadro.*')->join('definicion_formulario', 'definicion_formulario.id_definicion_formulario','=','definicion_cuadro.id_definicion_formulario')->orderBy('numero')->where('definicion_cuadro.id_definicion_formulario','=', $this->id_definicion_formulario)->get();
            Redis::set($Key_Def_Cuadros, $Def_Cuadros);
        }

        $Def_Formulario=collect(json_decode($Def_Formulario));
        $Def_Cuadros=collect(json_decode($Def_Cuadros));

        //paso los datos de definicion_formulario guardado a las propiedades de la instancia creada
        $this->nombre = $Def_Formulario['nombre'];
        $this->nombre_corto = $Def_Formulario['nombre_corto'];
        $this->descripcion = $Def_Formulario['descripcion'];
        $this->color = $Def_Formulario['color'];
        $this->id_periodo=$Def_Formulario['id_periodo'];

        // Cambie estas lineas para usar Redis
        // recuperar la definicion del formulario
        // $Def_Formulario=Definicion_formulario::findOrFail($this->id_definicion_formulario);
        //recuperar la definicion de los cuadros del formulario
        // $Def_Cuadros=$Def_Formulario->cuadros;      

        //paso los datos de definicion_formulario guardado a las propiedades de la instancia creada        
        // $this->nombre = $Def_Formulario->nombre;
        // $this->nombre_corto = $Def_Formulario->nombre_corto;
        // $this->descripcion = $Def_Formulario->descripcion;
        // $this->color = $Def_Formulario->color;
        // $this->id_periodo=$Def_Formulario->id_periodo;
       // fin Cache

        //$this->id_definicion_formulario = $Def_Formulario->id_definicion_formulario;  // ya lo asigna el constructo        
        //$this->created_at = $Def_Formulario->created_at;
        //$this->update_at = $Def_Formulario->update_at;

  //       try
		// {
		// 	DB::beginTransaction();
	        //propiedades de datos_formulario
	            // recuperar
	        $DF = Datos_formulario::firstOrCreate
	               (['id_definicion_formulario' => $this->id_definicion_formulario,   //clave acceso al formulario
	                 'id_localizacion_periodo' => $id_localizacion_periodo ] ,   
	                // si no se encuentra se inicializa un nuevo formulario  con:
	                [ //'id_datos_formulario' => $this->id_datos_formulario  ,    // es autonumérico    	                  
                      'c_estado_formulario'=>70 //vacio              
	                  ,'fecha_inicio_carga'=> null  // se crea null porque no se da comienza a la carga hasta que no se haga el primer save //date("Y/m/d") 
	                  ,'fecha_fin_carga'=> null
	                  ,'fecha_recepcion_UE'=>null
	                  ,'id_usuario_update'=>$id_usuario   // inicializo con el usuario login
                      ,'id_usuario_inicia'=> null  // se crea null porque no se da comienza a la carga hasta que no se haga un save
                      ,'id_usuario_confirma'=> null
	                  // ,'created_at'=> '', 'updated_at'=> ''                  
	                ] );
                    
            $DL = Datos_localizacion_periodo::find($id_localizacion_periodo );

            $nuevo = !isset($DL); // el formulario ya existia usamos sus datos

            if ($nuevo) 
            {    // se agrega un formulario nuevo
            	//pasar registro de localizaciones_periodo a datos_localizacion_periodo
              $DL=Localizaciones_periodo::
               join('organizacion_tipo', 'organizacion_tipo.c_organizacion','=','localizaciones_periodo.c_organizacion')       
               //->join('datos_formulario','datos_formulario.id_localizacion_periodo','=', 'localizaciones_periodo.id_localizacion_periodo')
               //  ->leftjoin('puntos_escuelas','puntos_escuelas.idserv', '=','localizaciones_periodo.id_serv')
                    ->select(   'localizaciones_periodo.id_localizacion_periodo',
                                'localizaciones_periodo.id_localizacion',       
                                'localizaciones_periodo.id_serv',
                                'localizaciones_periodo.cueanexo',                                
                                'localizaciones_periodo.codigo_jurisdiccional',
                                'localizaciones_periodo.id_periodo',
                                'localizaciones_periodo.departamento',
                                'localizaciones_periodo.c_departamento', 
                                'localizaciones_periodo.esc_nro',
                                'localizaciones_periodo.nombre',
                                'localizaciones_periodo.calle',
                                'localizaciones_periodo.nro',
                                'localizaciones_periodo.localidad',
                                'localizaciones_periodo.c_localidad',                                
                                'localizaciones_periodo.referencia',
                                'localizaciones_periodo.cod_postal',
                                'localizaciones_periodo.telefono_cod_area',
                                'localizaciones_periodo.telefono',
                                'localizaciones_periodo.email',
                                'localizaciones_periodo.dependencia',
                                'localizaciones_periodo.c_organizacion',
                                'localizaciones_periodo.calle_lateral_derecha',
                                'localizaciones_periodo.calle_lateral_izquierda',
                                'localizaciones_periodo.st_y',
                                'localizaciones_periodo.st_x'
                                //'null as new_st_y',
                                //'null as new_st_x' 
                                )
                        ->where('localizaciones_periodo.id_localizacion_periodo',$id_localizacion_periodo)
                        ->first();
                                            // separo el campo email en dos campos
                $emails=explode (";",str_replace(" ","",$DL->email)); 	// elimiar espacios y dividir los emails en un arreglo
                $e1=count($emails)>=1 ? $emails[0] : ''; // guarda 1er email
                $e2=count($emails)>=2 ? $emails[1] : ''; // guarda 2er email
 
                Datos_localizacion_periodo::insert(
                            [   'id_localizacion_periodo' => $DL->id_localizacion_periodo,
                                'id_localizacion' => $DL->id_localizacion,                                 
                                'id_serv'=> $DL->id_serv ,
                                'cueanexo' => $DL->cueanexo,                            
                                'codigo_jurisdiccional' => $DL->codigo_jurisdiccional,
                                'id_periodo' => $DL->id_periodo,
                                'departamento' => $DL->departamento,
                                'c_departamento' => $DL->c_departamento, 
                                'esc_nro' => $DL->esc_nro,
                                'nombre' => $DL->nombre,
                                'calle' => $DL->calle,
                                'nro' => $DL->nro,
                                'localidad' => $DL->localidad,
                                'c_localidad' => $DL->c_localidad,                                
                                'referencia' => $DL->referencia,
                                'cod_postal' => $DL->cod_postal,
                                'telefono_cod_area' => $DL->telefono_cod_area,
                                'telefono' => $DL->telefono,
                                'email'  => $e1, 
                                'email2' => $e2,
                                'dependencia' => $DL->dependencia,
                                'c_organizacion' => $DL->c_organizacion,
                                'st_y' => $DL->st_y,
                                'st_x' => $DL->st_x,
                                'calle_lateral_derecha' => $DL->calle_lateral_derecha,
                                'calle_lateral_izquierda' => $DL->calle_lateral_izquierda

                            ] );
            }
            //asignar las propiedades de localizacion
            $this->id_localizacion_periodo = $DL->id_localizacion_periodo;
            $this->id_localizacion = $DL->id_localizacion;                                 
            $this->id_serv = $DL->id_serv;
            $this->cueanexo = $DL->cueanexo;                            
            $this->codigo_jurisdiccional = $DL->codigo_jurisdiccional;
            $this->id_periodo = $DL->id_periodo;
            $this->departamento = $DL->departamento;
            $this->c_departamento = $DL->c_departamento; 
            $this->esc_nro = $DL->esc_nro;
            $this->esc_nombre = $DL->nombre;
            $this->calle = $DL->calle;
            $this->nro = $DL->nro;
            $this->localidad = $DL->localidad;
            $this->c_localidad = $DL->c_localidad;                                
            $this->referencia = $DL->referencia;
            $this->cod_postal = $DL->cod_postal;
            $this->telefono_cod_area = $DL->telefono_cod_area;
            $this->telefono = $DL->telefono;

            $this->email = $nuevo ? $e1: $DL->email;
            $this->email2 = $nuevo ? $e2: $DL->email2;

            $this->dependencia = $DL->dependencia;
            $this->c_organizacion = $DL->c_organizacion;

            $this->st_y = $DL->st_y;
            $this->st_x = $DL->st_x;            
            $this->new_st_y = $DL->new_st_y;
            $this->new_st_x = $DL->new_st_x;
            $this->calle_lateral_derecha = $DL->calle_lateral_derecha;
            $this->calle_lateral_izquierda = $DL->calle_lateral_izquierda;
          
            $this->ofertas=[];

           // cargar las ofertas de la localizacion
            //$DOfertas= Oferta_periodo::select('c_oferta',)->where('id_localizacion_periodo', $id_localizacion_periodo)->get();

            $DOfertas= Oferta_periodo::join ('oferta_tipo','oferta_tipo.c_oferta','=','oferta_periodo.c_oferta')
                        ->select('oferta_periodo.c_oferta','oferta_tipo.descripcion')
                        ->where('id_localizacion_periodo', $id_localizacion_periodo)
                        ->where('c_estado',1) // exige que la oferta sea activa
                        ->get();

      // ATENCION
      // le anulo la cache de las ofertas de una localizacion, porque esto es dinámico y se necesita actualizar
      // inmediatamente finalizada una articulación. tal vez sea posible activar si en el proceso de articulación se
      // eliminara esta key,
      

             // $key_DOfertas='DOfertas_'.$id_localizacion_periodo;      
             //  if (Redis::get($key_DOfertas)) {        
             //    $DOfertas=Redis::get($key_DOfertas); 
             //  }
             //  else {
             //    $DOfertas=Oferta_periodo::join ('oferta_tipo','oferta_tipo.c_oferta','=','oferta_periodo.c_oferta')
             //                ->select('oferta_periodo.c_oferta','oferta_tipo.descripcion')
             //                ->where('id_localizacion_periodo', $id_localizacion_periodo)
             //                ->where('c_estado',1) // exige que la oferta sea activa
             //                ->get();
             //      Redis::set($key_DOfertas, $DOfertas);
             //      Redis::expire($key_DOfertas, 14400);  // esta en segundos 3600 una hora 14400 son 4 hs 

             //  }
             //   $DOfertas=collect(json_decode($DOfertas));


            foreach ($DOfertas as $DO) {
                    $this->ofertas[$DO->c_oferta]=$DO->descripcion;
                }

	        // asignarlas al objeto formulario

	        $this->id_datos_formulario=$DF->id_datos_formulario;
	        //$this->id_definicion_formulario=$D->id_definicion_formulario     //ya esta asignado
	        //$this->id_localizacion = $D->id_localizacion;         //ya esta asignado          
            
            //$this->c_estado_formulario = isset($this->c_estado_formulario) ? $this->c_estado_formulario : $DF->c_estado_formulario; //prioriza error de definicion]
	        $this->c_estado_formulario = $DF->c_estado_formulario;  // sobreescribe el estado de error 7 ignorando el error de id_definicion_formulario !!!         
	        $this->id_usuario_update = $DF->id_usuario_update;
            $this->id_usuario_inicia = is_null($DF->id_usuario_inicia) ? $DF->id_usuario_update: $DF->id_usuario_inicia ;  //cargo el usuario de inicio para cuando haga un save
            $this->id_usuario_confirma = $DF->id_usuario_confirma;
            $this->fecha_inicio_carga = is_null($DF->fecha_inicio_carga)? date("Y/m/d") :$DF->fecha_inicio_carga;   //cargo la fecha inicio para cuando haga un save          
            $this->fecha_fin_carga = $DF->fecha_fin_carga;
            $this->fecha_recepcion_UE = $DF->fecha_recepcion_UE;
	        //$this->created_at = $D->created_at;  $this->updated_at = $D->updated_at;

            $date= date("Y-m-d H:i:s", time()); //('now'::text)::timestamp without time zone; //time(); //
	            // otras propiedades
	            // recuperar los cuadros
	            //$this->cuadros= DatosCuadroController::dat_cuadro_get_cuadros_formulario($DF->id_datos_formulario, $Def_Formulario->id_definicion_formulario,$this->ofertas);
            

	        //actualizar datos del cuadro
	        foreach ($Def_Cuadros as $C)
	        {   // recuperar propiedades de datos_cuadro
	            $DC = Datos_cuadro::firstOrCreate (
	                   	[   //clave acceso al cuadro
                            'id_datos_formulario'=> $this->id_datos_formulario,             
                            'id_definicion_cuadro' => $C->id_definicion_cuadro
                        ],   
	                      // si no se encuentra se inicializa un nuevo cuadro  con:
	                    [ //'id_datos_cuadro' => $D->id_datos_cuadro  ,  // es autonumerico      
	                      'c_estado_cuadro'=>70,  // Vacio estado inicial
	                      'id_usuario'=> $id_usuario              
	                    ] );   
	            // agregar el cuadro al array de cuadros
	            $this->cuadros[$C->numero] = new DatosCuadroController (
	                                            [   'id_definicion_cuadro'=>$C->id_definicion_cuadro ,
	                                                'nombre' => $C->nombre ,
	                                                'numero' => $C->numero ,
                                                    'descripcion' => $C->descripcion ,
                                                    'encabezado' => $C->encabezado ,
                                                    'indicaciones' => $C->indicaciones ,
                                                    'ayuda' => $C->ayuda ,
	                                                'c_tipo_cuadro' => $C->c_tipo_cuadro ,
	                                                'c_criterio_completitud'=> $C->c_criterio_completitud,
                                                    'ancho' => $C->ancho,
	                                                'id_datos_cuadro' => $DC->id_datos_cuadro,
	                                                'c_estado_cuadro' => $DC->c_estado_cuadro,
	                                                'id_usuario' => $DC->id_usuario,
	                                                'created_at' => $DC->created_at,
	                                                'update_at' => $DC->update_at,
                                                //  'consistencias' => $C->consistencias ,
                                                    'consistencias' => New DefinicionConsistenciaController($C->id_definicion_cuadro),
                                                    'mapa' => DefinicionMapacuadroController::mapa ($C->id_definicion_cuadro,$this->id_localizacion_periodo ), // recupero el mapa de ofertas validas del cuadro
                                                    'msg_err' => $DC->msg_err,
                                                    'msg_adv' => $DC->msg_adv,

	                                            //  'celdas' => DatosCeldaController::dat_celda_get_celdas_cuadro($DC->id_datos_cuadro,$C->id_definicion_cuadro)
	                                            ] );
    
                $id_cua=$DC->id_datos_cuadro;
                $Ci=$this->cuadros[$C->numero]; // alias al cuadro creado
                $cant_celdas_editables=0; // contador de celdas editable del cuadro (input);

                // no usamos Cache para recuperar la definicion_celdas porque se recupera en cojunto con los datos 
                               
                //recupero todas los datos de las celdas con su definicion del cuadro si existen en un array
				if ($C->c_tipo_cuadro!=2 and $C->c_tipo_cuadro!=3) // //si el cuadro no es filas infinitas
                {   // recuperar definicion y datos de celdas de cuadro de filas fijas
                    $ac=definicion_celda:: leftjoin ('datos_celda', function ($join) use ($id_cua ) {
                                                        $join->on ('definicion_celda.id_definicion_celda', '=', 'datos_celda.id_definicion_celda')
                                                        ->where('datos_celda.id_datos_cuadro', '=', $id_cua); })
                        ->select( 'definicion_celda.*', 'datos_celda.id_datos_celda','datos_celda.id_datos_cuadro', 'datos_celda.valor', 'datos_celda.updated_at')
                        ->where ('definicion_celda.id_definicion_cuadro',$C->id_definicion_cuadro )
                        ->orderBy('fila')->orderBy('columna')->get();  
                }
                else
                {   // recuperar definicion y datos de celdas de cuadro de filas infinitas
                    $ac=definicion_celda:: leftjoin ('datos_celda_infinitas', function ($join) use ($id_cua ) {
                                                        $join->on ('definicion_celda.id_definicion_celda', '=', 'datos_celda_infinitas.id_definicion_celda')
                                                        ->where('datos_celda_infinitas.id_datos_cuadro', '=', $id_cua);})
                        ->select('definicion_celda.*', 'datos_celda_infinitas.id_datos_celda', 'datos_celda_infinitas.id_datos_cuadro','datos_celda_infinitas.fila_infinita', 'datos_celda_infinitas.valor', 'datos_celda_infinitas.updated_at')
                        ->where ('definicion_celda.id_definicion_cuadro', $C->id_definicion_cuadro )
                        ->orderBy('fila')->orderBy('columna')->get();                        
                }

                // buscar si hay celdas editables para saber si es un  cuadro en  c_estado_cuadro=87 (anulado)
                for ($fil=0,$hay_editables=false ;!$hay_editables and $fil<count($ac); $fil++)
                    {   $cel=$ac[$fil];
                        $hay_editables= (($cel->editable)
                                            and (strlen($cel->valor)!=0 // tiene datos
                                                or is_null($cel->c_mapa) // no hay control de oferta
                                                or in_array($cel->c_mapa, $Ci->mapa) )); //la oferta esta en las ofertas validas 
                    } // for  de celdas
 
                foreach ($ac as $cel)  //poner las celdas en el objeto cuadro y en la base de datos si estamos creando el cuadro
                {   
                    $cel->valor=($cel->editable)? $cel->valor : $cel->valor_inicial; // inicializar celdas no editables
                    if ( (!isset($cel->id_datos_celda)  and $cel->editable) )          
                        {   // la celda no existe en datos_celda hay que agregarla
                            // inserto el nuevo registro en datos_celda  dependiendo el tipo de cuadro

                            // inicializamos los valores de la celda: el valor inicial , id_datos_cuadro ... 
                            // si tipo_dato='ComboBox' el valor_inicial guarda el id_combo que indica la tabal de opciones a utilizar no el valor inicial  
                            $cel->valor=(   (strtolower($cel->tipo_dato)=='combobox')
                                         or (strtolower($cel->tipo_dato)=='radio')) ? '': $cel->valor_inicial; 
                            $cel->id_datos_cuadro=$id_cua;
                            if ($hay_editables)
                            { // el cuadro tiene celdas con datos para grabar
                                if ($C->c_tipo_cuadro!=2 and $C->c_tipo_cuadro!=3)
                                { 
                                    $cel->id_datos_celda = Datos_celda::insertGetId
                                        (   [   'id_definicion_celda' => $cel->id_definicion_celda, 
                                                'id_datos_cuadro' => $cel->id_datos_cuadro,
                                                'valor' => $cel->valor, 
                                                'updated_at' => $date
                                            ] , 
                                            'id_datos_celda' 
                                        );
                                }
                                else
                                {  
                                $cel->id_datos_celda = Datos_celda_infinitas::insertGetId
                                        (   [   'id_definicion_celda' => $cel->id_definicion_celda, 
                                                'fila_infinita' => $cel->fila,
                                                'id_datos_cuadro' => $cel->id_datos_cuadro,
                                                'valor' => $cel->valor,
                                                'updated_at' => $date
                                            ] , 
                                            'id_datos_celda'
                                        ); 
                                }   
                            } // ? $hay_editables          
                        }  // ? agregar celdas nuevas

                    //recalculamos la fila segun el tipo de cuadro
                    $cel->fila=(($C->c_tipo_cuadro!=2 and $C->c_tipo_cuadro!=3) or !isset($cel->fila_infinita) ) ? $cel->fila: $cel->fila_infinita;

                    //recalculamos la visualizacion/ocultamiento de celdas dinamicas
                    if (!is_null($cel->c_mapa)   // se  verifica oferta valida
                            and !in_array($cel->c_mapa, $Ci->mapa) //la oferta esta en las ofertas validas
                            and strlen($cel->valor)==0 ) // la celda esta vacia
                    	{
                            $cel->titulo=false;  //poner la celda ciega
                            $cel->editable=false;
                        //    $cel->id_datos_celda=null; // no corresponde celda de datos
                        }
                     
                    if ($cel->editable) {   $cant_celdas_editables++; }  // contar celdas editaables del cuadro

                    // agregar la celdas a la tabla "celdas" del cuadro
                    $Ci->celdas[$cel->fila][$cel->columna] = new DatosCeldaController (
                                    [   // info de definicion celda
                                        'id_definicion_celda' => $cel->id_definicion_celda,
                                        'fila' => $cel->fila,
                                        'columna' => $cel->columna,
                                        'editable' => $cel->editable,
                                        'tipo_dato' => $cel->tipo_dato,
                                        'colspan' => $cel->colspan,
                                        'rowspan' => $cel->rowspan,
                                        'titulo' =>$cel->titulo,
                                        'valor_inicial' => $cel->valor_inicial,
                                        'estilos' => $cel->estilos,
                                        'c_mapa' => $cel->c_mapa,

                                        'c_categoria_consistencia' => $DC->c_categoria_consistencia,
                                        'msg' => $DC->msg,

                                            //info de datos celda                                
                                        'id_datos_celda' => $cel->id_datos_celda,
                                        'id_datos_cuadro' => $cel->id_datos_cuadro,
                                        'valor' => $cel->valor
                                     ] );

                }  //foreach  de cel

                // actualizamos estado del cuadro si cambio
                $c_estado_cuadro_antes=$Ci->c_estado_cuadro; // tomo el estado del cuadro antes para ver si cambia
                if (!$hay_editables and $Ci->c_estado_cuadro!=87)  // actualizar estado de cuadro si no hay celdas editables
                    {
                        $Ci->c_estado_cuadro=87;  // si no hay celdas editables anulo el cuadro, pongo estado 87 no corresponde
                        //eliminamos las celdas del cuadro en la base de datos
                        if ($C->c_tipo_cuadro!=2 and $C->c_tipo_cuadro!=3) // no es de filas infinitas
                            {  
                                Datos_celda::where ('id_datos_cuadro',$Ci->id_datos_cuadro)->delete();
                            }
                        else
                            {
                                Datos_celda_infinitas::where ('id_datos_cuadro',$Ci->id_datos_cuadro)->delete();
                            }
                    }
                elseif ($hay_editables and $Ci->c_estado_cuadro==87)
                    {
                        $Ci->c_estado_cuadro=40; // forzamos estado en carga, para que se valide cuando se consiste luego de cargar todos los cuadros
                    }
                if ($c_estado_cuadro_antes!=$Ci->c_estado_cuadro) // actualizamos los datos si cambio el estado del cuadro
                    {
                        $Ci->save_estado($id_usuario); 
                    }

	        }	// end foreach $ cuadros

            $c_estado_formulario_antes=$this->c_estado_formulario; //tomo el estado anterior par ver si cambia despes de consistir
            $this->consistir_formulario(); // aplicar consistencias

            if ($this->c_estado_formulario<>$c_estado_formulario_antes)
                {  // si detectamoz un cambio de estado lo grabo por si se aborta la edicion
                    $this->id_usuario_update =$id_usuario; // actualizo el usuario que modifica
                    Datos_formulario::where ('id_datos_formulario',$this->id_datos_formulario)
                                    ->update(['c_estado_formulario' => $this->c_estado_formulario
                                                ,'id_usuario_update'  => $this->id_usuario_update // se inicialize cuando se crea el formulario en el constructo
                                                ] );
                } // ? cambio estado formulario

    // DB::commit();  /* Transaction successful. */
    //     }
    //          catch (\Exception $e)
    //     {
    //          DB::rollback();  /* Transaction failed. */
    //     }

    }


    /**
     * Guardar los datos de un formulario.
     * return nada
     */         

    public function save () {   
        // try
        //     {   DB::beginTransaction();
             
                $id_usuario= Auth::user()->id; // recuperamos el usuario que modifica
                $this->id_usuario_update = $id_usuario; // actualizo el usuario que modifica

                //actualizar datos del formulario
                Datos_formulario::where ('id_datos_formulario', $this->id_datos_formulario )  
                        ->update([  'c_estado_formulario'=>$this->c_estado_formulario                                          
                                    ,'id_usuario_update'=>$this->id_usuario_update // se inicialize cuando se crea el formulario en el constructo
                                    ,'id_usuario_inicia'=>$this->id_usuario_inicia // se inicialize cuando se crea el formulario en el constructo
                                    ,'fecha_inicio_carga'=>$this->fecha_inicio_carga
                                // 'id_usuario_confirma'=>$this->id_usuario_confirma // no requiere update hasta que se confirme
                                // 'fecha_fin_carga'=>$this->fecha_fin_carga,
                                    ,'fecha_recepcion_UE'=>$this->fecha_recepcion_UE
                                  ]);
                //actualizar datos del cuadro

                foreach ($this->cuadros as $cua)
                {   
                    if ($cua->c_estado_cuadro!=87)  // cuadro con celdas editables
                    {
                        $cua->cuadro_save($id_usuario);                        
                    }  // ? cuadro con celdas editables  

                } // end for cuadros


        //         DB::commit();  /* Transaction successful. */
        //     }
        // catch (\Exception $e)
        //     {   DB::rollback();  /* Transaction failed. */
        //     }

    }

   /**
     * funcion para salvar en BD los datos de un cuadro a partir de un array
     * del tipo: $input [$cuadro][$fila][$columna] = $valor
     * ejemplo $input[3][4][1] = 23; (cuadro 3, fila 4, columna 1 con valor 23)
     * param Array con los datos a cargar en los cuadros.
     * acepta multiples cuadros en el array     
     */

    public function save_cuadros_editados($input)   { 
       // try
        //     {   DB::beginTransaction();

                $id_usuario= Auth::user()->id; // recuperamos el usuario que modifica
                $this->id_usuario_update = $id_usuario; // actualizo el usuario que modifica

                //actualizar datos del formulario
                Datos_formulario::where ('id_datos_formulario', $this->id_datos_formulario )  
                        ->update([  'c_estado_formulario'=>$this->c_estado_formulario
                                    ,'id_usuario_update'=>$this->id_usuario_update
                                    ,'id_usuario_inicia'=>$this->id_usuario_inicia 
                                    ,'fecha_inicio_carga'=>$this->fecha_inicio_carga
                                ]);
                
                //actualizar datos del cuadro editados
               
                foreach ($input as $ncua => $cuadro)
                    { 
                        $this->cuadros[$ncua]->cuadro_save($id_usuario);
                    } 

        //         DB::commit();  /* Transaction successful. */
        //     }
        // catch (\Exception $e)
        //     {   DB::rollback();  /* Transaction failed. */
        //     }

    }

     /**
     * Eliminar datos guardados del formulario en tabla de formularios
     * no afecta al objeto formulario!! (DefinicionFormularioController)
     * return nada
     */ 
    static public function dat_formulario_delete($id_localizacion_periodo)  {
        try
            {   DB::beginTransaction();
               // recuperar el formulario
               // $DF=Datos_formulario::findOrFail($id_datos_formulario);

                $DF =Datos_formulario::where('id_localizacion_periodo', $id_localizacion_periodo)
                                            ->first();
                $c_estado_formulario=$DF->c_estado_formulario; //no guardamos el estado del formulario

                //recuperar los cuadros del formulario
                $DCuadros=$DF->cuadros;

                //actualizar datos del cuadro
                foreach ($DCuadros as $Cua)
                {
                    Datos_celda::where ('id_datos_cuadro', $Cua->id_datos_cuadro)->delete();
                    Datos_celda_infinitas::where ('id_datos_cuadro', $Cua->id_datos_cuadro)->delete();   
                    $Cua->delete();
                }
                
                // eliminar datos de la localizacion de la base de datos.     
                Datos_localizacion_periodo::destroy($DF->id_localizacion_periodo);

                // eliminar datos del formulario en la base de datos.     
                $DF->delete();

                // si esta´marcado para borrar eliminamos lod datos de localizacion periodo y ofertas también
                if ($c_estado_formulario==6) //6=Formulario para borrar, por baja en padrón
                {
                   Oferta_periodo::where('id_localizacion_periodo', $id_localizacion_periodo) //eliminamos ofertas de la localizacion 
                                   ->where('c_estado','<>', 1) // estado activo
                                   ->delete();
                   Localizaciones_periodo::destroy($id_localizacion_periodo); // eliminamos detos de la localizacion periodo (sin ofertas)
                }

                DB::commit();  /* Transaction successful. */
            }
        catch (\Exception $e)
            {   DB::rollback();  /* Transaction failed. */
            }
    }

     /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show()  {    
        echo ' Definición_formulario->Id          :' . $this->id_definicion_formulario. '<BR>';
        echo ' Datos_formulario->Id          :' . $this->id_datos_formulario. '<BR>';
        echo ' Datos_formulario->nombre      :' . $this->nombre. '<BR>';
        echo ' Datos_formulario->nombre_corto:' . $this->nombre_corto. '<BR>';
        echo ' Datos_formulario->descripcion :' . $this->descripcion. '<BR>';
        echo ' Datos_formulario->id_periodo  :' . $this->id_periodo. '<BR>';
        echo ' Datos_formulario->color       :' . $this->color. '<BR>';
    	//    echo ' Datos_formulario->created_at  :' . $this->created_at. '<BR>';
    	//    echo ' Datos_formulario->update_at   :' . $this->update_at. '<BR>';  
        echo  '<BR>';
        echo  '<BR>';
        echo  '<BR>';

        if (!is_null($this->cuadros))
        {   foreach ($this->cuadros as $cuadro)
            {
                echo 'CUADRO: '. $cuadro->numero.' ) '. $cuadro->nombre.'<BR>';
                echo    'Id_datos_cuadro: ' . $cuadro->id_datos_cuadro 
                        . ' / ' . 'Desc: ' . $cuadro->descripcion 
                        . ' / ' . 'Encabezado: ' . $cuadro->encabezado 
                        . ' / ' . 'Indicaciones: ' . $cuadro->indicaciones 
                        . ' / ' . 'Ayuda: ' . $cuadro->ayuda 
                        . ' / ' . 'Tipo_Cuadro: ' . $cuadro->c_tipo_cuadro
                        . ' / ' . 'Criterio_completitud: ' . $cuadro->c_criterio_completitud 
                        . ' / ' . 'Ancho: ' . $cuadro->ancho ;
                
                if (!empty($cuadro->celdas))
                {   echo ' / Filas: '.count($cuadro->celdas) ;
                    echo '  Columnas: '.count($cuadro->celdas[1]).'<BR>';
                    echo '<table cellspacing="1" cellpadding="20" border="5px solid">';

                    for ($fil=0;$fil<count($cuadro->celdas); $fil++)
                    {   
                        echo '<tr>';
                        if (isset($cuadro->celdas[$fil+1] ) )
                        {   
                            for ($col=0;$col<count($cuadro->celdas[$fil+1] );$col++)
                            {   
                                if (isset($cuadro->celdas[$fil+1][$col+1])  )                                	
                                {   if   ($cuadro->celdas[$fil+1][$col+1]->tipo_dato !='null' ) // con null la celda no se imprime
                                    {    
	                                	$p= ($cuadro->celdas[$fil+1][$col+1]->titulo) ? ' align="center" ': ' align="center" ';
	                                   	$p.=($cuadro->celdas[$fil+1][$col+1]->rowspan>1)? ' rowspan='.$cuadro->celdas[$fil+1][$col+1]->rowspan : '';
	                                    $p.=($cuadro->celdas[$fil+1][$col+1]->colspan>1)? ' colspan='.$cuadro->celdas[$fil+1][$col+1]->colspan : '';
	                                    //$p.= (!$cuadro->celdas[$fil+1][$col+1]->editable  and !$cuadro->celdas[$fil+1][$col+1]->titulo) ? ' bgcolor="black"' : 'bgcolor="#FFFFFF"';
	                                   	if ($cuadro->celdas[$fil+1][$col+1]->titulo)
                                            {   $p.=($cuadro->celdas[$fil+1][$col+1]->editable) ? ' bgcolor="red" ': ' bgcolor="gray" ';
                                            }
                                       	elseif (!$cuadro->celdas[$fil+1][$col+1]->editable)
                                            {  //no es titulo y no es editable =celda ciega
                                               $p.= ' bgcolor="cyan" '; //celda ciega
                                            }
                                        else
                                            {   //ver color de celda?
                                               switch ($cuadro->celdas[$fil+1][$col+1]->c_categoria_consistencia)
                                                    {
                                                        case 1: $p.= ' bgcolor="white" ';
                                                                break;
                                                        case 2: $p.= ' bgcolor="yellow" ';
                                                                break;
                                                        case 3: $p.= ' bgcolor="red" ';
                                                                break;
                                                        default: $p.= ' bgcolor="green" ';                                                            
                                                    }
                                            } 
	                                    echo '<td'.$p .'>' . $cuadro->celdas[$fil+1][$col+1]->valor.'</td>';  

	                                   	//  echo '<td align="center" bgcolor="gray">'.$cuadro->celdas[$fil+1][$col+1]->valor.' </td>'; 
                                    }  // celda no visible
                                }
                                else
                                {	echo '<td align="center" bgcolor="#FFFFFF"> ' .'</td>'; } 

								//$col+=($cuadro->celdas[$fil+1][$col+1]->colspan>1)? $cuadro->celdas[$fil+1][$col+1]->colspan-1 : 0 ;
                            }   //for $col  
                           
                        }	//if hay fila
                        echo '</tr>';
                    } 	// for $fil
                    echo '</table> <BR><BR>';
                    foreach ($cuadro->msg_err as $msg) { echo '<p style="color:red">'. $msg .' </p>'; }
                    foreach ($cuadro->msg_adv as $msg) { echo '<p style="color:yellow">'.$msg .'<BR> </p>'; }
                }
                else
                {   echo '<BR>CUADRO SIN CELDAS'; }
            } //foreach ($this->cuadros as $cuadro) 
        }
        else 
        {   echo '<BR>FORMULARIO SIN CUADROS <BR>'; }
            
    }

    /*    public function __construct($id_localizacion, $id_periodo) 
    {     
        $this->id_localizacion=$id_localizacion;
        $this->id_periodo=$id_periodo;
        try
        {   DB::beginTransaction();
 
            //
            // ELECCION DEL id_definicion_formulario
            // el que tiene un formulario guardado puede diferir del que le corresponde segun la tabla de localizaciones actual
            //
            // intentar recuperar id_definicion_formulario del formulrio guardado
            $id_definicion_formulario1 =Datos_formulario::select ('datos_formulario.id_definicion_formulario')
                                                ->join('definicion_formulario','definicion_formulario.id_definicion_formulario','=','datos_formulario.id_definicion_formulario')
                                                 ->where('datos_formulario.id_localizacion', $id_localizacion)
                                                 ->where('definicion_formulario.id_periodo', $id_periodo)
                                                 ->first();//->id_definicion_formulario;
        
            
            // recuperar el id_definicion_formulario que corresponde por la tabla de localizaciones
            $id_definicion_formulario2 = Localizacion::select ('definicion_formulario.id_definicion_formulario')
                ->join('def_formulario_organizacion','def_formulario_organizacion.c_organizacion','=','localizaciones.c_organizacion')
                ->join('definicion_formulario','definicion_formulario.id_definicion_formulario','=','def_formulario_organizacion.id_definicion_formulario')
                ->where('localizaciones.id_localizacion', $id_localizacion) 
                ->where('definicion_formulario.id_periodo', $id_periodo)->first()->id_definicion_formulario;            
             
            if (isset($id_definicion_formulario1))
            {  //utilizar el id_definicion_formulario que cooresponde al formulario guardado
                $this->id_definicion_formulario = $id_definicion_formulario1->id_definicion_formulario;
                if ($id_definicion_formulario1->id_definicion_formulario != $id_definicion_formulario2)
                    { $this->c_estado_formulario=70; //error en id_definicion_formulario
                    } 
            }
            else
            {  //utilizar el id_definicion_formulario que cooresponde por la tabla de localizaciones
                $this->id_definicion_formulario = $id_definicion_formulario2;
            }

            $F=Definicion_Formulario::findOrFail($this->id_definicion_formulario);

            //paso los datos de definicion_formulario guardado a las propiedades de la instancia creada        
            $this->nombre = $F->nombre;
            $this->nombre_corto = $F->nombre_corto;
            $this->descripcion = $F->descripcion;
            $this->color = $F->color;
            //$this->id_definicion_formulario = $F->id_definicion_formulario;
            //$this->id_periodo = $F->id_periodo;
            //$this->created_at = $F->created_at;
            //$this->update_at = $F->update_at;


            //propiedades de datos
                // recuperar
            $D = Datos_formulario::firstOrCreate
                   (['id_definicion_formulario' => $this->id_definicion_formulario,   //clave acceso al formulario
                     'id_localizacion' => $id_localizacion ] ,   
                    // si no se encuentra se inicializa un nuevo formulario  con:
                    [ //'id_datos_formulario' => $this->id_datos_formulario  ,    // es autonumérico    
                      'c_estado_formulario'=>70  //vacio             
                      ,'fecha_inicio_carga'=> date("Y/m/d") //date(now)
                      ,'fecha_fin_carga'=> null
                      ,'fecha_recepcion_UE'=>null
                      ,'id_usuario'=> Auth:user()->id
                      // ,'created_at'=> '', 'updated_at'=> ''                  
                    ] );

                   // asignarlas al objeto formulario

            $this->id_datos_formulario=$D->id_datos_formulario;
            //$this->id_definicion_formulario=$D->id_definicion_formulario     //ya esta asignado
            //$this->id_localizacion = $D->id_localizacion;         //ya esta asignado          

            $this->c_estado_formulario = $D->c_estado_formulario;
            $this->fecha_inicio_carga = $D->fecha_inicio_carga;
            $this->fecha_fin_carga = $D->fecha_fin_carga;
            $this->fecha_recepcion_UE = $D->fecha_recepcion_UE;
            $this->id_usuario = $D->id_usuario;
            //$this->created_at = $D->created_at;  $this->updated_at = $D->updated_at;
        

                // otras propiedades
                // recuperar los cuadros
            $this->cuadros= DatosCuadroController::dat_cuadro_get_cuadros_formulario($D->id_datos_formulario, $F->id_definicion_formulario,$F->$ofertas);


            DB::commit();  // Transaction successful. 
        }
        catch (\Exception $e)
        {   DB::rollback();  // Transaction failed. 
        }


    }
*/
    /**
     * Correr las validaciones de un cuadro
     * actualizar estados de error de cuadro y celdas
     */
    public function consistir_formulario()  {
       if ($this->c_estado_formulario==70) { return; }  // si el formulario esta vacio no aplicamos consistencias
        $ef=0; // inicializa con  formulario sin estado
        foreach ($this->cuadros as $cua)  { 
               	self::consistir_cuadro($cua->numero,false) ;
               	$ec=$cua->c_estado_cuadro;
               	$ec= ($ec==85 or $ec==87) ? 90 : $ec ; // reasignar cuadro 85 y 87 ("completo sin información") como 90 ("completo")
              	if ($ef!=0) { // si ya se evaluo algun cuadro                	
						if ($ec==70 and $ef!=70)  //estado_cuadro=vacio and estado_formulario!=vacio (70)
							{$ec=40;}  //estado_cuadro=en carga (40)
						elseif (($ec==80 or $ec==90) and !($ef==80 or $ef==90))  //estado_cuadro=completo y  and estado_formulario!=completo  (80/90)
							{$ec=40;}  //estado_cuadro=en carga (40)
                	}               
            	$ef= ($ef==0 or $ec<$ef) ? $ec : $ef;  // actualiza estado formulario si no hay estado anterior o  el estado es menor que el asignado 
            }
         if ($ef>=80 and $this->c_estado_formulario == 100) // si el formulario estaba confirmado y se consistio como completo lo dejamos confirmado
            {   $ef=100;
            } 
        if ($this->c_estado_formulario >= 10) //errores menores de 10 no se sobreescriben
			{
			 	$this->c_estado_formulario = ($ef !=0) ? $ef : 110; //por las dudas cheque que no haya encontrado un estado válido
			}
    }

    /**
     * funcion para consistir los datos de un cuadro a partir de un array
     * del tipo: $input [$cuadro][$fila][$columna] = $valor
     * ejemplo $input[3][4][1] = 23; (cuadro 3, fila 4, columna 1 con valor 23)
     * param Array con los datos a cargar en los cuadros.
     * acepta multiples cuadros en el array     
     */

    public function consistir_cuadros_editados($input)  {         
        if ($this->c_estado_formulario==70)    { return; } // si el formulario esta vacio no aplicamos consistencias         

        $ef=0; // inicializa con  formulario sin estado
        foreach ($this->cuadros as $cua)  {    
                if (isset($input[$cua->numero])) // si el input tiene el cuadro, hay que consistir el formulario
                {    
                    self::consistir_cuadro($cua->numero,true) ;
                }

                $ec=$cua->c_estado_cuadro;
                $ec= ($ec==85 or $ec==87) ? 90 : $ec ; // reasignar cuadro 85 y 87 ("completo sin información") como 90 ("completo")

                if ($ef!=0) // si ya se evaluo algun cuadro
                {
                    if ($ec==70 and $ef!=70)  //estado_cuadro=vacio and estado_formulario!=vacio (70)
                        {   $ec=40;}  //estado_cuadro=en carga (40)
                    elseif (($ec==80 or $ec==90) and !($ef==80 or $ef==90))  //estado_cuadro=completo y  and estado_formulario!=completo  (80/90)
                        {   $ec=40;}  //estado_cuadro=en carga (40)
                }               
                $ef= ($ef==0 or $ec<$ef) ? $ec : $ef;  // actualiza estado formulario si no hay estado anterior o  el estado es menor que el asignado 
            }
        if ($ef>=80 and $this->c_estado_formulario >= 100) // si el formulario estaba confirmado y se consistio como completo lo dejamos vino
            {   $ef=$this->c_estado_formulario;
            }        
        if ($this->c_estado_formulario >= 10) //errores menores de 10 no se sobreescriben
            {
                $this->c_estado_formulario = ($ef !=0) ? $ef : 110; //por las dudas cheque que no haya encontrado un estado válido
            }      
    }

	 /**
     * Aplicar las consistencias de un cuadro 
     * actualizar estados de error de cuadro y celdas
     * parametros
     *      ncuadro = numero de cuadro a consistir
     *      consistir_dependientes indica si se deben consistir los cuadros dependientes (true) o solo el cuadro dado (false)     
    */
     
    public function consistir_cuadro($ncuadro,$consistir_dependientes) {
    $C=$this->cuadros[$ncuadro];

        if ($C->c_estado_cuadro==70)   // si el cuadro esta vacio no aplicamos consistencias
            {   return;
            }

        if ($C->c_estado_cuadro==85 or $C->c_estado_cuadro==87) // cuadro sin informacion , no hay que consistirlo
        {	
        	// recorremos el cuadro para limpiar valores viejos en el modelo inicializando a vacio
        	for ($fil=1; $fil<count($C->celdas)+1; $fil++)
		        {
		            for ($col=1; $col<count($C->celdas[$fil])+1; $col++)
		            {
		                if ($C->celdas[$fil][$col]->editable or $C->celdas[$fil][$col]->tipo_dato=='total_calculado' )
		                {
                                $C->celdas[$fil][$col]->valor=( (strtolower($C->celdas[$fil][$col]->tipo_dato)=='combobox')
                                                                 or (strtolower($C->celdas[$fil][$col]->tipo_dato)=='radio')) ? '': $C->celdas[$fil][$col]->valor_inicial;
		                        $C->celdas[$fil][$col]->msg='cuadro sin información';
		                        $C->celdas[$fil][$col]->c_categoria_consistencia=1; //1=ok
                        }
                    }
                }
            return;
        } 
        

        $cuadro_vacio=true; //flag para recalcular el estado de carga y error del cuadro 
        $cuadro_completo=true; //flag para recalcular el estado de carga y error del cuadro       

        // limpiar estado de error y advertencias en cuadro!
        $C->msg_err=[];
        $C->msg_adv=[];
        $C->c_estado_cuadro=200; // inicializado con un estado ivalido antes de verificar
        $c_error_completitud=0;
        $c_error_c_mapa=0;
        $c_datos = 0; //contador de celdas con datos
        $c_datosno0=0; //contador de celdas con datos no 0 or on

        // limpiar estado de error en celdas y verificar criterio de completitud!
        // dd($C->celdas);
        for ($fil=1; $fil<count($C->celdas)+1; $fil++)
        {
            for ($col=1; $col<count($C->celdas[$fil])+1; $col++)
            {  
                if ($C->celdas[$fil][$col]->editable)
                {  
                    //  verificar oferta valida         
                    if (!is_null($C->celdas[$fil][$col]->c_mapa) and !in_array($C->celdas[$fil][$col]->c_mapa, $C->mapa))  // hay oferta y no es valida, no corresponden datos de la celda
                    {  
                        if ($C->celdas[$fil][$col]->valor=='0') //limpiamos datos con 0 cuando la oferta no es válida
                        { 
                            $C->celdas[$fil][$col]->valor='';
                        } 
                        if (strlen($C->celdas[$fil][$col]->valor)!=0 and $C->celdas[$fil][$col]->valor!='false')// hay datos en la celda, cargo error de oferta en la celda
                            {   $C->celdas[$fil][$col]->msg='Esta celda no debe contener datos, falta oferta activa';
                                $C->celdas[$fil][$col]->c_categoria_consistencia=3; //3=error
                                $c_error_c_mapa++;

                            }
                        else  // se corrigio el error, pongo la celda ciega
                            {  $C->celdas[$fil][$col]->msg='';
                                $C->celdas[$fil][$col]->c_categoria_consistencia=1; //1=OK (antes de consistir)                          
                                $C->celdas[$fil][$col]->titulo=false;  //poner la celda ciega
                                $C->celdas[$fil][$col]->editable=false;
                                //dd($C);
                            }               

                    }
                    else // la oferta es válida y  corresponde cargar celda.
                    {
                        // verifica criterio de completitud;  1=todas las celdas del cuadro tienen que tener datos
                        //if ($C->c_criterio_completitud==1 and strlen($C->celdas[$fil][$col]->valor)==0)     // verifica criterio de completitud 
                        if (strlen($C->celdas[$fil][$col]->valor)==0 and $C->celdas[$fil][$col]->tipo_dato<>'textarea')
                        {
                            $C->celdas[$fil][$col]->msg='Esta celda tiene que tener datos';
                            $C->celdas[$fil][$col]->c_categoria_consistencia=3; //3=error
                            $c_error_completitud++;
                        }
                        else
                        {  
                            $C->celdas[$fil][$col]->msg='';
                            $C->celdas[$fil][$col]->c_categoria_consistencia=1; //1=OK (antes de consistir)
                        }

                    } 

/*             	
               // verifica criterio de completitud;  1=todas las celdas del cuadro tienen que tener datos
               if (strlen($C->celdas[$fil][$col]->valor)==0 and $C->celdas[$fil][$col]->tipo_dato<>'textarea')
                  {
                     $C->celdas[$fil][$col]->msg='Esta celda tiene que tener datos';
                     $C->celdas[$fil][$col]->c_categoria_consistencia=3; //3=error
                     $c_error_completitud++;
                  }
               elseif (!is_null($C->celdas[$fil][$col]->c_mapa)   //  verifica oferta valida
                                 and !in_array($C->celdas[$fil][$col]->c_mapa, $C->mapa))
                	{
                        if  (strlen($C->celdas[$fil][$col]->valor)!=0) // hay datos en la celda, cargo error de oferta en la celda
                        {   $C->celdas[$fil][$col]->msg='Esta celda no debe contener datos, falta oferta activa';
                            $C->celdas[$fil][$col]->c_categoria_consistencia=3; //3=error
                            $c_error_c_mapa++;
                        }
                     else  // se corrigio el error pongo la celda ciega
                        {  $C->celdas[$fil][$col]->msg='';                            
                        	$C->celdas[$fil][$col]->c_categoria_consistencia=1; //1=OK (antes de consistir)                          
                        	$C->titulo=false;  //poner la celda ciega
                        	$C->editable=false;
                    		}               		
                	}                    
               else
                  {  $C->celdas[$fil][$col]->msg='';
                     $C->celdas[$fil][$col]->c_categoria_consistencia=1; //1=OK (antes de consistir)
                  }
*/

                    if (strlen($C->celdas[$fil][$col]->valor)!=0 and $C->celdas[$fil][$col]->valor!='false')
                    { // incrementar contador de celdas con datos
                        $c_datos++;
                        if ($C->celdas[$fil][$col]->valor!='0') 
                        {
                            $c_datosno0++;
                        } //incrementar contador de celdas con dato distinto de  '0'
                    } // contador de celdas vacias y con datos cero 
                }            
            } //columnas
        } //filas
  		
      $cuadro_completo = ($c_error_completitud==0);
  		$cuadro_vacio = ($c_datos==0);

        foreach ($C->consistencias->consistencias as $cons)
        {    
        	// aplicar las consistencias
            //la consistencia 11 de (consistir cuadros dependientes) solo se aplica cuando $consistir_dependientes=true
            // y vale true cuando se consisten_cuadros_editados y false cuando se consiste el formulario completo
            // para evitar consistir mas de una vez los cuadros dependientes
           if ($cons->c_tipo_consistencia!=11 or $consistir_dependientes)  
           {
               $vari='consistencia_'.$cons->c_tipo_consistencia;           
               $this->$vari($cons,$ncuadro,$c_datosno0); 
           }
           
        }

        // determinar el estado del cuadro si no hay errores o advertencias        
        //_estado_cuadro =200 si no se encontraron errores o advertencias en las reglas    

 		//hasta aqui c_estado_cuadro vale:
		// 200 si no se encontraron errores o advertencias en las reglas    
		// 20 si se encontraron errores en las reglas
		// 30 si se encotraron advertencias en las reglas

        if ($c_error_c_mapa!=0) {
            $C->msg_err[]='Hay '. $c_error_c_mapa . ' celdas que no deberian tener datos por no tener oferta activa válida ' ;
            $C->c_estado_cuadro=10; //10=con error de oferta, (si se encontró error de oferta)
        }
        elseif ($c_error_completitud!=0) {
           $C->msg_err[]='Hay '. $c_error_completitud . ' celdas vacias que tienen que tener datos ' ;
           $C->c_estado_cuadro=20; //20=con error,  (si no cumple ecriterio de completitud)
        }
        elseif ($C->c_estado_cuadro==200 and $cuadro_vacio) { 
        	$C->c_estado_cuadro=70;  //70=vacio, (si esta vacio y no tiene errores o adv.)
        }
        elseif ($C->c_estado_cuadro==200 and !$cuadro_completo and !$cuadro_vacio) {
        	$C->c_estado_cuadro=40; // 40=en carga (si no esta completo y no esta vacio y no tiene errores o adv.)
        }        
        elseif ($C->c_estado_cuadro==30 and $cuadro_completo) {
        	$C->c_estado_cuadro=80; // 80=completo con adv. (tiene adv. y esta completo )
        }
         elseif ($C->c_estado_cuadro==200 and $cuadro_completo) {
        	$C->c_estado_cuadro=90; // 90=completo (si no tiene errores o adv. y esta completo)
        }

        // if ($c_error_completitud!=0) 
        //     {   $C->msg_err[]='Hay '. $c_error_completitud . ' celdas vacias que tienen que tener datos ' ;
        //         $C->c_estado_cuadro=20; }
        // if ($c_error_c_mapa!=0)
        //     {   $C->msg_err[]='Hay '. $c_error_c_mapa . ' celdas que no deberian tener datos por no tener oferta activa válida ' ;
        //         $C->c_estado_cuadro=10; }
        // $C->c_estado_cuadro = ($C->c_estado_cuadro==200 and $cuadro_vacio) ? 70 : $C->c_estado_cuadro ; //vacio (si esta vacio y no tiene errores o adv.)    
        // $C->c_estado_cuadro = ($C->c_estado_cuadro==200 and !$cuadro_completo and !$cuadro_vacio) ? 40 : $C->c_estado_cuadro ;  // en carga (si no esta completo y no esta vacio y no tiene errores o adv.)
        // $C->c_estado_cuadro = ($C->c_estado_cuadro==200 and $cuadro_completo) ? 90 : $C->c_estado_cuadro ; // completo (si esta completo y no tiene errores o adv.)
        // $C->c_estado_cuadro = ($C->c_estado_cuadro==30 and $cuadro_completo) ? 80: $C->c_estado_cuadro ; // completo con advertencias 

    }






//////////////////////7
//XXXXXXXXXXXXXXXXXXXXX
//////////////////////7       

public function consistencia_10 ($cons,$ncuadro,$c_datosno0)
	{       // consistencia de cuadro con datos no 0 or on
		$C=$this->cuadros[$ncuadro];

  //      if ($ncuadro==13) { dd($c_datosno0);}
	    if ($c_datosno0==0)  // consistencia de cuadro con datos no 0 or on
	    {
	        // cargar el error o adv. encontrada en el cuadro
	        if ($cons->c_categoria_consistencia==3) // consistencia de error
	        {   // agregar error en cuadro
	            $C->msg_err[]=$cons->msg1;
	            $C->c_estado_cuadro=($C->c_estado_cuadro>20 ) ? 20: $C->c_estado_cuadro; //20 En carga con errores
	        }
	        else // consistencia de advertencia
	        {
	            // agregar advertencia al cuadro
	            $C->msg_adv[]=$cons->msg1;
	            $C->c_estado_cuadro=($C->c_estado_cuadro>30 ) ? 30: $C->c_estado_cuadro; //30 En carga con advertencias
	        }                
	    } // consistencia de cuadro con datos no 0 or on
    }


//////////////////////7
//XXXXXXXXXXXXXXXXXXXXX
//////////////////////7
// consistir los cuadros dependientes
public function consistencia_11 ($cons,$ncuadro,$c_datosno0)
            // aplicar consistencias de fila 13
   {
      $r1= unserialize($cons->cmp1);
      //$C=$this->cuadros[$ncuadro];    
      foreach ( $r1['cua'] as $c)  // para cada cuadro dependiente
      {   //consistir el cuadro dependiente
         $old_estado=$this->cuadros[$c]->c_estado_cuadro; // estado antes de consistir el cuadro
         self::consistir_cuadro($this->cuadros[$c]->numero,false) ; // consistimos el cuadro
         if ($old_estado!=$this->cuadros[$c]->c_estado_cuadro) 
         { // el estado del cuadro  cambio, lo grabamos en la base!!!!
            $this->cuadros[$c]->save_estado();
         }
      } //otro cuadro dependiente
   }


//////////////////////7
//XXXXXXXXXXXXXXXXXXXXX
//////////////////////7

public function consistencia_13 ($cons,$ncuadro,$c_datosno0)
            // aplicar consistencias de comparaciones x fila 13
    {

	            $r1= unserialize($cons->cmp1);
	            $r2= unserialize($cons->cmp2);
	            $r3= unserialize($cons->cmp3);
	            $C=$this->cuadros[$ncuadro];

              $signo= isset($r3['sig']) ? $r3['sig'] : '<>';

                for ($fil=1; $fil<count($C->celdas)+1; $fil++)
                {   //echo ' consistencia: '. $cons->descripcion .' <BR>';
                    $s1= $C->c_suma([ 'fil'=>[$fil] , 'col'=>$r1['col'] ]);
                    $s2= $C->c_suma([ 'fil'=>[$fil] , 'col'=>$r2['col'] ]);

                    if ($signo=='>')      { $fallo= ($s1 > $s2);}
                      elseif ($signo=='<>')  { $fallo= ($s1 <> $s2);}
                      elseif ($signo=='=')    { $fallo= ($s1 = $s2);}

                    if ($fallo)

                    {   $msg=$cons->msg1.' ('.$s1.') '.$cons->msg2.' ('.$s2.')';
                        foreach ($r1['col'] as $col)
                        {   //marcar celda con error del grupo 1
                            //echo 'Fila: '.($fil).' columna: '.$col.'  valor: '. $C->celdas[$fil][$col]->valor .$msg.' id_error:'.$cons->c_categoria_consistencia.'<BR>';
                            if ($C->celdas[$fil][$col]->c_categoria_consistencia==1)  // 1 celda ok, no otros reescribo errores
                            {   $C->celdas[$fil][$col]->msg=$msg;
                                $C->celdas[$fil][$col]->c_categoria_consistencia=($cons->c_categoria_consistencia);
                            }
                        }
                        
                        foreach ( $r2['col'] as $col)
                        {   //marcar celda con error del grupo 2                            
                            //echo 'Fila: '.($fil).' columna: '.$col.'  valor: '. $C->celdas[$fil][$col]->valor .$msg.' id_error:'.$cons->c_categoria_consistencia.'<BR>';
                            if ($C->celdas[$fil][$col]->c_categoria_consistencia==1)  // 1 celda ok, no otros reescribo errores
                            {
                                $C->celdas[$fil][$col]->msg=$msg;
                                $C->celdas[$fil][$col]->c_categoria_consistencia=($cons->c_categoria_consistencia);
                            }
                        } 

                        if ($cons->c_categoria_consistencia==3) // consistencia de error
                        {   // agregar error en cuadro
                            $C->msg_err[]=$msg;
                            $C->c_estado_cuadro=($C->c_estado_cuadro>20 ) ? 20: $C->c_estado_cuadro; //20 En carga con errores
                        }
                        else // consistencia de advertencia
                        {
                            // agregar advertencia al cuadro
                            $C->msg_adv[]=$msg;
                            $C->c_estado_cuadro=($C->c_estado_cuadro>30 ) ? 30: $C->c_estado_cuadro; //30 En carga con advertencias
                        }
                    }        
                }                 
    } // consistencia de Filas


//////////////////////7
//XXXXXXXXXXXXXXXXXXXXX
//////////////////////7

public function consistencia_14 ($cons,$ncuadro,$c_datosno0)
    // aplicar consistencia 14 para re-calculo de totales x fila y column
    // consistencia 14 para re-calculo de totales x fila y columna 
    {
	            $r1= unserialize($cons->cmp1);
	            $r2= unserialize($cons->cmp2);
	            $r3= unserialize($cons->cmp3);
	            $C=$this->cuadros[$ncuadro];

		        if (isset($r1['col'] )) // si hay columnas para calcular total
		        {
		            for ($fil=1; $fil<count($C->celdas)+1; $fil++) // recorro las filas calculando los totales que correspondan
					{
						foreach ($r1['col'] as $i => $col) // para cada columna de total a calcular
		                    { 	//dd($col);
			                    if ($C->celdas[$fil][$col]->tipo_dato=='total_calculado') // es una celda de total calculado
			                    	{
			                    		$t= $C->c_suma([ 'fil'=>[$fil] , 'col'=>$r2['scol'][$i]]); // calculo la suma de las columnas que corresponden seguún scol
			                    		$C->celdas[$fil][$col]->valor=$t;	//asignamos el total calculado
			                    	}
		                	}
		        	}
		    	} // totales x columnas

		    	if (isset($r1['fil'] ) )// si hay filas para calcular total
		        {
		            for ($col=1; $col<count($C->celdas[1])+1; $col++) // recorro las filas calculando los totales que correspondan
					{
						foreach ($r1['fil'] as $f => $fil) // para cada fila de total a calcular
	                    {	if ($fil==0)
	                      	{	
	                      		$fil=count($C->celdas)+1;  // si es fila 0 , reposiciono a última fila del cuadro. y sumamos todas las celdas de datos de la columna
	                      		if ($C->celdas[$fil][$col]->tipo_dato=='total_calculado') // es una celda de total calculado
	                      		{
	                          		$t=0;
	                          		for ($i=1; $i<count($C->celdas); $i++) // recorro las filas calculando el total.
	                          		{	if ($C->celdas[$i][$col]->tipo_dato=='number' and is_numeric($C->celdas[$i][$col]->valor))
	                        			{	
	                        				$t=$t+$C->celdas[$i][$col]->valor;
	                        			}
	                          		}	                          		
	                          		$C->celdas[$fil][$col]->valor=$t;	//asignamos el total calculado
	                      		}
	                  		}
	                  		else
	                  		{	
	                  			$C->celdas[$fil][$col]->valor=$C->c_suma([ 'fil'=>$r2['sfil'][$f] , 'col'=>[$col]]); // calculo la suma de las columnas que corresponden seguún scol
	                  		}
	              		}
		      		}
		  		}
    } // consistencia 14 para re-calculo de totales x fila y columna 


//////////////////////7
//XXXXXXXXXXXXXXXXXXXXX
//////////////////////7


public function consistencia_16 ($cons,$ncuadro,$c_datosno0)
    // aplicar consistencias de totales x columna (todas las filas)
    // para todas las celdas con datos, y comparar con la ultima fila de total
    // consistencia x columnas
    {
	            $r1= unserialize($cons->cmp1);
	            $r2= unserialize($cons->cmp2);
	            $r3= unserialize($cons->cmp3);
	            $C=$this->cuadros[$ncuadro];
    	

		        $tit=$r3['tit']; // recuperar el titulo de cada columna 
		        // sumar el total de todas las columnas con datos
		        $t=[];
		        for ($fil=1; $fil<count($C->celdas) ; $fil++)
		        {   
		            for ($col=1; $col<count($C->celdas[$fil])+1 ; $col++)
		            {   if ($C->celdas[$fil][$col]->editable and $C->celdas[$fil][$col]->tipo_dato=='number'and is_numeric($C->celdas[$fil][$col]->valor) )
		                {
		                    $t[$col]= isset($t[$col]) ? $t[$col] + $C->celdas[$fil][$col]->valor : $C->celdas[$fil][$col]->valor ;
		                }
		            }
		        }
		        // 
		        foreach ($t as $col => $tcol)
	            {   if (($C->celdas[count($C->celdas)][$col]->editable) and ($tcol <> $C->celdas[count($C->celdas)][$col]->valor) )
	                {   
	                    // marcar las celdas de la columna con error
	                    $msg=$cons->msg1.$tit[$col].' ('.$tcol.') '.$cons->msg2.' ('.$C->celdas[count($C->celdas)][$col]->valor.')';                            
	                    for ($fil=1; $fil<count($C->celdas)+1 ; $fil++)
                        {   if ($C->celdas[$fil][$col]->editable and $C->celdas[$fil][$col]->tipo_dato=='number'
                                   and  ($C->celdas[$fil][$col]->c_categoria_consistencia==1) ) // 1 celda ok, no reescribo otros errores previos
	                        {
	                            $C->celdas[$fil][$col]->msg=$msg;
	                            $C->celdas[$fil][$col]->c_categoria_consistencia=($cons->c_categoria_consistencia);
	                        }                   
	                    } 

	                    // cargar el error o adv. encontrada en el cuadro
	                    if ($cons->c_categoria_consistencia==3) // consistencia de error
	                    {   // agregar error en cuadro
	                        $C->msg_err[]=$msg;
	                        $C->c_estado_cuadro=($C->c_estado_cuadro>20 ) ? 20: $C->c_estado_cuadro; //20 En carga con errores
	                    }
	                    else // consistencia de advertencia
	                    {
	                        // agregar advertencia al cuadro
	                        $C->msg_adv[]=$msg;
	                        $C->c_estado_cuadro=($C->c_estado_cuadro>30 ) ? 30: $C->c_estado_cuadro; //30 En carga con advertencias
	                    }     

	                }
	            }
         
    } //  totales x columna (todas las filas)



//////////////////////7
//XXXXXXXXXXXXXXXXXXXXX
//////////////////////7



public function consistencia_18 ($cons,$ncuadro,$c_datosno0)
    // aplicar consistencias de chkbox validar una opcion tildada
    // y validar celdas que habilitan la carga/tide de otras celdas en dat []
   {
      $r1= unserialize($cons->cmp1);
      $r2= unserialize($cons->cmp2);
      $r3= unserialize($cons->cmp3);
      $C=$this->cuadros[$ncuadro];

      foreach ($r1['chk'] as $i1 => $gchk)  // por cada grupo de celdas a checkear
      { 
         $t=0; // contador de celdas tildadas
         foreach ($gchk as $i2 => $cel)
         {
            if ($C->celdas[$cel[0]][$cel[1]]->valor !='false' )
            { 
               $t=$t+1;
            }
         } // buscar otra celda del grupo
         if ($t>1) // hay mas de una celda chequeada
         { // marcar las celdas del grupo con error 
            foreach ($gchk as $i2 => $cel)
            {              
               if ($C->celdas[$cel[0]][$cel[1]]->editable
                     and $C->celdas[$cel[0]][$cel[1]]->tipo_dato=='checkbox'
                     and $C->celdas[$cel[0]][$cel[1]]->valor!='false')
               {
                  $C->celdas[$cel[0]][$cel[1]]->msg=$r3['mch'][$i1];
                  $C->celdas[$cel[0]][$cel[1]]->c_categoria_consistencia=($cons->c_categoria_consistencia);
               }                   
            }  // buscar otra celda del grupo 

            // cargar el error o adv. encontrada en el cuadro
            if ($cons->c_categoria_consistencia==3) // consistencia de error
            {   // agregar error en cuadro
               $C->msg_err[]=$r3['mch'][$i1];
               $C->c_estado_cuadro=($C->c_estado_cuadro>20 ) ? 20: $C->c_estado_cuadro; //20 En carga con errores
            }
            else // consistencia de advertencia
            {
               // agregar advertencia al cuadro
               $C->msg_adv[]=$r3['mch'][$i1];
               $C->c_estado_cuadro=($C->c_estado_cuadro>30 ) ? 30: $C->c_estado_cuadro; //30 En carga con advertencias
            }
         }  // marcar las celdas del grupo con error   

      } // buscar otro grupo de celdas a validar

      // validar celdas habilitadas x tilde
      foreach ($r2['ckp'] as $i1 => $gchp)  // por cada grupo de celdas a checkear
      {  $ms='';
         foreach ($r2['chi'][$i1] as $i2 => $cel) // para cada celda hija del
         {  
            if (($this->cuadros[$gchp[0]]->celdas[$gchp[1]][$gchp[2]]->valor=='on') // la celda padre está chequeada
               and (strlen($C->celdas[$cel[0]][$cel[1]]->valor)==0 or $C->celdas[$cel[0]][$cel[1]]->valor=='false')) // la celda hija esta vacia
            {
               $C->celdas[$cel[0]][$cel[1]]->msg=$r3['mc1'][$i1];
               $ms=$r3['mc1'][$i1];
               $C->celdas[$cel[0]][$cel[1]]->c_categoria_consistencia=($cons->c_categoria_consistencia);
            }
            elseif (($this->cuadros[$gchp[0]]->celdas[$gchp[1]][$gchp[2]]->valor=='false') // la celda padre está chequeada
                     and (strlen($C->celdas[$cel[0]][$cel[1]]->valor)!=0 and $C->celdas[$cel[0]][$cel[1]]->valor!='on')) // la celda hija esta vacia
            {
               $C->celdas[$cel[0]][$cel[1]]->msg=$r3['mc0'][$i1];
               $ms=$r3['mc0'][$i1];
               $C->celdas[$cel[0]][$cel[1]]->c_categoria_consistencia=($cons->c_categoria_consistencia);
            }
         } // validar otra celda
         if ($ms!='')
         {
            // cargar el error o adv. encontrada en el cuadro
            if ($cons->c_categoria_consistencia==3) // consistencia de error
            {   // agregar error en cuadro
               $C->msg_err[]=$ms;
               $C->c_estado_cuadro=($C->c_estado_cuadro>20 ) ? 20: $C->c_estado_cuadro; //20 En carga con errores
            }
            else // consistencia de advertencia
            {
               // agregar advertencia al cuadro
               $C->msg_adv[]=$ms;
               $C->c_estado_cuadro=($C->c_estado_cuadro>30 ) ? 30: $C->c_estado_cuadro; //30 En carga con advertencias
            }
         }



      } // buscar otro grupo.

   } //  function consistencia_18



//////////////////////7
//XXXXXXXXXXXXXXXXXXXXX
//////////////////////7







public function consistencia_20 ($cons,$ncuadro,$c_datosno0)
    //// consistencia de comparación de desigualdad (<>) de la suma de dos conjuntos de celdas de un mismo cuadro
    // (suma las celdas de las filas pasadas en cmp1 ->fil  y las compara con cmp2 ->fil de cada columna 
    // para cada columna, comparando solo las filas indicadas en cmp1 y cmp2
    // 
    {
	            $r1= unserialize($cons->cmp1);
	            $r2= unserialize($cons->cmp2);
	            $r3= unserialize($cons->cmp3);
	            $C=$this->cuadros[$ncuadro];
                dd($C);
		        for ($col=1; $col<count($C->celdas[1])+1; $col++)
		        {   //echo ' consistencia: '. $cons->descripcion .' <BR>';
		            $s1= $C->c_suma([ 'col'=>[$col] , 'fil'=>$r1['fil'] ]);
		            $s2= $C->c_suma([ 'col'=>[$col] , 'fil'=>$r2['fil'] ]);

		            if ($s1<>$s2)
		            {   $msg=$cons->msg1.' ('.$s1.') '.$cons->msg2.' ('.$s2.')';
		                foreach ($r1['fil'] as $fil)
		                {   //marcar celda con error del grupo 1
                            //echo 'Fila: '.($fil).' columna: '.$col.'  valor: '. $C->celdas[$fil][$col]->valor .$msg.' id_error:'.$cons->c_categoria_consistencia.'<BR>';
                            if ($C->celdas[$fil][$col]->c_categoria_consistencia==1 ) // 1 celda ok, no reescribo otros errores previos
		                        {   $C->celdas[$fil][$col]->msg=$msg;
                                    $C->celdas[$fil][$col]->c_categoria_consistencia=($cons->c_categoria_consistencia);
                                }
		                }
		                
		                foreach ( $r2['fil'] as $fil)
		                {   //marcar celda con error del grupo 2                            
		                    //echo 'Fila: '.($fil).' columna: '.$col.'  valor: '. $C->celdas[$fil][$col]->valor .$msg.' id_error:'.$cons->c_categoria_consistencia.'<BR>';
                            if ($C->celdas[$fil][$col]->c_categoria_consistencia==1) // 1 celda ok, no reescribo otros errores previos
                            {   $C->celdas[$fil][$col]->msg=$msg;
                                $C->celdas[$fil][$col]->c_categoria_consistencia=($cons->c_categoria_consistencia);
                            }
		                } 

		                if ($cons->c_categoria_consistencia==3) // consistencia de error
		                {   // agregar error en cuadro
		                    $C->msg_err[]=$msg;
		                    $C->c_estado_cuadro=($C->c_estado_cuadro>20 ) ? 20: $C->c_estado_cuadro; //20 En carga con errores
		                }
		                else // consistencia de advertencia
		                {
		                    // agregar advertencia al cuadro
		                    $C->msg_adv[]=$msg;
		                    $C->c_estado_cuadro=($C->c_estado_cuadro>30 ) ? 30: $C->c_estado_cuadro; //30 En carga con advertencias
		                }
		            }        
		        }                 
    } // consistencia x columnas (de algunas filas)





//////////////////////7
//XXXXXXXXXXXXXXXXXXXXX
//////////////////////7

public function consistencia_21 ($cons,$ncuadro,$c_datosno0)
    // comparación de la suma de un conjunto de celdas pasados en cmp1-r1 de relación  mayor / menor
    // consistencia de comparacion menor val1<val2
    // 
    {
                $r1= unserialize($cons->cmp1);
                $r2= unserialize($cons->cmp2);
                $r3= unserialize($cons->cmp3);
                $C=$this->cuadros[$ncuadro];


                for ($i=0; $i<count($r1['v1']); $i++)  // grupo de celdas a compara contra v2
                {   
                    $v1=$C->c_suma( ['cel' => $r1['v1'][$i]]);
                    $v2=$C->c_suma( ['cel' => $r2['v2'][$i]]);
             
                    // $this->f_suma($r1['v1'][$i]); //sumar valores de v2  (del formulario)
                    //$v2= $this->f_suma($r2['v2'][$i]); //sumar valores de v2  (del formulario) 
                    $signo= isset($r3['sig'][$i]) ? $r3['sig'][$i] : '>';
                    $marque_error=false; // bandera para determinar si encotro error y se marco alguna celda editable con error
                    if ($signo=='>')          { $fallo= ($v1 > $v2);}
                        elseif ($signo=='=')  { $fallo= ($v1 == $v2);}
                         elseif ($signo=='!=')    { $fallo= ($v1 != $v2);}

                    if ($fallo)
                    { // dd($r1,$r2,$v1,$v2);
                        $msg=$cons->msg1.' '.$r3['m1'][$i].' ('.$v1.') '. $cons->msg2.' '.$r3['m2'][$i]. ' ('. $v2.')';
                        //marcar celda de secciones independientes involucradas con error     
                        // chequeo de no no reescribir errores y no recargar antes              
                        foreach ($r1['v1'][$i] as $key => $v)                          
                            { if (($C->celdas[$v[0]][$v[1]]->c_categoria_consistencia==1)  // 1 celda ok
                                    and $C->celdas[$v[0]][$v[1]]->editable and $C->celdas[$v[0]][$v[1]]->tipo_dato=='number')
                                    {   $C->celdas[$v[0]][$v[1]]->msg=$msg;
                                        $C->celdas[$v[0]][$v[1]]->c_categoria_consistencia=($cons->c_categoria_consistencia);
                                        $marque_error=true; //
                                    }
                            }
                        foreach ($r2['v2'][$i] as $key => $v)                          
                            {   if (($C->celdas[$v[0]][$v[1]]->c_categoria_consistencia==1)  // 1 celda ok
                                    and $C->celdas[$v[0]][$v[1]]->editable and $C->celdas[$v[0]][$v[1]]->tipo_dato=='number')
                                    {   $C->celdas[$v[0]][$v[1]]->msg=$msg;
                                        $C->celdas[$v[0]][$v[1]]->c_categoria_consistencia=($cons->c_categoria_consistencia);
                                        $marque_error=true;
                                    }
                            }    
                        if ($marque_error)
                        {  // maracer el error en el cuadro
                            if ($cons->c_categoria_consistencia==3) // consistencia de error
                            {   // agregar error en cuadro
                                $C->msg_err[]=$msg;
                                $C->c_estado_cuadro=($C->c_estado_cuadro>20 ) ? 20: $C->c_estado_cuadro; //20 En carga con errores
                            }
                            else // consistencia de advertencia
                            {
                                // agregar advertencia al cuadro
                                $C->msg_adv[]=$msg;
                                $C->c_estado_cuadro=($C->c_estado_cuadro>30 ) ? 30: $C->c_estado_cuadro; //30 En carga con advertencias
                            }
                        }
                    } // $fallo
                }   
    } // consistencia 21 comparacion valores de celdas


//////////////////////7
//ZZZZZZZZZZZZZZZZZZZZZ
//////////////////////7







//////////////////////7
//XXXXXXXXXXXXXXXXXXXXX
//////////////////////7





public function consistencia_22 ($cons,$ncuadro,$c_datosno0)
	// aplicar consistencias de de cuadros secciones con cuadros de alumnos
	// consistencia de Secciones y alumnos
    {
	            $r1= unserialize($cons->cmp1);
	            $r2= unserialize($cons->cmp2);
	            $r3= unserialize($cons->cmp3);
                $C=$this->cuadros[$ncuadro];

    
                for ($i=0; $i<count($r1['alu']); $i++) // comparacion de nivel
                {   
            		$a =$r1['alu'][$i]; // recupera coordenadas de celdas de alumnos a evaluar
                    $s =$r2['sei'][$i]; // recuperar coordenadas de celda de seccion independiente a verificar
                    $sa=$r2['sea'][$i]; // recuperar coordenadas de celda de seccion agrupada a verificar
                    $sa2=isset($r2['sa2'][$i]) ? $r2['sa2'][$i] :[]; // recuperar celdas de seccion agrupada alternativas verificar
                    $m =$r3['des'][$i]; // recupera msg de error de cada año
  //if ($i>0) { dd($sa); } 
                    $ssa= $this->f_suma(['cel'=>$sa]); //sumar secciones agrp
                    $ssa2= $this->f_suma(['cel'=>$sa2]); //sumar secciones agrp. alternativas
                    $at=0; // suma total de alumnos

                    //$s1= suma de alumnosxaño
                	//$s2=secciones independientes del año $i
                	//$s3=secciones agrupadas (si existen) 
                    // chequea si ($s1=alumnosxaño<>0)  and (secciones indep.+agrup=0) es error
                    // o si (alumnosxaño=0) and  (secciones indep.<>0)

                    for ($anio=0; $anio<count($a); $anio++ ) // comparación por anio
                        {  
                //        dd($a[$anio]); 
                            if ( isset($a[$anio]['r'] ))
                            {  // dd($a[$anio]['r'][0][0] );                            
                                $ai= $this->f_suma(['reg'=>$a[$anio]['r'] ]); //sumar las regiones pasadas en el array (alumnos varones y mujeres del año)
                                $cuadro_alu=$a[$anio]['r'][0][0]; //recupero el nro de cuadro  del que provienen  los alumnos
                            }
                            else
                            {
                                $ai= $this->f_suma(['cel'=>$a[$anio]]); //sumar las celdas pasadas en el array (alumnos varones y mujeres del año)
                                $cuadro_alu=$a[$anio][0][0]; //recupero el nro de cuadro  del que provienen  los alumnos
                            }

                            $si= $this->f_suma(['cel'=>$s[$anio]]); //sumar secciones indep del anio
                            $at=$at+$ai; //calculamos el total de alumnos                            

                            if ((($ai<>0) and ($si+$ssa==0) and ($ssa2==0)) or (($ai==0) and ($si<>0) ) )                 	
                            {  
                            	// dd($cons->msg1, $cuadro_alu, $m[$anio], $ai,$cons->msg2,$si);
                            	$msg=$cons->msg1.'cuadro '.$cuadro_alu.'; '.$m[$anio].' = ('.$ai.') '.$cons->msg2.' = ('.$si.')';
        						//marcar celda de secciones independientes involucradas con error                    	
                        		foreach ($s[$anio] as $key => $v)                 			
        	                        {	$this->cuadros[$v[0]]->celdas[$v[1]][$v[2]]->msg=$msg;
        	                            $this->cuadros[$v[0]]->celdas[$v[1]][$v[2]]->c_categoria_consistencia=($cons->c_categoria_consistencia);
        	                        }
                                // agregar error en cuadro
                                $C->msg_err[]=$msg;
                                $C->c_estado_cuadro=($C->c_estado_cuadro>20 ) ? 20: $C->c_estado_cuadro; //20 En carga con errores
        						                            
                            }   
                        }     

                       
                    if ($at==0 and $ssa!=0) // si no ahy alumnos y hay secciones agrupadas marcamos error
                        {    //dd($m);
                            // poner mensaje segun el error
                            $msg='Si en cuadro '.$cuadro_alu.' no consigna alumnos, no debería declarar  ('.$ssa.') secciones agrupadas';
                            
                            //marcar celda de secciones agrupadas involucradas con error
                            foreach ($sa as $key => $v)
                                {   $this->cuadros[$v[0]]->celdas[$v[1]][$v[2]]->msg=$msg;
                                    $this->cuadros[$v[0]]->celdas[$v[1]][$v[2]]->c_categoria_consistencia=($cons->c_categoria_consistencia);
                                } 
                            // agregar error en cuadro
                            $C->msg_err[]=$msg;
                            $C->c_estado_cuadro=($C->c_estado_cuadro>20 ) ? 20: $C->c_estado_cuadro; //20 En carga con errores
                        }


                }                 
    } // consistencia de secciones

//////////////////////7
//XXXXXXXXXXXXXXXXXXXXX
//////////////////////7

public function consistencia_23 ($cons,$ncuadro,$c_datosno0)
	// de relación  mayor / menor
	// consistencia de relación  alumnos x seccion  <min >max
    {
	            $r1= unserialize($cons->cmp1);
	            $r2= unserialize($cons->cmp2);
	            $r3= unserialize($cons->cmp3);
	            $C=$this->cuadros[$ncuadro];

	                for ($i=0; $i<count($r1['num']); $i++)
	                {   
	                	  $min=$r2['min'][$i]; // recuperar coordenadas de celda de seccion agrupada a verificar
	                    $max=$r2['max'][$i]; // recuperar coordenadas de celda de seccion agrupada a verificar
	                    
                       // $num= $this->f_suma(['cel'=>$r1['num'][$i]]); //sumar de valores del numerador
                              //sumar de valores del numerador
                        if ( isset($r1['num'][$i]['r'] )) // por regiones o por celdas
                        {   
                            $num= $this->f_suma(['reg'=>$r1['num'][$i]['r'] ]); //sumar las celdas pasadas en el array (alumnos varones y mujeres del año)
                            //$cuadro_alu=$r1['num'][$i]['r'][0][0]; //recupero el nro de cuadro  del que provienen  los alumnos
                        }
                        else
                        {
                            $num= $this->f_suma(['cel'=>$r1['num'][$i]]); //sumar las celdas pasadas en el array (alumnos varones y mujeres del año)
                            //$cuadro_alu=$r1['num'][$i][0][0]; //recupero el nro de cuadro  del que provienen  los alumnos
                        }

	                   	$div= $this->f_suma(['cel'=>$r1['div'][$i]]); //sumar valores del divisor                    
//dd ($r1 ,$num, $div,$C);	                    
	            		//$num numerado
	                	//$div denominador
	                	//$min valor minimo de la relacion
	                    //$max valor maximo de la relacion
	                                        
	                    if (($div<>0) and (($num/$div < $min) or ( $num/$div > $max) )  )
	                           	
	                    {   
	                    	$msg=$cons->msg1.$r3['des'][$i].' ('.round($num/$div).') '. $cons->msg2. ' ('. $min. ' a '. $max.') '. $cons->msg3;
							//marcar celda de secciones independientes involucradas con error     
							// chequea de no no reescribir errores y no recargar               	
	                		foreach ($r1['div'][$i] as $key => $v)                 			
		                        {	if ($this->cuadros[$v[0]]->celdas[$v[1]][$v[2]]->c_categoria_consistencia==1) // 1 celda ok
		                        		{	$this->cuadros[$v[0]]->celdas[$v[1]][$v[2]]->msg=$msg;
	    		                            $this->cuadros[$v[0]]->celdas[$v[1]][$v[2]]->c_categoria_consistencia=($cons->c_categoria_consistencia);
	    		                        }
		                        }
							 
	                        if ($cons->c_categoria_consistencia==3) // consistencia de error
	                        {   // agregar error en cuadro
	                            $C->msg_err[]=$msg;
	                            $C->c_estado_cuadro=($C->c_estado_cuadro>20 ) ? 20: $C->c_estado_cuadro; //20 En carga con errores
	                        }
	                        else // consistencia de advertencia
	                        {
	                            // agregar advertencia al cuadro
	                            $C->msg_adv[]=$msg;
	                            $C->c_estado_cuadro=($C->c_estado_cuadro>30 ) ? 30: $C->c_estado_cuadro; //30 En carga con advertencias
	                        }

	                    }        
	                }                 
    } //consistencia de relación  alumnos x seccion  <min >max






//////////////////////7
//XXXXXXXXXXXXXXXXXXXXX
//////////////////////7

public function consistencia_24 ($cons,$ncuadro,$c_datosno0)
    // consistencia para verificar la carga de alumnos y secciones para CUADROS DE CANTIDAD DE ALUMNOS Y SECCIONES POR TURNO
    // recibe en cmp1 un arreglos de valores [[c1,c2]] con las parejas de columnas a comparar entre si

    // verifica que si hay datos en la columna c1 tambien haya datos en la columna c2 y viceversa
    // en cmp3 se puede usar pasar una columna alternativa [[c3]] para secciones multiplesy  si hay datos en c3 
    // no se exige datos en c2 

    {
                $r1= unserialize($cons->cmp1);
                $r2= unserialize($cons->cmp2);
                $r3= unserialize($cons->cmp3);
                $C=$this->cuadros[$ncuadro];
                $msg='Debe declarar alumnos y secciones';                
                $c_error=0;

                for ($f=1; $f<count($C->celdas)+1; $f++)  // para cada fila
                { 
                    for ($i2=0; $i2<count($r1); $i2++)  //par de columnas a comparar
                    {    
                        $c1=$r1[$i2][0]; // columna 1  
                        $c2=$r1[$i2][1]; // columna 2
                        $c3=isset($r2[$i2]) ?  $r2[$i2]:  $c2;  // celda alternativa para secciones agrupadas multinivel

                        if  ( ($C->celdas[$f][$c1]->tipo_dato=='number')
                            and ( (    // marcar error si hay alumnos en c1 y no hay secciones c2 
                                (strlen($C->celdas[$f][$c1]->valor)!=0 and $C->celdas[$f][$c1]->valor!='0') // hay alumnos
                                and (strlen($C->celdas[$f][$c2]->valor)==0 or $C->celdas[$f][$c2]->valor=='0') // no hay secciones
                                and (strlen($C->celdas[$f][$c3]->valor)==0 or $C->celdas[$f][$c3]->valor=='0') // no hay secc alternativas  
                                ) 
                                or
                                (   // marcar error sin hay secciones y no hay alumnos  en celdas
                                    (strlen($C->celdas[$f][$c1]->valor)==0 or $C->celdas[$f][$c1]->valor=='0') // no hay alumnos
                                    and (strlen($C->celdas[$f][$c2]->valor)!=0 and $C->celdas[$f][$c2]->valor!='0') // hay secciones
                                )
                                )
                            )
                            {      //      dd($C->celdas[$f][$c1]->valor);            
                                // marcar error de secciones sin alumnos en celdas
                                $C->celdas[$f][$c1]->msg=$msg . ' en '. $r3['msg'][$i2];
                                $C->celdas[$f][$c1]->c_categoria_consistencia=($cons->c_categoria_consistencia);
                                $C->celdas[$f][$c2]->msg=$msg . ' en '. $r3['msg'][$i2];
                                $C->celdas[$f][$c2]->c_categoria_consistencia=($cons->c_categoria_consistencia);
                                $c_error++;
                            }
                    } // otro par de columnas a comparar
                }   // otra fila

                if ($c_error!=0)
                {  //agregar error al cuadro
                    if ($cons->c_categoria_consistencia==3) // consistencia de error
                    {   // agregar error en cuadro
                        $C->msg_err[]=$msg;
                        $C->c_estado_cuadro=($C->c_estado_cuadro>20 ) ? 20: $C->c_estado_cuadro; //20 En carga con errores
                    }
                    else // consistencia de advertencia
                    {
                        // agregar advertencia al cuadro
                        $C->msg_adv[]=$msg;
                        $C->c_estado_cuadro=($C->c_estado_cuadro>30 ) ? 30: $C->c_estado_cuadro; //30 En carga con advertencias
                    }
                }

    } // consistencia de compararacion menor val1<val2

//////////////////////7
//ZZZZZZZZZZZZZZZZZZZZZ
//////////////////////7



//////////////////////7
//XXXXXXXXXXXXXXXXXXXXX
//////////////////////7

public function consistencia_25 ($cons,$ncuadro,$c_datosno0)
	// comparación de la suma de un conjunto de celdas pasados en cmp1-r1 de relación  mayor / menor
	// consistencia de comparacion menor val1<val2
    // 
    {
	            $r1= unserialize($cons->cmp1);
	            $r2= unserialize($cons->cmp2);
	            $r3= unserialize($cons->cmp3);
	            $C=$this->cuadros[$ncuadro];

                $signo= isset($r2['sig']) ? $r2['sig'] : '>';

                for ($i=0; $i<count($r1['v1']); $i++)  // grupo de celdas a compara contra v2
                { 
                    $v2= $this->f_suma($r2['v2'][$i]); //sumar valores de v2  (del formulario) 
                    
                    for ($i2=0; $i2<count($r1['v1'][$i]); $i2++)
                    {   //($r1['v1'][$i][$i2]);

                        $v1= $C->c_suma( ['cel' => $r1['v1'][$i][$i2] ]); //sumar de valores de v1  (dentro del cuadro)
  //dd($this->cuadros[12]);
  // if ($ncuadro==10) { dd($ncuadro, $v1 , $v2,$signo,$r1,$r2); } ;
                        if ($signo=='>') 		  { $fallo= ($v1 > $v2);}
                        	elseif ($signo=='=')  { $fallo= ($v1 == $v2);}
                        	 elseif ($signo=='!=')    { $fallo= ($v1 != $v2);}

                        if ($fallo)
                        {  //dd($r3['d1']);
                            $msg=$cons->msg1.' '.$r3['d1'][$i][$i2].' ('.$v1.') '. $cons->msg2.' '.$r3['d2'][$i][$i2]. ' ('. $v2.')';
                            //marcar celda de secciones independientes involucradas con error     
                            // chequeo de no no reescribir errores y no recargar antes              
                            foreach ($r1['v1'][$i][$i2] as $key => $v)                          
                                {   if ($C->celdas[$v[0]][$v[1]]->c_categoria_consistencia==1)  // 1 celda ok
                                        {   $C->celdas[$v[0]][$v[1]]->msg=$msg;
                                            $C->celdas[$v[0]][$v[1]]->c_categoria_consistencia=($cons->c_categoria_consistencia);
                                        }
                                }
                             
                            if ($cons->c_categoria_consistencia==3) // consistencia de error
                            {   // agregar error en cuadro
                                $C->msg_err[]=$msg;
                                $C->c_estado_cuadro=($C->c_estado_cuadro>20 ) ? 20: $C->c_estado_cuadro; //20 En carga con errores
                            }
                            else // consistencia de advertencia
                            {
                                // agregar advertencia al cuadro
                                $C->msg_adv[]=$msg;
                                $C->c_estado_cuadro=($C->c_estado_cuadro>30 ) ? 30: $C->c_estado_cuadro; //30 En carga con advertencias
                            }
                        }        
                    }                 
                }   
    } // consistencia de comparacion menor val1<val2



//////////////////////7
//XXXXXXXXXXXXXXXXXXXXX
//////////////////////7


public function consistencia_26 ($cons,$ncuadro,$c_datosno0)
    // aplicar consistencias de comapracion de celdas una a una entre cuadros de (todas las filas) para las columnas indicadas
    // para todas las celdas con datos, 
    // utiliza dos array con los titulos de las filas y columnas de donde construir el mensaje de error
    // consistencia x 
    
    /* parametros
    en cmp1
                ['cols']  // array de parejas de columnas a ser comparadas (una de cada tabla, 1° de este cuadro , 2° del otro cuadro) / opcional  / si se omite se comparan todas una a una
                ['fils']  // array de parejas de filas a ser comparadas (una de cada tabla, 1° de este cuadro , 2° del otro cuadro)  / opcional  / si se omite se comparan todas una a una
    en cmp2
                'cuadro'  // integer con el mumero del otro cuadro contra el que comparar ej 3
                'cmp'    // string con la operacion de la comparación ej '!='
    en cmp3 
                ['tcol'] // array de integer, com las columnas que contienen los titulos de las columnas para el msg
                ['tfil'] // array de integer, con columnas que contienen los titulos de las filas para el msg
                ['textc']// array de string con los texto de las columnas (opcional) para el mensaje
                ['textf']// array de string con de cada fila para el msg
    */

    {
        $r1= unserialize($cons->cmp1);
        $r2= unserialize($cons->cmp2);
        $r3= unserialize($cons->cmp3);
        $C=$this->cuadros[$ncuadro];

        $ncuadro_cmp= $r2['cuadro']; // cuadro contra el que comparar
        $cmp= isset($r2['cmp']) ? $r2['cmp'] : '!='; // operacion de la comparación
        $tit_col= isset($r3['tcol']) ? $r3['tcol'] : []; // filas que contienen los titulos de las columnas para el msg
        $tit_fil= isset($r3['tfil']) ? $r3['tfil'] : []; // columnas que contienen los titulos de las filas para el msg
        $tf= isset($r3['textf']) ? $r3['textf'] : []; // texto de cada fila para el msg
        $tc= isset($r3['textc']) ? $r3['textc'] : []; // texto de cada columna para el msg

        if (isset($r1['cols']))  // recupero el array de parejas de columnas a ser comparadas (una de cada tabla)
            { $par_col= $r1['cols'];             
            }
        else  // si no hay array comparo todas las columnas una a una de ambos tablas
            {   $par_col=[];
                for ($col=1; $col<count($C->celdas[1])+1; $col++) // recorro las filas calculando los totales que correspondan
                    {   $par_col[]=[$col,$col];
                    }
            }
        if (isset($r1['fils']))  // recupero el array de parejas de filas a ser comparadas (una de cada tabla)
            {   $par_fil= $r1['fils'];                        
            }
        else  // si no hay array comparo todas las columnas una a una de ambos tablas
            {   $par_fil=[];
                for ($fil=1; $fil<count($C->celdas)+1; $fil++) // recorro las filas calculando los totales que correspondan
                    {
                        $par_fil[]=[$fil,$fil];
                    }
            }

        // recorremos todas las filas  a comparar
        foreach ($par_fil as $fil => $pfil)
        {   
            foreach ($par_col as $col => $pcol)	// recorremos todas las columnas a comparar ($pcol es un array con la pareja de columnas a comparar)	            
            {   if ($C->celdas[$pfil[0]][$pcol[0]]->editable and $C->celdas[$pfil[0]][$pcol[0]]->tipo_dato=='number'and is_numeric($C->celdas[$pfil[0]][$pcol[0]]->valor) )
                {
                    $v1=$C->celdas[$pfil[0]][$pcol[0]]->valor;
                    $v2=$this->cuadros[$ncuadro_cmp]->celdas[$pfil[1]][$pcol[1]]->valor;
                    if ($cmp=='>') 		 { $fallo= ($v1 > $v2);}
                    elseif ($cmp=='=')   { $fallo= ($v1 == $v2);}
                     elseif ($cmp=='!=') { $fallo= ($v1 != $v2);}

                    if ($fallo)
                    {  //dd($r3['d1']);
                        // armar el texto del mensaje de error con los titulos de filas y columnas dadas
                        $m=(array_key_exists($fil, $tf)) ? $tf[$fil]:''; // recupero el titulo de la filas pasado
                        
                        foreach ($tit_fil as $i) { $m.= (($m=='')? '':' / ') . $C->celdas[$pfil[0]][$i]->valor; } // recuperar los texto de las filas pasadas en $tit_fil
                        $m.= (array_key_exists($col, $tc)) ? (($m=='')? '':' / ').$tc[$col] :''; // recupero el titulo de la columna pasado
                        foreach ($tit_col as $i) { $m.= (($m=='')? '':' / ') . $C->celdas[$i][$pcol[0]]->valor; } // recuperar los textos de las filas pasadas en $tit_col

                        $msg=$cons->msg1.' '.$m.' ('.$v1.') '. $cons->msg2.' ('. $v2.')';
                        //marcar celda con error     
                        // chequeo de no no reescribir errores y no recargar antes              
                        if ($C->celdas[$pfil[0]][$pcol[0]]->c_categoria_consistencia==1)  // 1 celda ok
                            {   $C->celdas[$pfil[0]][$pcol[0]]->msg=$msg;
                                $C->celdas[$pfil[0]][$pcol[0]]->c_categoria_consistencia=($cons->c_categoria_consistencia);
                            }
                
                        if ($cons->c_categoria_consistencia==3) // consistencia de error
                        {   // agregar error en cuadro
                            $C->msg_err[]=$msg;
                            $C->c_estado_cuadro=($C->c_estado_cuadro>20 ) ? 20: $C->c_estado_cuadro; //20 En carga con errores
                        }
                        else // consistencia de advertencia
                        {
                            // agregar advertencia al cuadro
                            $C->msg_adv[]=$msg;
                            $C->c_estado_cuadro=($C->c_estado_cuadro>30 ) ? 30: $C->c_estado_cuadro; //30 En carga con advertencias
                        }
                    }        


                }
            }
        }
        // 
 
} //  consistencia 26 comparacion de columnas






//////////////////////7
//XXXXXXXXXXXXXXXXXXXXX
//////////////////////7


public function consistencia_27 ($cons,$ncuadro,$c_datosno0)
    // ctrl sección multiple, validar cantidad de años con alumnos
    // verifica que si declaran secciones multiples en una celda se haya mas de una pareja de celdas (v+m) con datos distinto de 0 
    // utiliza dos array con los titulos de las filas y columnas de donde construir el mensaje de error
    // consistencia x 
    
    /* parametros
    en cmp1
                ['niv']  // array de tres dimensiones con las celdas de los alumnos (nivel, año, celdas)
    en cmp2
                'cmp'    // calda multiple
    en cmp3 
                ['msg_niv'] // array de string con el mensaje para cada nivel
    */

    {
        $r1= unserialize($cons->cmp1);
        $r2= unserialize($cons->cmp2);
        $r3= unserialize($cons->cmp3);
        $C=$this->cuadros[$ncuadro];     

        $niv= isset($r1['niv']) ? $r1['niv'] : []; // recupero el array de niveles        
        $sea= isset($r2['sea']) ? $r2['sea'] : []; // celda de secciones agrpadas
        $msg_niv= isset($r3['msg_niv']) ? $r3['msg_niv'] : []; // array con los msg de error de cada nivel
        

        
        foreach ($niv as $ni => $cniv) // recorremos todas los niveles a controlar
        {
            $s=$this->f_suma(['cel' => $sea[$ni]]); // sumamos las secciones agrupadas del nivel
            if ($s>0) // si hay secciones agrupadas
            {   
                // contamos cantidad de años con alumnos
                $cai=0; // contador de anios con alumnos del nivel
                $cuadros_alu=''; //nros de cuadros  del que provienen los alumnos
                foreach ($cniv as $ai => $anio)	// recorro todos los años del nivel
                {   
                    if ( isset($anio['r'] ))
                    {  // dd($anio['r'][0][0] );                            
                        $a= $this->f_suma(['reg'=>$anio['r'] ]); //sumar las regiones pasadas en el array (alumnos varones y mujeres del año)
                        $cuadro=$anio['r'][0][0]; //recupero el nro de cuadro  del que provienen  los alumnos
                    }
                    else
                    {
                        $a= $this->f_suma(['cel'=>$anio]); //sumar las celdas pasadas en el array (alumnos varones y mujeres del año)
                        $cuadro=$anio[0][0]; //recupero el nro de cuadro  del que provienen  los alumnos
                    }
                    if ($a>0) { $cai++; }
                    
                    if (strpos($cuadros_alu,strval($cuadro))===false)   // si el nro de cuadro no esta en el string de cuadros  lo agregamos
                    {
                        $cuadros_alu.=($cuadros_alu=='') ? strval($cuadro) : ', '.strval($cuadro);    
                    }                  
                }
                if ($cai<=1) //hay menos de un anio con alumnos marcamos el error
                {
                        $msg=$cons->msg1.' ('.$s.') '. $cons->msg2 . ' '. $msg_niv[$ni].' '.$cons->msg3.' '.$cuadros_alu;
                        //marcar celda de secciones agrupadas involucradas con error     
                        // chequeo de no no reescribir errores y no recargar antes              
                        foreach ($sea[$ni] as $key => $v)                          
                            {   if ($C->celdas[$v[1]][$v[2]]->c_categoria_consistencia==1)  // 1 celda ok
                                    {   $C->celdas[$v[1]][$v[2]]->msg=$msg;
                                        $C->celdas[$v[1]][$v[2]]->c_categoria_consistencia=($cons->c_categoria_consistencia);
                                    }
                            }
                         
                        if ($cons->c_categoria_consistencia==3) // consistencia de error
                        {   // agregar error en cuadro
                            $C->msg_err[]=$msg;
                            $C->c_estado_cuadro=($C->c_estado_cuadro>20 ) ? 20: $C->c_estado_cuadro; //20 En carga con errores
                        }
                        else // consistencia de advertencia
                        {
                            // agregar advertencia al cuadro
                            $C->msg_adv[]=$msg;
                            $C->c_estado_cuadro=($C->c_estado_cuadro>30 ) ? 30: $C->c_estado_cuadro; //30 En carga con advertencias
                        }
                }        
            }
        }

    } //  consistencia 27 comptrol de cantidad de años con alumnos y secciones agrupadas











    /**
     * funcion para cargar los datos de un cuadro a partir de un array
     * del tipo: $input [$cuadro][$fila][$columna] = $valor
     * ejemplo $input[3][4][1] = 23; (cuadro 3, fila 4, columna 1 con valor 23)
     * param Array con los datos a cargar en los cuadros  acepta multiples cuadros en el array
     */
    public function cargar_input($input)  {
        // toastr()->info('Cargando datos...');
        if ($this->c_estado_formulario == 70) {   // si el formulario estaba vacio(=70) lo ponemos en carga, para que se puedan aplicar las consistencias
            $this->c_estado_formulario=40; // 40=en carga
        }

    	foreach ($input as $ncua => $cuadro)  { 
            if ($this->cuadros[$ncua]->c_estado_cuadro == 70) { // vacio(=70) (si estaba vacio lo pasamos a En carga)
                $this->cuadros[$ncua]->c_estado_cuadro=40; // 40=en carga,
            } 
            $this->cuadros[$ncua]->cargar_input($cuadro);
        }   
    }


    /**
     * function check_estado_formulario
     * cambiar el estado de completo a confirmado de un formulario
     * chequea si no hay errores en los cuadros antes devuelve TRUE o FALSE si pudo o no confirmar  
     */
    public function check_estado_formulario()  {
        
        $estado_anterior=$this->c_estado_formulario; 
        $this->consistir_formulario(); // recalculamos estado

        if  ($this->c_estado_formulario != $estado_anterior) {
            $this->save(); //se encontro un error en algun cuadro, salvamos todo el modelo para registrar el error
        }  
        return ($this->c_estado_formulario==$estado_anterior) ; // devuelve true si conserva el estado que tenia        
    } // fin Function check_estado_formulario()


    /**
     * function confirmarformulario
     * cambiar el estado de completo a confirmado de un formulario
     * chequea si no hay errores en los cuadros antes devuelve TRUE o FALSE si pudo o no confirmar  
     */
    public function confirmarformulario()  {

        $estado_anterior=$this->c_estado_formulario; 
        $this->consistir_formulario(); // recalculamos estado
        if ($this->c_estado_formulario>=80) {
            $this->c_estado_formulario=100; // lo paso a estado confirmado estado=100
        }

        if ($this->c_estado_formulario==100 and $estado_anterior<100) {    // se puede confirmar estado=100 
            // actualizo el modelo confirmado   
            $this->fecha_fin_carga=is_null($this->fecha_fin_carga) ? date("Y-m-d H:i:s", time()) : $this->fecha_fin_carga;
            $this->id_usuario_confirma=is_null($this->id_usuario_confirma) ? Auth::user()->id : $this->id_usuario_confirma;
            Datos_formulario::where ('id_datos_formulario', $this->id_datos_formulario )  
                                ->update([  'c_estado_formulario'=>$this->c_estado_formulario,
                                           // 'fecha_inicio_carga'=>$this->fecha_inicio_carga,
                                            'fecha_fin_carga'=> $this->fecha_fin_carga,
                                            //'fecha_recepcion_UE'=>$this->fecha_recepcion_UE,
                                            'id_usuario_confirma'=> $this->id_usuario_confirma,
                                        ]);
        }                                
        elseif  ($this->c_estado_formulario!=100 and $this->c_estado_formulario!=$estado_anterior) {
            $this->save(); //se encontro un error en algun cuadro salvamos todo el modelo para registrar el error
        }
 
        // if ($this->c_estado_formulario<100) // chekea si ya  no esta confirmado
        //     {           $this->consistir_formulario(); // verifica que se pueda confirmar
        //                 if ($this->c_estado_formulario<80) // hay error no puedo confirmar
        //                     {
        //                         $this->save(); //se encontro un error en algun cuadro salvamos todo el modelo para registrar el error
        //                     }
        //                 else
        //                     {
        //                         $this->c_estado_formulario=100;  // estado confirmado  
        //                         $this->fecha_fin_carga=is_null($this->fecha_fin_carga) ? date("Y-m-d H:i:s", time()) : $this->fecha_fin_carga;
        //                         $this->id_usuario_confirma=is_null($this->id_usuario_confirma) ? Auth::user()->id : $this->id_usuario_confirma;
        //                         // actualizo el modelo
        //                         Datos_formulario::where ('id_datos_formulario', $this->id_datos_formulario )  
        //                                             ->update([  'c_estado_formulario'=>$this->c_estado_formulario,
        //                                                        // 'fecha_inicio_carga'=>$this->fecha_inicio_carga,
        //                                                         'fecha_fin_carga'=> $this->fecha_fin_carga,
        //                                                         //'fecha_recepcion_UE'=>$this->fecha_recepcion_UE,
        //                                                         'id_usuario_confirma'=> $this->id_usuario_confirma,
        //                                                     ]);
        //                     }
        //     }

        return ($this->c_estado_formulario==100) ; // devuelve true si pudo confirmar                            
    } // fin function confirmarformulario()


    /** function desconfirmarformulario
     * 
     */
    public function desconfirmarformulario()   {

        $this->c_estado_formulario= 90; // lo paso a completo
        $this->consistir_formulario(); // calculamos el estado real
        // actualizo el modelo
        Datos_formulario::where ('id_datos_formulario', $this->id_datos_formulario )  
                        ->update([  'c_estado_formulario'=>$this->c_estado_formulario
                                    ,'id_usuario_update'=> Auth::user()->id  // guarda al usuario que desconfirma
                                 ]);        
    }


    /**
     * Calcular la suma de un conjunto de celdas del distinctos cuadros de un Formulario     
     * Recibe $param con un array con las celdas a sumar 
     * $cfc => [cuadro,fila, columnas]
     * si fila es 0 se utiliza la última fila del cuadro     
     * @return el total calculado 
     */
    public function f_suma( $param=[]) {
            $t=0;
            
			$celdas=isset($param['cel']) ? $param['cel'] : [];  // celdas referenciadas x [cuadro,fila,columna]
			$filas=isset($param['fil']) ? $param['fil'] : [];   // filas referenciadas x [cuadro,fila]
            $columnas=isset($param['col']) ? $param['col'] : []; // columnas referenciadas x [cuadro,columna]
            $region=isset($param['reg']) ? $param['reg'] : [];   // región referenciada x [cuadro,fil_1,col_1,fil_2,col_2]
            $t=0;

            //por celda            
            foreach ($celdas as $xy)
            {   
                if (isset($xy))
                    {
                                // reposiciona a la ultima fila si la fila es 0 
                        $f= ($xy[1]==0) ? count($this->cuadros[$xy[0]]->celdas) : $xy[1] ; 
                        if (is_numeric($this->cuadros[$xy[0]]->celdas[$f][$xy[2]]->valor) and
                            ($this->cuadros[$xy[0]]->celdas[$f][$xy[2]]->tipo_dato=='number' or $this->cuadros[$xy[0]]->celdas[$f][$xy[2]]->tipo_dato=='total_calculado'))
                                {   $t=$t + $this->cuadros[$xy[0]]->celdas[$f][$xy[2]]->valor; } 
                    }                         
            }

            //por fila (suma todas las celdas de una fila dada)
            foreach ($filas as $f) // para cada par cuadro, fila
            {   for ($c=1; $c<=count($this->cuadros[$f[0]]->celdas[$f[1]])+1 ; $c++) //columnas 
                    {   if ( is_numeric($this->cuadros[$f[0]]->celdas[$f[1]][$c]->valor) and
                             ($this->cuadros[$f[0]]->celdas[$f[1]][$c]->tipo_dato=='number' or $this->cuadros[$f[0]]->celdas[$f[1]][$c]->tipo_dato=='total_calculado'))
                            {  $t=$t + $this->cuadros[$f[0]]->celdas[$f[1]][$c]->valor;}
                    }             
            }

            //por columna (suma todas las celdas de una columna dada)
            foreach ($columnas as $c) // para cada par cuadro, columna
            {   for ($f=1; $f<=count($this->cuadros[$c[0]]->celdas) + 1 ; $f++) //columnas 
                    {   if (is_numeric($this->cuadros[$c[0]]->celdas[$c[1]][$f]->valor) and
                            ($this->cuadros[$c[0]]->celdas[$c[1]][$f]->tipo_dato=='number' or $this->cuadros[$c[0]]->celdas[$c[1]][$f]->tipo_dato=='total_calculado'))
                         {  $t=$t + $this->cuadros[$c[0]]->celdas[$c[1]][$f]->valor;}
                    }             
            }            
                        
            // region
            foreach ($region as $xy) // x cada region
            {     // reposiciona a la ultima fila si la fila es 0 

                $f0= ($xy[1]==0) ? count($this->cuadros[$xy[0]]->celdas) : $xy[1] ;
                $f1= ($xy[3]==0) ? count($this->cuadros[$xy[0]]->celdas) : $xy[3] ;
                for ($f=$f0 ; $f<=$f1; $f++) //filas
                {   for ($c=$xy[2]; $c<=$xy[4] ; $c++) //columnas 
                    {   if (is_numeric($this->cuadros[$xy[0]]->celdas[$f][$c]->valor) and
                            ($this->cuadros[$xy[0]]->celdas[$f][$c]->tipo_dato=='number' or $this->cuadros[$xy[0]]->celdas[$f][$c]->tipo_dato=='total_calculado'))
                            {$t=$t + $this->cuadros[$xy[0]]->celdas[$f][$c]->valor;}                                                
                    }             
                }
            }

            return $t;
    }    
}