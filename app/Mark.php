<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
	protected $guarded =[];
	
    public function studies(){
    	return $this->belongsTo('App\Study');
    }
}
