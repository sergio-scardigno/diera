<?php
namespace App\Http\Controllers\Formulario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Definicion_formulario;
use App\Http\Controllers\Formulario\DefinicionCuadroController;


class DefinicionFormularioController extends Controller
{   //propiedades del objeto Formulario
       //propiedades guardadas en tabla Definicion_formulario
    public  $id_definicion_formulario;
    public  $nombre;
    public  $nombre_corto;
    public  $descripcion;
    public  $id_periodo;
    public  $color;
    public  $created_at;
    public  $update_at; 
        // otras propiedades
    public  $cuadros; // arreglo de cuadros

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
    public function __construct($propiedades=[]) 
    {	
    	if (is_int($propiedades)) 
    		{
    			$propiedades=['id_definicion_formulario'=>$propiedades];
    		}
        if (isset($propiedades['id_definicion_formulario']))
       	  {     // recuperar formulario guardado
       	  	$F=Definicion_Formulario::FirstOrCreate(['id_definicion_formulario'=>$propiedades['id_definicion_formulario']],   
                    [   //asigno los valores si es nuevo
                      'nombre' => isset($propiedades['nombre']) ? $propiedades['nombre'] : 'Formulario',
                      'nombre_corto' => isset($propiedades['nombre_corto']) ? $propiedades['nombre_corto'] : 'Formulario',
                      'descripcion' => isset($propiedades['descripcion']) ? $propiedades['descripcion'] : 'Formulario',
                      'id_periodo' => isset($propiedades['id_periodo']) ? $propiedades['id_periodo'] : 79, 
                      'color' => isset($propiedades['color']) ? $propiedades['color'] : 'f_celeste'
                    ]);

                //paso los datos del formulario guardado a las propiedades de la instancia creada 
            $this->id_definicion_formulario = $F->id_definicion_formulario;
            $this->nombre = $F->nombre;
            $this->nombre_corto = $F->nombre_corto;
            $this->descripcion = $F->descripcion;
            $this->id_periodo = $F->id_periodo;
            $this->color = $F->color;
            $this->created_at = $F->created_at;
            $this->update_at = $F->update_at;
                // otras propiedades
                // recuperar los cuadros
            $this->cuadros= DefinicionCuadroController::def_cuadro_get_cuadros_formulario($F->id_definicion_formulario);

       	  }
       	else
       	  {  // se crea un formularios nuevo, inicializo propiedades a vacio      	  		    
			$this->id_definicion_formulario=0; // se da un id temporario hasta se grabe en la tabla de formularios
			$this->nombre= isset($propiedades['nombre']) ? $propiedades['nombre'] : '';
			$this->nombre_corto=isset($propiedades['nombre_corto']) ? $propiedades['nombre_corto'] : '';
			$this->descripcion=isset($propiedades['descripcion']) ? $propiedades['descripcion'] : '';
			$this->id_periodo=isset($propiedades['id_periodo']) ? $propiedades['id_periodo'] : '';
			$this->color=isset($propiedades['color']) ? $propiedades['color'] : '';
			$this->created_at=isset($propiedades['created_at']) ? $propiedades['created_at'] : null;
			$this->update_at=isset($propiedades['update_at']) ? $propiedades['update_at'] : null;
			// otras propiedades
			$this->cuadros=[];
		          
       	  } 
 
    } 

    


     /**
     * Eliminar datos guardados del formulario en tabla de formularios
     * no afecta al objeto formulario!! (DefinicionFormularioController)
     * return nada
     */ 
    public function def_formulario_delete()
    {
        // eliminar los cuadros de la BD
        foreach ($this->cuadros as $cuadro)
        { 
            $cuadro->def_cuadro_delete() ;
        }       
        // eliminar datos del formulario en la base de datos.     
        Definicion_Formulario::destroy($this->id_definicion_formulario);
    }

     /**
     * Guardar los datos de un formulario.
     *
     * return nada
     */         
    public function def_formulario_save ()   
    {   
     	if (!is_null($this->id_definicion_formulario) ) 	    	
        {			
	       	//guardar los datos del formulario
	        if ($this->id_definicion_formulario == 0 )   
	             { // el formulario no existe previamente (insert)
	             	$F= new Definicion_formulario();	             }
	        else  // se modifica un formulario
	        	{ 
	        		$F=Definicion_Formulario::findOrFail( $this->id_definicion_formulario );	        	           	     
	        	}

	        // almacenar los nuevos valores	
	        	        		    	
		    $F->nombre = $this->nombre;
		    $F->nombre_corto = $this->nombre_corto;
		    $F->descripcion = $this->descripcion;
		    $F->id_periodo = $this->id_periodo;
		    $F->color = $this->color;
		    $F->save();

            $this->id_definicion_formulario=$F->id_definicion_formulario; //recupero nuevo id del formulario            

            // almacenar los datos de los cuadros
            foreach ($this->cuadros as $cuadro)
            {   $cuadro->id_definicion_formulario=$this->id_definicion_formulario;
                $cuadro->def_cuadro_save() ;
            }    

		    		    

		}
    }


    /**
     * agrega un cuadro al formulario.
     *
     * return nada
     */         
    public function def_formulario_add_cuadro ($propiedades) 
    {
        if (!isset($this->cuadros[$propiedades['numero']]))
        {
            $this->cuadros[$propiedades['numero']]= new DefinicionCuadroController($propiedades);  //se crea un nuevo cuadro
        }

        //$c_nuevo->id_definicion_cuadro=0; // el constructor da un id temporario (0) hasta se grabe en la tabla de cuadros 
        $this->cuadros[$propiedades['numero']]->id_definicion_formulario =$this->id_definicion_formulario ;
        $this->cuadros[$propiedades['numero']]->numero=$propiedades['numero'];
        $this->cuadros[$propiedades['numero']]->nombre= isset($propiedades['nombre']) ? $propiedades['nombre'] : $this->cuadros[$propiedades['numero']]->nombre;        
        $this->cuadros[$propiedades['numero']]->descripcion=isset($propiedades['descripcion']) ? $propiedades['descripcion'] : $this->cuadros[$propiedades['numero']]->descripcion;
        $this->cuadros[$propiedades['numero']]->encabezado=isset($propiedades['encabezado']) ? $propiedades['encabezado'] : $this->cuadros[$propiedades['numero']]->encabezado;
        $this->cuadros[$propiedades['numero']]->indicaciones=isset($propiedades['indicaciones']) ? $propiedades['indicaciones'] : $this->cuadros[$propiedades['numero']]->indicaciones;
        $this->cuadros[$propiedades['numero']]->ayuda=isset($propiedades['ayuda']) ? $propiedades['ayuda'] : $this->cuadros[$propiedades['numero']]->ayuda;
        $this->cuadros[$propiedades['numero']]->c_tipo_cuadro= isset($propiedades['c_tipo_cuadro']) ? $propiedades['c_tipo_cuadro'] : $this->cuadros[$propiedades['numero']]->c_tipo_cuadro;
        $this->cuadros[$propiedades['numero']]->c_criterio_completitud= isset($propiedades['c_criterio_completitud']) ? $propiedades['c_criterio_completitud'] : $this->cuadros[$propiedades['numero']]->c_criterio_completitud;
        $this->cuadros[$propiedades['numero']]->ancho= isset($propiedades['ancho']) ? $propiedades['ancho'] : $this->cuadros[$propiedades['numero']]->ancho;
        $this->cuadros[$propiedades['numero']]->fecha_modificacion= isset($propiedades['fecha_modificacion']) ? $propiedades['fecha_modificacion'] : $this->cuadros[$propiedades['numero']]->fecha_modificacion;

        // eliminar  filas y columnas sobrantes x si el cuadro se está achicando
        $fil=$propiedades['filas'];
        $col=$propiedades['columnas'];

        if (isset ($this->cuadros[$propiedades['numero']]->celdas) and isset($fil) and isset($col))
        {
            // si el cuadro existe y tiene mas filas que las indicadas eliminamos las filas sobrantes
           // dd($this->cuadros[$propiedades['numero']]);
            $temp=[];
            if ($fil<count($this->cuadros[$propiedades['numero']]->celdas)
                 or ( (count($this->cuadros[$propiedades['numero']]->celdas)>=1) and  ($col<count($this->cuadros[$propiedades['numero']]->celdas[1]))  ) )
            {   // paso el array a un array temporal reordenado y truncando las filas y columnas que puedan sobrar
                for ($f=1; $f<=$fil ; $f++)
                {
                    for ($c=1; $c <= $col ; $c++)
                        { 
                            if ($f<=count($this->cuadros[$propiedades['numero']]->celdas) and $c<=count($this->cuadros[$propiedades['numero']]->celdas[1]))
                            {   
                                $temp[$f][$c]=$this->cuadros[$propiedades['numero']]->celdas[$f][$c];
                            }
                            else
                            {
                                 $temp[$f][$c]=new DefinicionCeldaController (['id_definicion_cuadro'=>$this->cuadros[$propiedades['numero']]->id_definicion_cuadro,'fila'=>$f,'columna'=>$c,
                                                                    'editable'=>true,'tipo_dato'=>'integer' ,'colspan'=>1,
                                                                    'rowspan'=>1,'titulo'=>false,'valor_inicial'=>'' ]);
                            }
                        }
                }
                $this->cuadros[$propiedades['numero']]->celdas=$temp;
            }
        }

    }  

    /**
     * eliminar todas las consistencias del formulario
     *
     *  
     */
    public function delete_consistencias()
    {
        DefinicionConsistenciaController::consistencia_fromulario_delete($this->$id_definicion_formulario);

    }    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
	{
	        //	    
		echo ' Definicion_formulario->Id          :' . $this->id_definicion_formulario. '<BR>';
		echo ' Definicion_formulario->nombre      :' . $this->nombre. '<BR>';
		echo ' Definicion_formulario->nombre_corto:' . $this->nombre_corto. '<BR>';
        echo ' Definicion_formulario->descripcion :' . $this->descripcion. '<BR>';
		echo ' Definicion_formulario->id_periodo  :' . $this->id_periodo. '<BR>';
		echo ' Definicion_formulario->color       :' . $this->color. '<BR>';
		echo ' Definicion_formulario->created_at  :' . $this->created_at. '<BR>';
		echo ' Definicion_formulario->update_at   :' . $this->update_at. '<BR>';  

		echo  '<BR>';
		echo  '<BR>';
		echo  '<BR>';

		IF (!is_null($this->cuadros))
		{	foreach ($this->cuadros as $cuadro)
			{
				echo 'CUADRO numero : '. $cuadro->numero.' ) '. $cuadro->nombre.'<BR>';
                echo 'Id: ' . $cuadro->id_definicion_cuadro . ' / '
                    . 'Desc: ' . $cuadro->descripcion . ' / '
                    . 'Encabezado: ' . $cuadro->encabezado . ' / '
                    . 'Indicaciones: ' . $cuadro->indicaciones . ' / '
                    . 'Ayuda: ' . $cuadro->ayuda . ' / '
                    . 'Tipo_Cuadro: ' . $cuadro->c_tipo_cuadro . ' / '
                    . 'Criterio_completitud: ' . $cuadro->c_criterio_completitud  . ' / '
                    . 'Ancho: ' . $cuadro->ancho.'<BR>';
				
		    	if (!empty($cuadro->celdas))
		    	{	echo 'Filas: '.count($cuadro->celdas) .'  ';
					echo 'columnas: '.count($cuadro->celdas[1]).'<BR>';
					echo '<table cellspacing="1" cellpadding="20" border="5px solid">';

                    /*foreach ($cuadro->celdas as $fila)
                    {   echo '<tr>';
                        foreach ($fila as $celda)
                        {   echo '<td align="center" bgcolor="#FFFFFF"> '                        
                                //  .$cuadro->celdas[$fil+1][$col+1]->id_definicion_cuadro.'<BR>'
                            . $celda->id_definicion_celda .'<BR>'
                            . $celda->valor_inicial
                            .' </td>';
                        }
                        echo '</tr>';             
                    }*/


					for ($fil=0;$fil<count($cuadro->celdas); $fil++)
					{	
						echo '<tr>';
                        if (isset($cuadro->celdas[$fil+1] ) )
                        {   
    						for ($col=0;$col<count($cuadro->celdas[$fil+1] );$col++)
    						{	
    							if (isset($cuadro->celdas[$fil+1][$col+1]))
                                {   echo '<td align="center" bgcolor="#FFFFFF"> '					     
    							      //  .$cuadro->celdas[$fil+1][$col+1]->id_definicion_cuadro.'<BR>'    							      
    							      . $cuadro->celdas[$fil+1][$col+1]->valor_inicial .'<BR>'
                                      . 'id_definicion_celda :'. $cuadro->celdas[$fil+1][$col+1]->id_definicion_celda .'<BR>'
                                      . 'fila: '. ($fil+1) . ', columna: '. ($col+1) . '<BR>'
                                      . 'clospan: ' . $cuadro->celdas[$fil+1][$col+1]->colspan .'<BR>'
                                      . 'rowspan: ' . $cuadro->celdas[$fil+1][$col+1]->rowspan .'<BR>'
                                      . 'titulo: ' . $cuadro->celdas[$fil+1][$col+1]->titulo .'<BR>'
                                      . 'editable: ' . $cuadro->celdas[$fil+1][$col+1]->editable .'<BR>'
                                      . 'tipo_dato: ' . $cuadro->celdas[$fil+1][$col+1]->tipo_dato .'<BR>'
                                      //. $cuadro->celdas[$fil+1][$col+1]->valor
    							      .' </td>';
                                }
                                else
                                {   echo '<td align="center" bgcolor="#FFFFFF"> ' .'</td>' ;}    
    						}
                        }
						echo '</tr>';
		    		}



		    		echo '</table> <BR><BR>';
		    	}
		    	else
		    	{	echo 'CUADRO SIN CELDAS'; }
		    }
		}
	    else 
	    {	echo 'FORMULARIO SIN CUADROS'; }

			
	}
	
}
