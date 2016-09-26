<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model {

	protected $table = 'clubs';
	public $timestamps = true;
	protected $fillable = array('nom', 'adresse_id', 'user_id', 'web', 'tel_fixe', 'tel_port');
	protected $hidden = array('timestamps');

	public function pilotes()
	{
		return $this->hasMany('Pilote');
	}

	public function adresse()
	{
		return $this->belongsTo('Adresse');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function resultats()
	{
		return $this->hasMany('Resultat');
	}

}