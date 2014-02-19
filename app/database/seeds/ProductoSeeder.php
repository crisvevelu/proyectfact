<?php 
	/**
	* Esta clase es usada para la inicialización de la base de datos 
	* Para que esta clase funcione tenemos que indicar que la use en DatabaseSeeder.php
	*/
	class ProductoSeeder extends DatabaseSeeder
	{
		
		public function run()
		{
			$productos= [
				[

					'nombre'=>'mesa',
					'cantidad'=> 30,
					'descripcion'=>'Mueble compuesto de un tablero horizontal liso y sostenido a la altura conveniente, generalmente por una o varias patas, para diferentes usos, como escribir, comer, etc',
					'imagen'=>'img.jpg'
				]
			];
			foreach ($productos as $producto) {
				Producto::create($producto);
			}
		}
	}
?>