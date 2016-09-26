<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('trophees', function(Blueprint $table) {
			$table->foreign('saison_id')->references('id')->on('saisons')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('categories', function(Blueprint $table) {
			$table->foreign('trophee_id')->references('id')->on('trophees')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('courses', function(Blueprint $table) {
			$table->foreign('trophee_id')->references('id')->on('trophees')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('courses', function(Blueprint $table) {
			$table->foreign('circuit_id')->references('id')->on('circuits')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('manches', function(Blueprint $table) {
			$table->foreign('course_id')->references('id')->on('courses')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('manches', function(Blueprint $table) {
			$table->foreign('categorie_id')->references('id')->on('categories')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('points', function(Blueprint $table) {
			$table->foreign('trophee_id')->references('id')->on('trophees')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('resultats', function(Blueprint $table) {
			$table->foreign('manche_id')->references('id')->on('manches')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('resultats', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('resultats', function(Blueprint $table) {
			$table->foreign('chassis_id')->references('id')->on('chassis')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('resultats', function(Blueprint $table) {
			$table->foreign('moteur_id')->references('id')->on('moteurs')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('resultats', function(Blueprint $table) {
			$table->foreign('club_id')->references('id')->on('clubs')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('inscriptions', function(Blueprint $table) {
			$table->foreign('course_id')->references('id')->on('courses')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('inscriptions', function(Blueprint $table) {
			$table->foreign('categorie_id')->references('id')->on('categories')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('inscriptions', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('inscriptions', function(Blueprint $table) {
			$table->foreign('kart_id')->references('id')->on('karts')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('videos', function(Blueprint $table) {
			$table->foreign('manche_id')->references('id')->on('manches')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('videos', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('club_id')->references('id')->on('clubs')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('bonus', function(Blueprint $table) {
			$table->foreign('trophee_id')->references('id')->on('trophees')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('karts', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('karts', function(Blueprint $table) {
			$table->foreign('moteur_id')->references('id')->on('moteurs')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('karts', function(Blueprint $table) {
			$table->foreign('chassis_id')->references('id')->on('chassis')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('trophees', function(Blueprint $table) {
			$table->dropForeign('trophees_saison_id_foreign');
		});
		Schema::table('categories', function(Blueprint $table) {
			$table->dropForeign('categories_trophee_id_foreign');
		});
		Schema::table('courses', function(Blueprint $table) {
			$table->dropForeign('courses_trophee_id_foreign');
		});
		Schema::table('courses', function(Blueprint $table) {
			$table->dropForeign('courses_circuit_id_foreign');
		});
		Schema::table('manches', function(Blueprint $table) {
			$table->dropForeign('manches_course_id_foreign');
		});
		Schema::table('manches', function(Blueprint $table) {
			$table->dropForeign('manches_categorie_id_foreign');
		});
		Schema::table('points', function(Blueprint $table) {
			$table->dropForeign('points_trophee_id_foreign');
		});
		Schema::table('resultats', function(Blueprint $table) {
			$table->dropForeign('resultats_manche_id_foreign');
		});
		Schema::table('resultats', function(Blueprint $table) {
			$table->dropForeign('resultats_user_id_foreign');
		});
		Schema::table('resultats', function(Blueprint $table) {
			$table->dropForeign('resultats_chassis_id_foreign');
		});
		Schema::table('resultats', function(Blueprint $table) {
			$table->dropForeign('resultats_moteur_id_foreign');
		});
		Schema::table('resultats', function(Blueprint $table) {
			$table->dropForeign('resultats_club_id_foreign');
		});
		Schema::table('inscriptions', function(Blueprint $table) {
			$table->dropForeign('inscriptions_course_id_foreign');
		});
		Schema::table('inscriptions', function(Blueprint $table) {
			$table->dropForeign('inscriptions_categorie_id_foreign');
		});
		Schema::table('inscriptions', function(Blueprint $table) {
			$table->dropForeign('inscriptions_user_id_foreign');
		});
		Schema::table('inscriptions', function(Blueprint $table) {
			$table->dropForeign('inscriptions_kart_id_foreign');
		});
		Schema::table('videos', function(Blueprint $table) {
			$table->dropForeign('videos_manche_id_foreign');
		});
		Schema::table('videos', function(Blueprint $table) {
			$table->dropForeign('videos_user_id_foreign');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_club_id_foreign');
		});
		Schema::table('bonus', function(Blueprint $table) {
			$table->dropForeign('bonus_trophee_id_foreign');
		});
		Schema::table('karts', function(Blueprint $table) {
			$table->dropForeign('karts_user_id_foreign');
		});
		Schema::table('karts', function(Blueprint $table) {
			$table->dropForeign('karts_moteur_id_foreign');
		});
		Schema::table('karts', function(Blueprint $table) {
			$table->dropForeign('karts_chassis_id_foreign');
		});
	}
}