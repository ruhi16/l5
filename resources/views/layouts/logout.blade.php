@extends('layouts.baselayout')
@section('title','Home Page')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
<h1>LogOut</h1>
@if(session()->has('error') OR session()->has('user'))
	<!-- <div class="alert alert-success">
		<strong>Message! {{session()->get('error')}}</strong>
		{{session()->forget('error')}}
		{{session()->forget('user')}}
	</div> -->
	{{session()->put('error')}}
	{{session()->put('user')}}
	<div class="top-right links">
        <a href="{{ url('/logout') }}">Log Out</a>        
    </div>
@endif
@endsection


@section('footer')
	@include('layouts.footer')
@endsection
