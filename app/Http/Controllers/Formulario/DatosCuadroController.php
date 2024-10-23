<?php

namespace App\Http\Controllers\Formulario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Illuminate\Support\Facades\DB;
use App\Model\Definicion_formulario;
use App\Model\Datos_cuadro;
use App\Model\Datos_celda;
use App\Model\Datos_celda_infinitas;
use App\Http\Controllers\Formulario\DatosCeldaController;

class DatosCuadroController extends Controller
{   
    // Propiedades
        // de definicion cuadro
        public $id_definicion_cuadro;
        //public $id_definicion_formulario;
        public $nombre;
        public $numero;
        public $descripcion;
        public $encabezado;
        public $indicaciones;
        public $ayuda;
        public $c_tipo_cuadro;
        public $c_criterio_completitud;
        public $ancho;
            //de datos cuadro
        public $id_datos_cuadro;
        public $c_estado_cuadro;
        public $id_usuario;
        public $created_at;
        public $update_at;     
                // de memoria    
        public $msg_err;
        public $msg_adv;
              // de celdas
        public $celdas= [];
    
            // de inconsistencias
        public $consistencias;
        public $mapa=[];  // arreglo de codigos c_mapa validos para el cuadro
    
        /**
         * Crear objeto cuadro.
         *
         * @return objeto creado
         */
        public function __construct($prop=[]) 
        {   
            //paso los datos del cuadro guardado a las propiedades de la instancia creada 
            $this->id_definicion_cuadro = isset($prop['id_definicion_cuadro']) ? $prop['id_definicion_cuadro'] : '';
            //$this->id_definicion_formulario = isset($prop['id_definicion_formulario']) ? : '';
            $this->nombre = isset($prop['nombre']) ? $prop['nombre'] : '';
            $this->numero = isset($prop['numero']) ? $prop['numero'] : '';
            $this->descripcion = isset($prop['descripcion']) ? $prop['descripcion'] : '';
            $this->encabezado = isset($prop['encabezado']) ? $prop['encabezado'] : '';
            $this->indicaciones = isset($prop['indicaciones']) ? $prop['indicaciones'] : '';
            $this->ayuda = isset($prop['ayuda']) ? $prop['ayuda'] : '';
            $this->c_tipo_cuadro = isset($prop['c_tipo_cuadro']) ? $prop['c_tipo_cuadro'] : '';
            $this->c_criterio_completitud = isset($prop['c_criterio_completitud']) ? $prop['c_criterio_completitud'] : '';
            $this->ancho = isset($prop['ancho']) ? $prop['ancho'] : null;
    
    
            //de datos cuadro
            $this->id_datos_cuadro = isset($prop['id_datos_cuadro']) ? $prop['id_datos_cuadro'] : '';
            $this->c_estado_cuadro = isset($prop['c_estado_cuadro']) ? $prop['c_estado_cuadro'] : '';
            $this->id_usuario = isset($prop['id_usuario']) ? $prop['id_usuario'] : '';;       
            $this->created_at = isset($prop['created_at']) ? $prop['created_at'] : '';
            $this->update_at = isset($prop['update_at']) ? $prop['update_at'] : '';
    
            // de memoria
            $this->msg_err = isset($prop['msg_err']) ? $prop['msg_err'] : [];
            $this->msg_adv = isset($prop['msg_adv']) ? $prop['msg_adv'] : [];
    
            // de celdas
            $this->celdas = isset($prop['celdas']) ? $prop['celdas'] : [];
            // de consistencias
            $this->consistencias = isset($prop['consistencias']) ? $prop['consistencias'] : '';
            $this->mapa = isset($prop['mapa']) ? $prop['mapa'] : '';
    
        }
    
    
    
     /**
         * Guardar los datos de un cuadro.
         *
         * return nada
         */         
        public function cuadro_save ( $id_usuario=null)   
        {   
            if ($this->c_estado_cuadro==87) //si el cuadro no tiene celdas editables no hay nada que grabar
            {
                return;
            }
            
            // el bigin trasaction lo hacemos en  fromulario::save_cuadros_editados($input)
    
            $this->save_estado ($id_usuario); //actualizamos elestado y usuario del cuadro
            
            //actualizar las celdas del cuadro   
             
            $date=date("Y-m-d H:i:s", time()) ; //time(); //('now'::text)::timestamp without time zone     
            if ($this->c_tipo_cuadro!=2 and $this->c_tipo_cuadro!=3 ) //si el cuadro no es filas infinitas
            {   //actualizar las celdas del cuadro con filas fijas 
                for ($fil=0;$fil<count($this->celdas); $fil++)
                {   
                    for ($col=0;$col<count($this->celdas[$fil+1] );$col++)                                       
                    {    
                        if ($this->celdas[$fil+1][$col+1]->editable )
                        {
                            if ($this->celdas[$fil+1][$col+1]->id_datos_celda==0)  // es una celda nueva
                            {
                               
                                $this->celdas[$fil+1][$col+1]->id_datos_celda = Datos_celda::
                                    insertGetId( [  'id_definicion_celda'=> $this->celdas[$fil+1][$col+1]->id_definicion_celda,
                                                    'id_datos_cuadro'=> $this->id_datos_cuadro,
                                                    'valor' => $this->celdas[$fil+1][$col+1]->valor,
                                                    'updated_at' => $date  ] , 'id_datos_celda'  );
                            }
                            else    //la celda ya existe
                            {  
                                Datos_celda::where('id_datos_celda',$this->celdas[$fil+1][$col+1]->id_datos_celda )  
                                    ->update([  'valor' => $this->celdas[$fil+1][$col+1]->valor,
                                                'updated_at' => $date ]); // posición absoluta de la fila   
                            }                                 
                        } // editales
                    } //columnas
                } //filas
    
                //eliminamos las celdas viejas que ahora no estan mas en el cuadro 
                Datos_celda::where('id_datos_cuadro',$this->id_datos_cuadro )  
                                    ->where('updated_at','<', $date) 
                                    ->delete();
            }
            else //si el cuadro es de filas infinitas c_tipo_cuadro==2  or $this->c_tipo_cuadro==3 )
            {  // en este tipo de cuadro tengo que guardar todas las celdas (editables y no editables) para poder agregar filas y que las no editables se reposicionen juntos las editables 
                // encontrar la primera 1° fila con datos
                for ($fd=1; $fd<count($this->celdas)+1 and !$this->celdas[$fd][2]->editable; $fd++) 
                    { }   
                 //actualizar las celdas del cuadro filas infinitas  
                for ($fil=$fd-1;$fil<count($this->celdas); $fil++)
                {   
                    for ($col=0;$col<count($this->celdas[$fil+1] );$col++)                                       
                    {    
                        // if ($this->celdas[$fil+1][$col+1]->editable )
                        // {
                            if ($this->celdas[$fil+1][$col+1]->id_datos_celda==0)  // es una celda nueva
                            {
                                $this->celdas[$fil+1][$col+1]->id_datos_celda = Datos_celda_infinitas::
                                    insertGetId( [  'id_definicion_celda'=> $this->celdas[$fil+1][$col+1]->id_definicion_celda,
                                                    'id_datos_cuadro'=> $this->id_datos_cuadro,
                                                    'fila_infinita' => $fil+1, // posición absoluta de la fila
                                                    'valor' => $this->celdas[$fil+1][$col+1]->valor,
                                                    'updated_at' => $date  ] , 'id_datos_celda' );
                            }
                            else    //la celda ya existe
                            {  
                                Datos_celda_infinitas::
                                    where('id_datos_celda',$this->celdas[$fil+1][$col+1]->id_datos_celda )  
                                    ->update([  'valor' => $this->celdas[$fil+1][$col+1]->valor,
                                                'fila_infinita' => $fil+1, // posición absoluta de la fila
                                                'updated_at' => $date ]); 
                            }                                
                        // } // ? editable
                    } //columnas
                } //filas
    
                //eliminamos las celdas viejas que ahora no estan mas en el cuadro 
                Datos_celda_infinitas::where('id_datos_cuadro',$this->id_datos_cuadro )  
                                    ->where('updated_at','<', $date) 
                                    ->delete();
    
            } // ? el cuadro es de filas infinitas c_tipo_cuadro==2 or c_tipo_cuadro==3
    
        }
    
    
    
        /**
         * Guardar el estado del cuadro.
         *
         * return nada
         */         
        public function save_estado ($id_usuario=null)   
        {   
            if (is_null($id_usuario)) // busco el id del usuario si no lo tengo
            {
                $id_usuario=Auth::user()->id;
            }
            $this->id_usuario =$id_usuario; // actualizamos el usuario que va a actualizar en el modelo
            
            Datos_cuadro::where ('id_datos_cuadro', $this->id_datos_cuadro )  
                        ->update([  'c_estado_cuadro' => $this->c_estado_cuadro,
                                    'id_usuario' => $this->id_usuario ]);
        }
    
        /**
         * Eliminar datos guardados del cuadro en tabla de cuadros
         * no afecta al objeto cuadro!! (DefinicionCuadroController)
         * return nada
         */ 
        public function cuadro_delete()
        {  
            try
                {   DB::beginTransaction();
    
                    // eliminar las celdas del cuadro
                    if ( $this->c_tipo_cuadro==2 or $this->c_tipo_cuadro==3) // cuadro filas infinita
                        {   Datos_celda_infinitas::where('id_datos_cuadro',$this->id_datos_cuadro)->delete(); }      
                    else
                        {   Datos_celda::where('id_datos_cuadro',$this->id_datos_cuadro)->delete();  }
               
                    // eliminar datos del cuadro en la base de datos.
                    Datos_Cuadro::destroy($this->id_datos_cuadro);
    
                    DB::commit();  /* Transaction successful. */
                }
            catch (\Exception $e)
                {   DB::rollback();  /* Transaction failed. */
                }
               
        }
    
    
        /**
         * Calcular la suma del area de un cuadro
         *
         * Recibe $param un aray con las areas a escanear y sumar
         * $filas, $columnas,$celdas,$region
         * $param= [fil=>[1],col=>[3,4], cel=>[[3,4],[3,6]], reg=>[[2,2,3,3],[6,3,8,4]] ]
         *
         * @return el totlal calculado 
         */
        public function c_suma( $param=[]) {
            $filas=isset($param['fil']) ? $param['fil'] : [];
            $columnas=isset($param['col']) ? $param['col'] : [];
            $celdas=isset($param['cel']) ? $param['cel'] : [];
            $region=isset($param['reg']) ? $param['reg'] : [];
            $t=0;
            //por fila y columna
            foreach ($filas as $f)
            {   foreach ($columnas as $c)
                { if (is_numeric($this->celdas[$f][$c]->valor) and 
                      ($this->celdas[$f][$c]->tipo_dato=='number' or $this->celdas[$f][$c]->tipo_dato=='total_calculado'))
                            {  $t=$t + $this->celdas[$f][$c]->valor;}
                }             
            }
            //por celda            
            foreach ($celdas as $xy)
            {   if (is_numeric( $this->celdas[$xy[0]][$xy[1]]->valor) and
                    ($this->celdas[$xy[0]][$xy[1]]->tipo_dato=='number' or $this->celdas[$xy[0]][$xy[1]]->tipo_dato=='total_calculado'))
                    {$t=$t + $this->celdas[$xy[0]][$xy[1]]->valor; }                          
            }
            // region
            foreach ($region as $xy) // x cada region
            {   for ($f=$xy[0] ; $f<=$xy[2] ; $f++) //filas
                {   for ($c=$xy[1]; $c<=$xy[3] ; $c++) //columnas 
                    {   if (is_numeric($this->celdas[$f][$c]->valor) and 
                            ($this->celdas[$f][$c]->tipo_dato=='number' or $this->celdas[$f][$c]->tipo_dato=='total_calculado'))
                            {$t=$t + $this->celdas[$f][$c]->valor;}                                                
                    }             
                }
            }
            return $t;
        }    
    
    /**
         * funcion para cargar los datos de un cuadro a partir de un array
         * cuyo key es id_datos_celda
         * ejemplo $nput=[52=>'235',53=>'24']
         * param Array con los datos a cargar en el cuadro
         * llamar $cuadro->cargar_input([52=>'235',53=>'24'])
         * si en el array no se incluye el id_datos_celda de alguna celda, la misma no se modifica
         */
    
        public function cargar_input($input)
        {    
            //dd($input);
            if ($this->c_estado_cuadro==87)  //es un cuadro deshabilitado no hay que consistirlo ni cargar inputs!
                {
                    return;
                }
    
            if ($input=="on") // es un cuadro deshabilitado, tengo que asignarlo como "85 completo sin datos y limpiar los datos "
                {   $this->c_estado_cuadro=85; // asigno estado completo deshabilitado
                    $this->msg_err=[]; // elimino msg de error anteriores po si los tubiese
                       $this->msg_adv=[];// elimino msg de adv anteriores po si los tubiese
                    
                    // limpiar datos de las celdas del cuadro
                    foreach ($this->celdas as $fil => $fila)
                    {
                        foreach ($this->celdas [$fil] as $col => $val)
                        { 
                            if ($this->celdas[$fil][$col]->editable )
                            {
                                $this->celdas[$fil][$col]->valor= ( (strtolower($this->celdas[$fil][$col]->tipo_dato)=='combobox')
                                                                    or (strtolower($this->celdas[$fil][$col]->tipo_dato)=='radio') ) ? '': $this->celdas[$fil][$col]->valor_inicial ;
                                $this->celdas[$fil][$col]->msg='';
                                $this->celdas[$fil][$col]->c_categoria_consistencia=1; //1=ok
                            }
                        }
                    }
                    
                
                    return;	
                }
            elseif ($this->c_estado_cuadro==85 ) // el cuadro cambió de completo sin informacion ($input="on") a con datos
                {   // le imputo un estado válido para forzar a que sea conistido
                    $this->c_estado_cuadro=70;  //70=vacio, (si esta vacio y no tiene errores o adv.)
                }
    
            if ($this->c_tipo_cuadro==2 or $this->c_tipo_cuadro==3)
            {   // si es un cuadro de filas infinitas hay que agregar o sacar las filas en el objeto cuadro
    
    
     /*                
                // encontrar la primera 1° fila con datos
                // cambie a usar la primera fila que usa el input (no se deberia borrar)
                for ($fd=1; $fd<count($this->celdas)+1 and !$this->celdas[$fd][2]->editable; $fd++) { }   
    */           
                $fd=min(array_keys($input)); // indice de la primera 1° fila con datos, la primera fila no se borra!!
    
                // 1° renumero las filas del input de+ forma correlativas x si se borraron filas
                $a=[]; //pasar las filas del input a un arreglo nuevo con key de filas correlativas
                $fi=$fd; // indice de la primera fila de datos, no se deberia borrar!
                foreach ($input as $fil => $fila)  { $a[$fi++]= $fila; }      
              
                $input=$a;  // reasignar el input con las filas corregidas 
                $fi--; // cantidad de filas del nuevo input incluye las filas de encabezdo  // $fi = count($input) - 1 + $fd;
                
                // agregar o sacar filas del modelo
                $diferencia=$fi - (count($this->celdas)); //calcular la cantidad de filas a agregar o sacar del modelo
                if ($diferencia>0) //agregar filas en el cuadro
                    {   //agregamos filas en la ante ultima fila por si hay fila de totales
                        $this->duplicar_fila($fi-$diferencia,$fi,true); //mover la ultima fila
                        
                         // inicializar las filas agregadas
                        for ($f=$fi-$diferencia; $f<$fi; $f++) 
                            {	$this->duplicar_fila($fd,$f,false); //copiar la estructura de la primera fila de datos ($fd)
                            } 
                        ksort($this->celdas); // reordenamos las filas del cuadro
                    }
                elseif ($diferencia<0) // eliminar filas del cuadro que sobran
                    {  
                        $this->duplicar_fila(count($this->celdas) , count($this->celdas)+$diferencia ,true); //mover la ultima fila
    
                           // eliminar filas excedentes (anteriores a la ultima)
                           $ff=count($this->celdas)+$diferencia;           	    
                        for ($f=count($this->celdas); $f>$ff; $f--)  //desplazar la filas dejando el espacio
                            {	
                                unset($this->celdas[$f]); //eliminar la fila	                		                
                            }              	
                            
                    }
            }
    
            // if ($this->c_tipo_cuadro==2 or $this->c_tipo_cuadro==3) { dd($input); }
            
            //pasar los datos al objeto cuadro
            foreach ($input as $fil => $fila)
            {
                foreach ($input [$fil] as $col => $val)
                { 
                    if ($this->celdas[$fil][$col]->editable )
                    {
                        $this->celdas[$fil][$col]->valor= strlen ($val)==0 ? '' : $val;
                        $this->celdas[$fil][$col]->fila=$fil; //reasignar la fila por si se agregaron o sacaron
                    }
                }
            }
            // if ($this->c_tipo_cuadro==2 or $this->c_tipo_cuadro==3) { dd($this); }
            //dd($fd,$input,$this->celdas); 
        }
    
    
        /**
         * funcion para duplicar una fila de un cuadro
         *  
         *  
         * param $f_origen=  la fila origen a ser copiada,
         *       $f_destino= la fila destino
         *        $copiar_id (boolean/ true/false) indica si se copia el id_datos_celda del origen al destino
         * si la fila destino no existe se crea una nueva fila 
         * 
         */
    
        public function duplicar_fila($f_origen,$f_destino,$copiar_id)
        {
            for ($c=1; $c<count($this->celdas[$f_origen])+1;$c++)
            {   if (!isset($this->celdas[$f_destino][$c]))  // estamos creando una fila
                    {   // generamos una nueva celda con las propiedades de la celda origen
                        $this->celdas[$f_destino][$c]= new DatosCeldaController(
                                                    [   'id_definicion_celda' => $this->celdas[$f_origen][$c]->id_definicion_celda,
                                                        'fila' => $f_destino,
                                                        'columna' => $this->celdas[$f_origen][$c]->columna,
                                                        'editable' => $this->celdas[$f_origen][$c]->editable,
                                                        'tipo_dato' => $this->celdas[$f_origen][$c]->tipo_dato,
                                                        'colspan' => $this->celdas[$f_origen][$c]->colspan,
                                                        'rowspan' => $this->celdas[$f_origen][$c]->rowspan,
                                                        'titulo' => $this->celdas[$f_origen][$c]->titulo,
                                                        'valor_inicial' => $this->celdas[$f_origen][$c]->valor_inicial,
                                                        'estilos' => $this->celdas[$f_origen][$c]->estilos,
                                                        'c_mapa' => $this->celdas[$f_origen][$c]->c_mapa,
                                                        'c_categoria_consistencia' => $this->celdas[$f_origen][$c]->c_categoria_consistencia,   
                                                        'msg' => $this->celdas[$f_origen][$c]->msg,
                                                        'id_datos_celda' => $copiar_id ? $this->celdas[$f_origen][$c]->id_datos_celda : null,     
                                                        'valor' => $this->celdas[$f_origen][$c]->valor 
                                                    ] );
                    }
                else    //estamos copiando una fila ya existente, paso las propiedades de la celda origen a la destino
                    {
                        $this->celdas[$f_destino][$c]->id_definicion_celda = $this->celdas[$f_origen][$c]->id_definicion_celda;
                        $this->celdas[$f_destino][$c]->fila = $f_destino;
                        $this->celdas[$f_destino][$c]->columna = $this->celdas[$f_origen][$c]->columna;
                        $this->celdas[$f_destino][$c]->editable = $this->celdas[$f_origen][$c]->editable;
                        $this->celdas[$f_destino][$c]->tipo_dato = $this->celdas[$f_origen][$c]->tipo_dato;
                        $this->celdas[$f_destino][$c]->colspan = $this->celdas[$f_origen][$c]->colspan;
                        $this->celdas[$f_destino][$c]->rowspan = $this->celdas[$f_origen][$c]->rowspan;
                        $this->celdas[$f_destino][$c]->titulo = $this->celdas[$f_origen][$c]->titulo;
                        $this->celdas[$f_destino][$c]->valor_inicial = $this->celdas[$f_origen][$c]->valor_inicial;
                        $this->celdas[$f_destino][$c]->estilos = $this->celdas[$f_origen][$c]->estilos;
                        $this->celdas[$f_destino][$c]->c_mapa = $this->celdas[$f_origen][$c]->c_mapa;
                        $this->celdas[$f_destino][$c]->c_categoria_consistencia = $this->celdas[$f_origen][$c]->c_categoria_consistencia;   
                        $this->celdas[$f_destino][$c]->msg = $this->celdas[$f_origen][$c]->msg;
                        $this->celdas[$f_destino][$c]->id_datos_celda =$copiar_id ? $this->celdas[$f_origen][$c]->id_datos_celda : null;
                        $this->celdas[$f_destino][$c]->valor = $this->celdas[$f_origen][$c]->valor;
                    }
            }
        }
    
    
    
    
        // /**
        //  * crea y/o recupera un arreglo con los cuadros de un formulario dado por
        //  *  $id_datos_formulario, y $id_definicion_formulario.
        //  *
        //  * @return $cuadros // Arreglo de objetos tipo DatrosCuadroController
        //  * ejemplo $cuadros= DatosCuadroController::dat_cuadro_get_cuadros_formulario($F->id_definicion_formulario);
        //  */
        //
        //  // FUNCION NO UTILIZADA POR AHORA FALTA ACTUALIZAR
        //
        // public static function dat_cuadro_get_cuadros_formulario ($id_datos_formulario,$id_definicion_formulario,$ofertas)
        // {   
        //     //recuperar las definicion de cuadros del formulario
        //     $ac= Definicion_formulario::find($id_definicion_formulario)->cuadros;
        //     $cuadros=[];
    
        //     foreach ($ac as $c)
        //     {   // recuperar propiedades de datos_cuadro
        //         $D = Datos_cuadro::firstOrCreate(['id_datos_formulario'=>$id_datos_formulario,             //clave acceso al cuadro
        //                  'id_definicion_cuadro' => $c->id_definicion_cuadro] ,   
        //                 // si no se encuentra se inicializa un nuevo cuadro  con:
        //                 [ //'id_datos_cuadro' => $D->id_datos_cuadro  ,  // es autonumerioco      
        //                   'c_estado_cuadro'=>70  // Vacio estado inicial
        //                   ,'id_usuario'=> Auth::user()->id              
        //                   // ,'created_at'=> '', 'updated_at'=> ''                  
        //                 ] );   
    
        //         // agregar el cuadro al arreay
        //         $cuadros[$c->numero] = new DatosCuadroController (
        //                                         [   'id_definicion_cuadro'=>$c->id_definicion_cuadro ,
        //                                             'nombre' => $c->nombre ,
        //                                             'numero' => $c->numero ,
        //                                             'descripcion' => $c->descripcion ,
        //                                             'encabezado' => $c->encabezado ,
        //                                             'indicaciones' => $c->indicaciones ,
        //                                             'ayuda' => $c->ayuda ,
        //                                             'c_tipo_cuadro' => $c->c_tipo_cuadro ,
        //                                             'c_criterio_completitud'=> $c->c_criterio_completitud,
        //                                             'ancho' => $c->ancho ,
    
        //                                             'id_datos_cuadro' => $D->id_datos_cuadro,
        //                                             'c_estado_cuadro' => $D->c_estado_cuadro,
        //                                             'id_usuario' => $D->id_usuario,
        //                                             'created_at' => $D->created_at,
        //                                             'update_at' => $D->update_at,
        //                                                     // de memoria
        //                                             'msg_err' => [],
        //                                             'msg_adv' => [],
        //                                             'celdas' => DatosCeldaController::dat_celda_get_celdas_cuadro($D->id_datos_cuadro,$c->id_definicion_cuadro,$ofertas) ,
        //                                             'consistencias' => New DefinicionConsistenciaController($c->id_definicion_cuadro),
        //                                             'mapa' => New DefinicionMapacuadroController($c->id_definicion_cuadro,$c->id_definicion_cuadro)
        //                                              
        //                                         ] );                     
        //     }  
    
        //     return $cuadros;
        // }
    
    
}
