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
$router->get('/popup/datos_cuenta', function () use ($router) {
    return view('datos_cuenta');
});
$router->get('/popup/faq', function () use ($router) {
    return view('faq');
});

$router->get('/popup/proyecto_conservacion', 'AreasController@index');

$router->post('/subscribe','HomeController@subscribe');
$router->get('certificados/confirmar','CertificadosController@confirmar');
$router->post('certificados/crear','CertificadosController@crear');
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

    });
    //
    

    
});
