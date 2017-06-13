<?php

use Endroid\QrCode\QrCode;


function qrTest($testReg, $testStr){
    $qrCode = new QrCode();
    $qrCode
        ->setText($testStr)
        ->setSize(150)
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
    $qrCode->save($testReg.'.png');

    // or create a response object
    //$response = new Response($qrCode->get(), 200, ['Content-Type' => $qrCode->getContentType()]);
    //return view('layouts.qrTest');
}
//php namespace App\Http;
//class Helpers {
    function convert($number){
         $hyphen      = '-';
         $conjunction = ' and ';
         $separator   = ', ';
         $negative    = 'negative ';
         $decimal     = ' point ';
         $dictionary  = array(
          0                   => 'Zero',
          1                   => 'One',
          2                   => 'Two',
          3                   => 'Three',
          4                   => 'Four',
          5                   => 'Five',
          6                   => 'Six',
          7                   => 'Seven',
          8                   => 'Eight',
          9                   => 'Nine',
          10                  => 'Ten',
          11                  => 'Eleven',
          12                  => 'Twelve',
          13                  => 'Thirteen',
          14                  => 'Fourteen',
          15                  => 'Fifteen',
          16                  => 'Sixteen',
          17                  => 'Seventeen',
          18                  => 'Eighteen',
          19                  => 'Nineteen',
          20                  => 'Twenty',
          30                  => 'Thirty',
          40                  => 'Fourty',
          50                  => 'Fifty',
          60                  => 'Sixty',
          70                  => 'Seventy',
          80                  => 'Eighty',
          90                  => 'Ninety',
          100                 => 'Hundred',
          1000                => 'Thousand',
        );

              if (!is_numeric($number) ) return false;
              $string = '';
              switch (true) {
                case $number < 21:
                    $string = $dictionary[$number];
                    break;
                case $number < 100:
                    $tens   = ((int) ($number / 10)) * 10;
                    $units  = $number % 10;
                    $string = $dictionary[$tens];
                    if ($units) {
                        $string .= $hyphen . $dictionary[$units];
                    }
                    break;
                case $number < 1000:
                    $hundreds  = $number / 100;
                    $remainder = $number % 100;
                    $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                    if ($remainder) {
                        $string .= $conjunction . convert($remainder);
                    }
                    break;
                default:
                    $baseUnit = pow(1000, floor(log($number, 1000)));
                    $numBaseUnits = (int) ($number / $baseUnit);
                    $remainder = $number % $baseUnit;
                    $string = convert($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                    if ($remainder) {
                        $string .= $remainder < 100 ? $conjunction : $separator;
                        $string .= convert($remainder);
                    }
                    break;
              }
              return $string;
            }




            function grade($grd){
              $g = '';
              if($grd >= 90)
                $g = 'O';
              else if($grd >= 80)
                $g = 'A+';
              else if($grd >= 70)
                $g = 'A';
              else if($grd >= 60)
                $g = 'B+';
              else if($grd >= 50)
                $g = 'B';
              else if($grd >= 40)
                $g = 'C';
              else if($grd >= 30)
                $g = 'P';
              else {
                $g = 'F';
              }


              return $g;
            }



            function makeResultPdf($student){
                  $str = '';
                  $str .= "<center><h1><b>Manikchak High Madrasah(H.S.)</b></h1>
                          <h4>Lalgola * Murshidabad</h4>
                          <h3>DISE Code: 19071515802</h3>
                          <b>Progress Report</b> for <b>Class XI Annual Exam-2017</b></center>";


                  //qrTest($student->reg, $qrStr); //<<<<<<(fileName, stringToEncode)<<<<<<<==============
                  $str .= "<table width='100%' ><tr><td>";
                  $str .= "<td><h3>Name: ".$student->name. " </h3>";
                  $str .= "<h4>Registration No: ".$student->reg."</h4><h4>[XI(2017) Class Roll: ".$student->roll."]</h4></td>";

                  $str .= "<td><div class='col-xs-4'><p align='right'><img src='$student->reg.png'></p></div></td></tr>";
                  $str .= "</table>";
                  $str .= "<table width='100%' border='1' style='border-width:1px; border-color: #222;border: solid; border-collapse: collapse;'>
                  <tr align='center'>
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

                    // $adSubj = ''; $minMark = 100;
                    // foreach ($study->marks as $mark) {
                    //     $tot = (int) ($mark->thmark + $mark->prmark);
                    //     if( $tot < $minMark && $study->subject->subj != 'Bengali' && $study->subject->subj != 'English'){
                    //         $minMark = $tot;
                    //         $adSubj = $study->subject->subj;
                    //     }
                    // }

                  $str .= "<tr align='center'>";
                      $str .= "<td rowspan='2'>".(++$sl)."</td>";
                      $str .= "<td rowspan='2'>".(isset($study->subject->subj)?$study->subject->subj:'')."</td>";//.(($study->subject->subj == $adSubj ? '(Addl.)':'') )
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
                          $str .= "<td rowspan='2'>".grade($mark->thmark+$mark->prmark)."</td>";
                          $gTotal += (int)($mark->thmark+$mark->prmark);
                          if( ($mark->thmark+$mark->prmark) < $min ){  //&& $study->subject->subj != 'Bengali' && $study->subject->subj != 'English'
                              $min = ($mark->thmark+$mark->prmark);
                          }
                      }
                      if($flag == false){
                          $str .= "<td >X</td>";
                          $str .= "<td >X</td>";
                          $str .= "<td >X</td>";
                          $str .= "<td rowspan='2'></td>";

                      }
                      $str .= "</tr>";

                      $str .= "<tr align='center'>";
                      $str .= "<td colspan='3'>".($flag == true ? convert($mark->thmark+$mark->prmark) : 'XXX')."</td>";
                  $str .= "</tr>";
                  }

                  $str .= "<tr align='center' >";
                  $str .= "<td colspan='6' align='left'>Overall Result: <b>".($count > 5 ? grade(($gTotal-$min)/6) : grade($gTotal/5))."</b></td>";
                  $str .= "<td colspan='2'>Grand Total: </td>";
                  $str .= "<td><b>".($count > 5 ? $gTotal-$min : $gTotal)."</b></td>";
                  $str .= "<td><b>".($count > 5 ? round(($gTotal-$min)/$count,2) : round(($gTotal/$count),2))."%</b></td>"; //$min."/".$count."/".
                  $str .= "</tr>";

                  $str .= "<tr>";
                  $str .= "<td colspan='10'>In Word: <b>".($count > 5 ? convert($gTotal-$min) : convert($gTotal))."<b></td>";
                  $str .= "</tr>";

                  $str .= "</table><br><br><br>";

                  $str .= "<table  width='100%' style='border-collapse: collapse; '>
                              <thead><tr>
                                  <th align='center'>Class Teacher</th>
                                  <th align='center'>TIC/Headmaster</th>
                              </tr></thead>
                              <tbody>
                                  <tr>
                                  <td align='center'>Manikchak High Madrasah(H.S.)</td>
                                  <td align='center'>Manikchak High Madrasah(H.S.)</td>
                                  </tr>
                              </tbody>
                          </table>";


                  $str .= "<br><br><br>
                    <table border='1' style='border-collapse: collapse;font-family:arial; font-size: 12px; text-align: center;'>
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
                  $str .= "<p style='font-family:arial; font-size: 12px; text-align: left;'>
                                N.B.:The Total Marks & Average are calculated on the basis of 'Best of 5 Subject' rules.
                              </p>";
              //$str .= "<div style='page-break-after:always;'></div>";
              return $str;
              //$pdf = PDF::loadhtml($str);
          	  //$pdf->setPaper('A4', 'portrate');
          	  //$pdf = PDF::loadView('layouts.studentResult', ['students'=>$students]);
              //$pdf = PDF::loadhtml("<h1>Hello1</h1>");

          	  //return $pdf->stream('resutlAll.pdf');
              //$pdf->download('resutlAll.pdf');

            }// end of function makeResultPdf()


//}
