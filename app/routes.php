<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/*
Route::get('/', function()
{
	return View::make('hello');
});
*/



Route::get('login', 'AuthController@getLogin');
Route::post('login', 'AuthController@postSignin');


Route::group(array('before' => 'auth'), function() {
	Route::get('/', 'WebController@action_index');
	

	Route::group(array('before' => 'admin'), function() {
		Route::get('admin', array('before' => 'admin', function() {
			return View::make('admin.index');
		}));

		Route::get('admin/usuarios/delete/{id}', 'AdminController@getDelete');
		Route::get('admin/usuarios/register', 'AdminController@getRegister');
		Route::get('/admin/clientes/mostar/{codcliente}', 'AdminController@getMostrar');
		Route::get('/admin/clientes/archivar/{codcliente}', 'AdminController@postArchivar');
		Route::get('/admin/clientes/antiguos/', 'AdminController@getAntiguos');
		Route::get('/admin/clientes/modificar/{codcliente}', 'AdminController@getModificar');
		Route::post('/admin/clientes/modificar/{codcliente}', 'AdminController@postModificar');
		Route::get('/admin/usuarios/modificar/{id}', 'AdminController@getModificaruser');
		Route::post('/admin/usuarios/modificar/{id}', 'AdminController@postModificaruser');
		Route::controller('admin', 'AdminController');
	});

	Route::post('/clientes/anadir/anadirmasiva', 'ClientesController@postAnadirmasiva');
	Route::controller('users', 'UsersController');
	Route::controller('clientes', 'ClientesController');
	Route::get('/ocultar/{codcliente}', 'ClientesController@postOcultar');

	Route::get('users', 'UsersController@getDashboard');

	Route::get('logout', 'AuthController@getLogout');
});

/*
Route::filter('auth', function() {
   if (Auth::guest()) return Redirect::guest('login');
});

*/