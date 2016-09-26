<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nom')->unique();
			$table->integer('age')->nullable();
			$table->float('poids')->nullable();
			$table->float('tarif')->nullable();
			$table->integer('trophee_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('categories');
	}
}