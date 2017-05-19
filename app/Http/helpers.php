<?php

use Endroid\QrCode\QrCode;


function qrTest($testReg, $testStr){
    $qrCode = new QrCode();
    $qrCode
        ->setText($testStr)
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
          0                   => 'zero',
          1                   => 'one',
          2                   => 'two',
          3                   => 'three',
          4                   => 'four',
          5                   => 'five',
          6                   => 'six',
          7                   => 'seven',
          8                   => 'eight',
          9                   => 'nine',
          10                  => 'ten',
          11                  => 'eleven',
          12                  => 'twelve',
          13                  => 'thirteen',
          14                  => 'fourteen',
          15                  => 'fifteen',
          16                  => 'sixteen',
          17                  => 'seventeen',
          18                  => 'eighteen',
          19                  => 'nineteen',
          20                  => 'twenty',
          30                  => 'thirty',
          40                  => 'fourty',
          50                  => 'fifty',
          60                  => 'sixty',
          70                  => 'seventy',
          80                  => 'eighty',
          90                  => 'ninety',
          100                 => 'hundred',
          1000                => 'thousand',
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


//}
