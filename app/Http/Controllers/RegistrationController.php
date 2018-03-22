<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

class RegistrationController extends Controller
{
    public function studentRegister(){
        $stds = Student::all();
        $studys = Study::all();
        $subjs = Subject::all();
        return view('studentRegister')
        ->with('stds', $stds)
        ->with('studys', $studys)
        ->with('subjs', $subjs)
        ;
    }

    public function studentRegisterHtml(){
        $stds = Student::all();
        $subjs = Subject::all();        

        // PDF::setOptions(['dpi' => 150, 
        //                  'defaultFont' => 'sans-serif',
        //                  'defaultPaperSize' => 'a4'])
        //                  ;
        $pdf = PDF::loadView('studentRegisterHtml',['stds'=>$stds, 'subjs'=>$subjs])
            ->setPaper('a4', 'landscape');//, $data);

        
        return $pdf->stream();
        // return $pdf->download('invoice.pdf');


        // return view('studentRegisterHtml')
        // ->with('stds', $stds)
        // ;
    }
}
