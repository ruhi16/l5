@extends('layouts.baselayout')
@section('title','REPORT PAGE')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
	<h1>Report's Hub ...</h1>


	<a class="btn btn-primary" href="{!! url('/studentResultPdf') !!}">All Students Result</a>
	<a class="btn btn-warning" href="{!! url('/resultTableAll') !!}">All's Result Table Page</a>
	<a class="btn btn-success" href="{!! url('/studentRegisterPdf') !!}">All Students Register</a>
	<a class="btn btn-info" href="{!! url('/studentResultIndPdf') !!}">Student's Individual Result</a>








@endsection




@section('footer')
	@include('layouts.footer')
@endsection
