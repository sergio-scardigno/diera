<?php

namespace App\Http\Controllers\Formulario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Def_formulario_organizacion;



class ArmarI2024Controller extends Controller
{


static public function I2024()
    {

        //dd('Lanzar creación de formularios INICIAL 2024');

      
        //$F=ArmarI2024Controller::I2024_INICIAL(150);
        //$F=ArmarI2024Controller::I2024_PRIMARIA(151); 
        //$F=ArmarI2024Controller::I2024_SECUNDARIA(152);
        //$F=ArmarI2024Controller::I2024_SUPERIOR(153);
        //$F=ArmarI2024Controller::I2024_EPA(154);
        //$F=ArmarI2024Controller::I2024_CENS(155);
        //$F=ArmarI2024Controller::I2024_ESPECIAL(156);
        // $F=ArmarI2024Controller::I2024_ARTISTICA(157);
        $F=ArmarI2024Controller::I2024_FP(158);
        // $F=ArmarI2024Controller::I2024_CEC(159);
        // $F=ArmarI2024Controller::I2024_CEF(160);
        // $F=ArmarI2024Controller::I2024_CIIE(161);

      
         
        $F->show();


    //          echo ' DELETE un Formulario guardado ... ' . '<BR>';
    //          $F2= new DefinicionFormularioController(10);
    //          $F2->def_formulario_delete();
    //          echo '   Definicion_formulario->id_definicion_formulario:' . $F2->id_definicion_formulario . ' DELETE <BR>';
// return $F2;


    }



static public function I2024_INICIAL($id_definicion_formulario)
    {

//////////////////////////////     
////////////////////////////       
//definir un nuevo formulario

      $F = new DefinicionFormularioController( $id_definicion_formulario);  // crear o cargar el formulario

      //$F->delete_consistencias();

      $F->nombre='MATRÍCULA INICIAL 2024 - EDUCACIÓN INICIAL';
      $F->nombre_corto='ED. INICIAL';
      $F->descripcion='Planilla Relevamiento Inicial 2024 de Ed. inicial';
      $F->id_periodo='106';
      $F->color='f_celeste';

      //asignar los tipo de organizacion del formulario
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'JI'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'JM'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'JP'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'JS'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'JU'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'JV'] );

//
// cuadro 1 INICIAL, CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
//

      $ncuadro=1;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO',
              'descripcion'=>'encabezado sae',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>2 ,
              'ancho'=>465,
              'filas'=>6,
              'columnas'=>2 
            ]);

      $CN=$F->cuadros[$ncuadro];

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,6,2]] ]);

      // TITULOS DE FILAS
      $CN->def_cuadro_store(['valor_inicial'=>'SERVICIO', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'CANTIDAD', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);

      // TITULOS DE COLUMNAS
      $CN->def_cuadro_store(['valor_inicial'=>'Desayuno y Merienda Completa',  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Comedor',                       'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Simple',                 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Doble',                  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Completo',               'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[3,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[4,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[6,2]] ]);

      $CN->consistencia_cantidad_x_cuadro(0); // por si hay que eliminar consistencias viejas

//
// cuadro 2, INICIAL - ALUMNOS MATRICULADOS POR AÑO Y SEXO
//

      $ncuadro=2;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'ALUMNOS MATRICULADOS POR AÑO Y SEXO',
              'descripcion'=>'matrícula de JM Y JI',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // tiene que TENER DATOS
              //'ancho'=>1280,
              'filas'=>4,
              'columnas'=>16
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,16]] ]);


      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'CICLO JARDÍN MATERNAL','colspan'=>6,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'CICLO JARDÍN DE INFANTES','colspan'=>6,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','rowspan'=>2,'colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,14]] ]);
      
      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Lactantes' , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Deambuladores', 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sala de 2 años', 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sala de 3 años'    , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sala de 4 años'    , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,10]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sala de 5 años'    , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,12]] ]);

      // fila 3
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                            ['celdas'=> [[3,2], [3,4],[3,6],[3,8],[3,10],[3,12],[3,14]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                            ['celdas'=> [[3,3], [3,5],[3,7],[3,9],[3,11],[3,13],[3,15]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], 
                            ['celdas'=> [[3,16]] ]);
      //filas 4 

      $CN->def_cuadro_store(['valor_inicial'=>'Matrícula', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'],
                            ['celdas'=> [[4,1]] ]);

                            
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>100] , ['region'=> [ [4,2 ,4,7]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>101] , ['region'=> [ [4,8 ,4,13]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>1100] , ['region'=> [ [4,14,4,16]] ]);
      //$CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'total_calculado','c_mapa'=>1122] , ['region'=> [ [4,12,11,14]] ]);

      $CN->def_cuadro_save() ;


      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 100, [100],'inicial cuadro 4') ;
      $CN->mapacuadro_store_c_mapa ( 101, [101],'inicial cuadro 4') ;
      $CN->mapacuadro_store_c_mapa (1100, [100,101],'inicial cuadro 4') ;


      // DEFINIR CONSISTENCIAS
      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'JARDIN - cuadro 2, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [14] ] ,
              'cmp2' => ['col' => [2,4,6,8,10,12] ] ,
              'cmp3' => '',
              'msg1' => 'El total de varones ',
              'msg2' => 'es distinto de suma de varones ',
              'msg3' => '',    
              'descripcion' => 'JARDIN - cuadro 2, Total x fila <> suma de varones'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [15] ] ,
              'cmp2' => ['col' => [3,5,7,9,11,13] ] ,
              'cmp3' => '',
              'msg1' => 'El total de mujeres ',
              'msg2' => 'es distinto de suma de mujeres ',
              'msg3' => '',    
              'descripcion' => 'JARDIN - cuadro 2, Total x fila <> suma de mujeres'
            ] ); 
      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [16] ] ,
              'cmp2' => ['col' => [14,15] ] ,
              'cmp3' => '',
              'msg1' => 'El total ',
              'msg2' => 'es distinto de suma de total varón + total mujer',
              'msg3' => '',    
              'descripcion' => 'JARDIN - cuadro 2, Total x fila <> suma de varón + mujer'
            ] ); 
      $CN->consistencia_save( 
            [
              'numero' => 5,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [3,5,6,7] ] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'JARDIN - cuadro 2, control de cuadros dependientes'
            ] );     


      $CN->consistencia_cantidad_x_cuadro(5); // por si hay que eliminar consistencias viejas


//
// cuadro 3, JARDIN - CANTIDAD DE SECCIONES POR EDAD DE LA SALA SEGÚN CICLO
//

      $ncuadro=3;
      $F->def_formulario_add_cuadro (
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE SECCIONES POR EDAD DE LA SALA SEGÚN CICLO',
              'descripcion'=>'secciones de JM Y JI',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // tiene que TENER DATOS
              //'ancho'=>1280,
              'filas'=>3,
              'columnas'=>10
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,3,10]] ]);


      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'CICLO JARDÍN MATERNAL','colspan'=>4,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'CICLO JARDÍN DE INFANTES','colspan'=>4,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','rowspan'=>2,'colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,10]] ]);
      
      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Lactantes'                           , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Deambuladores'                          , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sala de 2 años'                          , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Múltiple C. J. Maternal'        , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,5]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sala de 3 años'                              , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sala de 4 años'                              , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,7]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sala de 5 años'                              , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Múltiple C. J. Infantes / multi-ciclo' , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,9]] ]);

      // fila 3   
      $CN->def_cuadro_store(['valor_inicial'=>'Scciones', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);

      
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>100] , ['region'=> [ [3,2 ,3,5]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>101] , ['region'=> [ [3,6 ,3,9]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>1100] , ['celdas'=> [ [3,10]] ]);

      $CN->def_cuadro_save() ;


      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 100, [100],'I2024 - inicial cuadro 4') ;
      $CN->mapacuadro_store_c_mapa ( 101, [101],'I2024 - inicial cuadro 4') ;
      $CN->mapacuadro_store_c_mapa (1100, [100,101],'I2024 - inicial cuadro 4') ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar secciones',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'Inicial -cuadro 3, ingresar datos no 0 or on'
            ] );
      
      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [10] ] ,
              'cmp2' => ['col' => [2,3,4,5,6,7,8,9] ] ,
              'cmp3' => '',
              'msg1' => 'El total ',
              'msg2' => 'es distinto de suma de secciones por ciclo y año',
              'msg3' => '',    
              'descripcion' => 'Inicial -cuadro 3, Total x fila <> suma de secciones'
            ] ); 


      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 22, //Comparaciones de cuadross alumnos y secciones
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'alu' =>[ 
                                    [[[2,0,2],[2,0,3]], //alumnos 0 a 1 año V+M  Ciclo MATERNAL
                                    [[2,0,4],[2,0,5]], //alumnos 1 a 2 años V+M  Ciclo MATERNAL
                                    [[2,0,6],[2,0,7]] ], //alumnos 2 a 3 años V+M  Ciclo MATERNAL

                                    [[[2,0,8],[2,0,9]],    //alumnos 3 años V+M  Ciclo INFANTES
                                    [[2,0,10],[2,0,11]],   //alumnos 4 años V+M  Ciclo INFANTES
                                    [[2,0,12],[2,0,13]] ], //alumnos 5 años V+M  Ciclo INFANTES
                                ]
                        ],
              'cmp2' => [ 'sei' =>[ 
                                    [[[3,3,2]],   //secciones independientes 0 a 1 años Ciclo MATERNAL
                                      [[3,3,3]],   //secciones independientes 1 a 2 años Ciclo MATERNAL
                                      [[3,3,4]] ], //secciones independientes 2 a 3 años Ciclo MATERNAL

                                    [[[3,3,6]],   //secciones independientes 0 a 1 años Ciclo INFANTES
                                      [[3,3,7]],   //secciones independientes 1 a 2 años Ciclo INFANTES
                                      [[3,3,8]] ], //secciones independientes 2 a 3 años Ciclo INFANTES

                                  ],
                          'sea' => [  [[3,3,5]], [[3,3,9]]  ], // secciones agrupadas del nivel
                          'sa2' => [  [[3,3,9]], []  ] // secciones agrupadas alternativas del nivel 
                        ] ,
              
              'cmp3' => [ 'des' =>  [                                      
                                            ['Lactantes Ciclo J. MATERNAL', 
                                            'Deambuladores Ciclo J. MATERNAL',
                                            'Sala de 2 años Ciclo J. MATERNAL'
                                            ],

                                            ['Sala de 3 años Ciclo J. INFANTES',
                                            'Sala de 4 años Ciclo J. INFANTES',
                                            'Sala de 5 años Ciclo J. INFANTES' 
                                            ],                                       
                                      ]
                        ],  // titulos de comprobacion alumnos

              'msg1' => 'Los alumnos del ',
              'msg2' => 'informados, no se corresponden con las secciones declaradas',
              'msg3' => '',    
              'descripcion' => 'comparacion de alumnos varon + mujer con secciones independientes y/ agrupadas'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 23, // relacion alumnos por seccion
              'c_categoria_consistencia' =>  2, // Consistencia de advertencia
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'num' =>[ 
                                    [[2,0,2],[2,0,3],[2,0,4],[2,0,5],[2,0,6],[2,0,7]], //alumnos 0 a 1,  1 a 2, 2 a 3 año V+M  Ciclo MATERNAL
                                    [[2,0,8],[2,0,9],[2,0,10],[2,0,11],[2,0,12],[2,0,13]] //alumnos 0 a 1,  1 a 2, 2 a 3 año V+M  Ciclo INFANTES
                                  ],

                          'div' =>[ [[3,3,2],[3,3,3],[3,3,4],[3,3,5]], //secciones 1,2,3, AG ° año, Ciclo MATERNAL
                                              [[3,3,6],[3,3,7],[3,3,8],[3,3,9]] //secciones 1,2,3, AG ° año, Ciclo INFANTES
                                  ]
                        ],
              'cmp2' => [ 'min' =>[ 3,  // MATERNAL
                                    15 // INFANTES                                      
                                  ],
                          'max' =>[ 20, //MATERNAL
                                    38 //INFANTES                                      
                                  ]
                        ] ,
              
              'cmp3' => [ 'des' =>  ['Ciclo Jardín Maternal',
                                      'Ciclo Jardín de Infantes'                                       
                                    ] 
                        ],  
              'msg1' => 'La relación de alumnos por división/grupo de ',
              'msg2' => ' no es la esperada para los valores habituales, ',
              'msg3' => 'alumnos por división, verifique la cantidad de alumnos y divisiones/grupos cargadas, si es correcto ignore esta advertencia',
              'descripcion' => 'advertencia de alumnos x seccion fuera de rango'
            ] );
      $CN->consistencia_save( 
            [
              'numero' => 5,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [5] ] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'Inicial -cuadro 3, control de cuadros dependientes'
            ] );     

      $CN->consistencia_save( 
            [
              'numero' => 6,
              'c_tipo_consistencia' => 27, // ctrol de secciones multiples y mas de 1 años con alumnos
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'niv' =>[ 
                                    [ [[2,0,2],[2,0,3]],[[2,0,4],[2,0,5]],[[2,0,6],[2,0,7]] ], // Ciclo MATERNAL
                                    [ [[2,0,2],[2,0,3]],[[2,0,4],[2,0,5]],[[2,0,6],[2,0,7]],
                                      [[2,0,8],[2,0,9]],[[2,0,10],[2,0,11]],[[2,0,12],[2,0,13]] ] // Ciclo maternal+INFANTES
                                  ],
                        ],
              'cmp2' => [ 'sea' =>[
                                    [[3,3,5]], // secciones AG ° año, Ciclo MATERNAL
                                    [[3,3,9]], // secciones AG ° año, Ciclo INFANTES
                                  ],
                        ],
              'cmp3' => [ 'msg_niv' =>[
                                        'ciclo maternal', // secciones AG ° año, Ciclo MATERNAL
                                        'ciclo jardin de infantes / multi-ciclo', // secciones AG ° año, Ciclo INFANTES
                                      ],
                        ],
              'msg1' => 'Si declara',
              'msg2' => 'seccion/es multiple/s de',
              'msg3' => 'debe declarar alumnos en mas de una edad / año en cuadro:',
              'descripcion' => 'Inicial -cuadro 3, ctrol secciones multiples y mas de 1 años con alumnos'
            ] );  




      $CN->consistencia_cantidad_x_cuadro(6); // por si hay que eliminar consistencias viejas




//
// cuadro 4 INICIAL, EQUIPO DE ORIENTACION ESCOLAR
//

      $ncuadro=4;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'EQUIPO DE ORIENTACION ESCOLAR',
              'descripcion'=>'E.O.E',
              'c_tipo_cuadro'=>4,  // con checkbox
              'c_criterio_completitud'=>2 , // puede no TENER DATOS
              'ancho'=>300,
              'filas'=>6,
              'columnas'=>2
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,6,2]] ]);


      // TITULOS DE FILAS
      
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'EQUIPO DE ORIENTACION ESCOLAR'  ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      
      // fila 2 a 6
      $CN->def_cuadro_store(['valor_inicial'=>'No posee equipo','titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'EOE - (incluido en POF de su escuela)','titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'ED - Equipo de Distrito','titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Extensión de EOE - (POF de otra escuela)','titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Escuela','titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);


      // AREA DE DATOS
      // para anular el CUADRO comentar estas dos lineas
      
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'], ['region'=> [ [2,2 ,5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'textarea'], ['celdas'=> [ [6,2]] ]);

      $CN->def_cuadro_save() ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar una opción',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'INICIAL Cuadro 4, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 18, // consistencia de validacion de checkbox
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa                          
              'cmp1' => ['chk'=> [ [[2,2],[3,2],[4,2],[5,2]] ], // conjunto de celdas chk, a validar (1 sola puede ser tildada x vez)
                        ],
              'cmp2' => ['ckp' => [ [4,5,2] ],     // ckp (check padre) celdas que habilitan la carga/tilde de celdas hijos (chi)
                                                    // puede estar en otro cuadro   
                          'chi'=> [ [[6,2]] ] // chi (celdas hijos) celdas habilitadas x el tilde de ckp
                        ],
              'cmp3' => [ 'mch' => [ 'Solo una opción de EOE puede ser seleccionada'] , // mensaje para el grupo de celdas chk
                          'mc0' => [ 'Si Extensión de EOE no está seleccionada, no debe informar escuelas'], // mensaje si la celda padre NO esta chequeada 
                          'mc1' => [ 'Si Extensión de EOE está seleccionada, debe informar escuelas'], // mensaje si la celda padre esta chequeada 
                        ] ,
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'INICIAL -cuadro 4, validacion de E.O.E'
            ] );


      $CN->consistencia_cantidad_x_cuadro(2); // por si hay que eliminar consistencias viejas



//
// cuadro 5 - INICIAL, ALUMNOS Y SECCIONES POR CICLO SEGÚN REGIMEN DE TURNOS
//

      $ncuadro=5;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'ALUMNOS Y SECCIONES POR CICLO SEGÚN REGIMEN DE TURNOS',
              'descripcion'=>'ALUMNOS Y SECCIONES POR CICLO SEGÚN REGIMEN DE TURNOS',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // obligatorio DATOS                                              
              'ancho'=>500,
              'filas'=>10,
              'columnas'=>5 
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,10,5]] ]);

      // TITULOS DE FILAS

      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'TURNOS','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'CICLO JARDÍN MATERNAL', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'CICLO JARDÍN DE INFANTES', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      
      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Alumnos','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,2],[2,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Secciones','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,3],[2,5]] ]);


      //filas 3 y 10
      $CN->def_cuadro_store(['valor_inicial'=>'Mañana', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Intermedio', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Tarde', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Vespertino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Noche', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[7,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Doble esc.', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[8,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Alternado', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[9,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[10,1]] ]);

          
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>100] , ['region'=> [ [3,2,10,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>101] , ['region'=> [ [3,4,10,5]] ]);
      //$CN->def_cuadro_store(['c_mapa'=>119], ['region'=> [ [4,1,4,13]] ]);

      $CN->def_cuadro_save() ;


      // DEFINIR mapa_cuadro DEL CUADRO

      $CN->mapacuadro_store_c_mapa ( 100, [100],'I2024 - inicial cuadro 6') ;
      $CN->mapacuadro_store_c_mapa ( 101, [101],'I2024 - inicial cuadro 6') ;


    // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' =>  1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'INICIAL-cuadro 5, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' =>  2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1 , // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => 'Alumnos - Jardín Maternal ',
                                      '3' => 'Secciones - Jardín Maternal ',
                                      '4' => 'Alumnos - Jardín Infantes ',
                                      '5' => 'Secciones - Jardín Infantes ',
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'especial-cuadro 5, Suma de columna xxx <> Total'
            ] );                      

      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 25, // consistencia de comparacion menor val1, val1_1,val1_2 < val2
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
                        // celdas a comparar del cuadro
              'cmp1' => ['v1'=> [ [[[ 10,2]] ], // MATERNAL alumnos
                                  [[[ 10,3]] ], // MATERNAL secciones
                                  [[[ 10,4]] ], // infantes alumnos
                                  [[[ 10,5]] ] // infantes secciones
                                  
                                ]
                        ], 
              'cmp2' => ['v2'=>[   // celdas de otros cuadros a sumar para la comparación
                                  ['reg'=>[[2,0,2,0, 7 ]]],  // MATERNAL alumnos
                                  ['reg'=>[[3,0,2,0, 5 ]]],  // MATERNAL secciones
                                  ['reg'=>[[2,0,8,0,13 ]]],  //infantes alumnos
                                  ['reg'=>[[3,0,6,0, 9 ]]] ,  // infantes secciones
                                ],
                          'sig'=>'!=',
                        ],
              'cmp3' => ['d1'=> [ [ 'Los alumnos de C. Maternal'],
                                  [ 'Las secciones de C. Maternal'],
                                  [ 'Los alumnos de C. Jardin de Infantes'],
                                  [ 'Las secciones de C. Jardin de Infantes']                                  
                                ],                              
                        'd2'=> [ ['2'],
                                  ['3'],
                                  ['2'],
                                  ['3'],
                                ]
                        ],
              'msg1' => '',
              'msg2' => 'son distintos de lo informados en cuadro ',
              'msg3' => '',    
              'descripcion' => 'especial-cuadro 5, comparacion de alumnos y secciones diferentes'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 24, //consistencia para verificar la carga de alumnos y secciones para CUADROS DE CANTIDAD DE ALUMNOS Y SECCIONES POR TURNO
              'c_categoria_consistencia' => 3, // Consistencia de Error
              'c_estado' =>  1 , // Consistencia activa
              'cmp1' => [[2,3],[4,5]] , // parejas de columnas de alumnos y secciones a comparar
              'cmp2' => [5,null], //colmnas de celda alternativa para secciones agrupadas multinivel
              'cmp3' => ['msg' => ['Ciclo J. Maternal', 'Ciclo J. Infantes'],
                        ],
              'msg1' => '', // 
              'msg2' => '', //
              'msg3' => '',    
              'descripcion' => 'inicial-cuadro 5, CANTIDAD DE ALUMNOS Y SECCIONES POR TURNO'
            ] );                      

      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas

//
// cuadro 6 INICIAL, ALUMNOS POR CICLO SEGÚN TIPO DE JORNADA
//

      $ncuadro=6;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'ALUMNOS POR CICLO SEGÚN TIPO DE JORNADA',
              'descripcion'=>'ALUMNOS POR CICLO SEGÚN TIPO DE JORNADA de inicial',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // obligatorio DATOS                                              
              'ancho'=>500,
              'filas'=>5,
              'columnas'=>3 
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,5,3]] ]);

      // TITULOS DE FILAS

      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'TIPO DE JORNADA','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'ALUMNOS CICLO JARDIN MATERNAL', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'ALUMNOS CICLO JARDIN DE INFANTES', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
      
      //filas 2 a 5
      $CN->def_cuadro_store(['valor_inicial'=>'Jornada Simple (hasta 29 hs, semanales)', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Jornada Extendida (30 hs, semanales)', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Jornada Doble (40 hs, semanales)', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);

        
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>100] , ['region'=> [ [2,2,5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>101] , ['region'=> [ [2,3,5,3]] ]);

      //$CN->def_cuadro_store(['c_mapa'=>119], ['region'=> [ [4,1,4,13]] ]);

      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO

      $CN->mapacuadro_store_c_mapa ( 100, [100],'I2024 - inicial cuadro 6') ;
      $CN->mapacuadro_store_c_mapa ( 101, [101],'I2024 - inicial cuadro 6') ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' =>  1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'inicial 6, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' =>  2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1 , // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => 'Alumnos - Jardín Maternal ',
                                      '3' => 'Alumnos - Jardín Infantes ',
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'inicial-cuadro 6, Suma de columna xxx <> Total'
            ] );                      

      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 25, // consistencia de comparacion menor val1, val1_1,val1_2 < val2
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
                        // celdas a comparar del cuadro
              'cmp1' => ['v1'=> [ [[[ 5,2]] ], // MATERNAL alumnos
                                  [[[ 5,3]] ], // infantes alumnos
                                  
                                ]
                        ], 
              'cmp2' => ['v2'=>[   // celdas de otros cuadros a sumar para la comparación
                                  ['reg'=>[[2,0,2,0, 7 ]]],  // MATERNAL alumnos
                                  ['reg'=>[[2,0,8,0,13 ]]],  //infantes alumnos
                                ],
                          'sig'=>'!=',
                        ],
              'cmp3' => ['d1'=> [ [ 'Los alumnos de C. Maternal'],
                                  [ 'Los alumnos de C. Jardin de Infantes'],
                                ],                              
                        'd2'=> [ ['2'],
                                  ['2'],
                                ]
                        ],
              'msg1' => '',
              'msg2' => 'son distintos de lo informados en cuadro ',
              'msg3' => '',    
              'descripcion' => 'inicial-cuadro 6, comparacion de alumnos diferentes'
            ] );

        $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas


//
// cuadro 7 INICIAL, ALUMNOS POR SEXO NO BINARIO
//

        $ncuadro=7;
        $F->def_formulario_add_cuadro ( 
              [
                'numero'=>$ncuadro,
                'nombre'=>'ALUMNOS POR CICLO SEGÚN SEXO, NO BINARIO',
                'descripcion'=>'ALUMNOS POR CICLO SEGÚN SEXO, NO BINARIO de inicial',
                'c_tipo_cuadro'=>1,
                'c_criterio_completitud'=>1 , // obligatorio DATOS
                'indicaciones'=>'Nota: En concordancia con decreto DCTO-2021-476-APN-PTE.',                                                                                            
                'ancho'=>500,
                'filas'=>5,
                'columnas'=>3 
              ]);
            
        $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir
            
        // inicializar las celdas del cuadro
        $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,5,3]] ]);
            
        // TITULOS DE FILAS
            
        //fila 1
        $CN->def_cuadro_store(['valor_inicial'=>'SEXO','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'ALUMNOS CICLO JARDIN MATERNAL', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'ALUMNOS CICLO JARDIN DE INFANTES', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
            
        //filas 2 a 5
        $CN->def_cuadro_store(['valor_inicial'=>'Masculino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'Femenino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'X (no binario)', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
            
        $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
            
            
        // AREA DE DATOS
        $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>100] , ['region'=> [ [2,2,5,2]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>101] , ['region'=> [ [2,3,5,3]] ]);
            
        //$CN->def_cuadro_store(['c_mapa'=>119], ['region'=> [ [4,1,4,13]] ]);
            
        $CN->def_cuadro_save() ;
            
        // DEFINIR mapa_cuadro DEL CUADRO
            
        $CN->mapacuadro_store_c_mapa ( 100, [100],'I2024 - inicial cuadro 8') ;
        $CN->mapacuadro_store_c_mapa ( 101, [101],'I2024 - inicial cuadro 8') ;
            
            
        // DEFINIR CONSISTENCIAS
            
        $CN->consistencia_save( 
              [
                'numero' =>  1,
                'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => '',
                'msg1' => 'Debe consignar alumnos',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'inicial 7, ingresar datos no 0 or on'
              ] );
              
        $CN->consistencia_save( 
              [
                'numero' =>  2,
                'c_tipo_consistencia' => 16, //totales de columna
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1 , // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => ['tit' => [   '2' => 'Alumnos - Jardín Maternal ',
                                        '3' => 'Alumnos - Jardín Infantes ',
                                    ]
                          ],
                'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
                'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
                'msg3' => '',    
                'descripcion' => 'inicial-cuadro 7, Suma de columna xxx <> Total'
              ] );                      
                        
        $CN->consistencia_save( 
              [
                'numero' => 3,
                'c_tipo_consistencia' => 25, // consistencia de comparacion menor val1, val1_1,val1_2 < val2
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                          // celdas a comparar del cuadro
                'cmp1' => ['v1'=> [ [[[ 5,2]] ], // MATERNAL alumnos
                                    [[[ 5,3]] ], // infantes alumnos

                                  ]
                          ], 
                'cmp2' => ['v2'=>[   // celdas de otros cuadros a sumar para la comparación
                                    ['reg'=>[[2,0,2,0, 7 ]]],  // MATERNAL alumnos
                                    ['reg'=>[[2,0,8,0,13 ]]],  //infantes alumnos
                                  ],
                            'sig'=>'!=',
                          ],
                'cmp3' => ['d1'=> [ [ 'Los alumnos de C. Maternal'],
                                    [ 'Los alumnos de C. Jardin de Infantes'],
                                  ],                              
                          'd2'=> [ ['2'],
                                    ['2'],
                                  ]
                          ],
                'msg1' => '',
                'msg2' => 'son distintos de lo informados en cuadro ',
                'msg3' => '',    
                'descripcion' => 'inicial-cuadro 7, comparacion de alumnos diferentes'
              ] );
                        
        $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas
                        

      $F->def_formulario_save();  
      return ($F);

    }   // FORMULARIO DE INICIAL

















//////////////////////////////////
//////////////////////////////////
//////////////////////////////////
//////////////////////////////////
//////////////////////////////////









static public function I2024_PRIMARIA($id_definicion_formulario)
    {

       
////////////////////////////       
//definir un nuevo formulario
//////////////////////////////
///////////////////////////////

      $F = new DefinicionFormularioController( $id_definicion_formulario);  // crear o cargar el formulario

      //$F->delete_consistencias();

      $F->nombre='MATRÍCULA INICIAL 2024 - EDUCACIÓN PRIMARIA';
      $F->nombre_corto='ED. PRIMARIA';
      $F->descripcion='Planilla Relevamiento Inicial 2024 de Ed. Primaria';
      $F->id_periodo='106';
      $F->color='f_celeste';

      //asignar los tipo de organizacion del formulario
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'PP'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'PA'] );

//
// // cuadro 1 PRIMARIA, CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
//
      $ncuadro=1;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO',
              'descripcion'=>'encabezado sae',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>2 ,
              'ancho'=>465,
              'filas'=>6,
              'columnas'=>2 
            ]);

      $CN=$F->cuadros[$ncuadro];

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,6,2]] ]);

      // TITULOS DE FILAS
      $CN->def_cuadro_store(['valor_inicial'=>'SERVICIO', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'CANTIDAD', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);

      // TITULOS DE COLUMNAS
      $CN->def_cuadro_store(['valor_inicial'=>'Desayuno y Merienda Completa',  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Comedor',                       'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Simple',                 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Doble',                  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Completo',               'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[3,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[4,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[6,2]] ]);

      $CN->consistencia_cantidad_x_cuadro(0); // por si hay que eliminar consistencias viejas




//
//      // cuadro 2, PRIMARIA - ALUMNOS MATRICULADOS POR AÑO Y SEXO
//


      $ncuadro=2;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'NIVEL PRIMARIO - CANTIDAD DE ALUMNOS MATRICULADOS POR AÑO Y SEXO.',
              'descripcion'=>'matrícula de PP Y PA',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // tiene que TENER DATOS
              'ancho'=>1100,
              'filas'=>3,
              'columnas'=>16
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      
      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,3,16]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>''  ,'rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],      ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'1º','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],      ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2º','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],      ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3º','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],      ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'4º','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],      ['celdas'=> [[1,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'5º','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],      ['celdas'=> [[1,10]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'6º','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],      ['celdas'=> [[1,12]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],   ['celdas'=> [[1,14]] ]);


      // fila 2

      $CN->def_cuadro_store(['valor_inicial'=>'Varón','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],     ['celdas'=> [[2,2],[2,4],[2,6],[2,8],[2,10],[2,12],[2,14]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],     ['celdas'=> [[2,3],[2,5],[2,7],[2,9],[2,11],[2,13],[2,15]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],     ['celdas'=> [[2,16]] ]);

      // fila 3

      $CN->def_cuadro_store(['valor_inicial'=>'Matrícula','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>102], ['region'=> [ [3,2 ,3,16]] ]);

      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 102, [102],'I2024 - primaria cuadro 2') ;







      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 2, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [14] ] ,
              'cmp2' => ['col' => [2,4,6,8,10,12] ] ,
              'cmp3' => '',
              'msg1' => 'El total de varones ',
              'msg2' => 'es distinto de suma de varones ',
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 2, Total x fila <> suma de varones'
            ] );

    $CN->consistencia_save(
            [
              'numero' => 3,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [15] ] ,
              'cmp2' => ['col' => [3,5,7,9,11,13] ] ,
              'cmp3' => '',
              'msg1' => 'El total de mujeres ',
              'msg2' => 'es distinto de suma de mujeres ',
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 2, Total x fila <> suma de mujeres'
            ] ); 
    $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [16] ] ,
              'cmp2' => ['col' => [14,15] ] ,
              'cmp3' => '',
              'msg1' => 'El total ',
              'msg2' => 'es distinto de suma de total varón + total mujer',
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 2, Total x fila <> suma de varón + mujer'
            ] ); 
    $CN->consistencia_save( 
            [
              'numero' => 5,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [3,8,9,10,11] ] , // 11 ,agregar/sacar cuadro 11 en momento inicial/FINAL
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 2, control de cuadros dependientes'
            ] ); 


    $CN->consistencia_cantidad_x_cuadro(5); // por si hay que eliminar consistencias viejas


//
// //       // cuadro 3, PRIMARIA - SECCIONES POR AÑO Y SEXO
//


      $ncuadro=3;
      $F->def_formulario_add_cuadro ( 
              [
                'numero'=>$ncuadro,
                'nombre'=>'NIVEL PRIMARIO - CANTIDAD DE SECCIONES POR AÑO.',
                'descripcion'=>'secciones de PP Y PA',
                'c_tipo_cuadro'=>1,
                'c_criterio_completitud'=>1 , // tiene que TENER DATOS
                'ancho'=>800,
                'filas'=>2,
                'columnas'=>9
              ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,2,9]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],         ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'1º','colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],       ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2º','colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],       ['celdas'=> [[1,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3º','colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],       ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'4º','colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],       ['celdas'=> [[1,5]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'5º','colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],       ['celdas'=> [[1, 6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'6º','colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],       ['celdas'=> [[1, 7]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Múltiple','colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1, 8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],    ['celdas'=> [[1,9]] ]);


      // fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Secciones','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],             ['celdas'=> [[2,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>102], ['region'=> [ [2,2 ,2,9]] ]);

      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 102, [102],'I2024 - primaria cuadro 3') ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar secciones',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 3, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [9] ] ,
              'cmp2' => ['col' => [2,3,4,5,6,7,8] ] ,
              'cmp3' => '',
              'msg1' => 'El total de secciones ',
              'msg2' => 'es distinto de suma de secciones por año ',
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 3, Total x fila <> suma de secciones'
            ] );


    $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 22, //Comparaciones de cuadross alumnos y secciones
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'alu' =>[ 
                                    [[[2,0,2],[2,0,3]], //alumnos 1 año V+M  primaria
                                      [[2,0,4],[2,0,5]], //alumnos 2 años V+M  primaria
                                      [[2,0,6],[2,0,7]], //alumnos 3 años V+M primaria

                                      [[2,0,8],[2,0,9]],    //alumnos 4 años V+M  primaria
                                      [[2,0,10],[2,0,11]],   //alumnos 5 años V+M primaria
                                      [[2,0,12],[2,0,13]] ], //alumnos 6 años V+M  primaria
                                  ]
                        ],
              'cmp2' => [ 'sei' =>[ 
                                    [[[3,2,2]],   //secciones independientes 1 años primaria
                                      [[3,2,3]],   //secciones independientes 2 años primaria
                                      [[3,2,4]],   //secciones independientes 3 años primaria
                                      [[3,2,5]],   //secciones independientes 4 años primaria
                                      [[3,2,6]],   //secciones independientes 5 años primaria
                                      [[3,2,7]] ], //secciones independientes 6 años primaria

                                  ],
                          'sea' => [ [[3,2,8]]  ], // secciones agrupadas del nivel
                          'sa2' => [ []  ] // secciones agrupadas alternativas del nivel 
                        ] ,
              
              'cmp3' => [ 'des' =>  [                                      
                                        ['1° año', 
                                        '2° año',
                                        '3° año',
                                        '4° año',
                                        '5° año',
                                        '6° año' 
                                        ],                                       
                                      ]
                        ],  // titulos de comprobacion alumnos

              'msg1' => 'Los alumnos de ',
              'msg2' => 'informados, no se corresponden con las secciones declaradas',
              'msg3' => '',    
              'descripcion' => 'comparacion de alumnos varon + mujer con secciones independientes y/ agrupadas'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 23, // relacion alumnos por seccion
              'c_categoria_consistencia' =>  2, // Consistencia de advertencia
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'num' =>[ 
                                    [[2,0,16] ] //alumnos total de primaria
                                  ],

                          'div' =>[ [[3,2,9]] //secciones total de primaria
                                  ]
                        ],
              'cmp2' => [ 'min' =>[ 15,  // primaria
                                  ],
                          'max' =>[ 38, // primaria
                                  ]
                        ] ,
              
              'cmp3' => [ 'des' =>  [' Ed. Primaria '
                                    ] 
                        ],
              'msg1' => 'La relación de alumnos por sección de ',
              'msg2' => ' no es la esperada para los valores habituales, ',
              'msg3' => 'alumnos por sección, verifique la cantidad de alumnos y secciones cargadas, si es correcto ignore esta advertencia',
              'descripcion' => 'advertencia de alumnos x seccion fuera de rango'                                           
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 5,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [8] ] , // CONSISTIMOS CUADRO DE SECCIONES
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 2, control de cuadros dependientes'
            ] );      

      $CN->consistencia_save( 
            [
              'numero' => 6,
              'c_tipo_consistencia' => 27, // ctrol de secciones multiples y mas de 1 años con alumnos
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'niv' =>[ 
                                    [ [[2,0,2],[2,0,3]], //alumnos 1 año V+M  primaria
                                      [[2,0,4],[2,0,5]], //alumnos 2 años V+M  primaria
                                      [[2,0,6],[2,0,7]], //alumnos 3 años V+M primaria

                                      [[2,0,8],[2,0,9]],    //alumnos 4 años V+M  primaria
                                      [[2,0,10],[2,0,11]],   //alumnos 5 años V+M primaria
                                      [[2,0,12],[2,0,13]] ], //alumnos 6 años V+M  primaria
                                  ],
                        ],
              'cmp2' => [ 'sea' =>[
                                    [[3,2,8]], // secciones AG ° año, primaria
                                  ],
                        ],
              'cmp3' => [ 'msg_niv' =>[
                                        'nivel primario', // secciones AG ° año, n primario
                                      ],
                        ],
              'msg1' => 'Si declara',
              'msg2' => 'sección/es múltiples de',
              'msg3' => 'debe declarar alumnos en más de una año en cuadro:',    
              'descripcion' => 'primaria - cuadro 3, ctrol secciones multiples y mas de 1 años con alumnos'
            ] );  


            
    $CN->consistencia_cantidad_x_cuadro(6); // por si hay que eliminar consistencias viejas


//
// //       // cuadro 4, PRIMARIA - ALUMNOS MATRICULADOS POR AÑO Y SEXO
//


      $ncuadro=4;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                      'nombre'=>'NIVEL INICIAL - CANTIDAD DE ALUMNOS MATRICULADOS POR AÑO Y SEXO. (si su establecimiento posee curso preescolar)',
                      'descripcion'=>'matrícula de JM Y JI',
                      'c_tipo_cuadro'=>1,
                      'c_criterio_completitud'=>1 , // tiene que TENER DATOS
                      'ancho'=>800,
                      'filas'=>4,
                      'columnas'=>16]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,16]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'CICLO JARDÍN MATERNAL','colspan'=>6,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'CICLO JARDÍN DE INFANTES','colspan'=>6,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','rowspan'=>2,'colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,14]] ]);
      
      //fila 2

      $CN->def_cuadro_store(['valor_inicial'=>'Lactantes' , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Deambuladores', 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sala de 2 años', 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sala de 3 años'    , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sala de 4 años'    , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,10]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sala de 5 años'    , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,12]] ]);

      // fila 3
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>
                   [[3,2], [3,4],[3,6],[3,8],[3,10],[3,12],[3,14]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>
                   [[3,3], [3,5],[3,7],[3,9],[3,11],[3,13],[3,15]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>
                   [[3,16]] ]);
      //filas 4 

      $CN->def_cuadro_store(['valor_inicial'=>'Matrícula', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'],
                    ['celdas'=> [[4,1]] ]);


      
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>100] , ['region'=> [ [4,2 ,4,7]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>101] , ['region'=> [ [4,8 ,4,13]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>1100] , ['region'=> [ [4,14,4,16]] ]);
  //    $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'total_calculado','c_mapa'=>1122] , ['region'=> [ [4,12,11,14]] ]);

      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 100, [100],'inicial cuadro 4') ;
      $CN->mapacuadro_store_c_mapa ( 101, [101],'inicial cuadro 4') ;
      $CN->mapacuadro_store_c_mapa (1100, [100,101],'inicial cuadro 4') ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'especial-cuadro 4, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [14] ] ,
              'cmp2' => ['col' => [2,4,6,8,10,12] ] ,
              'cmp3' => '',
              'msg1' => 'El total de varones ',
              'msg2' => 'es distinto de suma de varones ',
              'msg3' => '',    
              'descripcion' => 'especial -cuadro 4, Total x fila <> suma de varones'
            ] );

    $CN->consistencia_save(
            [
              'numero' => 3,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [15] ] ,
              'cmp2' => ['col' => [3,5,7,9,11,13] ] ,
              'cmp3' => '',
              'msg1' => 'El total de mujeres ',
              'msg2' => 'es distinto de suma de mujeres ',
              'msg3' => '',    
              'descripcion' => 'especial -cuadro 4, Total x fila <> suma de mujeres'
            ] ); 
    $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [16] ] ,
              'cmp2' => ['col' => [14,15] ] ,
              'cmp3' => '',
              'msg1' => 'El total ',
              'msg2' => 'es distinto de suma de total varón + total mujer',
              'msg3' => '',    
              'descripcion' => 'especial -cuadro 4, Total x fila <> suma de varón + mujer'
            ] ); 

    $CN->consistencia_save( 
            [
              'numero' => 5,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [5,8,9,10] ] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 2, control de cuadros dependientes'
            ] ); 


    $CN->consistencia_cantidad_x_cuadro(5); // por si hay que eliminar consistencias viejas


//
//    // cuadro 5, PRIMARIA - CANTIDAD DE SECCIONES POR EDAD DE LA SALA SEGÚN CICLO
//

      $ncuadro=5;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'NIVEL INICIAL - CANTIDAD DE SECCIONES POR EDAD DE LA SALA SEGÚN CICLO',
              'descripcion'=>'matrícula de JM Y JI',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // tiene que TENER DATOS
              'ancho'=>800,
              'filas'=>3,
              'columnas'=>10
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,3,10]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'CICLO JARDÍN MATERNAL','colspan'=>4,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'CICLO JARDÍN DE INFANTES','colspan'=>4,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','rowspan'=>2,'colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,10]] ]);
      
      //fila 2

      $CN->def_cuadro_store(['valor_inicial'=>'Lactantes'               , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Deambuladores'              , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sala de 2 años'              , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Múltiple C. J. Maternal'    , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,5]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sala de 3 años'                  , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sala de 4 años'                  , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,7]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sala de 5 años'                  , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Múltiple C. J. Infantes / Multi-ciclo' , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,9]] ]);

      // fila 3
     
      $CN->def_cuadro_store(['valor_inicial'=>'Secciones', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);

      
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>100] , ['region'=> [ [3,2 ,3,5]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>101] , ['region'=> [ [3,6 ,3,9]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>1100] , ['celdas'=> [ [3,10]] ]);

      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 100, [100],'I2024 - inicial cuadro 5') ;
      $CN->mapacuadro_store_c_mapa ( 101, [101],'I2024 - inicial cuadro 5') ;
      $CN->mapacuadro_store_c_mapa (1100, [100,101],'I2024 - inicial cuadro 5') ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 4, ingresar datos no 0 or on'
            ] );
      
      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [10] ] ,
              'cmp2' => ['col' => [2,3,4,5,6,7,8,9] ] ,
              'cmp3' => '',
              'msg1' => 'El total ',
              'msg2' => 'es distinto de suma de secciones por ciclo y año',
              'msg3' => '',    
              'descripcion' => 'primaria -cuadro 4, Total x fila <> suma de secciones'
            ] ); 

    $CN->consistencia_save(
            [
              'numero' => 3,
              'c_tipo_consistencia' => 22, //Comparaciones de cuadross alumnos y secciones
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'alu' =>[ 
                                    [[[4,0,2],[4,0,3]], //alumnos 0 a 1 año V+M  Ciclo MATERNAL
                                    [[4,0,4],[4,0,5]], //alumnos 1 a 2 años V+M  Ciclo MATERNAL
                                    [[4,0,6],[4,0,7]] ], //alumnos 2 a 3 años V+M  Ciclo MATERNAL

                                    [[[4,0,8],[4,0,9]],    //alumnos 3 años V+M  Ciclo INFANTES
                                    [[4,0,10],[4,0,11]],   //alumnos 4 años V+M  Ciclo INFANTES
                                    [[4,0,12],[4,0,13]] ], //alumnos 5 años V+M  Ciclo INFANTES
                                ]
                        ],
              'cmp2' => [ 'sei' =>[ 
                                    [[[5,3,2]],   //secciones independientes 0 a 1 años Ciclo MATERNAL
                                      [[5,3,3]],   //secciones independientes 1 a 2 años Ciclo MATERNAL
                                      [[5,3,4]] ], //secciones independientes 2 a 3 años Ciclo MATERNAL

                                    [[[5,3,6]],   //secciones independientes 0 a 1 años Ciclo INFANTES
                                      [[5,3,7]],   //secciones independientes 1 a 2 años Ciclo INFANTES
                                      [[5,3,8]] ], //secciones independientes 2 a 3 años Ciclo INFANTES

                                  ],
                          'sea' => [  [[5,3,5]], [[5,3,9]]  ], // secciones agrupadas del nivel
                          'sa2' => [  [[5,3,9]], []  ] // secciones agrupadas alternativas del nivel 
                        ] ,
              
              'cmp3' => [ 'des' =>  [                                      
                                        ['Lactantes Ciclo J. MATERNAL', 
                                        'Deambuladores Ciclo J. MATERNAL',
                                        'Sala de 2 años Ciclo J. MATERNAL'
                                        ],

                                        ['Sala de 3 años Ciclo J. INFANTES',
                                        'Sala de 4 años Ciclo J. INFANTES',
                                        'Sala de 5 años Ciclo J. INFANTES' 
                                        ],                                       
                                      ]
                        ],  // titulos de comprobacion alumnos

              'msg1' => 'Los alumnos del ',
              'msg2' => 'informados, no se corresponden con las secciones declaradas',
              'msg3' => '',    
              'descripcion' => 'comparacion de alumnos varon + mujer con secciones independientes y/ agrupadas'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 23, // relacion alumnos por seccion
              'c_categoria_consistencia' =>  2, // Consistencia de advertencia
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'num' =>[ 
                                    [[4,0,2],[4,0,3],[4,0,4],[4,0,5],[4,0,6],[4,0,7]], //alumnos 0 a 1,  1 a 2, 2 a 3 año V+M  Ciclo MATERNAL
                                    [[4,0,8],[4,0,9],[4,0,10],[4,0,11],[4,0,12],[4,0,13]] //alumnos 0 a 1,  1 a 2, 2 a 3 año V+M  Ciclo INFANTES
                                  ],

                          'div' =>[ [[5,3,2],[5,3,3],[5,3,4],[5,3,5]], //secciones 1,2,3, AG ° año, Ciclo MATERNAL
                                    [[5,3,6],[5,3,7],[5,3,8],[5,3,9]] //secciones 1,2,3, AG ° año, Ciclo INFANTES
                                  ]
                        ],
              'cmp2' => [ 'min' =>[ 3,  // MATERNAL
                                    15 // INFANTES                                      
                                  ],
                          'max' =>[ 20, //MATERNAL
                                    38 //INFANTES                                      
                                  ]
                        ] ,
              
              'cmp3' => [ 'des' =>  ['Ciclo Jardín Maternal',
                                      'Ciclo Jardín de Infantes'                                       
                                    ] 
                        ],  
              'msg1' => 'La relación de alumnos por división/grupo de ',
              'msg2' => ' no es la esperada para los valores habituales, ',
              'msg3' => 'alumnos por división/grupo, verifique la cantidad de alumnos y división/grupo cargadas, si es correcto ignore esta advertencia',
              'descripcion' => 'advertencia de alumnos x seccion fuera de rango'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 5,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [4,8] ] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 2, control de cuadros dependientes'
            ] );  

      $CN->consistencia_save( 
            [
              'numero' => 6,
              'c_tipo_consistencia' => 27, // ctrol de secciones multiples y mas de 1 años con alumnos
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'niv' =>[ 
                                    [ [[4,0,2],[4,0,3]],[[4,0,4],[4,0,5]],[[4,0,6],[4,0,7]] ], // Ciclo MATERNAL
                                    [ [[4,0,2],[4,0,3]],[[4,0,4],[4,0,5]],[[4,0,6],[4,0,7]],
                                      [[4,0,8],[4,0,9]],[[4,0,10],[4,0,11]],[[4,0,12],[4,0,13]] ] // Ciclo maternal+INFANTES
                                  ],
                        ],
              'cmp2' => [ 'sea' =>[
                                    [[5,3,5]], // secciones AG ° año, Ciclo MATERNAL
                                    [[5,3,9]], // secciones AG ° año, Ciclo INFANTES / multi-ciclo
                                  ],
                        ],
              'cmp3' => [ 'msg_niv' =>[
                                        'ciclo maternal', // secciones AG ° año, Ciclo MATERNAL
                                        'ciclo jardin de infantes / multi-ciclo', // secciones AG ° año, Ciclo INFANTES
                                      ],
                        ],
              'msg1' => 'Si declara ',
              'msg2' => 'sección/es múltiple/s de',
              'msg3' => 'debe declarar alumnos en más de una edad/año en cuadro:',    
              'descripcion' => 'primaria -cuadro 5, control  secciones multiples y mas de 1 años con alumnos'
            ] );  

      $CN->consistencia_cantidad_x_cuadro(6); // por si hay que eliminar consistencias viejas



//
// //       // cuadro 6 PRIMARIA, NIVEL SECUNDARIO - ALUMNOS DE EDUCACIÓN SECUNDARIA BASICA POR AÑO Y SEXO (R.302/12)
//


      $ncuadro=6;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'NIVEL SECUNDARIO - CANTIDAD DE ALUMNOS DE EDUCACIÓN SECUNDARIA BASICA POR AÑO Y SEXO (R.302/12). (Si su establecimiento aún conserva Nivel Secundario)',
              'descripcion'=>'matrícula de PP Y PA',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // tiene que TENER DATOS
              'ancho'=>800,
              'filas'=>3,
              'columnas'=>10
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,3,10]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>''  ,'rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'1º','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2º','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3º','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);      
      $CN->def_cuadro_store(['valor_inicial'=>'Total Ciclo Básico','colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);


      // fila 2

      $CN->def_cuadro_store(['valor_inicial'=>'Varón','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,2],[2,4],[2,6],[2,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,3],[2,5],[2,7],[2,9]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,10]] ]);

      // fila 3

      $CN->def_cuadro_store(['valor_inicial'=>'Matrícula ESB','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110], ['region'=> [ [3,2 ,3,10]] ]);

      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 110, [110],'I2024 - primaria cuadro 6') ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 6, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [8] ] ,
              'cmp2' => ['col' => [2,4,6] ] ,
              'cmp3' => '',
              'msg1' => 'El total de varones ',
              'msg2' => 'es distinto de suma de varones ',
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 6, Total x fila <> suma de varones'
            ] );

    $CN->consistencia_save(
            [
              'numero' => 3,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [9] ] ,
              'cmp2' => ['col' => [3,5,7] ] ,
              'cmp3' => '',
              'msg1' => 'El total de mujeres ',
              'msg2' => 'es distinto de suma de mujeres ',
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 2, Total x fila <> suma de mujeres'
            ] ); 
    $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [10] ] ,
              'cmp2' => ['col' => [8,9] ] ,
              'cmp3' => '',
              'msg1' => 'El total ',
              'msg2' => 'es distinto de suma de total varón + total mujer',
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 2, Total x fila <> suma de varón + mujer'
            ] ); 

    $CN->consistencia_save( 
            [
              'numero' => 5,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [7,8,9,10] ] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 6, control de cuadros dependientes'
            ] ); 

    $CN->consistencia_cantidad_x_cuadro(5); // por si hay que eliminar consistencias viejas



//
//    // cuadro 7 PRIMARIA, NIVEL SECUNDARIO - CANTIDAD DE SECCIONES POR AÑO
//

      $ncuadro=7;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'NIVEL SECUNDARIO - CANTIDAD DE SECCIONES POR AÑO',
              'descripcion'=>'SECCIONES DE SECUNDARIA',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // tiene que TENER DATOS
              'ancho'=>700,
              'filas'=>2,
              'columnas'=>6
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,2,6]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>''   , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'1°' , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2°' , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3°' , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Pluriaño' , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,5]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total' , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);

      // fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. Secundaria ESB', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [2,2 ,2,6]] ]);

      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 110, [110],'I2024 - primaria cuadro 7') ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar secciones',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 7, ingresar datos no 0 or on'
            ] );
      
      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [6] ] ,
              'cmp2' => ['col' => [2,3,4,5] ] ,
              'cmp3' => '',
              'msg1' => 'El total ',
              'msg2' => 'es distinto de suma de secciones por año',
              'msg3' => '',    
              'descripcion' => 'primaria -cuadro 7, Total x fila <> suma de secciones'
            ] ); 

      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 22, //Comparaciones de cuadross alumnos y secciones
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'alu' =>[ 
                                    [ [[6,0,2],[6,0,3]],  //alumnos 1  año V+M  Ciclo Básico
                                      [[6,0,4],[6,0,5]],  //alumnos 2  años V+M  Ciclo Básico
                                      [[6,0,6],[6,0,7]],  //alumnos 3  años V+M  Ciclo Básico
                                    ]
                                  ]
                        ],
              'cmp2' => [ 'sei' =>[ 
                                    [ [[7,2,2]],   //secciones independientes 1 año
                                      [[7,2,3]],   //secciones independientes 2 año
                                      [[7,2,4]],   //secciones independientes 3 año
                                    ]
                                  ],
                          'sea' => [  [[7,2,5]] ], // secciones agrupadas del nivel
                          'sa2' => [  [] ] // secciones agrupadas alternativas del nivel 
                        ] ,
              
              'cmp3' => [ 'des' =>  [                                      
                                        [ '1° año', 
                                          '2° año',
                                          '3° año',
                                        ],                                       
                                      ]
                        ],  // titulos de comprobacion alumnos

              'msg1' => 'Los alumnos del ',
              'msg2' => 'informados, no se corresponden con las secciones declaradas',
              'msg3' => '',    
              'descripcion' => 'comparacion de alumnos varon + mujer con secciones independientes y/ agrupadas'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 23, // relacion alumnos por seccion
              'c_categoria_consistencia' =>  2, // Consistencia de advertencia
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'num' =>[ 
                                    [[6,0,10]] //total de alumnos de ciclo básico 
                                  ],

                          'div' =>[ [[7,2,6]] , //secciones 1 a 3 y AG ° año, de secundaria
                                  ]
                        ],
              'cmp2' => [ 'min' =>[ 15,  // min secundaria
                                  ],
                          'max' =>[ 42,  // max secundaria
                                  ]
                        ] ,
              
              'cmp3' => [ 'des' =>  ['Ed. Secundaria'
                                    ] 
                        ],  
              'msg1' => 'La relación de alumnos por división de ',
              'msg2' => 'excede los valores habituales, ',
              'msg3' => 'verifique la cantidad de alumnos y secciones ingresada',    
              'descripcion' => 'advertencia de alumnos x seccion fuera de rango'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 5,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [6,8] ] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 7, control de cuadros dependientes'
            ] );  

      $CN->consistencia_save( 
            [
              'numero' => 6,
              'c_tipo_consistencia' => 27, // ctrol de secciones multiples y mas de 1 años con alumnos
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'niv' =>[ 
                                    [ [[6,0,2],[6,0,3]],  //alumnos 1  año V+M  Ciclo Básico
                                      [[6,0,4],[6,0,5]],  //alumnos 2  años V+M  Ciclo Básico
                                      [[6,0,6],[6,0,7]],  //alumnos 3  años V+M  Ciclo Básico

              //                        [[7,0,2],[7,0,3]],   //alumnos 4 años V+M  Ciclo Superior
              //                        [[7,0,4],[7,0,5]],   //alumnos 5 años V+M  Ciclo Superior
              //                        [[7,0,6],[7,0,7]],   //alumnos 6 años V+M  Ciclo Superior
                                    ],  //alumnos x año de niv secundario
                                  ],
                        ],
              'cmp2' => [ 'sea' =>[
                                    [[7,2,5]], // secciones AG ° año,  niv secundario
                                  ],
                        ],
              'cmp3' => [ 'msg_niv' =>[
                                        'nivel secundario', // secundaria
                                      ],
                        ],
              'msg1' => 'Si declara ',
              'msg2' => 'sección/es pluriaño de',
              'msg3' => 'debe declarar alumnos en más de un año en cuadro:',    
              'descripcion' => 'primaria -cuadro 7, ctrol secciones multiples y mas de 1 años con alumnos'
            ] );  


      $CN->consistencia_cantidad_x_cuadro(6); // por si hay que eliminar consistencias viejas


//
//       // cuadro 8 PRIMARIA, ALUMNOS Y SECCIONES SEGÚN REGIMEN DE TURNOS
//

      $ncuadro=8;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'ALUMNOS Y SECCIONES SEGÚN REGIMEN DE TURNOS',
              'descripcion'=>'ALUMNOS Y SECCIONES SEGÚN REGIMEN DE TURNOS',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // obligatorio DATOS                                              
              'ancho'=>500,
              'filas'=>10,
              'columnas'=>9
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,10,9]] ]);

      // TITULOS DE FILAS
      //fila 1

      $CN->def_cuadro_store(['valor_inicial'=>'TURNOS','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. Primaria', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Inicial Ciclo Maternal', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Inicial Ciclo Jardín de Inf.', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ciclo Básico y Sup. de Ed. Sec. Orientada', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);
      
      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Alumnos',  'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,2],[2,4],[2,6],[2,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Secciones','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,3],[2,5],[2,7],[2,9]] ]);

      //filas 3 y 10
      $CN->def_cuadro_store(['valor_inicial'=>'Mañana', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Intermedio', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Tarde', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Vespertino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Noche', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[7,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Doble esc.', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[8,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Alternado', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[9,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[10,1]] ]);

        
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>102] , ['region'=> [ [3,2,10,3]] ]);  
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>100] , ['region'=> [ [3,4,10,5]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>101] , ['region'=> [ [3,6,10,7]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [3,8,10,9]] ]);


      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 102, [102],'I2024 - primaria cuadro 8 PP' ) ;
      $CN->mapacuadro_store_c_mapa ( 100, [100],'I2024 - primaria 8 j. mat.') ;
      $CN->mapacuadro_store_c_mapa ( 101, [101],'I2024 - primaria 8 j. inf.') ;
      $CN->mapacuadro_store_c_mapa ( 110, [110],'I2024 - primaria 8 secu') ;


      // DEFINIR CONSISTENCIAS


      $CN->consistencia_save( 
            [
              'numero' =>  1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'especial-cuadro 8, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' =>  2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1 , // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => 'Alumnos - Ed. Primaria ',
                                      '3' => 'Secciones - Ed. Primaria ',
                                      '4' => 'Alumnos - Ciclo Maternal ',
                                      '5' => 'Secciones - Ciclo Maternal ',
                                      '6' => 'Alumnos - Ciclo Jardín de Inf. ',
                                      '7' => 'Secciones - Ciclo Jardín de Inf. ',
                                      '8' => 'Alumnos - Ed. Sec. ',
                                      '9' => 'Secciones - Ed. Sec. ',
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 8, Suma de columna xxx <> Total'
            ] );                      

      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 25, // consistencia de comparacion menor val1, val1_1,val1_2 < val2
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
                        // celdas a comparar del cuadro
              'cmp1' => ['v1'=> [ [[[ 10,2]] ], // primaria alumnos
                                  [[[ 10,3]] ], // primaria secciones
                                  [[[ 10,4]] ], // maternal alumnos
                                  [[[ 10,5]] ], // maternal alumnos
                                  [[[ 10,6]] ], // infantes alumnos
                                  [[[ 10,7]] ], // infantes alumnos
                                  [[[ 10,8]] ], // secundar.alumnos
                                  [[[ 10,9]] ] // secundar.secciones
                                  
                                ]
                        ], 
              'cmp2' => ['v2'=>[   // celdas de otros cuadros a sumar para la comparación
                                  ['cel'=>[[2,0,16 ]]],  // primaria alumnos
                                  ['cel'=>[[3,0,9  ]]],  // primaria secciones
                                  ['reg'=>[[4,0,2,0,7 ]]],  // MATERNAL alumnos
                                  ['reg'=>[[5,0,2,0,5 ]]],  // MATERNAL secc.  
                                  ['reg'=>[[4,0,8,0,13]]],  // jardin   alumnos
                                  ['reg'=>[[5,0,6,0,9 ]]],  // jardin   secciones
                                  ['cel'=>[[6,0,10]]],  // ed. secundaria alum
                                  ['cel'=>[[7,0,6  ]]] , // ed. secundaria sec.

                                ],
                          'sig'=>'!=',
                        ],
              'cmp3' => ['d1'=> [ [ 'El Total de alumnos de Ed. Primaria'],
                                  [ 'El Total de secciones de Ed. Primaria'],
                                  [ 'El Total de alumnos de Ciclo Maternal'],
                                  [ 'El Total de secciones de Ciclo Maternal'],
                                  [ 'El Total de alumnos de C. Jardin de Infantes'],
                                  [ 'El Total de secciones de C. Jardin de Infantes'],
                                  [ 'El Total de alumnos de Ed. Sec.'],
                                  [ 'El Total de secciones de Ed. Sec.'],                                 
                                ],                              
                        'd2'=> [ ['2'],
                                  ['3'],
                                  ['4'],
                                  ['5'],
                                  ['4'],
                                  ['5'],
                                  ['6'],
                                  ['7'],
                                ]
                        ],
              'msg1' => '',
              'msg2' => 'son distintos de lo informados en cuadro ',
              'msg3' => '',    
              'descripcion' => 'primaria -cuadro 8, comparacion de alumnos y secciones diferentes'
            ] );

      $CN->consistencia_save( 
            [
              'numero' =>  4,
              'c_tipo_consistencia' => 24, //consistencia para verificar la carga de alumnos y secciones para CUADROS DE CANTIDAD DE ALUMNOS Y SECCIONES POR TURNO
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1 , // Consistencia activa
              'cmp1' => [[2,3],[4,5],[6,7],[8,9] ] , // parejas de columnas de alumnos y secciones a comparar
              'cmp2' => [null,7,null,null], //colmnas de celda alternativa para secciones agrupadas multinivel
              'cmp3' => ['msg' => ['Ed. Primaria','Ciclo J. Maternal', 'Ciclo J. Infantes','Ed. Sec.'],
                        ],
              'msg1' => '', // 
              'msg2' => '', //
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 8, CANTIDAD DE ALUMNOS Y SECCIONES POR TURNO'
            ] );                      


      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas



//
//       // cuadro 9 PRIMARIA, ALUMNOS SEGÚN TIPO DE JORNADA:
//

      $ncuadro=9;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'ALUMNOS SEGÚN TIPO DE JORNADA:',
              'descripcion'=>'ALUMNOS SEGÚN TIPO DE JORNADA:',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // obligatorio DATOS                                              
              'ancho'=>500,
              'filas'=>8,
              'columnas'=>5 
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,8,5]] ]);

      // TITULOS DE FILAS

      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Tipo de Jornada','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. Primaria', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Inicial Ciclo Maternal', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Inicial Ciclo Jardín Infantes', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ciclo Básico y Sup. de Ed. Sec. Orientada', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,5]] ]);
      
      //filas 2 a 8
      $CN->def_cuadro_store(['valor_inicial'=>'Jornada Simple (hasta 20 hs, semanales)'        , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Jornada Extendida (entre 21 y 24 hs, semanales)', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Jornada Extendida (entre 25 y 29 hs, semanales)', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Jornada Extendida (entre 30 y 34 hs, semanales)', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Jornada Extendida (entre 35 y 39 hs, semanales)', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Jornada Completa/Doble (40 hs, semanales)'      , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[7,1]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[8,1]] ]);

        
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>102] , ['region'=> [ [2,2,8,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>100] , ['region'=> [ [2,3,8,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>101] , ['region'=> [ [2,4,8,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [2,5,8,5]] ]);


       //celdas sombreadas
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] , ['region'=> [ [6,2,6,5] ] ]);


      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO

      $CN->mapacuadro_store_c_mapa ( 102, [102],'I2024 - primaria cuadro 9') ;
      $CN->mapacuadro_store_c_mapa ( 100, [100],'I2024 - primaria cuadro 9') ;
      $CN->mapacuadro_store_c_mapa ( 101, [101],'I2024 - primaria cuadro 9') ;
      $CN->mapacuadro_store_c_mapa ( 110, [110],'I2024 - primaria cuadro 9') ;


      // DEFINIR CONSISTENCIAS


      $CN->consistencia_save( 
            [
              'numero' =>  1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'primaria 9, ingresar datos no 0 or on'
            ] );


      $CN->consistencia_save( 
            [
              'numero' =>  2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1 , // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => 'Ed. Primaria ',
                                      '3' => 'Jardín Maternal ',
                                      '4' => 'Jardín Infantes ',
                                      '5' => 'Ed. Secundaria ',
                                  ]
                        ],
              'msg1' => 'La suma de alumnos en la columna de ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'primaria -cuadro 9 Suma de columna xxx <> Total'
            ] );                      

      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 25, // consistencia de comparacion menor val1, val1_1,val1_2 < val2
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
                        // celdas a comparar del cuadro
              'cmp1' => ['v1'=> [ [[[ 8,2]] ], // Ed. Primaria 
                                  [[[ 8,3]] ], // alumnos maternal
                                  [[[ 8,4]] ], // alumnos jardin
                                  [[[ 8,5]] ], // alumnos ed. secundaria
                                  
                                ]
                        ], 
              'cmp2' => ['v2'=>[   // celdas de otros cuadros a sumar para la comparación
                                  ['cel'=>[[2,0,16 ]]],  //primaria
                                  ['reg'=>[[4,0,2,0,7 ]]],  //maternal
                                  ['reg'=>[[4,0,8,0,13]]],  //INFANTES
                                  ['cel'=>[[6,0,10]]]  //secundaria
                                ],
                          'sig'=>'!=',
                        ],
              'cmp3' => ['d1'=> [ ['Ed. Primaria'],
                                  ['Jardín Maternal '],
                                  ['Jardín Infantes '],
                                  ['Ed. Secundaria ']
                                ],                              
                        'd2'=> [ ['2'],
                                  ['4'],
                                  ['4'],
                                  ['6'],
                                ]
                        ],
              'msg1' => 'Los alumnos de ',
              'msg2' => 'son distintos de los informados en cuadro ',
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 9, comparacion de alumnos diferentes'
            ] );

        $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas




//
//       // cuadro 10 PRIMARIA, ALUMNOS SEGÚN SEXO NO BINARIO:
//

      $ncuadro=10;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'ALUMNOS SEGÚN SEXO NO BINARIO:',
              'descripcion'=>'ALUMNOS SEGÚN SEXO NO BINARIO:',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // obligatorio DATOS                                              
              'indicaciones'=>'Nota: En concordancia con decreto DCTO-2021-476-APN-PTE.',
              'ancho'=>300,
              'filas'=>5,
              'columnas'=>5 
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,5,5]] ]);

      // TITULOS DE FILAS

      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Sexo','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. Primaria', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Inicial Ciclo Maternal', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Inicial Ciclo Jardín Infantes', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ciclo Básico y Sup. de Ed. Sec. Orientada', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,5]] ]);

      //filas 2 a 5
      $CN->def_cuadro_store(['valor_inicial'=>'Masculino'     , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Femenino'      , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'X (no binario)', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);

        
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>102] , ['region'=> [ [2,2,5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>100] , ['region'=> [ [2,3,5,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>101] , ['region'=> [ [2,4,5,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [2,5,5,5]] ]);


      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO

      $CN->mapacuadro_store_c_mapa ( 102, [102],'I2024 - primaria cuadro 10') ;
      $CN->mapacuadro_store_c_mapa ( 100, [100],'I2024 - primaria cuadro 10') ;
      $CN->mapacuadro_store_c_mapa ( 101, [101],'I2024 - primaria cuadro 10') ;
      $CN->mapacuadro_store_c_mapa ( 110, [110],'I2024 - primaria cuadro 10') ;


      // DEFINIR CONSISTENCIAS


      $CN->consistencia_save( 
            [
              'numero' =>  1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'primaria 10, ingresar datos no 0 or on'
            ] );


      $CN->consistencia_save( 
            [
              'numero' =>  2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1 , // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => 'Ed. Primaria ',
                                      '3' => 'Jardín Maternal ',
                                      '4' => 'Jardín Infantes ',
                                      '5' => 'Ed. Secundaria ',
                                  ]
                        ],
              'msg1' => 'La suma de alumnos en la columna de ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'primaria -cuadro 10 Suma de columna xxx <> Total'
            ] );                      

      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 25, // consistencia de comparacion menor val1, val1_1,val1_2 < val2
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
                        // celdas a comparar del cuadro
              'cmp1' => ['v1'=> [ [[[ 5,2]] ], // Ed. Primaria 
                                  [[[ 5,3]] ], // alumnos maternal
                                  [[[ 5,4]] ], // alumnos jardin
                                  [[[ 5,5]] ], // alumnos ed. secundaria
                                  
                                ]
                        ], 
              'cmp2' => ['v2'=>[   // celdas de otros cuadros a sumar para la comparación
                                  ['cel'=>[[2,0,16 ]]],  //primaria
                                  ['reg'=>[[4,0,2,0,7 ]]],  //maternal
                                  ['reg'=>[[4,0,8,0,13]]],  //INFANTES
                                  ['cel'=>[[6,0,10]]]  //secundaria
                                ],
                          'sig'=>'!=',
                        ],
              'cmp3' => ['d1'=> [ ['Ed. Primaria'],
                                  ['Jardín Maternal '],
                                  ['Jardín Infantes '],
                                  ['Ed. Secundaria ']
                                ],                              
                        'd2'=> [ ['2'],
                                  ['4'],
                                  ['4'],
                                  ['6'],
                                ]
                        ],
              'msg1' => 'Los alumnos de ',
              'msg2' => 'son distintos de los informados en cuadro ',
              'msg3' => '',    
              'descripcion' => 'primaria-cuadro 10, comparacion de alumnos diferentes'
            ] );

      $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas


// ATENCION!!!
// CUADRO anulado en momento Final, cuando se active; incorporar el cuadro 11 en la consistencia "cuadros dependientes" del cuadro 2 (matricula por año)   CONSITENCIA (c_tipo_consistencia => 11 )        
//

// //       // cuadro 11 PRIMARIA, CANTIDAD DE ALUMNOS EN 1° AÑO SEGÚN SU ASISTENCIA A JARDÍN
//

      $ncuadro=11;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                      'nombre'=>'CANTIDAD DE ALUMNOS EN 1° AÑO SEGÚN SU ASISTENCIA A JARDÍN',
                      'descripcion'=>'matrícula de 1° AÑO SEGÚN SU ASISTENCIA A JARDÍN',
                      'c_tipo_cuadro'=>1,
                      'c_criterio_completitud'=>1 , // tiene que TENER DATOS
                      'ancho'=>500,
                      'filas'=>5,
                      'columnas'=>4]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,5,4]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Asistencia a sala de 5 años'  ,'rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Cantidad de Alumnos en 1° año','colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);



      // fila 2

      $CN->def_cuadro_store(['valor_inicial'=>'Varón','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,4]] ]);

      // fila 3

      $CN->def_cuadro_store(['valor_inicial'=>'Asistieron','titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'No Asistieron','titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>102], ['region'=> [ [3,2 ,5,4]] ]);
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,4 ,5,4]] ]);


      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 102, [102],'I2024 - primaria cuadro 11') ;


      // DEFINIR CONSISTENCIAS


      $CN->consistencia_save( [
            'numero' =>  1,
            'c_tipo_consistencia' => 16, //totales de columna
            'c_categoria_consistencia' =>  3, // Consistencia de Error
            'c_estado' =>  1 , // Consistencia activa
            'cmp1' => [] ,
            'cmp2' => [] ,
            'cmp3' => ['tit' => [   '2' => 'varones',
                                    '3' => 'mujeres',
                                    '4' => 'total',
                                ]
                      ],
            'msg1' => 'La suma de ', //  'Total de las modalidades',
            'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
            'msg3' => '',    
            'descripcion' => 'primaria -cuadro 11 Suma de columna xxx <> Total'
            ] );                    

      $CN->consistencia_save( [
                'numero' => 2,
                'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => ['col' => [4] ],
                'cmp2' => ['scol' => [[2,3] ]] ,
                'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
                'descripcion' => 'primaria-cuadro 11, Total   x fila <> suma'
                ] );

      $CN->consistencia_save( [
                'numero' => 3,
                'c_tipo_consistencia' => 25, // consistencia de comparacion menor val1, val1_1,val1_2 < val2
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                          // celdas a comparar del cuadro
                'cmp1' => ['v1'=> [ [[[ 5,2]] ], // varon 
                                    [[[ 5,3]] ], // mujer
                                  ]
                          ], 
                'cmp2' => ['v2'=>[   // celdas de otros cuadros a sumar para la comparación
                                    ['cel'=>[[2,0,2 ]]],  // primaria alumnos 1° varon
                                    ['cel'=>[[2,0,3 ]]],  // primaria alumnos 1° mujer

                                  ],
                            'sig'=>'!=',
                          ],
                'cmp3' => ['d1'=> [ [ 'El total de alumnos varones de 1° año'],
                                    [ 'El total de alumnas mujeres de 1° año'],
                                  ],                              
                           'd2'=> [ ['2'],
                                    ['2'],
                                  ]
                          ],
                'msg1' => '',
                'msg2' => 'es distintos de lo informados en cuadro ',
                'msg3' => '',    
                'descripcion' => 'primaria -cuadro 11, comparacion de alumnos 1° año diferentes'
                ] );


      $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas



//
// //       // cuadro 12 PRIMARIA, EQUIPO DE ORIENTACION ESCOLAR
//


      $ncuadro=12;
      $F->def_formulario_add_cuadro ( ['numero'=>$ncuadro,
                      'nombre'=>'EQUIPO DE ORIENTACION ESCOLAR',
                      'descripcion'=>'E.O.E',
                      'c_tipo_cuadro'=>4,
                      'c_criterio_completitud'=>2 , // puede no TENER DATOS
                      'ancho'=>300,
                      'filas'=>6,
                      'columnas'=>2]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,6,2]] ]);

      // TITULOS DE FILAS
      // fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'EQUIPO DE ORIENTACION ESCOLAR'  ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      // fila 2 a 6
      $CN->def_cuadro_store(['valor_inicial'=>'No posee equipo','titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'EOE - (incluido en POF de su escuela)','titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'ED - Equipo de Distrito','titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Extensión de EOE - (POF de otra escuela)','titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Escuela','titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);



      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'], ['region'=> [ [2,2 ,5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'textarea'], ['celdas'=> [ [6,2]] ]);

      $CN->def_cuadro_save() ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( [
                'numero' => 1,
                'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => '',
                'msg1' => 'Debe consignar una opción',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'primaria-cuadro 12, ingresar datos no 0 or on'
                ] );

      $CN->consistencia_save( [
                'numero' => 2,
                'c_tipo_consistencia' => 18, // consistencia de validacion de checkbox
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa                          
                'cmp1' => ['chk'=> [ [[2,2],[3,2],[4,2],[5,2]] ], // conjunto de celdas chk, a validar (1 sola puede ser tildada x vez)
                          ],
                'cmp2' => ['ckp' => [ [12,5,2] ],     // ckp (check padre) celdas que habilitan la carga/tilde de celdas hijos (chi)
                                                      // puede estar en otro cuadro   
                           'chi'=> [ [[6,2]] ] // chi (celdas hijos) celdas habilitadas x el tilde de ckp
                          ],
                'cmp3' => [ 'mch' => [ 'Solo una opción de EOE puede ser seleccionada'] , // mensaje para el grupo de celdas chk
                            'mc0' => [ 'Si Extensión de EOE no está seleccionada, no debe informar escuelas'], // mensaje si la celda padre NO esta chequeada 
                            'mc1' => [ 'Si Extensión de EOE está seleccionada, debe informar escuelas'], // mensaje si la celda padre esta chequeada 
                          ] ,
                'msg1' => '',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'primaria -cuadro 12, validacion de E.O.E'
                ] );

      $CN->consistencia_cantidad_x_cuadro(2); // por si hay que eliminar consistencias viejas


      $F->def_formulario_save();  


      //dd($F); 
      return ($F);

    }  // FORMULARIO DE PRIMARIA  









//////////////////////////////
///////////////////////////////
//////////////////////////////
///////////////////////////////
//////////////////////////////
///////////////////////////////













static public function I2024_SECUNDARIA($id_definicion_formulario)
    {

       
////////////////////////////       
//definir un nuevo formulario
//////////////////////////////
///////////////////////////////

      $F = new DefinicionFormularioController( $id_definicion_formulario);  // crear o cargar el formulario

      //$F->delete_consistencias();

      $F->nombre='MATRÍCULA INICIAL 2024 - EDUCACIÓN SECUNDARIA / POLIMODAL / MEDIA';
      $F->nombre_corto='ED. SECUNDARIA';
      $F->descripcion='Planilla Relevamiento Inicial 2024 de Ed. Secundaria';
      $F->id_periodo='106';
      $F->color='f_celeste';

      //asignar los tipo de organizacion del formulario
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'MA'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'MT'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'MS'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'MM'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'MF'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'MC'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'BS'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'AS'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'MB'] );
      //     Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'DS'] );
      //LOS CEBAS MB SE PASARON A DS JUNTO CON LOS CENS, pero se relevan en cuadr 6 de secundaria comun

//
// // cuadro 1 SECUNDARIA-> CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
//
      $ncuadro=1;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO',
              'descripcion'=>'encabezado sae',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>2 ,
              'ancho'=>465,
              'filas'=>6,
              'columnas'=>2 
            ]);
      $CN=$F->cuadros[$ncuadro];

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,6,2]] ]);

      // TITULOS DE FILAS
      $CN->def_cuadro_store(['valor_inicial'=>'SERVICIO', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'CANTIDAD', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);

      // TITULOS DE COLUMNAS
      $CN->def_cuadro_store(['valor_inicial'=>'Desayuno y Merienda Completa',  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Comedor',                       'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Simple',                 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Doble',                  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Completo',               'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[3,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[4,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[6,2]] ]);

      $CN->consistencia_cantidad_x_cuadro(0); // por si hay que eliminar consistencias viejas




//
// //       // cuadro 2 SECUNDARIA-> NIVEL SECUNDARIO - CANTIDAD DE ALUMNOS DE ED. SECUNDARIA - CICLO BÁSICO (R.302/12) POR AÑOY SEXO
//


      $ncuadro=2;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'NIVEL SECUNDARIO - CANTIDAD DE ALUMNOS DE ED. SECUNDARIA - CICLO BÁSICO (R.302/12) POR AÑOY SEXO',
              'descripcion'=>'matrícula de ED. SECUNDARIA - CICLO BÁSICO',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // debe TENER DATOS
              'ancho'=>1000,
              'filas'=>6,
              'columnas'=>12
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,6,12]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Modalidad'   ,'rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'1º'          ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2º'          ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3º'          ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Fortalecimiento' ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);  
      $CN->def_cuadro_store(['valor_inicial'=>'Total'       ,'colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,10]] ]);


      // fila 2

      $CN->def_cuadro_store(['valor_inicial'=>'Varón','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,2],[2,4],[2,6],[2,8],[2,10]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,3],[2,5],[2,7],[2,9],[2,11]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,12]] ]);

      // fila 3 a 14

      $CN->def_cuadro_store(['valor_inicial'=>'Ed. sec. orientada (R.3186/07)' ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. sec. técnica (R88/09)'      ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. sec. agropecuaria (R88/09)' ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total Ciclo Básico'             ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);


      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110], ['region'=> [ [3,2 ,6,9]] ]);
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,10 ,6,12]] ]);

      // SOMBREAR CELDAS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] ,  ['region'=> [ [5,8,5, 9] ] ]);



      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 110, [110],'I2024 - secundaria cuadro 2') ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  2, // Consistencia inactiva
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 2, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => '1° año / varón ',
                                      '3' => '1° año / mujer ',
                                      '4' => '2° año / varón ',
                                      '5' => '2° año / mujer ',
                                      '6' => '3° año / varón ',
                                      '7' => '3° año / mujer ',
                                      '8' => 'Aceleración / varón ',
                                      '9' => 'Aceleración / mujer ',
                                      '10' => 'Total / varón ',
                                      '11' => 'Total / mujer ',
                                      '12'=> 'Total / total '
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 2, Suma de columna xxx <> Total'
            ] );
                                        
      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [10,11,12] ],
              'cmp2' => ['scol' => [[2,4,6,8],[3,5,7,9],[10,11] ]] ,
              'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
              'descripcion' => 'secundaria cuadro 2, Total   x fila <> suma'
            ] );
      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [13,16,17,18,19] ] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 2, control de cuadros dependientes'
            ] ); 

      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas


//
// //       // cuadro 3 SECUNDARIA-> NIVEL SECUNDARIO - CANTIDAD DE ALUMNOS DE EDUCACION SECUNDARIA CICLO SUPERIOR EN ESCUELAS DE ESB, SEGÚN ORIENTACIÓN
//


      $ncuadro=3;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'NIVEL SECUNDARIO - CANTIDAD DE ALUMNOS DE EDUCACIÓN SECUNDARIA CICLO SUPERIOR ORIENTADO POR AÑO Y SEXO SEGÚN ORIENTACIÓN. R.302/12',
              'descripcion'=>'matrícula de ED. SECUNDARIA - CICLO SUPERIOR',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // debe TENER DATOS
              'ancho'=>1300,
              'filas'=>15,
              'columnas'=>10
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,15,10]] ]);

      // TITULOS DE FILAS

      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Orientaciones','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'4º','colspan'=>2   ,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'5º','colspan'=>2   ,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'6º','colspan'=>2   ,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);      
      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);

      // fila 2

      $CN->def_cuadro_store(['valor_inicial'=>'Varón'   ,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,2],[2,4],[2,6],[2,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer'   ,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,3],[2,5],[2,7],[2,9]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total'   ,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,10]] ]);

      // fila 3 a 15

      $CN->def_cuadro_store(['valor_inicial'=>'Bachiller en Ciencias Naturales'     ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachiller en Ciencias Sociales'      ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachiller en Comunicación'           ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachiller en Economía y Administración'  ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachiller en Educación Física'       ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[7,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachiller en Lenguas Extranjeras'    ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[8,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachiller en Turismo'                ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[9,1]] ]);  
      $CN->def_cuadro_store(['valor_inicial'=>'Bachiller en Arte - Visuales'        ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[10,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachiller en Arte - Danzas'          ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[11,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachiller en Arte - Literatura'      ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[12,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachiller en Arte - Música'          ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[13,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachiller en Arte - Teatro'          ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[14,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total Ciclo Superior'                ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[15,1]] ]);


      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110], ['region'=> [ [3,2 ,15,7]] ]);
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,8 ,15,10]] ]);


      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 110, [110],'I2024 - secundaria cuadro 3') ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  2, // Consistencia inactiva
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria-cuadro 3, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => '4° año / varón ',
                                      '3' => '4° año / mujer ',
                                      '4' => '5° año / varón ',
                                      '5' => '5° año / mujer ',
                                      '6' => '6° año / varón ',
                                      '7' => '6° año / mujer ',
                                      '8' => 'Total / varón ',
                                      '9' => 'Total / mujer ',
                                      '10'=> 'Total / total '
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'secundaria-cuadro 3, Suma de columna xxx <> Total'
            ] );
                                        
      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [8,9,10] ],
              'cmp2' => ['scol' => [[2,4,6],[3,5,7],[8,9] ]] ,
              'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
              'descripcion' => 'secundaria-cuadro 3, Total   x fila <> suma'
            ] );
      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [13,16,17,18,19] ] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria-cuadro 3, control de cuadros dependientes'
            ] ); 





//
// //       // cuadro 4 SECUNDARIA-> NIVEL SECUNDARIO - CANTIDAD DE ALUMNOS DE EDUCACIÓN SECUNDARIA ARTÍSTICA. POR AÑO Y SEXO SEGÚN LENGUAJE / DISCIPLINA. R.3066/15 y 169/16.
//


      $ncuadro=4;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'NIVEL SECUNDARIO - CANTIDAD DE ALUMNOS DE EDUCACIÓN SECUNDARIA ARTÍSTICA. POR AÑO Y SEXO SEGÚN LENGUAJE / DISCIPLINA. R.3066/15 y 169/16.',
              'descripcion'=>'matrícula de ED. EDUCACIÓN SECUNDARIA ARTÍSTICA',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // debe TENER DATOS
              'ancho'=>1400,
              'filas'=>12,
              'columnas'=>16
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,12,16]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Orientaciones','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],  ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'1º','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],             ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2º','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],             ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3º','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],             ['celdas'=> [[1,6]] ]);      
      $CN->def_cuadro_store(['valor_inicial'=>'4º','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],             ['celdas'=> [[1,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'5º','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],             ['celdas'=> [[1,10]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'6º','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],             ['celdas'=> [[1,12]] ]);      
      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],          ['celdas'=> [[1,14]] ]);


      // fila 2

      $CN->def_cuadro_store(['valor_inicial'=>'Varón','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],  ['celdas'=> [[2,2],[2,4],[2,6],[2,8],[2,10],[2,12],[2,14]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],  ['celdas'=> [[2,3],[2,5],[2,7],[2,9],[2,11],[2,13],[2,15]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],  ['celdas'=> [[2,16]] ]);

      // fila 3 a 14

      $CN->def_cuadro_store(['valor_inicial'=>'Bach. en artes visuales con esp. en producción: cerámica'       ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=>[[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bach. en artes visuales con esp. en producción: grabado'        ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=>[[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bach. en artes visuales con esp. en producción: pintura'        ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=>[[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bach. en artes visuales esp. en producción: escultura'          ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=>[[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bach. en danza con esp. en danza de origen escénico'            ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=>[[7,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bach. en danza con esp. en danza de origen folklórico y popular','titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=>[[8,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bach. en música con esp. en realización musical en vivo - instrumento'     ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=>[[9,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bach. en música con esp. en realización musical en vivo - música popular'  ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=>[[10,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bach. en teatro con esp. en teatro popular'                     ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=>[[11,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total Ed. Secundaria Artística'                                 ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=>[[12,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110], ['region'=> [ [3,2 ,12,13]] ]);
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,14 ,12,16]] ]);


      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 110, [110],'I2024 - secundaria cuadro 3') ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  2, // Consistencia inactiva
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria-cuadro 4, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => '1° año / varón ',
                                      '3' => '1° año / mujer ',
                                      '4' => '2° año / varón ',
                                      '5' => '2° año / mujer ',
                                      '6' => '3° año / varón ',
                                      '7' => '3° año / mujer ',
                                      '8' => '4° año / varón ',
                                      '9' => '4° año / mujer ',
                                      '10' => '5° año / varón ',
                                      '11' => '5° año / mujer ',
                                      '12' => '6° año / varón ',
                                      '13' => '6° año / mujer ',
                                      '14' => 'Total / varón ',
                                      '15' => 'Total / mujer ',
                                      '16'=> 'Total / total '
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'secundaria-cuadro 4, Suma de columna xxx <> Total'
            ] );
                                        
      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [14,15,16] ],
              'cmp2' => ['scol' => [[2,4,6,8,10,12],[3,5,7,9,11,13],[14,15] ]] ,
              'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
              'descripcion' => 'secundaria-cuadro 4, Total   x fila <> suma'
            ] );
      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [13,16,17,18,19] ] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria-cuadro 4, control de cuadros dependientes'
            ] ); 


        $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas







//
// //       // cuadro 5 SECUNDARIA-> CANTIDAD DE ALUMNOS DE EDUCACIÓN SECUNDARIA CICLO SUPERIOR TECNICO Y AGRARIO POR AÑO Y SEXO SEGÚN ORIENTACIÓN. R.302/12
//


      $ncuadro=5;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE ALUMNOS DE EDUCACIÓN SECUNDARIA CICLO SUPERIOR TECNICO Y AGRARIO POR AÑO Y SEXO SEGÚN ORIENTACIÓN. R.302/12.',
              'descripcion'=>'ALUMNOS SECUNDARIA CICLO SUPERIOR TECNICO Y AGRARIO',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // debe TENER DATOS
              'ancho'=>1100,
              'filas'=>25,
              'columnas'=>12
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,25,12]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Especialidad','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],  ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'4º'          ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],  ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'5º'          ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],  ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'6º'          ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],  ['celdas'=> [[1,6]] ]); 
      $CN->def_cuadro_store(['valor_inicial'=>'7º'          ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],  ['celdas'=> [[1,8]] ]);                                 
      $CN->def_cuadro_store(['valor_inicial'=>'Total'       ,'colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],  ['celdas'=> [[1,10]] ]);


      // fila 2

      $CN->def_cuadro_store(['valor_inicial'=>'Varón','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],  ['celdas'=> [[2,2],[2,4],[2,6],[2,8],[2,10]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],  ['celdas'=> [[2,3],[2,5],[2,7],[2,9],[2,11]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],  ['celdas'=> [[2,12]] ]);

      //fila 3
      $CN->def_cuadro_store(['valor_inicial'=>'Ciclo Superior de Educación Técnica','colspan'=>12,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);

      // fila 3 a 14

      $CN->def_cuadro_store(['valor_inicial'=>'Maestro mayor de obras'                ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Técnico aviónico'                      ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Técnico constructor naval'             ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Técnico en administr. de las org.'     ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[7,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Técnico en aeronáutica'                ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[8,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Técnico en automotores'                ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[9,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Técnico en electromecánica'            ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[10,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Técnico en electrónica'                ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[11,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Técnico en inform. personal y prof.'   ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[12,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Técnico en multimedios'                ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[13,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Técnico en servicios turísticos'       ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[14,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Técnico en tecnología de los alimentos','titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[15,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Técnico químico'                       ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[16,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Técnico en programación'               ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[17,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Técnico en mecánica'                   ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[18,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Técnico en electricidad'               ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[19,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Técnico en energías renovables'        ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[20,1]] ]);

      //fila 3
      $CN->def_cuadro_store(['valor_inicial'=>'Ciclo Superior de Educación Agropecuaria','colspan'=>12,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[21,1]] ]);

      //$CN->def_cuadro_store(['valor_inicial'=>'Bach. agrario, con esp. en cs. naturales','titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[22,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Técnico en agroindustria'                ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[22,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Técnico en agroservicios'                ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[23,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Técnico en producción agropecuaria'      ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[24,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total Ciclo Superior Técnico y Agrario'  ,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[25,1]] ]);


      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110], ['region'=> [ [ 4, 2,20,9], [22, 2,25,9] ] ]);
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [ 4,10 ,20,12], [22,10 ,25,12]] ]);

      // SOMBREAR CELDAS

      //$CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] , ['celdas'=> [ [22,8], [22,9] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] ,  ['region'=> [ [22,2,23, 9] ] ]);




      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 110, [110],'I2024 - secundaria cuadro 5') ; //110=Común - Secundaria Completa req. 6 años 


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  2, // Consistencia inactiva
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria-cuadro 5, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( [
              'numero' => 2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => '4° año / varón ',
                                      '3' => '4° año / mujer ',
                                      '4' => '5° año / varón ',
                                      '5' => '5° año / mujer ',
                                      '6' => '6° año / varón ',
                                      '7' => '6° año / mujer ',
                                      '8' => '7° año / varón ',
                                      '9' => '7° año / mujer ',
                                      '10'=> 'Total / varón ',
                                      '11'=> 'Total / mujer ',
                                      '12'=> 'Total / total '
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'secundaria-cuadro 5, Suma de columna xxx <> Total'
            ] );
                                        
      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [10,11,12] ],
              'cmp2' => ['scol' => [[2,4,6,8],[3,5,7,9],[10,11] ]] ,
              'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
              'descripcion' => 'secundaria-cuadro 5, Total   x fila <> suma'
            ] );
      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [13,16,17,18,19] ] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria-cuadro 5, control de cuadros dependientes'
            ] ); 

      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas






      // //
      // //       // cuadro 6 SECUNDARIA-> CANTIDAD DE ALUMNOS DE EDUCACIÓN SECUNDARIA CICLO SUPERIOR TÉCNICO, POR AÑO Y SEXO SEGÚN ESPECIALIDAD. Resolución 1098/18. Semi-presencial
      // //       


      $ncuadro=6;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE ALUMNOS DE EDUCACIÓN SECUNDARIA CICLO SUPERIOR TÉCNICO, POR AÑO Y SEXO SEGÚN ESPECIALIDAD. Resolución 1098/18. Semi-presencial',
              'descripcion'=>'ALUMNOS DE EDUCACIÓN SECUNDARIA CICLO SUPERIOR TÉCNICO. R. 1098/18. Semi-presencial',
              'c_tipo_cuadro'=>2, // 
              'c_criterio_completitud'=>2 , // puede no TENER DATOS
              'ancho'=>700,  
              'filas'=>4,
              'columnas'=>12
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,12]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Especialidad / Titulo','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'4°'                   ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'5°'                   ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'6°'                   ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'7°'                   ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,10]] ]);

      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,2], [2,4],[2,6],[2,8],[2,10]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,3], [2,5],[2,7],[2,9],[2,11]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,12]] ]);

      //fila 4
      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>1,'titulo'=>true,'estilos'=>'titulo2','tipo_dato'=>'text'],['celdas'=>[[4,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>''  ,'editable'=>true,'tipo_dato'=>'number']  , ['region'=>[ [3,2,4,9] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'22','editable'=>true,'tipo_dato'=>'combobox'], ['celdas'=>[ [3,1]] ]); //combo de Tecnicaturas de común
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,10,4,12]] ]);
      $CN->def_cuadro_store(['c_mapa'=>110] , [ 'region'=> [ [3,1,3,12], [4,2,4,12] ] ]);


      // SOMBREAR CELDAS
      // $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] , ['region'=> [ [4,7,4,11]] ]);



      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 110, [110],'I2024 - secundaria cuadro 6') ; //110=Común - Secundaria Completa req. 6 años


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 6, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => '4° año / varón ',
                                      '3' => '4° año / mujer ',
                                      '4' => '5° año / varón ',
                                      '5' => '5° año / mujer ',
                                      '6' => '6° año / varón ',
                                      '7' => '6° año / mujer ',
                                      '8' => '7° año / mujer ',
                                      '9' => '7° año / mujer ',
                                      '10' => 'Total / varón ',
                                      '11' => 'Total / mujer ',
                                      '12'=> 'Total / total '
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 6, Suma de columna xxx <> Total'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [10,11,12] ],
              'cmp2' => ['scol' => [[2,4,6,8],[3,5,7,9],[10,11] ]] ,
              'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
              'descripcion' => 'secundaria cuadro 6, Total   x fila <> suma'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [13,16] ] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria - cuadro 6, control de cuadros dependientes'
            ] ); 

      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas






      
      // //
      // //       // cuadro 7 SECUNDARIA-> CANTIDAD DE ALUMNOS DE EDUCACIÓN PROFESIONAL SECUNDARIA  SEGÚN ESPECIALIDAD, Resolución 1873/2022
      // //       


      $ncuadro=7;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE ALUMNOS DE EDUCACIÓN PROFESIONAL SECUNDARIA  SEGÚN ESPECIALIDAD, Resolución 1873/2022.',
              'descripcion'=>'ALUMNOS DE EDUCACIÓN PROFESIONAL SECUNDARIA  SEGÚN ESPECIALIDAD, Resolución 1873/2022',
              'c_tipo_cuadro'=>2, // 
              'c_criterio_completitud'=>2 , // puede no TENER DATOS
              'indicaciones'=>'Nota: en caso que un alumno curse áreas de más de un nivel, contabilizarlo una única vez en el nivel inferior que cursa, (Ej. Si cursa áreas de nivel 1 y nivel 2 simultáneamente, contabilizarlo como alumno de nivel 1, recién cuando apruebe todas las áreas del nivel 1 se contabilizará en el nivel 2).',
              'ancho'=>700,  
              'filas'=>4,
              'columnas'=>12
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,12]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Especialidad / Titulo','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'1° Nivel'             ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2° Nivel'             ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3° Nivel'             ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'4° Nivel'             ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,10]] ]);

      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,2], [2,4],[2,6],[2,8],[2,10]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,3], [2,5],[2,7],[2,9],[2,11]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,12]] ]);

      //fila 4
      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>1,'titulo'=>true,'estilos'=>'titulo2','tipo_dato'=>'text'],['celdas'=>[[4,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>''  ,'editable'=>true,'tipo_dato'=>'number']  , ['region'=>[ [3,2,4,9] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'25','editable'=>true,'tipo_dato'=>'combobox'], ['celdas'=>[ [3,1]] ]); //combo de Ed. Profesional SecundariaTecnicaturas de común
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,10,4,12]] ]);
      $CN->def_cuadro_store(['c_mapa'=>110] , [ 'region'=> [ [3,1,3,12], [4,2,4,12] ] ]);


      // SOMBREAR CELDAS
      // $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] , ['region'=> [ [4,7,4,11]] ]);



      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 110, [110],'I2024 - secundaria cuadro 6') ; //110=Común - Secundaria Completa req. 6 años


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 6, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => '1° Nivel / varón ',
                                      '3' => '1° Nivel / mujer ',
                                      '4' => '2° Nivel / varón ',
                                      '5' => '2° Nivel / mujer ',
                                      '6' => '3° Nivel / varón ',
                                      '7' => '3° Nivel / mujer ',
                                      '8' => '4° Nivel / mujer ',
                                      '9' => '4° Nivel / mujer ',
                                      '10' => 'Total / varón ',
                                      '11' => 'Total / mujer ',
                                      '12'=> 'Total / total '
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 7, Suma de columna xxx <> Total'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [10,11,12] ],
              'cmp2' => ['scol' => [[2,4,6,8],[3,5,7,9],[10,11] ]] ,
              'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
              'descripcion' => 'secundaria cuadro 7, Total   x fila <> suma'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [13,17,18,19] ] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria - cuadro 7, control de cuadros dependientes'
            ] ); 

      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas








// //
// //       // cuadro 8 SECUNDARIA-> CANTIDAD DE ALUMNOS DE BACHILLERATO PARA ADULTOS, PLAN DE 3 AÑOS POR AÑO Y SEXO SEGÚN ESPECIALIDAD
// //       


      $ncuadro=8;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE ALUMNOS DE BACHILLERATO PARA ADULTOS, PLAN DE 3 AÑOS POR AÑO Y SEXO SEGÚN ESPECIALIDAD',
              'descripcion'=>'ALUMNOS DE BACHILLERATO PARA ADULTOS, PLAN DE 3 AÑOS POR AÑO',
              'c_tipo_cuadro'=>2, // 
              'c_criterio_completitud'=>2 , // puede no TENER DATOS
              'ancho'=>700,  
              'filas'=>4,
              'columnas'=>11
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,11]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Especialidad / Titulo','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Modalidad de Dictado' ,'rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'1°'                   ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2°'                   ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,5]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3°'                   ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,7]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Total'                ,'colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,9]] ]);

      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón' , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,3], [2,5],[2,7],[2,9]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer' , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,4], [2,6],[2,8],[2,10]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total' , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,11]] ]);

      //fila 4
      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>2,'titulo'=>true,'estilos'=>'titulo2','tipo_dato'=>'text'],['celdas'=>[[4,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>''  ,'editable'=>true,'tipo_dato'=>'number'], ['region'=>[ [3,3,4,8] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'13','editable'=>true,'tipo_dato'=>'combobox'], ['celdas'=>[ [3,1]] ]); //combo especialidad
      $CN->def_cuadro_store(['valor_inicial'=>'2' ,'editable'=>true,'tipo_dato'=>'combobox'], ['celdas'=>[ [3,2]] ]); //combo modalidad de dictado
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,9,4,11]] ]);
      $CN->def_cuadro_store(['c_mapa'=>144] , [ 'region'=> [ [3,1,3,11], [4,2,4,11] ] ]);



      // SOMBREAR CELDAS
      // $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] , ['region'=> [ [4,7,4,11]] ]);



      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 144, [144],'secundaria cuadro 7') ; // 144 = Adultos - Secundaria Completa


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'SECUNDARIA-cuadro 8, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save(
            [
              'numero' => 2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '3' => '1° año / varón ',
                                      '4' => '1° año / mujer ',
                                      '5' => '2° año / varón ',
                                      '6' => '2° año / mujer ',
                                      '7' => '3° año / varón ',
                                      '8' => '3° año / mujer ',
                                      '9' => 'Total / varón ',
                                      '10' => 'Total / mujer ',
                                      '11'=> 'Total / total '
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 8, Suma de columna xxx <> Total'
            ] );
      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [9,10,11] ],
              'cmp2' => ['scol' => [[3,5,7],[4,6,8],[9,10] ]] ,
              'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
              'descripcion' => 'secundaria cuadro 8, Total   x fila <> suma'
            ] );
      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [13,16,17,18,19] ] , // 13 - SEECIONES / 17 - ALUM. Y SECC.  X TURNO
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria -cuadro 8, control de cuadros dependientes'
            ] ); 

      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas



// //
// //       // cuadro 9 SECUNDARIA-> CANTIDAD DE ALUMNOS DE BACHILLERATO PARA ADULTOS, PLAN DE 4 AÑOS POR AÑO Y SEXO SEGÚN ESPECIALIDAD
// //       


      $ncuadro=9;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE ALUMNOS DE BACHILLERATO PARA ADULTOS, PLAN DE 4 AÑOS POR AÑO Y SEXO SEGÚN ESPECIALIDAD',
              'descripcion'=>'ALUMNOS DE BACHILLERATO PARA ADULTOS, PLAN DE 3 AÑOS POR AÑO',
              'c_tipo_cuadro'=>2, // 
              'c_criterio_completitud'=>2 , // puede no TENER DATOS
              'ancho'=>700,  
              'filas'=>4,
              'columnas'=>12
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,12]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Especialidad / Titulo','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'1°'                   ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2°'                   ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3°'                   ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'4°'                   ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,10]] ]);

      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,2], [2,4],[2,6],[2,8],[2,10]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,3], [2,5],[2,7],[2,9],[2,11]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,12]] ]);

      //fila 4
      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>1,'titulo'=>true,'estilos'=>'titulo2','tipo_dato'=>'text'],['celdas'=>[[4,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>''  ,'editable'=>true,'tipo_dato'=>'number']  , ['region'=>[ [3,2,4,9] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'13','editable'=>true,'tipo_dato'=>'combobox'], ['celdas'=>[ [3,1]] ]); //combo especialidad
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,10,4,12]] ]);
      $CN->def_cuadro_store(['c_mapa'=>144] , [ 'region'=> [ [3,1,3,12], [4,2,4,12] ] ]);


      // SOMBREAR CELDAS
      // $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] , ['region'=> [ [4,7,4,11]] ]);



      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 144, [144],'secundaria cuadro 9') ; // 144 = Adultos - Secundaria Completa


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 9, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => '1° año / varón ',
                                      '3' => '1° año / mujer ',
                                      '4' => '2° año / varón ',
                                      '5' => '2° año / mujer ',
                                      '6' => '3° año / varón ',
                                      '7' => '3° año / mujer ',
                                      '8' => '4° año / mujer ',
                                      '9' => '4° año / mujer ',
                                      '10' => 'Total / varón ',
                                      '11' => 'Total / mujer ',
                                      '12'=> 'Total / total '
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 9, Suma de columna xxx <> Total'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [10,11,12] ],
              'cmp2' => ['scol' => [[2,4,6,8],[3,5,7,9],[10,11] ]] ,
              'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
              'descripcion' => 'secundaria cuadro 9, Total   x fila <> suma'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [13,16,17,18,19] ] ,  // 13 - SEECIONES / 17 - ALUM. Y SECC.  X TURNO
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria - cuadro 9, control de cuadros dependientes'
            ] ); 

      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas









      // //
      // //       // cuadro 10 SECUNDARIA-> CANTIDAD DE ALUMNOS DE SISTEMA DUAL POR AÑO Y SEXO SEGÚN ESPECIALIDAD Y TÍTULO
      // //       


      $ncuadro=10;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE ALUMNOS DE SISTEMA DUAL POR AÑO Y SEXO SEGÚN ESPECIALIDAD Y TÍTULO',
              'descripcion'=>'ALUMNOS DE SISTEMA DUAL',
              'c_tipo_cuadro'=>2, // 
              'c_criterio_completitud'=>2 , // puede no TENER DATOS
              //'indicaciones'=>'',
              'ayuda'=>'Nota: Si su establecimiento no tiene alumnos de Sistema Dual debe vaciar todas las celdas y tildar el checkbox de Cuadro Sin información.',
              'ancho'=>700,  
              'filas'=>4,
              'columnas'=>8
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,8]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Especialidad / Titulo','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'5°','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'6°','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);

      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,2], [2,4],[2,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,3], [2,5],[2,7]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,8]] ]);

      //fila 4
      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>1,'titulo'=>true,'estilos'=>'titulo2','tipo_dato'=>'text'],['celdas'=>[[4,1]] ]);

      // AREA DE DATOS 
      $CN->def_cuadro_store(['valor_inicial'=>'','editable'=>true,'tipo_dato'=>'number'], ['region'=>[ [3,2,4,5] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'14','editable'=>true,'tipo_dato'=>'combobox'], ['celdas'=>[ [3,1]] ]); //combo especialidad
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3, 6,4,8]] ]);
      $CN->def_cuadro_store(['c_mapa'=>110] , [ 'region'=> [ [3,1,3,8], [4,2,4,8] ] ]);


      // SOMBREAR CELDAS
      // $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] , ['region'=> [ [4,7,4,11]] ]);



      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 110, [110],'secundaria cuadro 9') ; // 110 = Comun - Secundaria Completa


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 10, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => '4° año / varón ',
                                      '3' => '4° año / mujer ',
                                      '4' => '5° año / varón ',
                                      '5' => '5° año / mujer ',
                                      '6' => 'Total / varón ',
                                      '7' => 'Total / mujer ',
                                      '8' => 'Total / total '
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 10, Suma de columna xxx <> Total'
            ] );
                        
      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [6,7,8] ],
              'cmp2' => ['scol' => [[2,4],[3,5],[6,7] ]] ,
              'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
              'descripcion' => 'secundaria cuadro 10, Total   x fila <> suma'
            ] );
      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [13,16,17,18,19] ] , // 13 - SEECIONES / 17 - ALUM. Y SECC.  X TURNO
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria - cuadro 10, control de cuadros dependientes'
            ] ); 

      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas



// //
// //       // cuadro 11 SECUNDARIA-> CANTIDAD DE ALUMNOS DE ITINERARIOS FORMATIVOS POR AÑO Y SEXO SEGÚN ITINERARIO FORMATIVO Y MODALIDAD
// //       


      $ncuadro=11;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE ALUMNOS DE ITINERARIOS FORMATIVOS POR AÑO Y SEXO SEGÚN ITINERARIO FORMATIVO Y MODALIDAD',
              'descripcion'=>'ALUMNOS DE IF POR AÑO',
              'c_tipo_cuadro'=>2, // 
              'c_criterio_completitud'=>1 , // debe TENER DATOS
              'ancho'=>700,  
              'filas'=>4,
              'columnas'=>12
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,12]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Denominación del Itinerario Formativo (No Consignar discriminado por módulos)','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'4° Secundaria','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'5° Secundaria','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'6° Secundaria','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'7° Secundaria','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,10]] ]);

      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                            ['celdas'=>[[2,2], [2,4],[2,6],[2,8],[2,10]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>
                  [[2,3], [2,5],[2,7],[2,9],[2,11]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total',  'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>
                  [[2,12]] ]);

      //fila 4
      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>1,'titulo'=>true,'estilos'=>'titulo2','tipo_dato'=>'text'],['celdas'=>[[4,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'','editable'=>true,'tipo_dato'=>'number'], ['region'=>[ [3,2,4,9] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'16','editable'=>true,'tipo_dato'=>'combobox'], ['celdas'=>[ [3,1]] ]); //combo especialidad
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,10,4,12]] ]);
      $CN->def_cuadro_store(['c_mapa'=>114] , [ 'region'=> [ [3,1,3,12], [4,2,4,12] ] ]);


      // SOMBREAR CELDAS
      // $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] , ['region'=> [ [4,7,4,11]] ]);



      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 114, [114],'secundaria cuadro 11') ; // 114 = Común - Itinerario formativo 


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 11 ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => '4° año / varón ',
                                      '3' => '4° año / mujer ',
                                      '4' => '5° año / varón ',
                                      '5' => '5° año / mujer ',
                                      '6' => '6° año / varón ',
                                      '7' => '6° año / mujer ',
                                      '8' => '7° año / mujer ',
                                      '9' => '7° año / mujer ',
                                      '10' => 'Total / varón ',
                                      '11' => 'Total / mujer ',
                                      '12'=> 'Total / total '
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 11 Suma de columna xxx <> Total'
            ] );
                        
      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [10,11,12] ],
              'cmp2' => ['scol' => [[2,4,6,8],[3,5,7,9],[10,11] ]] ,
              'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
              'descripcion' => 'secundaria cuadro 11 Total   x fila <> suma'
            ] );
      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [13] ] , // 13 - SEECIONES 
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria - cuadro 11 control de cuadros dependientes'
            ] ); 

      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas









// //
// //       // cuadro 12 SECUNDARIA-> CANTIDAD DE ALUMNOS DE CAPACITACIÓN POST-PRIMARIA (CEA, Cursos cortos de Oficio, etc.) POR AÑO Y SEXO SEGÚN CURSO
// //       


      $ncuadro=12;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE ALUMNOS DE CAPACITACIÓN POST-PRIMARIA (CEA, Cursos cortos de Oficio, etc.) POR AÑO Y SEXO SEGÚN CURSO',
              'descripcion'=>'ALUMNOS DE CAPACITACIÓN POST-PRIMARIA',
              'c_tipo_cuadro'=>2, // 
              'c_criterio_completitud'=>1 , // debe TENER DATOS
              'ancho'=>700,  
              'filas'=>4,
              'columnas'=>13
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,13]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Especialidad / Titulo','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'1°','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2°','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3°','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Duración','colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,11]] ]);

      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                            ['celdas'=>[[2,2], [2,4],[2,6],[2,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>
                  [[2,3], [2,5],[2,7],[2,9]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total',  'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>
                  [[2,10]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Años' , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,11]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Meses', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,12]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Hs. Cátedra',  'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,13]] ]);

      //fila 4
      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>1,'titulo'=>true,'estilos'=>'titulo2','tipo_dato'=>'text'],['celdas'=>[[4,1 ]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'     ','colspan'=>3,'titulo'=>true,'estilos'=>'titulo2','tipo_dato'=>'text'],['celdas'=>[[4,11]] ]);

      // AREA DE DATOS 
      $CN->def_cuadro_store(['valor_inicial'=>'','editable'=>true,'tipo_dato'=>'number'], ['region'=>[  [3,2,4,7], [3,11,3,13] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'17','editable'=>true,'tipo_dato'=>'combobox'], ['celdas'=>[ [3,1]] ]); //combo especialidad
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3, 8,4,10]] ]);
      $CN->def_cuadro_store(['c_mapa'=>146] , [ 'region'=> [ [3,1,3,13], [4,2,4,10] ] ]);


      // SOMBREAR CELDAS
      // $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] , ['region'=> [ [4,7,4,11]] ]);



      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 146, [146],'secundaria cuadro 12') ; // 146 = Adultos - Formación Profesional 


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 12, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => '1° año / varón ',
                                      '3' => '1° año / mujer ',
                                      '4' => '2° año / varón ',
                                      '5' => '2° año / mujer ',
                                      '6' => '3° año / varón ',
                                      '7' => '3° año / mujer ',
                                      '8' => 'Total / varón ',
                                      '9' => 'Total / mujer ',
                                      '10'=> 'Total / total '
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 12, Suma de columna xxx <> Total'
            ] );
              

                        
      $CN->consistencia_save(
            [
              'numero' => 3,
              'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [8,9,10] ],
              'cmp2' => ['scol' => [[2,4,6],[3,5,7],[8,9] ]] ,
              'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
              'descripcion' => 'secundaria cuadro 12, Total   x fila <> suma'
            ] );
      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [13] ] ,  // 13 - SECCIONES 
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria - cuadro 12, control de cuadros dependientes'
            ] ); 

      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas





//
//
//       // cuadro 13 SECUNDARIA-> CANTIDAD DE DIVISIONES / GRUPOS POR AÑO Y MODALIDAD
//       
//

      $ncuadro=13;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                                              'nombre'=>'CANTIDAD DE DIVISIONES / GRUPOS POR AÑO Y MODALIDAD',
                                              'descripcion'=>'DIVISIONES POR AÑO y MODALIDAD',
                                              'c_tipo_cuadro'=>1,
                                              'c_criterio_completitud'=>1 , // PUEDE NO TENER DATOS
                                              'ancho'=>785,
                                              'filas'=>14,
                                              'columnas'=>11]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 
                                        'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,14,11]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Modalidad','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
              
      $CN->def_cuadro_store(['valor_inicial'=>'1°'         , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2°'         , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3°'         , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'4°'         , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,5]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'5°'         , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'6°'         , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,7]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'7°'         , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'pluriaño'   , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,9]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Fortalecimiento', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,10]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total'      , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,11]] ]);


      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. secundaria orientada (R.302/12)'                               , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. secundaria técnica (R.302/12)'                                 , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. secundaria técnica (R.1098/18) Semi-presencial'                , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. secundaria agropecuaria (R.302/12)'                            , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. secundaria artística (polivalentes de arte)'                   , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. Profesional Secundaria R.1873/22'                              , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[7,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachillerato para adultos, plan de 3 años'                         , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[8,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachillerato para adultos, plan de 4 años'                         , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[9,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Grupos de bachillerato para adultos semipresenciales o a distancia', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[10,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sistema dual'                                                      , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[11,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Grupos de Itinerarios Formativos'                                  , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[12,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Cursos de capacitación post-primaria'                              , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[13,1]] ]);                                              
      $CN->def_cuadro_store(['valor_inicial'=>'Total'                                                             , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[14,1]] ]);

      // AREA DE DATOS
      // fila 2 a 11
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['region'=> [ [2,2,14,11]] ]);
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado' ] , ['region'=> [ [2,11,14,11]] ]);

      $CN->def_cuadro_store(['c_mapa'=>110], ['region'=> [ [2,2,7,11]] ]);   //  110=Comun Secundaria.
      $CN->def_cuadro_store(['c_mapa'=>144], ['region'=> [ [8,2,10,11]] ]);  //  144=Adultos - Secundaria Completa
      $CN->def_cuadro_store(['c_mapa'=>110], ['region'=> [ [11,2,11,11]] ]); //  110=Comun Secundaria.
      $CN->def_cuadro_store(['c_mapa'=>114], ['region'=> [ [12,2,12,11]] ]); //  114=Común - Itinerario formativo 
      $CN->def_cuadro_store(['c_mapa'=>146], ['region'=> [ [13,2,13,11]] ]); //  146="Adultos - Formación Profesional "


      //celdas sombreadas
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] ,
            ['region'=> [ [4,2,4,4], [4,10,13,10], [7,2,7,8],  [8,5,8,9], [9,6,9,9],[10,5,10,9],[11,2,11,5],[11,8,11,9],[12,2,12,4],[13,5,13,9] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] ,
            ['celdas'=> [ [2,8],[6,8],[12,9]]]);


      $CN->def_cuadro_save() ;


      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 110, [110], 'secundaria c 13') ; // 110=Comun Secundaria.
      $CN->mapacuadro_store_c_mapa ( 144, [144], 'secundaria c 13') ; // 144=Adultos - Secundaria Completa
      $CN->mapacuadro_store_c_mapa ( 114, [114], 'secundaria c 13') ; // Itinerario
      $CN->mapacuadro_store_c_mapa ( 146, [146], 'secundaria c 13') ; // FP
      //    $CN->mapacuadro_store_c_mapa ( 112, [112], 'secundaria c 13') ; // polimodal
      //    $CN->mapacuadro_store_c_mapa ( 113, [113], 'secundaria c 13') ;


      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => '1° año ',
                                      '3' => '2° año ',
                                      '4' => '3° año ',
                                      '5' => '4° año ',
                                      '6' => '5° año ',
                                      '7' => '6° año ',
                                      '8' => '7° año ',
                                      '9' => 'pluriaño ',
                                      '10' => 'Fortalecimiento',
                                      '11' => 'Total ',
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'secundaria -cuadro 13, Suma de columna xxx <> Total'
            ] );
                          
      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [11] ],
              'cmp2' => ['scol' => [[2,3,4,5,6,7,8,9,10] ]] ,
              'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
              'descripcion' => 'sec -cuadro 13, Total x fila <> suma'
            ] );


      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 22, //Comparaciones de cuadros alumnos y secciones
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'alu' =>[ [[[2,3,2],[2,3,3]],[[2,3,4],[2,3,5]],[[2,3,6],[2,3,7]], //ciclo basico orientado
                                    [[3,0,2],[3,0,3]],[[3,0,4],[3,0,5]],[[3,0,6],[3,0,7]], // ciclo superior orientado
                                    [[2,3,8],[2,3,9]] ], // Aceleración orientada

                                    [[[2,4,2],[2,4,3]],[[2,4,4],[2,4,5]],[[2,4,6],[2,4,7]], //ciclo basico tecnica
                                    ['r'=>[[5,4,2,20,3]]],['r'=>[[5,4,4,20,5]]],['r'=>[[5,4,6,20,7]]],['r'=>[[5,4,8,20,9]]], // ciclo superior tecnica
                                    [[2,4,8],[2,4,9]] ], // Aceleración técnica

                                    [[[6,0,2],[6,0,3]],[[6,0,4],[6,0,5]],[[6,0,6],[6,0,7]],[[6,0,8],[6,0,9]] ],// ciclo superior tecnico a semi-presencial

                                    [[[2,5,2],[2,5,3]],[[2,5,4],[2,5,5]],[[2,5,6],[2,5,7]], //ciclo basico agraria
                                    ['r'=>[[5,22,2,24,3]]],['r'=>[[5,22,4,24,5]]],['r'=>[[5,22,6,24,7]]],['r'=>[[5,22,8,24,9]]] ],  // ciclo superior agraria

                                    [[[4,0,2],[4,0,3]],[[4,0,4],[4,0,5]],[[4,0,6],[4,0,7]], //ciclo basico artistico
                                    [[4,0,8],[4,0,9]],[[4,0,10],[4,0,11]],[[4,0,12],[4,0,13]] ], //ciclo sup. artistico

                                    [[[7,0,2],[7,0,3]],[[7,0,4],[7,0,5]],[[7,0,6],[7,0,7]],[[7,0,8],[7,0,9]] ],//Ed. Profesional Secundaria

                                    [[[8,0,3],[8,0,4]],[[8,0,5],[8,0,6]],[[8,0,7],[8,0,8]] ],// bach. adultos 3 años 1a3 v+m
                                    [[[9,0,2],[9,0,3]],[[9,0,4],[9,0,5]],[[9,0,6],[9,0,7]],[[9,0,8],[9,0,9]] ],// bach. adul 4 años 1a4 v+m

                                    [[[10,0,2],[10,0,3]],[[10,0,4],[10,0,5]] ],// sistema dual 5 y 6 año v+m

                                    [[[11,0,2],[11,0,3]],[[11,0,4],[11,0,5]],[[11,0,6],[11,0,7]],[[11,0,8],[11,0,9]] ],// IF 4a7 v+m

                                    [[[12,0,2],[12,0,3]],[[12,0,4],[12,0,5]],[[12,0,6],[12,0,7]] ],// CURSOS DE CAP. 1A3 v+m


                                  ], 
                        ],
              'cmp2' => [ 'sei' =>[ [[[13,2,2]],[[13,2,3]],[[13,2,4]], //Secciones c. basico orientada
                                    [[13,2,5]],[[13,2,6]],[[13,2,7]],[[13,2,10]] ], //secciones c. superior orient. y aceleracion

                                    [[[13,3,2]],[[13,3,3]],[[13,3,4]], //Secciones c. tecnico
                                     [[13,3,5]],[[13,3,6]],[[13,3,7]],[[13,3,8]],[[13,3,10]] ], //secciones c. tecnico

                                    [[[13,4,5]],[[13,4,6]],[[13,4,7]],[[13,4,8]] ], // ciclo superior tecnico a semi-presencial

                                    [[[13,5,2]],[[13,5,3]],[[13,5,4]], //Secciones c. agraria 1 a 3
                                     [[13,5,5]],[[13,5,6]],[[13,5,7]],[[13,5,8]] ], //secciones c. agraria 4 a 7

                                    [[[13,6,2]],[[13,6,3]],[[13,6,4]], //Secciones c.b. artistica 1 a 3
                                     [[13,6,5]],[[13,6,6]],[[13,6,7]],[[13,6,8]] ], //secciones c.s. artistica 4 a 7

                                    [[[13,7,2]],[[13,7,3]],[[13,7,4]],[[13,7,5]] ],  //Ed. Profesional Secundaria

                                    [[[13,8,2],[13,10,2]],[[13,8,3],[13,10,3]],[[13,8,4],[13,10,4]] ], //Secciones bach. adultos 3 años (presencial y a distancia)
                                    [[[13,9,2]],[[13,9,3]],[[13,9,4]],[[13,9,5]] ], //Secciones bach. adultos 4 años (presencial y a distancia)

                                    [[[13,11,6]],[[13,11,7]] ], //Secc. Sis. Dual 5 y 6 años  

                                    [[[13,12,5]],[[13,12,6]],[[13,12,7]],[[13,12,8]] ], //IF 4a7
                                    [[[13,13,2]],[[13,13,3]],[[13,13,4]] ], //Cursos de Cap. 1a3  

                                  ],
                          'sea' => [ [[13,2,9]], // secciones agrup ciclo orientado
                                     [[13,3,9]], // secciones agrup tecnica
                                     [[13,4,9]], // ciclo superior tecnico a semi-presencial
                                     [[13,5,9]], // secciones agrup agraria
                                     [[13,6,9]], // secciones agrup artistica
                                     [[13,7,9]],  // secciones agrp. ed. profesional secundaria
                                     [],  // secciones agrp. bach adultos 3 años presencial y a distancia 
                                     [],  // secciones agrp. bach adultos 4 años
                                     [],  // secciones agrp. sistema dual
                                     [],  // secciones agrp. IF
                                     [],  // secciones agrp. CURSOS

                                   ] // secciones agrupadas agregadas a secxaño
                        ] ,
              
              'cmp3' => [ 'des' =>  [                                      
                                    [ '1° C.B. Sec. Orientada', 
                                      '2° C.B. Sec. Orientada',
                                      '3° C.B. Sec. Orientada',
                                      '4° C.S. Sec. Orientada',
                                      '5° C.S. Sec. Orientada',
                                      '6° C.S. Sec. Orientada',
                                      'Aceleración. Sec. Orientada',
                                    ],

                                    [ '1° C.B. Técnico', 
                                      '2° C.B. Técnico',
                                      '3° C.B. Técnico',
                                      '4° C.S. Técnico',
                                      '5° C.S. Técnico',
                                      '6° C.S. Técnico',
                                      '7° C.S. Técnico',
                                      'Aceleración. Sec. Técnico',
                                    ],

                                    [ '4° C.S. Técnico, semi-presencial',
                                      '5° C.S. Técnico, semi-presencial',
                                      '6° C.S. Técnico, semi-presencial',
                                      '7° C.S. Técnico, semi-presencial',
                                  ],

                                    [ '1° C.B. Agrop.',
                                      '2° C.B. Agrop.',
                                      '3° C.B. Agrop.',
                                      '4° C.S. Agrop.',
                                      '5° C.S. Agrop.',
                                      '6° C.S. Agrop.',
                                      '7° C.S. Agrop.',
                                    ],

                                    [ '1° C.B. Artístico',
                                      '2° C.B. Artístico',
                                      '3° C.B. Artístico',
                                      '4° C.S. Artístico',
                                      '5° C.S. Artístico',
                                      '6° C.S. Artístico',
                                      '7° C.S. Artístico',
                                    ],

                                    [ '1° Ed. Prof. Secundaria',
                                      '2° Ed. Prof. Secundaria',
                                      '3° Ed. Prof. Secundaria',
                                      '4° Ed. Prof. Secundaria',
                                    ],                                    

                                    [ '1° Bach. 3 años',
                                      '2° Bach. 3 años',
                                      '3° Bach. 3 años',
                                    ],

                                    [ '1° Bach. 4 años',
                                      '2° Bach. 4 años',
                                      '3° Bach. 4 años',
                                      '4° Bach. 4 años',
                                    ],

                                    [ '5° Sist. Dual',
                                      '6° Sist. Dual',
                                      //'7° Sist. Dual',
                                    ],

                                    [ '4° IF',
                                      '5° IF',
                                      '6° IF',
                                      '7° IF',
                                    ],

                                    [ '1° Cursos de Cap.',
                                      '2° Cursos de Cap.',
                                      '3° Cursos de Cap.',
                                    ],



                                    ],
                        ],

              'msg1' => 'Los alumnos del ',
              'msg2' => 'informados, no se corresponden con las secciones declaradas',
              'msg3' => '',    
              'descripcion' => 'comparacion de alumnos varon + mujer con secciones independientes y/ agrupadas'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar secciones',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'control de cuadro vacio/0'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 5,
              'c_tipo_consistencia' => 23, // relacion alumnos por seccion
              'c_categoria_consistencia' =>  2, // Consistencia de advertencia
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'num' =>[ 
                                      ['r'=>[[2,3,2,3,7],[3,0,2,0,7]] ], // ciclo basico y superior orientado
                                      [[2,3,8],[2,3,9]] , // Aceleracion orientado

                                      ['r'=>[[2,4,2,4,7],[5, 4,2,20,9]] ], // ciclo basico y superior tecnico
                                      [[2,4,8],[2,4,9]] , // Aceleracion tecnico
                                      // en Ed. sec. técnica semi presencial no se calcula relacion de alumnos x seccion, se omiten en la validacion

                                      ['r'=>[[2,5,2,5,7],[5,22,2,24,9]] ], // ciclo basico y superior agrario
                                      ['r'=>[[4,0,2,0,13]] ], // ciclo basico y superior de arte

                                      ['r'=>[[7,0,2,0, 9]] ], // Ed. Profesional Secundaria 1a4 v+m

                                      [[8,0,3],[8,0,4]],[[8,0,5],[8,0,6]],[[8,0,7],[8,0,8]],// bach. adultos 3 años 1a3 v+m
                                      [[9,0,2],[9,0,3]],[[9,0,4],[9,0,5]],[[9,0,6],[9,0,7]],[[9,0,8],[9,0,9]],// bach. adul 4 años 1a4 v+m
                                      [[10,0,2],[10,0,3]],[[10,0,4],[10,0,5]],// sistema dual 5 y 6  v+m
                                      [[11,0,2],[11,0,3]],[[11,0,4],[11,0,5]],[[11,0,6],[11,0,7]],[[11,0,8],[11,0,9]],// IF 4a7 v+m
                                      [[12,0,2],[12,0,3]],[[12,0,4],[12,0,5]],[[12,0,6],[12,0,7]],// CURSOS DE CAP. 1A3 v+m
                                  ],

                          'div' =>[ 
                                      [[13,2,2],[13,2,3],[13,2,4], [13,2,5],[13,2,6],[13,2,7], [13,2,9] ], //secciones sec. orient.
                                      [[13,2,10]], // Aceleracion orientado
                                      [[13,3,2],[13,3,3],[13,3,4], [13,3,5],[13,3,6],[13,3,7],[13,3,8], [13,3,9] ], // s. tecnica
                                      [[13,3,10]], // Aceleracion tecnico

                                      [[13,5,2],[13,5,3],[13,5,4], [13,5,5],[13,5,6],[13,5,7],[13,5,8], [13,5,9] ], //S. agraria 1 a 7
                                      [[13,6,2],[13,6,3],[13,6,4], [13,6,5],[13,6,6],[13,6,7],[13,6,8], [13,6,9] ], //S. art. 1 a 7

                                      [[13,7,2],[13,7,3],[13,7,4],[13,7,5],[13,7,9]], //Ed. Profesional Secundaria 1a4 v+m
                                      
                                      [[13,8,2],[13,10,2]],[[13,8,3],[13,10,3]],[[13,8,4],[13,10,4]], //Bach. adultos 3 años (presencial y a distancia) suma de dos filas 
                                      [[13,9,2]],[[13,9,3]],[[13,9,4]],[[13,9,5]], //bach. adultos 4 años

                                      [[13,11,6]],[[13,11,7]], //Secc. Sis. Dual 5 y 6 años  
                                      [[13,12,5]],[[13,12,6]],[[13,12,7]],[[13,12,8]], //IF 4a7
                                      [[13,13,2]],[[13,13,3]],[[13,13,4]], //Cursos de Cap. 1a3

                                  ]

                        ],
              'cmp2' => [ 'min' =>[ 
                                      10, //secciones total orient.
                                      10, // aceleracion orientado
                                      10, // tecnica
                                      10, // aceleracion técnico
                                      10, // agraria
                                      10, // artistica
                                      10, // Ed. Prof. secundaria
                                      10,10,10, // bach 3 años
                                      10,10,10,10, // bach. 4 años
                                      10,10,    // sist. dual  
                                      10,10,10,10, // IF          
                                      10,10,10,    // cursos      
                                  ],
                          'max' =>[ 
                                      45, //secciones total, sec orient 
                                      45, //secciones aceleracion orientado
                                      45, //tecnica
                                      45, //secciones aceleracion tecnico
                                      45, //agraria
                                      45, //artistica
                                      30, //ed. prof. secundaria
                                      45,45,45,    // bach 3 años
                                      45,45,45,45, // bach 4 años
                                      45,45,    // sistema dual
                                      45,45,45,45, // IF        
                                      45,45,45,    // CURSOS     
                                  ]
                        ] ,

              'cmp3' => [ 'des' =>  [
                                      'Secundaria Orientada',
                                      'Aceleración Orientada',
                                      'Secudaria Técnica',
                                      'Aceleración Técnico',
                                      'Secudaria Agropecuaria',
                                      'Secudaria Artística',
                                      'Ed. Profesional Secundaria',
                                      '1° Bach. 3 años','2° Bach. 3 años','3° Bach. 3 años',
                                      '1° Bach. 4 años','2° Bach. 4 años','3° Bach. 4 años','4° Bach. 4 años',
                                      '5° Sist. Dual','6° Sist. Dual',
                                      '1° IF','2° IF','3° IF','4° IF',
                                      '1° Cursos','2° Cursos','3° Cursos',
                                    ] 
                        ],
              'msg1' => 'La relación de alumnos por división/grupo de ',
                        'msg2' => ' no es la esperada para los valores habituales, ',
                        'msg3' => 'alumnos por división/grupo, verifique la cantidad de alumnos y división/grupo cargadas, si es correcto ignore esta advertencia',
                        'descripcion' => 'advertencia de alumnos x seccion fuera de rango'
            ] );

      $CN->consistencia_save( 
              [
                'numero' => 6,
                'c_tipo_consistencia' => 27, // ctrol de secciones multiples y mas de 1 años con alumnos
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [ 'niv' =>[ 
                                      [[[2,3,2],[2,3,3]],[[2,3,4],[2,3,5]],[[2,3,6],[2,3,7]], //ciclo basico orientado
                                      [[3,0,2],[3,0,3]],[[3,0,4],[3,0,5]],[[3,0,6],[3,0,7]], // ciclo superior orientado
                                      [[2,3,8],[2,3,9]] ], // Aceleración orientada

                                      [[[2,4,2],[2,4,3]],[[2,4,4],[2,4,5]],[[2,4,6],[2,4,7]], //ciclo basico tecnica
                                      ['r'=>[[5,4,2,20,3]]],['r'=>[[5,4,4,20,5]]],['r'=>[[5,4,6,20,7]]],['r'=>[[5,4,8,20,9]]], // ciclo superior tecnica
                                      [[2,4,8],[2,4,9]] ], // Aceleración técnica

                                      [[[6,0,2],[6,0,3]],[[6,0,4],[6,0,5]],[[6,0,6],[6,0,7]],[[6,0,8],[6,0,9]] ], //ciclo sup tecnica semi-presencial

                                      [[[2,5,2],[2,5,3]],[[2,5,4],[2,5,5]],[[2,5,6],[2,5,7]], //ciclo basico agraria
                                      ['r'=>[[5,22,2,24,3]]],['r'=>[[5,22,4,24,5]]],['r'=>[[5,22,6,24,7]]],['r'=>[[5,22,8,24,9]]] ],  // ciclo superior agraria

                                      [[[4,0,2],[4,0,3]],[[4,0,4],[4,0,5]],[[4,0,6],[4,0,7]], //ciclo basico artistico
                                      [[4,0,8],[4,0,9]],[[4,0,10],[4,0,11]],[[4,0,12],[4,0,13]] ], //ciclo sup. artistico                                   
                                    ],  //alumnos x modalidad de secundario
                          ],
                'cmp2' => [ 'sea' =>[ 
                                      [[13,2,9]], // secciones agrup ciclo orientado
                                      [[13,3,9]],  // secciones agrup tecnica
                                      [[13,4,9]],  // secciones agrup tecnica semi-presencial
                                      [[13,5,9]],  // secciones agrup agraria
                                      [[13,6,9]],  // secciones agrup artistica
                                    ] // secciones agrupadas agregadas a secxaño
                          ],
                'cmp3' => [ 'msg_niv' =>[
                                          'Secundaria Orientada', // secundaria
                                          'Secudaria Técnica', // secundaria
                                          'Secudaria Técnica semi-presencial', // secundaria
                                          'Secudaria Agropecuaria', // secundaria
                                          'Secudaria Artística', // secundaria
                                        ],
                          ],
                'msg1' => 'Si declara ',
                'msg2' => 'sección/es pluriaño de',
                'msg3' => 'debe declarar alumnos en más de un año en cuadro:',    
                'descripcion' => 'secundaria - cuadro 13, ctrol secciones multiples y mas de 1 años con alumnos'
              ] );  

              $CN->consistencia_save( 
                [
                  'numero' => 7,
                  'c_tipo_consistencia' => 11, // cuadros dependientes
                  'c_categoria_consistencia' =>  3, // Consistencia de Error
                  'c_estado' =>  1, // Consistencia activa
                  'cmp1' => ['cua' => [17] ] ,  // 17 - ALUM y SECCIONES X turno
                  'cmp2' => [] ,
                  'cmp3' => '',
                  'msg1' => '', 
                  'msg2' => '',
                  'msg3' => '',    
                  'descripcion' => 'secundaria - cuadro 13, control de cuadros dependientes'
                ] ); 


        $CN->consistencia_cantidad_x_cuadro(7); // por si hay que eliminar consistencias viejas



//
// //       // cuadro 14 SECUNDARIA-> EQUIPO DE ORIENTACION ESCOLAR
//


      $ncuadro=14;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'EQUIPO DE ORIENTACION ESCOLAR',
              'descripcion'=>'E.O.E',
              'c_tipo_cuadro'=>4,
              'c_criterio_completitud'=>2 , // puede no TENER DATOS
              'ancho'=>300,
              'filas'=>6,
              'columnas'=>2
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,6,2]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'EQUIPO DE ORIENTACION ESCOLAR'  ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      // fila 2 a 6
      $CN->def_cuadro_store(['valor_inicial'=>'No posee equipo','titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'EOE - (incluido en POF de su escuela)','titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'ED - Equipo de Distrito','titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Extensión de EOE - (POF de otra escuela)','titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Escuela','titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);


      // CUADRO 14 OMITIDO EN RELEVAMIMIENTO FINAL
      // para anular el CUADRO comentar estas dos lineas
      // (area de datos comentada)
     
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'], ['region'=> [ [2,2 ,5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'textarea'], ['celdas'=> [ [6,2]] ]);

      $CN->def_cuadro_save() ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar una opción',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'SECUNDARIA Cuadro 14, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 18, // consistencia de validacion de checkbox
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa                          
              'cmp1' => ['chk'=> [ [[2,2],[3,2],[4,2],[5,2]] ], // conjunto de celdas chk, a validar (1 sola puede ser tildada x vez)
                        ],
              'cmp2' => ['ckp' => [ [14,5,2] ],     // ckp (check padre) celdas que habilitan la carga/tilde de celdas hijos (chi)
                                                    // puede estar en otro cuadro   
                        'chi'=> [ [[6,2]] ] // chi (celdas hijos) celdas habilitadas x el tilde de ckp
                        ],
              'cmp3' => [ 'mch' => [ 'Solo una opción de EOE puede ser seleccionada'] , // mensaje para el grupo de celdas chk
                          'mc0' => [ 'Si Extensión de EOE no está seleccionada, no debe informar escuelas'], // mensaje si la celda padre NO esta chequeada 
                          'mc1' => [ 'Si Extensión de EOE está seleccionada, debe informar escuelas'], // mensaje si la celda padre esta chequeada 
                        ] ,
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'SECUNDARIA -cuadro 14, validacion de E.O.E'
            ] );



//
// //       // cuadro 15 SECUNDARIA-> CONFORMACIONES DE SECUNDARIAS
//


      $ncuadro=15;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CONFORMACIONES DE SECUNDARIAS',
              'descripcion'=>'CONFORMACIONES',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>2 , // puede no TENER DATOS
              'ancho'=>150,
              'filas'=>5,
              'columnas'=>2
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,5,2]] ]);
      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Escuelas:' ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'1' ,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2' ,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3' ,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'4' ,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);




      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'textarea'], ['region'=> [ [2,2,5,2]] ]);

      $CN->def_cuadro_save() ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar una opción',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'SECUNDARIA Cuadro 15, ingresar datos no 0 or on'
            ] );


      $CN->consistencia_cantidad_x_cuadro(1); // por si hay que eliminar consistencias viejas





//
//       // cuadro 16 SECUNDARIA-> MATRÍCULA ATENDIDA DE MODALIDAD ARTÍSTICA Y ED. FÍSICA
//       // Omitido a partir rel I2024 a pedido de silvina se decidio no relevar mas matricula por modalidad
//

      $ncuadro=16;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'MATRÍCULA ATENDIDA DE MODALIDAD ARTÍSTICA Y ED. FÍSICA',
              'descripcion'=>'MATRÍCULA ATENDIDA DE MODALIDAD ARTÍSTICA Y ED. FÍSICA',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>2 , // puede no TENER DATOS                                              
              'ancho'=>670,
              'filas'=>16,
              'columnas'=>8 
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,16,8]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Modalidad'              , 'rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Tipo de Personal'       , 'rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Modalidades y Lenguajes', 'colspan'=>6,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);


      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Educación Física','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Artística Plástica','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Artística Danza - Exp. corporal','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,5]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Artística Música','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Artística Teatro','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,7]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Artística Literatura','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,8]] ]);

      //filas 3 y 4
      $CN->def_cuadro_store(['valor_inicial'=>'Ciclo Básico y Sup. de Ed. Sec. Orientada', 'rowspan'=>2, 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'personal propio', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'de otra escuela', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,2]] ]);

      //filas 5 y 6
      $CN->def_cuadro_store(['valor_inicial'=>'Ciclo Básico y Sup. de Ed. Sec. Técnica', 'rowspan'=>2, 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'personal propio', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'de otra escuela', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,2]] ]);

      //filas 7 y 8
      $CN->def_cuadro_store(['valor_inicial'=>'Ciclo Básico y Sup. de Ed. Sec. Agropecuaria', 'rowspan'=>2, 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[7,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'personal propio', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[7,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'de otra escuela', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[8,2]] ]);

      //filas 9 y 10
      $CN->def_cuadro_store(['valor_inicial'=>'Ciclo Básico y Sup. De Ed. Sec. Artística (poliv. de arte )', 'rowspan'=>2, 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[9,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'personal propio', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[9,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'de otra escuela', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[10,2]] ]);

      //filas 11 y 12
      $CN->def_cuadro_store(['valor_inicial'=>'Bachillerato para adultos (3 años)', 'rowspan'=>2, 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[11,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'personal propio', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[11,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'de otra escuela', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[12,2]] ]);


      //filas 13 y 14
      $CN->def_cuadro_store(['valor_inicial'=>'Bachillerato para adultos (4 años)', 'rowspan'=>2, 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[13,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'personal propio', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[13,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'de otra escuela', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[14,2]] ]);


      //filas 15 y 16
      $CN->def_cuadro_store(['valor_inicial'=>'Sistema Dual', 'rowspan'=>2, 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[15,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'personal propio', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[15,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'de otra escuela', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[16,2]] ]);




        
      // AREA DE DATOS
      // CUADRO OMITIDO / NO CORRESPONDE 
      // PARA ELIMINAR, CUANDO SE RENUMEREN, 
      //$CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [3,3,4,8]] ]); //Orientada
      //$CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [5,3,6,8]] ]); // tecnica
      //$CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [7,3,8,8]] ]);  //Agropecuaria
      //$CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [9,3,10,8]] ]); //artistica
      //$CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>144] , ['region'=> [ [11,3,12,8]] ]); // bach adultos 3 años
      //$CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>144] , ['region'=> [ [13,3,14,8]] ]); // bach. adultos 4
      //$CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [15,3,16,8]] ]); // sist. dual

      //$CN->def_cuadro_store(['c_mapa'=>119], ['region'=> [ [4,1,4,13]] ]);

      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO

      $CN->mapacuadro_store_c_mapa ( 110, [110],'I2024 - secundaria cuadro 16') ;
      //$CN->mapacuadro_store_c_mapa ( 112, [112],'I2024 - secundaria cuadro 16') ;
      $CN->mapacuadro_store_c_mapa ( 144, [144],'I2024 - secundaria cuadro 16') ;
      $CN->mapacuadro_store_c_mapa ( 144, [144],'I2024 - secundaria cuadro 16') ;


      // DEFINIR CONSISTENCIAS


      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 25, // consistencia de comparacion menor val1, val1_1,val1_2 < val2
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
                        // celdas a comparar del cuadro
              'cmp1' => ['v1'=> [

              [[[ 3,3],[ 4,3]], [[ 3,4],[ 4,4]], [[ 3,5],[ 4,5]], [[ 3,6],[ 4,6]], [[ 3,7],[ 4,7]], [[ 3,8],[ 4,8]]], //Orientada
              [[[ 5,3],[ 6,3]], [[ 5,4],[ 6,4]], [[ 5,5],[ 6,5]], [[ 5,6],[ 6,6]], [[ 5,7],[ 6,7]], [[ 5,8],[ 6,8]]], //tecnica
              [[[ 7,3],[ 8,3]], [[ 7,4],[ 8,4]], [[ 7,5],[ 8,5]], [[ 7,6],[ 8,6]], [[ 7,7],[ 8,7]], [[ 7,8],[ 8,8]]], // Agropecuaria
              [[[ 9,3],[10,3]], [[ 9,4],[10,4]], [[ 9,5],[10,5]], [[ 9,6],[10,6]], [[ 9,7],[10,7]], [[ 9,8],[10,8]]],  // artistica
              [[[ 11,3],[12,3]], [[ 11,4],[12,4]], [[ 11,5],[12,5]], [[ 11,6],[12,6]], [[ 11,7],[12,7]], [[ 11,8],[12,8]]],  // bach adultos 3 años
              [[[ 13,3],[14,3]], [[ 13,4],[14,4]], [[ 13,5],[14,5]], [[ 13,6],[14,6]], [[ 13,7],[14,7]], [[ 13,8],[14,8]]],  // bach. adultos 4
              [[[ 15,3],[16,3]], [[ 15,4],[16,4]], [[ 15,5],[16,5]], [[ 15,6],[16,6]], [[ 15,7],[16,7]], [[ 15,8],[16,8]]],  // sist. dual
                                ],
                        ], 
              'cmp2' => ['v2'=>[   // celdas de otros cuadros a sumar para la comparación

                                  ['cel'=>[[2,3,12], [3,0,10]] ], // alumnos ciclo basico y superior orientado (con CESAJ)
                                  ['cel'=>[[2,4,12],[6,0,12]] , 'reg'=>[[5, 4,12,20,12]] ], // alumnos ciclo basico (c2) y superior tecnico (c5) y tecnico semipresencial (c6)
                                  ['cel'=>[[2,5,12]], 'reg'=>[[5,22,12,24,12]] ], // alumnos ciclo basico y superior agrario

                                  ['cel'=>[[4,0,16]]], // ciclo basico y superior de arte

                                  ['cel'=>[[8,0,11]]], // bach. adultos 3 años 1a3 v+m
                                  ['cel'=>[[9,0,12]]], // bach. adul 4 años 1a4 v+m
                                  ['cel'=>[[10,0,8]]], // sistema dual 1a3 v+m

                                ]
                        ],
              'cmp3' => ['d1'=> [ [ 'S. Orientada/Ed. Física',
                                    'S. Orientada/Art. Plástica',
                                    'S. Orientada/Art. Danza',
                                    'S. Orientada/Art. Música',
                                    'S. Orientada/Art. Teatro',
                                    'S. Orientada/Art. Literatura'
                                  ],
                                  [ 'S. Técnica/Ed. Física',
                                    'S. Técnica/Art. Plástica',
                                    'S. Técnica/Art. Danza',
                                    'S. Técnica/Art. Música',
                                    'S. Técnica/Art. Teatro',
                                    'S. Técnica/Art. Literatura'
                                  ],
                                  [ 'S. Agraria/Ed. Física',
                                    'S. Agraria/Art. Plástica',
                                    'S. Agraria/Art. Danza ',
                                    'S. Agraria/Art. Música',
                                    'S. Agraria/Art. Teatro',  
                                    'S. Agraria/Art. Literatura'
                                  ],
                                  [ 'S. Arte/Ed. Física',
                                    'S. Arte/Art. Plástica',
                                    'S. Arte/Art. Danza',
                                    'S. Arte/Art. Música',
                                    'S. Arte/Art. Teatro',
                                    'S. Arte/Art. Literatura'
                                  ],                                  
                                  [ 'Bach. Ad. 3 años/Ed. Física',
                                    'Bach. Ad. 3 años/Art. Plástica',
                                    'Bach. Ad. 3 años/Art. Danza',
                                    'Bach. Ad. 3 años/Art. Música',
                                    'Bach. Ad. 3 años/Art. Teatro',
                                    'Bach. Ad. 3 años/Art. Literatura'
                                  ],
                                  [ 'Bach. Ad. 4 años/Ed. Física',
                                    'Bach. Ad. 4 años/Art. Plástica',
                                    'Bach. Ad. 4 años/Art. Danza',
                                    'Bach. Ad. 4 años/Art. Música',
                                    'Bach. Ad. 4 años/Art. Teatro',
                                    'Bach. Ad. 4 años/Art. Literatura'
                                  ],
                                  [ 'S. Dual/Ed. Física',
                                    'S. Dual/Art. Plástica',
                                    'S. Dual/Art. Danza',
                                    'S. Dual/Art. Música',
                                    'S. Dual/Art. Teatro',
                                    'S. Dual/Art. Literatura'
                                  ],
                                ],
                        'd2'=> [ ['2 y 3','2 y 3','2 y 3','2 y 3','2 y 3','2 y 3'],
                                  ['2,5 y 6','2,5 y 6','2,5 y 6','2,5 y 6','2,5 y 6','2,5 y 6'],
                                  ['2 y 5','2 y 5','2 y 5','2 y 5','2 y 5','2 y 5'],
                                  ['4','4','4','4','4','4'],
                                  ['8','8','8','8','8','8'],
                                  ['9','9','9','9','9','9'],
                                  ['10','10','10','10','10','10'],

                                  // ['10','10','10','10','10','10'],
                                  // ['11','11','11','11','11','11'],
                                  // ['12','12','12','12','12','12'],
                                ]
                        ],
              'msg1' => 'Los alumnos de ',
              'msg2' => 'superan los informados en cuadro ',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 16, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_cantidad_x_cuadro(1); // por si hay que eliminar consistencias viejas




      //
      //       // cuadro 17 SECUNDARIA-> ALUMNOS Y SECCIONES SEGÚN REGIMEN DE TURNOS
      //

      $ncuadro=17;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE ALUMNOS Y SECCIONES POR TURNO SEGÚN MODALIDAD',
              'descripcion'=>'ALUMNOS Y SECCIONES SEGÚN REGIMEN DE TURNOS',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // obligatorio DATOS                                              
              'ancho'=>1200,
              'filas'=>10,
              'columnas'=>17 
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,10,17]] ]);

      // TITULOS DE FILAS
      //fila 1

      $CN->def_cuadro_store(['valor_inicial'=>'TURNOS','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. Sec. Orientada', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. Sec. Técnica', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. Sec. Agropecuaria', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. Sec. Artísitica (poliv. de arte)', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. Prof. Secundaria', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,10]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachillerato para adultos (3 años)', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,12]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachillerato para adultos (4 años)', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,14]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sistema Dual', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,16]] ]);

      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Alumnos',  'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,2],[2,4],[2,6],[2,8],[2,10],[2,12],[2,14],[2,16]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Secciones','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,3],[2,5],[2,7],[2,9],[2,11],[2,13],[2,15],[2,17]] ]);

      //filas 3 y 10
      $CN->def_cuadro_store(['valor_inicial'=>'Mañana', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Intermedio', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Tarde', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Vespertino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Noche', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[7,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Doble esc.', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[8,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Alternado', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[9,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[10,1]] ]);



        
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [3,2,10,3]] ]); //Orientada
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [3,4,10,5]] ]); // tecnica
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [3,6,10,7]] ]);  //Agropecuariaº
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [3,8,10,9]] ]); //artisticaº
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [3,10,10,11]] ]); // Ed. Prof. Secundaria
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>144] , ['region'=> [ [3,12,10,13]] ]); // bach adultos 3 añosº
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>144] , ['region'=> [ [3,14,10,15]] ]); // bach. adultos 4º
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [3,16,10,17]] ]); // sist. dual

      //$CN->def_cuadro_store(['c_mapa'=>119], ['region'=> [ [4,1,4,13]] ]);

      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO

      $CN->mapacuadro_store_c_mapa ( 110, [110],'I2024 - secundaria cuadro 17') ;
     // $CN->mapacuadro_store_c_mapa ( 112, [112],'I2024 - secundaria cuadro 17') ;
      $CN->mapacuadro_store_c_mapa ( 144, [144],'I2024 - secundaria cuadro 17') ;
      $CN->mapacuadro_store_c_mapa ( 144, [144],'I2024 - secundaria cuadro 17') ;


      // DEFINIR CONSISTENCIAS


      $CN->consistencia_save( 
            [
              'numero' =>  1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 17, ingresar datos no 0 or on'
            ] );


      $CN->consistencia_save( 
            [
              'numero' =>  2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1 , // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => 'Alumnos - Sec. Orientada',
                                      '3' => 'Secciones - Sec. Orientada',
                                      '4' => 'Alumnos - Sec. Técnica',
                                      '5' => 'Secciones - Sec. Técnica',
                                      '6' => 'Alumnos - Sec. Agropecuaria',
                                      '7' => 'Secciones - Sec. Agropecuaria',
                                      '8' => 'Alumnos - Sec. Artísitica',
                                      '9' => 'Secciones - Sec. Artísitica',
                                      '10' => 'Alumnos - Ed. Profesional Secundaria',
                                      '11' => 'Secciones - Ed. Profesional Secundaria',
                                      '12' => 'Alumnos - Bachillerato para adultos (3 años)',
                                      '13' => 'Secciones - Bachillerato para adultos (3 años)',
                                      '14' => 'Alumnos - Bachillerato para adultos (4 años)',
                                      '15' => 'Secciones - Bachillerato para adultos (4 años)',
                                      '16' => 'Alumnos - Sistema Dual',
                                      '17' => 'Secciones - Sistema Dual',
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 17, Suma de columna xxx <> Total'
            ] );                      

      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 25, // consistencia de comparacion menor val1, val1_1,val1_2 < val2
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
                        // celdas a comparar del cuadro
              'cmp1' => ['v1'=> [ 
                                  [[[ 10,2]] ], // orientada alumnos
                                  [[[ 10,3]] ], // orientada secciones
                                  [[[ 10,4]] ], // Técnica alumnos
                                  [[[ 10,5]] ], // Técnica secciones
                                  [[[ 10,6]] ], // Agropecuaria alumnos
                                  [[[ 10,7]] ], // Agropecuaria Agropecuaria
                                  [[[ 10,8]] ], // Artísitica.alumnos
                                  [[[ 10,9]] ], // Artísitica.secciones 

                                  [[[ 10,10]] ], // Ed. Profesional Secundaria.alumnos
                                  [[[ 10,11]] ], // Ed. Profesional Secundaria.secciones
                                  [[[ 10,12]] ], // Bachillerato para adultos (3 años).alumnos
                                  [[[ 10,13]] ], // Bachillerato para adultos (3 años).secciones
                                  [[[ 10,14]] ], // Bachillerato para adultos (4 años).alumnos
                                  [[[ 10,15]] ], // Bachillerato para adultos (4 años).secciones
                                  [[[ 10,16]] ], // Sistema Dual.alumnos
                                  [[[ 10,17]] ], // Sistema Dual.secciones
                                  
                                ]
                        ], 

              'cmp2' => ['v2'=>[   // celdas de otros cuadros a sumar para la comparación

                                  ['cel'=>[[2,3,12], [3,0,10]] ], // alumnos ciclo basico y superior orientado (con CESAJ)
                                  ['cel'=>[[13,2,11]]],// Secciones

                                  ['cel'=>[[2,4,12],[6,0,12]] , 'reg'=>[[5, 4,12,20,12]] ], //alumnos ciclo basico (c2) y superior tecnico (c5) y tecnico seipresencial (c6)
                                  ['cel'=>[[13,3,11],[13,4,11]]],// Secciones (con las semipresenciales)

                                  ['cel'=>[[2,5,12]], 'reg'=>[[5,22,12,24,12]] ], // alumnos ciclo basico y superior agrario
                                  ['cel'=>[[13,5,11]]],// Secciones

                                  ['cel'=>[[4,0,16]]], // alumnos ciclo basico y superior de arte
                                  ['cel'=>[[13,6,11]]],// Secciones

                                  ['cel'=>[[7,0,12]]],// alumnos Ed. Profesional Secundaria.secciones 1a4 v+m
                                  ['cel'=>[[13,7,11]]],// Secciones 


                                  ['cel'=>[[8,0,11]]],// alumnos bach. adultos 3 años 1a3 v+m
                                  ['cel'=>[[13,8,11],[13,10,11]]],// Secciones (con las semipresenciales)

                                  ['cel'=>[[9,0,12]]],// alumnos bach. adul 4 años 1a4 v+m
                                  ['cel'=>[[13,9,11]]],// Secciones

                                  ['cel'=>[[10,0,8]]],// alumnos sistema dual 1a3 v+m
                                  ['cel'=>[[13,11,11]]],// Secciones

                                ],
                          'sig'=>'!=',
                        ],
              'cmp3' => ['d1'=> [ [ 'alumnos de la Sec. Orientada'],
                                  [ 'secciones de la Sec. Orientada'],
                                  [ 'alumnos de Sec. Técnica'],
                                  [ 'secciones de Sec. Técnica'],
                                  [ 'alumnos de Sec. Agropecuaria'],
                                  [ 'secciones de Sec. Agropecuaria'],
                                  [ 'alumnos de Sec. Artística'],
                                  [ 'secciones de Sec. Artística'],

                                  [ 'alumnos de Ed. Profesional Secundaria'],
                                  [ 'secciones de Ed. Profesional Secundaria'],
                                  [ 'alumnos de Bachillerato para adultos (3 años)'],
                                  [ 'secciones de Bachillerato para adultos (3 años)'],
                                  [ 'alumnos de Bachillerato para adultos (4 años)'],
                                  [ 'secciones de Bachillerato para adultos (4 años)'],
                                  [ 'alumnos de Sistema Dual'],
                                  [ 'secciones de Sistema Dual'],                                 
                                ],                              
                        'd2'=> [ 
                                  ['2 y 3'],['13'],
                                  ['2,5 y 6'],['13'],
                                  ['2 y 5'],['13'],
                                  ['4'],['13'],
                                  ['7'],['13'],
                                  ['8'],['13'],
                                  ['9'],['13'],
                                  ['10',],['13'],
                                ]
                        ],
              'msg1' => 'El Total de ',
              'msg2' => 'son distintos de lo informados en cuadro ',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 16, comparacion de alumnos y secciones diferentes'
            ] );


      $CN->consistencia_save( 
            [
              'numero' =>  4,
              'c_tipo_consistencia' => 24, //consistencia para verificar la carga de alumnos y secciones para CUADROS DE CANTIDAD DE ALUMNOS Y SECCIONES POR TURNO
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1 , // Consistencia activa
              'cmp1' => [[2,3],[4,5],[6,7],[8,9],[10,11],[12,13],[14,15],[16,17] ] , // parejas de columnas de alumnos y secciones a comparar
              'cmp2' => [null,null,null,null,null,null,null,null], //columnas de celda alternativa para secciones agrupadas multinivel
              'cmp3' => ['msg' => ['Sec. Orientada','Sec. Técnica', 'Sec. Agropecuaria','Sec. Artística',' Ed. Profesional Secundaria',' Bachillerato para adultos (3 años)','Bachillerato para adultos (4 años)','Sistema Dual'],
                        ],
              'msg1' => '', // 
              'msg2' => '', //
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 17, CANTIDAD DE ALUMNOS Y SECCIONES POR TURNO'
            ] );                      


      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas



//
//       // cuadro 18 SECUNDARIA-> ALUMNOS SEGÚN TIPO DE JORNADA:
//

      $ncuadro=18;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE ALUMNOS POR TIPO DE JORNADA SEGÚN MODALIDAD',
              'descripcion'=>'CANTIDAD DE ALUMNOS POR TIPO DE JORNADA SEGÚN MODALIDAD',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // obligatorio DATOS                                              
              //'indicaciones'=>'',
              'ayuda'=>'Si da error en las columnas de Bachillerato para Adultos indicando que deben ser distintas de cero, y ya no tiene la oferta de Bachillerato para Adultos en su establecimiento. Debe comunicarse con la Dirección de Información y Estadística solicitando la baja del Bachillerato en el padrón de establecimientos. Pude hacerlo, por el Chat de ayuda, o, telefónicamente a (0800) 222 2338 ó por email a die.relevamientos@abc.gob.ar',
              'ancho'=>1200,
              'filas'=>7,
              'columnas'=>13 
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,7,13]] ]);

      // TITULOS DE FILAS

      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Tipo de Jornada'                     ,'rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. Sec. Orientada'                  ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. Sec. Técnica'                    ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. Sec. Agropecuaria'               ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. Sec. Artísitica (poliv. de arte)','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Ed. Profesional Secundaria'          ,'rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,10]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachillerato para Adultos (3 años)'  ,'rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,11]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachillerato para Adultos (4 años)'  ,'rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,12]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sistema Dual'                        ,'rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,13]] ]);


      // fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Ciclo Básico'  ,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,2],[2,4],[2,6],[2,8], ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ciclo Superior','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,3],[2,5],[2,7],[2,9], ] ]);



      //filas 3 a 7
      $CN->def_cuadro_store(['valor_inicial'=>'Jornada Simple (hasta 29 hs, semanales)'     , 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Jornada Extendida (30 hs, semanales)'        , 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Jornada Agro-técnica (35 a 39 hs. Semanales)', 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Jornada Doble (40 hs, semanales)'            , 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total'                                       , 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[7,1]] ]);


        
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [3,2, 7,3]] ]); //Orientada
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [3,4, 7,5]] ]); // tecnica
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [3,6, 7,7]] ]);  //Agropecuaria
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [3,8, 7,9]] ]); //artistica
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [3,10, 7,10]] ]); // bach adultos 3 años
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>144] , ['region'=> [ [3,11, 7,11]] ]); // bach adultos 3 años
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>144] , ['region'=> [ [3,12, 7,12]] ]); // bach. adultos 4
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [3,13, 7,13]] ]); // sist. dual

      //$CN->def_cuadro_store(['c_mapa'=>119], ['region'=> [ [4,1,4,13]] ]);

      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO

      $CN->mapacuadro_store_c_mapa ( 110, [110],'I2024 - secundaria cuadro 18') ;
//      $CN->mapacuadro_store_c_mapa ( 112, [112],'I2024 - secundaria cuadro 18') ;
      $CN->mapacuadro_store_c_mapa ( 144, [144],'I2024 - secundaria cuadro 18') ;
      $CN->mapacuadro_store_c_mapa ( 144, [144],'I2024 - secundaria cuadro 18') ;


      // DEFINIR CONSISTENCIAS


      $CN->consistencia_save( 
            [
              'numero' =>  1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria 18, ingresar datos no 0 or on'
            ] );


      $CN->consistencia_save( 
            [
              'numero' =>  2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1 , // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   
                                      '2' => 'C. Básico - Sec. Orientada',
                                      '3' => 'C. Superior - Sec. Orientada',
                                      '4' => 'C. Básico - Sec. Técnica',
                                      '5' => 'C. Superior - Sec. Técnica',
                                      '6' => 'C. Básico - Sec. Agropecuaria',
                                      '7' => 'C. Superior - Sec. Agropecuaria',
                                      '8' => 'C. Básico - Sec. Artísitica',
                                      '9' => 'C. Superior - Sec. Artísitica',
                                      '10' => 'Ed. Profesional Secundaria',
                                      '11' => 'Bachillerato para adultos (3 años)',
                                      '12' => 'Bachillerato para adultos (4 años)',
                                      '13' => 'Sistema Dual',
                                  ]
                        ],
              'msg1' => 'La suma de alumnos en la columna de ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 18 Suma de columna xxx <> Total'
            ] );                      


      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 25, // consistencia de comparacion menor val1, val1_1,val1_2 < val2
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
                        // celdas a comparar del cuadro
              'cmp1' => ['v1'=> [ 
                                  [[[ 7 ,2]] ], // cb orientada alumnos
                                  [[[ 7 ,3]] ], // ss orientada 
                                  [[[ 7 ,4]] ], // cb Técnica alumnos
                                  [[[ 7 ,5]] ], // cs Técnica 
                                  [[[ 7 ,6]] ], // cb Agropecuaria
                                  [[[ 7 ,7]] ], // cs Agropecuaria
                                  [[[ 7 ,8]] ], // cb Artísitica.alumnos
                                  [[[ 7 ,9]] ], // ss Artísitica.

                                  [[[ 7 ,10]] ], // Ed. Profesional Secundaria.alumnos
                                  [[[ 7 ,11]] ], // Bachillerato para adultos (3 años).alumnos
                                  [[[ 7 ,12]] ], // Bachillerato para adultos (4 años).alumnos
                                  [[[ 7 ,13]] ], // Sistema Dual.alumnos
                                  
                                ]
                        ], 
              'cmp2' => ['v2'=>[   // celdas de otros cuadros a sumar para la comparación
                        
                        ['cel'=>[[2,3,12]] ], // alumnos ciclo basico orientado (con CESAJ)
                        ['cel'=>[[3,0,10]] ], // alumnos ciclo superior orientado

                        ['cel'=>[[2,4,12]] ], // alumnos ciclo basico tecnico
                        ['reg'=>[[5, 4,12,20,12]], 'cel'=>[[6,0,12]] ], // alumnos ciclo superior tecnico

                        ['cel'=>[[2,5,12]] ], // alumnos ciclo basico agrario
                        ['reg'=>[[5,22,12,24,12]] ], // alumnos ciclo superior agrario

                        ['reg'=>[[4, 0,2,0,7]]], // alumnos ciclo basico de arte
                        ['reg'=>[[4, 0,8,0,13]]], // alumnos ciclo superior de arte

                        ['cel'=>[[7,0,12]]],// alumnos Ed. Profesional Secundaria 1a4 v+m

                        ['cel'=>[[8,0,11]]],// alumnos bach. adultos 3 años 1a3 v+m

                        ['cel'=>[[9,0,12]]],// alumnos bach. adul 4 años 1a4 v+m

                        ['cel'=>[[10,0,8]]],// alumnos sistema dual 1a3 v+m

                                ],
                          'sig'=>'!=',
                        ],
              'cmp3' => ['d1'=> [ [ 'ciclo básico orientado'],
                                  [ 'ciclo superior orientado'],
                                  [ 'ciclo básico técnico'],
                                  [ 'ciclo superior técnico'],
                                  [ 'ciclo básico agropecuario'],
                                  [ 'ciclo superior agropecuario'],
                                  [ 'ciclo básico artístico'],
                                  [ 'ciclo superior artístico'],

                                  [ 'Ed. Profesional Secundaria'],
                                  [ 'bachillerato para adultos (3 años)'],
                                  [ 'bachillerato para adultos (4 años)'],
                                  [ 'sistema dual'],                                 
                                ],                              
                        'd2'=> [ 
                                  ['2'],['3'],
                                  ['2'],['5 y 6'],
                                  ['2'],['5'],
                                  ['4'],['4'],
                                  ['7'],
                                  ['8'],
                                  ['9'],
                                  ['10'],
                                ]
                        ],
              'msg1' => 'El Total de alumnos del ',
              'msg2' => 'es distinto de lo informados en cuadro ',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 18, comparacion de alumnos y secciones diferentes'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 4, // sirve para controlar que carguen al menos uno de los cuadros de bahillerato de adultos de 3 o de 4 años
              'c_tipo_consistencia' => 21, // consistencia de comparacion suma(cmp1) sig suma(cmp2)"   donde sig es sig '=','>','!='
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
                        // celdas a comparar del cuadro
              'cmp1' => [ 'v1' => [ [[7,11],[7,12]]  ] ],  // totales de bach. adultos 3 y 4 años
              'cmp2' => [ 'v2' => [ [] ] ],      // compara con 0   
              'cmp3' => [ 'sig'=> [ '='],
                          'm1' => [ 'del bachillerato para adultos de 3 y 4 años' ],
                          'm2' => [ '8 y 9, debe ser distinto de' ],
                        ],
              'msg1' => 'El total de alumnos',
              'msg2' => 'declarado en cuadros',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 18, controlar declarar alumnos de B. adultos'
            ] );



      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas






      //
      //       // cuadro 19 SECUNDARIA-> ALUMNOS POR SEXO NO BINARIO
      //

      $ncuadro=19;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE ALUMNOS POR SEXO NO BINARIO',
              'descripcion'=>'CANTIDAD DE ALUMNOS POR SEXO NO BINARIO',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // obligatorio DATOS                                              
              'indicaciones'=>'Nota: En concordancia con decreto DCTO-2021-476-APN-PTE.',
              'ayuda'=>'Si da error en las columnas de Bachillerato para Adultos indicando que deben ser distintas de cero, y ya no tiene la oferta de Bachillerato para Adultos en su establecimiento. Debe comunicarse con la Dirección de Información y Estadística solicitando la baja del Bachillerato en el padrón de establecimientos. Pude hacerlo, por el Chat de ayuda, o, telefónicamente a (0800) 222 2338 ó por email a die.relevamientos@abc.gob.ar',
              'ancho'=>1200,
              'filas'=>5,
              'columnas'=>9 
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,5,9]] ]);

      // TITULOS DE FILAS

      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Sexo'                                , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. Sec. Orientada'                  , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. Sec. Técnica'                    , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. Sec. Agropecuaria'               , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. Sec. Artísitica (poliv. de arte)', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,5]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ed. Profesional Secundaria'          , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachillerato para Adultos (3 años)'  , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,7]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachillerato para Adultos (4 años)'  , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sistema Dual'                        , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,9]] ]);


      //filas 2 a 5
      $CN->def_cuadro_store(['valor_inicial'=>'Masculino'     , 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Femenino'      , 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'X (no binario)', 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total'         , 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);


        
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [2,2, 5,2]] ]); // Orientada
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [2,3, 5,3]] ]); // tecnica
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [2,4, 5,4]] ]); // Agropecuaria
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [2,5, 5,5]] ]); // artistica
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [2,6, 5,6]] ]); // Ed. Prof. secundaria
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>144] , ['region'=> [ [2,7, 5,7]] ]); // bach adultos 3 años
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>144] , ['region'=> [ [2,8, 5,8]] ]); // bach. adultos 4
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>110] , ['region'=> [ [2,9, 5,9]] ]); // sist. dual

      //$CN->def_cuadro_store(['c_mapa'=>119], ['region'=> [ [4,1,4,13]] ]);

      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO

      $CN->mapacuadro_store_c_mapa ( 110, [110],'I2024 - secundaria cuadro 19') ;
      $CN->mapacuadro_store_c_mapa ( 144, [144],'I2024 - secundaria cuadro 19') ;


      // DEFINIR CONSISTENCIAS


      $CN->consistencia_save( 
            [
              'numero' =>  1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'secundaria 19, ingresar datos no 0 or on'
            ] );


      $CN->consistencia_save( 
            [
              'numero' =>  2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1 , // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   
                                      '2' => 'Sec. Orientada',
                                      '3' => 'Sec. Técnica',
                                      '4' => 'Sec. Agropecuaria',
                                      '5' => 'Sec. Artísitica',
                                      '6' => 'Ed. Profesional Secundaria',
                                      '7' => 'Bachillerato para adultos (3 años)',
                                      '8' => 'Bachillerato para adultos (4 años)',
                                      '9' => 'Sistema Dual',
                                  ]
                        ],
              'msg1' => 'La suma de alumnos en la columna de ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 19 Suma de columna xxx <> Total'
            ] );                      


      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 25, // consistencia de comparacion menor val1, val1_1,val1_2 < val2
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
                        // celdas a comparar del cuadro
              'cmp1' => ['v1'=> [ 
                                  [[[ 5 ,2]] ], // orientada alumnos
                                  [[[ 5 ,3]] ], // Técnica alumnos
                                  [[[ 5 ,4]] ], // Agropecuaria
                                  [[[ 5 ,5]] ], // Artísitica.alumnos

                                  [[[ 5 ,6]] ], // Ed. Profesional Secundaria.alumnos
                                  [[[ 5 ,7]] ], // Bachillerato para adultos (3 años).alumnos
                                  [[[ 5 ,8]] ], // Bachillerato para adultos (4 años).alumnos
                                  [[[ 5 ,9]] ], // Sistema Dual.alumnos
                                  
                                ]
                        ], 
              'cmp2' => ['v2'=>[   // celdas de otros cuadros a sumar para la comparación
                        
                        ['cel'=>[[2,3,12],[3,0,10]] ], // alumnos ciclo basico y sup orientado (con CESAJ)
                        ['cel'=>[[2,4,12],[6,0,12]],'reg'=>[[5, 4,12,20,12]] ], // alumnos ciclo basico y superior tecnico (incluye semipresencial cuadro 6)
                        ['cel'=>[[2,5,12]], 'reg'=>[[5,22,12,24,12]]  ], // alumnos ciclo basico y superior agrario
                        ['reg'=>[[4, 0,2,0,13]]], // alumnos ciclo basico y superior de arte

                        ['cel'=>[[7,0,12]]],// alumnos Ed. Profesional Secundaria 1a4 v+m
                        ['cel'=>[[8,0,11]]],// alumnos bach. adultos 3 años 1a3 v+m
                        ['cel'=>[[9,0,12]]],// alumnos bach. adul 4 años 1a4 v+m
                        ['cel'=>[[10,0,8]]],// alumnos sistema dual 1a3 v+m

                                ],
                          'sig'=>'!=',
                        ],
              'cmp3' => ['d1'=> [ [ 'sec. orientada'],
                                  [ 'sec. técnica'],
                                  [ 'sec. agropecuaria'],
                                  [ 'sec. artísitica'],

                                  [ 'ed. profesional secundaria'],
                                  [ 'bachillerato para adultos (3 años)'],
                                  [ 'bachillerato para adultos (4 años)'],
                                  [ 'sistema dual'],                                 
                                ],                              
                        'd2'=> [ 
                                  ['2 y 3'],
                                  ['2, 5 y 6'],
                                  ['2 y 5'],
                                  ['4'],
                                  ['7'],
                                  ['8'],
                                  ['9'],
                                  ['10'],
                                ]
                        ],
              'msg1' => 'El Total de alumnos de ',
              'msg2' => 'es distinto de lo informado en cuadro ',
              'msg3' => '',    
              'descripcion' => 'secundaria cuadro 19, comparacion de alumnos diferentes a cuadros de matricula'
            ] );

       $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas




      $F->def_formulario_save();  
      return ($F);



      }  // FORMULARIO DE SECUNDARIA  











//////////////////////////////
///////////////////////////////
//////////////////////////////
///////////////////////////////
//////////////////////////////
///////////////////////////////












static public function I2024_SUPERIOR($id_definicion_formulario)
    {

       
////////////////////////////       
//definir un nuevo formulario
//////////////////////////////
///////////////////////////////


      $F = new DefinicionFormularioController($id_definicion_formulario);  // crear o cargar el formulario

      $F->nombre='MATRÍCULA INICIAL 2024 - EDUCACIÓN SUPERIOR';
      $F->nombre_corto='ED. SUPERIOR';
      $F->descripcion='Planilla Relevamiento Inicial 2024 de Ed. Superior';
      $F->id_periodo='106';
      $F->color='f_verde';

      //asignar los tipo de organizacion del formulario
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'IS'] );

     
         
// cuadro 1, TURNOS DE FUNCIONAMIENTO
//
      $ncuadro=1;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'TURNOS DE FUNCIONAMIENTO',
              'descripcion'=>'encabezado de turnos',
              'c_tipo_cuadro'=>4, // de combobox
              'c_criterio_completitud'=>1 , //obligatorio con datos
              'filas'=>8,
              'ancho'=>247,
              'columnas'=>2 
            ]);

      
      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,8,2]] ]);

      // TITULOS DE FILAS
      $CN->def_cuadro_store(['valor_inicial'=>'TURNOS', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);

      // TITULOS DE COLUMNAS
      $CN->def_cuadro_store(['valor_inicial'=>'Mañana',            'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Intermedio',        'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Tarde',             'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Vespertino',        'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Noche',             'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Doble Escolaridad', 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[7,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Alternado',         'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[8,1]] ]);


//       // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[3,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[4,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[6,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[7,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[8,2]] ]);

      $CN->def_cuadro_save() ;


      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar al menos un turno',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'SUPERIOR-cuadro 1, ingresar al menos un turno'
            ] );

      $CN->consistencia_cantidad_x_cuadro(1); // por si hay que eliminar consistencias viejas


// // cuadro 2 SUPERIOR, CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
      //
      $ncuadro=2;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO',
              'descripcion'=>'encabezado sae',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>2 ,
              'filas'=>6,
              'ancho'=>465,
              'columnas'=>2 
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,6,2]] ]);

      // TITULOS DE FILAS
      $CN->def_cuadro_store(['valor_inicial'=>'SERVICIO', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'CANTIDAD', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);

      // TITULOS DE COLUMNAS
      $CN->def_cuadro_store(['valor_inicial'=>'Desayuno y Merienda Completa',  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Comedor',                       'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Simple',                 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Doble',                  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Completo',               'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[3,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[4,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[6,2]] ]);


      $CN->consistencia_cantidad_x_cuadro(0); // por si hay que eliminar consistencias viejas




//
//       // cuadro 3, SUPERIOR - CANTIDAD DE ALUMNOS DE CARRERAS, POSGRADOS Y POSTÍTULOS SEGÚN AÑO Y SEXO, MODALIDAD PRESENCIAL
//

      $ncuadro=3;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE ALUMNOS DE CARRERAS, POSGRADOS Y POSTÍTULOS SEGÚN AÑO Y SEXO, MODALIDAD PRESENCIAL',
              'descripcion'=>'CANTIDAD DE ALUMNOS DE CARRERAS, POSGRADOS Y POSTÍTULOS SEGÚN AÑO Y SEXO',
              'c_tipo_cuadro'=>2,
              'c_criterio_completitud'=>2 , // Puede NO puede no TENER DATOS
              'ancho'=>1300, 
              'filas'=>4,
              'columnas'=>12,
              'indicaciones'=>'Importante: Debe declarar alumnos en al menos uno de los cuadros (cuadro 3 y/o cuadro 4). Ya sea de las modalidades presencial, y/o Semipresencial/Virtual según corresponda.',
              //'ayuda'=>'Nota: Si su establecimiento no tiene alumnos de Sistema Dual debe vaciar todas las celdas y tildar el checkbox de Cuadro Sin información.',

            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,12]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Nombre de la Carrera', 'rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'1° año'              , 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2° año'              , 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3° año'              , 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'4° año'              , 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'TOTAL'               , 'colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,10]] ]);
    
      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,2],[2,4],[2,6],[2,8],[2,10] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,3],[2,5],[2,7],[2,9],[2,11]  ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,12]] ]);

      // AREA DE DATOS
      // fila 3 y 4
      $CN->def_cuadro_store(['valor_inicial'=>'' , 'editable'=>true,'tipo_dato'=>'number'] , ['region'=> [ [3,2,4,12]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'8', 'editable'=>true,'tipo_dato'=>'combobox'] ,  ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['c_mapa'=>115] , [ 'celdas'=> [[3,1]],'region'=> [ [3,2,4,12]] ]);
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,10,4,12]] ]);
      // Totales
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);

      
      

      $CN->def_cuadro_save() ;

//$CN->def_cuadro_store(['c_mapa'=>142], ['celdas'=> [[4,5],[4,6]] ]);
      
      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 115, [115], 'SUPERIOR c 3') ;


      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => '1° año / varón ',
                                      '3' => '1° año / mujer ',
                                      '4' => '2° año / varón ',
                                      '5' => '2° año / mujer ',
                                      '6' => '3° año / varón ',
                                      '7' => '3° año / mujer ',
                                      '8' => '4° año / varón ',
                                      '9' => '4° año / mujer ',
                                      '10' => 'Total / varón ',
                                      '11' => 'Total / mujer ',
                                      '12' => 'Total / total '
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'SUPERIOR-cuadro 3, Suma de columna xxx <> Total'
            ] );
              
                           
      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [10,11,12 ] ],
              'cmp2' => ['scol' => [[2,4,6,8],[3,5,7,9],[10,11] ]] ,
              'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
              'descripcion' => 'SUPERIOR-cuadro 3, Total   x fila <> suma'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [6,7] ] , //6 divisiones y 7 alum x sexo no binario
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'SUPERIOR-cuadro 3, control de cuadros dependientes'
            ] );
      $CN->consistencia_save( 
            [
                'numero' => 4,
                'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => '',
                'msg1' => 'Debe consignar alumnos',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'SUPERIOR-cuadro 3, ingresar datos no 0 or on'
            ] ); 

      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas




//
//       // cuadro 4, SUPERIOR - CANTIDAD DE ALUMNOS DE CARRERAS, POSGRADOS Y POSTÍTULOS SEGÚN AÑO Y SEXO, MODALIDAD SEMIPRESENCIAL Y VIRTUAL
//       


        $ncuadro=4;
        $F->def_formulario_add_cuadro ( 
            [
                'numero'=>$ncuadro,
                'nombre'=>'CANTIDAD DE ALUMNOS DE CARRERAS, POSGRADOS Y POSTÍTULOS SEGÚN AÑO Y SEXO, MODALIDAD SEMIPRESENCIAL Y VIRTUAL',
                'descripcion'=>'CANTIDAD DE ALUMNOS DE CARRERAS, POSGRADOS Y POSTÍTULOS SEGÚN AÑO Y SEXO',
                'c_tipo_cuadro'=>2,
                'c_criterio_completitud'=>2 , // PUEDE NO puede no TENER DATOS
                'ancho'=>1300, 
                'filas'=>4,
                'columnas'=>12
            ]);

        $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

        // inicializar las celdas del cuadro
        $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,12]] ]);

        // TITULOS DE FILAS
        //fila 1
        $CN->def_cuadro_store(['valor_inicial'=>'Nombre de la Carrera', 'rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'1° año'              , 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'2° año'              , 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'3° año'              , 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'4° año'              , 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'TOTAL'               , 'colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,10]] ]);

        //fila 2
        $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,2],[2,4],[2,6],[2,8],[2,10]  ] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,3],[2,5],[2,7],[2,9],[2,11]  ] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,12]] ]);

        // AREA DE DATOS
        // fila 3 y 4
        $CN->def_cuadro_store(['valor_inicial'=>'' , 'editable'=>true,'tipo_dato'=>'number'] , ['region'=> [ [3,2,4,12]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'8', 'editable'=>true,'tipo_dato'=>'combobox'] ,  ['celdas'=> [[3,1]] ]);
        $CN->def_cuadro_store(['c_mapa'=>115] , [ 'celdas'=> [[3,1]],'region'=> [ [3,2,4,12]] ]);
        $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,10,4,12]] ]);
        // Totales
        $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);




        $CN->def_cuadro_save() ;

        //$CN->def_cuadro_store(['c_mapa'=>142], ['celdas'=> [[4,5],[4,6]] ]);

        // DEFINIR mapa_cuadro DEL CUADRO
        $CN->mapacuadro_store_c_mapa ( 115, [115], 'SUPERIOR c 4') ;

        
        $CN->consistencia_save( 
            [
                'numero' => 1,
                'c_tipo_consistencia' => 16, //totales de columna
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => ['tit' => [   '2' => '1° año / varón ',
                                        '3' => '1° año / mujer ',
                                        '4' => '2° año / varón ',
                                        '5' => '2° año / mujer ',
                                        '6' => '3° año / varón ',
                                        '7' => '3° año / mujer ',
                                        '8' => '4° año / varón ',
                                        '9' => '4° año / mujer ',
                                        '10' => 'Total / varón ',
                                        '11' => 'Total / mujer ',
                                        '12' => 'Total / total '
                                    ]
                        ],
                'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
                'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
                'msg3' => '',    
                'descripcion' => 'SUPERIOR-cuadro 4, Suma de columna xxx <> Total'
            ] );
                
                            
        $CN->consistencia_save( 
            [
                'numero' => 2,
                'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => ['col' => [10,11,12 ] ],
                'cmp2' => ['scol' => [[2,4,6,8],[3,5,7,9],[10,11] ]] ,
                'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
                'descripcion' => 'SUPERIOR-cuadro 4, Total   x fila <> suma'
            ] );

        $CN->consistencia_save( 
            [
                'numero' => 3,
                'c_tipo_consistencia' => 11, // cuadros dependientes
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => ['cua' => [6,7] ] , //6 divisiones y 7 alum x sexo no binario
                'cmp2' => [] ,
                'cmp3' => '',
                'msg1' => '',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'SUPERIOR-cuadro 4, control de cuadros dependientes'
            ] ); 

        $CN->consistencia_save( 
            [
                'numero' => 4,
                'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => '',
                'msg1' => 'Debe consignar alumnos',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'SUPERIOR-cuadro 4, ingresar datos no 0 or on'
            ] );    

        $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas



//
//       // cuadro 5, SUPERIOR - CANTIDAD DE ALUMNOS DE CURSOS DE CAPACITACION SEGÚN AÑO Y SEXO
//       


      $ncuadro=5;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE ALUMNOS DE CURSOS DE CAPACITACION SEGÚN AÑO Y SEXO',
              'descripcion'=>'CANTIDAD DE ALUMNOS CURSOS',
              'c_tipo_cuadro'=>2,
              'c_criterio_completitud'=>1 , // NO puede no TENER DATOS
              'ancho'=>1300, 
              'filas'=>4,
              'columnas'=>12
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,12]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Nombre del curso', 'rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'1° año'          , 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2° año'          , 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3° año'          , 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'4° año'          , 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'TOTAL'           , 'colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,10]] ]);
    
      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,2],[2,4],[2,6],[2,8],[2,10]  ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,3],[2,5],[2,7],[2,9],[2,11]  ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,12]] ]);

      // AREA DE DATOS
      // fila 3 y 4
      $CN->def_cuadro_store(['valor_inicial'=>'' , 'editable'=>true,'tipo_dato'=>'number'  ] , ['region'=> [ [3,2,4,12]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'9', 'editable'=>true,'tipo_dato'=>'combobox'] , ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['c_mapa'=>117] , [ 'celdas'=> [[3,1]],'region'=> [ [3,2,4,12]] ]);
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,10,4,12]] ]);
      // Totales
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);

      
      

      $CN->def_cuadro_save() ;

//$CN->def_cuadro_store(['c_mapa'=>142], ['celdas'=> [[4,5],[4,6]] ]);
      
      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 117, [117], 'SUPERIOR c 5') ;

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'SUPERIOR-cuadro 5, ingresar datos no 0 or on'
            ] );


      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => '1° año / varón ',
                                      '3' => '1° año / mujer ',
                                      '4' => '2° año / varón ',
                                      '5' => '2° año / mujer ',
                                      '6' => '3° año / varón ',
                                      '7' => '3° año / mujer ',
                                      '8' => '4° año / varón ',
                                      '9' => '4° año / mujer ',
                                      '10' => 'Total / varón ',
                                      '11' => 'Total / mujer ',
                                      '12' => 'Total / total '
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'SUPERIOR-cuadro 5, Suma de columna xxx <> Total'
            ] );
                
                         
      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [10,11,12 ] ],
              'cmp2' => ['scol' => [[2,4,6,8],[3,5,7,9],[10,11] ]] ,
              'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
              'descripcion' => 'SUPERIOR-cuadro 5, Total   x fila <> suma'
            ] );
 

      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [6,7] ] , //6 divisiones y 7 alum x sexo no binario
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'SUPERIOR-cuadro 5, control de cuadros dependientes'
            ] ); 

      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas





//          //
// //       // cuadro 6, SUPERIOR - CANTIDAD DE DIVISIONES POR AÑO
//          //


      $ncuadro=6;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE DIVISIONES POR AÑO',
              'descripcion'=>'DIVISIONES X AÑO Y OFERTA',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // tiene que TENER DATOS
              'ancho'=>600,
              'filas'=>6,
              'columnas'=>6
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,5,6]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Divisiones','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'AÑO','colspan'=>4,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','rowspan'=>2,'colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      
      //fila 2

      $CN->def_cuadro_store(['valor_inicial'=>'1°' , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2°' , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3°' , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'4°' , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,5]] ]);

      // fila 3, 4 y 5
     
      $CN->def_cuadro_store(['valor_inicial'=>'Divisiones de Carreras de Modalidad Presencial (cuadro 3)', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Divisiones de Carreras de Modalidad Semipresencial o Virtual (cuadro 4)', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Divisiones de Cursos', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);


      
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>115] , ['region'=> [ [3,2 ,4,5]] ]); //carreras
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>117] , ['region'=> [ [5,2 ,5,5]] ]); // cursos
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>1115], ['region'=> [ [6,2 ,6,5]] ]); // total

      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,6 ,6,6]] ]);


      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 115, [115],'I2024 - SUPERIOR cuadro 6') ; // carreras
      $CN->mapacuadro_store_c_mapa ( 117, [117],'I2024 - SUPERIOR cuadro 6') ; // cursos
      $CN->mapacuadro_store_c_mapa (1115, [115,117],'I2024 - SUPERIOR cuadro 6') ; //carreras y cursos


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'superior-cuadro 6, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => '1° año ',
                                      '3' => '2° año ',
                                      '4' => '3° año ',
                                      '5' => '4° año ',
                                      '6' => 'Total ',
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'SUPERIOR-cuadro 6, Suma de columna xxx <> Total'
            ] );
                           
      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [6] ],
              'cmp2' => ['scol' => [[2,3,4,5]] ],
              'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
              'descripcion' => 'superior -cuadro 6, recalculado automatico Total  x fila '
            ] );


      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 22, //Comparaciones de cuadross alumnos y secciones
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'alu' =>[ 
                                    [ [[3,0,2],[3,0,3]], //alumnos 1 año V+M  de carreras PRESENCIALES
                                      [[3,0,4],[3,0,5]], //alumnos 2 año V+M  de carreras PRESENCIALES
                                      [[3,0,6],[3,0,7]], //alumnos 3 año V+M  de carreras PRESENCIALES
                                      [[3,0,8],[3,0,9]], //alumnos 4 año V+M  de carreras PRESENCIALES
                                    ],
                                    [ [[4,0,2],[4,0,3]], //alumnos 1 año V+M  de carreras SEMIPRESENICIAL/VIRTUAL
                                      [[4,0,4],[4,0,5]], //alumnos 2 año V+M  de carreras SEMIPRESENICIAL/VIRTUAL
                                      [[4,0,6],[4,0,7]], //alumnos 3 año V+M  de carreras SEMIPRESENICIAL/VIRTUAL
                                      [[4,0,8],[4,0,9]], //alumnos 4 año V+M  de carreras SEMIPRESENICIAL/VIRTUAL                                   
                                    ],
                                    [ [[5,0,2],[5,0,3]], //alumnos 1 año V+M  de cursos
                                      [[5,0,4],[5,0,5]], //alumnos 2 año V+M  de cursos
                                      [[5,0,6],[5,0,7]], //alumnos 3 año V+M  de cursos
                                      [[5,0,8],[5,0,9]], //alumnos 4 año V+M  de cursos
                                    ]
                                  ],
                                ],       
              'cmp2' => [ 'sei' =>[ 
                                    [ [[6,3,2]],   //secciones independientes 1 años carreras PRESENCIALES
                                      [[6,3,3]],   //secciones independientes 2 años carreras PRESENCIALES
                                      [[6,3,4]],   //secciones independientes 3 años carreras PRESENCIALES
                                      [[6,3,5]],   //secciones independientes 4 años carreras PRESENCIALES
                                    ],
                                    [ [[6,4,2]],   //secciones independientes 1 años carreras SEMIPRESENICIAL/VIRTUAL
                                      [[6,4,3]],   //secciones independientes 2 años carreras SEMIPRESENICIAL/VIRTUAL
                                      [[6,4,4]],   //secciones independientes 3 años carreras SEMIPRESENICIAL/VIRTUAL
                                      [[6,4,5]],   //secciones independientes 4 años carreras SEMIPRESENICIAL/VIRTUAL                                   
                                    ],
                                    [ [[6,5,2]],   //secciones independientes 1 años cursos
                                      [[6,5,3]],   //secciones independientes 2 años cursos
                                      [[6,5,4]],   //secciones independientes 3 años cursos
                                      [[6,5,5]],   //secciones independientes 4 años cursos
                                    ]
                                  ],
                          'sea' => [  [], [], []  ], // secciones agrupadas del nivel
                          'sa2' => [  [], [], []  ] // secciones agrupadas alternativas del nivel 
                        ] ,
              
              'cmp3' => [ 'des' =>  [                                      
                                        ['1 año de Carreras Presenciales', 
                                        '2 año de Carreras Presenciales',
                                        '3 año de Carreras Presenciales',
                                        '4 año de Carreras Presenciales'
                                        ],

                                        ['1 año de Carreras SemiPresenciales/Virtuales', 
                                        '2 año de Carreras SemiPresenciales/Virtuales',
                                        '3 año de Carreras SemiPresenciales/Virtuales',
                                        '4 año de Carreras SemiPresenciales/Virtuales'
                                        ],

                                        ['1 año de Cursos',
                                        '2 año de Cursos',
                                        '3 año de Cursos',
                                        '4 año de Cursos'
                                        ],

                                    ]
                        ],  // titulos de comprobacion alumnos

              'msg1' => 'Los alumnos de ',
              'msg2' => 'informados, no se corresponden con las secciones declaradas',
              'msg3' => '',    
              'descripcion' => 'comparacion de alumnos varon + mujer con secciones independientes y/ agrupadas'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 5,
              'c_tipo_consistencia' => 23, // relacion alumnos por seccion
              'c_categoria_consistencia' =>  2, // Consistencia de advertencia
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'num' =>[ 
                                    [[3,0,2 ],[3,0,3 ]], //alumnos de carreras Presenciales
                                    [[3,0,4 ],[3,0,5 ]],
                                    [[3,0,6 ],[3,0,7 ]],
                                    [[3,0,8 ],[3,0,9 ]],

                                    [[4,0,2 ],[4,0,3 ]], //alumnos de carreras SemiPresenciales/Virtuales
                                    [[4,0,4 ],[4,0,5 ]],
                                    [[4,0,6 ],[4,0,7 ]],
                                    [[4,0,8 ],[4,0,9 ]],

                                    [[5,0,2 ],[5,0,3 ]], //alumnos de cursos
                                    [[5,0,4 ],[5,0,5 ]],
                                    [[5,0,6 ],[5,0,7 ]],
                                    [[5,0,8 ],[5,0,9 ]] 
                                  ],

                          'div' =>[ [[6,3,2]], [[6,3,3]], [[6,3,4]], [[6,3,5]],  //secc. 1,2,3,4 + AG ° año, de carreras Presenciales
                                    [[6,4,2]], [[6,4,3]], [[6,4,4]], [[6,4,5]],  //secc. 1,2,3,4 + AG ° año, de carreras SemiPresenciales/Virtuales
                                    [[6,5,2]], [[6,5,3]], [[6,5,4]], [[6,5,5]],  //secc. 1,2,3,4 + AG ° año, de cursos                                   
                                  ]
                        ],
              'cmp2' => [ 'min' =>[ 15,15,15,15, //carrera Presenciales
                                    15,15,15,15, //carrera SemiPresenciales/Virtuales
                                    15,15,15,15 // cursos                                      
                                  ],
                          'max' =>[ 45,45,45,45, //carreras Presenciales
                                    200,200,200,200, //carrera SemiPresenciales/Virtuales
                                    45,45,45,45  //cursos                                      
                                  ]
                        ] ,

              'cmp3' => [ 'des' =>  [ '1° año de Carreras de Grado SNU','2°año de Carreras de Grado SNU',' 3°año de Carreras de Grado SNU',
                                      '4° año de Carreras de Grado SNU',

                                      '1° año de Carreras de Grado SNU SemiPresenciales/Virtuales','2°año de Carreras de Grado SNU SemiPresenciales/Virtuales',' 3°año de Carreras de Grado SNU SemiPresenciales/Virtuales',
                                      '4° año de Carreras de Grado SNU SemiPresenciales/Virtuales',

                                      '1° año de Cursos de Capacitación','2°año de Cursos de Capacitación','3°año de Cursos de Capacitación',
                                      '4° año de Cursos de Capacitación'
                                    ] 
                        ],  
              'msg1' => 'La relación de alumnos por división/grupo de ',
              'msg2' => 'excede los valores habituales, ',
              'msg3' => 'verifique la cantidad de alumnos y secciones ingresada',    
              'descripcion' => 'advertencia de alumnos x seccion fuera de rango'
            ] );


      $CN->consistencia_save( 
            [
                'numero' => 6,
                'c_tipo_consistencia' => 21, // consistencia de comparacion suma(cmp1) sig suma(cmp2)"   donde sig es sig '=','>','!='
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                        // celdas a comparar del cuadro
                'cmp1' => [ 'v1' => [ [ [3,2],[3,3],[3,4],[3,5], [4,2],[4,3],[4,4],[4,5] ]  ] ], 
                'cmp2' => [ 'v2' => [ [] ] ],         
                'cmp3' => [ 'sig'=> [ '='],
                        'm1' => [ 'de carreras de Grado (modalidades Presencial y Semiresencial/Virtual) ' ],
                            'm2' => [ '3 y 4, debe ser distinto de' ],
                        ],
                'msg1' => 'El total de alumnos ',
                'msg2' => 'declarados en cuadros',
                'msg3' => '',    
                'descripcion' => 'SUPERIOR cuadro 6, controlar declarar alumnos PRESENCIALES O SEMIPRESENCIALES en cuadro 3 o 4'
            ] );




      $CN->consistencia_cantidad_x_cuadro(6); // por si hay que eliminar consistencias viejas


//
// cuadro 7 SUPERIOR, ALUMNOS POR SEXO NO BINARIO
//

      $ncuadro=7;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'ALUMNOS POR CICLO SEGÚN SEXO, NO BINARIO',
              'descripcion'=>'ALUMNOS POR CICLO SEGÚN SEXO, NO BINARIO de inicial',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // obligatorio DATOS
              'indicaciones'=>'Nota: En concordancia con decreto DCTO-2021-476-APN-PTE.',                                                                                            
              'ancho'=>500,
              'filas'=>5,
              'columnas'=>3 
            ]);
          
      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir
          
      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,5,3]] ]);
          
      // TITULOS DE FILAS
          
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'SEXO','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'ALUMNOS DE CARRERA', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'ALUMNOS DE CURSO', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
          
      //filas 2 a 5
      $CN->def_cuadro_store(['valor_inicial'=>'Masculino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Femenino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'X (no binario)', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
          
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
          
          
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>115] , ['region'=> [ [2,2,5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>117] , ['region'=> [ [2,3,5,3]] ]);
          
      //$CN->def_cuadro_store(['c_mapa'=>119], ['region'=> [ [4,1,4,13]] ]);
          
      $CN->def_cuadro_save() ;
          

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 115, [115],'I2024 - SUPERIOR cuadro 7') ; // carreras
      $CN->mapacuadro_store_c_mapa ( 117, [117],'I2024 - SUPERIOR cuadro 7') ; // cursos
      //$CN->mapacuadro_store_c_mapa (1115, [115,117],'I2024 - SUPERIOR cuadro 6') ; //carreras y cursos

          
      // DEFINIR CONSISTENCIAS
          
      $CN->consistencia_save( 
            [
              'numero' =>  1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'superior 7, ingresar datos no 0 or on'
            ] );
            
      $CN->consistencia_save( 
            [
              'numero' =>  2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1 , // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => 'Alumnos de Carrera ',
                                      '3' => 'Alumnos de Curso ',
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'superior-cuadro 7, Suma de columna xxx <> Total'
            ] );                      
                      
      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 25, // consistencia de comparacion menor val1, val1_1,val1_2 < val2
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
                        // celdas a comparar del cuadro
              'cmp1' => ['v1'=> [ [[[ 5,2]] ], // Carrera alumnos
                                  [[[ 5,3]] ], // Cursos alumnos

                                ]
                        ], 
              'cmp2' => ['v2'=>[   // celdas de otros cuadros a sumar para la comparación
                                  ['cel'=>[[3,0,12],[4,0,12]]],  //alumnmos de carrera presencial y semipresencial                  
                                  ['cel'=>[[5,0,12]]],  // alumnos de cursos
                                ],
                          'sig'=>'!=',
                        ],
              'cmp3' => ['d1'=> [ [ 'carrera presencial y semipresencial'],
                                  [ 'cursos'],
                                ],                              
                        'd2'=>  [ ['3 y 4'],
                                ['5'],
                                ]
                        ],
              'msg1' => 'Los alumnos de ',
              'msg2' => ' son distintos de lo informados en cuadro ',
              'msg3' => '',    
              'descripcion' => 'inicial-cuadro 7, comparacion de alumnos diferentes'
            ] );
                      
      $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas
                      
      $F->def_formulario_save();  

      //dd($F); 
      return ($F);



}  // FROMULARIO DE SUPERIOR  







//////////////////////////////
///////////////////////////////
//////////////////////////////
///////////////////////////////














    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    static public function I2024_EPA($id_definicion_formulario)
    {
        
///////////////////////////////        
///////////////////////////////    
//DEFINIR UN NUEVO FORMULARIO /
///////////////////////////////
///////////////////////////////


      $F = new DefinicionFormularioController( $id_definicion_formulario);  // crear o cargar el formulario

      $F->nombre='MATRÍCULA INICIAL 2024 - EDUCACIÓN PRIMARIA DE ADULTOS';
      $F->nombre_corto='ED. PRIMARIA DE ADULTOS';
      $F->descripcion='Planilla Relevamiento Inicial 2024 de EPA';
      $F->id_periodo='106';
      $F->color='f_violeta';



      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'DE'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'DC'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'DA'] );

//
// cuadro 1 EPA-> TURNOS DE FUNCIONAMIENTO
//
      $ncuadro=1;
      $F->def_formulario_add_cuadro ( 
            [   
              'numero'=>$ncuadro,
              'nombre'=>'TURNOS DE FUNCIONAMIENTO',
              'descripcion'=>'encabezado de turnos',
              'c_tipo_cuadro'=>4,
              'c_criterio_completitud'=>1 ,
              'filas'=>8,
              'ancho'=>247,
              'columnas'=>2 
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro

      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,8,2]] ]);

      // TITULOS DE FILAS
      $CN->def_cuadro_store(['valor_inicial'=>'TURNOS', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);

      // TITULOS DE COLUMNAS
      $CN->def_cuadro_store(['valor_inicial'=>'Mañana',            'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Intermedio',        'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Tarde',             'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Vespertino',        'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Noche',             'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Doble Escolaridad', 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[7,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Alternado',         'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[8,1]] ]);


      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[3,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[4,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[6,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[7,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[8,2]] ]);

      $CN->def_cuadro_save() ;

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar al menos un turno',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'control de ingreso de un turno'
            ] );

      $CN->consistencia_cantidad_x_cuadro(1); // por si hay que eliminar consistencias viejas

//
// cuadro 2  EPA-> CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
//

      $ncuadro=2;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO',
              'descripcion'=>'encabezado sae',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>2 ,
              'filas'=>6,
              'ancho'=>465,
              'columnas'=>2 
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,6,2]] ]);

      // TITULOS DE FILAS
      $CN->def_cuadro_store(['valor_inicial'=>'SERVICIO', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'CANTIDAD', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);

      // TITULOS DE COLUMNAS
      $CN->def_cuadro_store(['valor_inicial'=>'Desayuno y Merienda Completa',  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Comedor',                       'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Simple',                 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Doble',                  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Completo',               'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[3,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[4,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[6,2]] ]);

      $CN->def_cuadro_save() ;

      $CN->consistencia_cantidad_x_cuadro(0); // por si hay que eliminar consistencias viejas

//
// cuadro 3 EPA-> CANTIDAD DE ALUMNOS DE EPA SEGÚN CICLO Y SEXO
//

      $ncuadro=3;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE ALUMNOS DE EPA SEGÚN CICLO Y SEXO',
              'descripcion'=>'matrícula EPA',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 ,
              'filas'=>3,
              'ancho'=>700,
              'columnas'=>9
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ], ['region'=> [ [1,1,3,9]] ]);

      // TITULOS DE FILAS
      
      $CN->def_cuadro_store(['valor_inicial'=>'Alfabetización (1º ciclo)'         , 'colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Formación Integral (2º ciclo)'     , 'colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Formación por Proyectos (3° ciclo)', 'colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,5]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total'                             , 'colspan'=>3, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,7]] ]);

      // $CN->def_cuadro_store(['valor_inicial'=>'Presencial','colspan'=>6,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      // $CN->def_cuadro_store(['valor_inicial'=>'Modularizado, Modalidad Semipresencial / Prog. Jefes y Jefas / Prog. De Alfabetización',
      //                                     'rowspan'=>2, 'colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,7]] ]);
      


      $CN->def_cuadro_store(['valor_inicial'=>'Varón',  'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,1],[2,3],[2,5],[2,7]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer',  'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,2],[2,4],[2,6],[2,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total',  'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,9]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['region'=> [ [3,1,3,9]] ]);        
      //$CN->def_cuadro_store(['c_mapa'=>142], ['celdas'=> [[4,5],[4,6]] ]);

      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      
      //$CN->mapacuadro_store_c_mapa ( 142, [142], 'epa cuadro 3') ;

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'control de cuadro vacio/0'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [9] ] ,
              'cmp2' => ['col' => [7,8] ] ,
              'cmp3' => '',
              'msg1' => 'El total por año',
              'msg2' => 'es distinto de total varon + total mujer',
              'msg3' => '',    
              'descripcion' => 'Total=total varon + total mujer'
            ] );
      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [7] ] ,
              'cmp2' => ['col' => [1,3,5] ] ,
              'cmp3' => '',
              'msg1' => 'El total de varones',
              'msg2' => 'es distinto de la suma de varones',
              'msg3' => '',    
              'descripcion' => 'Total varones <> suma de varons x fila'
            ] );
      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [8] ] ,
              'cmp2' => ['col' => [2,4,6] ] ,
              'cmp3' =>  '',
              'msg1' => 'El total de mujeres',
              'msg2' => 'es distinto de la suma de mujeres',
              'msg3' => '',    
              'descripcion' => 'Total mujeres <> suma de mujeres x fila'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 5,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' => 3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [4,5] ] , //4 divisiones y 5 alum x sexo no binario
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'epa-cuadro 3, control de cuadros dependientes'
            ] ); 
 
      $CN->consistencia_cantidad_x_cuadro(5); // por si hay que eliminar consistencias viejas

//
// cuadro 4 EPA-> CANTIDAD DE SECCIONES / GRUPOS DE EPA.
//
      $ncuadro=4;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE SECCIONES / GRUPOS DE EPA.',
              'descripcion'=>'secciones EPA',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 ,
              'filas'=>2,
              'ancho'=>463,
              'columnas'=>5
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,2,5]] ]);

      // TITULOS DE FILAS

      $CN->def_cuadro_store(['valor_inicial'=>'Alfabetización (1º ciclo)'         , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Formación Integral (2º ciclo)'     , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Formación por Proyectos (3° ciclo)', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Agrupadas'                         , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total'                             , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,5]] ]);

      // $CN->def_cuadro_store(['valor_inicial'=>'Presencial','colspan'=>4,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      // $CN->def_cuadro_store(['valor_inicial'=>'Modularizado, Modalidad Semipresencial / Prog. Jefes y Jefas / Prog. De Alfabetización',
                                                                              //  'rowspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,5]] ]);
            
      // AREA DE DATOS

      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['region'=> [ [2,1,2,5]] ]);
      // $CN->def_cuadro_store(['c_mapa'=>142], ['celdas'=> [[3,4]] ]);

      $CN->def_cuadro_save() ;


      // DEFINIR mapa_cuadro DEL CUADRO
      // $CN->mapacuadro_store_c_mapa ( 142, [142], 'epa cuadro 4') ;


      
      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 22, //Comparaciones de cuadross alumnos y secciones
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'alu' =>[ [
                                      [[3,3,1],[3,3,2]] , // alumnos 1° V+M
                                      [[3,3,3],[3,3,4]] , // alumnos 2° V+M                                                    
                                      [[3,3,5],[3,3,6]] , // alumnos 3° V+M 
                                    ]  // alumnos EPA                                                    
                                  ]
                        ],
              'cmp2' => [ 'sei' =>[
                                    [ [[4,2,1]], [[4,2,2]], [[4,2,3]] ] , // secciones 1°, 2° y 3r ciclo del EPA                                                    
                                  ],
                          'sea' =>[
                                    [[4,2,4]] // secciones agrupadas de EPA
                                  ]
                        ] ,
              
              'cmp3' => [ 'des' =>  [['Alfabetización (1º ciclo)',
                                      'Formación Integral (2º ciclo)',
                                      'Formación por Proyectos (3° ciclo)',
                                        '1º, 2º y 3º ciclo'  ],
                                    ] ],  // titulos de comprobacion alumnos
              'msg1' => 'Los alumnos del ',
              'msg2' => 'informados, no se corresponden con las secciones declaradas',
              'msg3' => '',    
              'descripcion' => 'comparacion de alumnos varon + mujer con secciones independientes y/ agrupadas'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 23, // relacion alumnos por seccion
              'c_categoria_consistencia' =>  2, // Consistencia de advertencia
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'num' =>[ [[3,3,1],[3,3,2],[3,3,3],[3,3,4],[3,3,5],[3,3,6]], //alumnos primaria
                                  ],
                          'div' =>[ [[4,2,1],[4,2,2],[4,2,3],[4,2,4]], //secciones 
                                  ]
                        ],
              'cmp2' => [ 'min' =>[ 10, //secciones de primaria
                                  ],
                          'max' =>[ 45, //secciones de primaria
                                  ]
                        ] ,
              
              'cmp3' => [ 'des' =>  ['sección de primaria para adultos'  ] 
                        ],  
              'msg1' => 'La relación de alumnos por ',
              'msg2' => 'excede los valores habituales, ',
              'msg3' => 'verifique la cantidad de alumnos y secciones ingresada',    
              'descripcion' => 'advertencia de alumnos x seccion fuera de rango'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [5] ] ,
              'cmp2' => ['col' => [1,2,3,4] ] ,
              'cmp3' => '',
              'msg1' => 'El total de secciones',
              'msg2' => 'es distinto de la suma de secciones de: 1ro., 2do., 3er. ciclo y agrupadas)',
              'msg3' => '',    
              'descripcion' => 'Total= secciones x año'
            ] );

      $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas



      //
      // cuadro 5 EPA, ALUMNOS POR SEXO NO BINARIO
      //

      $ncuadro=5;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'ALUMNOS POR CICLO SEGÚN SEXO, NO BINARIO',
              'descripcion'=>'ALUMNOS POR CICLO SEGÚN SEXO, NO BINARIO de inicial',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // obligatorio DATOS
              'indicaciones'=>'Nota: En concordancia con decreto DCTO-2021-476-APN-PTE.',                                                                                            
              'ancho'=>500,
              'filas'=>5,
              'columnas'=>2 
            ]);
          
      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir
          
      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,5,2]] ]);
          
      // TITULOS DE FILAS
          
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'SEXO','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'ALUMNOS DE EPA', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
          
      //filas 2 a 5
      $CN->def_cuadro_store(['valor_inicial'=>'Masculino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Femenino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'X (no binario)', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
          
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
          
          
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['region'=> [ [2,2,5,2]] ]);
          
      $CN->def_cuadro_save() ;
          

      // DEFINIR CONSISTENCIAS
          
      $CN->consistencia_save( 
            [
              'numero' =>  1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'superior 5, ingresar datos no 0 or on'
            ] );
            
      $CN->consistencia_save( 
            [
              'numero' =>  2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1 , // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => 'Alumnos de EPA ',
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'superior-cuadro 5, Suma de columna xxx <> Total'
            ] );                      
                      
      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 25, // consistencia de comparacion menor val1, val1_1,val1_2 < val2
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
                        // celdas a comparar del cuadro
              'cmp1' => ['v1'=> [ [[[ 5,2]] ], //  alumnos EPA

                                ]
                        ], 
              'cmp2' => ['v2'=>[   // celdas de otros cuadros a sumar para la comparación
                                  ['cel'=>[[3,0,9]]],  //Total de alumnmos de EPA
                                ],
                          'sig'=>'!=',
                        ],
              'cmp3' => ['d1'=> [ [ 'EPA'],
                                ],                              
                        'd2'=>  [ ['3'],
                                ]
                        ],
              'msg1' => 'Los alumnos de ',
              'msg2' => ' son distintos de lo informados en cuadro ',
              'msg3' => '',    
              'descripcion' => 'inicial-cuadro 5, comparacion de alumnos diferentes'
            ] );
                      
      $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas


      $F->def_formulario_save();

        //dd($F); 
        return ($F);

    } // FORMULARIO EPA




//////////////////////////////
///////////////////////////////
//////////////////////////////
///////////////////////////////




















static public function I2024_CENS($id_definicion_formulario)
{

       
////////////////////////////       
//definir un nuevo formulario
//////////////////////////////
///////////////////////////////

      $F = new DefinicionFormularioController( $id_definicion_formulario);  // crear o cargar el formulario

      //$F->delete_consistencias();

      $F->nombre='MATRÍCULA INICIAL 2024 - EDUCACIÓN DE ADULTOS (CENS)';
      $F->nombre_corto='ED. DE ADULTOS (CENS)';
      $F->descripcion='Planilla Relevamiento Inicial 2024 de CENS.';
      $F->id_periodo='106';
      $F->color='f_violeta';

      //asignar los tipo de organizacion del formulario
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'DM'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'DS'] );


      // // 
      // // Cuadro 1 CENS-> - TURNOS DE FUNCIONAMIENTO
      // //


      $ncuadro=1;
      $F->def_formulario_add_cuadro ( 
            [   
              'numero'=>$ncuadro,
              'nombre'=>'TURNOS DE FUNCIONAMIENTO',
              'descripcion'=>'encabezado de turnos',
              'c_tipo_cuadro'=>4, // de combobox
              'c_criterio_completitud'=>1 , //obligatorio con datos
              'filas'=>8,
              'ancho'=>247,
              'columnas'=>2 
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,8,2]] ]);

      // TITULOS DE FILAS
      $CN->def_cuadro_store(['valor_inicial'=>'TURNOS', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);

      // TITULOS DE COLUMNAS
      $CN->def_cuadro_store(['valor_inicial'=>'Mañana',            'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Intermedio',        'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Tarde',             'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Vespertino',        'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Noche',             'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Doble Escolaridad', 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[7,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Alternado',         'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[8,1]] ]);


      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[3,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[4,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[6,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[7,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[8,2]] ]);

      $CN->def_cuadro_save() ;


      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar al menos un turno',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'CENS-cuadro 1, ingresar al menos un turno'
            ] );

      $CN->consistencia_cantidad_x_cuadro(1); // por si hay que eliminar consistencias viejas


// //
// // cuadro 2  CENS-> CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
// //


      $ncuadro=2;
      $F->def_formulario_add_cuadro ( 
            [   'numero'=>$ncuadro,
                'nombre'=>'CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO',
                'descripcion'=>'encabezado sae',
                'c_tipo_cuadro'=>1,
                'c_criterio_completitud'=>2 ,
                'ancho'=>465,
                'filas'=>6,
                'columnas'=>2 
            ]);

      $CN=$F->cuadros[$ncuadro];

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,6,2]] ]);

      // TITULOS DE FILAS
      $CN->def_cuadro_store(['valor_inicial'=>'SERVICIO', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'CANTIDAD', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);

      // TITULOS DE COLUMNAS
      $CN->def_cuadro_store(['valor_inicial'=>'Desayuno y Merienda Completa',  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Comedor',                       'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Simple',                 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Doble',                  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Completo',               'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[3,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[4,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[6,2]] ]);

      $CN->def_cuadro_save() ;

      $CN->consistencia_cantidad_x_cuadro(0); // por si hay que eliminar consistencias viejas


// //
// //     cuadro 3 CENS-> CANTIDAD DE ALUMNOS DE BACHILLERATO PARA ADULTOS, PLAN DE 3 AÑOS
// //                        POR AÑO Y SEXO SEGÚN ESPECIALIDAD,  MODALIDAD PRESENCIAL
// //


      $ncuadro=3;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE ALUMNOS DE BACHILLERATO PARA ADULTOS, PLAN DE 3 AÑOS, POR AÑO Y SEXO SEGÚN ESPECIALIDAD,  MODALIDAD PRESENCIAL',
              'descripcion'=>'Alumnos de CENS PRESENCIALES',
              'c_tipo_cuadro'=>2, // 
              'c_criterio_completitud'=>2 , // puede no TENER DATOS
              'ancho'=>1000,  
              'filas'=>4,
              'columnas'=>10
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,10]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Especialidad / Titulo','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'1°','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2°','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3°','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);

      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                            ['celdas'=>[[2,2], [2,4],[2,6],[2,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>
                  [[2,3], [2,5],[2,7],[2,9]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>
                  [[2,10]] ]);

      //fila 4
      $CN->def_cuadro_store(['valor_inicial'=>'Total','titulo'=>true,'estilos'=>'titulo2','tipo_dato'=>'text'],['celdas'=>[[4,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'','editable'=>true,'tipo_dato'=>'number'], ['region'=>[ [3,2,4,7] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'11','editable'=>true,'tipo_dato'=>'combobox'], ['celdas'=>[ [3,1]] ]); //combo cursos
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,8,4,10]] ]);
      $CN->def_cuadro_store(['c_mapa'=>144] , [ 'region'=> [ [3,1,3,10], [4,2,4,10] ] ]);


      // SOMBREAR CELDAS
      // $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] , ['region'=> [ [4,7,4,11]] ]);



      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 144, [144],'CENS CUadro 3') ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
          [
            'numero' => 1,
            'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
            'c_categoria_consistencia' =>  3, // Consistencia de Error
            'c_estado' =>  1, // Consistencia activa
            'cmp1' => [] ,
            'cmp2' => [] ,
            'cmp3' => '',
            'msg1' => 'Debe consignar alumnos',
            'msg2' => '',
            'msg3' => '',    
            'descripcion' => 'CENS-cuadro 3, ingresar datos no 0 or on'
          ] );

      $CN->consistencia_save( 
          [
            'numero' => 2,
            'c_tipo_consistencia' => 16, //totales de columna
            'c_categoria_consistencia' =>  3, // Consistencia de Error
            'c_estado' =>  1, // Consistencia activa
            'cmp1' => [] ,
            'cmp2' => [] ,
            'cmp3' => ['tit' => [   '2' => '1° año / varón ',
                                    '3' => '1° año / mujer ',
                                    '4' => '2° año / varón ',
                                    '5' => '2° año / mujer ',
                                    '6' => '3° año / varón ',
                                    '7' => '3° año / mujer ',
                                    '8' => 'Total / varón ',
                                    '9' => 'Total / mujer ',
                                    '10'=> 'Total / total '
                                ]
                      ],
            'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
            'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
            'msg3' => '',    
            'descripcion' => 'CENS-cuadro 3, Suma de columna xxx <> Total'
          ] );
                                    
      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [8,9,10] ],
              'cmp2' => ['scol' => [[2,4,6],[3,5,7],[8,9] ]] ,
              'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
              'descripcion' => 'CENS-cuadro 3, Total   x fila <> suma'
            ] );
      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [7,9] ] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'CENS-cuadro 3, control de cuadros dependientes'
            ] ); 

      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas


// //
// //       Cuadro 4 CENS-> CANTIDAD DE ALUMNOS DE BACHILLERATO PARA ADULTOS, PLAN DE 4 AÑOS, POR AÑO Y SEXO SEGÚN ESPECIALIDAD, MODALIDAD PRESENCIAL 
// //       


      $ncuadro=4;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE ALUMNOS DE BACHILLERATO PARA ADULTOS, PLAN DE 4 AÑOS, POR AÑO Y SEXO SEGÚN ESPECIALIDAD, MODALIDAD PRESENCIAL',
              'descripcion'=>'ALUMNOS DE BACHILLERATO PARA ADULTOS, PLAN DE 4 AÑOS POR AÑO, PRESENCIAL',
              'c_tipo_cuadro'=>2, // 
              'c_criterio_completitud'=>2 , // puede no TENER DATOS
              'ancho'=>700,  
              'filas'=>4,
              'columnas'=>12
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,12]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Especialidad / Titulo' ,'rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'1°'                    ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2°'                    ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3°'                    ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'4°'                    ,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Total'                 ,'colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,10]] ]);

      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,2], [2,4],[2,6],[2,8],[2,10]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,3], [2,5],[2,7],[2,9],[2,11]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total',  'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,12]] ]);

      //fila 4
      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>1,'titulo'=>true,'estilos'=>'titulo2','tipo_dato'=>'text'],['celdas'=>[[4,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'','editable'=>true,'tipo_dato'=>'number'], ['region'=>[ [3,2,4,9] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'13','editable'=>true,'tipo_dato'=>'combobox'], ['celdas'=>[ [3,1]] ]); //combo especialidad
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,10,4,12]] ]);
      $CN->def_cuadro_store(['c_mapa'=>144] , [ 'region'=> [ [3,1,3,12], [4,2,4,12] ] ]);


      // SOMBREAR CELDAS
      // $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] , ['region'=> [ [4,7,4,11]] ]);



      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 144, [144],'secundaria cuadro 8') ; // 144 = Adultos - Secundaria Completa


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'CENS-cuadro 4, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => '1° año / varón ',
                                      '3' => '1° año / mujer ',
                                      '4' => '2° año / varón ',
                                      '5' => '2° año / mujer ',
                                      '6' => '3° año / varón ',
                                      '7' => '3° año / mujer ',
                                      '8' => '4° año / mujer ',
                                      '9' => '4° año / mujer ',
                                      '10' => 'Total / varón ',
                                      '11' => 'Total / mujer ',
                                      '12'=> 'Total / total '
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'CENS-cuadro 4, Suma de columna xxx <> Total'
          ] );
          

                    
      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [10,11,12] ],
              'cmp2' => ['scol' => [[2,4,6,8],[3,5,7,9],[10,11] ]] ,
              'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
              'descripcion' => 'CENS-cuadro 4, Total   x fila <> suma'
            ] );
      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [7,9] ] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'CENS-cuadro 4, control de cuadros dependientes'
            ] ); 

      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas


// //
// //       Cuadro 5 CENS-> CANTIDAD DE ALUMNOS DE MODALIDAD SEMIPRESENCIAL (R. 737/07)
// //


      $ncuadro=5;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE ALUMNOS DE MODALIDAD SEMIPRESENCIAL (R. 737/07)',
              'descripcion'=>'Alumnos de CENS SEMIPRESENCIALES',
              'c_tipo_cuadro'=>2, // matriz fija
              'c_criterio_completitud'=>2 , // puede no TENER DATOS
              'ancho'=>650,  
              'filas'=>4,
              'columnas'=>4
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,4]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Especialidad / Titulo' ,'rowspan'=>2,'titulo'=>true, 'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total'                 ,'colspan'=>3,'titulo'=>true, 'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);

      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,4]] ]);

      //fila 4
      $CN->def_cuadro_store(['valor_inicial'=>'Total','titulo'=>true,'estilos'=>'titulo2','tipo_dato'=>'text'],['celdas'=>[[4,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'','editable'=>true,'tipo_dato'=>'number'], ['region'=>[ [3,1,3,4],[4,2,4,4] ] ]);
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,4,4,4]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'12','editable'=>true,'tipo_dato'=>'combobox'], ['celdas'=>[ [3,1]] ]); //combo cursos
      $CN->def_cuadro_store(['c_mapa'=>144] , [ 'region'=> [ [3,1,3,4], [4,2,4,4] ] ]);


      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 144, [144],'CENS CUadro 3') ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save(
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'CENS-cuadro 5, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => 'Total / varón ',
                                      '3' => 'Total / mujer ',
                                      '4'=> 'Total / total '
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'CENS-cuadro 5, Suma de columna xxx <> Total'
            ] );
                          
      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [4] ],
              'cmp2' => ['scol' => [[2,3]]] ,
              'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
              'descripcion' => 'CENS-cuadro 5, Total   x fila <> suma'
            ] );
      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [7,9] ] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'CENS-cuadro 5, control de cuadros dependientes'
            ] ); 

      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas


// //
// //  Cuadro 6 CENS-> CANTIDAD DE ALUMNOS DE MODALIDAD VIRTUAL/SEMIPRESENCIAL R. (106/18)
// //  F2020 cambios en la impementacion, por falta de plataforma virtual el plan cambio a Semiprecencial, (sylvina)
// //


      $ncuadro=6;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE ALUMNOS DE MODALIDAD VIRTUAL/SEMIPRESENCIAL R. (106/18)',
              'descripcion'=>'Alumnos de CENS VIRTUALES/SEMIPRESENCIAL',
              'c_tipo_cuadro'=>2, // matriz fija
              'c_criterio_completitud'=>2 , // puede no TENER DATOS
              'ancho'=>650,  
              'filas'=>4,
              'columnas'=>4
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,4]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Especialidad / Titulo' ,'rowspan'=>2,'titulo'=>true, 'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total'                 ,'colspan'=>3,'titulo'=>true, 'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);

      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[2,4]] ]);

      //fila 4
      $CN->def_cuadro_store(['valor_inicial'=>'Total','titulo'=>true,'estilos'=>'titulo2','tipo_dato'=>'text'],['celdas'=>[[4,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'','editable'=>true,'tipo_dato'=>'number'], ['region'=>[ [3,1,3,4],[4,2,4,4] ] ]);
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,4,4,4]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'12','editable'=>true,'tipo_dato'=>'combobox'], ['celdas'=>[ [3,1]] ]); //combo cursos
      $CN->def_cuadro_store(['c_mapa'=>144] , [ 'region'=> [ [3,1,3,4], [4,2,4,4] ] ]);


      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 144, [144],'CENS Cuadro 6') ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save(
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'CENS-cuadro 6, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => 'Total / varón ',
                                      '3' => 'Total / mujer ',
                                      '4'=> 'Total / total '
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'CENS-cuadro 6, Suma de columna xxx <> Total'
            ] );
                          
      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [4] ],
              'cmp2' => ['scol' => [[2,3]]] ,
              'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
              'descripcion' => 'CENS-cuadro 6, Total   x fila <> suma'
            ] );
      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [7,9] ] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'CENS-cuadro 6, control de cuadros dependientes'
            ] ); 

      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas


// //
// //   cuadro 7 CENS-> CANTIDAD DE SECCIONES SEGÚN MODO DE DICTADO Y AÑO
// //


      $ncuadro=7;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE SECCIONES SEGÚN MODO DE DICTADO Y AÑO',
              'descripcion'=>'DIVISIONES X AÑO Y OFERTA',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // tiene que TENER DATOS
              'ancho'=>600,
              'filas'=>5,
              'columnas'=>7
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,5,7]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Modo de Dictado','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'1º ciclo','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2º ciclo','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3º ciclo','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'4º ciclo','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,5]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Modularizado','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,7]] ]);

      //filaS 2 , 3 Y 4

      $CN->def_cuadro_store(['valor_inicial'=>'Bachillerato de adultos, plan 3 años, presencial.'                   , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachillerato de adultos, plan 4 años, presencial.'                   , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachillerato de adultos, Semipresencial, No graduado (Resol. 737/07)', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachillerato de adultos, Virtual/Semipresencial, No graduado (Resol. 106/18)'       , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);


      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>144] , ['region'=> [ [2,2 ,5,7]] ]);

      // SOMBREAR CELDAS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'], [ 'celdas'=>[[3,6]], 'region'=>[[2,5,2,6],[4,2,5,5]] ] );

      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 144, [144],'I2024 - CENS cuadro 6') ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar secciones',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'CENS-cuadro 6, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [7] ] ,
              'cmp2' => ['col' => [ 2,3,4,5,6] ] ,
              'cmp3' => '',
              'msg1' => 'El total secciones',
              'msg2' => 'es distinto de suma de seccciones por año ',
              'msg3' => '',    
              'descripcion' => 'CENS -cuadro 6, Total x fila <> suma de AÑOS'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 22, //Comparaciones de cuadross alumnos y secciones
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'alu' =>[ 
                                    [
                                      [[3,0,2],[3,0,3]], //alumnos 1 año V+M  de BAO DE 3 AÑOS PRESENCIAL
                                      [[3,0,4],[3,0,5]], //alumnos 2 año V+M  de BAO DE 3 AÑOS PRESENCIAL
                                      [[3,0,6],[3,0,7]], //alumnos 3 año V+M  de BAO DE 3 AÑOS PRESENCIAL
                                    ], //alumnos DE BAO DE 3 AÑOS PRESENCIAL
                                    [
                                      [[4,0,2],[4,0,3]], //alumnos 1 año V+M  de BAO DE 3 AÑOS PRESENCIAL
                                      [[4,0,4],[4,0,5]], //alumnos 2 año V+M  de BAO DE 3 AÑOS PRESENCIAL
                                      [[4,0,6],[4,0,7]], //alumnos 3 año V+M  de BAO DE 3 AÑOS PRESENCIAL
                                      [[4,0,8],[4,0,9]], //alumnos 4 año V+M  de BAO DE 3 AÑOS PRESENCIAL
                                    ], //alumnos DE BAO DE 4 AÑOS PRESENCIAL
                                    [
                                      [[5,0,2],[5,0,3]], //alumnos V+M  de SEMIPRESENCIAL
                                    ], //alumnos BAO SEMIPRESENCIAL
                                    [
                                      [[6,0,2],[6,0,3]], //alumnos V+M  de VIRTUAL
                                    ], //alumnos BAO virtual
                                ]
                        ],
              'cmp2' => [ 'sei' =>[ 
                                    [
                                      [[7,2,2]],   //secciones  1 años de BAO DE 3 AÑOSE PRESENCIAL
                                      [[7,2,3]],   //secciones  2 años de BAO DE 3 AÑOS PRESENCIAL
                                      [[7,2,4]],   //secciones  3 años de BAO DE 3 AÑOS PRESENCIAL
                                    ], //secciones de BAO DE 3 AÑOS PRESENCIAL
                                    [
                                      [[7,3,2]],   //secciones 1 años de BAO DE 4 AÑOSE PRESENCIAL
                                      [[7,3,3]],   //secciones 2 años de BAO DE 4 AÑOS PRESENCIAL
                                      [[7,3,4]],   //secciones 3 años de BAO DE 4 AÑOS PRESENCIAL
                                      [[7,3,5]],   //secciones 4 años de BAO DE 4 AÑOS PRESENCIAL
                                    ], //secciones de BAO DE 4 AÑOS PRESENCIAL
                                    [
                                      [[7,4,6]],   //secciones SEMIPRESENCIAL  R.737
                                    ], //secciones SEMIPRESENCIAL
                                    [
                                      [[7,5,6]],   //secciones VIRTUALES R.106
                                    ], //secciones VIRUALES R.106

                                  ],
                          'sea' => [ [], [], [], [] ], // secciones agrupadas del nivel
                          'sa2' => [ [], [], [], [] ] // secciones agrupadas alternativas del nivel 
                        ] ,
              
              'cmp3' => [ 'des' =>  [                                      
                                      [ '1° año', 
                                        '2° año',
                                        '3° año',
                                      ],
                                      [ '1° año', 
                                        '2° año',
                                        '3° año',
                                        '4° año',
                                      ],
                                      ['Modalidad Semipresencial ',
                                      ],
                                      ['Modalidad Virtual',
                                      ],

                                    ]
                        ],  // titulos de comprobacion alumnos

              'msg1' => 'Los alumnos del ',
              'msg2' => 'informados, no se corresponden con las secciones declaradas',
              'msg3' => '',    
              'descripcion' => 'comparacion de alumnos varon + mujer con secciones independientes y/ agrupadas'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 4,
              'c_tipo_consistencia' => 23, // relacion alumnos por seccion
              'c_categoria_consistencia' =>  2, // Consistencia de advertencia
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'num' =>[ 
                                    [[3,0,2 ],[3,0,3 ]], //alumnos de cuadro 3 mod. presencial 3 anos
                                    [[3,0,4 ],[3,0,5 ]],
                                    [[3,0,6 ],[3,0,7 ]],
                                    [[4,0,2 ],[4,0,3 ]], //alumnos de cuadro 4 mod. presencial  4 AÑOS
                                    [[4,0,4 ],[4,0,5 ]],
                                    [[4,0,6 ],[4,0,7 ]],
                                    [[4,0,8 ],[4,0,9 ]],

                                    [[5,0,2 ],[5,0,3 ]], //alumnos de cuadro 5 mod. semipresencial
                                    [[6,0,2 ],[6,0,3 ]], //alumnos de cuadro 5 mod. VITUAL
                                  ],

                          'div' =>[ [[7,2,2]], [[7,2,3]], [[7,2,4]],  //secc. 1,2,3, BAO de 3
                                    [[7,3,2]], [[7,3,3]], [[7,3,4]], [[7,3,5]],  //secc. 1,2,3,4 bao de 4
                                    [[7,4,6]], //secc. semipresenciales
                                    [[7,5,6]], //secc. virtuales                                    
                                  ]
                        ],
              'cmp2' => [ 'min' =>[ 15,15,15, //presencial 3 anos
                                    15,15,15,15, //presencial 4 anos
                                    15, // semipresencial 
                                    15, // virtuales                                     
                                  ],
                          'max' =>[ 45,45,45, //presencial 3 anos
                                    45,45,45,45, //presencial 4 anos
                                    80,  //semipresencial
                                    80,  //virtuales                                       
                                  ]
                        ] ,

              'cmp3' => [ 'des' =>  [ 'cuadro 3, 1° año','cuadro 3, 2°año','cuadro 3, 3°año',
                                      'cuadro 4, 1° año','cuadro 4, 2°año','cuadro 4, 3°año', 'cuadro 4, 4°año',                          
                                      'cuadro 5, modalidad semipresencia',
                                      'cuadro 6, modalidad virtual',
                                    ] 
                        ],  
              'msg1' => 'La relación de alumnos por sección del ',
              'msg2' => 'excede los valores habituales, ',
              'msg3' => 'alumnos por división/grupo, verifique la cantidad de alumnos y división/grupo cargadas, si es correcto ignore esta advertencia',    
              'descripcion' => 'advertencia de alumnos x seccion fuera de rango'
            ] );

      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas


// //
// //       // cuadro 8 CENS-> CANTIDAD DE ALUMNOS Y COMISIONES DE PLANES FINES
// //


      $ncuadro=8;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE ALUMNOS Y COMISIONES DE PLANES FINES',
              'descripcion'=>'ALUMNOS Y DIVISIONES X AÑO DE PLANES FINES',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>2 , // puede no TENER DATOS
              'ancho'=>600,
              'filas'=>3,
              'columnas'=>5
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,3,5]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Línea de plan fines','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Varón','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Comisiones','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,5]] ]);
            
      //fila 2 Y 3

      $CN->def_cuadro_store(['valor_inicial'=>'Línea deudores de materias' , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Línea trayectos educativos' , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);


      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>144] , ['region'=> [ [2,2 ,3,5]] ]);

      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 144, [144],'I2024 - CENS cuadro 5') ;


      // DEFINIR CONSISTENCIAS


      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [4] ] ,
              'cmp2' => ['col' => [2,3] ] ,
              'cmp3' => '',
              'msg1' => 'El total alumnos',
              'msg2' => 'es distinto de suma de varones y mujeres ',
              'msg3' => '',    
              'descripcion' => 'CENS -cuadro 8, Total x fila <> suma de AÑOS'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 22, //Comparaciones de cuadros alumnos y secciones
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'alu' =>[ 
                                    [[[8,2,2],[8,2,3]], //alumnos Línea deudores de materias V+M
                                    [[8,3,2],[8,3,3]], //alumnos Línea trayectos educativos V+M
                                    ]
                                  ]
                        ],
              'cmp2' => [ 'sei' =>[ 
                                    [[[8,2,5]],   //secciones Línea deudores de materias
                                    [[8,3,5]],   //secciones Línea trayectos educativos
                                    ], //secciones independientes 
                                  ],
                          'sea' => [  [], []  ], // secciones agrupadas del nivel
                          'sa2' => [  [], []  ] // secciones agrupadas alternativas del nivel 
                        ] ,
              
              'cmp3' => [ 'des' =>  [                                      
                                      [ 'Línea deudores de materias', 
                                        'Línea trayectos educativos',
                                      ],
                                    ]
                        ],  // titulos de comprobacion alumnos

              'msg1' => 'Los alumnos de ',
              'msg2' => 'informados, no se corresponden con las comisiones declaradas',
              'msg3' => '',    
              'descripcion' => 'comparacion de alumnos varon + mujer con secciones independientes y/ agrupadas'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 23, // relacion alumnos por seccion
              'c_categoria_consistencia' =>  2, // Consistencia de advertencia
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'num' =>[ 
                                    [[8,2,2 ],[8,2,3 ]], //alumnos 1
                                    [[8,3,2 ],[8,3,3 ]], //alumnos 2
                                  ],

                          'div' =>[ [[8,2,5]], //secc. 1, + AG ° año, 
                                    [[8,3,5]], //secc. 2, + AG ° año                                   
                                  ]
                        ],
              'cmp2' => [ 'min' =>[ 15, // deudores
                                    15 //  trayectos                                      
                                  ],
                          'max' =>[ 60, // deudores               
                                    60  // trayectos                                     
                                  ]
                        ] ,

              'cmp3' => [ 'des' =>  [ 'Línea deudores de materias',                            
                                      'Línea trayectos educativos'
                                    ] 
                        ],  
              'msg1' => 'La relación de alumnos por comisión de ',
              'msg2' => 'excede los valores habituales, ',
              'msg3' => 'verifique la cantidad de alumnos y comisiones ingresada',    
              'descripcion' => 'advertencia de alumnos x seccion fuera de rango'
            ] );

      $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas



// //
// // cuadro 9 CENS, ALUMNOS POR SEXO NO BINARIO
// //

      $ncuadro=9;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'ALUMNOS POR CICLO SEGÚN SEXO, NO BINARIO',
              'descripcion'=>'ALUMNOS POR CICLO SEGÚN SEXO, NO BINARIO de inicial',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // obligatorio DATOS
              'indicaciones'=>'Nota: En concordancia con decreto DCTO-2021-476-APN-PTE.',                                                                                            
              'ancho'=>1000,
              'filas'=>5,
              'columnas'=>5 
            ]);
          
      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir
          
      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,5,5]] ]);
          
      // TITULOS DE FILAS
          
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'SEXO','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachillerato de adultos, plan 3 años y no graduados. Presencial, semipresencial y virtual (R737/07 y R106/18)'
                            , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Bachillerato de adultos plan 4 años, presencial'
                            , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'PLANES FINES Línea deudores de materias'
                            , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'PLANES FINES Línea trayectos educativos'
                            , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,5]] ]);
          
      //filas 2 a 5
      $CN->def_cuadro_store(['valor_inicial'=>'Masculino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Femenino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'X (no binario)', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
          
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
          
          
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['region'=> [ [2,2,5,5]] ]);
          
      $CN->def_cuadro_save() ;
          

      // DEFINIR CONSISTENCIAS
          
      $CN->consistencia_save( 
            [
              'numero' =>  1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'CENS-cuadro 9, ingresar datos no 0 or on'
            ] );
            
      $CN->consistencia_save( 
            [
              'numero' =>  2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1 , // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => 'Bachillerato de adultos, plan 3 años y no graduados. Presencial, semipresencial y virtual (R737/07 y R106/18) ',
                                      '3' => 'Bachillerato de adultos plan 4 años, presencial ',
                                      '4' => 'PLANES FINES Línea deudores de materias ',
                                      '5' => 'PLANES FINES Línea trayectos educativos ',
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'CENS-cuadro 9, Suma de columna xxx <> Total'
            ] );                      
                      
      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 25, // consistencia de comparacion menor val1, val1_1,val1_2 < val2
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
                        // celdas a comparar del cuadro
              'cmp1' => ['v1'=> [ [[[ 5,2]] ], //  alumnos EPA

                                ]
                        ], 
              'cmp2' => ['v2'=>[   // celdas de otros cuadros a sumar para la comparación
                                  ['cel'=>[[3,0,10],[5,0,4],[6,0,4]]],  //Total de Bachillerato de adultos, plan 3 años y no graduados. Presencial, semipresencial y virtual (R737/07 y R106/18)
                                  ['cel'=>[[4,0,12]]],  //Total de Bachillerato de adultos plan 4 años, presencial
                                  ['cel'=>[[8,2,4]]],  //Total de PLANES FINES Línea deudores de materias
                                  ['cel'=>[[8,3,4]]],  //Total de PLANES FINES Línea trayectos educativos 
                                ],
                          'sig'=>'!=',
                        ],
              'cmp3' => ['d1'=> [ [ 'Bachillerato de adultos, plan 3 años y no graduados. Presencial, semipresencial y virtual (R737/07 y R106/18)'],
                                  [ 'Bachillerato de adultos plan 4 años, presencial'],
                                  [ 'PLANES FINES Línea deudores de materias'],
                                  [ 'PLANES FINES Línea trayectos educativos'],
                                ],                              
                        'd2'=>  [ ['3,5 y 6'],
                                  ['4'],
                                  ['8'],
                                  ['8'],
                                ]
                        ],
              'msg1' => 'Los alumnos de ',
              'msg2' => ' son distintos de lo informados en cuadro ',
              'msg3' => '',    
              'descripcion' => 'CENS-cuadro 9, comparacion de alumnos diferentes'
            ] );
                      
      $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas




      $F->def_formulario_save();  

      //dd($F); 
      return ($F);



}  // FORMULARIO DE CENS  











//////////////////////////////
///////////////////////////////
//////////////////////////////
///////////////////////////////
//////////////////////////////
///////////////////////////////
















static public function I2024_ESPECIAL($id_definicion_formulario)
    {

       
////////////////////////////       
//definir un nuevo formulario
//////////////////////////////
///////////////////////////////

      $F = new DefinicionFormularioController( $id_definicion_formulario);  // crear o cargar el formulario

      //$F->delete_consistencias();

      $F->nombre='MATRÍCULA INICIAL 2024 - EDUCACIÓN ESPECIAL';
      $F->nombre_corto='ED. ESPECIAL';
      $F->descripcion='Planilla Relevamiento Inicial 2024 de Especial';
      $F->id_periodo='106';
      $F->color='f_rosa';

      //asignar los tipo de organizacion del formulario
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'EE'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'EI'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'EL'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'EP'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'ET'] );


// //
// // Cuadro 1, TURNOS DE FUNCIONAMIENTO
// //

      $ncuadro=1;
      $F->def_formulario_add_cuadro (
            [   
              'numero'=>$ncuadro,
              'nombre'=>'TURNOS DE FUNCIONAMIENTO',
              'descripcion'=>'encabezado de turnos',
              'c_tipo_cuadro'=>4, // de combobox
              'c_criterio_completitud'=>1 , //obligatorio con datos
              'ancho'=>247,
              'filas'=>8,
              'columnas'=>2 
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      
      
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,8,2]] ]);

      // TITULOS DE FILAS
      $CN->def_cuadro_store(['valor_inicial'=>'TURNOS', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);

      // TITULOS DE COLUMNAS
      $CN->def_cuadro_store(['valor_inicial'=>'Mañana',            'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Intermedio',        'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Tarde',             'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Vespertino',        'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Noche',             'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Doble Escolaridad', 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[7,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Alternado',         'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[8,1]] ]);


      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[3,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[4,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[6,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[7,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[8,2]] ]);


      $CN->def_cuadro_save() ; // grabar la estructura del cuadro en la base

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa                                     
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar al menos un turno',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'especial-cuadro 1, ingresar al menos un turno'
            ] );

      $CN->consistencia_cantidad_x_cuadro(1); // por si hay que eliminar consistencias viejas

// //
// // Cuadro 2 ESPECIAL, CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
// //

      $ncuadro=2;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO',
              'descripcion'=>'encabezado sae',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>2 ,
              'ancho'=>465,
              'filas'=>6,
              'columnas'=>2
            ]);

      $CN=$F->cuadros[$ncuadro];

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,6,2]] ]);

      // TITULOS DE FILAS
      $CN->def_cuadro_store(['valor_inicial'=>'SERVICIO', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'CANTIDAD', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);

      // TITULOS DE COLUMNAS
      $CN->def_cuadro_store(['valor_inicial'=>'Desayuno y Merienda Completa',  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Comedor',                       'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Simple',                 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Doble',                  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Completo',               'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[3,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[4,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[6,2]] ]);

      $CN->def_cuadro_save() ; // grabar la estructura del cuadro en la base

      $CN->consistencia_cantidad_x_cuadro(0); // por si hay que eliminar consistencias viejas


//
//   // cuadro 3. ALUMNOS MATRICULADOS EN LOS NIVELES INICIAL, PRIMARIO Y EN FORMACIÓN INTEGRAL (EN SEDE).
//

      $ncuadro=3;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'ALUMNOS MATRICULADOS EN LOS NIVELES INICIAL, PRIMARIO Y EN FORMACIÓN INTEGRAL (EN SEDE).',
              'descripcion'=>'matrícula de niveles en sede',
              'indicaciones'=>'Nota (1): Consignar la cantidad total de alumnos que reciben Formación Integral en su establecimiento, ya sea que cursen solo la Formación General, o solo Formación Técnica o ambas Formaciones.',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // tiene que TENER DATOS
              'ancho'=>1380,
              'filas'=>13,
              'columnas'=>16
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir
    
      
      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,13,16]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Discapacidad / Trastorno', 'rowspan'=>3             ,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Inicial'           , 'rowspan'=>1,'colspan'=>4,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Primario'          , 'rowspan'=>1,'colspan'=>4,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Formación Integral (1)'  , 'rowspan'=>1,'colspan'=>4,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,10]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total'                   , 'rowspan'=>2,'colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,12]] ]);
      
      //fila 2

      $CN->def_cuadro_store(['valor_inicial'=>'1° Ciclo ATDI' , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2° Ciclo'      , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'1° Ciclo'      , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2° Ciclo'      , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ciclo Básico'  , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,10]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ciclo Superior', 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,12]] ]);

      // fila 3
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[3,2], [3,4],[3,6],[3,8],[3,10],[3,12],[3,14]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[3,3], [3,5],[3,7],[3,9],[3,11],[3,13],[3,15]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[3,16]] ]);
      
      //filas 4 a 11
      $CN->def_cuadro_store(['valor_inicial'=>'Discapacidad auditiva (sordera e hipoacusia)'              , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Discapacidad visual'                                       , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sordo - ceguera'                                           , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Discapacidad motora'                                       , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[7,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Alteraciones en el desarrollo y la constitución subjetiva' , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[8,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Discapacidad intelectual'                                  , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[9,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Trastornos específicos del lenguaje'                       , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[10,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Discapacidad múltiple'                                     , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[11,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Riesgo ambiental'                                          , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[12,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total'                                                     , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[13,1]] ]);


      // AREA DE DATOS

      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>121] , ['region'=> [ [4,2,13,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>122] , ['region'=> [ [4,4,13,5]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>123] , ['region'=> [ [4,6,13,9]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>131] , ['region'=> [ [4,10,13,13]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'total_calculado','c_mapa'=>1122] , ['region'=> [ [4,14,13,16]] ]);

      // Sombrear celdas
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] , ['region'=> [ [12,4,12,13]] ]);
      $CN->def_cuadro_save() ; // grabar la estructura del cuadro en la base


      // DEFINIR mapa_cuadro DEL CUADRO

      $CN->mapacuadro_store_c_mapa ( 121, [121],'especial ATDI cuadro 3') ;
      $CN->mapacuadro_store_c_mapa ( 122, [122],'especial N. Inicial cuadro 3') ;
      $CN->mapacuadro_store_c_mapa ( 123, [123],'especial N. Primario cuadro 3') ;
      $CN->mapacuadro_store_c_mapa ( 131, [131,171],'especial Formacion Integral cuadro 3') ;
      $CN->mapacuadro_store_c_mapa (1122, [121,122,123,131 ,171],'especial totales cuadro 3') ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'especial-cuadro 3, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => 'Nivel Inicial / 1° Ciclo ATDI / Varón ',
                                      '3' => 'Nivel Inicial / 1° Ciclo ATDI / Mujer ',
                                      '4' => 'Nivel Inicial / 2° Ciclo / Varón ',
                                      '5' => 'Nivel Inicial / 2° Ciclo / Mujer ',
                                      '6' => 'Nivel Primario / 1° Ciclo / Varón ',
                                      '7' => 'Nivel Primario / 1° Ciclo / Mujer ',
                                      '8' => 'Nivel Primario / 2° Ciclo / Varón ',
                                      '9' => 'Nivel Primario / 2° Ciclo / Mujer ',
                                      '10' => 'Formación Integral / Ciclo Básico / Varón ',
                                      '11' => 'Formación Integral / Ciclo Básico / Mujer ',
                                      '12' => 'Formación Integral / Ciclo Superior / Varón ',
                                      '13' => 'Formación Integral / Ciclo Superior / Mujer ',
                                      '14' => 'Total / Varón ',
                                      '15' => 'Total / Mujer ',
                                      '16' => 'Total '
                                    ]
                          ],
                'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
                'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
                'msg3' => '',    
                'descripcion' => 'especial-cuadro 3, Suma de columna xxx <> Total'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [14,15,16] ] ,
              'cmp2' => ['scol' => [[2,4,6,8,10,12],[3,5,7,9,11,13],[14,15] ]] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'especial -cuadro 3, Total  varon x fila <> suma de varónes'
            ] );
      $CN->consistencia_save(
            [

              'numero' => 4,
              'c_tipo_consistencia' => 11, // cuadros dependientes
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['cua' => [4,6,9] ] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => '',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'especial-cuadro 3, control de cuadros dependientes'
            ] ); 

      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas


//
//    // ESPECIAL - cuadro 4, ALUMNOS DE FORMACIÓN INTEGRAL EN SEDE COMPARTIDOS CON OTRA ESCUELA.
//


      $ncuadro=4;
      $F->def_formulario_add_cuadro  ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'ALUMNOS DE FORMACIÓN INTEGRAL EN SEDE COMPARTIDOS CON OTRA ESCUELA.',
              'descripcion'=>'matrícula duplicda de formación integral en sede',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>2, // puede NO que TENER DATOS
              'ancho'=>528,
              'filas'=>3,
              'columnas'=>8
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,3,8]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Alumnos de Formación Integral compartidos','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Ciclo Básico','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ciclo Superior','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>3, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      //filas 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,2],[2,4],[2,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,3],[2,5],[2,7]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,8]] ]);

      //filas 3
      $CN->def_cuadro_store(['valor_inicial'=>'Si su escuela comparte alumnos con un CFI, indique la cantidad de Estudiantes que está compartiendo',
                            'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);


      // AREA DE DATOS

      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>131] , ['region'=> [ [3,2,3,8]] ]);


      $CN->def_cuadro_save() ; // grabar la estructura del cuadro en la base


      // DEFINIR mapa_cuadro DEL CUADRO

      $CN->mapacuadro_store_c_mapa ( 131, [131,171],    'especial formación integral cuadro 4') ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [8] ] ,
              'cmp2' => ['col' => [6,7] ] ,
              'cmp3' => '',
              'msg1' => 'El total ',
              'msg2' => 'es distinto de total varón + total mujer',
              'msg3' => '',    
              'descripcion' => 'especial -cuadro 4, Total x fila <> suma de varón + mujer'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [6] ] ,
              'cmp2' => ['col' => [2,4] ] ,
              'cmp3' => '',
              'msg1' => 'El total de varones',
              'msg2' => 'es distinto de la suma de los varones',
              'msg3' => '',    
              'descripcion' => 'especial -cuadro 4, Total varón x fila <> suma de varón'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 13, //Comparaciones en fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => ['col' => [7] ] ,
              'cmp2' => ['col' => [3,5] ] ,
              'cmp3' => '',
              'msg1' => 'El total de mujeres ',
              'msg2' => 'es distinto de la suma de mujeres',
              'msg3' => '',    
              'descripcion' => 'especial -cuadro 4, Total mujer x fila <> suma de mujeres'
            ] );

      $CN->consistencia_save( 
            [
              'numero' =>4,
              'c_tipo_consistencia' => 26, // consistencia de comparacion de columnas de dos de  de cuadros
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [ 'cols'=> [[2,10],[3,11],[4,12],[5,13]], // columnas a comparar si no se envia se comparan todas las columnas (opcional)
                          'fils'=> [[3,13]], // columnas a comparar si no se envia se comparan todas las columnas (opcional)
                        ], 
              'cmp2' => [ 'cuadro' =>3, // numero de cuadro con el que se compara
                          'cmp' =>'>', // tipo de comparación
                        ],
              'cmp3' => [ //'tcol' =>[], // filas con texto para el mesaje 
                          //'tfil' =>[], // columnas con texto para el mensaje
                          'textc' =>['Ciclo Básico / Varón','Ciclo Básico / Mujer','Ciclo Superior / Varón','Ciclo Superior / Mujer'], // texto de las columnas (opcional) para el mensaje
                          //'textf'=>['','','',''], // texto de las filas (opcional) para el mensaje'
                          
                        ],
                        // estructura del mensage =  msg1 . tfil .'-'. tcol .v1. msg2 . v2
              'msg1' => 'Los alumnos compartidos de F. Integral de  ',  
              'msg2' => 'superan los alumnos matriculados del cuadro 3',
              'msg3' => '',    
              'descripcion' => 'especial-cuadro 11, control de egresados<=matricula'
            ] );

      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas


// //     
// //    ESPECIAL - Cuadro 5 -ALUMNOS MATRICULADOS EN ORIENTACION MANUAL Y PRE-TALLER (EN SEDE).
// //     


      $ncuadro=5;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'ALUMNOS MATRICULADOS EN ORIENTACION MANUAL Y PRE-TALLER (EN SEDE).',
              'descripcion'=>'matrícula ORIENTACION MANUAL Y PRE-TALLER',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>2, // puede NO que TENER DATOS   1 , // tiene que TENER DATOS
              'filas'=>5,
              'ancho'=>430,
              'columnas'=>5
            ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,5,5]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>''          , 'rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Alumnos'   , 'colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Secciones' , 'rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,5]] ]);


      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,4]] ]);
      //filas 3 y 4
      $CN->def_cuadro_store(['valor_inicial'=>'Orientación Manual'          , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Pre-Taller (Pre-Profesional)', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total'                       , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);


      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>136] , ['region'=> [ [3,2,5,5]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'total_calculado','c_mapa'=>136] , ['region'=> [ [3,4,5,4]] ]);

      $CN->def_cuadro_store(['c_mapa'=>136]  , ['region'=> [ [3,2,3,5]] ]);
      $CN->def_cuadro_store(['c_mapa'=>136]  , ['region'=> [ [4,2,4,5]] ]); //cambió dino y sylvina 16/12/2020, transf. de especial (era 138 paso a 170 talleres de formacion integ.)
      $CN->def_cuadro_store(['c_mapa'=>1136] , ['region'=> [ [5,2,5,5]] ]);

   

      $CN->def_cuadro_save() ;


      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 136, [136,170],     'especial cuadro 5') ;
//      $CN->mapacuadro_store_c_mapa ( 138, [138],     'especial cuadro 5') ;
      $CN->mapacuadro_store_c_mapa (1136, [136,170], 'especial cuadro 5') ;  //  cambió dino y sylvina 16/12/2020, transf. de especial (incluía la 138 y paso a 170 talleres de formacion integ.)



      // DEFINIR CONSISTENCIAS


      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'especial-cuadro 5, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => 'Varón ',
                                      '3' => 'Mujer ',
                                      '4' => 'Total ',
                                      '5' => 'Secciones '
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'especial-cuadro 5, Suma de columna xxx <> Total'
            ] ); 

      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 14, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1 , // Consistencia activa
              'cmp1' => ['col'=>[4] ] ,
              'cmp2' => ['scol'=>[[2,3]]] ,
              'cmp3' => [],
              'msg1' => '', 
              'msg2' => '', 
              'msg3' => '',    
              'descripcion' => 'especial-cuadro 5 calcula Suma de columna xxx totales'
            ] );                                           

      $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas




//
//  ESPECIAL - cuadro 6, ALUMNOS POR SEXO NO BINARIO EN LOS NIVELES INICIAL, PRIMARIO Y FORMACIÓN INTEGRAL (EN SEDE)
//

      $ncuadro=6;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'ALUMNOS POR SEXO NO BINARIO EN LOS NIVELES INICIAL, PRIMARIO Y FORMACIÓN INTEGRAL (EN SEDE)',
              'descripcion'=>'ALUMNOS POR SEXO NO BINARIO EN LOS NIVELES INICIAL, PRIMARIO Y FORMACIÓN INTEGRAL (EN SEDE)',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // obligatorio DATOS
              'indicaciones'=>'Nota: En concordancia con decreto DCTO-2021-476-APN-PTE.',                                                                                            
              'ancho'=>500,
              'filas'=>5,
              'columnas'=>5 
            ]);
          
      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir
          
      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,5,5]] ]);
          
      // TITULOS DE FILAS
          
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'SEXO','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Inicial 1º Ciclo ATDI' , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Inicial 2º Ciclo'      , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Primario'    , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Formación Integral', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,5]] ]);
          
      //filas 2 a 5
      $CN->def_cuadro_store(['valor_inicial'=>'Masculino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Femenino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'X (no binario)', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
          
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
          
          
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>121] , ['region'=> [ [2,2,5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>122] , ['region'=> [ [2,3,5,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>123] , ['region'=> [ [2,4,5,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>131] , ['region'=> [ [2,5,5,5]] ]);
      
      
      $CN->def_cuadro_save() ;


      // DEFINIR mapa_cuadro DEL CUADRO

      $CN->mapacuadro_store_c_mapa ( 121, [121],'especial ATDI cuadro 6') ;
      $CN->mapacuadro_store_c_mapa ( 122, [122],'especial N. Inicial 2ºciclo cuadro 6') ;
      $CN->mapacuadro_store_c_mapa ( 123, [123],'especial N. Primario cuadro 6') ;
      $CN->mapacuadro_store_c_mapa ( 131, [131,171],'especial Formacion Integral cuadro 6') ;
      //$CN->mapacuadro_store_c_mapa (1122, [121,122,123,131 ,171],'especial totales cuadro 6') ;

          
      // DEFINIR CONSISTENCIAS
          
      $CN->consistencia_save( 
            [
              'numero' =>  1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'ESPECIAL cuadro 6, ingresar datos no 0 or on'
            ] );
            
      $CN->consistencia_save( 
            [
              'numero' =>  2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1 , // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => 'Nivel Inicial 1º ciclo ATDI',
                                      '3' => 'Nivel Primario 2º ciclo',
                                      '4' => 'Nivel Primario ',
                                      '5' => 'Formación Integral ',
                                  ]
                        ],
              'msg1' => 'La suma de la columna Alumnos de ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'ESPECIAL cuadro 6, Suma de columna xxx <> Total'
            ] );                      
                      
      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 25, // consistencia de comparacion menor val1, val1_1,val1_2 < val2
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
                        // celdas a comparar del cuadro
              'cmp1' =>   [ 'v1'=> [  [[[ 5,2]] ], // Nivel Inicial 1º ciclo ATDI
                                      [[[ 5,3]] ], // Nivel Inicial 2º ciclo
                                      [[[ 5,4]] ], // Nivel Primario
                                      [[[ 5,5]] ], // Formación Integral

                                    ]
                          ], 
              'cmp2' =>  [  'v2'=>[   // celdas de otros cuadros a sumar para la comparación
                                    ['reg'=>[[3,0,2,0,3]]],  // N. inicial 1º ciclo ATDI
                                    ['reg'=>[[3,0,4,0,5]]],  // N. inicial 2º ciclo
                                    ['reg'=>[[3,0,6,0,9]]],  // N. primario
                                    ['reg'=>[[3,0,10,0,13]]],// F. Integral
                                  ],
                            'sig'=>'!=',
                          ],
              'cmp3' => [ 'd1'=>  [
                                    [ 'Nivel Inicial 1º ciclo ATDI'],
                                    [ 'Nivel Inicial 2º ciclo'],
                                    [ 'N. Primario'],
                                    [ 'Form. Integral'],
                                    ],                              
                          'd2'=>  [
                                    ['3'],
                                    ['3'],
                                    ['3'],
                                    ['3'],
                                  ]
                          ],
              'msg1' => 'El total de alumnos de ',
              'msg2' => ' es distintos de lo informados en cuadro ',
              'msg3' => '',    
              'descripcion' => 'ESPECIAL cuadro 6, comparacion de alumnos diferentes'
            ] );
                      
      $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas
        


// //
// //    ESPECIAL - Cuadro 7 -  ALUMNOS MATRICULADOS, DISMINUIDOS FÍSICOS IMPEDIDOS DE CONCURRIR AL SERVICIO ORDINARIO
// //                             , DOMICILIARIOS Y HOSPITALARIOS


      $ncuadro=7;
      $F->def_formulario_add_cuadro  ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'ALUMNOS MATRICULADOS, DISMINUIDOS FÍSICOS IMPEDIDOS DE CONCURRIR AL SERVICIO ORDINARIO, DOMICILIARIOS Y HOSPITALARIOS',
              'descripcion'=>'matrícula DOMICILIARIOS Y HOSPITALARIOS',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // tiene que TENER DATOS
              'ancho'=>600,
              'filas'=>8,
              'columnas'=>19]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,8,19]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Atención:'        ,'rowspan'=>3,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Procede de Educación Común'    ,'colspan'=>6,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Procede de Educación Especial' ,'colspan'=>6,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,9]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Procede de Educación Adultos'  ,'colspan'=>4,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,15]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total'            ,'rowspan'=>3,'colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,19]] ]);
      
      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Inicial'     , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,3]] ]); //comun
      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Primario'    , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,5]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Secundario'  , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,7]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Inicial'     , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,9]] ]); //especial
      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Primario'    , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,11]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Formación Integral', 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,13]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Primario'    , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,15]] ]); //adultos
      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Secundario'  , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,17]] ]);

      // fila 3
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[3,3],[3,5],[3,7],[3, 9],[3,11],[3,13],[3,15],[3,17]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[3,4],[3,6],[3,8],[3,10],[3,12],[3,14],[3,16],[3,18]] ]);



      //filas  4,5,6,7
      $CN->def_cuadro_store(['valor_inicial'=>'Domiciliarios','rowspan'=>2,'colspan'=>1,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Hospitalarios','rowspan'=>2,'colspan'=>1,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Permanentes'  ,'rowspan'=>1,'colspan'=>1,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,2],[6,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Transitorios' ,'rowspan'=>1,'colspan'=>1,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,2],[7,2]] ]);

      // fila 8
      $CN->def_cuadro_store(['valor_inicial'=>'Total'        ,'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[8,1]] ]);
      
 
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>152] , ['region'=> [ [4, 3,8, 4]] ]); //Hosp y Dom:comun-inicial
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>153] , ['region'=> [ [4, 5,8, 6]] ]); //Hosp y Dom:comun-Prim
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>154] , ['region'=> [ [4, 7,8, 8]] ]); //Hosp y Dom:comun-Secund

      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>155] , ['region'=> [ [4, 9,8,10]] ]); //Hosp y Dom:esp-inicial
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>156] , ['region'=> [ [4,11,8,12]] ]); //Hosp y Dom:esp-Prim
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>157] , ['region'=> [ [4,13,8,14]] ]); //Hosp y Dom:esp-N. Sec/F. Integral

      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>158] , ['region'=> [ [4,15,8,16]] ]); //Hosp y Dom:adu-Prim
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>159] , ['region'=> [ [4,17,8,18]] ]); //Hosp y Dom:adu-Sec.

      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'total_calculado','c_mapa'=>1155 ] , ['region'=> [ [4,19,8,19]] ]);


      $CN->def_cuadro_save() ;


      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 152, [152],    'especial cuadro 7') ;
      $CN->mapacuadro_store_c_mapa ( 153, [153],    'especial cuadro 7') ;
      $CN->mapacuadro_store_c_mapa ( 154, [154],    'especial cuadro 7') ;
      $CN->mapacuadro_store_c_mapa ( 155, [155],    'especial cuadro 7') ;
      $CN->mapacuadro_store_c_mapa ( 156, [156],    'especial cuadro 7') ;
      $CN->mapacuadro_store_c_mapa ( 157, [157],    'especial cuadro 7') ;
      $CN->mapacuadro_store_c_mapa ( 158, [158],    'especial cuadro 7') ;
      $CN->mapacuadro_store_c_mapa ( 159, [159],    'especial cuadro 7') ;

      $CN->mapacuadro_store_c_mapa (1155, [152,153,154,155,156,157,158,159],'especial cuadro 7') ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save(
            [
              'numero' =>  1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'especial-cuadro 5, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' =>  2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1 , // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   
                                    '3' =>  'Ed. Común / Nivel Inicial / Varón ',
                                    '4' =>  'Ed. Común / Nivel Inicial / Mujer ',
                                    '5' =>  'Ed. Común / Nivel Primario / Varón ',
                                    '6' =>  'Ed. Común / Nivel Primario / Mujer ',
                                    '7' =>  'Ed. Común / Nivel Secundario / Varón ',
                                    '8' =>  'Ed. Común / Nivel Secundario / Mujer ',
                                    '9' =>  'Ed. Especial / Nivel Inicial / Varón ',
                                    '10' =>  'Ed. Especial / Nivel Inicial / Mujer ',
                                    '11' =>  'Ed. Especial / Nivel Primario / Varón ',
                                    '12' =>  'Ed. Especial / Nivel Primario / Mujer ',
                                    '13' =>  'Ed. Especial / Formación Integral / Varón ',
                                    '14' =>  'Ed. Especial / Formación Integral / Mujer ',
                                    '15' =>  'Ed. Adultos / Nivel Primario / Varón ',
                                    '16' =>  'Ed. Adultos / Nivel Primario / Mujer ',
                                    '17' =>  'Ed. Adultos / Nivel Secundario / Varón ',
                                    '18' =>  'Ed. Adultos / Nivel Secundario / Mujer '
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'especial-cuadro 7, Suma de columna xxx <> Total'
            ] );                      

      $CN->consistencia_save( 
            [
              'numero' =>  3,
              'c_tipo_consistencia' => 14, //totales x fila
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1 , // Consistencia activa
              'cmp1' => ['col'=>[19] ] ,
              'cmp2' => ['scol'=>[[3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]]] ,
              'cmp3' => [],
              'msg1' => '', //  'Total de las modalidades',
              'msg2' => '', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'especial-cuadro 7, calcula Suma de columna xxx totales'
            ] );    

      $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas            


// //
// //     ESPECIAL - Cuadro 8 - ALUMNOS MATRICULADOS EN PROPUESTAS DE INCLUSIÓN SEGÚN MODALIDAD Y NIVEL.
// //

      $ncuadro=8;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                                              'nombre'=>'ALUMNOS MATRICULADOS EN PROPUESTAS DE INCLUSIÓN SEGÚN MODALIDAD Y NIVEL.',
                                              'descripcion'=>'matrícula de niveles en INCLUSIÓN',
                                              'c_tipo_cuadro'=>1,
                                              'c_criterio_completitud'=>1 , // debe TENER DATOS
                                              'ancho'=>1122,
                                              'filas'=>12,
                                              'columnas'=>16]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,12,16]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Discapacidad / Trastorno'                    ,'rowspan'=>3,'colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Común'                                       ,'rowspan'=>1,'colspan'=>6,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Adultos'                                     ,'rowspan'=>1,'colspan'=>4,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Formación Profesional (C.F.P)'               ,'rowspan'=>2,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,12]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Residencia Laboral / Pasantías / artística'  ,'rowspan'=>2,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,14]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total'                                       ,'rowspan'=>3,'colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,16]] ]);
      
      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Inicial'     , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,2]] ]); //comun
      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Primario'    , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Secundario'  , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,6]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Primario'    , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,8]] ]); //adultos
      $CN->def_cuadro_store(['valor_inicial'=>'Nivel Secundario'  , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,10]] ]);

      // fila 3
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[3,2],[3,4],[3,6],[3,8],[3,10],[3,12],[3,14]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>[[3,3],[3,5],[3,7],[3,9],[3,11],[3,13],[3,15]] ]);


      //filas 4 a 12
      $CN->def_cuadro_store(['valor_inicial'=>'Discapacidad auditiva (sordera e hipoacusia)'              , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Discapacidad visual'                                       , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Sordo - ceguera'                                           , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Discapacidad motora'                                       , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[7,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Alteraciones en el desarrollo y la constitución subjetiva' , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[8,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Discapacidad intelectual'                                  , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[9,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Trastornos específicos del lenguaje'                       , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[10,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Discapacidad múltiple'                                     , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[11,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total'                                                     , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[12,1]] ]);


      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>134] , ['region'=> [ [4,2,12,15]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'total_calculado','c_mapa'=>134] , ['region'=> [ [4,16,12,16]] ]);


      $CN->def_cuadro_save() ;


      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 134, [134],    'especial cuadro 8') ;




      // DEFINIR CONSISTENCIAS


      $CN->consistencia_save( 
            [
              'numero' => 1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' => 2, // Consistencia inactiva
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'especial-cuadro 8, ingresar datos no 0 or on'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'numero' => 2, 
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => 'Común / Nivel Inicial / Varón ',
                                      '3' => 'Común / Nivel Inicial / Mujer ',
                                      '4' => 'Común / Nivel Primario / Varón ',
                                      '5' => 'Común / Nivel Primario / Mujer ',
                                      '6' => 'Común / Nivel Secundario / Varón ',
                                      '7' => 'Común / Nivel Secundario / Mujer ',
                                      '8' => 'Adultos / Nivel Primario / Varón ',
                                      '9' => 'Adultos / Nivel Primario / Mujer ',
                                      '10' => 'Adultos / Nivel Secundario / Varón ',
                                      '11' => 'Adultos / Nivel Secundario / Mujer ',
                                      '12' => 'Formación Profesional (C.F.P) / Varón ',
                                      '13' => 'Formación Profesional (C.F.P) / Mujer ',
                                      '14' => 'Residencia Laboral - Pasantías - artística / Varón ',
                                      '15' => 'Residencia Laboral - Pasantías - artística / Mujer ',
                                      '16' => 'Total '
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'especial-cuadro 8, Suma de columna xxx <> Total'
            ] );

      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 14, //totales de columna (total calculado)
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1 , // Consistencia activa
              'cmp1' => ['col'=>[16] ] ,
              'cmp2' => ['scol'=>[[2,3,4,5,6,7,8,9,10,11,12,13,14,15]]] ,
              'cmp3' => [],
              'msg1' => '', 
              'msg2' => '', 
              'msg3' => '',    
              'descripcion' => 'especial-cuadro 7 calcula Suma de columna xxx totales'
            ] );


        $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas    






//
//     ESPECIAL - cuadro 9, ALUMNOS SEGÚN RÉGIMEN DE TURNO EN LOS NIVELES INICIAL, PRIMARIO Y FORMACIÓN INTEGRAL (EN SEDE)
//

        $ncuadro=9;
        $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                                                'nombre'=>'ALUMNOS SEGÚN RÉGIMEN DE TURNO EN LOS NIVELES INICIAL, PRIMARIO Y FORMACIÓN INTEGRAL (EN SEDE).',
                                                'descripcion'=>'ALUMNOS X TURNO',
                                                'c_tipo_cuadro'=>1,
                                                'c_criterio_completitud'=>1 , // obligatorio DATOS                                              
                                                'ancho'=>400,
                                                'filas'=>9,
                                                'columnas'=>5 ]);

        $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

        // inicializar las celdas del cuadro
        $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,9,5]] ]);

        // TITULOS DE FILAS
        //fila 1

        $CN->def_cuadro_store(['valor_inicial'=>'TURNOS',             'colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'Nivel Inicial 1º ciclo ATDI', 'colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'Nivel Inicial 2º ciclo',      'colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'Nivel Primario',              'colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'Formación Integral',          'colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,5]] ]);

        //filas 2 y 9
        $CN->def_cuadro_store(['valor_inicial'=>'Mañana',     'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'Intermedio', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'Tarde',      'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);

        $CN->def_cuadro_store(['valor_inicial'=>'Vespertino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'Noche',      'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'Doble esc.', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[7,1]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'Alternado',  'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[8,1]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'Total',      'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[9,1]] ]);

          
        // AREA DE DATOS
        $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>121]  , ['region'=> [ [2,2,9,2]] ]);  
        $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>122]  , ['region'=> [ [2,3,9,3]] ]);  
        $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>123]  , ['region'=> [ [2,4,9,4]] ]);
        $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>131]  , ['region'=> [ [2,5,9,5]] ]);
        //$CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>1122] , ['region'=> [ [2,5,9,5]] ]);


        $CN->def_cuadro_save() ;

        // DEFINIR mapa_cuadro DEL CUADRO

        $CN->mapacuadro_store_c_mapa ( 121, [121],'especial N. Inicial (ATDI) cuadro 9') ;
        $CN->mapacuadro_store_c_mapa ( 122, [122],'especial N. Inicial (infantes) cuadro 9') ;
        $CN->mapacuadro_store_c_mapa ( 123, [123],'especial N. Primario cuadro 9') ;
        $CN->mapacuadro_store_c_mapa ( 131, [131,171],'especial Formacion Integral cuadro 9') ;
        //$CN->mapacuadro_store_c_mapa (1122, [121,122,123,131 ,171],'especial totales cuadro 9') ;        


        // DEFINIR CONSISTENCIAS

        $CN->consistencia_save( [
              'numero' =>  1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'especial-cuadro 9, ingresar datos no 0 or on'
              ] );


        $CN->consistencia_save( [
              'numero' =>  2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1 , // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => 'Nivel Inicial 1º ciclo ATDI',
                                      '3' => 'Nivel Inicial 2º ciclo',
                                      '4' => 'Nivel Primario',
                                      '5' => 'Formación Integral',
                                  ]
                        ],
              'msg1' => 'La suma de la columna ', //  'Total del nivel',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de los turnos.',
              'msg3' => '',    
              'descripcion' => 'especial-cuadro 9, Suma de columna xxx <> Total'
              ] );                      

        $CN->consistencia_save( [
              'numero' => 3,
              'c_tipo_consistencia' => 25, // consistencia de comparacion menor val1, val1_1,val1_2 < val2
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
                        // celdas a comparar del cuadro
              'cmp1' => ['v1'=> [ [[[ 9,2]] ], // N. Inicial 1º ciclo ATDI
                                  [[[ 9,3]] ], // N. Inicial 2º ciclo
                                  [[[ 9,4]] ], // N. Primario
                                  [[[ 9,5]] ], // F. Integral                                  
                                ]
                        ], 
              'cmp2' => ['v2'=>[   // celdas de otros cuadros a sumar para la comparación
                                  ['reg'=>[[3,0,2,0,3]]],  // N. inicial 1º ciclo ATDI
                                  ['reg'=>[[3,0,4,0,5]]],  // N. inicial 2º ciclo
                                  ['reg'=>[[3,0,6,0,9]]],  // N. primario
                                  ['reg'=>[[3,0,10,0,13]]],// F. Integral
                                ],
                          'sig'=>'!=',
                        ],
              'cmp3' => ['d1'=> [ [ 'El Total de alumnos de N. Inicial 1º ciclo ATDI'],
                                  [ 'El Total de alumnos de N. Inicial 2º ciclo'],
                                  [ 'El Total de alumnos de N. Primario'],
                                  [ 'El Total de alumnos de Form. Integral'],
                                ],                              
                        'd2'=> [
                                  ['3'],
                                  ['3'],
                                  ['3'],
                                  ['3'],
                                ]
                        ],
              'msg1' => '',
              'msg2' => 'son distintos de lo informados en cuadro ',
              'msg3' => '',    
              'descripcion' => 'especial -cuadro 9, comparacion de alumnos diferentes'
              ] );

        $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas


      $F->def_formulario_save();
        //dd($F); 
      return ($F);


}  // FORMULARIO ESPECIAL










//////////////////////////////
///////////////////////////////
//////////////////////////////
///////////////////////////////
//////////////////////////////
///////////////////////////////















static public function I2024_ARTISTICA($id_definicion_formulario)
    {

       
////////////////////////////       
//definir un nuevo formulario
//////////////////////////////
///////////////////////////////


      $F = new DefinicionFormularioController( $id_definicion_formulario);  // crear o cargar el formulario

      $F->nombre='MATRÍCULA INICIAL 2024 - EDUCACIÓN ARTÍSTICA';
      $F->nombre_corto='ED. ARTÍSTICA';
      $F->descripcion='Planilla Relevamiento Inicial 2024 de Artistica';
      $F->id_periodo='106';
      $F->color='f_marron';

      //asignar los tipo de organizacion del formulario
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'AA'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'AC'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'AD'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'AE'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'AF'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'AM'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'AP'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'AT'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'AZ'] );
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'AV'] );


     
//         
//     ARTÍSTICA cuadro 1 -> TURNOS DE FUNCIONAMIENTO
//
      $ncuadro=1;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                                              'nombre'=>'TURNOS DE FUNCIONAMIENTO',
                                              'descripcion'=>'encabezado de turnos',
                                              'c_tipo_cuadro'=>4, // de combobox
                                              'c_criterio_completitud'=>1 , //obligatorio con datos
                                              'filas'=>8,
                                              'ancho'=>247,
                                              'columnas'=>2 ]);

      
      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,8,2]] ]);

      // TITULOS DE FILAS
      $CN->def_cuadro_store(['valor_inicial'=>'TURNOS', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);

      // TITULOS DE COLUMNAS
      $CN->def_cuadro_store(['valor_inicial'=>'Mañana',            'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Intermedio',        'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Tarde',             'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Vespertino',        'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Noche',             'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Doble Escolaridad', 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[7,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Alternado',         'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[8,1]] ]);


//       // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[3,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[4,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[6,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[7,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[8,2]] ]);

      $CN->def_cuadro_save() ;


      $CN->consistencia_save( [
                                    'numero' => 1,
                                    'c_tipo_consistencia' => 10, // con datos no 0 or on
                                    'c_categoria_consistencia' =>  3, // Consistencia de Error
                                    'c_estado' =>  1, // Consistencia activa
                                    'cmp1' => [] ,
                                    'cmp2' => [] ,
                                    'cmp3' => '',
                                    'msg1' => 'Debe consignar al menos un turno',
                                    'msg2' => '',
                                    'msg3' => '',    
                                    'descripcion' => 'artistica-cuadro 1, ingresar al menos un turno'
                                    ] );

      $CN->consistencia_cantidad_x_cuadro(1); // por si hay que eliminar consistencias viejas

//
// // cuadro 2  ARTÍSTICA -> CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
//
      $ncuadro=2;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                                              'nombre'=>'CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO',
                                              'descripcion'=>'encabezado sae',
                                              'c_tipo_cuadro'=>1,
                                              'c_criterio_completitud'=>2 ,
                                              'filas'=>6,
                                              'ancho'=>465,
                                              'columnas'=>2 ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,6,2]] ]);

      // TITULOS DE FILAS
      $CN->def_cuadro_store(['valor_inicial'=>'SERVICIO', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'CANTIDAD', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);

      // TITULOS DE COLUMNAS
      $CN->def_cuadro_store(['valor_inicial'=>'Desayuno y Merienda Completa',  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Comedor',                       'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Simple',                 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Doble',                  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Completo',               'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[3,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[4,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[6,2]] ]);


      $CN->consistencia_cantidad_x_cuadro(0); // por si hay que eliminar consistencias viejas

//
//    ARTÍSTICA cuadro 3 -> CANTIDAD DE ALUMNOS DE EDUCACIÓN ESTÉTICA INFANTIL
//
      $ncuadro=3;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                                              'nombre'=>'CANTIDAD DE ALUMNOS DE EDUCACIÓN ESTÉTICA INFANTIL',
                                              'descripcion'=>'matrícula ESTÉTICA INFANTIL',
                                              'c_tipo_cuadro'=>1,
                                              'c_criterio_completitud'=>2 , // PUEDE NO TENER DATOS
                                              'filas'=>4,
                                              'ancho'=>1038,
                                              'columnas'=>13]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,13]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'AÑO','colspan'=>8,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Talleres', 'rowspan'=>2,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,9]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total',
                                            'rowspan'=>2, 'colspan'=>3, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,11]] ]);

      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'1° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,5]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'4° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,7]] ]);

      //fila 3
      $CN->def_cuadro_store(['valor_inicial'=>'Varón',
                                            'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[3,1],[3,3],[3,5],[3,7],[3,9],[3,11]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer',
                                            'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[3,2],[3,4],[3,6],[3,8],[3,10],[3,12]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[3,13]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>119] , ['region'=> [ [4,1,4,13]] ]);


      //$CN->def_cuadro_store(['c_mapa'=>119], ['region'=> [ [4,1,4,13]] ]);


      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 119, [119], 'artistica c 3') ;

              
  
      $CN->consistencia_save( [
                                    'numero' => 1,
                                    'c_tipo_consistencia' => 13, //Comparaciones en fila
                                    'c_categoria_consistencia' =>  3, // Consistencia de Error
                                    'c_estado' =>  1, // Consistencia activa
                                    'cmp1' => ['col' => [13] ] ,
                                    'cmp2' => ['col' => [11,12] ] ,
                                    'cmp3' => '',
                                    'msg1' => 'El total por año',
                                    'msg2' => 'es distinto de total varon + total mujer',
                                    'msg3' => '',    
                                    'descripcion' => 'artistica-cuadro 3, Total <> total varon + total mujer x fila'
                                    ] );
      $CN->consistencia_save( [
                                    'numero' => 2,
                                    'c_tipo_consistencia' => 13, //Comparaciones en fila
                                    'c_categoria_consistencia' =>  3, // Consistencia de Error
                                    'c_estado' =>  1, // Consistencia activa
                                    'cmp1' => ['col' => [11] ] ,
                                    'cmp2' => ['col' => [1,3,5,7,9] ] ,
                                    'cmp3' => '',
                                    'msg1' => 'El total de varones',
                                    'msg2' => 'es distinto de la suma de varones',
                                    'msg3' => '',    
                                    'descripcion' => 'artistica-cuadro 3, Total varones <> suma de varons x fila'
                                    ] );
      $CN->consistencia_save( [
                                    'numero' => 3,
                                    'c_tipo_consistencia' => 13, //Comparaciones en fila
                                    'c_categoria_consistencia' =>  3, // Consistencia de Error
                                    'c_estado' =>  1, // Consistencia activa
                                    'cmp1' => ['col' => [12] ] ,
                                    'cmp2' => ['col' => [2,4,6,8,10] ] ,
                                    'cmp3' =>  '',
                                    'msg1' => 'El total de mujeres',
                                    'msg2' => 'es distinto de la suma de mujeres',
                                    'msg3' => '',    
                                    'descripcion' => 'artistica-cuadro 3, Total mujeres <> suma de mujeres x fila'
                                    ] );

      $CN->consistencia_save( [
                                    'numero' => 4,
                                    'c_tipo_consistencia' => 11, // cuadros dependientes
                                    'c_categoria_consistencia' =>  3, // Consistencia de Error
                                    'c_estado' =>  1, // Consistencia activa
                                    'cmp1' => ['cua' => [9,10] ] ,
                                    'cmp2' => [] ,
                                    'cmp3' => '',
                                    'msg1' => '',
                                    'msg2' => '',
                                    'msg3' => '',    
                                    'descripcion' => 'ARTISTICA-cuadro 3, control de cuadros dependientes'
                                    ] ); 
            $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas 
     



//
//    ARTÍSTICA - cuadro 4-> CANTIDAD DE ALUMNOS POR CICLO DE ENSEÑANZA SEGÚN AÑO Y SEXO
//
      $ncuadro=4;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                                              'nombre'=>'CANTIDAD DE ALUMNOS POR CICLO DE ENSEÑANZA SEGÚN AÑO Y SEXO',
                                              'descripcion'=>'ALUMNOS POR CARRERA SEGÚN AÑO Y SEXO',
                                              'c_tipo_cuadro'=>2,
                                              'c_criterio_completitud'=>2 , // PUEDE NO TENER DATOS
                                              'filas'=>5,
                                              'ancho'=>1038, 
                                              'columnas'=>22]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,5,22]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'CARRERA','rowspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Prep. / Form. Básica', 'rowspan'=>2,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ciclo Inicial',
                                            'colspan'=>6, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ciclo Medio',
                                            'colspan'=>6, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,10]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Form. Básica Adolescentes y Adultos',
                                            'colspan'=>6, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,16]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'TOTAL',
                                            'rowspan'=>3, 'colspan'=>6, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,22]] ]);

      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'1° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,8]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'1° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,10]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,12]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,14]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'1° nivel','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,16]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2° nivel','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,18]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3° nivel','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,20]] ]);


      //fila 3
      $CN->def_cuadro_store(['valor_inicial'=>'Varón',
                                            'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[3,2],[3,4],[3,6],[3,8],[3,10],[3,12],
                                             [3,14],[3,16],[3,18],[3,20] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer',
                                            'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[3,3],[3,5],[3,7],[3,9],[3,11],[3,13],
                                             [3,15],[3,17],[3,19],[3,21]] ]);
      // AREA DE DATOS
      // fila 4 y 5
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['region'=> [ [4,2,5,22]] ]);
      $CN->def_cuadro_store(['editable'=>true,'tipo_dato'=>'combobox' , 'valor_inicial'=>'3'] ,  ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['c_mapa'=>120], ['celdas'=> [[4,1]] , 'region'=> [ [4,2,5,22]]]);
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'], ['region'=> [ [4,22,5,22]]]);

      // Totales
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
        



      $CN->def_cuadro_save() ;

      //$CN->def_cuadro_store(['c_mapa'=>142], ['celdas'=> [[4,5],[4,6]] ]);
      

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 120, [120], 'artistica c 4') ;

      $CN->consistencia_save( [
                            'numero' => 1,
                            'c_tipo_consistencia' => 16, //totales de columna
                            'c_categoria_consistencia' =>  3, // Consistencia de Error
                            'c_estado' =>  1, // Consistencia activa
                            'cmp1' => [] ,
                            'cmp2' => [] ,
                            'cmp3' => ['tit' => [   '2' => 'Prep. Form. Básica / varón ',
                                                    '3' => 'Prep. Form. Básica / mujer ',
                                                    '4' => 'Ciclo Inicial / 1° año / varón ',
                                                    '5' => 'Ciclo Inicial / 1° año / mujer ',
                                                    '6' => 'Ciclo Inicial / 2° año / varón ',
                                                    '7' => 'Ciclo Inicial / 2° año / mujer ',
                                                    '8' => 'Ciclo Inicial / 3° año / varón ',
                                                    '9' => 'Ciclo Inicial / 3° año / mujer ',
                                                    '10' => 'Ciclo Medio / 1° año / varón ',
                                                    '11' => 'Ciclo Medio / 1° año / mujer ',
                                                    '12' => 'Ciclo Medio / 2° año / varón ',
                                                    '13' => 'Ciclo Medio / 2° año / mujer ',
                                                    '14' => 'Ciclo Medio / 3° año / varón ',
                                                    '15' => 'Ciclo Medio / 3° año / mujer ',

                                                    '16' => 'Form. Básica / 1° nivel / varón ',
                                                    '17' => 'Form. Básica / 1° nivel / mujer ',
                                                    '18' => 'Form. Básica / 2° nivel / varón ',
                                                    '19' => 'Form. Básica / 2° nivel / mujer ',
                                                    '20' => 'Form. Básica / 3° nivel / varón ',
                                                    '21' => 'Form. Básica / 3° nivel / mujer ',
                                                    '22' => 'Total '
                                                ]
                                      ],
                            'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
                            'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
                            'msg3' => '',    
                            'descripcion' => 'artistica-cuadro 4, Suma de columna xxx <> Total'
                            ] );
                            
      $CN->consistencia_save( [
                            'numero' => 2,
                            'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
                            'c_categoria_consistencia' =>  3, // Consistencia de Error
                            'c_estado' =>  1, // Consistencia activa
                            'cmp1' => ['col' => [22] ] ,
                            'cmp2' => ['scol' => [[2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21] ]] ,
                            'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
                            'descripcion' => 'especial -cuadro 4, Total   x fila <> suma'
                            ] );
  
     // $CN->consistencia_save( [
     //                                'numero' => 3,
     //                                'c_tipo_consistencia' => 13, //Comparaciones en fila
     //                                'c_categoria_consistencia' =>  3, // Consistencia de Error
     //                                'c_estado' =>  1, // Consistencia activa
     //                                'cmp1' => ['col' => [22] ] ,
     //                                'cmp2' => ['col' => [2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21] ] ,
     //                                'cmp3' => '',
     //                                'msg1' => 'El total de la carrera',
     //                                'msg2' => 'es distinto de suma de sus ciclos / años ',
     //                                'msg3' => '',    
     //                                'descripcion' => 'artistica-cuadro 4, Total de carrera x fila <> suma de los años de la fila'
     //                                ] );
   
      $CN->consistencia_save( [
                            'numero' => 3,
                            'c_tipo_consistencia' => 11, // cuadros dependientes
                            'c_categoria_consistencia' =>  3, // Consistencia de Error
                            'c_estado' =>  1, // Consistencia activa
                            'cmp1' => ['cua' => [9,10] ] ,
                            'cmp2' => [] ,
                            'cmp3' => '',
                            'msg1' => '',
                            'msg2' => '',
                            'msg3' => '',    
                            'descripcion' => 'ARTISTICA-cuadro 3, control de cuadros dependientes'
                            ] ); 

        $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas   
   



//
//    ARTÍSTICA - cuadro 5 -> CANTIDAD DE ALUMNOS POR CARRERA SEGÚN AÑO Y SEXO
//
      $ncuadro=5;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                                              'nombre'=>'CANTIDAD DE ALUMNOS POR CARRERA SEGÚN AÑO Y SEXO',
                                              'descripcion'=>'ALUMNOS POR CARRERA SEGÚN AÑO Y SEXO',
                                              'c_tipo_cuadro'=>2,
                                              'c_criterio_completitud'=>2 , // PUEDE NO TENER DATOS
                                              'filas'=>5,
                                              'ancho'=>1038, 
                                              'columnas'=>12]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,5,12]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'CARRERA','rowspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Tecnicaturas y Profesorados', 'colspan'=>8,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'TOTAL',
                                            'rowspan'=>2, 'colspan'=>3, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,10]] ]);

      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'1° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'4° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,8]] ]);

    
      //fila 3
      $CN->def_cuadro_store(['valor_inicial'=>'Varón',
                                            'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[3,2],[3,4],[3,6],[3,8],[3,10] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer',
                                            'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[3,3],[3,5],[3,7],[3,9],[3,11] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[3,12]] ]);

      // AREA DE DATOS
      // fila 4 y 5
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['region'=> [ [4,2,5,12]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'23', 'editable'=>true,'tipo_dato'=>'combobox'] ,  ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['c_mapa'=>115] , [ 'celdas'=> [[4,1]],'region'=> [ [4,2,5,12]] ]);
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [4,10,5,12]] ]);
      // Totales
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);

      
      



      $CN->def_cuadro_save() ;

//$CN->def_cuadro_store(['c_mapa'=>142], ['celdas'=> [[4,5],[4,6]] ]);
      
      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 115, [115], 'artistica c 5') ;


      $CN->consistencia_save( [
                            'numero' => 1,
                            'c_tipo_consistencia' => 16, //totales de columna
                            'c_categoria_consistencia' =>  3, // Consistencia de Error
                            'c_estado' =>  1, // Consistencia activa
                            'cmp1' => [] ,
                            'cmp2' => [] ,
                            'cmp3' => ['tit' => [   '2' => '1° año / varón ',
                                                    '3' => '1° año / mujer ',
                                                    '4' => '2° año / varón ',
                                                    '5' => '2° año / mujer ',
                                                    '6' => '3° año / varón ',
                                                    '7' => '3° año / mujer ',
                                                    '8' => '4° año / varón ',
                                                    '9' => '4° año / mujer ',
                                                    '10' => 'Total / varón ',
                                                    '11' => 'Total / mujer ',
                                                    '12' => 'Total / total '
                                                ]
                                      ],
                            'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
                            'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
                            'msg3' => '',    
                            'descripcion' => 'artistica-cuadro 5, Suma de columna xxx <> Total'
                            ] );
      $CN->consistencia_save( [
                            'numero' => 2,
                            'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
                            'c_categoria_consistencia' =>  3, // Consistencia de Error
                            'c_estado' =>  1, // Consistencia activa
                            'cmp1' => ['col' => [10,11,12 ] ],
                            'cmp2' => ['scol' => [[2,4,6,8],[3,5,7,9],[10,11] ]] ,
                            'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
                            'descripcion' => 'especial -cuadro 5, Total   x fila <> suma'
                ] );
      $CN->consistencia_save( [
                            'numero' => 3,
                            'c_tipo_consistencia' => 11, // cuadros dependientes
                            'c_categoria_consistencia' =>  3, // Consistencia de Error
                            'c_estado' =>  1, // Consistencia activa
                            'cmp1' => ['cua' => [9,10] ] ,
                            'cmp2' => [] ,
                            'cmp3' => '',
                            'msg1' => '',
                            'msg2' => '',
                            'msg3' => '',    
                            'descripcion' => 'ARTISTICA-cuadro 3, control de cuadros dependientes'
                            ] );       

// $CN->consistencia_save( [
//                                     'numero' =>  3,
//                                     'c_tipo_consistencia' => 13, //Comparaciones en fila
//                                     'c_categoria_consistencia' =>  3, // Consistencia de Error
//                                     'c_estado' =>  1, // Consistencia activa
//                                     'cmp1' => ['col' => [12] ] ,
//                                     'cmp2' => ['col' => [10,11] ] ,
//                                     'cmp3' => '',
//                                     'msg1' => 'El total ',
//                                     'msg2' => 'es distinto de suma de sus total varón + total mujer ',
//                                     'msg3' => '',    
//                                     'descripcion' => 'artistica-cuadro 5, Total de carrera x fila <> suma de los años de la fila'
//                                     ] );
  
//      $CN->consistencia_save( [
//                                    'numero' =>  4,
//                                     'c_tipo_consistencia' => 13, //Comparaciones en fila
//                                     'c_categoria_consistencia' =>  3, // Consistencia de Error
//                                     'c_estado' =>  1, // Consistencia activa
//                                     'cmp1' => ['col' => [10] ] ,
//                                     'cmp2' => ['col' => [2,4,6,8] ] ,
//                                     'cmp3' => '',
//                                     'msg1' => 'El total varón ',
//                                     'msg2' => 'es distinto de suma de varones x año ',
//                                     'msg3' => '',    
//                                     'descripcion' => 'artistica-cuadro 5, Total varón de carrera x fila <> suma de los varones x años de la fila'
//                                     ] );
// $CN->consistencia_save( [
//                                     'numero' => 5,
//                                     'c_tipo_consistencia' => 13, //Comparaciones en fila
//                                     'c_categoria_consistencia' =>  3, // Consistencia de Error
//                                     'c_estado' =>  1, // Consistencia activa
//                                     'cmp1' => ['col' => [11] ] ,
//                                     'cmp2' => ['col' => [3,5,7,9] ] ,
//                                     'cmp3' => '',
//                                     'msg1' => 'El total mujer ',
//                                     'msg2' => 'es distinto de suma de mujeres x año ',
//                                     'msg3' => '',    
//                                     'descripcion' => 'artistica-cuadro 5, Total mujer de la carrera x fila <> suma de los mujeres x años de la fila'
//                                     ] );

            $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas

//
//     ARTÍSTICA cuadro 6 -> CANTIDAD DE ALUMNOS POR CURSO SEGÚN AÑO Y SEXO
//
      $ncuadro=6;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                                              'nombre'=>'CANTIDAD DE ALUMNOS POR CURSO SEGÚN AÑO Y SEXO',
                                              'descripcion'=>'ALUMNOS POR CURSO SEGÚN AÑO Y SEXO',
                                              'c_tipo_cuadro'=>2,
                                              'c_criterio_completitud'=>2 , // PUEDE NO TENER DATOS
                                              'filas'=>4,
                                              'ancho'=>1038, 
                                              'columnas'=>12]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false,
                                        'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,12]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'CURSOS','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1',
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
               
      $CN->def_cuadro_store(['valor_inicial'=>'1° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1',
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'4° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'TOTALES','colspan'=>3, 'titulo'=>true,'estilos'=>'titulo1',
                                        'tipo_dato'=>'text'], ['celdas'=>[[1,10]] ]);

    
      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                                        ['celdas'=> [[2,2],[2,4],[2,6],[2,8],[2,10] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], 
                                        ['celdas'=> [[2,3],[2,5],[2,7],[2,9],[2,11] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                                        ['celdas'=> [[2,12]] ]);

      // AREA DE DATOS
      // fila 3 y 4
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['region'=> [ [3,2,4,12]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'5', 'editable'=>true,'tipo_dato'=>'combobox'] ,  ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['c_mapa'=>119], [ 'celdas'=> [[3,1]] ,'region'=> [ [3,2,4,12]] ]);
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,10,4,12]] ]);
      // Totales
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'],
                                        ['celdas'=> [[4,1]] ]);
      

      $CN->def_cuadro_save() ;



      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 119, [119], 'artistica c 6') ;


      $CN->consistencia_save( [
                            'numero' => 1,
                            'c_tipo_consistencia' => 16, //totales de columna
                            'c_categoria_consistencia' =>  3, // Consistencia de Error
                            'c_estado' =>  1, // Consistencia activa
                            'cmp1' => [] ,
                            'cmp2' => [] ,
                            'cmp3' => ['tit' => [   '2' => '1° año / varón ',
                                                    '3' => '1° año / mujer ',
                                                    '4' => '2° año / varón ',
                                                    '5' => '2° año / mujer ',
                                                    '6' => '3° año / varón ',
                                                    '7' => '3° año / mujer ',
                                                    '8' => '4° año / varón ',
                                                    '9' => '4° año / mujer ',
                                                    '10' => 'Total / varón ',
                                                    '11' => 'Total / mujer ',
                                                    '12' => 'Total / total '
                                                ]
                                      ],
                            'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
                            'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
                            'msg3' => '',    
                            'descripcion' => 'artistica-cuadro 6, Suma de columna xxx <> Total'
                            ] );
                           
      $CN->consistencia_save( [
                           'numero' => 2,
                            'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
                            'c_categoria_consistencia' =>  3, // Consistencia de Error
                            'c_estado' =>  1, // Consistencia activa
                            'cmp1' => ['col' => [10,11,12 ] ],
                            'cmp2' => ['scol' => [[2,4,6,8],[3,5,7,9],[10,11] ]] ,
                            'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
                            'descripcion' => 'especial -cuadro 6, Total   x fila <> suma'
                            ] );
                           
      $CN->consistencia_save( [
                            'numero' => 3,
                            'c_tipo_consistencia' => 11, // cuadros dependientes
                            'c_categoria_consistencia' =>  3, // Consistencia de Error
                            'c_estado' =>  1, // Consistencia activa
                            'cmp1' => ['cua' => [9,10] ] ,
                            'cmp2' => [] ,
                            'cmp3' => '',
                            'msg1' => '',
                            'msg2' => '',
                            'msg3' => '',    
                            'descripcion' => 'ARTISTICA-cuadro 3, control de cuadros dependientes'
                            ] );       

      $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas


    
   



//
//    ARTÍSTICA cuadro 7 -> CANTIDAD DE ALUMNOS MATRICULADOS EN TRAYECTOS PRE-PROFESIONALES ARTÍSTICOS (T.P.P.) POR AÑO Y SEXO SEGÚN ESPECIALIDAD
//       

      $ncuadro=7;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                                              'nombre'=>'CANTIDAD DE ALUMNOS MATRICULADOS EN TRAYECTOS PRE-PROFESIONALES ARTÍSTICOS (T.P.P.) POR AÑO Y SEXO SEGÚN ESPECIALIDAD',
                                              'descripcion'=>'ALUMNOS EN (T.P.P.) POR AÑO Y SEXO SEGÚN ESPECIALIDAD',
                                              'c_tipo_cuadro'=>2,
                                              'c_criterio_completitud'=>2 , // PUEDE NO TENER DATOS
                                              'filas'=>4 ,
                                              'ancho'=>1038, 
                                              'columnas'=>10]);


      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false,
                                        'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,10]] ]);



      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Especialidad','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);               
      $CN->def_cuadro_store(['valor_inicial'=>'1° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'TOTALES', 'colspan'=>3, 'titulo'=>true,'estilos'=>'titulo1',
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);

    
      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], 
                                        ['celdas'=> [[2,2],[2,4],[2,6],[2,8] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], 
                                        ['celdas'=> [[2,3],[2,5],[2,7],[2,9] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], 
                                        ['celdas'=> [[2,10]] ]);

      // AREA DE DATOS
      // fila 3 y 4
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['region'=> [ [3,2,4,10]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'6', 'editable'=>true,'tipo_dato'=>'combobox'] ,  ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['c_mapa'=>119] , [ 'celdas'=> [[3,1]] ,'region'=> [ [3,2,4,10]] ]);
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado' ] , ['region'=> [ [3,8,4,10]] ]);

      // Totales
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], 
                                        ['celdas'=> [[4,1]] ]);
      


      $CN->def_cuadro_save() ;


      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 119, [119], 'artistica c 7') ;

      

      $CN->consistencia_save( [
                            'numero' => 1,
                            'c_tipo_consistencia' => 16, //totales de columna
                            'c_categoria_consistencia' =>  3, // Consistencia de Error
                            'c_estado' =>  1, // Consistencia activa
                            'cmp1' => [] ,
                            'cmp2' => [] ,
                            'cmp3' => ['tit' => [   '2' => '1° año / varón ',
                                                    '3' => '1° año / mujer ',
                                                    '4' => '2° año / varón ',
                                                    '5' => '2° año / mujer ',
                                                    '6' => '3° año / varón ',
                                                    '7' => '3° año / mujer ',
                                                    '8' => 'Total / varón ',
                                                    '9' => 'Total / mujer ',
                                                    '10' => 'Total / total '
                                                ]
                                      ],
                            'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
                            'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
                            'msg3' => '',    
                            'descripcion' => 'artistica-cuadro 7, Suma de columna xxx <> Total'
                            ] );
                            
      $CN->consistencia_save( [
                           'numero' => 2,
                            'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
                            'c_categoria_consistencia' =>  3, // Consistencia de Error
                            'c_estado' =>  1, // Consistencia activa
                            'cmp1' => ['col' => [8,9,10 ] ],
                            'cmp2' => ['scol' => [[2,4,6],[3,5,7] ,[8,9] ]] ,
                            'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
                            'descripcion' => 'especial -cuadro 7, Total   x fila <> suma'
                            ] );

      $CN->consistencia_save( [
                            'numero' => 3,
                            'c_tipo_consistencia' => 11, // cuadros dependientes
                            'c_categoria_consistencia' =>  3, // Consistencia de Error
                            'c_estado' =>  1, // Consistencia activa
                            'cmp1' => ['cua' => [9] ] ,
                            'cmp2' => [] ,
                            'cmp3' => '',
                            'msg1' => '',
                            'msg2' => '',
                            'msg3' => '',    
                            'descripcion' => 'ARTISTICA-cuadro 3, control de cuadros dependientes'
                            ] );       
            
            $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas

  
    

//
//    ARTÍSTICA cuadro 8 -> CANTIDAD DE ALUMNOS EN TRAYECTO ARTÍSTICO PROFESIONAL (TAP) POR AÑO Y SEXO SEGÚN ESPECIALIDAD
//       

      $ncuadro=8;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                                              'nombre'=>'CANTIDAD DE ALUMNOS MATRICULADOS EN TRAYECTO ARTÍSTICO PROFESIONAL (TAP) POR AÑO Y SEXO SEGÚN ESPECIALIDAD',
                                              'descripcion'=>'ALUMNOS EN (T.A.P.) POR AÑO Y SEXO SEGÚN ESPECIALIDAD',
                                              'c_tipo_cuadro'=>2,
                                              'c_criterio_completitud'=>2 , // PUEDE NO TENER DATOS
                                              'filas'=>4,
                                              'ancho'=>1038,  
                                              'columnas'=>10]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 
                                        'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,10]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Especialidad','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
               
      $CN->def_cuadro_store(['valor_inicial'=>'1° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3° año','colspan'=>2, 'titulo'=>true,'estilos'=>'titulo1', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'TOTALES','colspan'=>3, 'titulo'=>true,'estilos'=>'titulo1', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);

    
      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                                        ['celdas'=> [[2,2],[2,4],[2,6],[2,8] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                                        ['celdas'=> [[2,3],[2,5],[2,7],[2,9] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                                        ['celdas'=> [[2,10]] ]);

      // AREA DE DATOS
      // fila 3 y 4
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['region'=> [ [3,2,4,10]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'24','editable'=>true,'tipo_dato'=>'combobox'] ,  ['celdas'=> [[3,1]] ]);  //Inicial 2023 cambié la tabla de opciones id_combo=24;  era id_combo=7
      $CN->def_cuadro_store(['c_mapa'=>118] , ['celdas'=> [[3,1]] , 'region'=> [ [3,2,4,10]] ]);
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado' ] , ['region'=> [ [3,8,4,10]] ]);
      // Totales
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'],
                                        ['celdas'=> [[4,1]] ]);
      


      $CN->def_cuadro_save() ;


      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 118, [118], 'artistica c 8') ;
      

      $CN->consistencia_save( [
                            'numero' => 1,
                            'c_tipo_consistencia' => 16, //totales de columna
                            'c_categoria_consistencia' =>  3, // Consistencia de Error
                            'c_estado' =>  1, // Consistencia activa
                            'cmp1' => [] ,
                            'cmp2' => [] ,
                            'cmp3' => ['tit' => [   '2' => '1° año / varón ',
                                                    '3' => '1° año / mujer ',
                                                    '4' => '2° año / varón ',
                                                    '5' => '2° año / mujer ',
                                                    '6' => '3° año / varón ',
                                                    '7' => '3° año / mujer ',
                                                    '8' => 'Total / varón ',
                                                    '9' => 'Total / mujer ',
                                                    '10' => 'Total / total '
                                                ]
                                      ],
                            'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
                            'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
                            'msg3' => '',    
                            'descripcion' => 'artistica-cuadro 8, Suma de columna xxx <> Total'
                            ] );
                            
      $CN->consistencia_save( [
                           'numero' => 2,
                            'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
                            'c_categoria_consistencia' =>  3, // Consistencia de Error
                            'c_estado' =>  1, // Consistencia activa
                            'cmp1' => ['col' => [8,9,10 ] ],
                            'cmp2' => ['scol' => [[2,4,6],[3,5,7] ,[8,9] ]] ,
                            'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
                            'descripcion' => 'especial -cuadro 8, Total   x fila <> suma'
                            ] );

      $CN->consistencia_save( [
                            'numero' => 3,
                            'c_tipo_consistencia' => 11, // cuadros dependientes
                            'c_categoria_consistencia' =>  3, // Consistencia de Error
                            'c_estado' =>  1, // Consistencia activa
                            'cmp1' => ['cua' => [9,10] ] ,
                            'cmp2' => [] ,
                            'cmp3' => '',
                            'msg1' => '',
                            'msg2' => '',
                            'msg3' => '',    
                            'descripcion' => 'ARTISTICA-cuadro 3, control de cuadros dependientes'
                            ] );       
      $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas


//
//    ARTÍSTICA cuadro 9 -> CANTIDAD DE DIVISIONES POR AÑO y MODALIDAD
//       
      $ncuadro=9;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                                              'nombre'=>'CANTIDAD DE DIVISIONES POR AÑO y MODALIDAD',
                                              'descripcion'=>'DIVISIONES POR AÑO y MODALIDAD',
                                              'c_tipo_cuadro'=>1,
                                              'c_criterio_completitud'=>1 , // PUEDE NO TENER DATOS
                                              'filas'=>11,
                                              'ancho'=>585, 
                                              'columnas'=>7]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 
                                        'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,11,7]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Modalidad','titulo'=>true,'estilos'=>'titulo1', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
               
      $CN->def_cuadro_store(['valor_inicial'=>'1° año', 'titulo'=>true,'estilos'=>'titulo1', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'2° año', 'titulo'=>true,'estilos'=>'titulo1', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'3° año', 'titulo'=>true,'estilos'=>'titulo1', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'4° año', 'titulo'=>true,'estilos'=>'titulo1', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,5]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Talleres', 'titulo'=>true,'estilos'=>'titulo1', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo1', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[1,7]] ]);

    
      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Formación Básica / Preparatoria', 'titulo'=>true,'estilos'=>'titulo2', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ciclo Inicial', 'titulo'=>true,'estilos'=>'titulo2', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ciclo Medio', 'titulo'=>true,'estilos'=>'titulo2', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'FOBA', 'titulo'=>true,'estilos'=>'titulo2', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Tecnicaturas y Profesorados', 'titulo'=>true,'estilos'=>'titulo2', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Estética Infantil', 'titulo'=>true,'estilos'=>'titulo2', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[7,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Cursos', 'titulo'=>true,'estilos'=>'titulo2', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[8,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'T.P.P. / O.C.C.', 'titulo'=>true,'estilos'=>'titulo2', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[9,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'T.A.P.', 'titulo'=>true,'estilos'=>'titulo2', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[10,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 
                                        'tipo_dato'=>'text'], ['celdas'=> [[11,1]] ]);

      // AREA DE DATOS
      // fila 2 a 11
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['region'=> [ [2,2,11,7]] ]);
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado' ] , ['region'=> [ [2,7,11,7]] ]);

      $CN->def_cuadro_store(['c_mapa'=>120], ['region'=> [ [2,2,5,7]] ]); // cuadro  4, ciclos de enseñanza artistica.
      $CN->def_cuadro_store(['c_mapa'=>115], ['region'=> [ [6,2,6,7]] ]); // cuadro 5, snu, tecnicaturas y prof.
      $CN->def_cuadro_store(['c_mapa'=>119], ['region'=> [ [7,2,9,7]] ]); // cuadro  3,6y7 , estetica inf., cursos y t.p.p.
      $CN->def_cuadro_store(['c_mapa'=>118], ['region'=> [ [10,2,10,7]] ]); // cuadro  8 , TAP


      //celdas sombreadas
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] , ['region'=> [ [2,5,5,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] , ['celdas'=> [ [6,6],[8,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] , ['region'=> [ [9,5,10,6]] ]);
      

      $CN->def_cuadro_save() ;


      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 120, [120], 'artistica c 9') ;
      $CN->mapacuadro_store_c_mapa ( 115, [115], 'artistica c 9') ;
      $CN->mapacuadro_store_c_mapa ( 119, [119], 'artistica c 9') ;
      $CN->mapacuadro_store_c_mapa ( 118, [118], 'artistica c 9') ;
      



      

      $CN->consistencia_save( [
                'numero' => 1,
                'c_tipo_consistencia' => 16, //totales de columna
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => ['tit' => [   '2' => '1° año ',
                                        '3' => '2° año ',
                                        '4' => '3° año ',
                                        '5' => '4° año ',
                                        '6' => 'Talleres ',
                                        '7' => 'Total ',
                                    ]
                          ],
                'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
                'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
                'msg3' => '',    
                'descripcion' => 'artistica-cuadro 9, Suma de columna xxx <> Total'
                ] );
                            
      $CN->consistencia_save( [
                'numero' => 2,
                'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => ['col' => [7] ],
                'cmp2' => ['scol' => [[2,3,4,5,6] ]] ,
                'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
                'descripcion' => 'especial -cuadro 9, Total   x fila <> suma'
                ] );


      $CN->consistencia_save( [
                'numero' => 3,
                'c_tipo_consistencia' => 22, //Comparaciones de cuadross alumnos y secciones
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [ 'alu' =>[ [[[4,0,2],[4,0,3]] ], //alumnos Formación Básica / Preparatoria    nivel,año,sexo

                                      [[[4,0,4],[4,0,5]], //alumnos 1° V+M  Ciclo Inicial
                                      [[4,0,6],[4,0,7]], //alumnos 2° V+M  Ciclo Inicial
                                      [[4,0,8],[4,0,9]] ], //alumnos 3° V+M  Ciclo Inicial

                                      [[[4,0,10],[4,0,11]], //alumnos 1° V+M  Ciclo Medio
                                      [[4,0,12],[4,0,13]], //alumnos 2° V+M  Ciclo Medio
                                      [[4,0,14],[4,0,15]] ], //alumnos 3° V+M  Ciclo Medio

                                      [[[4,0,16],[4,0,17]], //alumnos 1° V+M  FOBA
                                      [[4,0,18],[4,0,19]], //alumnos 2° V+M  FOBA
                                      [[4,0,20],[4,0,21]] ], //alumnos 3° V+M  FOBA


                                      [[[5,0,2],[5,0,3]], //alumnos 1° V+M  Tecnicaturas y Profesorados
                                      [[5,0,4],[5,0,5]], //alumnos 2° V+M  Tecnicaturas y Profesorados
                                      [[5,0,6],[5,0,7]], //alumnos 3° V+M  Tecnicaturas y Profesorados
                                      [[5,0,8],[5,0,9]] ], //alumnos 4° V+M  Tecnicaturas y Profesorados

                                      [[[3,0,1],[3,0,2]], //alumnos 1° V+M  Estética Infantil
                                      [[3,0,3],[3,0,4]], //alumnos 2° V+M  Estética Infantil
                                      [[3,0,5],[3,0,6]], //alumnos 3° V+M  Estética Infantil
                                      [[3,0,7],[3,0,8]], //alumnos 4° V+M  Estética Infantil
                                      [[3,0,9],[3,0,10]] ], //alumnos talleres V+M  Estética Infantil

                                      [[[6,0,2],[6,0,3]], //alumnos 1° V+M  Cursos
                                      [[6,0,4],[6,0,5]], //alumnos 2° V+M  Cursos
                                      [[6,0,6],[6,0,7]], //alumnos 3° V+M  Cursos
                                      [[6,0,8],[6,0,9]] ], //alumnos 4° V+M  Cursos

                                      [[[7,0,2],[7,0,3]], //alumnos 1° V+M  T.P.P. / O.C.C.
                                      [[7,0,4],[7,0,5]], //alumnos 2° V+M  T.P.P. / O.C.C.
                                      [[7,0,6],[7,0,7]] ], //alumnos 3° V+M  T.P.P. / O.C.C.

                                      [[[8,0,2],[8,0,3]], //alumnos 1° V+M  T.A.P.
                                      [[8,0,4],[8,0,5]], //alumnos 2° V+M  T.A.P.
                                      [[8,0,6],[8,0,7]] ], //alumnos 3° V+M  T.A.P.

                                  ]
                          ],
                'cmp2' => [ 'sei' =>[ [[[9,2,2],[9,2,3],[9,2,4]] ], //secciones total,Formación Básica / Preparatoria (no hay distribucion x año en matricula)

                                      [[[9,3,2]], //secciones 1° año,Ciclo Inicial
                                      [[9,3,3]], //secciones 2° año,Ciclo Inicial
                                      [[9,3,4]] ], //secciones 3° año,Ciclo Inicial

                                      [[[9,4,2]], //secciones 1° año,Ciclo Medio
                                      [[9,4,3]], //secciones 2° año,Ciclo Medio
                                      [[9,4,4]]], //secciones 3° año,Ciclo Medio

                                      [[[9,5,2]], //secciones 1° año,Ciclo FOBA
                                      [[9,5,3]], //secciones 2° año,Ciclo FOBA
                                      [[9,5,4]] ], //secciones 3° año,Ciclo FOBA

                                      [[[9,6,2]], //secciones 1° año, Tecnicaturas y Profesorados
                                      [[9,6,3]], //secciones 2° año, Tecnicaturas y Profesorados
                                      [[9,6,4]], //secciones 3° año, Tecnicaturas y Profesorados
                                      [[9,6,5]] ], //secciones 4° año, Tecnicaturas y Profesorados

                                      [[[9,7,2]], //secciones 1° año, Estética Infantil
                                      [[9,7,3]], //secciones 2° año, Estética Infantils
                                      [[9,7,4]], //secciones 3° año, Estética Infantil
                                      [[9,7,5]], //secciones 4° año, Estética Infantil
                                      [[9,7,6]] ], //secciones Talleres, Estética Infantil

                                      [[[9,8,2]], //secciones 1° año, Cursos
                                      [[9,8,3]], //secciones 2° año, Cursos
                                      [[9,8,4]], //secciones 3° año, Cursos
                                      [[9,8,5]] ], //secciones 4° año, Cursos

                                      [[[9,9,2]], //secciones 1° año, T.P.P. / O.C.C.
                                      [[9,9,3]], //secciones 2° año, T.P.P. / O.C.C.
                                      [[9,9,4]] ], //secciones 3° año, T.P.P. / O.C.C.

                                      [[[9,10,2]], //secciones 1° año, T.A.P.
                                      [[9,10,3]], //secciones 2° año, T.A.P.
                                      [[9,10,4]] ], //secciones 3° año, T.A.P.

                                    ],
                            'sea' => [  [],[],[],[],[],[],[],[],[]  ] // secciones agrupadas agregadas a secxaño
                          ] ,
                
                'cmp3' => [ 'des' =>  [['Formación Básica / Preparatoria', 'Formación Básica / Preparatoria' ],
                                      
                                       ['1° Ciclo Inicial', 
                                       '2° Ciclo Inicial',
                                       '3° Ciclo Inicial', 'Ciclo Inicial' ],

                                       ['1° Ciclo Medio',
                                       '2° Ciclo Medio',
                                       '3° Ciclo Medio','Ciclo Medio' ],

                                       ['1° FOBA',
                                       '2° FOBA',
                                       '3° FOBA','FOBA' ],

                                       ['1° Tecnicaturas y Profesorados',
                                       '2° Tecnicaturas y Profesorados',
                                       '3° Tecnicaturas y Profesorados',
                                       '4° Tecnicaturas y Profesorados', 'Tecnicaturas y Profesorados' ],

                                       ['1° Estética Infantil',
                                       '2° Estética Infantil',
                                       '3° Estética Infantil',
                                       '4° Estética Infantil',
                                       'Talleres de Estética Infantil', 'Estética Infantil'],


                                       ['1° Cursos',
                                       '2° Cursos',
                                       '3° Cursos',
                                       '4° Cursos','Cursos' ],

                                       ['1° T.P.P. / O.C.C.',
                                       '2° T.P.P. / O.C.C.',
                                       '3° T.P.P. / O.C.C.' ,'T.P.P. / O.C.C.'],

                                       ['1° T.A.P.',
                                       '2° T.A.P.',
                                       '3° T.A.P.','T.A.P.' ]
                                       ] ],  // titulos de comprobacion alumnos

                'msg1' => 'Los alumnos del ',
                'msg2' => 'informados, no se corresponden con las secciones declaradas',
                'msg3' => '',    
                'descripcion' => 'comparacion de alumnos varon + mujer con secciones independientes y/ agrupadas'
                ] );

      $CN->consistencia_save( [
                'numero' => 4,
                'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => '',
                'msg1' => 'Debe consignar secciones',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'control de cuadro vacio/0'
                ] );

      $CN->consistencia_save( [
                'numero' => 5,
                'c_tipo_consistencia' => 23, // relacion alumnos por seccion
                'c_categoria_consistencia' =>  2, // Consistencia de advertencia
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [ 'num' =>[ [[4,0,2],[4,0,3]] , //alumnos Formación Básica / Preparatoria    nivel,año,sexo

                                      [[4,0,4],[4,0,5]], //alumnos 1° V+M  Ciclo Inicial
                                      [[4,0,6],[4,0,7]], //alumnos 2° V+M  Ciclo Inicial
                                      [[4,0,8],[4,0,9]], //alumnos 3° V+M  Ciclo Inicial

                                      [[4,0,10],[4,0,11]], //alumnos 1° V+M  Ciclo Medio
                                      [[4,0,12],[4,0,13]], //alumnos 2° V+M  Ciclo Medio
                                      [[4,0,14],[4,0,15]], //alumnos 3° V+M  Ciclo Medio

                                      [[4,0,16],[4,0,17]], //alumnos 1° V+M  FOBA
                                      [[4,0,18],[4,0,19]], //alumnos 2° V+M  FOBA
                                      [[4,0,20],[4,0,21]], //alumnos 3° V+M  FOBA

                                      [[5,0,2],[5,0,3]], //alumnos 1° V+M  Tecnicaturas y Profesorados
                                      [[5,0,4],[5,0,5]], //alumnos 2° V+M  Tecnicaturas y Profesorados
                                      [[5,0,6],[5,0,7]], //alumnos 3° V+M  Tecnicaturas y Profesorados
                                      [[5,0,8],[5,0,9]], //alumnos 4° V+M  Tecnicaturas y Profesorados

                                      [[3,0,1],[3,0,2]], //alumnos 1° V+M  Estética Infantil
                                      [[3,0,3],[3,0,4]], //alumnos 2° V+M  Estética Infantil
                                      [[3,0,5],[3,0,6]], //alumnos 3° V+M  Estética Infantil
                                      [[3,0,7],[3,0,8]], //alumnos 4° V+M  Estética Infantil
                                      [[3,0,9],[3,0,10]], //alumnos talleres V+M  Estética Infantil

                                      [[6,0,2],[6,0,3]], //alumnos 1° V+M  Cursos
                                      [[6,0,4],[6,0,5]], //alumnos 2° V+M  Cursos
                                      [[6,0,6],[6,0,7]], //alumnos 3° V+M  Cursos
                                      [[6,0,8],[6,0,9]], //alumnos 4° V+M  Cursos

                                      [[7,0,2],[7,0,3]], //alumnos 1° V+M  T.P.P. / O.C.C.
                                      [[7,0,4],[7,0,5]], //alumnos 2° V+M  T.P.P. / O.C.C.
                                      [[7,0,6],[7,0,7]], //alumnos 3° V+M  T.P.P. / O.C.C.

                                      [[8,0,2],[8,0,3]], //alumnos 1° V+M  T.A.P.
                                      [[8,0,4],[8,0,5]], //alumnos 2° V+M  T.A.P.
                                      [[8,0,6],[8,0,7]] //alumnos 3° V+M  T.A.P.

                                    ],

                            'div' =>[ [[9,2,7]], //secciones total,Formación Básica / Preparatoria (no hay distribucion x año en matricula)

                                      [[9,3,2]], //secciones 1° año,Ciclo Inicial
                                      [[9,3,3]], //secciones 2° año,Ciclo Inicial
                                      [[9,3,4]], //secciones 3° año,Ciclo Inicial

                                      [[9,4,2]], //secciones 1° año,Ciclo Medio
                                      [[9,4,3]], //secciones 2° año,Ciclo Medio
                                      [[9,4,4]], //secciones 3° año,Ciclo Medio

                                      [[9,5,2]], //secciones 1° año,Ciclo FOBA
                                      [[9,5,3]], //secciones 2° año,Ciclo FOBA
                                      [[9,5,4]], //secciones 3° año,Ciclo FOBA

                                      [[9,6,2]], //secciones 1° año, Tecnicaturas y Profesorados
                                      [[9,6,3]], //secciones 2° año, Tecnicaturas y Profesorados
                                      [[9,6,4]], //secciones 3° año, Tecnicaturas y Profesorados
                                      [[9,6,5]], //secciones 4° año, Tecnicaturas y Profesorados

                                      [[9,7,2]], //secciones 1° año, Estética Infantil
                                      [[9,7,3]], //secciones 2° año, Estética Infantils
                                      [[9,7,4]], //secciones 3° año, Estética Infantil
                                      [[9,7,5]], //secciones 4° año, Estética Infantil
                                      [[9,7,6]], //secciones Talleres, Estética Infantil

                                      [[9,8,2]], //secciones 1° año, Cursos
                                      [[9,8,3]], //secciones 2° año, Cursos
                                      [[9,8,4]], //secciones 3° año, Cursos
                                      [[9,8,5]], //secciones 4° año, Cursos

                                      [[9,9,2]], //secciones 1° año, T.P.P. / O.C.C.
                                      [[9,9,3]], //secciones 2° año, T.P.P. / O.C.C.
                                      [[9,9,4]], //secciones 3° año, T.P.P. / O.C.C.

                                      [[9,10,2]], //secciones 1° año, T.A.P.
                                      [[9,10,3]], //secciones 2° año, T.A.P.
                                      [[9,10,4]] //secciones 3° año, T.A.P.

                                    ]
                          ],
                'cmp2' => [ 'min' =>[ 10, //secciones total,Formación Básica / Preparatoria 
                                      6,6,6, //secciones 1,2,3 Ciclo Inicial
                                      6,6,6, //secciones 1,2,3 Ciclo Medio
                                      6,6,6, //secciones 1,2,3 Ciclo FOBA
                                      10,10,10,10,    //secciones de 1,2,3,4 Tecnicaturas y Profesorados
                                      10,10,10,10,10, //secciones de  1,2,3,4 y Talleres de estetica
                                      6,6,6,6, //secciones de 1,2,3,4 de  cursos
                                      6,6,6, //secciones 1,2,3 T.P.P. / O.C.C.o
                                      6,6,6 //secciones 1,2,3 T.A.P.
                                    ],
                            'max' =>[ 45, //secciones total,Formación Básica / Preparatoria 
                                      45,45,45, //secciones 1,2,3 Ciclo Inicial
                                      45,45,45, //secciones 1,2,3 Ciclo Medio
                                      45,45,45, //secciones 1,2,3 Ciclo FOBA
                                      50,50,50,50,    //secciones de 1,2,3,4 Tecnicaturas y Profesorados
                                      45,45,45,45,45, //secciones de  1,2,3,4 y Talleres de estetica
                                      45,45,45,45, //secciones de 1,2,3,4 de  cursos
                                      45,45,45,    //secciones 1,2,3 T.P.P. / O.C.C.o
                                      45,45,45     //secciones 1,2,3 T.A.P.o
                                    ]
                          ] ,
                
                'cmp3' => [ 'des' =>  ['Formación Básica / Preparatoria',
                                       '1° año - Ciclo Inicial',
                                       '2° año - Ciclo Inicial',
                                       '3° año - Ciclo Inicial',

                                       '1° año - Ciclo Medio',
                                       '2° año - Ciclo Medio',
                                       '3° año - Ciclo Medio',

                                       '1° año - Ciclo FOBA',
                                       '2° año - Ciclo FOBA',
                                       '3° año - Ciclo FOBA',
                                       
                                       '1° año - Tec. y Prof.',
                                       '2° año - Tec. y Prof.',
                                       '3° año - Tec. y Prof.',
                                       '4° año - Tec. y Prof.',
                                       
                                       '1° año - de Estetica Inf.',
                                       '2° año - de Estetica Inf.',
                                       '3° año - de Estetica Inf.',
                                       '4° año - de Estetica Inf.',
                                       'Talleres - de Estetica Inf.',

                                       '1° año - cursos',
                                       '2° año - cursos',
                                       '3° año - cursos',
                                       '4° año - cursos',

                                       '1° año - T.P.P.',
                                       '2° año - T.P.P.',
                                       '3° año - T.P.P.',

                                       '1° año - T.A.P',
                                       '2° año - T.A.P',
                                       '3° año - T.A.P'

                                      ] 
                          ],  
                'msg1' => 'La relación de alumnos por división/grupo de ',
                'msg2' => 'excede los valores habituales, ',
                'msg3' => 'verifique la cantidad de alumnos y secciones ingresada',    
                'descripcion' => 'advertencia de alumnos x seccion fuera de rango'
                ] );

      $CN->consistencia_cantidad_x_cuadro(5); // por si hay que eliminar consistencias viejas




//
//     ARTÍSTICA cuadro 10 -> ALUMNOS POR SEXO NO BINARIO
//

      $ncuadro=10;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'ALUMNOS POR CICLO SEGÚN SEXO, NO BINARIO',
              'descripcion'=>'ALUMNOS POR CICLO SEGÚN SEXO, NO BINARIO de inicial',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // obligatorio DATOS
              'indicaciones'=>'Nota: En concordancia con decreto DCTO-2021-476-APN-PTE.',                                                                                            
              'ancho'=>500,
              'filas'=>5,
              'columnas'=>10 
            ]);
          
      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir
          
      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,5,10]] ]);
          
      // TITULOS DE FILAS
          
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'SEXO'                            , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Formación Básica / Preparatoria' , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ciclo Inicial'                   , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Ciclo Medio'                     , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'FOBA'                            , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,5]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Tecnicaturas y Profesorados'     , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Estética Infantil'               , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,7]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Cursos'                          , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'T.P.P. / O.C.C.'                 , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,9]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'T.A.P.'                          , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,10]] ]);
          
      //filas 2 a 5
      $CN->def_cuadro_store(['valor_inicial'=>'Masculino'       , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Femenino'        , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'X (no binario)'  , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total'           , 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
          
          
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>120] , ['region'=> [ [2,2,5,5]] ]); // cuadro  4, ciclos de enseñanza artistica.
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>115] , ['region'=> [ [2,6,5,6]] ]); // cuadro 5, snu, tecnicaturas y prof.
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>119] , ['region'=> [ [2,7,5,9]] ]); // cuadro  3,6y7 , estetica inf., cursos y t.p.p.
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>118] , ['region'=> [ [2,10,5,10]] ]); // cuadro  8 , TAP
          
      $CN->def_cuadro_save() ;
          
        // DEFINIR mapa_cuadro DEL CUADRO

        $CN->mapacuadro_store_c_mapa ( 120, [120], 'artistica c 10') ;
        $CN->mapacuadro_store_c_mapa ( 115, [115], 'artistica c 10') ;
        $CN->mapacuadro_store_c_mapa ( 119, [119], 'artistica c 10') ;
        $CN->mapacuadro_store_c_mapa ( 118, [118], 'artistica c 10') ;
 
          
      // DEFINIR CONSISTENCIAS
          
      $CN->consistencia_save( 
            [
              'numero' =>  1,
              'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => '',
              'msg1' => 'Debe consignar alumnos',
              'msg2' => '',
              'msg3' => '',    
              'descripcion' => 'ARTÍSTICA cuadro 10, ingresar datos no 0 or on'
            ] );
            
      $CN->consistencia_save( 
            [
              'numero' =>  2,
              'c_tipo_consistencia' => 16, //totales de columna
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1 , // Consistencia activa
              'cmp1' => [] ,
              'cmp2' => [] ,
              'cmp3' => ['tit' => [   '2' => 'Formación Básica / Preparatoria ',
                                      '3' => 'Ciclo Inicial ',
                                      '4' => 'Ciclo Medio ',
                                      '5' => 'FOBA ',
                                      '6' => 'Tecnicaturas y Profesorados ',
                                      '7' => 'Estética Infantil ',
                                      '8' => 'Cursos ',
                                      '9' => 'T.P.P. / O.C.C. ',
                                      '10' => 'T.A.P. ',
                                  ]
                        ],
              'msg1' => 'La suma de la columna Alumnos de ', //  'Total de las modalidades',
              'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
              'msg3' => '',    
              'descripcion' => 'ARTÍSTICA cuadro 10, Suma de columna xxx <> Total'
            ] );                      
                      
      $CN->consistencia_save( 
            [
              'numero' => 3,
              'c_tipo_consistencia' => 25, // consistencia de comparacion menor val1, val1_1,val1_2 < val2
              'c_categoria_consistencia' =>  3, // Consistencia de Error
              'c_estado' =>  1, // Consistencia activa
                        // celdas a comparar del cuadro
              'cmp1' =>   [ 'v1'=> [  [[[ 5,2]] ], // Formación Básica / Preparatoria c4
                                      [[[ 5,3]] ], // Ciclo Inicial c4
                                      [[[ 5,4]] ], // Ciclo Medio c4
                                      [[[ 5,5]] ], // foba c4
                                      [[[ 5,6]] ], // Tecnicaturas y Profesorados  c5
                                      [[[ 5,7]] ], // Estética Infantil c3
                                      [[[ 5,8]] ], // Cursos c6
                                      [[[ 5,9]] ], // T.P.P. / O.C.C.  c7
                                      [[[ 5,10]] ], // T.A.P.  c8

                                    ]
                          ], 
              'cmp2' =>  [  'v2'=>[   // celdas de otros cuadros a sumar para la comparación
                                    ['reg'=>[[4,0,2,0,3]]],   // Formación Básica / Preparatoria c4
                                    ['reg'=>[[4,0,4,0,9]]],   // Ciclo Inicial c4
                                    ['reg'=>[[4,0,10,0,15]]], // Ciclo Medio c4
                                    ['reg'=>[[4,0,16,0,21]]], // Ciclo FOBA c4
                                    ['cel'=>[[5,0,12]]],      // carreras c5
                                    ['cel'=>[[3,0,13]]],      // Estetica c3
                                    ['cel'=>[[6,0,12]]],      // Cursos Medio c6
                                    ['cel'=>[[7,0,10]]], // T.P.P. / O.C.C.  c7
                                    ['cel'=>[[8,0,10]]], // T.A.P.  c8
                                  ],
                            'sig'=>'!=',
                          ],
              'cmp3' => [ 'd1'=>  [
                                    [ 'Formación Básica / Preparatoria'],
                                    [ 'Ciclo Inicial'],
                                    [ 'Ciclo Medio'],
                                    [ 'FOBA'],
                                    [ 'Tecnicaturas y Profesorados'],
                                    [ 'Estética Infantil'],
                                    [ 'Cursos'],
                                    [ 'T.P.P. / O.C.C.'],
                                    [ 'T.A.P.'],
                                    ],                              
                          'd2'=>  [
                                    ['4'],
                                    ['4'],
                                    ['4'],
                                    ['4'],
                                    ['5'],
                                    ['3'],
                                    ['6'],
                                    ['7'],
                                    ['8'],
                                  ]
                          ],
              'msg1' => 'El total de alumnos de ',
              'msg2' => ' es distintos de lo informados en cuadro ',
              'msg3' => '',    
              'descripcion' => 'ARTÍSTICA cuadro 10, comparacion de alumnos diferentes'
            ] );
                      
      $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas
        

 
                
      $F->def_formulario_save();  

      //dd($F); 
      return ($F);

    }  // FORMULARIO DE ARTÍSTICA











//////////////////////////////
//////////////////////////////
///////////////////////////////
//////////////////////////////
///////////////////////////////
///////////////////////////////












static public function I2024_FP($id_definicion_formulario)
    {

       
////////////////////////////       
//definir un nuevo formulario
//////////////////////////////
///////////////////////////////


      $F = new DefinicionFormularioController($id_definicion_formulario);  // crear o cargar el formulario

      $F->nombre='MATRÍCULA INICIAL 2024 - FORMACION PROFESIONAL';
      $F->nombre_corto='FORMACION PROFESIONAL';
      $F->descripcion='Planilla Relevamiento Inicial 2024 de Formación Profesional';
      $F->id_periodo='106';
      $F->color='f_naranja';

      //asignar los tipo de organizacion del formulario
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'DF'] );

     
//        
// FP cuadro 1 ->TURNOS DE FUNCIONAMIENTO
//
      $ncuadro=1;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                'nombre'=>'TURNOS DE FUNCIONAMIENTO',
                'descripcion'=>'encabezado de turnos',
                'c_tipo_cuadro'=>4, // de combobox
                'c_criterio_completitud'=>1 , //obligatorio con datos
                'filas'=>8,
                'ancho'=>247,
                'columnas'=>2 ]);

      
      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,8,2]] ]);

      // TITULOS DE FILAS
      $CN->def_cuadro_store(['valor_inicial'=>'TURNOS', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);

      // TITULOS DE COLUMNAS
      $CN->def_cuadro_store(['valor_inicial'=>'Mañana',            'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Intermedio',        'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Tarde',             'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Vespertino',        'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Noche',             'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Doble Escolaridad', 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[7,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Alternado',         'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[8,1]] ]);


      //       // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[3,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[4,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[6,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[7,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[8,2]] ]);

      $CN->def_cuadro_save() ;


      $CN->consistencia_save( [
                'numero' => 1,
                'c_tipo_consistencia' => 10, // con datos no 0 or on
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => '',
                'msg1' => 'Debe consignar al menos un turno',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'FP-cuadro 1, ingresar al menos un turno'
                ] );

      $CN->consistencia_cantidad_x_cuadro(1); // por si hay que eliminar consistencias viejas

//
// // FP cuadro 2 ->CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
//
      $ncuadro=2;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                'nombre'=>'CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO',
                'descripcion'=>'encabezado sae',
                'c_tipo_cuadro'=>1,
                'c_criterio_completitud'=>2 ,
                'filas'=>6,
                'ancho'=>465,
                'columnas'=>2 ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,6,2]] ]);

      // TITULOS DE FILAS
      $CN->def_cuadro_store(['valor_inicial'=>'SERVICIO', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'CANTIDAD', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);

      // TITULOS DE COLUMNAS
      $CN->def_cuadro_store(['valor_inicial'=>'Desayuno y Merienda Completa',  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Comedor',                       'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Simple',                 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Doble',                  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Completo',               'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[3,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[4,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[6,2]] ]);

      $CN->def_cuadro_save() ;

      $CN->consistencia_cantidad_x_cuadro(0); // por si hay que eliminar consistencias viejas




//  //
//    FP cuadro 3 ->MATRÍCULA Y HORAS CÁTEDRA POR CURSO O TRAYECTO DE FORMACIÓN PROFESIONAL
//  //

      $ncuadro=3;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                'nombre'=>'MATRÍCULA Y HORAS CÁTEDRA POR CURSO O TRAYECTO DE FORMACIÓN PROFESIONAL',
                'descripcion'=>'MATRÍCULA Y HORAS CÁTEDRA POR CURSO O TRAYECTO DE FORMACIÓN PROFESIONAL',     
// nota que no corresponde en relevamientos iniciales                                                         
                'indicaciones'=>' ',
//                'indicaciones'=>'Consignar la matrícula solo de los trayectos dictados en el segundo semestre, (no incluir trayectos finalizados del primer semestre)',                
                'ayuda'=>'',
                'c_tipo_cuadro'=>2,
                'c_criterio_completitud'=>1 , // NO puede no TENER DATOS
                'ancho'=>600, 
                'filas'=>4,
                'columnas'=>7]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,7]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Curso N°','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Trayecto', 'rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Matrícula', 'colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Duración total en Hs. cátedra ', 'rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Finalizado','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,7]] ]);
      //    $CN->def_cuadro_store(['valor_inicial'=>'No Finalizado', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,9]] ]);
      //    $CN->def_cuadro_store(['valor_inicial'=>'Observaciones', 'rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,9]] ]);
      
      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,5]] ]);

      //$CN->def_cuadro_store(['valor_inicial'=>'Fecha',     'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,7]] ]);
      //$CN->def_cuadro_store(['valor_inicial'=>'Aprobados', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,8]] ]);
      // $CN->def_cuadro_store(['valor_inicial'=>'Continua',  'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,9]] ]);
      // $CN->def_cuadro_store(['valor_inicial'=>'Cerrado',   'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,10]] ]);
      
      // Fila Totales
      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>2,'titulo'=>true,'estilos'=>'titulo2','tipo_dato'=>'text'],['celdas'=>[[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>' ', 'titulo'=>true, 'tipo_dato'=>'text'], ['celdas'=> [[4,6],[4,7]] ]); // celdas no editables vacias

      // SOMBREAR CELDAS
      //  $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] , ['region'=> [ [4,7,4,9]] ]);



      // AREA DE DATOS
      // fila 3 y 4
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['region'=> [ [3,1,3,7], [4,3,4,5] ] ]); // todas con numeros

      $CN->def_cuadro_store(['valor_inicial'=>'10', 'editable'=>true, 'tipo_dato'=>'combobox'], ['celdas'=> [[3,2]] ]); //combo cursos
      $CN->def_cuadro_store(['valor_inicial'=>'Si;No' , 'editable'=>true,'tipo_dato'=>'radio'], ['celdas'=> [[3,7]] ]); // Finalizado (SI/NO)

      // $CN->def_cuadro_store(['valor_inicial'=>''  , 'editable'=>true,'tipo_dato'=>'date'] ,       ['celdas'=> [ [3,7]] ]);
      // $CN->def_cuadro_store(['valor_inicial'=>''  , 'editable'=>true,'tipo_dato'=>'date'] ,       ['celdas'=> [ [3,7]] ]); // fecha
      // $CN->def_cuadro_store(['valor_inicial'=>'1' , 'editable'=>true,'tipo_dato'=>'combobox'] ,   ['celdas'=> [ [3,9]] ]); // continua
      // $CN->def_cuadro_store(['valor_inicial'=>'1' , 'editable'=>true,'tipo_dato'=>'combobox'] ,   ['celdas'=> [ [3,10]] ]); // cerrado
      // $CN->def_cuadro_store(['valor_inicial'=>''  , 'editable'=>true,'tipo_dato'=>'textarea'] ,   ['celdas'=> [ [3,9]] ]); // observaciones

      $CN->def_cuadro_store(['c_mapa'=>146], [ 'region'=> [ [3,1,3,7], [4,3,4,5] ] ]);
      

      $CN->def_cuadro_save() ;

      //$CN->def_cuadro_store(['c_mapa'=>142], ['celdas'=> [[4,5],[4,6]] ]);
      
      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 146, [146], 'FP c 3') ;

      $CN->consistencia_save( [
                'numero' => 1,
                'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => '',
                'msg1' => 'Debe consignar alumnos',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'FP-cuadro 3, ingresar datos no 0 or on'
                ] );


      $CN->consistencia_save( [
                'numero' => 2,
                'c_tipo_consistencia' => 16, //totales de columna
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => ['tit' => [   '3' => 'Varón ',
                                        '4' => 'Mujer ',
                                        '5' => 'Total ',
                                        //'6' => 'Hs. Cat. Semanales',
                                        //'8' => 'Aprobados',

                                    ]
                          ],
                'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
                'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
                'msg3' => '',    
                'descripcion' => 'FP-cuadro 3, Suma de columna xxx <> Total'
                ] );
                            
      $CN->consistencia_save( [
                'numero' => 3,
                'c_tipo_consistencia' => 13, //Comparaciones en fila
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => ['col' => [5] ] ,
                'cmp2' => ['col' => [3,4] ] ,
                'cmp3' => '',
                'msg1' => 'El total ',
                'msg2' => 'es distinto de suma de varones + mujeres ',
                'msg3' => '',    
                'descripcion' => 'FP -cuadro 3, Total x fila <> suma de varones+mujeres'
                ] );

      $CN->consistencia_save( [
                'numero' => 4,
                'c_tipo_consistencia' => 11, // cuadros dependientes
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => ['cua' => [4,5] ] ,
                'cmp2' => [] ,
                'cmp3' => '',
                'msg1' => '',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'FP -cuadro 3, control de cuadros dependientes'
                ] );                    

      // $CN->consistencia_save( [
      //           'numero' => 4,
      //           'c_tipo_consistencia' => 13, //Comparaciones en fila
      //           'c_categoria_consistencia' =>  3, // Consistencia de Error
      //           'c_estado' =>  1, // Consistencia activa
      //           'cmp1' => ['col' => [8] ] ,
      //           'cmp2' => ['col' => [5] ] ,
      //           'cmp3' => ['sig' => '>' ],
      //           'msg1' => 'Los aprobados ',
      //           'msg2' => 'no pueden superar el total de alumnos del curso ',
      //           'msg3' => '',    
      //           'descripcion' => 'FP -cuadro 3, aprobados > Total  alumnos x fila'
      //           ] );      


      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas




//
//     FP cuadro 4 -> CANTIDAD DE CURSOS Y COMISIONES
//

      $ncuadro=4;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                'nombre'=>'CANTIDAD DE CURSOS / TRAYECTOS Y COMISIONES',
                'descripcion'=>'cuadro de cursos y comisiones',
                'indicaciones'=>'ACLARACIÓN: Cada grupo al que se imparte un curso o trayecto constituye una comisión. Si un curso o trayecto tiene dos o más grupos se considera un curso o trayecto con dos o más comisiones.',
                'c_tipo_cuadro'=>1,
                'c_criterio_completitud'=>1 , // NO puede no TENER DATOS
                'filas'=>3,
                'ancho'=>465,
                'columnas'=>3 ]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,3,3]] ]);

      // TITULOS DE FILAS
      $CN->def_cuadro_store(['valor_inicial'=>'Cursos / Trayectos', 'titulo'=>true,'rowspan'=>2, 'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Comisiones', 'titulo'=>true, 'colspan'=>2,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'en sede', 'titulo'=>true, 'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'en subsedes', 'titulo'=>true, 'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,3]] ]);

      // TITULOS DE COLUMNAS


      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[3,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[3,3]] ]);

      $CN->def_cuadro_store(['c_mapa'=>146] , [ 'region'=> [ [3,1,3,3] ] ]);

      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 146, [146], 'FP c 4') ;

      // DEFINICION DE CONSISTENCIAS

      $CN->consistencia_save( [
                'numero' => 1,
                'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => '',
                'msg1' => 'Debe consignar cursos y secciones',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'FP-cuadro 3, ingresar datos no 0 or on'
                ] );

      $CN->consistencia_save( [
                'numero' => 2,
                'c_tipo_consistencia' => 13, //Comparaciones en fila
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => ['col' => [1] ] ,
                'cmp2' => ['col' => [2,3] ] ,
                'cmp3' => ['sig' => '>' ],
                'msg1' => 'La cantidad de cursos / Trayectos ',
                'msg2' => 'no puede superar la cantidad de comisiones',
                'msg3' => '',    
                'descripcion' => 'FP -cuadro 4, cant. cursos > Total  comisiones'
                ] );

      $CN->consistencia_save( [
                'numero' => 3,
                'c_tipo_consistencia' => 22, //Comparaciones de cuadros alumnos y secciones
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [ 'alu' =>[ 
                                      [[[3,0,5]], // matrícula total de cuadro 3 cursos de fp
                                      ]
                                    ]
                          ],
                'cmp2' => [ 'sei' =>[ 
                                      [[[4,3,2],[4,3,3]],   //secciones Línea deudores de materias
                                      ], //secciones independientes 
                                    ],
                            'sea' => [  []  ], // secciones agrupadas del nivel
                            'sa2' => [  []  ] // secciones agrupadas alternativas del nivel 
                          ] ,
                
                'cmp3' => [ 'des' =>  [                                      
                                        ['Cursos o trayectos de F.P.', 
                                        ],
                                      ]
                          ],  // titulos de comprobacion alumnos

                'msg1' => 'La matrícula total de los',
                'msg2' => 'informada, no se corresponde con las comisiones declaradas',
                'msg3' => '',    
                'descripcion' => 'comparacion de alumnos varon + mujer con comisiones'
                ] );

      $CN->consistencia_save( [
                'numero' => 4,
                'c_tipo_consistencia' => 23, // relacion alumnos por seccion
                'c_categoria_consistencia' =>  2, // Consistencia de advertencia
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [ 'num' =>[ 
                                      [[3,0,5]], //matrícula total de cuadro 3 cursos de fp
                                    ],

                            'div' =>[
                                        [[4,3,2],[4,3,3]],  //secc. de sede y perifericas de fp
                                    ]
                          ],
                'cmp2' => [ 'min' =>[ 10, // min cursos fp
                                    ],
                            'max' =>[ 55, // max cursos fp
                                    ]
                          ] ,

                'cmp3' => [ 'des' =>  [ 'cuadro 3 y cuadro 4 de',
                                      ] 
                          ],  
                'msg1' => 'La relación de alumnos por comisión resultante entre los ',
                'msg2' => 'excede los valores habituales, ',
                'msg3' => 'alumnos por comisión, verifique la cantidad de alumnos y comisiones cargadas, si es correcto ignore esta advertencia',    
                'descripcion' => 'advertencia de alumnos x comisión fuera de rango FP'
                ] );


      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas
    




//
// FP cuadro 5 -> ALUMNOS POR SEXO NO BINARIO
//

      $ncuadro=5;
      $F->def_formulario_add_cuadro ( 
                [
                  'numero'=>$ncuadro,
                  'nombre'=>'ALUMNOS POR CICLO SEGÚN SEXO, NO BINARIO',
                  'descripcion'=>'ALUMNOS POR CICLO SEGÚN SEXO, NO BINARIO de inicial',
                  'c_tipo_cuadro'=>1,
                  'c_criterio_completitud'=>1 , // obligatorio DATOS
                  'indicaciones'=>'Nota: En concordancia con decreto DCTO-2021-476-APN-PTE.',                                                                                            
                  'ancho'=>500,
                  'filas'=>5,
                  'columnas'=>2 
                ]);
          
      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir
          
      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,5,2]] ]);
          
      // TITULOS DE FILAS
          
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'SEXO','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Alumnos de Trayectos de Formación Profesional'
                            , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
          
      //filas 2 a 5
      $CN->def_cuadro_store(['valor_inicial'=>'Masculino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Femenino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'X (no binario)', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
          
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
          
          
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['region'=> [ [2,2,5,2]] ]);
          
      $CN->def_cuadro_save() ;
          

      // DEFINIR CONSISTENCIAS
          
      $CN->consistencia_save( 
                [
                  'numero' =>  1,
                  'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
                  'c_categoria_consistencia' =>  3, // Consistencia de Error
                  'c_estado' =>  1, // Consistencia activa
                  'cmp1' => [] ,
                  'cmp2' => [] ,
                  'cmp3' => '',
                  'msg1' => 'Debe consignar alumnos',
                  'msg2' => '',
                  'msg3' => '',    
                  'descripcion' => 'FP-cuadro 5, ingresar datos no 0 or on'
                ] );
            
      $CN->consistencia_save( 
                [
                  'numero' =>  2,
                  'c_tipo_consistencia' => 16, //totales de columna
                  'c_categoria_consistencia' =>  3, // Consistencia de Error
                  'c_estado' =>  1 , // Consistencia activa
                  'cmp1' => [] ,
                  'cmp2' => [] ,
                  'cmp3' => ['tit' => [   '2' => 'Trayectos de Formación Profesional ',
                                      ]
                            ],
                  'msg1' => 'La suma de la columna de alumnos de', //  'Total de las modalidades',
                  'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
                  'msg3' => '',    
                  'descripcion' => 'FP-cuadro 5, Suma de columna xxx <> Total'
                ] );                      
                      
      $CN->consistencia_save( 
                [
                  'numero' => 3,
                  'c_tipo_consistencia' => 25, // consistencia de comparacion menor val1, val1_1,val1_2 < val2
                  'c_categoria_consistencia' =>  3, // Consistencia de Error
                  'c_estado' =>  1, // Consistencia activa
                            // celdas a comparar del cuadro
                  'cmp1' => ['v1'=> [ [[[ 5,2]] ], //  alumnos EPA

                                    ]
                            ], 
                  'cmp2' => ['v2'=>[   // celdas de otros cuadros a sumar para la comparación
                                      ['cel'=>[[3,0,5]]],  //Total de Trayectos de Formación Profesional
                                    ],
                              'sig'=>'!=',
                            ],
                  'cmp3' => ['d1'=> [ [ 'Trayectos de Formación Profesional'],
                                    ],                              
                            'd2'=>  [ ['3'],
                                    ]
                            ],
                  'msg1' => 'Los alumnos de ',
                  'msg2' => ' son distintos de lo informados en cuadro ',
                  'msg3' => '',    
                  'descripcion' => 'FP-cuadro 5, comparacion de alumnos diferentes'
                ] );
                          
      $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas






      $F->def_formulario_save();  

      //dd($F); 
      return ($F);



}  // FROMULARIO DE FP  
















//////////////////////////////
///////////////////////////////
//////////////////////////////
///////////////////////////////
//////////////////////////////
///////////////////////////////











static public function I2024_CEC($id_definicion_formulario)
    {

       
////////////////////////////       
//definir un nuevo formulario
//////////////////////////////
///////////////////////////////

      $F = new DefinicionFormularioController( $id_definicion_formulario);  // crear o cargar el formulario

      //$F->delete_consistencias();

      $F->nombre='MATRÍCULA INICIAL 2024 - CENTRO EDUCATIVO COMPLEMENTARIO';
      $F->nombre_corto='CENTRO ED. COMPLEMENTARIO';
      $F->descripcion='Planilla Relevamiento Inicial 2024 de C.E.C.';
      $F->id_periodo='106';
      $F->color='f_amarillo';

      //asignar los tipo de organizacion del formulario
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'SC'] );


// 
// cuadro 1 -> C.E.C. - TURNOS DE FUNCIONAMIENTO
//
      $ncuadro=1;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                'nombre'=>'TURNOS DE FUNCIONAMIENTO',
                'descripcion'=>'encabezado de turnos',
                'c_tipo_cuadro'=>4, // de combobox
                'c_criterio_completitud'=>1 , //obligatorio con datos
                'filas'=>8,
                'ancho'=>247,
                'columnas'=>2 ]);

      
      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,8,2]] ]);

      // TITULOS DE FILAS
      $CN->def_cuadro_store(['valor_inicial'=>'TURNOS', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);

      // TITULOS DE COLUMNAS
      $CN->def_cuadro_store(['valor_inicial'=>'Mañana',            'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Intermedio',        'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Tarde',             'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Vespertino',        'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Noche',             'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Doble Escolaridad', 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[7,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Alternado',         'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[8,1]] ]);


      //       // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[3,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[4,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[6,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[7,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[8,2]] ]);

      $CN->def_cuadro_save() ;


      $CN->consistencia_save( [
                'numero' => 1,
                'c_tipo_consistencia' => 10, // con datos no 0 or on
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => '',
                'msg1' => 'Debe consignar al menos un turno',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'FP-cuadro 1, ingresar al menos un turno'
                ] );

      $CN->consistencia_cantidad_x_cuadro(1); // por si hay que eliminar consistencias viejas


// //
// // cuadro 2 -> C.E.C., CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
// //

      $ncuadro=2;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                'nombre'=>'CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO',
                'descripcion'=>'encabezado sae',
                'c_tipo_cuadro'=>1,
                'c_criterio_completitud'=>2 ,
                'ancho'=>465,
                'filas'=>6,
                'columnas'=>2 ]);
      $CN=$F->cuadros[$ncuadro];

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,6,2]] ]);

      // TITULOS DE FILAS
      $CN->def_cuadro_store(['valor_inicial'=>'SERVICIO', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'CANTIDAD', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);

      // TITULOS DE COLUMNAS
      $CN->def_cuadro_store(['valor_inicial'=>'Desayuno y Merienda Completa',  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Comedor',                       'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Simple',                 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Doble',                  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Completo',               'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[3,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[4,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[6,2]] ]);

      $CN->def_cuadro_save() ;

      $CN->consistencia_cantidad_x_cuadro(0); // por si hay que eliminar consistencias viejas





// //
// //       // cuadro 3 -> C.E.C. - ALUMNOS SEGÚN GRUPOS Y SEXO
// //       //


      $ncuadro=3;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                      'nombre'=>'CANTIDAD DE ALUMNOS SEGÚN GRUPOS Y SEXO',
                      'descripcion'=>'Alumnos de C.E.C.',
                      'c_tipo_cuadro'=>1, // matriz fija
                      'c_criterio_completitud'=>1 , // tiene que TENER DATOS
                      'ancho'=>1000,  
                      'filas'=>4,
                      'columnas'=>14]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,14]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'C.E.C.','rowspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Grupo Pre Primario','rowspan'=>2,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Grupo Primario','colspan'=>8,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);

      $CN->def_cuadro_store(['valor_inicial'=>'Total','rowspan'=>2,'colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,12]] ]);

      //fila 2

      $CN->def_cuadro_store(['valor_inicial'=>'Grupo Inferior' , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Grupo Medio', 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Grupo Superior', 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,8]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Grupo de Aceleración'    , 'rowspan'=>1,'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,10]] ]);


      // fila 3
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>
                   [[3,2], [3,4],[3,6],[3,8],[3,10],[3,12]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>
                   [[3,3], [3,5],[3,7],[3,9],[3,11],[3,13]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=>
                   [[3,14]] ]);
      //filas 4 
      $CN->def_cuadro_store(['valor_inicial'=>'Matrícula', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'],
                    ['celdas'=> [[4,1]] ]);


      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>116] , ['region'=> [ [4,2 ,4,14]] ]);

      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 116, [116],'C.E.C. cuadro 3') ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( [
                'numero' => 1,
                'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => '',
                'msg1' => 'Debe consignar alumnos',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'especial-cuadro 4, ingresar datos no 0 or on'
                ] );

      $CN->consistencia_save( [
                'numero' => 2,
                'c_tipo_consistencia' => 13, //Comparaciones en fila
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => ['col' => [12] ] ,
                'cmp2' => ['col' => [2,4,6,8,10] ] ,
                'cmp3' => '',
                'msg1' => 'El total de varones ',
                'msg2' => 'es distinto de suma de varones ',
                'msg3' => '',    
                'descripcion' => 'CEC -cuadro 3, Total x fila <> suma de varones'
                ] );

      $CN->consistencia_save( [
                'numero' => 3,
                'c_tipo_consistencia' => 13, //Comparaciones en fila
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => ['col' => [13] ] ,
                'cmp2' => ['col' => [3,5,7,9,11] ] ,
                'cmp3' => '',
                'msg1' => 'El total de mujeres ',
                'msg2' => 'es distinto de suma de mujeres ',
                'msg3' => '',    
                'descripcion' => 'CEC -cuadro 3, Total x fila <> suma de mujeres'
                ] ); 
      $CN->consistencia_save( [
                'numero' => 4,
                'c_tipo_consistencia' => 13, //Comparaciones en fila
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => ['col' => [14] ] ,
                'cmp2' => ['col' => [12,13] ] ,
                'cmp3' => '',
                'msg1' => 'El total ',
                'msg2' => 'es distinto de suma de total varón + total mujer',
                'msg3' => '',    
                'descripcion' => 'C.E.C. -cuadro 3, Total x fila <> suma de varón + mujer'
                ] ); 
      $CN->consistencia_save( [
                'numero' => 5,
                'c_tipo_consistencia' => 11, // cuadros dependientes
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => ['cua' => [4,5] ] ,
                'cmp2' => [] ,
                'cmp3' => '',
                'msg1' => '',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'C.E.C -cuadro 3, control de cuadros dependientes'
                ] );                    


    $CN->consistencia_cantidad_x_cuadro(5); // por si hay que eliminar consistencias viejas



//
//    C.E.C. - cuadro 4 -> CANTIDAD DE SECCIONES SEGÚN GRUPO
//
      $ncuadro=4;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                'nombre'=>'CANTIDAD DE SECCIONES SEGÚN GRUPO',
                'descripcion'=>'SECCIONES X GRUP DE C.E.C.',
                'c_tipo_cuadro'=>1,
                'c_criterio_completitud'=>1 , // tiene que TENER DATOS
                'ancho'=>1000,
                'filas'=>3,
                'columnas'=>8]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,3,8]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'C.E.C.','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Grupo Pre Primario','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Grupo Primario','colspan'=>4,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Agrupadas','rowspan'=>2,'colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,7]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','rowspan'=>2,'colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,8]] ]);


     //fila 2

      $CN->def_cuadro_store(['valor_inicial'=>'Grupo Inferior' , 'rowspan'=>1,'colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Grupo Medio', 'rowspan'=>1,'colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,4]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Grupo Superior', 'rowspan'=>1,'colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,5]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Grupo de Aceleración' , 'rowspan'=>1,'colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[2,6]] ]);


      // fila 3
     
      $CN->def_cuadro_store(['valor_inicial'=>'Secciones', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);

      
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number','c_mapa'=>116] , ['region'=> [ [3,2 ,3,8]] ]);

      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      $CN->mapacuadro_store_c_mapa ( 116, [116],'I2024 - c.e.c. cuadro 4') ;


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( [
                'numero' => 1,
                'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => '',
                'msg1' => 'Debe consignar alumnos',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'c.e.c. - cuadro 4, ingresar datos no 0 or on'
                ] );
      
      $CN->consistencia_save( [
                'numero' => 2,
                'c_tipo_consistencia' => 13, //Comparaciones en fila
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => ['col' => [8] ] ,
                'cmp2' => ['col' => [2,3,4,5,6,7] ] ,
                'cmp3' => '',
                'msg1' => 'El total ',
                'msg2' => 'es distinto de suma de secciones por grup',
                'msg3' => '',    
                'descripcion' => 'c.e.c. - cuadro 4, Total x fila <> suma de secciones'
                ] ); 


      $CN->consistencia_save( [
                'numero' => 3,
                'c_tipo_consistencia' => 22, //Comparaciones de cuadross alumnos y secciones
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [ 'alu' =>[ 
                                      [[[3,0, 2],[3,0, 3]], //Alumnos G. Pre Primario  V+M  
                                        [[3,0, 4],[3,0, 5]], //Alumnos G. Inferior  V+M  
                                        [[3,0, 6],[3,0, 7]], //alumnos G. Medio V+M  
                                        [[3,0, 8],[3,0, 9]], //alumnos G. Superior V+M  
                                        [[3,0,10],[3,0,11]] ],//alumnos G. Aceleracion V+M  
                                    ]
                          ],
                'cmp2' => [ 'sei' =>[ 
                                      [[[4,3,2]],   //secciones independientes G. Pre Primario
                                        [[4,3,3]],   //secciones independientes G. Inferior
                                        [[4,3,4]],   //secciones independientes G. Medio
                                        [[4,3,5]],   //secciones independientes G. Superior
                                        [[4,3,6]] ], //secciones independientes G. G. Aceleracion

                                    ],
                            'sea' => [  [[4,3,7]]  ], // secciones agrupadas del nivel
                            'sa2' => [  []  ] // secciones agrupadas alternativas del nivel 
                          ] ,
                
                'cmp3' => [ 'des' =>  [                                      
                                          ['G. Pre Primario', 
                                          'G. Inferior',
                                          'G. Medio',
                                          'G. Superior',
                                          'G. Aceleracion '
                                          ]                                       
                                        ]
                          ],  // titulos de comprobacion alumnos

                'msg1' => 'Los alumnos del ',
                'msg2' => 'informados, no se corresponden con los grupos declaradas',
                'msg3' => '',    
                'descripcion' => 'comparacion de alumnos varon + mujer con secciones independientes y/ agrupadas'
                ] );

      $CN->consistencia_save( [
                'numero' => 4,
                'c_tipo_consistencia' => 23, // relacion alumnos por seccion
                'c_categoria_consistencia' =>  2, // Consistencia de advertencia
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [ 'num' =>[ 
                                      [[3,0,2],[3,0,3],[3,0,4],[3,0,5],[3,0,6],[3,0,7],[3,0,8],[3,0,9],[3,0,10],[3,0,11]] //alumnos
                                    ],

                            'div' =>[ [[4,3,2],[4,3,3],[4,3,4],[4,3,5],[4,3,6],[4,3,7]] //secc.de grupos + AG.
                                    ]
                          ],
                'cmp2' => [ 'min' =>[ 12   // C.E.C.                                                                            
                                    ],
                            'max' =>[ 38  // C.E.C.                                      
                                    ]
                          ] ,
                
                'cmp3' => [ 'des' =>  ['C.E.C.'                                       
                                      ] 
                          ],  
                'msg1' => 'La relación de alumnos por división/grupo de ',
                'msg2' => 'excede los valores habituales, ',
                'msg3' => 'verifique la cantidad de alumnos y secciones ingresada',    
                'descripcion' => 'advertencia de alumnos x seccion fuera de rango'
                ] );


      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas




//
// CEC cuadro 5 -> ALUMNOS POR SEXO NO BINARIO
//

      $ncuadro=5;
      $F->def_formulario_add_cuadro ( 
            [
              'numero'=>$ncuadro,
              'nombre'=>'ALUMNOS POR CICLO SEGÚN SEXO, NO BINARIO',
              'descripcion'=>'ALUMNOS POR CICLO SEGÚN SEXO, NO BINARIO de inicial',
              'c_tipo_cuadro'=>1,
              'c_criterio_completitud'=>1 , // obligatorio DATOS
              'indicaciones'=>'Nota: En concordancia con decreto DCTO-2021-476-APN-PTE.',                                                                                            
              'ancho'=>500,
              'filas'=>5,
              'columnas'=>3 
            ]);
          
      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir
          
      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,5,3]] ]);
          
      // TITULOS DE FILAS
          
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'SEXO','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Alumnos Grupo Pre Primario' , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Alumnos Grupo Primario'     , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
          
      //filas 2 a 5
      $CN->def_cuadro_store(['valor_inicial'=>'Masculino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Femenino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'X (no binario)', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
          
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
          
          
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['region'=> [ [2,2,5,3]] ]);
          
      $CN->def_cuadro_save() ;
          

      // DEFINIR CONSISTENCIAS
          
      $CN->consistencia_save( 
                [
                  'numero' =>  1,
                  'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
                  'c_categoria_consistencia' =>  3, // Consistencia de Error
                  'c_estado' =>  1, // Consistencia activa
                  'cmp1' => [] ,
                  'cmp2' => [] ,
                  'cmp3' => '',
                  'msg1' => 'Debe consignar alumnos',
                  'msg2' => '',
                  'msg3' => '',    
                  'descripcion' => 'C.E.C. -cuadro 5, ingresar datos no 0 or on'
                ] );
            
      $CN->consistencia_save( 
                [
                  'numero' =>  2,
                  'c_tipo_consistencia' => 16, //totales de columna
                  'c_categoria_consistencia' =>  3, // Consistencia de Error
                  'c_estado' =>  1 , // Consistencia activa
                  'cmp1' => [] ,
                  'cmp2' => [] ,
                  'cmp3' => ['tit' => [   '2' => 'alumnos de Grupo Pre Primario ',
                                          '3' => 'alumnos de Grupo Primario ',
                                      ]
                            ],
                  'msg1' => 'La suma de la columna de ', //  'Total de las modalidades',
                  'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
                  'msg3' => '',    
                  'descripcion' => 'C.E.C.-cuadro 5, Suma de columna xxx <> Total'
                ] );                      
                      
      $CN->consistencia_save( 
                [
                  'numero' => 3,
                  'c_tipo_consistencia' => 25, // consistencia de comparacion menor val1, val1_1,val1_2 < val2
                  'c_categoria_consistencia' =>  3, // Consistencia de Error
                  'c_estado' =>  1, // Consistencia activa
                            // celdas a comparar del cuadro
                  'cmp1' => ['v1'=> [ [[[ 5,2]] ], //  alumnos Grupo Pre Primario
                                      [[[ 5,3]] ], //  alumnos Grupo Primario
                                    ]
                            ], 
                  'cmp2' => ['v2'=>[   // celdas de otros cuadros a sumar para la comparación
                                      ['reg'=>[[3,0,2,0,3 ]]],  //Total Grupo Pre Primario
                                      ['reg'=>[[3,0,4,0,11]]],  //Total Grupo Primario
                                    ],
                              'sig'=>'!=',
                            ],
                  'cmp3' => ['d1'=> [ [ 'alumnos de Grupo Pre Primario'],
                                      [ 'alumnos de Grupo Primario'], 
                                    ],                              
                            'd2'=>  [ ['3'],
                                      ['3'],
                                    ]
                            ],
                  'msg1' => 'El total de ',
                  'msg2' => ' es distinto de lo informado en cuadro ',
                  'msg3' => '',    
                  'descripcion' => 'C.E.C.-cuadro 5, comparacion de alumnos diferentes'
                ] );
                      
      $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas



      $F->def_formulario_save();  

      //dd($F); 
      return ($F);



}  // FROMULARIO DE CEC  








//////////////////////////////
///////////////////////////////
//////////////////////////////
///////////////////////////////







//////////////////////////////
///////////////////////////////
//////////////////////////////
///////////////////////////////
//////////////////////////////
///////////////////////////////














static public function I2024_CEF($id_definicion_formulario)
    {

       
////////////////////////////       
//definir un nuevo formulario
//////////////////////////////
///////////////////////////////

      $F = new DefinicionFormularioController( $id_definicion_formulario);  // crear o cargar el formulario

      //$F->delete_consistencias();

      $F->nombre='MATRÍCULA INICIAL 2024 - CENTRO EDUCACIÓN FÍSICA';
      $F->nombre_corto='CENTRO ED. FÍSICA';
      $F->descripcion='Planilla Relevamiento Inicial 2024 de C.E.F.';
      $F->id_periodo='106';
      $F->color='f_amarillo';

      //asignar los tipo de organizacion del formulario
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'FC'] );



//
//    C.E.F cuadro 1 -> CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO
//

      $ncuadro=1;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                'nombre'=>'CANTIDAD DE RACIONES DEL SERVICIO ALIMENTARIO',
                'descripcion'=>'encabezado sae',
                'c_tipo_cuadro'=>1,
                'c_criterio_completitud'=>2 ,
                'ancho'=>465,
                'filas'=>6,
                'columnas'=>2 ]);
      $CN=$F->cuadros[$ncuadro];

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,6,2]] ]);

      // TITULOS DE FILAS
      $CN->def_cuadro_store(['valor_inicial'=>'SERVICIO', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'CANTIDAD', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);

      // TITULOS DE COLUMNAS
      $CN->def_cuadro_store(['valor_inicial'=>'Desayuno y Merienda Completa',  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Comedor',                       'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Simple',                 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Doble',                  'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Módulo Completo',               'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);

      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[3,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[4,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['celdas'=> [[6,2]] ]);

    $CN->consistencia_cantidad_x_cuadro(0); // por si hay que eliminar consistencias viejas




// 
//    C.E.F cuadro 2 -> CANTIDAD DE GRUPOS POR TIPO DE ATENCIÓN SEGÚN REGIMEN DE TURNO
//

      $ncuadro=2;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                'nombre'=>'CANTIDAD DE GRUPOS POR TIPO DE ATENCIÓN SEGÚN REGIMEN DE TURNO',
                'descripcion'=>'encabezado de turnos',
                'c_tipo_cuadro'=>1, // de FILAS FIJAS
                'c_criterio_completitud'=>1 , //obligatorio con datos
                'filas'=>8,
                'ancho'=>247,
                'columnas'=>4 ]);

      
      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,8,2]] ]);

      // TITULOS DE FILAS
      $CN->def_cuadro_store(['valor_inicial'=>'TURNOS', 'colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Propia del CEF', 'colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'De otro Servicio Educ.', 'colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'colspan'=>1,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,4]] ]);



      // TITULOS DE COLUMNAS
      $CN->def_cuadro_store(['valor_inicial'=>'Mañana', 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'],
           ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Intermedio','titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'],
           ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Tarde', 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'],
           ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Vespertino','titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'],
           ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Noche', 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'],
           ['celdas'=> [[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Alternado', 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'],
           ['celdas'=> [[7,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'],
           ['celdas'=> [[8,1]] ]);


      //  AREA DE DATOS

      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'], ['region'=> [ [ 2,2,8,4]] ]);
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [2,4,8,4]] ]);


      $CN->def_cuadro_save() ;

      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( [
                'numero' => 1,
                'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => '',
                'msg1' => 'Debe consignar grupos',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'secundaria-cuadro 3, ingresar datos no 0 or on'
                ] );

      $CN->consistencia_save( [
                'numero' => 2,
                'c_tipo_consistencia' => 16, //totales de columna
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => ['tit' => [   '2' => 'Propia del CEF',
                                        '3' => 'De otro Servicio Educ.',
                                        '4' => 'Total'
                                    ]
                          ],
                'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
                'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
                'msg3' => '',    
                'descripcion' => 'secundaria-cuadro 3, Suma de columna xxx <> Total'
                ] );
                                           
      $CN->consistencia_save( [
                'numero' => 3,
                'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => ['col' => [4] ],
                'cmp2' => ['scol' => [[2,3] ]] ,
                'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
                'descripcion' => 'secundaria-cuadro 3, Total   x fila <> suma'
                ] );

      $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas



// //
// // C.E.F cuadro 3 -> ALUMNOS POR TIPO DE ATENCIÓN Y SEXO SEGÚN OFERTA EDUCATIVA
// //

      $ncuadro=3;
      $F->def_formulario_add_cuadro ( [ 'numero'=>$ncuadro,
                'nombre'=>'ALUMNOS POR TIPO DE ATENCIÓN Y SEXO SEGÚN OFERTA EDUCATIVA',
                'descripcion'=>'ALUMNOS del CEF',
                'c_tipo_cuadro'=>2, // 
                'c_criterio_completitud'=>1 , // no puede no TENER DATOS
                'indicaciones'=>'Consignar la matrícula atendida por el CEF y de apoyo a los distintos Niveles de Educación)',
                'ancho'=>900,  
                'filas'=>4,
                'columnas'=>8]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,8]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Oferta Educativa','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Propia del CEF','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'De otro Serv. Educ.','colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,5]] ]);

      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                            ['celdas'=>[[2,2], [2,4],[2,6]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                            ['celdas'=>[[2,3], [2,5],[2,7]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total',  'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                            ['celdas'=>[[2,8]] ]);

      //fila 4
      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>1,'titulo'=>true,'estilos'=>'titulo2','tipo_dato'=>'text'],
                            ['celdas'=>[[4,1]] ]);
     
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'','editable'=>true,'tipo_dato'=>'number'], ['region'=>[ [3,2,4,8] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'18','editable'=>true,'tipo_dato'=>'combobox'], ['celdas'=>[ [3,1]] ]); //combo especialidad
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,6,4,8]] ]);
      //  $CN->def_cuadro_store(['c_mapa'=>144] , [ 'region'=> [ [3,1,3,8], [4,2,4,8] ] ]);


      // SOMBREAR CELDAS
      // $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] , ['region'=> [ [4,7,4,11]] ]);



      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      //  $CN->mapacuadro_store_c_mapa ( 144, [144],'secundaria cuadro 7') ; // 144 = Adultos - Secundaria Completa


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( [
                'numero' => 1,
                'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => '',
                'msg1' => 'Debe consignar alumnos',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'CEF-cuadro 3, ingresar datos no 0 or on'
                ] );

      $CN->consistencia_save( [
                'numero' => 2,
                'c_tipo_consistencia' => 16, //totales de columna
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => ['tit' => [   '2' => 'Propia del CEF / varón ',
                                        '3' => 'Propia del CEF / mujer ',
                                        '4' => 'De otro Serv. Educ. / varón ',
                                        '5' => 'De otro Serv. Educ. / mujer ',
                                        '6' => 'Total / varón ',
                                        '7' => 'Total / mujer ',
                                        '8'=> 'Total / total '
                                    ]
                          ],
                'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
                'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
                'msg3' => '',    
                'descripcion' => 'CEF cuadro 3, Suma de columna xxx <> Total'
                ] );
      $CN->consistencia_save( [
                'numero' => 3,
                'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => ['col' => [6,7,8] ],
                'cmp2' => ['scol' => [[2,4],[3,5],[6,7] ]] ,
                'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
                'descripcion' => 'CEF cuadro 3, Total   x fila <> suma'
                ] );

      $CN->consistencia_save( [
                'numero' => 4,
                'c_tipo_consistencia' => 11, // cuadros dependientes
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => ['cua' => [4] ] ,
                'cmp2' => [] ,
                'cmp3' => '',
                'msg1' => '',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'CEF -cuadro 3, control de cuadros dependientes'
                ] );                    

      $CN->consistencia_cantidad_x_cuadro(4); // por si hay que eliminar consistencias viejas




//
// CEF cuadro 4 -> ALUMNOS POR SEXO NO BINARIO
//

      $ncuadro=4;
      $F->def_formulario_add_cuadro ( 
                [
                  'numero'=>$ncuadro,
                  'nombre'=>'ALUMNOS POR CICLO SEGÚN SEXO, NO BINARIO',
                  'descripcion'=>'ALUMNOS POR CICLO SEGÚN SEXO, NO BINARIO de inicial',
                  'c_tipo_cuadro'=>1,
                  'c_criterio_completitud'=>1 , // obligatorio DATOS
                  'indicaciones'=>'Nota: En concordancia con decreto DCTO-2021-476-APN-PTE.',                                                                                            
                  'ancho'=>500,
                  'filas'=>5,
                  'columnas'=>2 
                ]);
          
      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir
          
      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,5,2]] ]);
          
      // TITULOS DE FILAS
          
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'SEXO','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Alumnos del C.E.F.'
                            , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
          
      //filas 2 a 5
      $CN->def_cuadro_store(['valor_inicial'=>'Masculino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Femenino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'X (no binario)', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
          
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
          
          
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['region'=> [ [2,2,5,2]] ]);
          
      $CN->def_cuadro_save() ;
          

      // DEFINIR CONSISTENCIAS
          
      $CN->consistencia_save( 
                [
                  'numero' =>  1,
                  'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
                  'c_categoria_consistencia' =>  3, // Consistencia de Error
                  'c_estado' =>  1, // Consistencia activa
                  'cmp1' => [] ,
                  'cmp2' => [] ,
                  'cmp3' => '',
                  'msg1' => 'Debe consignar alumnos',
                  'msg2' => '',
                  'msg3' => '',    
                  'descripcion' => 'C.E.F. -cuadro 4, ingresar datos no 0 or on'
                ] );
              
      $CN->consistencia_save( 
                [
                  'numero' =>  2,
                  'c_tipo_consistencia' => 16, //totales de columna
                  'c_categoria_consistencia' =>  3, // Consistencia de Error
                  'c_estado' =>  1 , // Consistencia activa
                  'cmp1' => [] ,
                  'cmp2' => [] ,
                  'cmp3' => ['tit' => [   '2' => 'alumnos del C.E.F ',
                                      ]
                            ],
                  'msg1' => 'La suma de la columna de ', //  'Total de las modalidades',
                  'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
                  'msg3' => '',    
                  'descripcion' => 'C.E.F.-cuadro 4, Suma de columna xxx <> Total'
                ] );                      
                      
      $CN->consistencia_save( 
                [
                  'numero' => 3,
                  'c_tipo_consistencia' => 25, // consistencia de comparacion menor val1, val1_1,val1_2 < val2
                  'c_categoria_consistencia' =>  3, // Consistencia de Error
                  'c_estado' =>  1, // Consistencia activa
                            // celdas a comparar del cuadro
                  'cmp1' => ['v1'=> [ [[[ 5,2]] ], //  alumnos C.E.F

                                    ]
                            ], 
                  'cmp2' => ['v2'=>[   // celdas de otros cuadros a sumar para la comparación
                                      ['cel'=>[[3,0,8]]],  //Total C.E.F
                                    ],
                              'sig'=>'!=',
                            ],
                  'cmp3' => ['d1'=> [ [ 'alumnos del C.E.F'],
                                    ],                              
                            'd2'=>  [ ['3'],
                                    ]
                            ],
                  'msg1' => 'El total de ',
                  'msg2' => ' es distintos de lo informado en cuadro ',
                  'msg3' => '',    
                  'descripcion' => 'C.E.F.-cuadro 4, comparacion de alumnos diferentes'
                ] );
                      
      $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas



      $F->def_formulario_save();  

      //dd($F); 
      return ($F);



}     // FROMULARIO DE CEF  







//////////////////////////////
///////////////////////////////
//////////////////////////////
///////////////////////////////
//////////////////////////////
///////////////////////////////










static public function I2024_CIIE($id_definicion_formulario)
    {

       
////////////////////////////       
//definir un nuevo formulario
//////////////////////////////
///////////////////////////////

      $F = new DefinicionFormularioController( $id_definicion_formulario);  // crear o cargar el formulario

      //$F->delete_consistencias();

      $F->nombre='MATRÍCULA INICIAL 2024 - CIIE';
      $F->nombre_corto='CIIE';
      $F->descripcion='Planilla Relevamiento Inicial 2024 de CIIE';
      $F->id_periodo='106';
      $F->color='f_verde';

      //asignar los tipo de organizacion del formulario
      Def_formulario_organizacion::updateOrCreate( [  'id_definicion_formulario'=> $F->id_definicion_formulario, 'c_organizacion'=> 'IC'] );



// 
//    CIIE cuadro 1 -> TURNOS DE FUNCIONAMIENTO
//
      $ncuadro=1;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                'nombre'=>'TURNOS DE FUNCIONAMIENTO',
                'descripcion'=>'encabezado de turnos',
                'c_tipo_cuadro'=>4, // de combobox
                'c_criterio_completitud'=>1 , //obligatorio con datos
                'filas'=>8,
                'ancho'=>247,
                'columnas'=>2 ]);

      
      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,8,2]] ]);

      // TITULOS DE FILAS
      $CN->def_cuadro_store(['valor_inicial'=>'TURNOS', 'colspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);

      // TITULOS DE COLUMNAS
      $CN->def_cuadro_store(['valor_inicial'=>'Mañana',            'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Intermedio',        'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Tarde',             'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Vespertino',        'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Noche',             'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[6,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Doble Escolaridad', 'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[7,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Alternado',         'titulo'=>true, 'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[8,1]] ]);


      //       // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[3,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[4,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[5,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[6,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>false,'tipo_dato'=>'checkbox'] , ['celdas'=> [[7,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'false', 'editable'=>true,'tipo_dato'=>'checkbox'] , ['celdas'=> [[8,2]] ]);

      $CN->def_cuadro_save() ;


      $CN->consistencia_save( [
                'numero' => 1,
                'c_tipo_consistencia' => 10, // con datos no 0 or on
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => '',
                'msg1' => 'Debe consignar al menos un turno',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'CIIE-cuadro 1, ingresar al menos un turno'
                ] );

      $CN->consistencia_cantidad_x_cuadro(1); // por si hay que eliminar consistencias viejas





// //
// // CIIE cuadro 2 -> ALUMNOS DE CURSOS PRESENCIALES SEGÚN NIVELES/MODALIDADES, ÁREAS y SEXO
// //

      $ncuadro=2;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                'nombre'=>'ALUMNOS DE CURSOS PRESENCIALES SEGÚN NIVELES/MODALIDADES, ÁREAS y SEXO',
                'descripcion'=>'ALUMNOS del CIIE',
                'c_tipo_cuadro'=>2, // 
                'c_criterio_completitud'=>2 , // puede no TENER DATOS
                'ancho'=>650,  
                'filas'=>4,
                'columnas'=>4]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,4]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Niveles / Modalidades / Área','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total de Matrícula','colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);

      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                            ['celdas'=>[[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                            ['celdas'=>[[2,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total',  'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                            ['celdas'=>[[2,4]] ]);

      //fila 4
      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>1,'titulo'=>true,'estilos'=>'titulo2','tipo_dato'=>'text'],
                            ['celdas'=>[[4,1]] ]);
     
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'','editable'=>true,'tipo_dato'=>'number'], ['region'=>[ [3,2,4,4] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'19','editable'=>true,'tipo_dato'=>'combobox'], ['celdas'=>[ [3,1]] ]); //combo especialidad
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,4,4,4]] ]);
      //  $CN->def_cuadro_store(['c_mapa'=>144] , [ 'region'=> [ [3,1,3,8], [4,2,4,8] ] ]);


      // SOMBREAR CELDAS
      // $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] , ['region'=> [ [4,7,4,11]] ]);



      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      //  $CN->mapacuadro_store_c_mapa ( 144, [144],'secundaria cuadro 7') ; // 144 = Adultos - Secundaria Completa


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( [
                'numero' => 1,
                'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => '',
                'msg1' => 'Debe consignar alumnos',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'CIIE-cuadro 2, ingresar datos no 0 or on'
                ] );

      $CN->consistencia_save( [
                'numero' => 2,
                'c_tipo_consistencia' => 16, //totales de columna
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => ['tit' => [   '2' => 'Varón ',
                                        '3' => 'Mujer ',
                                        '4' => 'Total'
                                    ]
                          ],
                'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
                'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
                'msg3' => '',    
                'descripcion' => 'CIIE cuadro 2, Suma de columna xxx <> Total'
                ] );
                

                           
      $CN->consistencia_save( [
                'numero' => 3,
                'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => ['col' => [4] ],
                'cmp2' => ['scol' => [[2,3] ]] ,
                'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
                'descripcion' => 'CIIE cuadro 2, Total   x fila <> suma'
                ] );

      $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas






// //
// // CIIE cuadro 3 -> ALUMNOS DE CURSOS A DISTANCIA/VIRTUAL SEGÚN NIVELES/MODALIDADES, ÁREAS y SEXO
// //

      $ncuadro=3;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                'nombre'=>'ALUMNOS DE CURSOS A DISTANCIA/VIRTUAL SEGÚN NIVELES/MODALIDADES, ÁREAS y SEXO',
                'descripcion'=>'ALUMNOS del CIIE A DISTANCIA',
                'c_tipo_cuadro'=>2, // 
                'c_criterio_completitud'=>2 , // puede no TENER DATOS
                'ancho'=>650,  
                'filas'=>4,
                'columnas'=>4]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,4]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Niveles / Modalidades / Área','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total de Matrícula','colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);

      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                            ['celdas'=>[[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                            ['celdas'=>[[2,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total',  'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                            ['celdas'=>[[2,4]] ]);

      //fila 4
      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>1,'titulo'=>true,'estilos'=>'titulo2','tipo_dato'=>'text'],
                            ['celdas'=>[[4,1]] ]);
     
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'','editable'=>true,'tipo_dato'=>'number'], ['region'=>[ [3,2,4,4] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'20','editable'=>true,'tipo_dato'=>'combobox'], ['celdas'=>[ [3,1]] ]); //combo especialidad
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,4,4,4]] ]);
      //  $CN->def_cuadro_store(['c_mapa'=>144] , [ 'region'=> [ [3,1,3,8], [4,2,4,8] ] ]);


      // SOMBREAR CELDAS
      // $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] , ['region'=> [ [4,7,4,11]] ]);



      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      //  $CN->mapacuadro_store_c_mapa ( 144, [144],'secundaria cuadro 7') ; // 144 = Adultos - Secundaria Completa


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( [
                'numero' => 1,
                'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => '',
                'msg1' => 'Debe consignar alumnos',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'CIIE-cuadro 3, ingresar datos no 0 or on'
                ] );

      $CN->consistencia_save( [
                'numero' => 2,
                'c_tipo_consistencia' => 16, //totales de columna
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => ['tit' => [   '2' => 'Varón ',
                                        '3' => 'Mujer ',
                                        '4' => 'Total'
                                    ]
                          ],
                'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
                'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
                'msg3' => '',    
                'descripcion' => 'CIIE cuadro 3, Suma de columna xxx <> Total'
                ] );
                

                           
      $CN->consistencia_save( [
                'numero' => 3,
                'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => ['col' => [4] ],
                'cmp2' => ['scol' => [[2,3] ]] ,
                'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
                'descripcion' => 'CIIE cuadro 3, Total   x fila <> suma'
                ] );

      $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas






// //
// // CIIE cuadro 4 -> ALUMNOS DE ASISTENCIAS TÉCNICAS SEGÚN NIVELES / MODALIDADES, ÁREAS Y SEXO
// //

      $ncuadro=4;
      $F->def_formulario_add_cuadro ( [   'numero'=>$ncuadro,
                'nombre'=>'ALUMNOS DE ASISTENCIAS TÉCNICAS SEGÚN NIVELES / MODALIDADES, ÁREAS Y SEXO',
                'descripcion'=>'ALUMNOS deel CIEE asistencia Técnica',
                'c_tipo_cuadro'=>2, // 
                'c_criterio_completitud'=>2 , // puede no TENER DATOS                      
                'ancho'=>650,  
                'filas'=>4,
                'columnas'=>4]);

      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir

      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,4,4]] ]);

      // TITULOS DE FILAS
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'Niveles / Modalidades / Área','rowspan'=>2,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total de Matrícula','colspan'=>3,'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);

      //fila 2
      $CN->def_cuadro_store(['valor_inicial'=>'Varón', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                            ['celdas'=>[[2,2]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Mujer', 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                            ['celdas'=>[[2,3]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Total',  'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'],
                            ['celdas'=>[[2,4]] ]);

      //fila 4
      $CN->def_cuadro_store(['valor_inicial'=>'Total','colspan'=>1,'titulo'=>true,'estilos'=>'titulo2','tipo_dato'=>'text'],
                            ['celdas'=>[[4,1]] ]);
     
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'','editable'=>true,'tipo_dato'=>'number'], ['region'=>[ [3,2,4,4] ] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'21','editable'=>true,'tipo_dato'=>'combobox'], ['celdas'=>[ [3,1]] ]); //combo especialidad
      $CN->def_cuadro_store(['editable'=>false,'tipo_dato'=>'total_calculado'] , ['region'=> [ [3,4,4,4]] ]);
      //  $CN->def_cuadro_store(['c_mapa'=>144] , [ 'region'=> [ [3,1,3,8], [4,2,4,8] ] ]);


      // SOMBREAR CELDAS
      // $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>false,'tipo_dato'=>'number'] , ['region'=> [ [4,7,4,11]] ]);



      $CN->def_cuadro_save() ;

      // DEFINIR mapa_cuadro DEL CUADRO
      //  $CN->mapacuadro_store_c_mapa ( 144, [144],'secundaria cuadro 7') ; // 144 = Adultos - Secundaria Completa


      // DEFINIR CONSISTENCIAS

      $CN->consistencia_save( [
                'numero' => 1,
                'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => '',
                'msg1' => 'Debe consignar alumnos',
                'msg2' => '',
                'msg3' => '',    
                'descripcion' => 'CIIE-cuadro 4, ingresar datos no 0 or on'
                ] );

      $CN->consistencia_save( [
                'numero' => 2,
                'c_tipo_consistencia' => 16, //totales de columna
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => [] ,
                'cmp2' => [] ,
                'cmp3' => ['tit' => [   '2' => 'Varón ',
                                        '3' => 'Mujer ',
                                        '4' => 'Total'
                                    ]
                          ],
                'msg1' => 'La suma de la columna ', //  'Total de las modalidades',
                'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
                'msg3' => '',    
                'descripcion' => 'CIIE cuadro 4, Suma de columna xxx <> Total'
                ] );
                

                           
      $CN->consistencia_save( [
                'numero' => 3,
                'c_tipo_consistencia' => 14, //consistencia 14 para re-calculo de totales x fila y columna
                'c_categoria_consistencia' =>  3, // Consistencia de Error
                'c_estado' =>  1, // Consistencia activa
                'cmp1' => ['col' => [4] ],
                'cmp2' => ['scol' => [[2,3] ]] ,
                'cmp3' => '', 'msg1' => '', 'msg2' => '', 'msg3' => '',    
                'descripcion' => 'CIIE cuadro 4, Total   x fila <> suma'
                ] );

      $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas




//
//    CIIE cuadro 5 -> ALUMNOS POR SEXO NO BINARIO
//

      $ncuadro=5;
      $F->def_formulario_add_cuadro ( 
                [
                  'numero'=>$ncuadro,
                  'nombre'=>'ALUMNOS POR CICLO SEGÚN SEXO, NO BINARIO',
                  'descripcion'=>'ALUMNOS POR CICLO SEGÚN SEXO, NO BINARIO de inicial',
                  'c_tipo_cuadro'=>1,
                  'c_criterio_completitud'=>1 , // obligatorio DATOS
                  'indicaciones'=>'Nota: En concordancia con decreto DCTO-2021-476-APN-PTE.',                                                                                            
                  'ancho'=>500,
                  'filas'=>5,
                  'columnas'=>2 
                ]);
          
      $CN=$F->cuadros[$ncuadro]; // cargo un alias del cuadro a redefinir
          
      // inicializar las celdas del cuadro
      $CN->def_cuadro_store(['valor_inicial'=>'','rowspan'=>1, 'colspan'=>1,'estilos'=>'','editable'=>false, 'titulo'=>false , 'tipo_dato'=>'null' ],  ['region'=> [ [1,1,5,2]] ]);
          
      // TITULOS DE FILAS
          
      //fila 1
      $CN->def_cuadro_store(['valor_inicial'=>'SEXO','titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Alumnos del C.I.I.E.'
                            , 'titulo'=>true,'estilos'=>'titulo1', 'tipo_dato'=>'text'], ['celdas'=> [[1,2]] ]);
          
      //filas 2 a 5
      $CN->def_cuadro_store(['valor_inicial'=>'Masculino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[2,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'Femenino', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[3,1]] ]);
      $CN->def_cuadro_store(['valor_inicial'=>'X (no binario)', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[4,1]] ]);
          
      $CN->def_cuadro_store(['valor_inicial'=>'Total', 'titulo'=>true,'estilos'=>'titulo2', 'tipo_dato'=>'text'], ['celdas'=> [[5,1]] ]);
          
          
      // AREA DE DATOS
      $CN->def_cuadro_store(['valor_inicial'=>'', 'editable'=>true,'tipo_dato'=>'number'] , ['region'=> [ [2,2,5,2]] ]);
          
      $CN->def_cuadro_save() ;
          

      // DEFINIR CONSISTENCIAS
          
      $CN->consistencia_save( 
                [
                  'numero' =>  1,
                  'c_tipo_consistencia' => 10, // cuadro con datos no 0 or on
                  'c_categoria_consistencia' =>  3, // Consistencia de Error
                  'c_estado' =>  1, // Consistencia activa
                  'cmp1' => [] ,
                  'cmp2' => [] ,
                  'cmp3' => '',
                  'msg1' => 'Debe consignar alumnos',
                  'msg2' => '',
                  'msg3' => '',    
                  'descripcion' => 'C.I.I.E. -cuadro 5, ingresar datos no 0 or on'
                ] );
            
      $CN->consistencia_save( 
                [
                  'numero' =>  2,
                  'c_tipo_consistencia' => 16, //totales de columna
                  'c_categoria_consistencia' =>  3, // Consistencia de Error
                  'c_estado' =>  1 , // Consistencia activa
                  'cmp1' => [] ,
                  'cmp2' => [] ,
                  'cmp3' => ['tit' => [   '2' => 'alumnos del C.I.I.E. ',
                                      ]
                            ],
                  'msg1' => 'La suma de la columna de ', //  'Total de las modalidades',
                  'msg2' => 'no se corresponde con el total declarado', //es distinto de suma de las modalidades.',
                  'msg3' => '',    
                  'descripcion' => 'C.I.I.E.-cuadro 5, Suma de columna xxx <> Total'
                ] );                      
                          
      $CN->consistencia_save( 
                [
                  'numero' => 3,
                  'c_tipo_consistencia' => 25, // consistencia de comparacion menor val1, val1_1,val1_2 < val2
                  'c_categoria_consistencia' =>  3, // Consistencia de Error
                  'c_estado' =>  1, // Consistencia activa
                            // celdas a comparar del cuadro
                  'cmp1' => ['v1'=> [ [[[ 5,2]] ], //  alumnos C.I.I.E.

                                    ]
                            ], 
                  'cmp2' => ['v2'=>[   // celdas de otros cuadros a sumar para la comparación
                                      ['cel'=>[[2,0,4],[3,0,4],[4,0,4]]],  //Total C.I.I.E.
                                    ],
                              'sig'=>'!=',
                            ],
                  'cmp3' => ['d1'=> [ [ 'alumnos del C.I.I.E.'],
                                    ],                              
                            'd2'=>  [ ['2,3 y 4'],
                                    ]
                            ],
                  'msg1' => 'El total de ',
                  'msg2' => ' es distintos de lo informado en cuadros ',
                  'msg3' => '',    
                  'descripcion' => 'C.I.I.E.-cuadro 5, comparacion de alumnos diferentes'
                ] );
                      
      $CN->consistencia_cantidad_x_cuadro(3); // por si hay que eliminar consistencias viejas




      $F->def_formulario_save();  

      //dd($F); 
      return ($F);



}  // FROMULARIO DE CIIE  






//////////////////////////////
///////////////////////////////
//////////////////////////////
///////////////////////////////
//////////////////////////////
///////////////////////////////








}

