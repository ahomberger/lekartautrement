<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBonusTable extends Migration {

	public function up()
	{
		Schema::create('bonus', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('trophee_id')->unsigned();
			$table->integer('pourcentage');
			$table->integer('points');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('bonus');
	}
}