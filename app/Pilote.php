<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pilote extends Model {

	protected $table = 'pilotes';
	public $timestamps = true;
	protected $fillable = array('adresse_id', 'num_licence', 'num_licence_tuteur', 'user_id', 'club_id', 'chassis_id');

	public function club()
	{
		return $this->belongsTo('Club');
	}

	public function resultats()
	{
		return $this->hasMany('Resultat');
	}

	public function inscriptions()
	{
		return $this->hasMany('Inscription');
	}

	public function videos()
	{
		return $this->hasMany('Video');
	}

	public function chassis()
	{
		return $this->belongsTo('Chassis');
	}

	public function adresse()
	{
		return $this->belongsTo('Adresse');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

}