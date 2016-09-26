<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saison extends Model {

	protected $table = 'saisons';
	public $timestamps = false;
	protected $fillable = array('annee');

	public function trophees()
	{
		return $this->hasMany('Trophee');
	}

}