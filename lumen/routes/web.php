<?php
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/*$router->get('/', function () use ($router) {
    return $router->app->version();
});*/

/*INICIO WEB SITE*/

$router->get('/', 'HomeController@home');
$router->get('/en', 'HomeController@home');
$router->get('/es', 'HomeController@home');
$router->get('/semillas', 'HomeController@semillas');


$router->get('/response/', 'HomeController@response');
$router->get('/response/es', 'HomeController@response');
$router->get('/response/en', 'HomeController@response');
$router->post('/response', 'HomeController@response');
$router->post('/response/', 'HomeController@response');

$router->get('/popup/datos_cuenta', 'HomeController@datos');
$router->get('/popup/datos_cuenta/es', 'HomeController@datos');
$router->get('/popup/datos_cuenta/en', 'HomeController@datos');


$router->get('/popup/faq', 'HomeController@faq');
$router->get('/popup/faq/en', 'HomeController@faq');
$router->get('/popup/faq/es', 'HomeController@faq');

$router->get('/popup/politicas', 'HomeController@politicas');
$router->get('/popup/politicas/en', 'HomeController@politicas');
$router->get('/popup/politicas/es', 'HomeController@politicas');

$router->get('/popup/proyecto_conservacion', 'AreasController@index');
$router->get('/popup/proyecto_conservacion/en', 'AreasController@index');
$router->get('/popup/proyecto_conservacion/es', 'AreasController@index');

$router->post('/subscribe','HomeController@subscribe');
$router->get('certificados/confirmar','CertificadosController@confirmar');
$router->get('certificados/confirmar/en','CertificadosController@confirmar');
$router->post('certificados/crear','CertificadosController@crear');
$router->post('certificados/crear/en','CertificadosController@crear');
$router->post('certificados/grabar','CertificadosController@grabar');


/*FIN WEB SITE*/


$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('auth', 'UserController@auth');
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return response()->json(['status' => 'success', 'data' => $router->app->version()]);
    });
    //login
    $router->post('/login','UserController@authenticate');
    $router->post('/pagos/login','UserController@authenticate_pagos');
    //certificado img pdf
    $router->get('/certificados/image', 'CertificadosController@download_img');
    $router->get('/certificados/pdf', 'CertificadosController@download_pdf');

    $router->group(['middleware' => 'auth'], function () use ($router) {
        //test
        $router->get('/indice', 'IndiceController@index');

        //login
        $router->post('/check', 'UserController@check');

        //arboles
        $router->get('/arboles', 'ArbolesController@index');
        $router->post('/arboles', 'ArbolesController@create');
        $router->get('/arboles/{id}', 'ArbolesController@show');
        $router->put('/arboles/{id}', 'ArbolesController@update');
        $router->delete('/arboles/{id}', 'ArbolesController@destroy');
        $router->post('/arboles/importar', 'ArbolesController@importar');
        $router->post('/arboles/subir', 'ArbolesController@subir');

        $router->get('/arboles/nombres', 'ArbolesController@nombre_arboles');
        $router->get('/arboles/campanias', 'ArbolesController@campanias');

        //codigos
        $router->get('/codigos', 'CodigosController@index');
        $router->post('/codigos/generar', 'CodigosController@generar');
        $router->post('/codigos/generarCantidad', 'CodigosController@generarCantidad');
        $router->post('/codigos/actualizar_reserva', 'CodigosController@actualizar_reserva');

        //certificados
        $router->get('/certificados', 'CertificadosController@index');
        $router->get('/certificados/campanias', 'CertificadosController@campanias');
        $router->post('/certificados/actualizar', 'CertificadosController@actualizar');
        $router->post('/certificados/subir', 'CertificadosController@subir');
        $router->post('/certificados/importar', 'CertificadosController@importar');

        //Campanas
        $router->get('/campanas', 'CampanasController@index');

        //tiposcertificado
        $router->get('/tiposcertificado', 'TiposcertificadoController@index');

        //estadisticas
        $router->get('/estadisticas/data', 'EstadisticasController@estadisticas_data');

        //website
        $router->get('/website', 'WebsiteController@index');
        $router->post('/website', 'WebsiteController@grabar');
        $router->post('/website/aliando', 'WebsiteController@aliados');

        //areas
        $router->get('/areas', 'AreasController@listar');
        $router->put('/areas', 'AreasController@update');
        $router->post('/areas', 'AreasController@new');
        $router->delete('/areas', 'AreasController@delete');

        $router->post('/areas/subir', 'AreasController@subir');

        //pagos
        $router->get('/pagos', 'PagosController@index');

    });
    //
    

    
});
