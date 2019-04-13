<?php

namespace App\Http\Controllers;
ini_set('max_execution_time', 5000);
//ini_set("memory_limit","256M");
ini_set('memory_set',-1);
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

class ResultController extends Controller
{
    public function reportDetails(){

    	return view('layouts.ReportDetails');
    }

    public function updateIndividualMarks(Request $request){

    }



    public function studentResultPdf(Request $request){
      $students = Student::all();//text-align:center;

      // $allStuds = DB::table('shrenies')
      //     ->join('subjects', 'shrenies.id', '=', 'subjects.shreny_id')
      //     ->join('students', 'shrenies.id', '=', 'students.shreny_id')
      //     ->join('studies', function($join)
      //     {
      //       $join->on('studies.student_id', '=', 'students.id');
      //       $join->on('studies.subject_id', '=', 'subjects.id');
      //     })
      //     ->leftJoin('marks', 'marks.study_id', '=', 'studies.id')
      //     ->select('students.*','subjects.*', 'studies.*', 'studies.id as sid', 'marks.*')
      //     ->where('subjects.subj', '=', $request->sub)
      //     ->where('shrenies.id',   '=', $request->cls)
      //     ->where('students.id','=', 2) //<<<<<<<<<<<<<<< submit student id, want to get result
      //     ->get();


        //foreach ($allStuds as $key) { //<<<<<<<<<<
        foreach ($students as $student) {
            $qrStr = '';

            $qrStr .= 'MHM-HS-19071515802-XI-An(2018)/Result-Nm:'.$student->name.' ('.$student->roll.') Rg-'.$student->reg.' ';
            // refer to helper.php for helper function() utilised

            foreach ($student->studies as $study) {
                $qrStr .= (isset($study->subject->subj)? $study->subject->subj : '') . '-';
                foreach ($study->marks as $mark) {
                    $qrStr .= '('.(int)$mark->thmark.'+'.(int)$mark->prmark.'); ';
                }
            }

            qrTest($student->reg, $qrStr);
        }

        $str = "";
        foreach ($students as $student) {
          // refer to helper.php for helper function() utilised
          $str .= makeResultPdf($student);
          break;
        }




          $pdf = PDF::loadhtml($str)
            ->setPaper('A4', 'portrate')
            ->save('result.pdf');
        	//$pdf->setPaper('A4', 'portrate');

        return $pdf->download('resutlAll.pdf');
        //return view('layouts.studentResult')->with('students', $students);
    }

    //===== start =================================================
    public function resultTableAllCopy(Request $request){
        $students = Student::get();
        //console.log($students);
        return view('layouts.resultTableAllCopy')->with('students', $students);
    }

    public function resultTableAll(Request $request){
        $students = Student::paginate(10);
        //console.log($students);
        return view('layouts.resultTableAll')->with('students', $students);
    }
    public function downloadResult(Request $request){
        $student = Student::find($request['sid']);

            $qrStr = '';
            $qrStr .= 'MHM-HS-19071515802-XI-An-2018/RS-N:'.$student->name.'-'.$student->roll.'-'.$student->reg.' ';
            foreach ($student->studies as $study) {
                $qrStr .= (isset($study->subject->subj)? $study->subject->subj : '') . '-';
                foreach ($study->marks as $mark) {
                    $qrStr .= '('.(int)$mark->thmark.'+'.(int)$mark->prmark.');';
                }
            }

            qrTest($student->reg, $qrStr);
            $strDetails = makeResultPdf($student);

            $pdf = PDF::loadhtml($strDetails)
          	      ->setPaper('A4', 'portrate')
                  ->save($student->reg.'.pdf');


            //$pdf->download('resutlAll.pdf');
        $stdReg = '';//$student->reg;
        if(is_null($student)){
            $stdReg = "Data not Found!";
        }else{
            $stdReg = $student->reg;
        }
        return response()->json([
                                 'id'=>  $request['sid'],
                                 'name'=> $stdReg//$student->name
                               ]);
        //return response()->download($student->reg.'.pdf');
    }
    //====== end =================================================

    public function studentResultIndPdf(Request $request){
        $students = DB::table('shrenies')
            ->join('subjects', 'shrenies.id', '=', 'subjects.shreny_id')
            ->join('students', 'shrenies.id', '=', 'students.shreny_id')
            ->join('studies', function($join)
            {
              $join->on('studies.student_id', '=', 'students.id');
              $join->on('studies.subject_id', '=', 'subjects.id');
            })
            ->leftJoin('marks', 'marks.study_id', '=', 'studies.id')
            ->select('students.*','subjects.*', 'studies.*', 'studies.id as sid', 'marks.*')
            //->where('subjects.subj', '=', $request->sub)
            //->where('shrenies.id',   '=', $request->cls)
            ->where('students.id','=', 2) //<<<<<<<<<<<<<<< submit student id, want to get result
            ->paginate(20);

        //qrTest("Hello");
        //$students = Student::all();
        return view('layouts.resultIndividual')->with('students', $students);
        //return view('layouts.marksEntryNew')->with('test', $students);
    }



    public function studentRegisterPdf(){

    	$students = Student::all();

    	$pdf = PDF::loadView('layouts.reportRegister', ['students'=>$students]);
    	$pdf->setPaper('Legal', 'landscape');
    	return $pdf->stream('resutlAll.pdf');
    	//return view('layouts.reportRegister')->with('students', $students);
    }

    public function studentSubRegisterPdf(Request $request){
        $cls = $request->cls;
        $sub = $request->sub;
        $shreny = Shreny::all();

        $pdf = PDF::loadView('layouts.studentSubRegisterPdf', ['shreny'=>$shreny, 'cls'=>$cls, 'sub'=>$sub]);

        $pdf->setPaper('A4', 'portrate');
        $str = $cls.' - '.$sub.'.pdf';
        return $pdf->stream($str);
        //return $pdf->download('resutlAll.pdf');
        //return view('layouts.studentSubRegisterPdf')->with('shreny', $shreny)->with('cls', $cls)->with('sub', $sub);


    }


    public function selectSubjectPdf(){
        $clss  = Shreny::all();
        $subjs = Subject::all();



        return view ('layouts.selectSubjectPdf')
                ->with('subjs', $subjs)
                ->with('clss', $clss);
    }

    public function qrTest(){
        $qrCode = new QrCode();
        $qrCode
            ->setText('Manichak High Madrasah(H.S.)-Annual Exam-2017 of Class-XI Name: Hari Naryan Das(Reg:410232562) Results:Bng:65+12, En')
            ->setSize(100)
            ->setPadding(10)
            ->setErrorCorrection('high')
            ->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0])
            ->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0])
            //->setLabel('Scan the code..')
            //->setLabelFontSize(10)
            ->setImageType(QrCode::IMAGE_TYPE_PNG)
        ;

        // now we can directly output the qrcode
        //header('Content-Type: '.$qrCode->getContentType());
        //$qrCode->render();

        // save it to a file
        $qrCode->save('qrcode.png');

        // or create a response object
        //$response = new Response($qrCode->get(), 200, ['Content-Type' => $qrCode->getContentType()]);
        return view('layouts.qrTest');
    }



}

/*

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml('hello world');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
Setting Options

Set options during dompdf instantiation:

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('defaultFont', 'Courier');
$dompdf = new Dompdf($options);
or at run time

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$


$pdf=PDF::loadView('print_tests.test_pdf', ['data' => $data]);
    $pdf->setOptions('isPhpEnabled', true);
    $pdf->setPaper('L', 'landscape');
    return $pdf->stream('test_pdf.pdf');

*/
