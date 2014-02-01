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

	}