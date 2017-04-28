@extends('layouts.baselayout')
@section('title','REPORT PAGE')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
	<h1>Report's Hub ...</h1>


	<a class="btn btn-primary" href="{!! url('/studentResultPdf') !!}">All Students Result</a>
	<a class="btn btn-success" href="{!! url('/studentRegisterPdf') !!}">All Students Register</a>








@endsection




@section('footer')
	@include('layouts.footer')
@endsection