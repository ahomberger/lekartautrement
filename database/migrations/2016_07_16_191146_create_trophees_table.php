<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTropheesTable extends Migration {

	public function up()
	{
		Schema::create('trophees', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nom');
			$table->integer('saison_id')->unsigned();
			$table->integer('nb_retrait')->nullable()->default('4');
			$table->integer('points_pole')->nullable()->default('2');
			$table->integer('points_abandon')->default('0');
			$table->integer('points_declassement')->default('0');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('trophees');
	}
}