<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKartsTable extends Migration {

	public function up()
	{
		Schema::create('karts', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('moteur_id')->unsigned();
			$table->integer('chassis_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('karts');
	}
}