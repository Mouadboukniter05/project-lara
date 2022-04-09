<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    // use SoftDeletes;
    protected $fillable = [ 
    	'cont_name','cont_email','cont_message'
    ] ;
}
