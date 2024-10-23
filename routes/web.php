<?php
// Route::get('/', function () {
//     return view('welcome');
// });

    Route::get('/', function () {
        return view('auth.login');
    });

    // Descargar planillas
    Route::get('/descargar_planillas/{periodo}', 'LocalizacionController@descargar_planillas')->name('descargar_planillas');
    
    Route::get('/relant', 'LocalizacionController@relant')->name('relant');
    
Auth::routes(['register' => false]);

Route::group( ['middleware' => ['auth','checkusersistema']], function() {
    Route::get('/home', 'HomeController@index')->name('home');

    // LOCALIZACIONES
    Route::get('/localizacion/{idperiodo}', 'LocalizacionController@index')->name('localizacion');

    // FORMULARIOS
    Route::get('/formulario/{id}/{start?}', 'LocalizacionController@formulario')->name('formulario');
    Route::post('/grabarformulario', 'LocalizacionController@grabarformulario')->name('grabarformulario'); 
    Route::get('/editformulario/{id}/{excel?}', 'LocalizacionController@show')->name('editformulario'); 
    Route::post('/eliminarformulario/{id}', 'LocalizacionController@eliminarformulario')->name('eliminarformulario');
    Route::post('/confirmarformulario/{id}', 'LocalizacionController@confirmarformulario')->name('confirmarformulario');
    Route::post('/desconfirmarformulario/{id}', 'LocalizacionController@desconfirmarformulario')->name('desconfirmarformulario');
    Route::post('/declaracionjurada/{id}', 'LocalizacionController@declaracionjurada')->name('declaracionjurada');
    Route::post('/formulariopdf/{id}', 'LocalizacionController@impresion_formulario')->name('impresion_formulario');

    // VERIFICAR DATOS
    Route::post('/verificacion_datos/{id}', 'LocalizacionController@verificacion_datos')->name('verificacion_datos');
    Route::post('/update_verificacion_datos/{id}', 'LocalizacionController@update_verificacion_datos')->name('update_verificacion_datos');
    Route::post('/grabar_domi/{id}', 'LocalizacionController@grabar_domi')->name('grabar_domi');

    // GRILLA EXCEL
    Route::get('/grilla_excel/{periodo}/', 'LocalizacionController@grilla_excel')->name('grilla_excel');

    // SERVICIOS EDUCATIVOS
    Route::get('/pservicio/{idperiodo}', 'LocalizacionController@pservicio')->name('pservicio');
    Route::get('/new_pservicio', 'LocalizacionController@new_pservicio')->name('new_pservicio');   
    Route::post('/edit_servicio_educativo/{id}', 'LocalizacionController@edit_servicio_educativo')->name('edit_servicio_educativo');
    Route::post('/edit_pservicio/{id}', 'LocalizacionController@edit_pservicio')->name('edit_pservicio');
    Route::post('/eliminarservicio/{id}', 'LocalizacionController@eliminarservicio')->name('eliminarservicio');
    Route::post('/print_planilla_servicios/{id}', 'LocalizacionController@print_planilla_servicios')->name('print_planilla_servicios');
    Route::get('/grilla_excel_pservicios/{periodo}/', 'LocalizacionController@grilla_excel_pservicios')->name('grilla_excel_pservicios');

    // USUARIOS
    Route::get('/usuarios', 'UserController@index')->name('usuarios');
    Route::get('/newuser', 'UserController@getnewuser')->name('newuser');
    Route::post('/adduser', 'UserController@postnewuser')->name('adduser');
    Route::post('/edituser/{id}', 'UserController@getedituser')->name('edituser');
    Route::post('/saveuser/{id}', 'UserController@postedituser')->name('saveuser');
    Route::post('/deleteuser/{id}', 'UserController@deleteuser')->name('deleteuser');
    Route::post('/edituserpass/{id}', 'UserController@geteditpass')->name('edituserpass'); 
    Route::post('/saveuserpass/{id}', 'UserController@posteditpass')->name('saveuserpass'); 

    // PERIODO
    Route::get('/periodo', 'HomeController@periodo')->name('periodo');	
    Route::get('/newperiodo', 'HomeController@getnewperiodo')->name('newperiodo');
    Route::post('/addperiodo','HomeController@postnewperiodo')->name('addperiodo');
    Route::post('/editperiodo/{id}', 'HomeController@geteditperiodo')->name('editperiodo');
    Route::post('/saveperiodo/{id}', 'HomeController@posteditperiodo')->name('saveperiodo');

    // PROCESOS
    Route::get('/select_periodo/{ruta}/{titulo}', 'LocalizacionController@select_periodo')->name('select_periodo');
        // Articulacion
    Route::post('/proceso_articulacion/{id}', 'Padron\ArticulacionController@proceso_articulacion')->name('proceso_articulacion');    
        // Confirmar completos 
    Route::post('/confirmar_completos/{id}', 'LocalizacionController@confirmar_completos')->name('confirmar_completos');
    // Revisar consitencias
    Route::post('/revisar_consistencias/{id}', 'LocalizacionController@revisar_consistencias')->name('revisar_consistencias');

    // ESTADISTICA
    Route::get('/estadistica/{idperiodo}/{excel?}', 'LocalizacionController@estadistica')->name('estadistica');	
    Route::get('/fichaestadistica/{id}/{id_localizacion_periodo}', 'LocalizacionController@fichaestadistica')->name('fichaestadistica');

    Route::get('/estadisticacarga/{id_localizacion_periodo}', 'LocalizacionController@estadisticacarga')->name('estadisticacarga');

    // MAIL
    Route::get('/mailing/{periodo}', 'LocalizacionController@mailing')->name('mailing');
    Route::get('/ver_verificacion_datos/{id}/{p}', 'LocalizacionController@ver_verificacion_datos')->name('ver_verificacion_datos');
    Route::get('/redactarmail/{id}/{periodo}', 'LocalizacionController@redactarmail')->name('redactarmail');
    Route::get('/enviodemail/{periodo}/{id?}', 'LocalizacionController@enviodemail')->name('enviodemail');
    Route::get('/mail_personalizado/{id?}/{p}', 'LocalizacionController@mail_personalizado')->name('mail_personalizado');
    
    Route::get('/generar_formularios', 'Formulario\ArmarFormularioController@generar_formularios');
    Route::get('/actulizar_users', 'Padron\ArticulacionController@actulizar_users');
});
