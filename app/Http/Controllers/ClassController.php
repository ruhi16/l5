<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Subject;
use App\Student;
use App\Study;
use App\Shreny;
use App\Mark;


class ClassController extends Controller
{
    public function classDetails(){
    	$classes = Shreny::all();
    	
    	return view('layouts.class')->with('classes', $classes);
    }


    public function addClass(Request $request){
    	$classes = new Shreny;
    	$classes->cls = $request->clss;
    	$classes->save();

    	return redirect()->to('/classDetails');
    }


}
