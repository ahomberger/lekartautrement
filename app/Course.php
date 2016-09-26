<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Course extends Model {

	protected $table = 'courses';
	public $timestamps = true;
	protected $fillable = ['date', 'trophee_id', 'circuit_id', 'sens_inverse', 'annulee'];
	protected $appends  = ['circuit', 'trophee'];
	protected $hidden = ['created_at', 'updated_at'];
	protected $dates = ['created_at', 'updated_at', 'date'];

	public function getCircuitAttribute() {
        return $this->circuit()->select('nom')->first()->nom;
    }

    public function getTropheeAttribute() {
        return $this->trophee()->select('nom')->first()->nom;
    }

	public function trophee() {
		return $this->belongsTo('App\Trophee');
	}

	public function circuit() {
		return $this->belongsTo('App\Circuit');
	}

	public function manches() {
		return $this->hasMany('App\Manche');
	}

	public function inscriptions() {
		return $this->hasMany('App\Inscription');
	}

	public function getDateAttribute() {
        if (!empty($this->attributes['date'])) {
            return Carbon::parse($this->attributes['date'])->format('Y-m-d');
        }
        else {
            return $this->attributes['date'];
        }
        
    }

	public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat('Y-m-d', $value);
    }

}