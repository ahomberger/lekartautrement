<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model {

	protected $table = 'bonus';
	public $timestamps = true;
	protected $fillable = array('trophee_id', 'pourcentage', 'points');
	protected $hidden = array('timestamps');

	public function trophee()
	{
		return $this->belongsTo('Trophee');
	}

}