<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInscriptionsTable extends Migration {

	public function up()
	{
		Schema::create('inscriptions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('course_id')->unsigned();
			$table->integer('categorie_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('kart_id')->unsigned();
			$table->integer('numero')->unsigned();
			$table->boolean('present')->default(0);
			$table->boolean('regle')->default(0);
			$table->string('mode_reglement');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('inscriptions');
	}
}