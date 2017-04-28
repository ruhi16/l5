<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	@include('layouts.supports')
</head>
<body>


<div class="container-fluid">
@section('header')

	<!-- <header>This is Base-header Section</header> -->
@show
</div>
@section('main')
	<div class="container">
		@yield('content')
	</div>
@show

@section('footer')
	<div class="container">
		<footer>This is base-footer Section</footer>
	</div>
@show
</body>