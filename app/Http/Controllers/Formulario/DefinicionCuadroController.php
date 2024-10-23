<?php

namespace App\Http\Controllers\Formulario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Definicion_cuadro;
use App\Model\Definicion_formulario;
use App\Model\Definicion_celda;
use App\Model\Datos_celda;
use App\Model\Migracion\Def_migracion_alumnos;
use App\Model\Migracion\Def_migracion_secciones;

use App\Http\Controllers\Formulario\DefinicionCeldaController;
use App\Http\Controllers\Formulario\DefinicionConsistenciaController;
use App\Http\Controllers\Formulario\DefinicionMapaCuadroController;

class DefinicionCuadroController extends Controller
{
    public  $id_definicion_cuadro;
    public  $id_definicion_formulario;
    public  $nombre;
    public  $numero;
    public  $descripcion;
    public  $encabezado;
    public  $indicaciones;
    public  $ayuda;
    public  $c_tipo_cuadro;
    public  $c_criterio_completitud;
    public  $ancho;
    public  $fecha_modificacion;
    public  $created_at;
    public  $update_at;

            // otras propiedades
    public  $celdas; // arreglo de celdas
    
    public  $consistencias; //colleccion de consisterncias

    /**
     * Crea un cuadro en memoria
     * de la class  (DefinicionCuadroController) 
     * si se da un $id_definicion_cuadro que debe existir, recupera el cuadro guardado
     * return objeto class DefinicionCuadroController
     * Ej: crear cuadro:
     *    $nuevo_cuadro = new DefinicionCuadroController(['nombre'=>'cuadro N 8','numero'=>8,'descripcion'=>'Cuadro de Prueba','c_tipo_cuadro'=>1,'fecha_modificacion'=>'2017/04/04']);
     * Ej. Recuperar Cuadro:
     *    $nuevo_cuadro = new DefinicionCuadroController(8);
     */ 
    public function __construct($propiedades=[]) 
    {   
        if (is_int($propiedades)) 
            {
                $propiedades=['id_definicion_cuadro'=>$propiedades];
            }
        if (isset($propiedades['id_definicion_cuadro']))
          { // recuperar cuadro guardado
            $C=Definicion_Cuadro::findOrFail($propiedades['id_definicion_cuadro']);
                  //paso los datos del cuadro guardado a las propiedades de la instancia creada 
            $this->id_definicion_cuadro = $C->id_definicion_cuadro;
            $this->id_definicion_formulario = $C->id_definicion_formulario;
            $this->nombre = $C->nombre;
            $this->numero = $C->nombre_corto;
            $this->descripcion = $C->descripcion;
            $this->encabezado = $C->encabezado;
            $this->indicaciones = $C->indicaciones;
            $this->ayuda = $C->ayuda;
            $this->c_tipo_cuadro = $C->c_tipo_cuadro;
            $this->c_criterio_completitud = $C->c_criterio_completitud;
            $this->ancho = $C->ancho;
            $this->created_at = $C->created_at;
            $this->update_at = $C->update_at;

            // otras propiedades
            $this->celdas= DefinicionCeldaController::def_celda_get_celdas_cuadro($C->id_definicion_cuadro);   
            $this->consistencias= New DefinicionConsistenciaController ($C->id_definicion_cuadro); // recuperar las consistencias del cuadro 

          }
        else
          {  // se crea un cuadro nuevo, inicializo propiedades a nulo                     
            $this->id_definicion_cuadro=0; // se da un id temporario hasta se grabe en la tabla de cuadros
            $this->id_definicion_formulario =isset($propiedades['id_definicion_formulario']) ? $propiedades['id_definicion_formulario'] : '';
            $this->nombre=isset($propiedades['nombre']) ? $propiedades['nombre'] : '';
            $this->numero=isset($propiedades['numero']) ? $propiedades['numero'] : '';
            $this->descripcion=isset($propiedades['descripcion']) ? $propiedades['descripcion'] : '';
            $this->encabezado=isset($propiedades['encabezado']) ? $propiedades['encabezado'] : '';
            $this->indicaciones=isset($propiedades['indicaciones']) ? $propiedades['indicaciones'] : '';
            $this->ayuda=isset($propiedades['ayuda']) ? $propiedades['ayuda'] : '';
            $this->c_tipo_cuadro=isset($propiedades['c_tipo_cuadro']) ? $propiedades['c_tipo_cuadro'] : '';
            $this->c_criterio_completitud=isset($propiedades['c_criterio_completitud']) ? $propiedades['c_criterio_completitud'] : '';
            $this->ancho=isset($propiedades['ancho']) ? $propiedades['ancho'] : null;
            $this->created_at=isset($propiedades['created_at']) ? $propiedades['created_at'] : null;
            $this->update_at=isset($propiedades['update_at']) ? $propiedades['update_at'] : null;
            // otras propiedades
            if ( isset($propiedades['filas']) and isset($propiedades['columnas']) ) 
            {   //echo 'filas y columnas'. $propiedades['filas'] .' '.$propiedades['columnas'] ;
                for ($fil =1; $fil<=$propiedades['filas'] ; $fil++)
                {   for ($col=1; $col<=$propiedades['columnas'] ; $col++)
                    { $this->celdas[$fil][$col]= new DefinicionCeldaController (['id_definicion_cuadro'=>$this->id_definicion_cuadro,'fila'=>$fil,'columna'=>$col,
                        'editable'=>true,'tipo_dato'=>'integer' ,'colspan'=>1,
                        'rowspan'=>1,'titulo'=>false,'valor_inicial'=>'0' ]);
                    }          
                } 
            }   
            else 
            {   //echo 'no encontre filas y columnas' ;
                $this->celdas = []; //array(array()); //[][] ; //[[],[]]; // array(array() ,array());
            }
            $this->consistencias = New DefinicionConsistenciaController ($this->id_definicion_cuadro);    //declara la coleccion de inconsistencias vacia 
          } 
 
    } 
    /**
     * Devuelve un arreglo con los cuadros de un formulario dado por
     *  id_definicion_formulario.
     *
     * @return $cuadros // Arreglo de objetos tipo DefinicionCuadroController
     * ejemplo $cuadros= DefinicionCuadroController::def_cuadro_get_cuadros_formulario($F->id_definicion_formulario);
     */
    public static function def_cuadro_get_cuadros_formulario ($id_definicion_formulario)
    {   
        //recuperar los cuadros del formulario
        $ac= Definicion_formulario::find($id_definicion_formulario)->cuadros;
        $cuadros=[];

        foreach ($ac as $c)
        {  $cuadros[$c->numero] = new DefinicionCuadroController();
           $cuadros[$c->numero]->id_definicion_cuadro=$c->id_definicion_cuadro;
           $cuadros[$c->numero]->id_definicion_formulario=$c->id_definicion_formulario;
           $cuadros[$c->numero]->nombre=$c->nombre;
           $cuadros[$c->numero]->numero=$c->numero;
           $cuadros[$c->numero]->descripcion=$c->descripcion;
           $cuadros[$c->numero]->encabezado=$c->encabezado;
           $cuadros[$c->numero]->indicaciones=$c->indicaciones;
           $cuadros[$c->numero]->ayuda=$c->ayuda;
           $cuadros[$c->numero]->c_tipo_cuadro=$c->c_tipo_cuadro;
           $cuadros[$c->numero]->c_criterio_completitud=$c->c_criterio_completitud;
           $cuadros[$c->numero]->ancho=$c->ancho;
           $cuadros[$c->numero]->fecha_modificacion=$c->fecha_modificacion;
           $cuadros[$c->numero]->created_at=$c->created_at;
           $cuadros[$c->numero]->update_at=$c->update_at;
           $cuadros[$c->numero]->celdas= DefinicionCeldaController::def_celda_get_celdas_cuadro($c->id_definicion_cuadro); 
           $cuadros[$c->numero]->consistencias= New DefinicionConsistenciaController ($c->id_definicion_cuadro);  //declara la coleccion de inconsistencias vacia 
        }  

        return $cuadros;      

    }

    /**
     * Eliminar datos guardados del cuadro en tabla de cuadros
     * no afecta al objeto cuadro!! (DefinicionCuadroController)
     * return nada
     */ 
    public function def_cuadro_delete()
    {   
        // eliminar las celdas del cuadro
            foreach ($this->celdas as $fila)
                {   foreach ($fila as $celda)
                        {  
                            $celda->def_celda_delete() ;
                        }             
                }             
        // eliminar datos del cuadro en la base de datos.
        Definicion_Cuadro::destroy($this->id_definicion_cuadro);
    }

    /**
     * Guardar los datos de un cuadro.
     * 
     * return
     * si es un nuevo cuadro se devuelve el id_definicion_cuadro asignado 
     * en el mismo objeto ($this)
     */
    public function def_cuadro_save ()   
    {   
        if (!is_null($this->id_definicion_cuadro) )             
        {       
            //guardar los datos del cuadro
            if ($this->id_definicion_cuadro == 0 ) { // el cuadro no existe previamente (insert)
                    $C= new Definicion_cuadro();
                 }
            else  {  // se modifica un formulario
                    $C=Definicion_Cuadro::findOrFail( $this->id_definicion_cuadro );                                                 
                }

            // almacenar los nuevos valores 
            $C->id_definicion_formulario=$this->id_definicion_formulario;                            
            $C->nombre = $this->nombre;
            $C->numero = $this->numero;
            $C->descripcion = $this->descripcion;
            $C->encabezado = $this->encabezado;
            $C->indicaciones = $this->indicaciones;
            $C->ayuda = $this->ayuda;
            $C->c_tipo_cuadro = $this->c_tipo_cuadro;
            $C->c_criterio_completitud = $this->c_criterio_completitud;
            $C->ancho = $this->ancho;
            $C->save();            
            $this->id_definicion_cuadro=$C->id_definicion_cuadro; //recupero nuevo id del cuadro
            // almacenar datos de las celdas del cuadro
            foreach ($this->celdas as $fila)
                {
                    foreach ($fila as $celda)
                        {   $celda->id_definicion_cuadro=$C->id_definicion_cuadro;
                            $celda->def_celda_save() ;
                        }             
                }

                // eliminar filas y columnas viejas (de cuadros que fueron más grandes)
                Datos_Celda::join('definicion_celda','datos_celda.id_definicion_celda','=','definicion_celda.id_definicion_celda')
                    ->where('definicion_celda.id_definicion_cuadro','=',$this->id_definicion_cuadro)
                    ->where('definicion_celda.fila','>',count($this->celdas))
                    ->delete();
                Datos_Celda::join('definicion_celda','datos_celda.id_definicion_celda','=','definicion_celda.id_definicion_celda')
                    ->where('definicion_celda.id_definicion_cuadro','=',$this->id_definicion_cuadro)
                    ->where('definicion_celda.columna','>',count($this->celdas[1]))
                    ->delete();

                Definicion_Celda::
                    where('definicion_celda.id_definicion_cuadro','=',$this->id_definicion_cuadro)
                    ->where('definicion_celda.fila','>',count($this->celdas))
                    ->delete();
                Definicion_Celda::
                    where('definicion_celda.id_definicion_cuadro','=',$this->id_definicion_cuadro)
                    ->where('definicion_celda.columna','>',count($this->celdas[1]))
                    ->delete();


        }
    }

    /**
     * Guardar propiedades a celdas de un cuadro. 
     * de: filas, columnas, region 
     * @param  $propiedades=[] arreglo de propiedades a asignar
     *          $areas=[] arreglo de filas,columnas celdas y regiones del cuadro a asignarle las propiedades
     * Ej:
     * $F_nuevo->cuadros[1]->def_cuadro_store (['valor_inicial'=>'1°'],  [ 'celdas'=> [[1,2]] ] );
     * $F_nuevo->cuadros[1]->def_cuadro_store (['valor_inicial'=>'1°'],  [ 'region'=> [[2,2,5,4],  [2,2,6,8] ] );
     * $F_nuevo->cuadros[1]->def_cuadro_store (['valor_inicial'=>'0'],   [ 'filas' => [ [5,6,] ] ] );
     */
    public function def_cuadro_store ($propiedades=[],$areas=[]) {        
        if (!is_null($this->id_definicion_cuadro) ) {   
            $filas=isset($areas['filas']) ? $areas['filas'] : [];
            $columnas=isset($areas['columnas']) ? $areas['columnas'] : [];
            $celdas=isset($areas['celdas']) ? $areas['celdas'] : [];
            $region=isset($areas['region']) ? $areas['region'] : []; 
            //por fila
        	foreach ($filas as $fil)
            {   foreach ($this->celdas[$fil] as $c)
                    {   foreach ($propiedades as $prop =>$value)
                	    {	$c->$prop=$value;}                        
                    }             
            }
            // por columna
			foreach ($this->celdas as $fil)
            {   foreach ($columnas as $col)
                    {   foreach ($propiedades as $prop =>$value)
                	    { $fil [$col]->$prop=$value; }                        
                    }             
            }
            //por celda            
            foreach ($celdas as $xy)
            {   foreach ($propiedades as $prop =>$value)
        	    {	$this->celdas[$xy[0]][$xy[1]]->$prop=$value; }            
            }
            // region
            foreach ($region as $xy) // x cada region
            {   for ($f=$xy[0] ; $f<=$xy[2] ; $f++) //filas
                {   for ($c=$xy[1]; $c<=$xy[3] ; $c++) //columnas 
                    {   foreach ($propiedades as $prop =>$value)
                        {  $this->celdas[$f][$c]->$prop=$value;  }                        
                    }             
                }
            }           
    	}
	}

    /**
     * agrega una consistencia a un cuadro en la Base de datos directamente (no en el modelo de memoria)
     *
     * @return \Illuminate\Http\Response
     */
    public function consistencia_save( $cons=[])
    {    // agrego o reescribo propiedades del formulario y cuadro
        $cons['id_definicion_formulario']=$this->id_definicion_formulario;
        $cons['id_definicion_cuadro']=$this->id_definicion_cuadro;        
  
        DefinicionConsistenciaController::consistencia_save($cons);
    }




     /**
     * eliminar las consistencias subrantes de un cuadro
     * 
     * parametros=
     *
     * $cant= cantidad de consistencias válidas
     * 
     * @return nada
     **/
    
    public function consistencia_cantidad_x_cuadro($cant)
    {
        DefinicionConsistenciaController::consistencia_cantidad_x_cuadro($this->id_definicion_cuadro,$cant);
    }

    public function mapacuadro_store_c_mapa($c_mapa, $ofertas=[], $descripcion)
    {
        DefinicionMapaCuadroController::mapacuadro_store_c_mapa($this->id_definicion_cuadro, $c_mapa, $ofertas, $descripcion) ;
    }





    /**
     * Guardar propiedades de la definicion de un grupo de celdas de un cuadro. en las tablas 'def_migracion_...'
     * de: filas, columnas, region 
     * @param  $propiedades=[] arreglo de propiedades a asignar
     *          $areas=[] arreglo de filas,columnas celdas y regiones del cuadro a asignarle las propiedades
     * Ej:
     * $F_nuevo->cuadros[1]->save_cuadro_migrador (['id_oferta_educativa'=>1],  [ 'celdas'=> [[1,2]] ] );
     * $F_nuevo->cuadros[1]->save_cuadro_migrador (['id_oferta_educativa,'=>2,'id_modalidad'=>0 ,'id_terminalidad'=>0],  [ 'region'=> [[2,2,5,4],  [2,2,6,8] ] );
     * $F_nuevo->cuadros[1]->save_cuadro_migrador (['id_oferta_educativa,'=>2,'id_modalidad'=>0 ,'id_terminalidad'=>0],  [ 'filas' => [ [5,6,] ] ] );
     */
    public function save_cuadro_migrador ($propiedades=[],$areas=[])
    {        
        if (!is_null($this->id_definicion_cuadro) )           
        {   
            $filas=isset($areas['filas']) ? $areas['filas'] : [];
            $columnas=isset($areas['columnas']) ? $areas['columnas'] : [];
            $celdas=isset($areas['celdas']) ? $areas['celdas'] : [];
            $region=isset($areas['region']) ? $areas['region'] : []; 


            //por fila
            foreach ($filas as $fil)
            {   foreach ($this->celdas[$fil] as $c)
                    {   if ($c->editable)
                        {
                            $this->UpdateOrCreate_Def_migracion ($c->id_definicion_celda, $propiedades);
                            //Def_migracion_alumnos::UpdateOrCreate( ['id_definicion_celda'=> $c->id_definicion_celda], $propiedades ); 
                        }
                    }             
            }
            // por columna
            foreach ($this->celdas as $fil)
            {   foreach ($columnas as $col)
                    {   
                        if ($fil[$col]->editable)
                        {   
                            $this->UpdateOrCreate_Def_migracion ($fil[$col]->id_definicion_celda, $propiedades);
                            //Def_migracion_alumnos::UpdateOrCreate( ['id_definicion_celda'=> $fil [$col]->id_definicion_celda], $propiedades );
                        }
                    }             
            }
            //por celda            
            foreach ($celdas as $xy)
            {   if ($this->celdas[$xy[0]][$xy[1]]->editable)
                {
                    $this->UpdateOrCreate_Def_migracion ($this->celdas[$xy[0]][$xy[1]]->id_definicion_celda, $propiedades);
                    //Def_migracion_alumnos::UpdateOrCreate( ['id_definicion_celda'=> $this->celdas[$xy[0]][$xy[1]]->id_definicion_celda], $propiedades );
                }
            }
            // region
            foreach ($region as $xy) // x cada region
            {   for ($f=$xy[0] ; $f<=$xy[2] ; $f++) //filas
                {   for ($c=$xy[1]; $c<=$xy[3] ; $c++) //columnas 
                    {   if ($this->celdas[$f][$c]->editable)
                        {   
                            $this->UpdateOrCreate_Def_migracion ($this->celdas[$f][$c]->id_definicion_celda, $propiedades);
                            //Def_migracion_alumnos::UpdateOrCreate( ['id_definicion_celda'=>  $this->celdas[$f][$c]->id_definicion_celda], $propiedades );
                        }
                    }             
                }
            }
           
        }
    }


    /**
     * Guardar en la "tabla_destino" (clase 'def_migracion_...') las propiedades de una celda de definicion (dada por $id_definicion_celda. 
     * @param $id_definicion_celda = id de la celda a agregarle propiedades 
     *        $data = array con las propiedades de la celda a agregar, tiene que incluir la propiedad "tabla_destino" indicando la tabla donde se almacenan las propiedades 
     * Ej: $this->UpdateOrCreate_Def_migracion ($c->id_definicion_celda, $propiedades);
     * donde podria ser : $propiedades=['tabla_destino=>'alumnos', id_oferta_educativa=>2]]
     */

    public function UpdateOrCreate_Def_migracion ($id_definicion_celda,$data=[])
    {   
        $tabla_destino=isset($data['tabla_destino']) ? $data['tabla_destino'] : '';  // recupero la tabla donde se graban las propiedades

        if ($tabla_destino!='') {
                unset($data['tabla_destino']); // eliminamos el valor de la tabla destino del array
                $t='App\Model\Migracion\Def_migracion_'.$tabla_destino;
                $t::UpdateOrCreate( ['id_definicion_celda'=>  $id_definicion_celda], $data);
        } //if $tabla_destino!=''

    } //  function UpdateOrCreate_Def_migracion 



/**
     * agrega un cuadro al formulario.
     *
     * return nada
     */         
    public function def_cuadro_add_fila ($nva_fila) 
    {
        if (isset ($this->celdas) and count($this->celdas)>=$nva_fila)
        {
            // calcular cant de filas del cuadro
            $fil=count($this->celdas);
            $col=count($this->celdas[1]);

            // dd($this->cuadros[$propiedades['numero']]);
            for ($f=$fil+1; $f>$nva_fila ; $f--) // desplazamos las filas subsiguientes
            {   
                $this->celdas[$f]=$this->celdas[$f-1]; 
                for ($c=1; $c <= $col ; $c++)
                {
                    $this->celdas[$f][$c]->fila=$f;                       
                }
            }

            for ($c=1; $c <= $col ; $c++)
            {   // inicializamos la fila liberada
                $this->celdas[$nva_fila][$c]=new DefinicionCeldaController (['id_definicion_cuadro'=>$this->id_definicion_cuadro,'fila'=>$nva_fila,'columna'=>$c,
                                                'valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ]);
            }

            //$this->cuadros[$propiedades['numero']]->celdas=$temp;
        } // if (count($this->celdas)>=$nva_fila)

    }  





}
