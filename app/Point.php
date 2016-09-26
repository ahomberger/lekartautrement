<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model {

	protected $table = 'points';
	public $timestamps = true;
	protected $fillable = array('position');

	public function trophee()
	{
		return $this->belongsTo('Trophee');
	}

}