@extends('layouts.baselayout')
@section('title','Dashboard')

@section('header')
	@include('layouts.navbar')
@endsection



@section('content')

{!! Form::open(['url'=>'/rollUpdate','method'=>'post']) !!}
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Sl No</th>
			<th>Name</th>
			<th>Reg No</th>
			<th>Roll</th>
		</tr>
	</thead>
	<tbody>
		@php $i=0; @endphp
		@foreach($students as $student)
		<tr>
			<td><input type="hidden" name="id[]" value="{{$student->id}}">{{++$i}}</td>
			<td>{{$student->name}}</td>
			<td>{{$student->reg}}</td>
			<td><input type="text" class="form-control" name="roll[]" value="{{$student->roll}}"></td>
		</tr>
		@endforeach
	</tbody>
</table>

	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Update All Students Roll Nos</button>
{!! Form::close() !!}

@endsection


@section('footer')
	@include('layouts.footer')
@endsection
