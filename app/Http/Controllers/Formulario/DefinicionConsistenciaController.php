<?php

namespace App\Http\Controllers\Formulario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Definicion_consistencia;

class DefinicionConsistenciaController extends Controller
{
    
  	public $consistencias;

    /**
     * devuelve las consistencias de un cuadro
     *
     * @return objeto creado
     */
    public function __construct ($id_definicion_cuadro) 
    //public static  function cons ($id_definicion_cuadro) 

    {
        $this->consistencias=Definicion_consistencia::join('consistencia_tipo', 'consistencia_tipo.c_consistencia_tipo', '=', 'definicion_consistencia.c_tipo_consistencia')
                                 ->where('id_definicion_cuadro', $id_definicion_cuadro)->where('c_estado',1)->orderBy('consistencia_tipo.orden','asc')->get();
    	// return DB::table('consistencias')->where('id_definicion_cuadro', $id_definicion_cuadro)->get();
    	 //return Consistencias::where('id_definicion_cuadro', $id_definicion_cuadro)->get();
    }  


    /**
     * almacenar o actualizar una consistencia en la tabla deconsistencias
     *  @param  un array con las propiedades de las consistencia
     * si se pasa el id_consistencia se intenta actualizar
     * si no se pasa el id_consistencia, se crea una consistencia nueva.
     * y debe incluirse id_definicion_formulario o da error
     *
     * 
     * @return $id_consistencia creado o actualizado
     **/

    public static function consistencia_save($cons=[])

    {
        // serializar los array a guardar en la tabla
        if (isset($cons['cmp1'])) {	$cons['cmp1']=serialize($cons['cmp1']); } 
        if (isset($cons['cmp2'])) {	$cons['cmp2']=serialize($cons['cmp2']); } 
        if (isset($cons['cmp3'])) {	$cons['cmp3']=serialize($cons['cmp3']); } 

		$id = Definicion_consistencia::UpdateOrCreate( 
                        [    //'id_consistencia' => $cons['id_consistencia'],
                            'id_definicion_cuadro' => $cons['id_definicion_cuadro'],
                            'numero' => $cons['numero'] 
                        ],
        				[
                         	'id_definicion_formulario' => isset($cons['id_definicion_formulario']) ? $cons['id_definicion_formulario'] : null, // nulo no permitido daria error					
        					'id_definicion_celda' => isset($cons['id_definicion_celda']) ? $cons['id_definicion_celda'] : null,
        					'c_tipo_consistencia' => isset($cons['c_tipo_consistencia']) ? $cons['c_tipo_consistencia'] : 13, //Comparaciones en fila
        					'c_categoria_consistencia' => isset($cons['c_categoria_consistencia']) ? $cons['c_categoria_consistencia'] : 1, // Consistencia de Error
        					'c_estado' => isset($cons['c_estado']) ? $cons['c_estado'] : 1, // Consistencia activa
        					
        					'cmp1' => isset($cons['cmp1']) ? $cons['cmp1'] : '',
        					'cmp2' => isset($cons['cmp2']) ? $cons['cmp2'] : '',
        					'cmp3' => isset($cons['cmp3']) ? $cons['cmp3'] : '',
        					'msg1' => isset($cons['msg1']) ? $cons['msg1'] : '',
        					'msg2' => isset($cons['msg2']) ? $cons['msg2'] : '',
        					'msg3' => isset($cons['msg3']) ? $cons['msg3'] : '',	
        					'descripcion' => isset($cons['descripcion']) ? $cons['descripcion'] : ''
        				] );
		
    } 


    /**
     * eliminar todas las consistencias de un fromulario por el id_formulario
     *
     * 
     * @return nada
     **/

    public static function consistencia_fromulario_delete($id_definicion_formulario)
    {
        Definicion_consistencia::where('id_definicion_formulario','=',$id_definicion_formulario)->delete();
    }


    /**
     * eliminar las consistencias subrantes de un cuadro
     * 
     * parametros=
     * $id_definicion_cuadro= identificador del cuadro,
     * $cant= cantidad de consistencias válidas
     * 
     * @return nada
     **/
    
    public static function consistencia_cantidad_x_cuadro($id_definicion_cuadro,$cant)
    {
        Definicion_consistencia::where('id_definicion_cuadro','=',$id_definicion_cuadro)
                                ->where('numero','>',$cant)->delete();
    }
    
}
