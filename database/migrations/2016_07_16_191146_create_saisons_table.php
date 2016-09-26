<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSaisonsTable extends Migration {

	public function up()
	{
		Schema::create('saisons', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('annee');
		});
	}

	public function down()
	{
		Schema::drop('saisons');
	}
}