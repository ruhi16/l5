<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

ini_set('max_execution_time', 5000);
//ini_set("memory_limit","256M");
ini_set('memory_set',-1);

use Endroid\QrCode\QrCode;
use DB;
use App\User;
use App\Subject;
use App\Student;
use App\Study;
use App\Mark;
use App\Exam;
use App\Shreny;
use PDF;
use App\Http\helpers;

use App\Meritlist;
use App\Minelecmark;

use App\Studentmarksdetail;
use App\Studentminopmarksdetail;
use App\Studentbest5subjectmarksdetail;


use Illuminate\Support\Collection;

class ReportController extends Controller
{
    public function compactMarksRegister(Request $request){
        $students = Student::all();
        
        $marks = Mark::all();
        $meritlists = Meritlist::all();
        $minelecmarks = Minelecmark::all();

        $stdy = Study::all()->sortBy('student_id');




        return view('layouts.compactMarksRegister')
            ->with('students', $students)
            ->with('marks', $marks)
            ->with('meritlists', $meritlists)
            ->with('minelecmarks', $minelecmarks)
            ->with('stdy', $stdy)
        ;
    }


    

    public function compactMarksRegisterHTML(Request $request){
        $students = Student::all()->sortBy('roll');


        $pdf = pdf::LOADvIEW('layouts.compactMarksRegisterHTML', ['students'=>$students])
                    ->setPaper('a4', 'portrate');
        
        return $pdf->stream();         
    }



    //=============================
    public function compactMeritList(Request $request){

        $meritlists = Meritlist::all();

        return view('layouts.compactMeritList')
            ->with('meritlists', $meritlists)
        ;
    }

    public function compactMeritListHTML(Request $request){
        $meritlists = Meritlist::all();
        

        $pdf = pdf::LOADvIEW('layouts.compactMeritListHTML', ['meritlists'=>$meritlists])
                    ->setPaper('a4', 'portrate');

        return $pdf->stream();  
        // return view('layouts.compactMeritListHTML');
        // $students = Student::all();

        // return view('layouts.compactMeritListHTML')
        //     ->with('students', $students)
        // ;
    }


    //============================================================
    public function compactMeritListBest5(){
        $stmrkdetails = Studentmarksdetail::all();
        $stminmrk = Studentminopmarksdetail::all();
        $stbest5mrk = Studentbest5subjectmarksdetail::all()->sortByDesc('total5subject');


        return view ('layouts.compactMeritListBest5')
            ->with('stmrkdetails', $stmrkdetails)
            ->with('stminmrk', $stminmrk)
            ->with('stbest5mrk', $stbest5mrk)
        ;
    }

    public function compactMeritListBest5HTML(){
        $stmrkdetails = Studentmarksdetail::all();
        $stminmrk = Studentminopmarksdetail::all();
        $stbest5mrk = Studentbest5subjectmarksdetail::all()->sortByDesc('total5subject');


        $pdf = pdf::LOADvIEW('layouts.compactMeritListBest5HTML', 
                    ['stmrkdetails' => $stmrkdetails, 'stminmrk'=> $stminmrk, 'stbest5mrk' => $stbest5mrk])
                    ->setPaper('a4', 'portrate');
        
        return $pdf->stream(); 

        // return view ('layouts.compactMeritListBest5HTML')
        //     ->with('stmrkdetails', $stmrkdetails)
        //     ->with('stminmrk', $stminmrk)
        //     ->with('stbest5mrk', $stbest5mrk)
        // ;
    }


}
