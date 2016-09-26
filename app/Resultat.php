<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resultat extends Model {

	protected $table = 'resultats';
	public $timestamps = true;
	protected $fillable = array('manche_id', 'pilote_id', 'position', 'abandon', 'declassement', 'points', 'chassis_id', 'club_id');

	public function manche()
	{
		return $this->belongsTo('Manche');
	}

	public function pilote()
	{
		return $this->belongsTo('Pilote');
	}

	public function chassis()
	{
		return $this->belongsTo('Chassis');
	}

	public function club()
	{
		return $this->belongsTo('Club');
	}

}