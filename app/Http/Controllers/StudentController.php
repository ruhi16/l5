<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Subject;
use App\Student;
use App\Study;
use App\Shreny;

class StudentController extends Controller
{
    public function students(Request $request){
    	$allStud = Student::all();
    	$allSubj = Subject::all();
        $allClss = Shreny::all();

        return view('layouts.students')
        	->with('allStud', $allStud)
        	->with('allSubj', $allSubj)
            ->with('allClss', $allClss);
    }

    public function individualStudent(Request $request, $id){
    	$student = Student::find($id);


    	return view('layouts.individualStudent')->with('student', $student);
    }

    public function studentRoll(){
        $students = Student::where('shreny_id','=','1')->get();

        // foreach($students as $student){
           //echo $student;
        // }
        return view('layouts.studentRoll')->with('students', $students);

    }

    public function rollUpdate(Request $request){

        for($i=0; $i<count($request->id); $i++){
            $student = Student::find($request->id[$i]);
            $student->roll = $request->roll[$i];
            $student->save();
            //echo "hello:".$request->id[$i]."=>".$student->name;
            //echo $request->roll[$i]."<br>";
        }
        //echo $i;
        return redirect()->back();
    }

}
