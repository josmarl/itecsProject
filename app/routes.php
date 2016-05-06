<?php

/* * ************* HOME *************** */

Route::get('menu', 'HomeController@showWelcome');
Route::get('usuario/index', array('uses' => 'UsuarioController@index'));
Route::post('usuario/login', array('uses' => 'UsuarioController@login'));
Route::get('usuario/exit', array('uses' => 'UsuarioController@salir'));

Route::group(array('before' => 'auth.login'), function() {
    Route::get('/', 'HomeController@dashboarIndex');
    Route::get('usuario/procesos', 'UsuarioController@getProcesosElectorales');
    Route::get('usuario/esquema/{esquema}', 'UsuarioController@searchEsquema');
    Route::get('usuario/modulos', 'UsuarioController@getModulos');
    Route::post('modulos/index/{param}', 'ModulosController@index');
    Route::get('modulos/index/{param}', 'ModulosController@index');

    Route::get('local/obtenerLocales/{ubigeo}', 'LocalController@obtenerLocales');
    Route::get('ubigeo/obtenerDistritos/{ambito}', 'UbigeoController@obtenerDistritos');
    Route::get('ubigeo/fetch/{ambito?}', array('uses' => 'UbigeoController@fetch'));
    Route::post('credencial/search', array('uses' => 'CredencialController@searchCredencial'));
    Route::post('credencial/remove', array('uses' => 'CredencialController@removeCredencial'));
    Route::post('credencial/list', array('uses' => 'CredencialController@getCredenciales'));


    Route::get('consulta/cred-cargo/exporta', array('uses' => 'ConsultaController@credCargoExport'));
    Route::get('consulta/cred-entregada/exporta', array('uses' => 'ConsultaController@credEntregadasExport'));
    Route::get('consulta/buscar-mesa/exporta', 'ConsultaController@buscarMesaExport');

    Route::post('consulta/searchMesa', 'ConsultaController@searchMesa');
    Route::post('consulta/searchDistrito', 'ConsultaController@searchDistrito');
    Route::post('consulta/cred-entregada', array('uses' => 'ConsultaController@credEntregadas'));
    Route::post('consulta/cred-cargo', array('uses' => 'ConsultaController@credCargo'));
    Route::post('consulta/credencial-mmesa/cred-mmesa-odpe', array('uses' => 'ConsultaController@credMiembrosMesa'));
    Route::post('consulta/credencial-mmesa/cred-mmesa-dis', array('uses' => 'ConsultaController@credMiembrosMesa'));
    Route::get('consulta/credencial-mmesa/exporta', array('uses' => 'ConsultaController@credMiembrosMesaExport'));
    Route::post('consulta/credencial-mmesa/cred-entreg-local', array('uses' => 'ConsultaController@credEntregLocal'));
    Route::get('consulta/credencial-mmesa/cred-entreg-local/exporta', array('uses' => 'ConsultaController@credEntregadasByLocalExcel'));


    Route::group(array('before' => 'auth.option'), function() {
        Route::get('consulta/buscar_mesa', 'ConsultaController@buscarMesaIndex');
        Route::get('consulta/credencial', array('uses' => 'ConsultaController@credEntregadaIndex'));
        Route::get('consulta/credencial-cargo', array('uses' => 'ConsultaController@credByCargoIndex'));
        Route::get('consulta/credencial-mmesa/{tipo}', array('uses' => 'ConsultaController@credByAmbitoIndex'));
        Route::get('consulta/credencial-local', array('uses' => 'ConsultaController@credEntregadaLocalIndex'));
        Route::get('capacitaciones/index', 'CapacitacionController@index');
    });
    Route::get('credencial/index', array('uses' => 'CredencialController@index'));
});

Route::get('capacitaciones/index', 'CapacitacionController@index');
Route::get('capacitaciones/lstTiposCapacitacion', array('uses' => 'CapacitacionController@listaTipoCapacitacion'));
Route::post('capacitaciones/doUploadExcel', array('uses' => 'CapacitacionController@uploadExcelCap'));

Route::get('proyecto/list-view', array('uses' => 'ProyectoController@viewProyecto'));
Route::post('proyecto/list', array('uses' => 'ProyectoController@fetchProyecto'));
Route::post('proyecto/save', array('uses' => 'ProyectoController@saveProyecto'));
Route::post('proyecto/remove', array('uses' => 'ProyectoController@removeProyecto'));

Route::post('persona/list', array('uses' => 'PersonaController@fetchPersona'));
Route::get('persona/list-view', array('uses' => 'PersonaController@viewPersona'));

Route::get('backlog/list-view/{proyecto}', array('uses' => 'BacklogController@viewBacklog'));
Route::post('backlog/list/{proyecto}', array('uses' => 'BacklogController@getBacklogByProyecto'));
Route::post('backlog/list-personas/{proyecto}', array('uses' => 'BacklogController@fetchPersonaByProyecto'));
Route::post('backlog/list-complejidad', array('uses' => 'BacklogController@fetchComplejidad'));
Route::post('backlog/save', array('uses' => 'BacklogController@saveBacklog'));
Route::post('backlog/remove', array('uses' => 'BacklogController@removeBacklog'));



