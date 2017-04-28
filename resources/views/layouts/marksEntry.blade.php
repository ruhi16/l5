@extends('layouts.baselayout')
@section('title','TEST PAGE')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
	<h1>Marks Entry...</h1>
	<h2>Marks Entry for Class: {{$clsses->cls}} and Subject: {{$subj}}</h2>
	<br>



	{!! Form::open(['url'=>'/addMarks','method'=>'post']) !!}
	<table class="table table-bordered">
	<tr><th>Name</th><th>Subject</th><th>Th Marks</th><th>Pr Marks({{$clss}})</th><th>Action</th></tr>

	@foreach($clsses->students as $std)
		<tr><?php $sub=''; $subId=0; ?>
			<td>{{$std->id}}:{{$std->name}}</td>
			
			@foreach($std->studies as $s)				
				@if($s->subject_id != 0 AND $s->subject->subj == $subj)				
					<?php 
						$sub   = $s->id.$s->subject->subj; 
						$subId = $s->id; 
					?>					
				@endif
			@endforeach
			@if($sub != '')
				<td>{{$sub}}</td>
				<input type="hidden" name="code[]" value="{{$subId}}">
				<td><input type="text" name="Tmark[]" value =""></td>
				<td><input type="text" name="Pmark[]" value =""></td>
				<td><a class="btn btn-info" name="">Save</a></td>
			@else
				<td></td>	<td></td>	<td></td>	<td></td>
			@endif
			
		</tr>
	@endforeach


	</table>
	<button type="reset" class="btn btn-primary">Reset Fields</button>
	<button type="submit" class="btn btn-warning">Add New Records</button>	
	{!! Form::close() !!}


<script type="text/javascript">
	$(document).ready(function(){
		//alert("Hello");
	});


</script>	
@endsection





@section('footer')
	@include('layouts.footer')
@endsection