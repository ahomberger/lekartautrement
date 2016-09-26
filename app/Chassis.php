<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chassis extends Model {

	protected $table = 'chassis';
	public $timestamps = false;
	protected $fillable = array('nom');

	public function pilotes()
	{
		return $this->hasMany('Pilote');
	}

	public function resultats()
	{
		return $this->hasMany('Resultat');
	}

}