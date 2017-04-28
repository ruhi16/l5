<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shreny extends Model
{
	protected $guarded =[];
	
    public function students(){
    	return $this->hasMany('App\Student');
    }

    public function subjects(){
    	return $this->hasMany('App\Subject');
    }
}
