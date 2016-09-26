<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateManchesTable extends Migration {

	public function up()
	{
		Schema::create('manches', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nom');
			$table->integer('course_id')->unsigned();
			$table->boolean('points_pole')->default(0);
			$table->boolean('points_position')->default(1);
			$table->integer('categorie_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('manches');
	}
}