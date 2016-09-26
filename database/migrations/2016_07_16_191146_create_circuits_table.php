<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCircuitsTable extends Migration {

	public function up()
	{
		Schema::create('circuits', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nom')->unique();
			$table->string('web')->nullable();
			$table->string('tel_fixe')->nullable();
			$table->string('adresse_ligne1')->nullable();
			$table->string('tel_port')->nullable();
			$table->string('adresse_ligne2')->nullable();
			$table->timestamps();
			$table->integer('code_postal')->nullable();
			$table->string('ville')->nullable();
			$table->string('pays')->nullable();
			$table->string('gps')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('circuits');
	}
}