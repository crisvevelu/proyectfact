<?php

	class AdminController extends BaseController {
		protected $layout = "layouts.main";
		
		public function getIndex() {
			return View::make('admin.index');
		}

		/**
		*	Funciones Usuarios
		*/

		public function getUsuarios() {
			$usuarios = User::all();
			return View::make('admin.usuarios.listar')->with('usuarios', $usuarios);
		}

		public function getDelete($id) {
			$user = User::find($id);

			if(is_null($user)) {
				return Redirect::to('admin/usuarios')->with('message', 'Error al borrar el usuario');
			}
			$user->delete();

			return Redirect::to('admin/usuarios')->with('message', 'Usuario eliminado correctamente');
		}

		public function getRegister() {
			$this->layout->content = View::make('admin.usuarios.register');
		}

		public function postCreate() {
			$mensajes = array (
				'required'	=> 'Campo Obligatorio',
				'alpha' 	=> 'El campo :attribute tiene que contener caracteres',
				'confirmed'	=> 'El campo :attribute tiene que ser igual'
			);

			$validator = Validator::make(Input::all(), User::$rules, $mensajes);

			if ($validator->passes()) {
				$user = new User;
				$user->username = Input::get('username');
				$user->email = Input::get('email');
				$user->password = Hash::make(Input::get('password'));
				$user->tipo_user = Input::get('tipo_user');
				$user->save();

				return Redirect::to('/admin/usuarios')->with('message', 'Usuario Registrado');
			} else {
				return Redirect::to('/admin/usuarios/register')->with('message', 'Hay errores:')->withErrors($validator)->withInput();
			}
		}

		/**
		*	Funciones Clientes
		*/

		public function getClientes() {
			$clientes = Cliente::all();
			return View::make('admin.clientes.listar')->with('clientes', $clientes);
		}

		public function getMostrar($codcliente) {

			$cliente = Cliente::where('codcliente', '=', $codcliente)->first();
			$cliente->estado = 1;
			$cliente->save();
			return Redirect::to('/admin/clientes')->with('message', 'Cliente modificado');
		}

		public function getAntiguos() {
			$clientes = Cliente::all();
			return View::make('admin.clientes.antiguos')->with('clientes', $clientes);
		}

		public function postArchivar($codcliente) {
			$cliente = Cliente::where('codcliente', '=', $codcliente)->first();
			$cliente->estado = 2;
			$cliente->save();
			return Redirect::to('/admin/clientes/listar')->with('message', 'Cliente modificado');
		}

		public function getModificar($codcliente) {
			$cliente = Cliente::where('codcliente', '=', $codcliente)->first();
			return View::make('/admin/clientes/modificar')->with('cliente', $cliente);
		}

		public function postModificar($codcliente) {
			//$cliente = Cliente::where('codcliente', '=', $codcliente)->first();
			$cliente = Cliente::find($codcliente);

			$mensajes = array (
				'required' => 'Campo Obligatorio',
				'alpha' => 'El campo :attribute tiene que contener caracteres',
				'numeric' => 'El campo tiene que ser numerico'
			);

			$validator = Validator::make(Input::all(), Cliente::$rules_modificacion, $mensajes);

			if ($validator->passes()) {

				if ( $cliente->cif != Input::get('cif') ) {
					$cliente->cif = Input::get('cif');
				}
				if ( $cliente->razonsocial != Input::get('razonsocial') ) {
					$cliente->razonsocial = Input::get('razonsocial');
				}
				$cliente->direccion1 = Input::get('direccion1');
				$cliente->direccion2 = Input::get('direccion2');
				$cliente->localidad = Input::get('localidad');
				$cliente->provincia = Input::get('provincia');
				$cliente->pais = Input::get('pais');
				$cliente->cpostal = Input::get('cod_postal');
				$cliente->telefono1 = Input::get('telefono1');
				$cliente->telefono2 = Input::get('telefono2');
				if ( $cliente->email != Input::get('email') ) {
					$cliente->email = Input::get('email');
				}
				$cliente->web = Input::get('p_web');
				$cliente->logo = Input::get('logo');
				$cliente->save();

				return Redirect::to('/admin/clientes')->with('message', 'Cliente modificado');
			} else {
				return Redirect::back()->with('message', 'Hay errores:')->withErrors($validator)->withInput();
			}
		}

		public function getModificaruser($id) {
			$usuario = User::find($id);
			return View::make('/admin/usuarios/modificar')->with('usuario', $usuario);
		}

		public function postModificaruser($id) {
			
			$usuario = User::find($id);

			$mensajes = array (
				'required' => 'Campo Obligatorio',
				'alpha' => 'El campo :attribute tiene que contener caracteres',
				'numeric' => 'El campo tiene que ser numerico'
			);

			$validator = Validator::make(Input::all(), User::$rules_modificacion, $mensajes);

			if ($validator->passes()) {
				$usuario->username = Input::get('username');
				if ( $usuario->email != Input::get('email') ) {
					$usuario->email = Input::get('email');
				}
				if(Input::has('password')) {
					$usuario->password = Hash::make(Input::get('password'));
				}
				$usuario->tipo_user = Input::get('tipo_user');
				$usuario->save();
				
				return Redirect::to('/admin/usuarios')->with('message', 'Usuario modificado');
			} else {
				return Redirect::back()->with('message', 'Hay errores:')->withErrors($validator)->withInput();
			}
		}
	}
?>