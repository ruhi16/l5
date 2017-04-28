@extends('layouts.baselayout')
@section('title','TEST PAGE')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
	<h1>TEST PAGE ...</h1>
	{!! Form::open(['url'=>'/selectSubject','method'=>'get']) !!}
	<div class="row">
		<div class="form-group">
    		<label class="col-sm-2 text-right" for="cls">Class:</label>
    		<div class="col-sm-3">
    			<select class="form-control" name="cls">
    				<option> </option>
    				@foreach($clss as $cls)
                        <option value="{{$cls->id}}">{{$cls->cls}}</option>                  
                    @endforeach
    			</select>
    		</div>

    		<label class="col-sm-1 text-right" for="cls">Subject:</label>
    		<div class="col-sm-3">
    			<select class="form-control" name="sub">
                    <option value="0"></option>
                    @foreach($subjs as $sub)
    				    <option value="{{$sub->subj}}">{{$sub->subj}}</option>    				
                    @endforeach
    			</select>
    		</div>

    		<div class="col-sm-2">
    			<input type="submit" class="form-control btn btn-success" id="" value="Submit">
    		</div>
  		</div>
	</div>
	{!! Form::close() !!}

	<br>
	<hr>
	<br>
	


	


@endsection





@section('footer')
	@include('layouts.footer')
@endsection
