<?php

namespace App;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
//use Laravel\Passport\HasApiTokens;

class Letter extends Model implements JWTSubject
{
    use  Notifiable;
    protected $fillable = [
         'message','email','post','whoishe','id_client','subject',
    ];
   /* public function Clients() {
        return $this->belongsTo('App\Customer') ;
    }*/

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
}
