<?php

	class UsersController extends BaseController {
		protected $layout = "layouts.main";

		public function __construct() {
			$this->beforeFilter('csrf', array('on'=>'post'));
			$this->beforeFilter('auth', array('only'=>array('getDashboard')));
		}

		public function getRegister() {
			$this->layout->content = View::make('users.register');
		}

		public function postCreate() {
			$mensajes = array (
				'required' => 'Campo Obligatorio',
				'alpha' => 'El campo :attribute tiene que contener caracteres'
			);

			$validator = Validator::make(Input::all(), User::$rules, $mensajes);

			if ($validator->passes()) {
				$user = new User;
				$user->username = Input::get('username');
				$user->email = Input::get('email');
				$user->password = Hash::make(Input::get('password'));
				$user->tipo_user = Input::get('tipo_user');
				$user->save();

				return Redirect::to('/login')->with('message', 'Gracias por Registrarte');
			} else {
				return Redirect::to('/users/register')->with('message', 'Hay errores:')->withErrors($validator)->withInput();
			}
		}

		public function getDashboard() {
			$this->layout->content = View::make('users.dashboard');
		}
	}
?>