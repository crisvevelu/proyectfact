<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//creacion de la tabla productos
		Schema::create('productos', function($table){
			$table->increments('id');
			$table->string('nombre', 40);
			$table->integer('cantidad');
			$table->string('descripcion', 500);
			$table->string('imagen');
			$table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//borrado de la tabla creada anterior
		Schema::drop('producto');
	}

}
