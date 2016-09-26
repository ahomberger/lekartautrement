<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMoteursTable extends Migration {

	public function up()
	{
		Schema::create('moteurs', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nom');
		});
	}

	public function down()
	{
		Schema::drop('moteurs');
	}
}