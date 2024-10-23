<?php

namespace App\Http\Controllers\Formulario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Definicion_celda;
use App\Model\Definicion_cuadro;

class DefinicionCeldaController extends Controller
{

     public $id_definicion_celda;          
     public $id_definicion_cuadro;
     public $fila;
     public $columna;
     public $editable;
     public $tipo_dato;
     public $colspan;
     public $rowspan;
     public $titulo;
     public $valor_inicial;

     public $created_at;
     public $update_at;

     public $estilos;
     public $c_mapa;

     public $valor=0;

     /**
     * Crea un cuadro en memoria
     * de la class  (DefinicionCeldaController) 
     * si se da un $id_definicion_celda que debe existir, recupera el cuadro guardado
     * return objeto class DefinicionCuadroController
     * Ej: crear celda:
     *    $nueva_celda = new DefinicionCeldaController (['id_definicion_cuadro'=>1,'fila'=>1,'columna'=>1,'editable'=>1,'tipo_dato'=>integer ,'colspan'=>1,'rowspan'=>1,'titulo'=>'Total','valor_inicial'=>'' );
     * Ej. Recuperar Celda:
     *    $nueva_celda = new DefinicionCeldaController(1234);
     */ 
      
    public function __construct($propiedades=[]) 
    {   
        if (is_int($propiedades)) 
            {
                $propiedades=['id_definicion_celda'=>$propiedades];
            }
        if (isset($propiedades['id_definicion_celda']))
          { 
            // recuperar celda guardada
            $C=Definicion_celda::findOrFail($propiedades['id_definicion_celda']);
            //paso los datos de la celda guardada a las propiedades de la instancia creada 
            $this->id_definicion_celda = $C->id_definicion_celda;
            $this->id_definicion_cuadro = $C->id_definicion_cuadro;
            $this->fila = $C->fila;
            $this->columna = $C->columna;
            $this->editable = $C->editable;
            $this->tipo_dato = $C->tipo_dato;
            $this->colspan = $C->colspan;
            $this->rowspan = $C->rowspan;
            $this->titulo = $C->titulo;
            $this->valor_inicial = $C->valor_inicial;
            $this->created_at = $C->created_at;
            $this->update_at = $C->update_at;
            $this->estilos = $C->estilos;
            $this->c_mapa = $C->c_mapa;

          }
        else
          {  // se crea una celda nueva, inicializo propiedades a nulo                     
            $this->id_definicion_celda=0; // se da un id temporario hasta se grabe en la tabla de cuadros
            $this->id_definicion_cuadro =isset($propiedades['id_definicion_cuadro']) ? $propiedades['id_definicion_cuadro'] : '';
            $this->fila=isset($propiedades['fila']) ? $propiedades['fila'] : '';
            $this->columna=isset($propiedades['columna']) ? $propiedades['columna'] : '';
            $this->editable=isset($propiedades['editable']) ? $propiedades['editable'] : false;
            $this->tipo_dato=isset($propiedades['tipo_dato']) ? $propiedades['tipo_dato'] : 'null';
            $this->colspan=isset($propiedades['colspan']) ? $propiedades['colspan'] : 1;
            $this->rowspan=isset($propiedades['rowspan']) ? $propiedades['rowspan'] : 1;
            $this->titulo=isset($propiedades['titulo']) ? $propiedades['titulo'] : false;
            $this->valor_inicial=isset($propiedades['valor_inicial']) ? $propiedades['valor_inicial'] : '';
            $this->created_at=isset($propiedades['created_at']) ? $propiedades['created_at'] : null;
            $this->update_at=isset($propiedades['update_at']) ? $propiedades['update_at'] : null;
            $this->estilos=isset($propiedades['estilos']) ? $propiedades['estilos'] : '';
            $this->c_mapa=isset($propiedades['c_mapa']) ? $propiedades['c_mapa'] : null;
            
          } 
 
    } 
    /**
     * Devuelve un arreglo con las celdas de un cuadros de un formulario dado por
     *  id_definicion_cuadro.
     *
     * @return \Illuminate\Http\Response
     */
    public static function def_celda_get_celdas_cuadro ($id_definicion_cuadro)
    {   
        //recuperar los cuadros del formulario
        $ac = Definicion_cuadro::find($id_definicion_cuadro)->celdas;

         $celdas = []; //null; //[[],[]];
        
        foreach ($ac as $c)
        {  	
        	$celdas[$c->fila][$c->columna] = new DefinicionCeldaController();
        	$celdas[$c->fila][$c->columna]->id_definicion_celda = $c->id_definicion_celda;
        	$celdas[$c->fila][$c->columna]->id_definicion_cuadro = $c->id_definicion_cuadro;
        	$celdas[$c->fila][$c->columna]->fila = $c->fila;
        	$celdas[$c->fila][$c->columna]->columna = $c->columna;
        	$celdas[$c->fila][$c->columna]->editable = $c->editable;
			$celdas[$c->fila][$c->columna]->tipo_dato = $c->tipo_dato;
			$celdas[$c->fila][$c->columna]->colspan = $c->colspan;
			$celdas[$c->fila][$c->columna]->rowspan = $c->rowspan;
			$celdas[$c->fila][$c->columna]->titulo = $c->titulo;
			$celdas[$c->fila][$c->columna]->valor_inicial = $c->valor_inicial;
			$celdas[$c->fila][$c->columna]->created_at = $c->created_at;
			$celdas[$c->fila][$c->columna]->update_at = $c->update_at; 
            $celdas[$c->fila][$c->columna]->estilos = $c->estilos;  
            $celdas[$c->fila][$c->columna]->c_mapa = $c->c_mapa;          
        }  

        return $celdas;      

    }

    /**
     * Eliminar datos guardados del cuadro en tabla de cuadros
     * no afecta al objeto cuadro!! (DefinicionCuadroController)
     * return nada
     */ 
    public function def_celda_delete()
    {
        // eliminar datos una celda 
        Definicion_Celda::destroy($this->id_definicion_celda);
    }

    /**
     * Guardar los datos de un cuadro.
     * 
     * return
     * si es un nuevo cuadro se devuelve el id_definicion_cuadro asignado 
     * en el mismo objeto ($this)
     */
    public function def_celda_save ()   
    {   
        if (!is_null($this->id_definicion_celda) )             
        {       
            //guardar los datos de la celda
            if ($this->id_definicion_celda == 0 )   
                 { // la celda no existe previamente (insert)
                    $C= new Definicion_celda();                   
                 }
            else  // se modifica un celda existente
                {  
                    $C=Definicion_celda::findOrFail( $this->id_definicion_celda );                                                 
                }


            // almacenar los nuevos valores 
            $C->id_definicion_cuadro=$this->id_definicion_cuadro;                            
            $C->fila = $this->fila;
            $C->columna = $this->columna;
            $C->editable = $this->editable;
            $C->tipo_dato = $this->tipo_dato;
            $C->colspan = $this->colspan;
            $C->rowspan = $this->rowspan;
            $C->titulo = $this->titulo;
            $C->valor_inicial = $this->valor_inicial;
            $C->estilos = $this->estilos;
            $C->c_mapa = $this->c_mapa;
            //$C->created_at = $this->created_at;
            //$C->update_at = $this->update_at;

             
            $C->save();
            
            $this->id_definicion_celda=$C->id_definicion_celda; //recupero nuevo id de la celda            

        }
    }

}
