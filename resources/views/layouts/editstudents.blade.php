@extends('layouts.baselayout')
@section('title','Students Details')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
<h1>Students Details</h1>
@if(session()->has('error'))
	<div class="alert alert-success">
		<strong>Message! {{session()->get('error')}} </strong>		
	</div>
@endif

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Panel heading</div>

  	<table class="table table-bordered">
    <thead>
      <tr>
        <th>Roll</th>
        <th>Name</th>
        <th>Registraion No</th>
        <th>Subjects Alloted</th>
        <th>Action</th>
      </tr>
    </thead>
    	<tbody>
      
      <tr>
        <td>{{$estud->roll}}</td>
        <td>{{$estud->name}}</td>
        <td>{{$estud->reg}}</td>
        <td>
        @foreach($estud->studies as $stud)
          @if($stud->subject_id != 0)
            {{$stud->subject->subj}}, <br>
          @endif
        @endforeach
        </td>
        <td><button class="btn btn-success btn-lg">Edit</button></td>
      </tr>
      
    	</tbody>
  	</table>

  
</div>

@endsection


@section('footer')
	@include('layouts.footer')
@endsection