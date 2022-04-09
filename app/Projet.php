<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projet extends Model
{  
    //  use SoftDeletes;
     protected $fillable = [ 
    	'customer_id','user_id', 'projet_title', 'projet' , 'priority', 'duedate'
     ] ;


     public function customer() {
     	return $this->belongsTo('App\Customer') ;
     }

     public function user() {
         return $this->belongsTo('App\User') ;
     }

     public function projetfiles() {
         return $this->hasMany('App\ProjetFiles') ;
     }
}
