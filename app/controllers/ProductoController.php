<?php
/**
* Controlador de productos
*/

class ProductoController extends BaseController
{
	
	/*function __construct(argument)
	{
		# code...
	}*/

	public function getListar()
	{
		//listar la lista de productos almacenados en la base de datos
		$productos= Producto::all();
		return View::make('productos.listar')->with('productos',$productos);
	}
	public function getAnadir(){
		return View::make('productos.anadir');
	}
	/**
	* postAnadir para almacenar los datos introducidos en el formulario
	* añadir productos en la base de datos. 
	*/
	public function postAnadir() {
		//recojer los productos introducidos por el formulario
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
					$producto = new Producto();
					$producto->nombre = Input::get('nombre');
					if (Input::get('cantidad')<0){
						return Redirect::to('/productos/anadir')->with('message', 'Hay errores: La cantidad no puede tener un valor negativo'); 
					}else{
						$producto->cantidad = Input::get('cantidad');
					}
					$producto->descripcion = Input::get('descripcion');
					$producto->imagen = $destinationPath . $filename;
					$producto->save();
					return Redirect::to('/productos/listar')->with('message', 'Añadido nuevo producto');
				}else{
					return Redirect::to('/productos/anadir')->with('message', 'Hay errores:')->withErrors($validator)->withInput();
				}
			}
			$producto = new Producto();
			$producto->nombre = Input::get('nombre');
			if (Input::get('cantidad')<0){
				return Redirect::to('/productos/anadir')->with('message', 'Hay errores: La cantidad no puede tener un valor negativo'); 
			}else{
				$producto->cantidad = Input::get('cantidad');
			}
			$producto->descripcion = Input::get('descripcion');		
			$producto->save();
			return Redirect::to('/productos/listar')->with('message', 'Añadido nuevo producto');
		}else{
			return Redirect::to('/productos/anadir')->with('message', 'Hay errores:')->withErrors($validator)->withInput();
		}
	}	
	public function getModificar($id)
	{
		# modificar contenido de un producto
		$producto = Producto::find($id);
		return View::make('productos.modificar')->with('producto', $producto);
	}
	public function postModificar($id)
	{
		# guardar el contenido modificado del producto
		//buscamos el id del producto indicado
		$producto = Producto::find($id);//->first();
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
						return Redirect::to('/productos/modificar/'.$id)->with('message', 'Hay errores: La cantidad no puede tener un valor negativo'); 
					}else{
						$producto->cantidad = Input::get('cantidad');
					}
					$producto->descripcion = Input::get('descripcion');
					$producto->imagen = $destinationPath . $filename;
					$producto->save();
					return Redirect::to('/productos/listar')->with('message', 'Producto modificado correctamente');
				}else{
					return Redirect::to('/productos/modificar/'.$id)->with('message', 'Hay errores:')->withErrors($validator)->withInput();
				}
			}
			
			$producto->nombre = Input::get('nombre');
			if (Input::get('cantidad')<0){
				return Redirect::to('/productos/modificar/'.$id)->with('message', 'Hay errores: La cantidad no puede tener un valor negativo'); 
			}else{
				$producto->cantidad = Input::get('cantidad');
			}
			$producto->descripcion = Input::get('descripcion');		
			$producto->save();
			return Redirect::to('/productos/listar')->with('message', 'Producto modificado correctamente');
		}else{
			return Redirect::to('/productos/modificar/'.$id)->with('message', 'Hay errores:')->withErrors($validator)->withInput();
		}

	}
	public function getBuscar()
	{
		return View::make('productos.buscar');
	}
	public function postBuscar()
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