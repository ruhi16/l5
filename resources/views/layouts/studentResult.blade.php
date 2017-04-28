@extends('layouts.baselayout')
@section('title','Dashboard')

@section('header')
	
@endsection



@section('content')

@foreach($students as $student)
@php $gTotal = 0; @endphp
	<div class="row">
		<div class="col-xs-12 text-center">
			<h1><b>Manikchak High Madrasah(H.S.)</b></h1>
			<h4>Lalgola * Murshidabad</h4>
			<b>Progress Report</b> for <b>Class XI Annual Exam-2017</b>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-8 text-left">			
			<div class="row">
				<div class="col-xs-12">
					<br><br>
					<p><h4>Name: {{$student->name}}<small>[Class Roll:{{$student->roll}}]</small></h4></p>
					<p> Registration No: {{$student->reg}}</p>
				</div>
			</div>
		</div>
		<div class="col-xs-4">
			<img src="qrcode.png">
		</div>				
	</div>
		<table class="table table-bordered text-center tabel-sm" style="font-size:12px;">
			<tr>
				<th rowspan="2"></th>
				<th rowspan="2" class="text-center">Subject</th>
				<th colspan="2" class="text-center">Full Marks</th>
				<th colspan="2" class="text-center">Pass Marks</th>
				<th colspan="3" class="text-center">Obtained Marks</th>
				<th rowspan="2" class="text-center">Grade</th>
			</tr>
			<tr>

				<th class="text-center">Theory</th>
				<th class="text-center">Project</th>
				<th class="text-center">Theory</th>
				<th class="text-center">Project</th>
				<th class="text-center">Theory</th>
				<th class="text-center">Project</th>
				<th class="text-center">Total</th>
			</tr>
		@forelse($student->studies as $study)
			<tr>
				<td rowspan="2"></td>
				<td rowspan="2" class="text-left">{{$study->subject->subj or 'Not Assigned'}}</td>
				<td rowspan="2">{{$study->subject->fmTh or ''}}</td>
				<td rowspan="2">{{$study->subject->fmPr or ''}}</td>
				<td rowspan="2">{{$study->subject->pmTh or ''}}</td>
				<td rowspan="2">{{$study->subject->pmPr or ''}}</td>
				@forelse($study->marks as $mark)
					<td>{{(int)$mark->thmark}}</td>
					<td>{{(int)$mark->prmark}}</td>
					<td>{{($mark->thmark+$mark->prmark)}}</td>
					<td rowspan="2">
						
					</td>
					@php $gTotal += ($mark->thmark+$mark->prmark); @endphp
				@empty
					<td></td><td></td><td></td><td rowspan="2"></td>
				@endforelse
			</tr>
			<tr>
				<td colspan="3">Eighty Seven</td>
			</tr>

		@empty
		<td>Data Not Found</td>
		@endforelse
		<tr class="text-left">
			<td colspan="6"><b>Overall Result: <br>Grade:</b></td>
			<td colspan="2"><b>Grand Ttotla</b></td>
			<td class="text-center"><b>{{$gTotal}}</b></td>
			<td class="text-center"><b>{{$gTotal/5}}%</b></td>
		</tr>

		</table>



<br><br>


<table class="table">
	<thead>
		<th class="text-center">Class Teacher</th>
		<th class="text-center">Head of the Institution</th>		
	</thead>
	<tbody>
		
	</tbody>
</table>


<table class="table table-bordered" style="font-size:10px;">
	<thead>
		<tr>
		<th colspan="8" class="text-center">		
		Subjec-wise marks and grade are shown in the Mark Sheet. Classification of Grade is given bellow:		
		</th>
		</tr>
	</thead>

	<tbody class="text-center">
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
</table>


<div style="page-break-after:always;"></div> 
@break{{-- <<<<<<<<<<<<====================<<<<<<<<<<<<<<<< --}}
@endforeach




@endsection










@section('footer')
		
@endsection
