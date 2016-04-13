<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::controller('login', 'LoginController');
Route::controller('pacientes', 'PacientesController');
Route::controller('accidentes-trabajo', 'AccidentesTrabajoController');
Route::controller('antecedentes-laborales', 'AntecedentesLaboralesController');
Route::controller('enfermedades-profesionales', 'EnfermedadesProfesionalesController');
Route::controller('usuarios', 'UsuariosController');
Route::controller('imagenes', 'ImagesController');
Route::controller('paises', 'PaisesController');
Route::controller('ciudades', 'CiudadesController');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
