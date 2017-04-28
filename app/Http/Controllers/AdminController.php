<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SelectSubjectRequest;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Input;
// use Illuminate\Support\Facades\Redirect;

use DB;
use App\User;
use App\Subject;
use App\Student;
use App\Study;
use App\Mark;
use App\Exam;
use App\Shreny;

class AdminController extends Controller
{
    public function home(){
        $shrenies = Shreny::all();
    	return view('layouts.home')->with('shrenies', $shrenies);
    }


    public function login(){


    	return view('layouts.login');
    }


    
    
    public function loginSubmit(LoginRequest $request){       
        $vUs = User::where('email','like',$request->email)
                   ->where('password','like',md5($request->password));
        if($vUs->count() == 1){
            session()->put('user',$request->email);
            session()->put('error','Succesfully Login');
            //return "Welcome, you are now Logged In...";
            return redirect()->to('/dashboard');
        }else{
            //session()->put('user',$request->email);
            session()->put('error','Email or Password does not matched');
            return redirect()->to('/login');            
        }       

    }
    public function register(){
    	return view('layouts.register');
    }

    public function registerSubmit(Request $request){  
    	$vEm = User::where('email','like',$request->email)->count();

    	if($vEm != 0){
    		session()->put('error','This Email is already registered, use alternative one!');
	    	return redirect()->to('/register');
    	}

    	if($request->password == $request->confpassword){	
	    	$user = new User;
			$user->name 	= $request->name;
			$user->email 	= $request->email;
			$user->password = md5($request->password);
			$user->email 	= $request->email;
			$user->save();

	   		session()->put('error','Successfully User Registered.');
	    	return redirect()->to('/home');

    	}else{
    		session()->put('error','Password does not matched!');
    		return redirect()->to('/register');
    	}

    }

    

    public function dashboard(){
        
        $allSubj = DB::table('subjects')->get();
        $allStud = Student::all();
        $allClss = Shreny::all();
        


        return view('layouts.dashboard')
                    ->with('allSubj', $allSubj)
                    ->with('allStud', $allStud)
                    ->with('allClss', $allClss);
    }




    //---------------------------------------------------------------------------------
    public function test2(){
        
        $students = Student::all();     


        return view('layouts.test2')             
            ->with('students', $students);
    }




    public function addStudent(SelectSubjectRequest $request){
        $stud = new Student;
        $stud->name = $request->name;
        $stud->shreny_id = $request->get('clss');
        $stud->roll = $request->roll;
        $stud->reg = $request->reg;
        //$stud->save();

        $stdy = new Study; 
        $data = array(       
        array(  "student_id" => $stud->id,
                "subject_id" => $request->get('sub1')),
        array(  "student_id" => $stud->id,
                "subject_id" => $request->get('sub2')),
        array(  "student_id" => $stud->id,
                "subject_id" => $request->get('sub3')),
        array(  "student_id" => $stud->id,
                "subject_id" => $request->get('sub4')),
        array(  "student_id" => $stud->id,
                "subject_id" => $request->get('sub5')),
        array(  "student_id" => $stud->id,
                "subject_id" => $request->get('sub6'))
        );
        //$stdy->insert($data);
        
        return "Successfull";
        //return redirect()->to('/dashboard');
        
    }


    public function getShow($n){
        $estud = Student::find($n);
        //echo $n;
        return view('layouts.editstudents')->with('estud',$estud);
    }
    
}