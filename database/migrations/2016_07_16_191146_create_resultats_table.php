<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResultatsTable extends Migration {

	public function up()
	{
		Schema::create('resultats', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('manche_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('position')->unsigned();
			$table->boolean('abandon')->default(0);
			$table->boolean('declassement')->default(0);
			$table->integer('points');
			$table->float('meilleur_chrono');
			$table->integer('numero')->unsigned();
			$table->integer('chassis_id')->unsigned()->nullable();
			$table->integer('moteur_id')->unsigned()->nullable();
			$table->integer('club_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('resultats');
	}
}