<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	protected $guarded =[];

    public function studies(){
    	return $this->hasMany('App\Study');
    }

    public function shrenies(){
    	return $this->belongsTo('App\Shreny');
    }
    
}
