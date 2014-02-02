<?php

	class ClientesController extends BaseController {

		public function __construct() {
			$this->beforeFilter('csrf', array('on'=>'post'));
			$this->beforeFilter('auth', array('only'=>array('getListar')));
		}

		public function getListar()	{
			$clientes = Cliente::all();
			return View::make('clientes.listar')->with('clientes', $clientes);
		}

		public function getHome($codcliente) {
			//$clientes = Cliente::find($codcliente);
			$clientes = Cliente::where('codcliente', '=', $codcliente)->first();

			if (is_null ($clientes)) {
				App::abort(404);
			}

			return View::make('clientes.homecliente')->with('clientes', $clientes);

		}


		public function getAnadir() {
			return View::make('clientes.anadir');
		}

		public function postAnadir() {
			$mensajes = array (
				'required' => 'Campo Obligatorio',
				'alpha' => 'El campo :attribute tiene que contener caracteres',
				'numeric' => 'El campo tiene que ser numerico'
			);

			$validator = Validator::make(Input::all(), Cliente::$rules, $mensajes);

			if ($validator->passes()) {
				$cliente = new Cliente;

				$cliente->cif = Input::get('cif');
				$cliente->razonsocial = Input::get('razonsocial');
				$cliente->direccion1 = Input::get('direccion1');
				$cliente->direccion2 = Input::get('direccion2');
				$cliente->localidad = Input::get('localidad');
				$cliente->provincia = Input::get('provincia');
				$cliente->pais = Input::get('pais');
				$cliente->cpostal = Input::get('cod_postal');
				$cliente->telefono1 = Input::get('telefono1');
				$cliente->telefono2 = Input::get('telefono2');
				$cliente->email = Input::get('email');
				$cliente->web = Input::get('p_web');
				$cliente->logo = Input::get('logo');
				$cliente->estado = Input::get('estado_cliente');
				$cliente->save();

				return Redirect::to('/clientes/listar')->with('message', 'Añadido nuevo cliente');
			} else {
				return Redirect::to('/clientes/anadir')->with('message', 'Hay errores:')->withErrors($validator)->withInput();
			}
		}

	}