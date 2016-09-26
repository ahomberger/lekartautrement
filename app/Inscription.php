<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model {

	protected $table = 'inscriptions';
	public $timestamps = true;

	public function pilote()
	{
		return $this->belongsTo('Pilote');
	}

	public function course()
	{
		return $this->belongsTo('Course');
	}

}