@extends('layouts.baselayout')
@section('title','REPORT PAGE')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
	<h1>Compact Merit List</h1>



    @foreach($students as $student)

        {{ $student }}<br>

    @endforeach




@endsection

@section('footer')
	@include('layouts.footer')
@endsection
