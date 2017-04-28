@extends('layouts.baselayout')
@section('title','Subject Selection')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
	<h1>Subject Selection ...</h1>
<div class="form-group">
  <label for="sel1">Select list:</label>
  <select class="form-control" id="sel1">
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
  </select>
</div>	



@endsection





@section('footer')
	@include('layouts.footer')
@endsection
