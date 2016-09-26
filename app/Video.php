<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model {

	protected $table = 'videos';
	public $timestamps = true;

	public function pilote()
	{
		return $this->belongsTo('Pilote');
	}

	public function manche()
	{
		return $this->belongsTo('Manche');
	}

}