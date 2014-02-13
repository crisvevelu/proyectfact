<?php
header('Content-Type: text/html; charset=UTF-8');
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
			$clientes = Cliente::find($codcliente)->first();
			//$clientes = Cliente::where('codcliente', '=', $codcliente)->first();

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

		public function postOcultar($codcliente) {
			$cliente = Cliente::where('codcliente', '=', $codcliente)->first();
			$cliente->estado = 2;
			$cliente->save();
			return Redirect::to('/clientes/listar')->with('message', 'Cliente modificado');
		}


		public function getClistado() {
			$clientes = Cliente::all();
			return View::make('clientes.homelistados')->with('clientes', $clientes);
		}

		public function getGenerar() {
			$clientes = Cliente::all();
			$html = '<!DOCTYPE html>
					<html lang="es">
						<head>
							<meta charset="utf-8">
						</head>
						<body>
							<table class="table table-striped" border="1">
								<tr><td>Codigo Cliente</td>
								<td>CIF / NIF</td>
								<td>Razon Social</td>
								<td>Localidad</td>
								<td>Provincia</td>
								<td>Telefono</td>
								<td>Email</td></tr>';
			 foreach ($clientes as $cliente) {
    		    if($cliente->estado == 1) {
					
					$html.= '<tr><td>'. $cliente->codcliente .'</td>
						<td>'. $cliente->cif .'</td>
						<td>'. $cliente->razonsocial .'</td>
						<td>'. $cliente->localidad .'</td>
						<td>'. $cliente->provincia .'</td>
						<td>'. $cliente->telefono1 .'</td>
						<td>'. $cliente->email .'</td>';
					$html .= '</tr>';
				}
      		}
      		$html .= '</table></body><html>';
			return PDF::load($html, 'A4', 'landscape')->show();
		}

		public function postAnadirmasiva() {
			if (Input::hasFile('smasiva')) {
				$smasiva = Input::file('smasiva');

				$fh = fopen($smasiva, "r");
				//$texto = "";

				$cif = "";
				$razonsocial = "";
				$direccion1 = "";
				$direccion2 = "";
				$localidad = "";
				$provincia = "";
				$pais = "";
				$cpostal = "";
				$telefono1 = "";
				$telefono2 = "";
				$email = "";
				$web = "";
				$logo = "";
				$estado = "";

				$datos[][] = array();
				while (( $data = fgetcsv ( $fh , 1000 , ";" )) !== FALSE ) { // Mientras hay líneas que leer...
					//$data = fgetcsv ( $fh , 1000 , ";" );
					$i = 0;
					foreach($data as $row) {
						//$texto .= "Campo $i: $row<br />"; // Muestra todos los campos de la fila actual 

					
					$datos[$i][$row] = $data;
					$i++ ;

					}
				}
				fclose ( $fh );

				return $datos;
			}else {
				return 'Error';
			}
		}

	}