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


class ResultController extends Controller
{
    public function reportDetails(){
    	
    	return view('layouts.ReportDetails');
    }

    public function updateIndividualMarks(Request $request){
    	
    }


   
    public function studentResultPdf(Request $request){
    	$students = Student::all();

        $str = "";
        foreach ($students as $student) {
            
            $str .= "<center><h1><b>Manikchak High Madrasah(H.S.)</b></h1>
                    <h4>Lalgola * Murshidabad</h4>
                    <b>Progress Report</b> for <b>Class XI Annual Exam-2017</b></center>";



            $str .= "<table width='100%'><tr><td>";
            $str .= "<td><h3>Name: ".$student->name. " [Class Roll: ".$student->roll."]</h3>";
            $str .= "<h4>Registration No: ".$student->reg."</h4></td>";
            $str .= "<td><div class='col-xs-4'><center><img src='qrcode.png'></center></div></td></tr>";
            $str .= "</table>";
            $str .= "<table border='1' width='100%'>
            <tr>
                <th rowspan='2'></th>
                <th rowspan='2' class='text-center'>Subject</th>
                <th colspan='2' class='text-center'>Full Marks</th>
                <th colspan='2' class='text-center'>Pass Marks</th>
                <th colspan='3' class='text-center'>Obtained Marks</th>
                <th rowspan='2' class='text-center'>Grade</th>
            </tr>
            <tr>

                <th class='text-center'>Theory</th>
                <th class='text-center'>Project</th>
                <th class='text-center'>Theory</th>
                <th class='text-center'>Project</th>
                <th class='text-center'>Theory</th>
                <th class='text-center'>Project</th>
                <th class='text-center'>Total</th>
            </tr>";
            $gTotal = 0; $min=100; $sl=0;$count = 0;
            foreach ($student->studies as $study) {

            $str .= "<tr>";
                $str .= "<td rowspan='2'>".(++$sl)."</td>";
                $str .= "<td rowspan='2'>".(isset($study->subject->subj)?$study->subject->subj:'')."</td>";
                $str .= "<td rowspan='2'>".(isset($study->subject->subj)?$study->subject->fmTh:'')."</td>";
                $str .= "<td rowspan='2'>".(isset($study->subject->subj)?$study->subject->fmPr:'')."</td>";
                $str .= "<td rowspan='2'>".(isset($study->subject->subj)?$study->subject->pmTh:'')."</td>";
                $str .= "<td rowspan='2'>".(isset($study->subject->subj)?$study->subject->pmPr:'')."</td>";
                $flag = false;
                
                foreach ($study->marks as $mark) {
                    $flag = true; $count++;
                    $str .= "<td >".(int)$mark->thmark."</td>";
                    $str .= "<td >".(int)$mark->prmark."</td>";
                    $str .= "<td >".(int)($mark->thmark+$mark->prmark)."</td>";
                    $str .= "<td rowspan='2'></td>";  
                    $gTotal += (int)($mark->thmark+$mark->prmark);
                    if( ($mark->thmark+$mark->prmark) < $min ){
                        $min = ($mark->thmark+$mark->prmark);
                    }
                }
                if($flag == false){
                    $str .= "<td >a</td>";
                    $str .= "<td >b</td>";
                    $str .= "<td >c</td>";
                    $str .= "<td rowspan='2'></td>";
                }
                $str .= "</tr>";
                
                $str .= "<tr>";
                $str .= "<td colspan='3'>YY</td>";
            $str .= "</tr>";
            }

            $str .= "<tr>";
            $str .= "<td colspan='6'>Overall Result</td>";
            $str .= "<td colspan='2'>Grand Total</td>";
            $str .= "<td>".($count > 5 ? $gTotal-$min : $gTotal)."</td>";
            $str .= "<td>".$min."/".$count."</td>";
            $str .= "</tr>";

            $str .= "<tr>";
            $str .= "<td colspan='10'>In Word: </td>";
            $str .= "</tr>";

            $str .= "</table><br><br><br>";

            $str .= "<table width='100%'>
                        <thead><tr>
                            <th >Class Teacher</th>
                            <th >Head of the Institution</th>        
                        </tr></thead>
                        <tbody>
                            <tr>
                            <td>Class XI</td>
                            <td>Manikchak High Madrasah(H.S.)</td>
                            </tr>
                        </tbody>
                    </table>";


            $str .= "<br><br><br><table border='1'>
                <thead>
                    <tr>
                    <th colspan='8'>        
                    Subjec-wise marks and grade are shown in the Mark Sheet. Classification of Grade is given bellow:       
                    </th>
                    </tr>
                </thead>

                <tbody>
                <tr>
                    <td>90-100:O [Outstanding]</td>
                    <td>88-89: A+ [Excelent]</td>
                    <td>70-79: A [Very Good]</td>
                    <td>60-69: B+ [Good]</td>
                    <td>50-59: B [Satisfactory]</td>
                    <td>40-49: C [Fair]</td>
                    <td>30-39: P [Passed]</td>
                    <td>Bellow 39: F [Failed]</td>
                </tr>
                </tbody>
            </table>";


            // $str =  "<h1>Hello<br>thi is test.</h1>
            //          <div style='page-break-after:always;'></div> 
            //          <h1>Hello<br>thi is test.</h1>";


            // for($i=0; $i<10; $i++){
            //    $str = $str. $i."<div style='page-break-after:always;'>hello</div>"."Hello<br>";
            // }
        $str .= "<div style='page-break-after:always;'></div>";
        break;
        }
            $pdf = PDF::loadhtml($str);
        	$pdf->setPaper('A4', 'portrate');
        	//$pdf = PDF::loadView('layouts.studentResult', ['students'=>$students]);
            //$pdf = PDF::loadhtml("<h1>Hello1</h1>");
        	
        	//return $pdf->stream('resutlAll.pdf');

        

        
        return $pdf->download('resutlAll.pdf');
        //return view('layouts.studentResult')->with('students', $students);
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
        return $pdf->stream('resutlAll.pdf');
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