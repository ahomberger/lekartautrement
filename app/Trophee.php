<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trophee extends Model {

	protected $table = 'trophees';
	public $timestamps = true;
	protected $fillable = ['nom', 'saison_id', 'nb_retrait', 'points_pole', 'points_abandon', 'points_declassement'];
	protected $hidden = ['timestamps'];

	public function courses() {
		return $this->hasMany('Course');
	}

	public function categories() {
		return $this->hasMany('Categorie');
	}

	public function points() {
		return $this->hasMany('Point');
	}

	public function saison() {
		return $this->belongsTo('Saison');
	}

	public function bonus() {
		return $this->hasMany('Bonus');
	}

}