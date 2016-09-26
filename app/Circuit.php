<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Circuit extends Model {

	protected $table = 'circuits';
	public $timestamps = true;
	protected $fillable = ['nom', 'adresse_id', 'user_id', 'tel_fixe', 'tel_port'];
	protected $hidden = ['created_at', 'updated_at'];

	public function courses()
	{
		return $this->hasMany('App\Course');
	}

	public function adresse()
	{
		return $this->belongsTo('App\Adresse');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

}