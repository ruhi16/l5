@extends('layouts.baselayout')
@section('title','TEST PAGE')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
	<h1>Marks Entry...</h1>
	<h2>Marks Entry for Class: {{$clsses->cls}} and Subject: {{$subj}}</h2>
	<br>

	<table class="table table-bordered">
	<tr><th>Name</th><th>Subject</th><th>Th Marks</th><th>Pr Marks</th><th>Total</th><th>Action</th></tr>

	@foreach($clsses->students as $student)
		<tr>
			<td>{{$student->name}}</td>
			@foreach($student->studies as $study)					
				@if($study->subject_id != 0 AND $study->subject->subj == $subj)
					<td>{{$study->subject->subj}}</td>
					@foreach($study->marks as $mark)
						<td><input type="text" name="" value ="{{$mark->thmark}}"></td>
						<td><input type="text" name="" value ="{{$mark->prmark}}"></td>
						<td><b>{{$mark->thmark+$mark->prmark}}</b></td>
						<td><button class="btn btn-primary" value="{{$subject->id}}">Save</button></td>
					@endforeach
				@endif			

			@endforeach
			
		</tr>		
	@endforeach


	</table>
		

	
@endsection





@section('footer')
	@include('layouts.footer')
@endsection