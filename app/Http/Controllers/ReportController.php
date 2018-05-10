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


class ReportController extends Controller
{
    public function compactMarksRegister(Request $request){
        $students = Student::all();

        return view('layouts.compactMarksRegister')
            ->with('students', $students)
        ;
    }

    public function compactMeritList(Request $request){

        $students = Student::all();

        return view('layouts.compactMeritList')
            ->with('students', $students)
        ;
    }
}
