<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ModifyUsersTable extends Migration {

	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->dropColumn('name');
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
		});
	}

	public function down()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->string('name');
			$table->dropColumn('sexe')->nullable();
			$table->dropColumn('nom')->nullable();
			$table->dropColumn('prenom')->nullable();
			$table->dropColumn('date_naissance')->nullable();
			$table->dropColumn('adresse_ligne1')->nullable();
			$table->dropColumn('adresse_ligne2')->nullable();
			$table->dropColumn('code_postal')->nullable();
			$table->dropColumn('ville')->nullable();
			$table->dropColumn('pays')->nullable();
			$table->dropColumn('gps')->nullable();
			$table->dropColumn('tel_fixe')->nullable();
			$table->dropColumn('tel_port')->nullable();
			$table->dropColumn('num_licence')->unsigned()->nullable();
			$table->dropColumn('num_licence_tuteur')->unsigned()->nullable();
			$table->dropColumn('num_transpondeur')->unsigned()->nullable();
			$table->dropColumn('derogation')->default(0);
			$table->dropColumn('club_id')->unsigned()->nullable();
			$table->dropColumn('pilote')->default(0);
			$table->dropColumn('staff')->default(0);
			$table->dropColumn('admin')->default(0);
			$table->dropColumn('facebook_id')->nullable();
			$table->dropColumn('facebook_link')->nullable();
			$table->dropColumn('google_id')->nullable();
		});
	}
}