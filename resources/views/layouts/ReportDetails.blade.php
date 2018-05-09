@extends('layouts.baselayout')
@section('title','REPORT PAGE')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
	<h1>Report's Hub ...</h1>


	<a class="btn btn-primary" 	href="{!! url('/studentResultPdf') !!}">All Students Result</a>
	<a class="btn btn-warning" 	href="{!! url('/resultTableAll') !!}">All Result Table Page</a>
	<a class="btn btn-success" 	href="{!! url('/studentRegisterPdf') !!}">All Students Register</a>
	<a class="btn btn-info" 	href="{!! url('/studentResultIndPdf') !!}">Student Individual Result</a>



	{{--  New Work  --}}
	<br><br>
	<a class="btn btn-success" href="{{url('/studentRegisterCheckList')}}">Registration Check List</a>
	<a class="btn btn-info"    href="{{url('/studentRegisterCheckListHtml')}}">Registration Check List Pdf</a>
	<a class="btn btn-warning" href="{{url('/compactMarksRegister')}}">Compact Students Marks List</a>
	<a class="btn btn-warning" href="{{url('/compactMarksRegisterHTML')}}">Compact Students Marks List PDF</a>
	<a class="btn btn-success" href="{{url('/compactMeritList')}}">Student Merit List</a>
	<a class="btn btn-success" href="{{url('/compactMeritListHTML')}}">Student Merit List PDF</a>

@endsection




@section('footer')
	@include('layouts.footer')
@endsection
