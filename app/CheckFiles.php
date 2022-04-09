<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckFiles extends Model
{
    
    protected $fillable = ['check_id', 'filename'];
    
    public function check()
    {
        return $this->belongsTo('App\Check');
    }
}
