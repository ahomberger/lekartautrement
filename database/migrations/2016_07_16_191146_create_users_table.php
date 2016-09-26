<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('password');
			$table->string('sexe')->nullable();
			$table->string('nom')->nullable();
			$table->string('prenom')->nullable();
			$table->timestamp('date_naissance')->nullable();
			$table->string('adresse_ligne1')->nullable();
			$table->string('adresse_ligne2')->nullable();
			$table->integer('code_postal')->nullable();
			$table->string('ville')->nullable();
			$table->string('pays')->nullable();
			$table->string('gps')->nullable();
			$table->string('tel_fixe')->nullable();
			$table->string('tel_port')->nullable();
			$table->integer('num_licence')->unsigned()->nullable();
			$table->integer('num_licence_tuteur')->unsigned()->nullable();
			$table->integer('num_transpondeur')->unsigned()->nullable();
			$table->boolean('derogation')->default(0);
			$table->integer('club_id')->unsigned()->nullable();
			$table->boolean('pilote')->default(0);
			$table->boolean('staff')->default(0);
			$table->boolean('admin')->default(0);
			$table->string('facebook_id')->nullable();
			$table->string('facebook_link')->nullable();
			$table->string('google_id')->nullable();
			$table->rememberToken();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}