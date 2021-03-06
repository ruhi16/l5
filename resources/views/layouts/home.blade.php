@extends('layouts.baselayout')
@section('title','Home Page')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')

@if(session()->has('error'))
	<div class="alert alert-success">
		<strong>Message! {{session()->get('error')}}</strong>
		{{session()->forget('error')}}
		
	</div>
@endif

	<div class="container">
      <div class="jumbotron">
        <h1>Home Page</h1>
        <p class="lead">This is a intermediatery example of Class XI Result Automation System. The full & Completed version will be arrived soon...</p>
        <a class="btn btn-lg btn-primary" href="#" role="button">View navbar docs &raquo;</a>
      </div>
    </div>

Subject Wise Students List:
<table class="table table-bordered">
@foreach($shrenies as $shreny)	
	@foreach($shreny->subjects as $subject)	
		<tr>
		<td>{{$subject->subj}}</td>
		@php $count = 0; @endphp
		<td>
		{{--  @php	
			$index = 0;
		@endphp  --}}
		@foreach($subject->studies as $study)	
			@php $count++; @endphp	
			<strong>{{$study->student->name}}</strong>({{$study->student->reg}}),

			{{--  <br/>
			@php
				$index++;
				$str = '
				<tr>
					<td>'.$index.'</td>
					<td>'. $study->student->name . '</td>
					<td>'. $study->student->reg  . '</td>
					<td>'. $study->student->roll  . '</td>
					<td><a href="results\resultsxi2018\\'.$study->student->reg.'.pdf">Click Me</a></td>
					<td><a href="results\resultsxi2018\\'.$study->student->reg.'.pdf" download>Click Me</a></td>

				</tr>
				';
			@endphp 
			
			{{$str}}  --}}

		@endforeach	
		</td>
		<td>{{$count}}</td>
		</tr>
	@endforeach	
@endforeach
</table>

Student Wise Subjects List:
<table class="table table-bordered">
@foreach($shrenies as $shreny)
	
	@foreach($shreny->students as $student)	
		<tr>
		<td>{{$student->name}}({{$student->reg}})</td>
		@php $count = 0; @endphp
		<td>
		@foreach($student->studies as $study)	
			@if(isset($study->subject->subj))
				@php $count++; @endphp	
			@endif
			<td>{{$study->subject->subj or ''}}</td>
		@endforeach	
		</td>
		<td>{{$count}}</td>
		</tr>
	@endforeach	
@endforeach

</table>
@endsection


@section('footer')
	@include('layouts.footer')
@endsection
