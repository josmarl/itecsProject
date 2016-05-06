<?php

/*
  |--------------------------------------------------------------------------
  | Register The Laravel Class Loader
  |--------------------------------------------------------------------------
  |
  | In addition to using Composer, you may use the Laravel class loader to
  | load your controllers and models. This is useful for keeping all of
  | your classes in the "global" namespace without Composer updating.
  |
 */

ClassLoader::addDirectories(array(
    app_path() . '/commands',
    app_path() . '/controllers',
    app_path() . '/models',
    app_path() . '/database/seeds',
    app_path() . '/constants',
    
));

/*
  |--------------------------------------------------------------------------
  | Application Error Logger
  |--------------------------------------------------------------------------
  |
  | Here we will configure the error logger setup for the application which
  | is built on top of the wonderful Monolog library. By default we will
  | build a basic log file setup which creates a single file for logs.
  |
 */

Log::useFiles(storage_path() . '/logs/laravel.log');

/*
  |--------------------------------------------------------------------------
  | Application Error Handler
  |--------------------------------------------------------------------------
  |
  | Here you may handle any errors that occur in your application, including
  | logging them or displaying custom views for specific errors. You may
  | even register several error handlers to handle different types of
  | exceptions. If nothing is returned, the default error view is
  | shown, which includes a detailed stack trace during debug.
  |
 */

App::missing(function($exception) {

    /*     * *****Verificar Login******* */
    $login = true;
    /*     * *****Verificar Login******* */

    if ($login) {
        return Response::view('error.404', array(), 404);
    }
});

//origin
//App::error(function(Exception $exception, $code)
//{
//	Log::error($exception);
//});

/*
  |--------------------------------------------------------------------------
  | Maintenance Mode Handler
  |--------------------------------------------------------------------------
  |
  | The "down" Artisan command gives you the ability to put an application
  | into maintenance mode. Here, you will define what is displayed back
  | to the user if maintenance mode is in effect for the application.
  |
 */

App::down(function() {
    return Response::make("Be right back!", 503);
});



/* * ************* GUARDAR LOG DE CONSULTA SQL *************** */
/*
DB::listen(function($sql, $bindings, $times) {
    $queries = DB::getQueryLog();
    $last_query = end($queries);
    
    Log::useFiles(storage_path() . '/logs/ropc_log_query.log', 'alert');
    Log::alert('', array('user' => Session::get('usuario.username'),
        ',proceso' => Session::get('proceso'),
        ',host' => Config::get('database.connections.oracle.host'),
        ',bd' => DB::getDatabaseName(),
        ',service_name' => Config::get('database.connections.oracle.service_name'),
        ',consulta' => $last_query,
        ',times' => $times
    ));
});
*/

/* * ************* GUARDAR LOG DE ERRORES*************** */
App::error(function(Exception $exc, $code) {
    Log::useFiles(storage_path() . '/logs/sirec_log_error.log', 'error');
    Log::error('', array('user' => Session::get('usuario.username'),
        ',proceso' => Session::get('proceso'),
        ',Error' => $exc->getMessage(),
        ',Tracer' => $exc->getTraceAsString(),
        ',code' => $code));
});



/*
  |--------------------------------------------------------------------------
  | Require The Filters File
  |--------------------------------------------------------------------------
  |
  | Next we will load the filters file for the application. This gives us
  | a nice separate location to store our route and application filter
  | definitions instead of putting them all in the main routes file.
  |
 */

require app_path() . '/filters.php';
