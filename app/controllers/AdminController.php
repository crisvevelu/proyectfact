<?php

	class AdminController extends BaseController {
		protected $layout = "layouts.main";
		
		public function getIndex() {
			return View::make('admin.index');
		}

		public function getRegister() {
			$this->layout->content = View::make('admin.register');
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

				return Redirect::to('/users/dashboard')->with('message', 'Gracias por Registrarte');
			} else {
				return Redirect::to('/admin/register')->with('message', 'Hay errores:')->withErrors($validator)->withInput();
			}
		}
	}
?>