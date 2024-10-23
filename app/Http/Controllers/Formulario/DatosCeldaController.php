<?php

namespace App\Http\Controllers\Formulario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Definicion_celda;
use App\Model\Datos_celda;

class DatosCeldaController extends Controller
{
    // Propiedades
        // de definicion cuadro        
    public $id_definicion_celda;
    //public $id_definicion_cuadro;
    public $fila;
    public $columna;
    public $editable;
    public $tipo_dato;
    public $colspan;
    public $rowspan;
    public $titulo;
    public $valor_inicial;
    public $estilos;
    public $c_mapa;
    
    
    // de memoria
    public $c_categoria_consistencia; //  1= OK o (antes de consistir), 2= con advertencia , 3=con error  ver Tabla c_categoria_consistencia_tipo
    public $msg; // msg de texto describiendo su estado

 //   public $created_at;
 //   public $update_at;   
        //de datos celda
    public $id_datos_celda;
   // public $id_datos_cuadro; esto esta en las propiedades del cuadro
    public $valor;


    /**
     * Crear objeto celda.
     *
     * @return objeto creado
     */
    public function __construct($prop=[]) 
    {   
        //paso los datos del cuadro guardado a las propiedades de la instancia creada 
        $this->id_definicion_celda = isset($prop['id_definicion_celda']) ? $prop['id_definicion_celda'] : '';
        //$this->id_definicion_cuadro = isset($prop['id_definicion_cuadro']) ? $prop['id_definicion_cuadro'] : '';
        $this->fila = isset($prop['fila']) ? $prop['fila'] : '';
        $this->columna = isset($prop['columna']) ? $prop['columna'] : '';
        $this->editable = isset($prop['editable']) ? $prop['editable'] : '';
        $this->tipo_dato = isset($prop['tipo_dato']) ? $prop['tipo_dato'] : '';
        $this->colspan = isset($prop['colspan']) ? $prop['colspan'] : '';
        $this->rowspan = isset($prop['rowspan']) ? $prop['rowspan'] : '';
        $this->titulo = isset($prop['titulo']) ? $prop['titulo'] : '';
        $this->valor_inicial = isset($prop['valor_inicial']) ? $prop['valor_inicial'] : '';
        $this->estilos = isset($prop['estilos']) ? $prop['estilos'] : '';
        $this->c_mapa = isset($prop['c_mapa']) ? $prop['c_mapa'] : null;
        // de memoria
        $this->c_categoria_consistencia = isset($prop['c_categoria_consistencia']) ? $prop['c_categoria_consistencia'] : 1;       
        $this->msg = isset($prop['msg']) ? $prop['msg'] : '';
       
        //de datos celda
        $this->id_datos_celda = isset($prop['id_datos_celda']) ? $prop['id_datos_celda'] : null;
    //    $this->id_datos_cuadro = isset($prop['id_datos_cuadro']) ? $prop['id_datos_cuadro'] : '';  //esta prpiead va en el cuadro
        $this->valor = isset($prop['valor']) ? $prop['valor'] : '';


    }

// 
//      /**
//      * Devuelve un arreglo con la tabla de celdas de un cuadro dado por
//      *  $id_datos_cuadro,$id_definicion_cuadro
//      *
//      * @return $celdas = [filas][columnas];  
//      *
//      * ATENCION!!! FALTA AGREGAR CUADROS DE FILAS INFINITAS!!!!
//      *
//      *
//      */
//     public static function dat_celda_get_celdas_cuadro ($id_datos_cuadro,$id_definicion_cuadro, $ofertas)
//     {   
//         //recuperar las celdas del cuadro
//         $ac = Definicion_celda::  
//               	leftJoin ('datos_celda', function ($leftJoin) use ($id_datos_cuadro) { $leftJoin
//               	                            ->on ('datos_celda.id_definicion_celda','=', 'definicion_celda.id_definicion_celda')
//               	                            ->whereRaw ('"datos_celda"."id_datos_cuadro" = '.$id_datos_cuadro ); }
//               			 )
//             	->select ('definicion_celda.*', 'datos_celda.id_datos_celda',
//               	      'datos_celda.id_datos_cuadro','datos_celda.valor') 
//             	->where('definicion_celda.id_definicion_cuadro', $id_definicion_cuadro)->get();
        
//         $celdas = [];         
//         foreach ($ac as $c)
//         {   
//                    //recalculamos la visualizacion/ocultamiento de celdas dinamicas
//                     if ($c->c_mapa !=null   //  verifica oferta valida
//                                     and !array_key_exists($c->c_mapa, $ofertas) //la oferta esta en las ofertas validas
//                                     and strlen($c->valor)==0 )
//                         {
//                         //     $C->celdas[$fil][$col]->msg='Esta celda no debe contener datos, falta oferta activa';
//                         //     $C->celdas[$fil][$col]->c_categoria_consistencia=3; //3=error                            
//                             $c->titulo=false;  //poner la celda ciega
//                             $c->editable=false;
//                         }



//              if (!isset($c->id_datos_celda) and $c->editable)  
//              {	// la celda no existe en datos_celda hay que agregarla
//              		//inserto el nuevo registro en datos_celda
//              	$c->id_datos_celda = Datos_celda::insertGetId( ['id_definicion_celda' => $c->id_definicion_celda, 
//              													'id_datos_cuadro' => $id_datos_cuadro, 
//              													'valor' => $c->valor_inicial], 
//          	            										'id_datos_celda' );
//              	$c->id_datos_cuadro=$id_datos_cuadro;
//              	$c->valor= $c->valor_inicial;
//              }

//              // agregar la celdas a la tabla del cuadro
//             $celdas[$c->fila][$c->columna] = new DatosCeldaController(
// 												[   'id_definicion_celda' => $c->id_definicion_celda,
// 										            'fila' => $c->fila,
// 										            'columna' => $c->columna,
// 										            'editable' => $c->editable,
// 										            'tipo_dato' => $c->tipo_dato,
// 										            'colspan' => $c->colspan,
// 										            'rowspan' => $c->rowspan,
// 										            'titulo' => $c->titulo,
// 										            'valor_inicial' => $c->valor_inicial,
//                                                     'estilos' => $c->estilos,
//                                                     'c_mapa' => $c->c_mapa,
//                                                     // de memoria
//                                                     'c_categoria_consistencia' => 1,   ///1=OK o no determinado (antes de consistir)    
//                                                     'msg' => '',                                                    										            
// 										                    //de datos celda
// 										        	'id_datos_celda' => isset($c->id_datos_celda) ? $c->id_datos_celda : null ,
// 										        	//'id_datos_cuadro' => $id_datos_cuadro ;
// 										        	'valor' => ($c->editable) ? $c->valor : $c->valor_inicial     // si no es editable siempre se carga el valor_inicial
//												] );

/*            $celdas[$c->fila][$c->columna]->id_definicion_celda = $c->id_definicion_celda;
            $celdas[$c->fila][$c->columna]->fila = $c->fila;
            $celdas[$c->fila][$c->columna]->columna = $c->columna;
            $celdas[$c->fila][$c->columna]->editable = $c->editable;
            $celdas[$c->fila][$c->columna]->tipo_dato = $c->tipo_dato;
            $celdas[$c->fila][$c->columna]->colspan = $c->colspan;
            $celdas[$c->fila][$c->columna]->rowspan = $c->rowspan;
            $celdas[$c->fila][$c->columna]->titulo = $c->titulo;
            $celdas[$c->fila][$c->columna]->valor_inicial = $c->valor_inicial;
            
                    //de datos celda
        	$celdas[$c->fila][$c->columna]->id_datos_celda = isset($c->id_datos_celda) ? $c->id_datos_celda : null ;
        	//$celdas[$c->fila][$c->columna]->id_datos_cuadro = $id_datos_cuadro ;
        	$celdas[$c->fila][$c->columna]->valor = ($c->editable) ? $c->valor : $c->valor_inicial ;    // si no es editable siempre se carga el valor_inicial    */
    //     }  
    //     return $celdas;      

    // }

}
