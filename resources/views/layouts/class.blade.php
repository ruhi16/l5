@extends('layouts.baselayout')
@section('title','Class Details')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
<h1>Classes</h1>
  <div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Class Details
      <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModalAddSubject">  Add New</button>
      <div class="clearfix"></div>  
    </div>
            <table class="table table-bordered">
              <thead>
              <tr>
                <th>Sl No</th>
                <th>Name of Classes</th>
              </tr>
              </thead>
              <tbody>
                @foreach($classes as $clss)
                  <tr>
                    <td>{{$clss->id}}</td>
                    <td>{{$clss->cls}}</td>
                  </tr>
                @endforeach
              
            </tbody>
            </table>
  </div>


<!-- Modal for Add New Subject -->
<div class="modal fade" id="myModalAddSubject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
    {!! Form::open(['url'=>'/addClass','method'=>'get','class'=>'form-inline']) !!}
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

      <div class="form-group">
        <label class="control-label col-sm-offset-2 col-sm-3" for="clss">New Class:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" id="clss" name="clss" placeholder="Enter New Class">
        </div>

      </div>





      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Add New Subject</button>

      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>




@endsection


@section('footer')
	@include('layouts.footer')
@endsection

