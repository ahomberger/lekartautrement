<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adresse extends Model {

	protected $table = 'adresses';
	public $timestamps = true;
	protected $fillable = array('ligne1', 'ligne2', 'cp', 'ville', 'gps');
	protected $hidden = array('timestamps');

	public function circuit()
	{
		return $this->hasOne('Circuit');
	}

	public function pilote()
	{
		return $this->hasOne('Pilote');
	}

	public function club()
	{
		return $this->hasOne('Club');
	}

}