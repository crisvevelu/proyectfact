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

		/*public function getHome($codcliente) {
			$clientes = Cliente::find($codcliente)->first();
			//$clientes = Cliente::where('codcliente', '=', $codcliente)->first();

			if (is_null ($clientes)) {
				App::abort(404);
			}

			return View::make('clientes.homecliente')->with('clientes', $clientes);
		}*/

		public function getAnadir() {
			return View::make('clientes.anadir');
		}

		public function postAnadir(){
			/**
			*  "/^\d{8}[a-zA-Z]{1}$/" patron NIF
			*	"/^[a-zA-Z]{1}\d{7}[a-zA-Z0-9]{1}$/" patron para CIF	
			*/
			$mensajes = array(
				'required' => 'Campo Obligatorio',
				'alpha' => 'El campo :attribute tiene que contener caracteres',
				'numeric' => 'El campo tiene que ser numerico'
				);
			$validator = Validator::make(Input::all(), Cliente::$rules , $mensajes);
			if ($validator->passes()) {
				$cliente = new Cliente;
				//añadimos los datos a la base de datos
				
				$valor = Input::get('cif');
				if(preg_match(('/^\d{8}[a-zA-Z]{1}$/'), $valor) || preg_match(('/^[a-zA-Z]{1}\d{7}[a-zA-Z0-9]{1}$/'), $valor)){
					$cliente->cif = $valor;
				}else{
					return Redirect::to('/clientes/anadir')->with('message', 'No ha introducido un CIF o NIF');
				}
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
				
				//comprobar imagen y añadirla en caso de que haya
				if (Input::hasFile('logo')){
					$file=Input::file('logo');
					$destinationPath = 'uploads/logo/';
					$filename = $file->getClientOriginalName();
					$upload_success = $file->move($destinationPath, $filename);
					if ($upload_success) {
						$cliente->logo = $destinationPath . $filename;
						//return $destinationPath . $filename; 
					}
				}
				$cliente->estado = Input::get('estado_cliente');
				$cliente->save();
				return Redirect::to('/clientes/listar')->with('message', 'Añadido nuevo cliente');

			}else{
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

			$mensajes = array (
				'required' => 'Campo Obligatorio',
			);

			$validator = Validator::make(Input::all(), Cliente::$rules_masiva, $mensajes);
			if ( $validator->passes() && Input::hasFile('smasiva') ) {
				$smasiva = Input::file('smasiva');

				$fh = fopen($smasiva, "r");

				$datosBd = array('codcliente', 'cif', 'razonsocial', 'direccion1', 'direccion2' , 'localidad', 'provincia', 'pais', 'cpostal', 'telefono1', 'telefono2', 'email', 'web', 'logo', 'estado');

				while ($data = fgetcsv ( $fh, 1000, ';')) {
					$i = 0;
					if ( Cliente::find($data[0]) == '' && Cliente::where('cif', '<>', $data[1]) && Cliente::where('email', '<>', $data[10]) ) {
						$cliente = new Cliente;
						foreach ($data as $linea => $elemento) {
							if ( $elemento!='' || $elemento!=' ' ) {
								$cliente->$datosBd[$i] = $elemento;
							}
							$i++;
						}
						$cliente->save();
					} else {
						return Redirect::to('/clientes/anadir')->with('smasiva', 'Clientes duplicados. ¡Comprueba el archivo!')->with('message', 'Hay errores:');
					}
				}
				fclose ( $fh );
				return Redirect::to('/clientes/listar')->with('message', 'Añadidos '. $i .' clientes');
			}else {
				return Redirect::to('/clientes/anadir')->with('message', 'Hay errores:')->withErrors($validator)->withInput();
			}
		}
		public function getModificar($codcliente) {
			$cliente = Cliente::where('codcliente', '=', $codcliente)->first();
			return View::make('/clientes/modificar')->with('cliente', $cliente);
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
				if (Input::hasFile('logo')){
					$file=Input::file('logo');
					$destinationPath = 'uploads/logo/';
					$filename = $file->getClientOriginalName();
					$upload_success = $file->move($destinationPath, $filename);
					if ($upload_success) {
						$cliente->logo = $destinationPath . $filename;
					}
				}
				$cliente->save();

				return Redirect::to('clientes.listar')->with('message', 'Cliente modificado');
			} else {
				return Redirect::back()->with('message', 'Hay errores:')->withErrors($validator)->withInput();
			}
		}
		public function getClientOriginalName() {
  			return $this->originalName;
		}
		public function getMostrarHomeCliente($codcliente)
		{
			if ($clientes = Cliente::find($codcliente)) {
				return View::make('clientes.homecliente')->with('clientes', $clientes);
			} else {
				return Redirect::to('/clientes/listar')->with('message', 'El cliente no existe');
			}
		}
		/*
			Buscador
		*/
		public function getBuscar()
		{
			return View::make('clientes.buscar');
		}
		public function postBuscar()
		{
			/*
			*  "/^\d{8}[a-zA-Z]{1}$/" patron NIF
			*	"/^[a-zA-Z]{1}\d{7}[a-zA-Z0-9]{1}$/" patron para CIF	
			*/
			
			//$campo contiene el valor obtenido de la lista despegable
			$campo = Input::get('criterio');
			//$valor es el valor introducido para buscar
			$valor= Input::get('valor');
			$opciones = array(0 => '0', 1 => 'cif', 2 => 'razonsocial', 3 => 'localidad', 4 =>'provincia' );
			$criterio = $opciones[$campo];
			if ($valor==" " || $valor==""){
				return Redirect::to('/clientes/buscar')->with('message', 'Debe de introducir un valor para buscar en la base de datos');
			}else{
				switch ($campo) {
					case 0:
						return Redirect::to('/clientes/buscar')->with('message', 'Hay errores: debe de seleccionar el criterio de busqueda.');
					case 1:
					//comprobación de un cif o dni
						if(preg_match(('/^\d{8}[a-zA-Z]{1}$/'), $valor) || preg_match(('/^[a-zA-Z]{1}\d{7}[a-zA-Z0-9]{1}$/'), $valor)){
							$consulta= DB::select('SELECT * FROM clientes WHERE '.$criterio.' LIKE "'. $valor. '"');
							return View::make('clientes.listar')->with('clientes',$consulta);
						}else{
							return Redirect::to('/clientes/buscar')->with('message', 'Hay errores: debe introducir un CIF/DNI.');
						}
					case 2:
					//comprobamos el nombre de la razon social, el nombre puede contener cualquier caracter.
						if (is_string($valor)){
							$consulta= DB::select('SELECT * FROM clientes WHERE '.$criterio.' LIKE "%'. $valor. '%"');
							return View::make('clientes.listar')->with('clientes',$consulta);
						}else{
							return Redirect::to('/clientes/buscar')->with('message', 'Hay errores: debe introducir un texto.');
						}
					case 3:
					//comprobamos el nombre de la provincia la provincia no contendra números
						if (is_string($valor) && !(preg_match( ('/^[0-9]+$/') , $valor))){
							$consulta= DB::select('SELECT * FROM clientes WHERE '.$criterio.' LIKE "'. $valor. '"');
							return View::make('clientes.listar')->with('clientes',$consulta);
						}else{
							return Redirect::to('/clientes/buscar')->with('message', 'Hay errores: debe introducir un texto.');
						}
					case 4:
					//comprobamos el nombre de la provincia, la provincia no contendra números
						if (is_string($valor) && !(preg_match( ('/^[0-9]+$/') , $valor))){
							$consulta= DB::select('SELECT * FROM clientes WHERE '.$criterio.' LIKE "'. $valor. '"');
							return View::make('clientes.listar')->with('clientes',$consulta);
						}else{
							return Redirect::to('/clientes/buscar')->with('message', 'Hay errores: debe introducir un texto.');
						}
				}
			}
		}

	}