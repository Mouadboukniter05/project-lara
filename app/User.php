<?php

namespace App;
use Tymon\JWTAuth\Contracts\JWTSubject;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{ 
    // use SoftDeletes;
    use Notifiable;
   // use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'admin' ,'password','phone','post',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function projets() {
        return $this->hasMany('App\Projet') ;
    }
    public function raport() {
        return $this->hasMany('App\Raport') ;
    }
    public function message() {
        return $this->hasMany('App\Message') ;
    }
     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
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
