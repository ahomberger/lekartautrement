<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClubsTable extends Migration {

	public function up()
	{
		Schema::create('clubs', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nom')->unique();
			$table->string('web');
			$table->string('tel_fixe')->nullable();
			$table->string('tel_port')->nullable();
			$table->string('adresse_ligne1')->nullable();
			$table->string('adresse_ligne2')->nullable();
			$table->integer('code_postal')->nullable();
			$table->string('ville')->nullable();
			$table->string('pays')->nullable();
			$table->string('gps')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clubs');
	}
}