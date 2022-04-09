<?php

namespace App;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Model implements JWTSubject
{
    protected $fillable = [
            'id',
            'cust_f_name',
            'cust_l_name',
            'cust_status',
            'cust_adress',
            'cust_phone',
            'cust_email',
    
    ];
    public function getJWTIdentifier()
        {
            return $this->getKey();
        }

        /**
         * Return a key value array, containing any custom claims to be added to the JWT.
         *
         * @return array
         */
        public function getJWTCustomClaims()
        {
            return [];
        }
    // use SoftDeletes;
    public function projets() {
    	return $this->hasMany('App\Projet');
    }
}
