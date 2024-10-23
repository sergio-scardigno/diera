<?php
namespace App\Http\Controllers\Migrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Formulario\DefinicionFormularioController;

class DefinicionMigracionI2019Controller extends Controller
{
    ////

static public function I2019()
    {
   		// $F=DefinicionMigracionI2019Controller::I2019_INICIAL(30);
       	// $F=DefinicionMigracionI2019Controller::I2019_PRIMARIA(31);
       	// $F=DefinicionMigracionI2019Controller::I2019_SECUNDARIA(32);
       	// $F=DefinicionMigracionI2019Controller::I2019_SUPERIOR(33); 
		$F=DefinicionMigracionI2019Controller::I2019_EPA(34); 
		// $F=DefinicionMigracionI2019Controller::I2019_CENS(35);
		// $F=DefinicionMigracionI2019Controller::I2019_ESPECIAL(36); 
		// $F=DefinicionMigracionI2019Controller::I2019_ARTISTICA(37); 
		// $F=DefinicionMigracionI2019Controller::I2019_FP(38);
		// $F=DefinicionMigracionI2019Controller::I2019_CEC(39);        
		// $F=DefinicionMigracionI2019Controller::I2019_CEF(40);        
		// $F=DefinicionMigracionI2019Controller::I2019_CIIE(41);




        echo 'DEFINICION DE MIGRACIONES GENERADA:'. '<BR>';
		echo ' Definicion_formulario->Id          :' . $F->id_definicion_formulario. '<BR>';
		echo ' Definicion_formulario->nombre      :' . $F->nombre. '<BR>';
		//echo ' Definicion_formulario->nombre_corto:' . $F->nombre_corto. '<BR>';
		echo ' Definicion_formulario->descripcion :' . $F->descripcion. '<BR>';
		echo ' Definicion_formulario->id_periodo  :' . $F->id_periodo. '<BR>';

        



    }


static public function I2019_INICIAL ($id_definicion_formulario)
    {   
    	$F = new DefinicionFormularioController( $id_definicion_formulario);  // cargar el formulario

	// CUADRO 1) CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
		$C=$F->cuadros[1];
				
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 11 ],  [ 'celdas'=> [[2,2]] ] );  //  (DMC)		
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=>  1 ],  [ 'celdas'=> [[3,2]] ] );  // Comedor
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 12 ],  [ 'celdas'=> [[4,2]] ] );  // Módulo Simple
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 13 ],  [ 'celdas'=> [[5,2]] ] );  // Módulo Doble
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 14 ],  [ 'celdas'=> [[6,2]] ] );  // Módulo Completo
									   
	
	// CUADRO 2) ALUMNOS MATRICULADOS POR AÑO Y SEXO  (J. MATERNAL E J. INFANTES)
		$C=$F->cuadros[2];
        $C->save_cuadro_migrador (['id_oferta_educativa'=>1,
    		                                    'id_modalidad'=>0,
    		                                    'id_terminalidad_titulo'=>0,
    		                                    'id_modo_de_dictado'=>1,
    		                                    'id_caracteristica_matricula'=>1,
    		                                    'id_anio_estudio'=>1,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',
                                               ],  [ 'region'=> [[4,2,4,13]] ] );

		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_oferta_educativa'=>2 ],  [ 'region'=> [[4,8,4,13]] ] );

    	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>0],  [ 'columnas'=> [2,3] ] );
    	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>1],  [ 'columnas'=> [4,5] ] );
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>2],  [ 'columnas'=> [6,7] ] );
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>3],  [ 'columnas'=> [8,9] ] );
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>4],  [ 'columnas'=> [10,11] ] );
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>5],  [ 'columnas'=> [12,13] ] );
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'campo_destino'=>'mujer'],  [ 'celdas'=> [[4,3],[4,5],[4,7],[4,9],[4,11],[4,13]] ] );


// CUADRO 3) CANTIDAD DE SECCIONES POR EDAD DE LA SALA SEGÚN CICLO

		$C=$F->cuadros[3];
		$C->save_cuadro_migrador ([ 'id_oferta_educativa'=>1,
                                    'id_tipo_seccion'=>'I',
                                    'id_anio_estudio'=>0,
                                    'tabla_destino'=>'secciones',
                                    'campo_destino'=>'cantidad',
                                  ],  [ 'region'=> [[3,2,3,9]] ] );

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_oferta_educativa'=>2], [ 'region'=> [[3,6,3,9]] ] );

        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>0],  [ 'columnas'=> [2] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>1],  [ 'columnas'=> [3] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>2],  [ 'columnas'=> [4] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>999,'id_tipo_seccion'=>'M'],  [ 'columnas'=> [5] ] );

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>3],  [ 'columnas'=> [6] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>4],  [ 'columnas'=> [7] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>5],  [ 'columnas'=> [8] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>999, 'id_tipo_seccion'=>'M'],  ['columnas'=> [9] ] );


		
		
// CUADRO 4)  MATRÍCULA ATENDIDA DE MODALIDAD ARTÍSTICA Y ED. FÍSICA

		$C=$F->cuadros[4];
					// 'id_personal' = 1 personal propio / 2 de otro estab.
					//'id_servicio_complementario'= 5 Educación Física / 19 Plástica Visual / 20 Danza / 21 Música / 22 Teatro / 23 Literatura
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>5 ],  [ 'region'=> [[ 3,3, 6,3]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>19],  [ 'region'=> [[ 3,4, 6,4]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>20],  [ 'region'=> [[ 3,5, 6,5]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>21],  [ 'region'=> [[ 3,6, 6,6]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>22],  [ 'region'=> [[ 3,7, 6,7]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>23],  [ 'region'=> [[ 3,8, 6,8]] ] ); 

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>1, 'id_personal'=>1 ],  [ 'region'=> [[ 3,3, 3,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>1, 'id_personal'=>2 ],  [ 'region'=> [[ 4,3, 4,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>2, 'id_personal'=>1 ],  [ 'region'=> [[ 5,3, 5,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>2, 'id_personal'=>2 ],  [ 'region'=> [[ 6,3, 6,8]] ] );




// CUADRO 5) EQUIPO DE ORIENTACION ESCOLAR
		$C=$F->cuadros[5];
				
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'eoe','campo_destino'=>'eoe',  'id_servicio_complementario'=> 16 ],  [ 'celdas'=> [[3,2]] ] );  // EOE - (incluido en POF
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'eoe','campo_destino'=>'eoe',  'id_servicio_complementario'=> 17 ],  [ 'celdas'=> [[4,2]] ] );  // ED - Equipo de Distrito
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'eoe','campo_destino'=>'eoe',  'id_servicio_complementario'=> 18 ],  [ 'celdas'=> [[6,2]] ] );  // Extensión de EOE Escuela
									   




// CUADRO 6) ALUMNOS Y SECCIONES POR CICLO SEGÚN REGIMEN DE TURNOS
		$C=$F->cuadros[6];

	// turnos= M,I,T,V,N,D,A
				
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'alumnos', 
		                           'id_oferta_educativa'=>1, 'id_personal'=>1],  [ 'region'=> [[3,2,9,2]] ] );  // alumnos, maternal
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'secciones', 
		                           'id_oferta_educativa'=>1, 'id_personal'=>1],  [ 'region'=> [[3,3,9,3]] ] );  // secciones, maternal
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'alumnos', 
		                           'id_oferta_educativa'=>2, 'id_personal'=>1],  [ 'region'=> [[3,4,9,4]] ] );  // alumnos, Jardin Inf.
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'secciones', 
		                           'id_oferta_educativa'=>2, 'id_personal'=>1],  [ 'region'=> [[3,5,9,5]] ] );  // secciones, maternal

		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'M' ],  [ 'region'=> [[3,2,3,5]] ] );  // M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'I' ],  [ 'region'=> [[4,2,4,5]] ] );  // M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'T' ],  [ 'region'=> [[5,2,5,5]] ] );  // M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'V' ],  [ 'region'=> [[6,2,6,5]] ] );  // M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'N' ],  [ 'region'=> [[7,2,7,5]] ] );  // M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'D' ],  [ 'region'=> [[8,2,8,5]] ] );  // M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'A' ],  [ 'region'=> [[9,2,9,5]] ] );  // M



// CUADRO 7) ALUMNOS POR CICLO SEGÚN TIPO DE JORNADA
		$C=$F->cuadros[7];

	// JORNADA= 1) JOR. SIMPLE/ 2) JOR EXT. 30 / 3) JOR. DOBLE  40 / 4) JOR. AGROT.
				
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','campo_destino'=>'alumnos', 'id_oferta_educativa'=>1],  [ 'region'=> [[2,2,4,2]] ] );  // alumnos, maternal
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','campo_destino'=>'alumnos', 'id_oferta_educativa'=>2],  [ 'region'=> [[2,3,4,3]] ] );  // secciones, maternal

		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','id_tipo_jornada'=> '1' ],  [ 'region'=> [[2,2,2,3]] ] );  // j. simp.
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','id_tipo_jornada'=> '2' ],  [ 'region'=> [[3,2,3,3]] ] );  // j. ext.
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','id_tipo_jornada'=> '3' ],  [ 'region'=> [[4,2,4,3]] ] );  // j. dobl.





		return ($F);

    }







static public function I2019_PRIMARIA ($id_definicion_formulario)
    {
    	$F = new DefinicionFormularioController( $id_definicion_formulario);  // cargar el formulario

// CUADRO 1) CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
		$C=$F->cuadros[1];
				
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 11 ],  [ 'celdas'=> [[2,2]] ] );  //  (DMC)		
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=>  1 ],  [ 'celdas'=> [[3,2]] ] );  // Comedor
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 12 ],  [ 'celdas'=> [[4,2]] ] );  // Módulo Simple
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 13 ],  [ 'celdas'=> [[5,2]] ] );  // Módulo Doble
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 14 ],  [ 'celdas'=> [[6,2]] ] );  // Módulo Completo

// CUADRO 2) NIVEL PRIMARIO - ALUMNOS MATRICULADOS POR AÑO Y SEXO  (NIVEL PRIMARIO)
		$C=$F->cuadros[2];
    	$C->save_cuadro_migrador (['id_oferta_educativa'=>3,
    		                                    'id_modalidad'=>0,
    		                                    'id_terminalidad_titulo'=>0,
    		                                    'id_modo_de_dictado'=>1,
    		                                    'id_caracteristica_matricula'=>1,
    		                                    'id_anio_estudio'=>1,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',

                                               ],  [ 'region'=> [[3,2,3,13]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>1],  [ 'columnas'=> [2,3] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>2],  [ 'columnas'=> [4,5] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>3],  [ 'columnas'=> [6,7] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>4],  [ 'columnas'=> [8,9] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>5],  [ 'columnas'=> [10,11] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>6],  [ 'columnas'=> [12,13] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  [ 'celdas'=> [[3,3],[3,5],[3,7],[3,9],[3,11],[3,13]] ] );



// CUADRO 3) NIVEL PRIMARIO - CANTIDAD DE SECCIONES POR AÑO

		$C=$F->cuadros[3];
		$C->save_cuadro_migrador ([ 'id_oferta_educativa'=>3,
                                    'id_tipo_seccion'=>'I',
                                    'id_anio_estudio'=>0,
                                    'tabla_destino'=>'secciones',
                                    'campo_destino'=>'cantidad',
                                  ],  [ 'region'=> [[2,2,2,8]] ] );

        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>1],  [ 'columnas'=> [2] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>2],  [ 'columnas'=> [3] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>3],  [ 'columnas'=> [4] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>4],  [ 'columnas'=> [5] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>5],  [ 'columnas'=> [6] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>6],  [ 'columnas'=> [7] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>999, 'id_tipo_seccion'=>'M'],  ['columnas'=> [8] ] );



// CUADRO 4) NIVEL INICIAL - CANTIDAD DE ALUMNOS MATRICULADOS POR AÑO Y SEXO. (si su establecimiento posee curso preescolar)
		$C=$F->cuadros[4];
        $C->save_cuadro_migrador (['id_oferta_educativa'=>81,
    		                                    'id_modalidad'=>0,
    		                                    'id_terminalidad_titulo'=>0,
    		                                    'id_modo_de_dictado'=>1,
    		                                    'id_caracteristica_matricula'=>1,
    		                                    'id_anio_estudio'=>1,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',
                                               ],  [ 'region'=> [[4,2,4,13]] ] );

		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_oferta_educativa'=>82 ],  [ 'region'=> [[4,8,4,13]] ] );

    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>0],  [ 'columnas'=> [2,3] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>1],  [ 'columnas'=> [4,5] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>2],  [ 'columnas'=> [6,7] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>3],  [ 'columnas'=> [8,9] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>4],  [ 'columnas'=> [10,11] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>5],  [ 'columnas'=> [12,13] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  [ 'celdas'=> [[4,3],[4,5],[4,7],[4,9],[4,11],[4,13]] ] );



// CUADRO 5) NIVEL INICIAL  - CANTIDAD DE SECCIONES POR EDAD DE LA SALA SEGÚN CICLO

		$C=$F->cuadros[5];
		$C->save_cuadro_migrador ([ 'id_oferta_educativa'=>81,
                                    'id_tipo_seccion'=>'I',
                                    'id_anio_estudio'=>0,
                                    'tabla_destino'=>'secciones',
                                    'campo_destino'=>'cantidad',
                                  ],  [ 'region'=> [[3,2,3,9]] ] );

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_oferta_educativa'=>82], [ 'region'=> [[3,6,3,9]] ] );

        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>0],  [ 'columnas'=> [2] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>1],  [ 'columnas'=> [3] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>2],  [ 'columnas'=> [4] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>999,'id_tipo_seccion'=>'M'],  [ 'columnas'=> [5] ] );

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>3],  [ 'columnas'=> [6] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>4],  [ 'columnas'=> [7] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>5],  [ 'columnas'=> [8] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>999, 'id_tipo_seccion'=>'M'],  ['columnas'=> [9] ] );


// CUADRO 6) NIVEL SECUNDARIO - CANTIDAD DE ALUMNOS DE EDUCACIÓN SECUNDARIA BASICA POR AÑO Y SEXO (R.302/12). (Si su establecimiento aún conserva Nivel Secundario)
		$C=$F->cuadros[6];
        $C->save_cuadro_migrador (['id_oferta_educativa'=>66,
    		                                    'id_modalidad'=>0,
    		                                    'id_terminalidad_titulo'=>0,
    		                                    'id_modo_de_dictado'=>1,
    		                                    'id_caracteristica_matricula'=>1,
    		                                    'id_anio_estudio'=>1,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',
                                               ],  [ 'region'=> [[3,2,3,7]] ] );

    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>1],  [ 'columnas'=> [2,3] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>2],  [ 'columnas'=> [4,5] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>3],  [ 'columnas'=> [6,7] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  [ 'celdas'=> [[3,3],[3,5],[3,7]  ] ] );



// cuadro 7) NIVEL SECUNDARIO - CANTIDAD DE ALUMNOS DE EDUCACION SECUNDARIA CICLO SUPERIOR EN ESCUELAS DE ESB, SEGÚN ORIENTACIÓN R.302/2012

		$C=$F->cuadros[7];
        $C->save_cuadro_migrador (['id_oferta_educativa'=>84,
    		                                    'id_modalidad'=>0,
    		                                    'id_terminalidad_titulo'=>0,
    		                                    'id_modo_de_dictado'=>1,
    		                                    'id_caracteristica_matricula'=>1,
    		                                    'id_anio_estudio'=>1,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',
                                               ],  [ 'region'=> [[3,2,13,7]] ] );

    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>4],  [ 'region'=> [[3,2,13,3]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>5],  [ 'region'=> [[3,4,13,5]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>6],  [ 'region'=> [[3,6,13,7]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  [ 'region'=> [[3,3,13,3],[3,5,13,5],[3,7,13,7] ] ] );

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>102,'id_terminalidad_titulo'=>102],  [ 'filas'=> [3] ] ); //c. naturales
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>101,'id_terminalidad_titulo'=>101],  [ 'filas'=> [4] ] ); //c. soc.
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>109,'id_terminalidad_titulo'=>109],  [ 'filas'=> [5] ] ); //Comunicaciones
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>103,'id_terminalidad_titulo'=>103],  [ 'filas'=> [6] ] ); //EyC
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>110,'id_terminalidad_titulo'=>110],  [ 'filas'=> [7] ] ); //e. fisica
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>111,'id_terminalidad_titulo'=>111],  [ 'filas'=> [8] ] ); //lenguas esx.
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>104,'id_terminalidad_titulo'=>104],  [ 'filas'=> [9] ] );  //visuales
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>105,'id_terminalidad_titulo'=>105],  [ 'filas'=> [10] ] ); //danza
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>108,'id_terminalidad_titulo'=>108],  [ 'filas'=> [11] ] ); //literatura
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>106,'id_terminalidad_titulo'=>106],  [ 'filas'=> [12] ] ); //musica
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>107,'id_terminalidad_titulo'=>107],  [ 'filas'=> [13] ] ); //teatro



// CUADRO 8) NIVEL SECUNDARIO - CANTIDAD DE SECCIONES POR AÑO

		$C=$F->cuadros[8];
		$C->save_cuadro_migrador ([ 'id_oferta_educativa'=>66, //ciclo basico en Primaria
                                    'id_tipo_seccion'=>'I',
                                    'id_anio_estudio'=>0,
                                    'tabla_destino'=>'secciones',
                                    'campo_destino'=>'cantidad',
                                  ],  [ 'region'=> [[2,2,2,8]] ] );
		$C->save_cuadro_migrador ([ 'id_oferta_educativa'=>84, //ciclo superior orientado en Primaria
                                    'tabla_destino'=>'secciones',
                                  ],  [ 'region'=> [[2,5,2,7]] ] ); // el pluriaño queda en con ofera educ. 66

        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>1],  [ 'columnas'=> [2] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>2],  [ 'columnas'=> [3] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>3],  [ 'columnas'=> [4] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>4],  [ 'columnas'=> [5] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>5],  [ 'columnas'=> [6] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>6],  [ 'columnas'=> [7] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>999, 'id_tipo_seccion'=>'M'],  ['columnas'=> [8] ] );

		
		
// CUADRO 9) MATRÍCULA ATENDIDA DE MODALIDAD ARTÍSTICA Y ED. FÍSICA

		$C=$F->cuadros[9];
					// 'id_personal' = 1 personal propio / 2 de otro estab.
					//'id_servicio_complementario'= 5 Educación Física / 19 Plástica Visual / 20 Danza / 21 Música / 22 Teatro / 23 Literatura
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>5 ],  [ 'region'=> [[ 3,3,10,3]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>19],  [ 'region'=> [[ 3,4,10,4]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>20],  [ 'region'=> [[ 3,5,10,5]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>21],  [ 'region'=> [[ 3,6,10,6]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>22],  [ 'region'=> [[ 3,7,10,7]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>23],  [ 'region'=> [[ 3,8,10,8]] ] ); 

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>3  , 'id_personal'=>1 ],  [ 'region'=> [[ 3,3, 3,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>3  , 'id_personal'=>2 ],  [ 'region'=> [[ 4,3, 4,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>1  , 'id_personal'=>1 ],  [ 'region'=> [[ 5,3, 5,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>1  , 'id_personal'=>2 ],  [ 'region'=> [[ 6,3, 6,8]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>2  , 'id_personal'=>1 ],  [ 'region'=> [[ 7,3, 7,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>2  , 'id_personal'=>2 ],  [ 'region'=> [[ 8,3, 8,8]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>910, 'id_personal'=>1 ],  [ 'region'=> [[ 9,3, 9,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>910, 'id_personal'=>2 ],  [ 'region'=> [[10,3,10,8]] ] );



// CUADRO 10) ALUMNOS Y SECCIONES SEGÚN REGIMEN DE TURNOS
		$C=$F->cuadros[10];

	// turnos= M,I,T,V,N,D,A
				
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'alumnos', 
		                           'id_oferta_educativa'=>3  , 'id_personal'=>1],  [ 'region'=> [[3,2,9,2]] ] );  // alumnos, primaria
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'secciones', 
		                           'id_oferta_educativa'=>3  , 'id_personal'=>1],  [ 'region'=> [[3,3,9,3]] ] );  // secciones, primaria
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'alumnos', 
		                           'id_oferta_educativa'=>1  , 'id_personal'=>1],  [ 'region'=> [[3,4,9,4]] ] );  // alumnos, maternal
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'secciones', 
		                           'id_oferta_educativa'=>1  , 'id_personal'=>1],  [ 'region'=> [[3,5,9,5]] ] );  // secciones, maternal
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'alumnos', 
		                           'id_oferta_educativa'=>2  , 'id_personal'=>1],  [ 'region'=> [[3,6,9,6]] ] );  // alumnos, j. infantes
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'secciones', 
		                           'id_oferta_educativa'=>2  , 'id_personal'=>1],  [ 'region'=> [[3,7,9,7]] ] );  // secciones, j.infantes
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'alumnos', 
		                           'id_oferta_educativa'=>910, 'id_personal'=>1],  [ 'region'=> [[3,8,9,8]] ] );  // alumnos, sec.    
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'secciones', 
		                           'id_oferta_educativa'=>910, 'id_personal'=>1],  [ 'region'=> [[3,9,9,9]] ] );  // secciones, sec.    


		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'M' ],  [ 'region'=> [[3,2,3,9]] ] );  // M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'I' ],  [ 'region'=> [[4,2,4,9]] ] );  // M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'T' ],  [ 'region'=> [[5,2,5,9]] ] );  // M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'V' ],  [ 'region'=> [[6,2,6,9]] ] );  // M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'N' ],  [ 'region'=> [[7,2,7,9]] ] );  // M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'D' ],  [ 'region'=> [[8,2,8,9]] ] );  // M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'A' ],  [ 'region'=> [[9,2,9,9]] ] );  // M



// CUADRO 11)  ALUMNOS SEGÚN TIPO DE JORNADA:
		$C=$F->cuadros[11];

	// JORNADA= 1) JOR. SIMPLE/ 2) JOR EXT. 30 / 3) JOR. DOBLE  40 / 4) JOR. AGROT.
				
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','campo_destino'=>'alumnos', 'id_oferta_educativa'=>3  ],  [ 'region'=> [[2,2,4,2]] ] );  // primaria
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','campo_destino'=>'alumnos', 'id_oferta_educativa'=>1  ],  [ 'region'=> [[2,3,4,3]] ] );  // maternal
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','campo_destino'=>'alumnos', 'id_oferta_educativa'=>2  ],  [ 'region'=> [[2,4,4,4]] ] );  // j. infnates
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','campo_destino'=>'alumnos', 'id_oferta_educativa'=>910],  [ 'region'=> [[2,5,4,5]] ] );  // secundaria

		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','id_tipo_jornada'=> '1' ],  [ 'region'=> [[2,2,2,5]] ] );  // j. simp.
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','id_tipo_jornada'=> '2' ],  [ 'region'=> [[3,2,3,5]] ] );  // j. ext.
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','id_tipo_jornada'=> '3' ],  [ 'region'=> [[4,2,4,5]] ] );  // j. dobl.


// CUADRO 12) CANTIDAD DE ALUMNOS EN 1° AÑO SEGÚN SU ASISTENCIA A JARDÍN
		$C=$F->cuadros[12];
    	$C->save_cuadro_migrador (['id_oferta_educativa'=>3,
    		                                    'id_modalidad'=>0,
    		                                    'id_terminalidad_titulo'=>0,
    		                                    'id_modo_de_dictado'=>1,
    		                                    'id_caracteristica_matricula'=>9, //9 asistieron a sala de 5 anos - 10 no asistieron
    		                                    'id_anio_estudio'=>1,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',

                                               ],  [ 'region'=> [[3,2,4,3]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_caracteristica_matricula'=>10],  [ 'region'=>[[4,2,4,3]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  [ 'region'=> [[3,3,4,3] ] ] );




// CUADRO 13) EQUIPO DE ORIENTACION ESCOLAR
		$C=$F->cuadros[13];
				
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'eoe', 'campo_destino'=>'eoe', 'id_servicio_complementario'=> 15 ],  [ 'celdas'=> [[2,2]] ] );  // No posee equip
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'eoe', 'campo_destino'=>'eoe', 'id_servicio_complementario'=> 16 ],  [ 'celdas'=> [[3,2]] ] );  // EOE - (incluido en POF
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'eoe', 'campo_destino'=>'eoe', 'id_servicio_complementario'=> 17 ],  [ 'celdas'=> [[4,2]] ] );  // ED - Equipo de Distrito
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'eoe', 'campo_destino'=>'eoe', 'id_servicio_complementario'=> 18 ],  [ 'celdas'=> [[6,2]] ] );  // Extensión de EOE Escuela
									   





    	return ($F);





    } //function I2019_PRIMARIA






static public function I2019_SECUNDARIA ($id_definicion_formulario)
    {
    	$F = new DefinicionFormularioController( $id_definicion_formulario);  // cargar el formulario


// CUADRO 1) CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
		$C=$F->cuadros[1];
				
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 11 ],  [ 'celdas'=> [[2,2]] ] );  //  (DMC)		
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=>  1 ],  [ 'celdas'=> [[3,2]] ] );  // Comedor
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 12 ],  [ 'celdas'=> [[4,2]] ] );  // Módulo Simple
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 13 ],  [ 'celdas'=> [[5,2]] ] );  // Módulo Doble
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 14 ],  [ 'celdas'=> [[6,2]] ] );  // Módulo Completo
									   
	 	

// CUADRO 2) NIVEL SECUNDARIO - CANTIDAD DE ALUMNOS DE ED. SECUNDARIA - CICLO BÁSICO (R.302/12) POR AÑOY SEXO
		$C=$F->cuadros[2];
    	$C->save_cuadro_migrador (['id_oferta_educativa'=>63,
    		                                    'id_modalidad'=>0,
    		                                    'id_terminalidad_titulo'=>0,
    		                                    'id_modo_de_dictado'=>1,
    		                                    'id_caracteristica_matricula'=>1,
    		                                    'id_anio_estudio'=>1,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',
                                  ],  [ 'region'=>[[3,2,5,9]] ] );

    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>1],  [ 'region'=> [[3,2,5,3]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>2],  [ 'region'=> [[3,4,5,5]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>3],  [ 'region'=> [[3,6,5,7]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>123],[ 'region'=> [[3,8,5,9]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  [ 'region'=> [[3,3,5,3],[3,5,5,5],[3,7,5,7],[3,9,5,9] ] ] );

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_oferta_educativa'=>63],  [ 'filas'=> [3] ] ); //Ed. sec. orientada (R.3186/07)
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_oferta_educativa'=>75],  [ 'filas'=> [4] ] ); //Ed. sec. técnica (R88/09)
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_oferta_educativa'=>78],  [ 'filas'=> [5] ] ); //Ed. sec. agropecuaria (R88/09)
		


// cuadro 3) NIVEL SECUNDARIO - CANTIDAD DE ALUMNOS DE EDUCACIÓN SECUNDARIA CICLO SUPERIOR ORIENTADO POR AÑO Y SEXO SEGÚN ORIENTACIÓN. R.302/12

		$C=$F->cuadros[3];
        $C->save_cuadro_migrador (['id_oferta_educativa'=>72,
    		                                    'id_modalidad'=>0,
    		                                    'id_terminalidad_titulo'=>0,
    		                                    'id_modo_de_dictado'=>1,
    		                                    'id_caracteristica_matricula'=>1,
    		                                    'id_anio_estudio'=>1,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',
                                               ],  [ 'region'=> [[3,2,14,7]] ] );

    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>4],  [ 'region'=> [[3,2,14,3]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>5],  [ 'region'=> [[3,4,14,5]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>6],  [ 'region'=> [[3,6,14,7]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  [ 'region'=> [[3,3,14,3],[3,5,14,5],[3,7,14,7] ] ] );

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>102,'id_terminalidad_titulo'=>102],  [ 'filas'=> [3] ] ); //c. naturales
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>101,'id_terminalidad_titulo'=>101],  [ 'filas'=> [4] ] ); //c. soc.
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>109,'id_terminalidad_titulo'=>109],  [ 'filas'=> [5] ] ); //Comunicaciones
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>103,'id_terminalidad_titulo'=>103],  [ 'filas'=> [6] ] ); //EyC
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>110,'id_terminalidad_titulo'=>110],  [ 'filas'=> [7] ] ); //e. fisica
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>111,'id_terminalidad_titulo'=>111],  [ 'filas'=> [8] ] ); //lenguas esx.
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>112,'id_terminalidad_titulo'=>112],  [ 'filas'=> [9] ] );  //turismo
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>104,'id_terminalidad_titulo'=>104],  [ 'filas'=> [10] ] );  //visuales
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>105,'id_terminalidad_titulo'=>105],  [ 'filas'=> [11] ] ); //danza
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>108,'id_terminalidad_titulo'=>108],  [ 'filas'=> [12] ] ); //literatura
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>106,'id_terminalidad_titulo'=>106],  [ 'filas'=> [13] ] ); //musica
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>107,'id_terminalidad_titulo'=>107],  [ 'filas'=> [14] ] ); //teatro




// cuadro 4) NIVEL SECUNDARIO - CANTIDAD DE ALUMNOS DE EDUCACIÓN SECUNDARIA ARTÍSTICA. POR AÑO Y SEXO SEGÚN LENGUAJE / DISCIPLINA. R.3066/15 y 169/16.

		$C=$F->cuadros[4];
        $C->save_cuadro_migrador (['id_oferta_educativa'=>76,
    		                                    'id_modalidad'=>0,
    		                                    'id_terminalidad_titulo'=>0,
    		                                    'id_modo_de_dictado'=>1,
    		                                    'id_caracteristica_matricula'=>1,
    		                                    'id_anio_estudio'=>1,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',
                                               ],  [ 'region'=> [[3,2,11,13]] ] );

		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_oferta_educativa'=>77 ],  [ 'region'=> [[3,8,11,13]] ] );
		
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>1],  [ 'region'=> [[3,2,11,3]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>2],  [ 'region'=> [[3,4,11,5]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>3],  [ 'region'=> [[3,6,11,7]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>4],  [ 'region'=> [[3,8,11,9]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>5],  [ 'region'=> [[3,10,11,11]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>6],  [ 'region'=> [[3,12,11,13]] ] );

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  [ 'region'=> [[3,3,11,3],[3,5,11,5],[3,7,11,7], [3,9,11,9],[3,11,11,11],[3,13,11,13] ] ] );

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>501,'id_terminalidad_titulo'=>501],  [ 'filas'=> [3] ] ); //ceramica
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>502,'id_terminalidad_titulo'=>502],  [ 'filas'=> [4] ] ); //grabado
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>503,'id_terminalidad_titulo'=>503],  [ 'filas'=> [5] ] ); //pintura
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>504,'id_terminalidad_titulo'=>504],  [ 'filas'=> [6] ] ); //escultura
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>505,'id_terminalidad_titulo'=>505],  [ 'filas'=> [7] ] ); //danzas o. esc.
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>506,'id_terminalidad_titulo'=>506],  [ 'filas'=> [8] ] ); //danzas o. flok y polular
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>507,'id_terminalidad_titulo'=>507],  [ 'filas'=> [9] ] );  //musica instr.
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>508,'id_terminalidad_titulo'=>508],  [ 'filas'=> [10] ] ); //musica en vivo
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>509,'id_terminalidad_titulo'=>509],  [ 'filas'=> [11] ] ); //teatro pop.






// cuadro 5) NIVEL SECUNDARIO -  CANTIDAD DE ALUMNOS DE EDUCACIÓN SECUNDARIA CICLO SUPERIOR TECNICO Y AGRARIO POR AÑO Y SEXO SEGÚN ORIENTACIÓN. R.302/12..

		$C=$F->cuadros[5];
        $C->save_cuadro_migrador (['id_oferta_educativa'=>0,
    		                                    'id_modalidad'=>0,
    		                                    'id_terminalidad_titulo'=>0,
    		                                    'id_modo_de_dictado'=>1,
    		                                    'id_caracteristica_matricula'=>1,
    		                                    'id_anio_estudio'=>1,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',
                                               ],  [ 'region'=> [[4,2,23,9]] ] );

		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_oferta_educativa'=>73 ],  [ 'region'=> [[4,2,20,9]] ] ); //ESST superior tecnica
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_oferta_educativa'=>79 ],  [ 'region'=> [[22,2,23,9]] ] ); // ESSA superior agraria
		
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>4],  [ 'region'=> [[4,2,23,3]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>5],  [ 'region'=> [[4,4,23,5]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>6],  [ 'region'=> [[4,6,23,7]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>7],  [ 'region'=> [[4,8,23,9]] ] );

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  [ 'region'=> [[4,3,23,3],[4,5,23,5],[4,7,23,7], [4,9,23,9] ] ] );

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>207,'id_terminalidad_titulo'=>207],  [ 'filas'=> [4] ] ); //M.M.O  
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>209,'id_terminalidad_titulo'=>209],  [ 'filas'=> [5] ] ); //AVIONICO
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>213,'id_terminalidad_titulo'=>213],  [ 'filas'=> [6] ] ); //C. NAVAL 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>202,'id_terminalidad_titulo'=>202],  [ 'filas'=> [7] ] ); //ADM. DE ORG.
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>208,'id_terminalidad_titulo'=>208],  [ 'filas'=> [8] ] ); //AERONAUTICA
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>210,'id_terminalidad_titulo'=>210],  [ 'filas'=> [9] ] );  //AUTOMOTORES
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>201,'id_terminalidad_titulo'=>201],  [ 'filas'=> [10] ] ); //ELECTROMECANICA
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>205,'id_terminalidad_titulo'=>205],  [ 'filas'=> [11] ] ); //ELECTRONICA
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>206,'id_terminalidad_titulo'=>206],  [ 'filas'=> [12] ] ); //INF. PERSONAL
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>212,'id_terminalidad_titulo'=>212],  [ 'filas'=> [13] ] ); //MULTIMEDIOS
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>211,'id_terminalidad_titulo'=>211],  [ 'filas'=> [14] ] ); //TURISTICO
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>204,'id_terminalidad_titulo'=>204],  [ 'filas'=> [15] ] ); //ALIMENTOS
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>203,'id_terminalidad_titulo'=>203],  [ 'filas'=> [16] ] ); //QUIMICO
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>215,'id_terminalidad_titulo'=>215],  [ 'filas'=> [17] ] ); //PROGRAMACION
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>216,'id_terminalidad_titulo'=>216],  [ 'filas'=> [18] ] ); //MECANICA
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>217,'id_terminalidad_titulo'=>217],  [ 'filas'=> [19] ] ); //ELECTRICIDAD
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>218,'id_terminalidad_titulo'=>218],  [ 'filas'=> [20] ] ); //ENERGIAS RENOVABLES

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>313,'id_terminalidad_titulo'=>313],  [ 'filas'=> [22] ] ); //teatro pop.
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>314,'id_terminalidad_titulo'=>314],  [ 'filas'=> [23] ] ); //teatro pop.





// cuadro 6) NIVEL SECUNDARIO -  CANTIDAD DE ALUMNOS DE POLIMODAL DE CUATRO AÑOS. Resoluciones Nº12.468/99 y 12.763/99 Vespertino/Nocturno.

		$C=$F->cuadros[6];
        $C->save_cuadro_migrador (['id_oferta_educativa'=>6,
    		                                    'id_modalidad'=>0,
    		                                    'id_terminalidad_titulo'=>0,
    		                                    'id_modo_de_dictado'=>1,
    		                                    'id_caracteristica_matricula'=>1,
    		                                    'id_anio_estudio'=>1,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',
                                               ],  [ 'region'=> [[3,2,7,9]] ] );

		
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>1],  [ 'region'=> [[3,2, 7,3]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>2],  [ 'region'=> [[3,4, 7,5]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>3],  [ 'region'=> [[3,6, 7,7]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>4],  [ 'region'=> [[3,8, 7,9]] ] );

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  [ 'region'=> [[3,3, 7,3],[3,5, 7,5],[3,7, 7,7], [3,9, 7,9] ] ] );

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>20,'id_terminalidad_titulo'=>20000],  [ 'filas'=> [3] ] ); //Cs NAT
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>50,'id_terminalidad_titulo'=>50000],  [ 'filas'=> [4] ] ); //Comunic. arte
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>30,'id_terminalidad_titulo'=>30000],  [ 'filas'=> [5] ] ); //EyC 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>10,'id_terminalidad_titulo'=>10000],  [ 'filas'=> [6] ] ); //H y Cs. Soc  
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_modalidad'=>40,'id_terminalidad_titulo'=>40000],  [ 'filas'=> [7] ] ); //ByS.




// cuadro 7) NIVEL SECUNDARIO -  CANTIDAD DE ALUMNOS DE BACHILLERATO PARA ADULTOS, PLAN DE 3 AÑOS POR AÑO Y SEXO SEGÚN ESPECIALIDAD

		$C=$F->cuadros[7];
        $C->save_cuadro_migrador ([  		    'id_oferta_educativa'=>8,
    		                                    'id_modalidad'=>100, // valor por defecto, si no se carga combo
    		                                    'id_terminalidad_titulo'=>0, // valor por defecto, si no se carga combo
    		                                    'id_modo_de_dictado'=>1, // valor por defecto, si no se carga combo
    		                                    'id_caracteristica_matricula'=>1,
    		                                    'id_anio_estudio'=>1,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',
    		                                    'col_combo1'=>1,
    		                                    'cp_destino1'=>'id_oferta_educativa',
    		                                    'col_combo2'=>2,
    		                                    'cp_destino2'=>'id_modalidad_de_dictado',
                                               ],  [ 'region'=> [[3,3,3,8]] ] );

		
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>1],  [ 'region'=> [[3,3, 3,4]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>2],  [ 'region'=> [[3,5, 3,6]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>3],  [ 'region'=> [[3,7, 3,8]] ] );

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  [ 'celdas'=> [[3,4],[3,6],[3,8]] ] );




// cuadro 8) NIVEL SECUNDARIO -   CANTIDAD DE ALUMNOS DE BACHILLERATO PARA ADULTOS, PLAN DE 4 AÑOS POR AÑO Y SEXO SEGÚN ESPECIALIDAD

		$C=$F->cuadros[8];
        $C->save_cuadro_migrador ([  		    'id_oferta_educativa'=>80,
    		                                    'id_modalidad'=>100, //valor por defecto, si no se carga combo
    		                                    'id_terminalidad_titulo'=>0, //valor por defecto, si no se carga combo
    		                                    'id_modo_de_dictado'=>1,
    		                                    'id_caracteristica_matricula'=>1,
    		                                    'id_anio_estudio'=>1,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',
    		                                    'col_combo1'=>1,
    		                                    'cp_destino1'=>'id_oferta_educativa',
    		                                //    'col_combo2'=>2,
    		                                //    'cp_destino2'=>'id_modalidad_de_dictado',
                                               ],  [ 'region'=> [[3,2,3,9]] ] );

		
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>1],  [ 'region'=> [[3,2, 3,3]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>2],  [ 'region'=> [[3,4, 3,5]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>3],  [ 'region'=> [[3,6, 3,7]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>4],  [ 'region'=> [[3,8, 3,9]] ] );

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  [ 'celdas'=> [[3,3],[3,5],[3,7],[3,9]] ] );




// cuadro 9) NIVEL SECUNDARIO -   CANTIDAD DE ALUMNOS DE SISTEMA DUAL POR AÑO Y SEXO SEGÚN ESPECIALIDAD Y TÍTULO

		$C=$F->cuadros[9];
        $C->save_cuadro_migrador ([  		    'id_oferta_educativa'=>9,
    		                                    'id_modalidad'=>80, //valor por defecto, si no se carga combo
    		                                    'id_terminalidad_titulo'=>80000, //valor por defecto, si no se carga combo
    		                                    'id_modo_de_dictado'=>1,
    		                                    'id_caracteristica_matricula'=>1,
    		                                    'id_anio_estudio'=>1,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',
    		                                    'col_combo1'=>1,
    		                                    'cp_destino1'=>'id_oferta_educativa',
    		                                //    'col_combo2'=>2,
    		                                //    'cp_destino2'=>'id_modalidad_de_dictado',
                                               ],  [ 'region'=> [[3,2,3,7]] ] );

		
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>1],  [ 'region'=> [[3,2, 3,3]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>2],  [ 'region'=> [[3,4, 3,5]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>3],  [ 'region'=> [[3,6, 3,7]] ] );

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  [ 'celdas'=> [[3,3],[3,5],[3,7]] ] );



// cuadro 10) NIVEL SECUNDARIO -   CANTIDAD DE ALUMNOS DE TRAYECTOS TÉCNICOS PROFESIONALES POR AÑO Y SEXO SEGÚN TRAYECTO Y MODALIDAD

		$C=$F->cuadros[10];
        $C->save_cuadro_migrador ([  		    'id_oferta_educativa'=>11,
    		                                    'id_modalidad'=>10, //valor por defecto, si no se carga combo
    		                                    'id_terminalidad_titulo'=>10000,//valor por defecto, si no se carga combo
    		                                    'id_modo_de_dictado'=>1,
    		                                    'id_caracteristica_matricula'=>18,
    		                                    'id_anio_estudio'=>1,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',
    		                                    'col_combo1'=>1,
    		                                    'cp_destino1'=>'id_oferta_educativa',
    		                                //    'col_combo2'=>2,
    		                                //    'cp_destino2'=>'id_modalidad_de_dictado',
                                               ],  [ 'region'=> [[3,2,3,9]] ] );

		
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>1],  [ 'region'=> [[3,2, 3,3]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>2],  [ 'region'=> [[3,4, 3,5]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>3],  [ 'region'=> [[3,6, 3,7]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>4],  [ 'region'=> [[3,8, 3,9]] ] );

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  [ 'celdas'=> [[3,3],[3,5],[3,7],[3,9]] ] );

// cuadro 11) NIVEL SECUNDARIO -   CANTIDAD DE ALUMNOS DE ITINERARIOS FORMATIVOS POR AÑO Y SEXO SEGÚN ITINERARIO FORMATIVO Y MODALIDAD

		$C=$F->cuadros[11];
        $C->save_cuadro_migrador ([  		    'id_oferta_educativa'=>64,
    		                                    'id_modalidad'=>10, //valor por defecto, si no se carga combo
    		                                    'id_terminalidad_titulo'=>641000, //valor por defecto, si no se carga combo
    		                                    'id_modo_de_dictado'=>1,
    		                                    'id_caracteristica_matricula'=>19,
    		                                    'id_anio_estudio'=>1,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',
    		                                    'col_combo1'=>1,
    		                                    'cp_destino1'=>'id_oferta_educativa',
    		                                //    'col_combo2'=>2,
    		                                //    'cp_destino2'=>'id_modalidad_de_dictado',
                                               ],  [ 'region'=> [[3,2,3,9]] ] );

		
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>4],  [ 'region'=> [[3,2, 3,3]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>5],  [ 'region'=> [[3,4, 3,5]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>6],  [ 'region'=> [[3,6, 3,7]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>7],  [ 'region'=> [[3,8, 3,9]] ] );

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  [ 'celdas'=> [[3,3],[3,5],[3,7],[3,9]] ] );





// cuadro 12) NIVEL SECUNDARIO -    CANTIDAD DE ALUMNOS DE CAPACITACIÓN POST-PRIMARIA (CEA, Cursos cortos de Oficio, etc.) POR AÑO Y SEXO SEGÚN CURSO

		$C=$F->cuadros[12];
        $C->save_cuadro_migrador ([  		    'id_oferta_educativa'=>12,
    		                                    'id_modalidad'=>70,  //valor por defecto, si no se carga combo
    		                                    'id_terminalidad_titulo'=>70000, //valor por defecto, si no se carga combo
    		                                    'id_modo_de_dictado'=>1,
    		                                    'id_caracteristica_matricula'=>1,
    		                                    'id_anio_estudio'=>1,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',
    		                                    'col_combo1'=>1,
    		                                    'cp_destino1'=>'id_oferta_educativa',
    		                                //    'col_combo2'=>2,
    		                                //    'cp_destino2'=>'id_modalidad_de_dictado',
                                               ],  [ 'region'=> [[3,2,3,7]] ] );

		
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>1],  [ 'region'=> [[3,2, 3,3]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>2],  [ 'region'=> [[3,4, 3,5]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>3],  [ 'region'=> [[3,6, 3,7]] ] );

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  [ 'celdas'=> [[3,3],[3,5],[3,7]] ] );




// CUADRO 13) NIVEL SECUNDARIO - CANTIDAD DE DIVISIONES / GRUPOS POR AÑO Y MODALIDAD

		$C=$F->cuadros[13];
		$C->save_cuadro_migrador ([ 'id_oferta_educativa'=>0, //ciclo basico en Primaria
                                    'id_tipo_seccion'=>'I',
                                    'id_anio_estudio'=>0,
                                    'tabla_destino'=>'secciones',
                                    'campo_destino'=>'cantidad',
                                  ],  [ 'region'=> [[2,2,13,10]] ] );

		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>63],  [ 'region'=> [[2,2,2,4],[2,9,2,10]] ] ); // ESB orientada 
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>72],  [ 'region'=> [[2,5,2,7]] ] ); // ESS orientada 

		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>75],  [ 'region'=> [[3,2,3,4],[3,9,3,10]] ] ); // ESB tecnica 
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>73],  [ 'region'=> [[3,5,3,8]] ] ); // ESS tecnica 

		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>78],  [ 'region'=> [[4,2,4,4]], 'celdas'=>[[4,9]] ] ); // ESB agraria 
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>79],  [ 'region'=> [[4,5,4,8]] ] ); // ESS agraria 

		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>76],  [ 'region'=> [[5,2,5,4]], 'celdas'=>[[5,9]] ] ); // ESB arte 
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>77],  [ 'region'=> [[5,5,5,8]] ] ); // ESS arte

		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>6],  [ 'region'=> [[6,2,6,5]] ] ); // polimodal.
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>8],  [ 'region'=> [[7,2,7,4]] ] ); // bach adulos 3 años
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>80], [ 'region'=> [[8,2,8,5]] ] ); // bac. adultos 4 años
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>8,'id_tipo_seccion'=>'A'],  [ 'region'=> [[9,2,9,4]] ] ); // bac. adultos 3 años
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>9],  [ 'region'=> [[10,2,10,4]] ] ); // sist. dual
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>11], [ 'region'=> [[11,2,11,5]] ] ); // TTP
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>64], [ 'region'=> [[12,5,12,8]] ] ); // IF
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>12], [ 'region'=> [[13,2,13,4]] ] ); // Cursos de FP


        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>1],  [ 'region'=> [[2,2,13,2]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>2],  [ 'region'=> [[2,3,13,3]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>3],  [ 'region'=> [[2,4,13,4]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>4],  [ 'region'=> [[2,5,13,5]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>5],  [ 'region'=> [[2,6,13,6]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>6],  [ 'region'=> [[2,7,13,7]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>7],  [ 'region'=> [[2,8,13,8]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>999,'id_tipo_seccion'=>'M'],  ['region'=> [[2,9,5,9]]  ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>123],  [ 'region'=> [[2,10,3,10]] ] );



// CUADRO 14) EQUIPO DE ORIENTACION ESCOLAR
		$C=$F->cuadros[14];
				
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'eoe', 'campo_destino'=>'eoe', 'id_servicio_complementario'=> 15 ],  [ 'celdas'=> [[2,2]] ] );  // No posee equip
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'eoe', 'campo_destino'=>'eoe', 'id_servicio_complementario'=> 16 ],  [ 'celdas'=> [[3,2]] ] );  // EOE - (incluido en POF
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'eoe', 'campo_destino'=>'eoe', 'id_servicio_complementario'=> 17 ],  [ 'celdas'=> [[4,2]] ] );  // ED - Equipo de Distrito
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'eoe', 'campo_destino'=>'eoe', 'id_servicio_complementario'=> 18 ],  [ 'celdas'=> [[6,2]] ] );  // Extensión de EOE Escuela
									   
// CUADRO 15) CONFORMACIONES DE SECUNDARIAS	
		// NO SE MIGRA
		
		
// CUADRO 16) MATRÍCULA ATENDIDA DE MODALIDAD ARTÍSTICA Y ED. FÍSICA

		$C=$F->cuadros[16];
					// 'id_personal' = 1 personal propio / 2 de otro estab.
					//'id_servicio_complementario'= 5 Educación Física / 19 Plástica Visual / 20 Danza / 21 Música / 22 Teatro / 23 Literatura
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>5 ],  [ 'region'=> [[ 3,3,18,3]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>19],  [ 'region'=> [[ 3,4,18,4]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>20],  [ 'region'=> [[ 3,5,18,5]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>21],  [ 'region'=> [[ 3,6,18,6]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>22],  [ 'region'=> [[ 3,7,18,7]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>23],  [ 'region'=> [[ 3,8,18,8]] ] ); 

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>910, 'id_personal'=>1 ],  [ 'region'=> [[ 3,3, 3,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>910, 'id_personal'=>2 ],  [ 'region'=> [[ 4,3, 4,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>911, 'id_personal'=>1 ],  [ 'region'=> [[ 5,3, 5,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>911, 'id_personal'=>2 ],  [ 'region'=> [[ 6,3, 6,8]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>912, 'id_personal'=>1 ],  [ 'region'=> [[ 7,3, 7,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>912, 'id_personal'=>2 ],  [ 'region'=> [[ 8,3, 8,8]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>913, 'id_personal'=>1 ],  [ 'region'=> [[ 9,3, 9,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>913, 'id_personal'=>2 ],  [ 'region'=> [[10,3,10,8]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>  6, 'id_personal'=>1 ],  [ 'region'=> [[11,3,11,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>  6, 'id_personal'=>2 ],  [ 'region'=> [[12,3,12,8]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>  8, 'id_personal'=>1 ],  [ 'region'=> [[13,3,13,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>  8, 'id_personal'=>2 ],  [ 'region'=> [[14,3,14,8]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=> 80, 'id_personal'=>1 ],  [ 'region'=> [[15,3,15,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=> 80, 'id_personal'=>2 ],  [ 'region'=> [[16,3,16,8]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>  9, 'id_personal'=>1 ],  [ 'region'=> [[17,3,17,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=>  9, 'id_personal'=>2 ],  [ 'region'=> [[18,3,18,8]] ] );




// CUADRO 17) CANTIDAD DE ALUMNOS Y SECCIONES POR TURNO SEGÚN MODALIDAD
		$C=$F->cuadros[17];

	// turnos= M,I,T,V,N,D,A
				
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'alumnos', 
		                           'id_oferta_educativa'=>910, 'id_personal'=>1],  [ 'region'=> [[3, 2,9, 2]] ] );  // alumnos, sec. orient.
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'secciones', 
		                           'id_oferta_educativa'=>910, 'id_personal'=>1],  [ 'region'=> [[3, 3,9, 3]] ] );  // secciones, sec. orient
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'alumnos', 
		                           'id_oferta_educativa'=>911, 'id_personal'=>1],  [ 'region'=> [[3, 4,9, 4]] ] );  // alumnos, tec.
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'secciones', 
		                           'id_oferta_educativa'=>911, 'id_personal'=>1],  [ 'region'=> [[3, 5,9, 5]] ] );  // secciones, tec.
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'alumnos', 
		                           'id_oferta_educativa'=>912, 'id_personal'=>1],  [ 'region'=> [[3, 6,9, 6]] ] );  // alumnos, s. agr.
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'secciones', 
		                           'id_oferta_educativa'=>912, 'id_personal'=>1],  [ 'region'=> [[3, 7,9, 7]] ] );  // secciones, s. agr.
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'alumnos', 
		                           'id_oferta_educativa'=>913, 'id_personal'=>1],  [ 'region'=> [[3, 8,9, 8]] ] );  // alumnos, s. art.
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'secciones', 
		                           'id_oferta_educativa'=>913, 'id_personal'=>1],  [ 'region'=> [[3, 9,9, 9]] ] );  // secciones, s. art. 
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'alumnos', 
		                           'id_oferta_educativa'=>  6, 'id_personal'=>1],  [ 'region'=> [[3,10,9,10]] ] );  // alumnos, polim   
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'secciones', 
		                           'id_oferta_educativa'=>  6, 'id_personal'=>1],  [ 'region'=> [[3,11,9,11]] ] );  // secciones, polim   
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'alumnos', 
		                           'id_oferta_educativa'=>  8, 'id_personal'=>1],  [ 'region'=> [[3,12,9,12]] ] );  // alumnos, bach. 3a;os
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'secciones', 
		                           'id_oferta_educativa'=>  8, 'id_personal'=>1],  [ 'region'=> [[3,13,9,13]] ] );  // secciones, bach. 3 a;os
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'alumnos', 
		                           'id_oferta_educativa'=> 80, 'id_personal'=>1],  [ 'region'=> [[3,14,9,14]] ] );  // alumnos, bach. 4 a;os
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'secciones', 
		                           'id_oferta_educativa'=> 80, 'id_personal'=>1],  [ 'region'=> [[3,15,9,15]] ] );  // secciones, bach. 4 a;os
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'alumnos', 
		                           'id_oferta_educativa'=>  9, 'id_personal'=>1],  [ 'region'=> [[3,16,9,16]] ] );  // alumnos, sist. dual
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'secciones', 
		                           'id_oferta_educativa'=>  9, 'id_personal'=>1],  [ 'region'=> [[3,17,9,17]] ] );  // secciones, sist. dual

		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'M' ],  [ 'region'=> [[3,2,3,17]] ] );  // M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'I' ],  [ 'region'=> [[4,2,4,17]] ] );  // I
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'T' ],  [ 'region'=> [[5,2,5,17]] ] );  // T
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'V' ],  [ 'region'=> [[6,2,6,17]] ] );  // V
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'N' ],  [ 'region'=> [[7,2,7,17]] ] );  // N
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'D' ],  [ 'region'=> [[8,2,8,17]] ] );  // D
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'A' ],  [ 'region'=> [[9,2,9,17]] ] );  // A



// CUADRO 18) CANTIDAD DE ALUMNOS POR TIPO DE JORNADA SEGÚN MODALIDAD
		$C=$F->cuadros[18];

	// JORNADA= 1) JOR. SIMPLE/ 2) JOR EXT. 30 / 3) JOR. DOBLE  40 / 4) JOR. AGROT.
				
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','campo_destino'=>'alumnos', 'id_oferta_educativa'=> 63],  [ 'region'=> [[3, 2,6, 2]] ] );  // ORIENT.
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','campo_destino'=>'alumnos', 'id_oferta_educativa'=> 72],  [ 'region'=> [[3, 3,6, 3]] ] );  // ORIENT.
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','campo_destino'=>'alumnos', 'id_oferta_educativa'=> 75],  [ 'region'=> [[3, 4,6, 4]] ] );  // TEC.
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','campo_destino'=>'alumnos', 'id_oferta_educativa'=> 73],  [ 'region'=> [[3, 5,6, 5]] ] );  // TEC.
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','campo_destino'=>'alumnos', 'id_oferta_educativa'=> 78],  [ 'region'=> [[3, 6,6, 6]] ] );  // AGR.
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','campo_destino'=>'alumnos', 'id_oferta_educativa'=> 79],  [ 'region'=> [[3, 7,6, 7]] ] );  // AGR.
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','campo_destino'=>'alumnos', 'id_oferta_educativa'=> 76],  [ 'region'=> [[3, 8,6, 8]] ] );  // ART.
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','campo_destino'=>'alumnos', 'id_oferta_educativa'=> 77],  [ 'region'=> [[3, 9,6, 9]] ] );  // ART.
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','campo_destino'=>'alumnos', 'id_oferta_educativa'=>  6],  [ 'region'=> [[3,10,6,10]] ] );  // POLI
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','campo_destino'=>'alumnos', 'id_oferta_educativa'=>  8],  [ 'region'=> [[3,11,6,11]] ] );  // B. ADULT 3
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','campo_destino'=>'alumnos', 'id_oferta_educativa'=> 80],  [ 'region'=> [[3,12,6,12]] ] );  // B. ADULT.4
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','campo_destino'=>'alumnos', 'id_oferta_educativa'=>  9],  [ 'region'=> [[3,13,6,13]] ] );  // SIST.DUAL 


		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','id_tipo_jornada'=> '1' ],  [ 'region'=> [[3,2,3,13]] ] );  // j. simp.
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','id_tipo_jornada'=> '2' ],  [ 'region'=> [[4,2,4,13]] ] );  // j. ext.
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','id_tipo_jornada'=> '4' ],  [ 'region'=> [[5,2,5,13]] ] );  // j. AGROT.
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos_por_tipo_jornada','id_tipo_jornada'=> '3' ],  [ 'region'=> [[6,2,6,13]] ] );  // j. dobl.



    	return ($F);

	} //function I2019_SECUNDARIA



static public function I2019_SUPERIOR ($id_definicion_formulario)
    {   
    	$F = new DefinicionFormularioController( $id_definicion_formulario);  // cargar el formulario


// CUADRO 1) TURNOS DE FUNCIONAMIENTO
		$C=$F->cuadros[1];
				
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','vista'=>'checkturnos','campo_destino'=>'','id_oferta_educativa'=>905,'id_personal'=>1,'id_turno'=>''],
										 [ 'region'=> [[2,2,8,2]] ] );// M		
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'M'], [ 'celdas'=> [[2,2]]] );// M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'I'], [ 'celdas'=> [[3,2]]] );// I
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'T'], [ 'celdas'=> [[4,2]]] );// T
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'V'], [ 'celdas'=> [[5,2]]] );// V
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'N'], [ 'celdas'=> [[6,2]]] );// N
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'D'], [ 'celdas'=> [[7,2]]] );// D
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'A'], [ 'celdas'=> [[8,2]]] );// A



	// CUADRO 2) CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
		$C=$F->cuadros[2];
				
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 11 ],  [ 'celdas'=> [[2,2]] ] );  //  (DMC)		
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=>  1 ],  [ 'celdas'=> [[3,2]] ] );  // Comedor
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 12 ],  [ 'celdas'=> [[4,2]] ] );  // Módulo Simple
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 13 ],  [ 'celdas'=> [[5,2]] ] );  // Módulo Doble
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 14 ],  [ 'celdas'=> [[6,2]] ] );  // Módulo Completo
									   

// CUADRO 3) CANTIDAD DE ALUMNOS DE CARRERAS, POSGRADOS Y POSTÍTULOS SEGÚN AÑO Y SEXO
		$C=$F->cuadros[3];

       $C->save_cuadro_migrador ([  		    'id_oferta_educativa'=>13,
    		                                    'id_modalidad'=>500, //valor por defecto, si no se carga combo
    		                                    'id_terminalidad_titulo'=>555498, //valor por defecto, si no se carga combo
    		                                    'id_modo_de_dictado'=>1,
    		                                    'id_caracteristica_matricula'=>1,
    		                                    'id_anio_estudio'=>0,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',
    		                                    'col_combo1'=>1,
    		                                    'cp_destino1'=>'id_oferta_educativa',
    		                                //    'col_combo2'=>2,
    		                                //    'cp_destino2'=>'id_modalidad_de_dictado',
                                               ],  [ 'region'=> [[3,2,3,11]] ] );

		
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>1],  [ 'region'=> [[3,2, 3,3]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>2],  [ 'region'=> [[3,4, 3,5]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>3],  [ 'region'=> [[3,6, 3,7]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>4],  [ 'region'=> [[3,8, 3,9]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>5],  [ 'region'=> [[3,10, 3,11]] ] );

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  ['celdas'=> [[3,3],[3,5],[3,7],[3,9],[3,11]] ] );


// CUADRO 4) CANTIDAD DE ALUMNOS DE CURSOS DE CAPACITACION SEGÚN AÑO Y SEXO
		$C=$F->cuadros[4];

       $C->save_cuadro_migrador ([  		    'id_oferta_educativa'=>14,
    		                                    'id_modalidad'=>510, //valor por defecto, si no se carga combo
    		                                    'id_terminalidad_titulo'=>510005, //valor por defecto, si no se carga combo
    		                                    'id_modo_de_dictado'=>1,
    		                                    'id_caracteristica_matricula'=>1,
    		                                    'id_anio_estudio'=>0,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',
    		                                    'col_combo1'=>1,
    		                                    'cp_destino1'=>'id_oferta_educativa',
    		                                //    'col_combo2'=>2,
    		                                //    'cp_destino2'=>'id_modalidad_de_dictado',
                                               ],  [ 'region'=> [[3,2,3,11]] ] );

		
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>1],  [ 'region'=> [[3,2, 3,3]] ] );
    	$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>2],  [ 'region'=> [[3,4, 3,5]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>3],  [ 'region'=> [[3,6, 3,7]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>4],  [ 'region'=> [[3,8, 3,9]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>5],  [ 'region'=> [[3,10, 3,11]] ] );


        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  ['celdas'=> [[3,3],[3,5],[3,7],[3,9],[3,11]] ] );

// CUADRO 5) CANTIDAD DE DIVISIONES POR AÑO
		$C=$F->cuadros[5];

  		$C->save_cuadro_migrador ([ 'id_oferta_educativa'=>0, 
                                    'id_tipo_seccion'=>'I',
                                    'id_anio_estudio'=>0,
                                    'tabla_destino'=>'secciones',
                                    'campo_destino'=>'cantidad',
                                  ],  [ 'region'=> [[3,2,4,6]] ] );

		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>13],  [ 'region'=> [[3,2,3,6]] ] ); // CARRERAS DE SUP.
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>14],  [ 'region'=> [[4,2,4,6]] ] ); // CURSOS DE SUP.

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>1],  [ 'region'=> [[3,2, 4,2]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>2],  [ 'region'=> [[3,3, 4,3]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>3],  [ 'region'=> [[3,4, 4,4]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>4],  [ 'region'=> [[3,5, 4,5]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>5],  [ 'region'=> [[3,6, 4,6]] ] );




       
    	return ($F);

    }  //FUNCTION I2019_SUPERIOR



static public function I2019_EPA ($id_definicion_formulario)
    {   
    	$F = new DefinicionFormularioController( $id_definicion_formulario);  // cargar el formulario



// CUADRO 1) TURNOS DE FUNCIONAMIENTO
		$C=$F->cuadros[1];
				
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','vista'=>'checkturnos','campo_destino'=>'','id_oferta_educativa'=>15,'id_personal'=>1,'id_turno'=>''],
										 [ 'region'=> [[2,2,8,2]] ] );// M		
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'M'], [ 'celdas'=> [[2,2]]] );// M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'I'], [ 'celdas'=> [[3,2]]] );// I
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'T'], [ 'celdas'=> [[4,2]]] );// T
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'V'], [ 'celdas'=> [[5,2]]] );// V
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'N'], [ 'celdas'=> [[6,2]]] );// N
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'D'], [ 'celdas'=> [[7,2]]] );// D
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'A'], [ 'celdas'=> [[8,2]]] );// A



// CUADRO 2) CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
		$C=$F->cuadros[2];
				
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 11 ],  [ 'celdas'=> [[2,2]] ] );  //  (DMC)		
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=>  1 ],  [ 'celdas'=> [[3,2]] ] );  // Comedor
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 12 ],  [ 'celdas'=> [[4,2]] ] );  // Módulo Simple
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 13 ],  [ 'celdas'=> [[5,2]] ] );  // Módulo Doble
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 14 ],  [ 'celdas'=> [[6,2]] ] );  // Módulo Completo
									   


// CUADRO 3) CANTIDAD DE ALUMNOS DE EPA SEGÚN CICLO Y SEXO

	$C=$F->cuadros[3];
	$C->save_cuadro_migrador (	[	'id_oferta_educativa'=>15,
									'id_modalidad'=>0,
									'id_terminalidad_titulo'=>0,
									'id_modo_de_dictado'=>1,
									'id_caracteristica_matricula'=>1,
									'id_anio_estudio'=>1,
									'tabla_destino'=>'alumnos',
									'campo_destino'=>'varon',
								],  [ 'region'=> [[3,1,3,6]] ] );

	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>1],  [ 'columnas'=> [1,2] ] );
	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>2],  [ 'columnas'=> [3,4] ] );
	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>3],  [ 'columnas'=> [5,6] ] );

	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'campo_destino'=>'mujer'],  [ 'celdas'=> [[3,2],[3,4],[3,6] ] ] );



// CUADRO 4) CANTIDAD DE SECCIONES / GRUPOS DE EPA SEGÚN MODO DE DICTADO Y CICLO.

	$C=$F->cuadros[4];
	$C->save_cuadro_migrador (	[	'id_oferta_educativa'=>15,
									'id_tipo_seccion'=>'I',
									'id_anio_estudio'=>0,
									'tabla_destino'=>'secciones',
									'campo_destino'=>'cantidad',
								  ],  [ 'region'=> [[2,1,2,4]] ] );

	$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>1],  [ 'columnas'=> [1] ] );
	$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>2],  [ 'columnas'=> [2] ] );
	$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>3],  [ 'columnas'=> [3] ] );
	$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>999,'id_tipo_seccion'=>'M'],  [ 'columnas'=> [4] ] );




       
    	return ($F);

    }   // function I2019_EPA




static public function I2019_CENS ($id_definicion_formulario)
    {   
        $F = new DefinicionFormularioController( $id_definicion_formulario);  // cargar el formulario


// CUADRO 1) TURNOS DE FUNCIONAMIENTO
		$C=$F->cuadros[1];
				
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','vista'=>'checkturnos','campo_destino'=>'','id_oferta_educativa'=>16,'id_personal'=>1,'id_turno'=>''],
										 [ 'region'=> [[2,2,8,2]] ] );// M		
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'M'], [ 'celdas'=> [[2,2]]] );// M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'I'], [ 'celdas'=> [[3,2]]] );// I
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'T'], [ 'celdas'=> [[4,2]]] );// T
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'V'], [ 'celdas'=> [[5,2]]] );// V
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'N'], [ 'celdas'=> [[6,2]]] );// N
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'D'], [ 'celdas'=> [[7,2]]] );// D
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'A'], [ 'celdas'=> [[8,2]]] );// A



// CUADRO 2) CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
		$C=$F->cuadros[2];
				
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 11 ],  [ 'celdas'=> [[2,2]] ] );  //  (DMC)		
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=>  1 ],  [ 'celdas'=> [[3,2]] ] );  // Comedor
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 12 ],  [ 'celdas'=> [[4,2]] ] );  // Módulo Simple
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 13 ],  [ 'celdas'=> [[5,2]] ] );  // Módulo Doble
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 14 ],  [ 'celdas'=> [[6,2]] ] );  // Módulo Completo
									   
       

// CUADRO 3) CANTIDAD DE ALUMNOS DE BACHILLERATO PARA ADULTOS, PLAN DE 3 AÑOS, POR AÑO Y SEXO SEGÚN ESPECIALIDAD, MODALIDAD PRESENCIAL
        $C=$F->cuadros[3];

       $C->save_cuadro_migrador ([              'id_oferta_educativa'=>16,
                                                'id_modalidad'=>804, //valor por defecto, si no se carga combo
                                                'id_terminalidad_titulo'=>804000, //valor por defecto, si no se carga combo
                                                'id_modo_de_dictado'=>1,
                                                'id_caracteristica_matricula'=>1,
                                                'id_anio_estudio'=>0,
                                                'tabla_destino'=>'alumnos',
                                                'campo_destino'=>'varon',
                                                'col_combo1'=>1,
                                                'cp_destino1'=>'id_oferta_educativa',
                                            //    'col_combo2'=>2,
                                            //    'cp_destino2'=>'id_modalidad_de_dictado',
                                               ],  [ 'region'=> [[3,2,3,7]] ] );

        
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>1],  [ 'region'=> [[3,2, 3,3]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>2],  [ 'region'=> [[3,4, 3,5]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>3],  [ 'region'=> [[3,6, 3,7]] ] );

        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  ['celdas'=> [[3,3],[3,5],[3,7]] ] );



// CUADRO 4) CANTIDAD DE ALUMNOS DE BACHILLERATO PARA ADULTOS, PLAN DE 4 AÑOS, POR AÑO Y SEXO SEGÚN ESPECIALIDAD, MODALIDAD PRESENCIAL

$C=$F->cuadros[4];
$C->save_cuadro_migrador ([  		    'id_oferta_educativa'=>80,
										'id_modalidad'=>100, //valor por defecto, si no se carga combo
										'id_terminalidad_titulo'=>0, //valor por defecto, si no se carga combo
										'id_modo_de_dictado'=>1,
										'id_caracteristica_matricula'=>1,
										'id_anio_estudio'=>1,
										'tabla_destino'=>'alumnos',
										'campo_destino'=>'varon',
										'col_combo1'=>1,
										'cp_destino1'=>'id_oferta_educativa',
									//    'col_combo2'=>2,
									//    'cp_destino2'=>'id_modalidad_de_dictado',
									   ],  [ 'region'=> [[3,2,3,9]] ] );


$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>1],  [ 'region'=> [[3,2, 3,3]] ] );
$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>2],  [ 'region'=> [[3,4, 3,5]] ] );
$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>3],  [ 'region'=> [[3,6, 3,7]] ] );
$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>4],  [ 'region'=> [[3,8, 3,9]] ] );

$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  [ 'celdas'=> [[3,3],[3,5],[3,7],[3,9]] ] );




// CUADRO 5) CANTIDAD DE ALUMNOS DE MODALIDAD SEMIPRESENCIAL Resol. 737/07
        $C=$F->cuadros[5];

       $C->save_cuadro_migrador ([              'id_oferta_educativa'=>16,
                                                'id_modalidad'=>804, //valor por defecto, si no se carga combo
                                                'id_terminalidad_titulo'=>804000, //valor por defecto, si no se carga combo
                                                'id_modo_de_dictado'=>2,
                                                'id_caracteristica_matricula'=>1,
                                                'id_anio_estudio'=>4,
                                                'tabla_destino'=>'alumnos',
                                                'campo_destino'=>'varon',
                                                'col_combo1'=>1,
                                                'cp_destino1'=>'id_oferta_educativa',
                                            //    'col_combo2'=>2,
                                            //    'cp_destino2'=>'id_modalidad_de_dictado',
                                               ],  [ 'region'=> [[3,2,3,3]] ] );
        

        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  ['celdas'=> [[3,3]] ] );

// CUADRO 6) CANTIDAD DE SECCIONES SEGÚN MODO DE DICTADO Y AÑO

        $C=$F->cuadros[6];

        $C->save_cuadro_migrador ([ 'id_oferta_educativa'=>16, 
                                    'id_tipo_seccion'=>'I',
                                    'id_anio_estudio'=>0,
                                    'tabla_destino'=>'secciones',
                                    'campo_destino'=>'cantidad',
                                  ],  [ 'region'=> [[2,2,3,5]], 'celdas'=> [[4,6] ]] );

        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>1],  [ 'region'=> [[2,2,3,2]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>2],  [ 'region'=> [[2,3,3,3]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>3],  [ 'region'=> [[2,4,3,4]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>4],  [ 'region'=> [[2,5,3,5]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>4,'id_tipo_seccion'=>'S'],  [ 'celdas'=> [[4,6]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_oferta_educativa'=>80],  [ 'region'=> [[3,2,3,5]] ] );




// CUADRO 7) CANTIDAD DE ALUMNOS Y COMISIONES DE PLANES FINES

        $C=$F->cuadros[7];

       // los alumnos
       $C->save_cuadro_migrador ([              'id_oferta_educativa'=>0,
                                                'id_modalidad'=>890,
                                                'id_terminalidad_titulo'=>890000,
                                                'id_modo_de_dictado'=>1,
                                                'id_caracteristica_matricula'=>1,
                                                'id_anio_estudio'=>0,
                                                'tabla_destino'=>'alumnos',
                                                'campo_destino'=>'varon',
                                            //    'col_combo1'=>1,
                                            //    'cp_destino1'=>'id_oferta_educativa',
                                            //    'col_combo2'=>2,
                                            //    'cp_destino2'=>'id_modalidad_de_dictado',
                                               ],  [ 'region'=> [[2,2,3,3]] ] );
        

        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_oferta_educativa'=>40,],  ['region'=> [[2,2,2,3]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_oferta_educativa'=>41,],  ['region'=> [[3,2,3,3]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  ['region'=> [[2,3,3,3]] ] );

        // -- las secciones
        $C->save_cuadro_migrador ([ 'id_oferta_educativa'=>0, 
                                    'id_tipo_seccion'=>'I',
                                    'id_anio_estudio'=>0,
                                    'tabla_destino'=>'secciones',
                                    'campo_destino'=>'cantidad',
                                  ],  [ 'region'=> [[2,5,3,5]] ] );

        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_oferta_educativa'=>40],  [ 'celdas'=> [[2,5]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_oferta_educativa'=>41],  [ 'celdas'=> [[3,5]] ] );


       
        return ($F);

    }  //FUNCTION I2019_CENS






static public function I2019_ESPECIAL ($id_definicion_formulario)
    {   
        $F = new DefinicionFormularioController( $id_definicion_formulario);  // cargar el formulario

// CUADRO 1) CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
		$C=$F->cuadros[1];
				
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 11 ],  [ 'celdas'=> [[2,2]] ] );  //  (DMC)		
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=>  1 ],  [ 'celdas'=> [[3,2]] ] );  // Comedor
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 12 ],  [ 'celdas'=> [[4,2]] ] );  // Módulo Simple
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 13 ],  [ 'celdas'=> [[5,2]] ] );  // Módulo Doble
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 14 ],  [ 'celdas'=> [[6,2]] ] );  // Módulo Completo
									   
// CUADRO 2) ALUMNOS MATRICULADOS EN EL NIVEL INICIAL (ATDI) 0 A 3 AÑOS
        $C=$F->cuadros[2];

        $C->save_cuadro_migrador ([             'id_oferta_educativa'=>17,
                                                'id_modalidad'=>601,
                                                'id_terminalidad_titulo'=>0,
                                                'id_modo_de_dictado'=>1,
                                                'id_caracteristica_matricula'=>1,
                                                'id_anio_estudio'=>1,
                                                'tabla_destino'=>'alumnos',
                                                'campo_destino'=>'varon',
                                            //    'col_combo1'=>1,
                                            //    'cp_destino1'=>'id_oferta_educativa',
                                            //    'col_combo2'=>2,
                                            //    'cp_destino2'=>'id_modalidad_de_dictado',
                                               ],  [ 'region'=> [[3,2,4,3]] ] );
        

        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600001,],  ['region'=> [[3,2,3,3]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600024,],  ['region'=> [[4,2,4,3]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  ['region'=> [[3,3,4,3]] ] );




// CUADRO 3) ALUMNOS MATRICULADOS EN LOS NIVELES INICIAL, PRIMARIO Y POST-PRIMARIO (EN SEDE)
		$C=$F->cuadros[3];
		//dd($C);
        $C->save_cuadro_migrador (['id_oferta_educativa'=>0,
    		                                    'id_modalidad'=>0,
    		                                    'id_terminalidad_titulo'=>0,
    		                                    'id_modo_de_dictado'=>1,
    		                                    'id_caracteristica_matricula'=>1,
    		                                    'id_anio_estudio'=>1,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',
                                               ],  [ 'region'=> [[4,2,10,11]] ] );

		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_oferta_educativa'=>18,'id_modalidad'=>602 ],  [ 'region'=> [[4,2,10,3]] ] );  // N. inicial
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_oferta_educativa'=>19,'id_modalidad'=>603 ],  [ 'region'=> [[4,4,10,7]] ] );  //n. primario
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_oferta_educativa'=>65,'id_modalidad'=>617 ],  [ 'region'=> [[4,8,10,11]] ] ); //n.secundario

		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600026],  [ 'region'=> [[ 4,2, 4,11]] ] ); // SORDOS E HIPOACUSICOS  
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600027],  [ 'region'=> [[ 5,2, 5,11]] ] ); // CIEGOS Y DISMINUIDOS VISUALES  
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600028],  [ 'region'=> [[ 6,2, 6,11]] ] ); // DISCAPACITADOS MOTORES Y NEUROLOCOMOTORES 
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600029],  [ 'region'=> [[ 7,2, 7,11]] ] ); //	TRASTORNOS EMOCIONALES SEVEROS  
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600025],  [ 'region'=> [[ 8,2, 8,11]] ] ); // RETARDO MENTAL  
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600030],  [ 'region'=> [[ 9,2, 9,11]] ] ); // TRASTORNOS EN EL DESARROLLO DEL LENGUAJE Y LA COMUNICACION 
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600018],  [ 'region'=> [[10,2,10,11]] ] ); // MULTIIMPEDIDOS  


    	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>1],  [ 'region'=> [[4,4,10,5],[4, 8,10, 9]] ] );
    	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>2],  [ 'region'=> [[4,6,10,7],[4,10,10,11]] ] );

		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'campo_destino'=>'mujer'],  [ 'region'=> [[4,3,10,3],[4,5,10,5],[4,7,10,7],[4,9,10,9],[4,11,10,11]] ] );



// CUADRO 4) ALUMNOS MATRICULADOS, DISMINUIDOS FÍSICOS IMPEDIDOS DE CONCURRIR AL SERVICIO ORDINARIO, DOMICILIARIOS Y HOSPITALARIOS

		$C=$F->cuadros[4];
		//dd($C);
        $C->save_cuadro_migrador (['id_oferta_educativa'=>0,
    		                                    'id_modalidad'=>0,
    		                                    'id_terminalidad_titulo'=>0,
    		                                    'id_modo_de_dictado'=>0,  // domiciliario o hospitalario
    		                                    'id_caracteristica_matricula'=>1,
    		                                    'id_anio_estudio'=>1,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',
                                               ],  [ 'region'=> [[4,3,7,12]] ] );

		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_oferta_educativa'=>21,'id_modalidad'=>610 ],  [ 'region'=> [[4,3,5,4]] ] );  // DOMIC. N. inicial
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_oferta_educativa'=>22,'id_modalidad'=>611 ],  [ 'region'=> [[4,5,5,8]] ] );  // DOMIC. n. primario
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_oferta_educativa'=>68,'id_modalidad'=>614 ],  [ 'region'=> [[4,9,5,12]] ] ); // DOMIC. n.secundario

		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_oferta_educativa'=>23,'id_modalidad'=>612 ],  [ 'region'=> [[6,3,7,4]] ] );  // HOSP. N. inicial
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_oferta_educativa'=>24,'id_modalidad'=>613 ],  [ 'region'=> [[6,5,7,8]] ] );  // HOSP. n. primario
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_oferta_educativa'=>69,'id_modalidad'=>615 ],  [ 'region'=> [[6,9,7,12]] ] ); // HOSP. n.secundario


		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600031,'id_modo_de_dictado'=>4 ],  [ 'region'=> [[4,3,4,12]] ] ); // DOMICILIARIO PERMANENTE
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600032,'id_modo_de_dictado'=>4 ],  [ 'region'=> [[5,3,5,12]] ] ); // DOMICILIARIO TRANSITORIO  
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600031,'id_modo_de_dictado'=>3 ],  [ 'region'=> [[6,3,6,12]] ] ); // HOSPITALARO PERMANENTE 
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600032,'id_modo_de_dictado'=>3 ],  [ 'region'=> [[7,3,7,12]] ] ); // HOSPITALARIO TRANSITORIO  


    	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>1],  [ 'region'=> [[4,5,7,6],[4, 9,7,10]] ] );
    	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>2],  [ 'region'=> [[4,7,7,8],[4,11,7,12]] ] );

		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'campo_destino'=>'mujer'],  [ 'region'=> [[4,4,7,4],[4,6,7,6],[4,8,7,8],[4,10,7,10],[4,12,7,12]] ] );




// CUADRO 5) ALUMNOS MATRICULADOS EN FORMACIÓN LABORAL (EN SEDE)

        $C=$F->cuadros[5];

       // los alumnos
       $C->save_cuadro_migrador ([              'id_oferta_educativa'=>20,
                                                'id_modalidad'=>616,
                                                'id_terminalidad_titulo'=>600034,
                                                'id_modo_de_dictado'=>1,
                                                'id_caracteristica_matricula'=>1,
                                                'id_anio_estudio'=>1,
                                                'tabla_destino'=>'alumnos',
                                                'campo_destino'=>'varon',
                                            //    'col_combo1'=>1,
                                            //    'cp_destino1'=>'id_oferta_educativa',
                                            //    'col_combo2'=>2,
                                            //    'cp_destino2'=>'id_modalidad_de_dictado',
                                               ],  [ 'region'=> [[3,2,3,3]] ] );

        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  [ 'celdas'=> [[3,3]] ] );

        // -- las secciones
 		// no se estan migrando secciones de especial al PL_Datos
        // $C->save_cuadro_migrador ([ 'id_oferta_educativa'=>20, 
        //                             'id_tipo_seccion'=>'I',
        //                             'id_anio_estudio'=>1,
        //                             'tabla_destino'=>'secciones',
        //                             'campo_destino'=>'cantidad',
        //                           ],  [ 'celdas'=> [[3,5]] ] );






// CUADRO 6) ALUMNOS MATRICULADOS EN LOS NIVELES INICIAL, PRIMARIO Y POST-PRIMARIO (EN INTEGRACIÓN)

$C=$F->cuadros[6];
//dd($C);
$C->save_cuadro_migrador (['id_oferta_educativa'=>0,
										'id_modalidad'=>0,
										'id_terminalidad_titulo'=>0,
										'id_modo_de_dictado'=>5,  // modo de dictado de integracion!!!!
										'id_caracteristica_matricula'=>1,
										'id_anio_estudio'=>1,
										'tabla_destino'=>'alumnos',
										'campo_destino'=>'varon',
									   ],  [ 'region'=> [[4,2,10,11]] ] );

$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_oferta_educativa'=>18,'id_modalidad'=>602 ],  [ 'region'=> [[4,2,10,3]] ] );  // N. inicial
$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_oferta_educativa'=>19,'id_modalidad'=>603 ],  [ 'region'=> [[4,4,10,7]] ] );  //n. primario
$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_oferta_educativa'=>65,'id_modalidad'=>617 ],  [ 'region'=> [[4,8,10,11]] ] ); //n.secundario

$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600026],  [ 'region'=> [[ 4,2, 4,11]] ] ); // SORDOS E HIPOACUSICOS  
$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600027],  [ 'region'=> [[ 5,2, 5,11]] ] ); // CIEGOS Y DISMINUIDOS VISUALES  
$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600028],  [ 'region'=> [[ 6,2, 6,11]] ] ); // DISCAPACITADOS MOTORES Y NEUROLOCOMOTORES 
$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600029],  [ 'region'=> [[ 7,2, 7,11]] ] ); //	TRASTORNOS EMOCIONALES SEVEROS  
$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600025],  [ 'region'=> [[ 8,2, 8,11]] ] ); // RETARDO MENTAL  
$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600030],  [ 'region'=> [[ 9,2, 9,11]] ] ); // TRASTORNOS EN EL DESARROLLO DEL LENGUAJE Y LA COMUNICACION 
$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600018],  [ 'region'=> [[10,2,10,11]] ] ); // MULTIIMPEDIDOS  


$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>1],  [ 'region'=> [[4,4,10,5],[4, 8,10, 9]] ] );
$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>2],  [ 'region'=> [[4,6,10,7],[4,10,10,11]] ] );

$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'campo_destino'=>'mujer'],  [ 'region'=> [[4,3,10,3],[4,5,10,5],[4,7,10,7],[4,9,10,9],[4,11,10,11]] ] );




// CUADRO 7) ALUMNOS MATRICULADOS EN FORMACIÓN LABORAL (EN INTEGRACIÓN)

$C=$F->cuadros[7];

// los alumnos
$C->save_cuadro_migrador ([              'id_oferta_educativa'=>20,
										 'id_modalidad'=>616,
										 'id_terminalidad_titulo'=>600034,
										 'id_modo_de_dictado'=>5,  // modo de dictado de integracion!!!!
										 'id_caracteristica_matricula'=>1,
										 'id_anio_estudio'=>1,
										 'tabla_destino'=>'alumnos',
										 'campo_destino'=>'varon',
									 //    'col_combo1'=>1,
									 //    'cp_destino1'=>'id_oferta_educativa',
									 //    'col_combo2'=>2,
									 //    'cp_destino2'=>'id_modalidad_de_dictado',
										],  [ 'region'=> [[3,2,3,3]] ] );

 $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  [ 'celdas'=> [[3,3]] ] );

 // -- las secciones
 // no se estan migrando secciones de especial al PL_Datos
 // $C->save_cuadro_migrador ([ 'id_oferta_educativa'=>20, 
	// 						 'id_tipo_seccion'=>'N',  // ver codigo en PL_DATOS
	// 						 'id_anio_estudio'=>1,
	// 						 'tabla_destino'=>'secciones',
	// 						 'campo_destino'=>'cantidad',
	// 					   ],  [ 'celdas'=> [[3,5]] ] );




// CUADRO 8) ALUMNOS MATRICULADOS EN ORIENTACION MANUAL Y PRE-TALLER

$C=$F->cuadros[8];

// los alumnos
$C->save_cuadro_migrador ([              'id_oferta_educativa'=>70,
										 'id_modalidad'=>618,
										 'id_terminalidad_titulo'=>0,
										 'id_modo_de_dictado'=>1,  
										 'id_caracteristica_matricula'=>20,
										 'id_anio_estudio'=>1,
										 'tabla_destino'=>'alumnos',
										 'campo_destino'=>'varon',
									 //    'col_combo1'=>1,
									 //    'cp_destino1'=>'id_oferta_educativa',
									 //    'col_combo2'=>2,
									 //    'cp_destino2'=>'id_modalidad_de_dictado',
										],  [ 'region'=> [[3,2,4,3]] ] );

$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600035],  [ 'region'=> [[3,2,3,3]] ] ); // ORIENTACION MANUAL 
$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_terminalidad_titulo'=>600036],  [ 'region'=> [[4,2,4,3]] ] ); // PRETALLER (PREPROFESIONAL) L 

$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  [ 'region'=> [[3,3,4,3]] ] );

 // -- las secciones
 // no se estan migrando secciones de especial al PL_Datos
    // $C->save_cuadro_migrador ([ 'id_oferta_educativa'=>70, 
	// 						 'id_tipo_seccion'=>'I',  // ver codigo en PL_DATOS
	// 						 'id_anio_estudio'=>1,
	// 						 'tabla_destino'=>'secciones',
	// 						 'campo_destino'=>'cantidad',
	// 					   ],  [ 'region'=> [[3,5,4,5]] ] );
	// $C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_anio_estudio'=>1 ],  [ 'celdas'=> [[3,5]] ] );    // ver codigo en PL_DATOS
	// $C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_anio_estudio'=>2 ],  [ 'celdas'=> [[4,5]] ] );    // ver codigo en PL_DATOS
	// 						 
	// 						 


		
// CUADRO 9)  MATRÍCULA ATENDIDA DE MODALIDAD ARTÍSTICA Y ED. FÍSICA

		$C=$F->cuadros[9];
					// 'id_personal' = 1 personal propio / 2 de otro estab.
					//'id_servicio_complementario'= 5 Educación Física / 19 Plástica Visual / 20 Danza / 21 Música / 22 Teatro / 23 Literatura
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>5 ],  [ 'region'=> [[ 3,3,12,3]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>19],  [ 'region'=> [[ 3,4,12,4]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>20],  [ 'region'=> [[ 3,5,12,5]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>21],  [ 'region'=> [[ 3,6,12,6]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>22],  [ 'region'=> [[ 3,7,12,7]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas','campo_destino'=>'matricula', 'id_servicio_complementario'=>23],  [ 'region'=> [[ 3,8,12,8]] ] ); 

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=> 17, 'id_personal'=>1 ],  [ 'region'=> [[ 3,3, 3,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=> 17, 'id_personal'=>2 ],  [ 'region'=> [[ 4,3, 4,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=> 18, 'id_personal'=>1 ],  [ 'region'=> [[ 5,3, 5,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=> 18, 'id_personal'=>2 ],  [ 'region'=> [[ 6,3, 6,8]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=> 19, 'id_personal'=>1 ],  [ 'region'=> [[ 7,3, 7,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=> 19, 'id_personal'=>2 ],  [ 'region'=> [[ 8,3, 8,8]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=> 65, 'id_personal'=>1 ],  [ 'region'=> [[ 9,3, 9,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=> 65, 'id_personal'=>2 ],  [ 'region'=> [[10,3,10,8]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=> 20, 'id_personal'=>1 ],  [ 'region'=> [[11,3,11,8]] ] ); 
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'matricula_atendida_areas', 'id_oferta_educativa'=> 20, 'id_personal'=>2 ],  [ 'region'=> [[12,3,12,8]] ] );


// CUADRO 10) ALUMNOS SEGÚN REGIMEN DE TURNO
		$C=$F->cuadros[10];

	// turnos= M,I,T,V,N,D,A
				
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'alumnos',
								   'id_oferta_educativa'=>17, 'id_personal'=>1],  [ 'region'=> [[2,2,8,2]] ] );  // alumnos,atdi
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'alumnos', 
		                           'id_oferta_educativa'=>18, 'id_personal'=>1],  [ 'region'=> [[2,3,8,3]] ] );  // alumnos, inicial
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'alumnos', 
		                           'id_oferta_educativa'=>19, 'id_personal'=>1],  [ 'region'=> [[2,4,8,4]] ] );  // alumnos, primaria.
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'alumnos', 
		                           'id_oferta_educativa'=>65, 'id_personal'=>1],  [ 'region'=> [[2,5,8,5]] ] );  // alumnos, post prim.
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'alumnos', 
		                           'id_oferta_educativa'=>20, 'id_personal'=>1],  [ 'region'=> [[2,6,8,6]] ] );  // alumnos, f. laboral   

		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'M' ],  [ 'region'=> [[2,2,2,6]] ] );  // M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'I' ],  [ 'region'=> [[3,2,3,6]] ] );  // I
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'T' ],  [ 'region'=> [[4,2,4,6]] ] );  // T
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'V' ],  [ 'region'=> [[5,2,5,6]] ] );  // V
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'N' ],  [ 'region'=> [[6,2,6,6]] ] );  // N
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'D' ],  [ 'region'=> [[7,2,7,6]] ] );  // D
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'A' ],  [ 'region'=> [[8,2,8,6]] ] );  // A



	return ($F);


    }  //FUNCTION I2019_ESPECIAL







static public function I2019_ARTISTICA ($id_definicion_formulario)
    {   
        $F = new DefinicionFormularioController( $id_definicion_formulario);  // cargar el formulario


// CUADRO 1) TURNOS DE FUNCIONAMIENTO
		$C=$F->cuadros[1];
				
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','vista'=>'checkturnos','campo_destino'=>'','id_oferta_educativa'=>906,'id_personal'=>1,'id_turno'=>''],
										 [ 'region'=> [[2,2,8,2]] ] );// M		
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'M'], [ 'celdas'=> [[2,2]]] );// M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'I'], [ 'celdas'=> [[3,2]]] );// I
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'T'], [ 'celdas'=> [[4,2]]] );// T
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'V'], [ 'celdas'=> [[5,2]]] );// V
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'N'], [ 'celdas'=> [[6,2]]] );// N
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'D'], [ 'celdas'=> [[7,2]]] );// D
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'A'], [ 'celdas'=> [[8,2]]] );// A



// CUADRO 2) CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
		$C=$F->cuadros[2];
				
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 11 ],  [ 'celdas'=> [[2,2]] ] );  //  (DMC)		
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=>  1 ],  [ 'celdas'=> [[3,2]] ] );  // Comedor
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 12 ],  [ 'celdas'=> [[4,2]] ] );  // Módulo Simple
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 13 ],  [ 'celdas'=> [[5,2]] ] );  // Módulo Doble
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 14 ],  [ 'celdas'=> [[6,2]] ] );  // Módulo Completo
									   


// CUADRO 3) CANTIDAD DE ALUMNOS DE EDUCACIÓN ESTÉTICA INFANTIL
        $C=$F->cuadros[3];

        $C->save_cuadro_migrador ([             'id_oferta_educativa'=>29,
                                                'id_modalidad'=>701,
                                                'id_terminalidad_titulo'=>700000,
                                                'id_modo_de_dictado'=>1,
                                                'id_caracteristica_matricula'=>1,
                                                'id_anio_estudio'=>0,
                                                'tabla_destino'=>'alumnos',
                                                'campo_destino'=>'varon',
                                            //    'col_combo1'=>1,
                                            //    'cp_destino1'=>'id_oferta_educativa',
                                            //    'col_combo2'=>2,
                                            //    'cp_destino2'=>'id_modalidad_de_dictado',
                                               ],  [ 'region'=> [[4,1,4,10]] ] );
        

        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>1 ],  ['region'=> [[4,1,4, 2]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>2 ],  ['region'=> [[4,3,4, 4]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>3 ],  ['region'=> [[4,5,4, 6]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>4 ],  ['region'=> [[4,7,4, 8]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>5 ],  ['region'=> [[4,9,4,10]] ] );

        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  ['celdas'=> [[4,2], [4,4], [4,6], [4,8], [4,10] ] ] );




// CUADRO 4) CANTIDAD DE ALUMNOS POR CICLO DE ENSEÑANZA SEGÚN AÑO Y SEXO

		$C=$F->cuadros[4];
		//dd($C);
        $C->save_cuadro_migrador (['id_oferta_educativa'=>0,
    		                                    'id_modalidad'=>0,
    		                                    'id_terminalidad_titulo'=>700000, //valor por defecto, si no se carga combo
    		                                    'id_modo_de_dictado'=>1,
    		                                    'id_caracteristica_matricula'=>1,
    		                                    'id_anio_estudio'=>1,
    		                                    'tabla_destino'=>'alumnos',
    		                                    'campo_destino'=>'varon',
    		                                    'col_combo1'=>1,
                                                'cp_destino1'=>'id_oferta_educativa',
                                               ],  [ 'region'=> [[4,2,4,21]] ] );

		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_oferta_educativa'=>30,'id_modalidad'=>702 ],  [ 'region'=> [[4, 2, 4, 3]] ] );  // Prep. Form. Básica
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_oferta_educativa'=>31,'id_modalidad'=>703 ],  [ 'region'=> [[4, 4, 4, 9]] ] );  // c. inicial
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_oferta_educativa'=>33,'id_modalidad'=>705 ],  [ 'region'=> [[4,10, 4,15]] ] );  // c. medio
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos','id_oferta_educativa'=>34,'id_modalidad'=>706 ],  [ 'region'=> [[4,16, 4,21]] ] );  // FOBA


    	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>1],  [ 'region'=> [[4, 4, 4,5],[4,10,4,11],[4,16,4,17]] ] );
    	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>2],  [ 'region'=> [[4, 6, 4,7],[4,12,4,13],[4,18,4,19]] ] );
    	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>3],  [ 'region'=> [[4, 8, 4,9],[4,14,4,15],[4,20,4,21]] ] );
    	
		$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'campo_destino'=>'mujer'],  [ 'celdas'=> [[4,3], [4,5], [4,7], [4,9], [4,11], [4,13], [4,15], [4,17], [4,19], [4,21] ] ] );



// CUADRO 5) CANTIDAD DE ALUMNOS POR CARRERA SEGÚN AÑO Y SEXO

        $C=$F->cuadros[5];
        //dd($C);
        $C->save_cuadro_migrador (['id_oferta_educativa'=>35,            // carreras de artistica
                                                'id_modalidad'=>707,
                                                'id_terminalidad_titulo'=>700000, //valor por defecto, si no se carga combo
                                                'id_modo_de_dictado'=>1,
                                                'id_caracteristica_matricula'=>1,
                                                'id_anio_estudio'=>1,
                                                'tabla_destino'=>'alumnos',
                                                'campo_destino'=>'varon',
                                                'col_combo1'=>1,
                                                'cp_destino1'=>'id_oferta_educativa',
                                               ],  [ 'region'=> [[4,2,4,9]] ] );

        $C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>1],  [ 'region'=> [[4,2,4,3]] ] );
        $C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>2],  [ 'region'=> [[4,4,4,5]] ] );
        $C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>3],  [ 'region'=> [[4,6,4,7]] ] );
        $C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>4],  [ 'region'=> [[4,8,4,9]] ] );
        
        $C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'campo_destino'=>'mujer'],  [ 'celdas'=> [[4,3], [4,5], [4,7], [4,9]] ] );



// CUADRO 6) CANTIDAD DE ALUMNOS POR CURSO SEGÚN AÑO Y SEXO

	$C=$F->cuadros[6];
	$C->save_cuadro_migrador (['id_oferta_educativa'=>36,             //cursos de artistica
											'id_modalidad'=>708,
											'id_terminalidad_titulo'=>700000, //valor por defecto, si no se carga combo
											'id_modo_de_dictado'=>1,
											'id_caracteristica_matricula'=>1,
											'id_anio_estudio'=>1,
											'tabla_destino'=>'alumnos',
											'campo_destino'=>'varon',
											'col_combo1'=>1,
											'cp_destino1'=>'id_oferta_educativa',
										],  [ 'region'=> [[3,2,3,9]] ] );

	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>1],  [ 'region'=> [[3,2,3,3]] ] );
	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>2],  [ 'region'=> [[3,4,3,5]] ] );
	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>3],  [ 'region'=> [[3,6,3,7]] ] );
	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>4],  [ 'region'=> [[3,8,3,9]] ] );
	
	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'campo_destino'=>'mujer'],  [ 'celdas'=> [[3,3], [3,5], [3,7], [3,9]] ] );





// CUADRO 7) CANTIDAD DE ALUMNOS MATRICULADOS EN TRAYECTOS PRE-PROFESIONALES ARTÍSTICOS (T.P.P.) POR AÑO Y SEXO SEGÚN ESPECIALIDAD

	$C=$F->cuadros[7];
	$C->save_cuadro_migrador (['id_oferta_educativa'=>37,             //TPP artisitica (op 6)
										 'id_modalidad'=>3400,
										 'id_terminalidad_titulo'=>340000,
											'id_modo_de_dictado'=>1,
											'id_caracteristica_matricula'=>1,
											'id_anio_estudio'=>0,
											'tabla_destino'=>'alumnos',
											'campo_destino'=>'varon',
											'col_combo1'=>1,
											'cp_destino1'=>'id_oferta_educativa',
										],  [ 'region'=> [[3,2,3,7]] ] );

	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>1],  [ 'region'=> [[3,2,3,3]] ] );
	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>2],  [ 'region'=> [[3,4,3,5]] ] );
	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>3],  [ 'region'=> [[3,6,3,7]] ] );
	
	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'campo_destino'=>'mujer'],  [ 'celdas'=> [[3,3], [3,5], [3,7]] ] );



// CUADRO 8) CANTIDAD DE ALUMNOS MATRICULADOS EN TRAYECTO ARTÍSTICO PROFESIONAL (TAP) POR AÑO Y SEXO SEGÚN ESPECIALIDAD

	$C=$F->cuadros[8];
	//dd($C);
	$C->save_cuadro_migrador (['id_oferta_educativa'=>38,             //TAP  artisitica  (op 7)
											'id_modalidad'=>10, //valor por defecto, si no se carga combo
											'id_terminalidad_titulo'=>10000, // //valor por defecto, si no se carga combo
											'id_modo_de_dictado'=>1,
											'id_caracteristica_matricula'=>1,
											'id_anio_estudio'=>0,
											'tabla_destino'=>'alumnos',
											'campo_destino'=>'varon',
											'col_combo1'=>1,
											'cp_destino1'=>'id_oferta_educativa',
										],  [ 'region'=> [[3,2,3,7]] ] );

	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>1],  [ 'region'=> [[3,2,3,3]] ] );
	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>2],  [ 'region'=> [[3,4,3,5]] ] );
	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'id_anio_estudio'=>3],  [ 'region'=> [[3,6,3,7]] ] );
	
	$C->save_cuadro_migrador (['tabla_destino'=>'alumnos', 'campo_destino'=>'mujer'],  [ 'celdas'=> [[3,3], [3,5], [3,7]] ] );





// CUADRO 9) CANTIDAD DE DIVISIONES POR AÑO y MODALIDAD

		$C=$F->cuadros[9];
		$C->save_cuadro_migrador ([ 'id_oferta_educativa'=>0, 
                                    'id_tipo_seccion'=>'I',
                                    'id_anio_estudio'=>0,
                                    'tabla_destino'=>'secciones',
                                    'campo_destino'=>'cantidad',
                                  ],  [ 'region'=> [[2,2,10,6]] ] );

		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>30],  [ 'region'=> [[ 2,2, 2,4]] ] ); // Form basica Preparatoria
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>31],  [ 'region'=> [[ 3,2, 3,4]] ] ); // Ciclo Incial  
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>33],  [ 'region'=> [[ 4,2, 4,4]] ] ); // Ciclo Medio 
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>34],  [ 'region'=> [[ 5,2, 5,4]] ] ); // FOBA 

		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>35],  [ 'region'=> [[ 6,2, 6,5]] ] ); // Tecnicaturas y Prof
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>29],  [ 'region'=> [[ 7,2, 7,6]] ] ); // Estetica Inf.

		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>36],  [ 'region'=> [[ 8,2, 8,5]] ] ); // Cursos 
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>37],  [ 'region'=> [[ 9,2, 9,4]] ] ); // TPP
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>38],  [ 'region'=> [[10,2,10,4]] ] ); // TAP.


        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>1],  [ 'region'=> [[2,2,10,2]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>2],  [ 'region'=> [[2,3,10,3]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>3],  [ 'region'=> [[2,4,10,4]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>4],  [ 'region'=> [[2,5,10,5]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>5],  [ 'region'=> [[2,6,10,6]] ] );




		return ($F);


    }  //FUNCTION I2019_ARTISTICA




static public function I2019_FP ($id_definicion_formulario)
    {   
        $F = new DefinicionFormularioController( $id_definicion_formulario);  // cargar el formulario


// CUADRO 1) TURNOS DE FUNCIONAMIENTO
		$C=$F->cuadros[1];
				
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','vista'=>'checkturnos','campo_destino'=>'','id_oferta_educativa'=>25,'id_personal'=>1,'id_turno'=>''],
										 [ 'region'=> [[2,2,8,2]] ] );// M		
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'M'], [ 'celdas'=> [[2,2]]] );// M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'I'], [ 'celdas'=> [[3,2]]] );// I
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'T'], [ 'celdas'=> [[4,2]]] );// T
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'V'], [ 'celdas'=> [[5,2]]] );// V
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'N'], [ 'celdas'=> [[6,2]]] );// N
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'D'], [ 'celdas'=> [[7,2]]] );// D
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'A'], [ 'celdas'=> [[8,2]]] );// A



// CUADRO 2) CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
		$C=$F->cuadros[2];
				
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 11 ],  [ 'celdas'=> [[2,2]] ] );  //  (DMC)		
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=>  1 ],  [ 'celdas'=> [[3,2]] ] );  // Comedor
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 12 ],  [ 'celdas'=> [[4,2]] ] );  // Módulo Simple
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 13 ],  [ 'celdas'=> [[5,2]] ] );  // Módulo Doble
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 14 ],  [ 'celdas'=> [[6,2]] ] );  // Módulo Completo
									   


// CUADRO 3) CANTIDAD DE ALUMNOS Y HORAS CÁTEDRA EN CURSOS DE FORMACIÓN PROFESIONAL

		$C=$F->cuadros[3];
		$C->save_cuadro_migrador ([             'id_oferta_educativa'=>25,
												'id_modalidad'=>370, //valor por defecto, si no se carga combo
												'id_terminalidad_titulo'=>370000, //valor por defecto, si no se carga combo
												'id_modo_de_dictado'=>1,
												'id_caracteristica_matricula'=>1,
												'id_anio_estudio'=>1,
												'tabla_destino'=>'alumnos',
												'campo_destino'=>'varon',
												'col_combo1'=>2,
												'cp_destino1'=>'id_oferta_educativa',
												'anio_x_fila'=> 3 // asigna origen de id_anio_estudio desde el numero de la fila (-2)
											],  [ 'region'=> [[3,3,3,4]] ] );
		

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  ['celdas'=> [[3,4]] ] );

		$C->save_cuadro_migrador ([             'id_oferta_educativa'=>25, //no se usa en esta vista
												//'id_modalidad'=>0,
												//'id_terminalidad_titulo'=>0,
												'id_modo_de_dictado'=>1, // no se usa en esta vista
												'id_caracteristica_matricula'=>1, //no se usa en esta vista
												'id_anio_estudio'=>1,  //no se usa en esta vista
												'tabla_destino'=>'alumnos',
												'vista'=>'catedra_por_curso',  // se transforma con otra vista
												'campo_destino'=>'',
												'anio_x_fila'=> 3 // asigna origen de id_anio_estudio desde el numero de la fila (-2)
											],  [ 'region'=> [[3,6,3,7]] ] );        

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'hs_cat_total'],   ['celdas'=> [[3,6]] ] );
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'finalizado'  ] ,  ['celdas'=> [[3,7]] ] );



// CUADRO 4) CANTIDAD DE CURSOS Y SECCIONES

		$C=$F->cuadros[4];

		// -- las secciones
		$C->save_cuadro_migrador ([ 'id_oferta_educativa'=>25, 
									'id_tipo_seccion'=>'I',
									'id_anio_estudio'=>999,
									'tabla_destino'=>'secciones',
									'campo_destino'=>'cantidad',
								  ],  [ 'region'=> [[3,2,3,3]] ] );

		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_tipo_seccion'=>'S'],  [ 'celdas'=> [[3,2]] ] );  // secciones en sede
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_tipo_seccion'=>'R'],  [ 'celdas'=> [[3,3]] ] );  // secciones radiales





		return ($F);

    }   //FUNCTION I2019_FP


static public function I2019_CEC ($id_definicion_formulario)
    {   
        $F = new DefinicionFormularioController( $id_definicion_formulario);  // cargar el formulario




// CUADRO 1) TURNOS DE FUNCIONAMIENTO
		$C=$F->cuadros[1];
				
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','vista'=>'checkturnos','campo_destino'=>'','id_oferta_educativa'=>909,'id_personal'=>1,'id_turno'=>''],
										 [ 'region'=> [[2,2,8,2]] ] );// M		
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'M'], [ 'celdas'=> [[2,2]]] );// M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'I'], [ 'celdas'=> [[3,2]]] );// I
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'T'], [ 'celdas'=> [[4,2]]] );// T
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'V'], [ 'celdas'=> [[5,2]]] );// V
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'N'], [ 'celdas'=> [[6,2]]] );// N
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'D'], [ 'celdas'=> [[7,2]]] );// D
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'A'], [ 'celdas'=> [[8,2]]] );// A



// CUADRO 2) CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
		$C=$F->cuadros[2];
				
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 11 ],  [ 'celdas'=> [[2,2]] ] );  //  (DMC)		
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=>  1 ],  [ 'celdas'=> [[3,2]] ] );  // Comedor
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 12 ],  [ 'celdas'=> [[4,2]] ] );  // Módulo Simple
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 13 ],  [ 'celdas'=> [[5,2]] ] );  // Módulo Doble
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 14 ],  [ 'celdas'=> [[6,2]] ] );  // Módulo Completo
									   



// CUADRO 3) CANTIDAD DE ALUMNOS SEGÚN GRUPOS Y SEXO
        $C=$F->cuadros[3];

        $C->save_cuadro_migrador ([             //'id_oferta_educativa'=>0,
                                                'id_modalidad'=>0,
                                                'id_terminalidad_titulo'=>0,
                                                'id_modo_de_dictado'=>1,
                                                'id_caracteristica_matricula'=>1,
                                                'id_anio_estudio'=>1,
                                                'tabla_destino'=>'alumnos',
                                                'campo_destino'=>'varon',
                                                //'col_combo1'=>2,
                                                //'cp_destino1'=>'id_oferta_educativa',
                                                //'anio_x_fila'=> 3 // asigna origen de id_anio_estudio desde el numero de la fila (-2)
                                               ],  [ 'region'=> [[4,2,4,11]] ] );
        

        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_oferta_educativa'=>26],  ['region'=> [[4,2,4,3]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_oferta_educativa'=>27],  ['region'=> [[4,4,4,11]] ] );

        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>1],  ['region'=> [[4, 2,4, 3]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>1],  ['region'=> [[4, 4,4, 5]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>2],  ['region'=> [[4, 6,4, 7]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>3],  ['region'=> [[4, 8,4, 9]] ] );
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>4],  ['region'=> [[4,10,4,11]] ] );

        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  ['celdas'=> [[4,3],[4,5],[4,7],[4,9],[4,11] ] ] );



// CUADRO 4) CANTIDAD DE SECCIONES SEGÚN GRUPO

		$C=$F->cuadros[4];

		$C->save_cuadro_migrador ([ 'id_oferta_educativa'=>0, 
                                    'id_tipo_seccion'=>'I',
                                    'id_anio_estudio'=>0,
                                    'tabla_destino'=>'secciones',
                                    'campo_destino'=>'cantidad',
                                  ],  [ 'region'=> [[3,2,3,7]] ] );

		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>26],  [ 'celdas'=> [[ 3,2]] ] ); // G. Pre Primario         
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones', 'id_oferta_educativa'=>27],  [ 'region'=> [[ 3,3,3,7]] ] ); // G. Primario   

        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>1],  [ 'celdas'=> [[3,2]] ] ); // S. Pre Primario
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>1],  [ 'celdas'=> [[3,3]] ] ); // S. P. Inferior
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>2],  [ 'celdas'=> [[3,4]] ] ); // S. P. Medio
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>3],  [ 'celdas'=> [[3,5]] ] ); // S. P. Superior
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>4],  [ 'celdas'=> [[3,6]] ] ); // S. P. Grupo Acelerador
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'secciones','id_anio_estudio'=>999,'id_tipo_seccion'=>'M'],  [ 'celdas'=> [[3,7]] ] ); //S. Agrupadas


		return ($F);
    }   //FUNCTION I2019_CEC





static public function I2019_CEF ($id_definicion_formulario)
    {   
        $F = new DefinicionFormularioController( $id_definicion_formulario);  // cargar el formulario

// CUADRO 1) CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
		$C=$F->cuadros[1];
				
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 11 ],  [ 'celdas'=> [[2,2]] ] );  //  (DMC)		
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=>  1 ],  [ 'celdas'=> [[3,2]] ] );  // Comedor
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 12 ],  [ 'celdas'=> [[4,2]] ] );  // Módulo Simple
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 13 ],  [ 'celdas'=> [[5,2]] ] );  // Módulo Doble
		$C->save_cuadro_migrador (['tabla_destino'=>'servicio',	'vista'=>'servicio','campo_destino'=>'matricula', 'id_servicio_complementario'=> 14 ],  [ 'celdas'=> [[6,2]] ] );  // Módulo Completo
									   


// CUADRO 2) CANTIDAD DE GRUPOS POR TIPO DE ATENCIÓN SEGÚN REGIMEN DE TURNOD
		$C=$F->cuadros[2];

	// turnos= M,I,T,V,N,D,A
				
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'secciones', 
		                           'id_oferta_educativa'=>28, 'id_personal'=>1],  [ 'region'=> [[2,2,7,2]] ] );  // secciones, sec. orient
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','campo_destino'=>'secciones', 
		                           'id_oferta_educativa'=>28, 'id_personal'=>2],  [ 'region'=> [[2,3,7,3]] ] );  // secciones, tec.

		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'M' ],  [ 'region'=> [[2,2,2,3]] ] );  // M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'I' ],  [ 'region'=> [[3,2,3,3]] ] );  // I
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'T' ],  [ 'region'=> [[4,2,4,3]] ] );  // T
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'V' ],  [ 'region'=> [[5,2,5,3]] ] );  // V
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'N' ],  [ 'region'=> [[6,2,6,3]] ] );  // N
		//$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'D' ],  [ 'region'=> [[8,2,8,17]] ] );  // D
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=> 'A' ],  [ 'region'=> [[7,2,7,3]] ] );  // A


//'CUADRO 3) ALUMNOS POR TIPO DE ATENCIÓN Y SEXO SEGÚN OFERTA EDUCATIVA

        $C=$F->cuadros[3];

        $C->save_cuadro_migrador ([             'id_oferta_educativa'=>28,
                                                'id_modalidad'=>99,  //valor por defecto, si no se carga combo
                                                'id_terminalidad_titulo'=>99999, //valor por defecto, si no se carga combo
                                                'id_modo_de_dictado'=>1,
                                                'id_caracteristica_matricula'=>1,
                                                'id_anio_estudio'=>0,
                                                'tabla_destino'=>'alumnos',
                                                'campo_destino'=>'varon',
                                                'col_combo1'=>1,
                                                'cp_destino1'=>'id_oferta_educativa',
                                                //'anio_x_fila'=> 3 // asigna origen de id_anio_estudio desde el numero de la fila (-2)
                                               ],  [ 'region'=> [[3,2,3,5]] ] );
        
		$C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>1],  [ 'region'=> [[3,2,3,3]] ] ); // Atencion Propia
        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','id_anio_estudio'=>2],  [ 'region'=> [[3,4,3,5]] ] ); // Atencion de otro servicio

        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  ['celdas'=> [[3,3],[3,5]] ] );


		return ($F);
    }   //FUNCTION I2019_CEF




static public function I2019_CIIE ($id_definicion_formulario)
    {   
        $F = new DefinicionFormularioController( $id_definicion_formulario);  // cargar el formulario



// CUADRO 1) TURNOS DE FUNCIONAMIENTO
		$C=$F->cuadros[1];
				
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','vista'=>'checkturnos','campo_destino'=>'','id_oferta_educativa'=>905,'id_personal'=>1,'id_turno'=>''],
										 [ 'region'=> [[2,2,8,2]] ] );// M		
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'M'], [ 'celdas'=> [[2,2]]] );// M
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'I'], [ 'celdas'=> [[3,2]]] );// I
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'T'], [ 'celdas'=> [[4,2]]] );// T
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'V'], [ 'celdas'=> [[5,2]]] );// V
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'N'], [ 'celdas'=> [[6,2]]] );// N
		//$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'D'], [ 'celdas'=> [[7,2]]] );// D
		$C->save_cuadro_migrador (['tabla_destino'=>'secciones_matricula_turno','id_turno'=>'A'], [ 'celdas'=> [[8,2]]] );// A


// CUADRO 2) ALUMNOS DE CURSOS PRESENCIALES SEGÚN NIVELES/MODALIDADES, ÁREAS y SEXO
        $C=$F->cuadros[2];

        $C->save_cuadro_migrador ([             //'id_oferta_educativa'=>0,
                                                //'id_modalidad'=>0,
                                                //'id_terminalidad_titulo'=>0,
                                                'id_modo_de_dictado'=>1,
                                                'id_caracteristica_matricula'=>1,
                                                'id_anio_estudio'=>1,
                                                'tabla_destino'=>'alumnos',
                                                'campo_destino'=>'varon',
                                                'col_combo1'=>1,
                                                'cp_destino1'=>'id_oferta_educativa',
                                                //'anio_x_fila'=> 3 // asigna origen de id_anio_estudio desde el numero de la fila (-2)
                                               ],  [ 'region'=> [[3,2,3,3]] ] );
        

        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  ['celdas'=> [[3,3]] ] );

		// CUADRO 3) ALUMNOS DE CURSOS A DISTANCIA/VIRTUAL SEGÚN NIVELES/MODALIDADES, ÁREAS y SEXO

        $C=$F->cuadros[3];

        $C->save_cuadro_migrador ([             //'id_oferta_educativa'=>0,
                                                //'id_modalidad'=>0,
                                                //'id_terminalidad_titulo'=>0,
                                                'id_modo_de_dictado'=>2,
                                                'id_caracteristica_matricula'=>1,
                                                'id_anio_estudio'=>1,
                                                'tabla_destino'=>'alumnos',
                                                'campo_destino'=>'varon',
                                                'col_combo1'=>1,
                                                'cp_destino1'=>'id_oferta_educativa',
                                                //'anio_x_fila'=> 3 // asigna origen de id_anio_estudio desde el numero de la fila (-2)
                                               ],  [ 'region'=> [[3,2,3,3]] ] );
        

        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  ['celdas'=> [[3,3]] ] );

        // CUADRO 4) ALUMNOS DE ASISTENCIAS TÉCNICAS SEGÚN NIVELES / MODALIDADES, ÁREAS Y SEXO

        $C=$F->cuadros[4];

        $C->save_cuadro_migrador ([             //'id_oferta_educativa'=>0,
                                                //'id_modalidad'=>0,
                                                //'id_terminalidad_titulo'=>0,
                                                'id_modo_de_dictado'=>1,
                                                'id_caracteristica_matricula'=>1,
                                                'id_anio_estudio'=>1,
                                                'tabla_destino'=>'alumnos',
                                                'campo_destino'=>'varon',
                                                'col_combo1'=>1,
                                                'cp_destino1'=>'id_oferta_educativa',
                                                //'anio_x_fila'=> 3 // asigna origen de id_anio_estudio desde el numero de la fila (-2)
                                               ],  [ 'region'=> [[3,2,3,3]] ] );        

        $C->save_cuadro_migrador ([ 'tabla_destino'=>'alumnos','campo_destino'=>'mujer'],  ['celdas'=> [[3,3]] ] );




		return ($F);


    }  //FUNCTION I2019_CIIE





}
