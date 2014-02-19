<?php
	/**
	* 
	*/
	class Producto extends Eloquent
	{
		/**
		* Tabla de la base de datos usada por el modelo
		*/
		protected $table='productos';
		public $timestamps = false;
		//clave primaria id
		protected $primaryKey = 'id';
		//roles que deben cumplir los usuarios

		public static $rules= array(
			'nombre' =>'required' , 
			'cantidad' =>'numeric|required', 
			'descripcion' =>'required',
			'imagen' =>'mimes:png,jpeg' ,
			);
	}
?>