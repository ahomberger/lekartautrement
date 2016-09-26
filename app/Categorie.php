<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model {

	protected $table = 'categories';
	public $timestamps = true;
	protected $fillable = array('nom', 'age', 'poids', 'tarif', 'trophee_id');
	protected $hidden = array('timestamps');

	public function trophee()
	{
		return $this->belongsTo('Trophee');
	}

	public function manches()
	{
		return $this->hasMany('Manche');
	}

}