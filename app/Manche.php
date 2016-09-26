<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manche extends Model {

	protected $table = 'manches';
	public $timestamps = true;
	protected $fillable = array('points_pole', 'points_position');

	public function course()
	{
		return $this->belongsTo('Course');
	}

	public function categorie()
	{
		return $this->belongsTo('Categorie');
	}

	public function resultats()
	{
		return $this->hasMany('Resultat');
	}

	public function videos()
	{
		return $this->hasMany('Video');
	}

}