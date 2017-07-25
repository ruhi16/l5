@extends('layouts.baselayout')
@section('title','REPORT PAGE')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
	<h1>Result Table ...</h1>
	<table class="table table-bordered">
		<tr>
			<th>Sl</th>
			<th>Name</th>
			<th>Registraion No</th>
			<th>Class Roll No</th>
			<th>Action</th>
		</tr>
		
		@foreach($students as $student)
		<tr>
			<td></td>
			<td>{{$student->name}}</td>
			<td>{{$student->reg}}</td>
			<td>{{$student->roll}}</td>
			<td>
				<button class="btn btn-primary btn-sm btnGr" data-datac="{{$student->id}}">Get Result</button>

					<a  class="btn btn-info btn-sm dw{{$student->id}} dwn" href="http://localhost/l5/public/{{$student->reg}}.pdf" download>Download</a>

			</td>
		</tr>
		@endforeach

	</table>

	<!-- Pagination Starts -->


	<!-- Pagination Ends -->









@endsection

@section('footer')
	@include('layouts.footer')
@endsection
