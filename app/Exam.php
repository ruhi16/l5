<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
	protected $guarded =[];
	
    public function marks(){
    	return $this->hasMany('App\Mark');
    }
}
