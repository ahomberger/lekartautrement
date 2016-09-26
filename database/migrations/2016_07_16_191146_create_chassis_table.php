<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChassisTable extends Migration {

	public function up()
	{
		Schema::create('chassis', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nom');
		});
	}

	public function down()
	{
		Schema::drop('chassis');
	}
}