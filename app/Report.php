<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [ 
    	'user_id', 'raport_title', 'raport' , 'duedate'
     ] ;
     public function user() {
        return $this->belongsTo('App\User') ;
    }
}
