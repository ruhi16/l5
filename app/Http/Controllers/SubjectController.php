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


class SubjectController extends Controller
{
    public function subject(){
    	$allSubj = DB::table('subjects')->get();   
        $allClss = Shreny::all();     

    	//console.log('hello');
        return view('layouts.subjects')->with('allSubj', $allSubj)->with('allClss', $allClss);
    }

    public function addSubject(Request $request){
        $subj = new Subject;
        $arr = explode('-',$request->get('forcls'));
        
        $subj->subj     = $request->newsub;
        $subj->shreny_id = $arr[0];
        $subj->forclass = $arr[1];
        $subj->fmTh = $request->fmTh;        
        $subj->fmPr = $request->fmPr;
        $subj->pmTh = $request->pmTh;
        $subj->pmPr = $request->pmPr;

        $subj->save();
        
        return redirect()->to('/subject');
    }

    public function updateSubject(Request $request){
        //echo "stu id:".$request->tsub2;
        //echo "sub is:".$request->get('sub1')."<br>";            

             //echo $request->tsub1." = ".$request->sub1."<br>";
             $study = Study::find($request->tsub1);
             $study->subject_id = $request->sub1;
             $study->save();

             //echo $request->tsub2." = ".$request->sub2."<br>";
             $study = Study::find($request->tsub2);
             $study->subject_id = $request->sub2;
             $study->save();

             //echo $request->tsub3." = ".$request->sub3."<br>";
             $study = Study::find($request->tsub3);
             $study->subject_id = $request->sub3;
             $study->save();

             //echo $request->tsub4." = ".$request->sub4."<br>";
             $study = Study::find($request->tsub4);
             $study->subject_id = $request->sub4;
             $study->save();

             //echo $request->tsub5." = ".$request->sub5."<br>";
             $study = Study::find($request->tsub5);
             $study->subject_id = $request->sub5;
             $study->save();

             //echo $request->tsub6." = ".$request->sub6."<br>";
             $study = Study::find($request->tsub6);
             $study->subject_id = $request->sub6;
             $study->save();

        

        return redirect()->to('/students');

    }


    public function editSubject($n){
        $esubj = Subject::find($n);       
        return "hello";

    }


    public function xyz(Request $request){
    	$esubj = Subject::find($request['val']);
        
        $oldsub = $esubj->subj;

    	$esubj->subj = $request['sub'];
    	$esubj->save();

    	//dd($request->sub);


		return response()->json(['newsub'	=> $esubj->subj, 'newsubid' => $esubj->id, 'oldsub'=>$oldsub]);

		    	//return Response::json(["option"=>$esubj]);
    }

    public function updateMarks(Request $request){
        $marks = Mark::find($request['val']);
        $marks->thmark = (float)$request['sth'];
        $marks->prmark = (float)$request['spr'];
        $marks->save();
        
        return response()->json(['mrkid'=>$marks->id, 'thm'=>$marks->thmark, 'prm'=>$marks->prmark]);
    }

    public function insertMarks(Request $request){
        $mark = new Mark;
        $mark->study_id = (int) $request['val'];
        $mark->thmark = (float) $request['sth'];
        $mark->prmark = (float) $request['spr'];
        $mark->exam_id = 1;
        $mark->save();

        return response()->json(['mrkid'=> $mark->id, 'subid'=>$mark->study_id, 'thm'=>$request['sth'], 'prm'=>$request['spr']]);

    }



    

    public function test(){
        $clss  = Shreny::all();
        $subjs = Subject::all();

        return view ('layouts.test')
                ->with('subjs', $subjs)
                ->with('clss', $clss);
                
    }


    public function selectSubject(Request $request){       
        $clsses = Shreny::find($request->cls);//->paginate(1);
        
        $test = DB::table('shrenies')
            ->join('subjects', 'shrenies.id', '=', 'subjects.shreny_id')
            ->join('students', 'shrenies.id', '=', 'students.shreny_id')
            ->join('studies', function($join)
            {
              $join->on('studies.student_id', '=', 'students.id');
              $join->on('studies.subject_id', '=', 'subjects.id');
            })
            ->leftJoin('marks', 'marks.study_id', '=', 'studies.id')
            ->select('students.*','subjects.*', 'studies.*', 'studies.id as sid', 'marks.*')
            ->where('subjects.subj', '=', $request->sub)
            ->where('shrenies.id',   '=', $request->cls)
            ->paginate(20);
                
                
        return view('layouts.marksEntryNew')
                 ->with('clsses',$clsses)
                 ->with('test', $test)
                 ->with('clss', $request->cls)
                 ->with('subj', $request->sub);    
    }

    public function AddSubMrk(Request $request) {
      $mark = DB::table('marks')->where('study_id', $request['sid'])->first();
      
      if(isset($mark)){
        $mark = Mark::find($mark->id);
        $mark->study_id = (int) $request['sid'];
        $mark->thmark = (float) $request['thm'];
        $mark->prmark = (float) $request['prm'];
        $mark->exam_id = 1;
        $mark->save();
        $text = "Records Updated".$mark->id;
      }else{
        $mark = new Mark;
        $mark->study_id = (int) $request['sid'];
        $mark->thmark = (float) $request['thm'];
        $mark->prmark = (float) $request['prm'];
        $mark->exam_id = 1;
        $mark->save();
        $text = "New Record Inserted";
      }

      
      return response()->json(['oval' => $request['thm'], 'nval' => $mark->thmark]);
      //return response()->json(['sid' => $request['sid'], 'thm' => $request['thm'], 'prm' => $request['prm']]); 
    }


    public function addMarks(Request $request){
        $mark = new Mark;
        $Tvals = $request->get('Tmark');
        $Pvals = $request->get('Pmark');
        $code = $request->get('code');
        
        $stack = array();
        for($i=0; $i<count($code); $i++){
            echo $code[$i]."=>".$Pvals[$i]."=>".$Tvals[$i]."<br>";
            $data = array("study_id"=> $code[$i],
                          "thmark"  => (float)$Tvals[$i],
                          "prmark"  => (float)$Pvals[$i],
                          "exam_id" => 1);
            array_push($stack, $data);
            print_r($data); echo"<br>";
            print_r($stack);echo"<br>";            
        }
        $mark->Insert($stack);

        return redirect()->to('/test2');
    }  



    
}
