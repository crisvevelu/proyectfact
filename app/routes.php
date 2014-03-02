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
		Route::get('/admin/usuarios/modificar/{id}', 'AdminController@getModificaruser');
		Route::post('/admin/usuarios/modificar/{id}', 'AdminController@postModificaruser');

		Route::get('/admin/clientes/mostar/{codcliente}', 'AdminController@getMostrar');
		Route::get('/admin/clientes/archivar/{codcliente}', 'AdminController@postArchivar');
		Route::get('/admin/clientes/antiguos/', 'AdminController@getAntiguos');
		Route::get('/admin/clientes/modificar/{codcliente}', 'AdminController@getModificar');
		Route::post('/admin/clientes/modificar/{codcliente}', 'AdminController@postModificar');
		Route::get('/admin/clientes/gestlistados/', 'AdminController@getGestlistados');
		Route::post('/admin/clientes/gestlistados/', 'AdminController@postGestlistados');

		Route::get('/admin/productos/listar', 'AdminController@getMostrarProductos');
		Route::get('/admin/productos/eliminar/{id}', 'AdminController@getEliminarProducto');
		Route::get('/admin/productos/modificar/{id}', 'AdminController@getModificarProductos');
		Route::post('/admin/productos/modificar/{id}', 'AdminController@postModificarProductos');
		Route::get('/admin/productos/buscar', 'AdminController@getBuscarProductos');
		Route::post('/admin/productos/buscar', 'AdminController@postBuscarProductos');

		Route::controller('admin', 'AdminController');
	});

	Route::get('/clientes/anadir', 'ClientesController@getAnadir');
	Route::post('/clientes/anadir', 'ClientesController@postAnadir');
	Route::get('/clientes/modificar/{codcliente}', 'ClientesController@getModificar');
	Route::post('/clientes/modificar/{codcliente}', 'ClientesController@postModificar');
	Route::get('/clientes/homecliente/{codcliente}', 'ClientesController@getMostrarHomeCliente');
	Route::post('/clientes/homecliente/{codcliente}', 'ClientesController@postMostrarHomeCliente');
	Route::post('/clientes/anadir/anadirmasiva', 'ClientesController@postAnadirmasiva');
	Route::get('/clientes/buscar', 'ClientesController@getBuscar');
	Route::post('/clientes/buscar', 'ClientesController@postBuscar');
	Route::controller('users', 'UsersController');
	Route::controller('clientes', 'ClientesController');
	Route::get('/ocultar/{codcliente}', 'ClientesController@postOcultar');

	Route::get('users', 'UsersController@getDashboard');

	Route::get('logout', 'AuthController@getLogout');
	Route::get('/productos/listar', 'ProductoController@getListar');

	Route::get('/productos/anadir', 'ProductoController@getAnadir');
	Route::post('/productos/anadir', 'ProductoController@postAnadir');
	Route::get('/productos/modificar/{id}', 'ProductoController@getModificar');
	Route::post('/productos/modificar/{id}', 'ProductoController@postModificar');
	Route::get('/productos/buscar', 'ProductoController@getBuscar');
	Route::post('/productos/buscar', 'ProductoController@postBuscar');

	Route::controller('productos', 'ProductoController');
});

/*
Route::filter('auth', function() {
   if (Auth::guest()) return Redirect::guest('login');
});

*/