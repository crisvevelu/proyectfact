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
		public function getGestlistados() {
			//$clientes = Cliente::all();
			//$clientes = DB::table('clientes')->lists('title', 'name');

			 $clientes = DB::table('clientes')->remember(10)->get();

			return View::make('admin.clientes.listados')->with('clientes', $clientes);
			//return View::make('admin.clientes.listados', $clientes);
		}

		public function postGestlistados() {
			return 'Gestionar Listados';
		}
		/**
		* Funciones productos
		*/
		public function getProductos() {
			$productos= Producto::all();
			return View::make('admin.productos.listar')->with('productos', $productos);
		}
		public function getMostrarProductos()
		{
			//metodo para obtener todos los productos
			$productos= Producto::all();
			return View::make('admin.productos.listar')->with('productos', $productos);

		}

		public function getModificarProductos($id)
		{
			//metodo para modificar productos
			$producto = Producto::find($id);
			return View::make('admin.productos.modificar')->with('producto', $producto);
		}
		public function postModificarProductos($id)
		{
			//metodo para obtener la modificacion productos
			$producto = Producto::find($id);
			$mensajes = array (
					'required' => 'Campo Obligatorio',
					'numeric' => 'El campo tiene que ser numerico'
				);
			//validamos que los datos cumplan los requisitos del modelo
			$validator= Validator::make(Input::all(), Producto::$rules, $mensajes);
			if ($validator->passes()) {
				#si la validacion no falla
				//comprobamos que imagen es un archivo
				if(Input::hasFile('imagen')){
					//almacenamos la imagen en una variable
					$file= Input::file('imagen');
					$destinationPath ='uploads/';
					$filename= $file->getClientOriginalName();
					$upload_success=$file->move($destinationPath, $filename);
					if($upload_success){
						$producto->nombre = Input::get('nombre');
						if (Input::get('cantidad')<0){
							return Redirect::to('admin/productos/modificar/'.$id)->with('message', 'Hay errores: La cantidad no puede tener un valor negativo'); 
						}else{
							$producto->cantidad = Input::get('cantidad');
						}
						$producto->descripcion = Input::get('descripcion');
						$producto->imagen = $destinationPath . $filename;
						$producto->save();
						return Redirect::to('admin/productos/listar')->with('message', 'Producto modificado correctamente');
					}else{
						return Redirect::to('admin/productos/modificar/'.$id)->with('message', 'Hay errores:')->withErrors($validator)->withInput();
					}
				}
				
				$producto->nombre = Input::get('nombre');
				if (Input::get('cantidad')<0){
					return Redirect::to('admin/productos/modificar/'.$id)->with('message', 'Hay errores: La cantidad no puede tener un valor negativo'); 
				}else{
					$producto->cantidad = Input::get('cantidad');
				}
				$producto->descripcion = Input::get('descripcion');		
				$producto->save();
				return Redirect::to('admin/productos/listar')->with('message', 'Producto modificado correctamente');
			}else{
				return Redirect::to('admin/productos/modificar/'.$id)->with('message', 'Hay errores:')->withErrors($validator)->withInput();
			}
		}
		public function getEliminarProducto($id)
		{
			//funcion para elminar el producto por id
			$producto=Producto::find($id);
			if (is_null($producto)){
				App::abort(404);
			}
			$producto->delete();
			return Redirect::to('admin/productos/listar')->with('message', 'Producto eliminado correctamente');
		}
		public function getBuscarProductos()
	{
		return View::make('productos.buscar');
	}
	public function postBuscarProductos()
	{
		/*
			Funcion para buscar coincidencias en la base de datos
		*/
			
			$campo = Input::get('criterio');
			//valor es el valor introducido para buscar
			$valor= Input::get('valor');
			$opciones = array(0 => '0', 1 => 'nombre', 2 => 'cantidad', 3 => 'descripcion' );
			$criterio = $opciones[$campo];
			if ($valor==" " || $valor==""){
				
				return Redirect::to('/productos/buscar')->with('message', 'Debe de introducir un valor para buscar en la base de datos');
			}else{
				switch ($campo) {
					case 0:
						return Redirect::to('/productos/buscar')->with('message', 'Hay errores: debe de seleccionar el criterio de busqueda.');
						
					case 1:
						if (is_string($valor) && !(preg_match( ('/^[0-9]+$/') , $valor))){
							$consulta= DB::select('SELECT * FROM productos WHERE '.$criterio.' LIKE "'. $valor. '"');
							return View::make('productos.listar')->with('productos',$consulta);
						}else{
							return Redirect::to('/productos/buscar')->with('message', 'Hay errores: debe introducir un texto.');
						}
						
					case 2:
						if (preg_match( ('/^[0-9]+$/') , $valor)){
							$consulta= DB::select('SELECT * FROM productos WHERE '.$criterio.' LIKE "'. $valor. '"');
							return View::make('productos.listar')->with('productos',$consulta);
						}else{
							return Redirect::to('/productos/buscar')->with('message', 'Hay errores: debe introducir un numero.');
						}
						
					case 3:
						if (is_string($valor)){
							$consulta= DB::select('SELECT * FROM productos WHERE '.$criterio.' LIKE "%'. $valor. '%"');
							return View::make('productos.listar')->with('productos',$consulta);
						}else{
							return Redirect::to('/productos/buscar')->with('message', 'Hay errores: debe introducir un texto.');
						}
				}
			}
			
	}

	}
?>