<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable
{
    protected $table = 'users';
    public $timestamps = true;
    protected $fillable = ['email', 'password', 'sexe', 'nom', 'prenom', 'date_naissance',
    'adresse_ligne1',  'adresse_ligne2', 'code_postal', 'ville', 'pays', 'gps', 'tel_fixe', 'tel_port',
    'num_licence', 'num_licence_tuteur', 'derogation',
    'facebook_id', 'facebook_link', 'google_id', 
    'admin', 'staff','pilote'];
    protected $appends  = ['has_password'];
    protected $hidden = ['password', 'rememberToken'];
    protected $dates = ['created_at', 'updated_at', 'date_naissance'];

    public function setPrenomAttribute($value) {
        $this->attributes['prenom'] = ucwords($value);
    }

    public function setNomAttribute($value) {
        $this->attributes['nom'] = strtoupper($value);
    }

    public function getHasPasswordAttribute() {
        if (!empty($this->attributes['password'])) {
            return true;
        }
        else {
            return false;
        }
    }

    public function getDateNaissanceAttribute() {
        if (!empty($this->attributes['date_naissance'])) {
            return Carbon::parse($this->attributes['date_naissance'])->format('Y-m-d');
        }
        else {
            return $this->attributes['date_naissance'];
        }
        
    }

    public function club() {
        return $this->hasOne('App\Club');
    }

    /**
     * This mutator automatically hashes the password.
     *
     * @var string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }

    public function setDateNaissanceAttribute($value)
    {
        $this->attributes['date_naissance'] = Carbon::createFromFormat('Y-m-d', $value);
    }
}
