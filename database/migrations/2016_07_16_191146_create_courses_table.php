<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoursesTable extends Migration {

	public function up()
	{
		Schema::create('courses', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamp('date');
			$table->integer('trophee_id')->unsigned();
			$table->integer('circuit_id')->unsigned();
			$table->boolean('sens_inverse')->default(0);
			$table->boolean('annulee')->default(0);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('courses');
	}
}