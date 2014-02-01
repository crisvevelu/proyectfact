<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function($table) {
			$table->increments('id');
			$table->string('username', 20);
			$table->string('email', 100)->unique();
			$table->string('password', 64);
			$table->string('tipo_user', 1);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('users');
	}

}