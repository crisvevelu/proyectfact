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
	
	Route::get('admin', array('before' => 'admin', function() {
		return View::make('admin.index');
	}));

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