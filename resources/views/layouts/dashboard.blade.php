@extends('layouts.baselayout')
@section('title','Dashboard')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
<h1>Dashboard</h1>
@if(session()->has('error'))
	<div class="alert alert-success">
		<strong>Message! {{session()->get('error')}}</strong>
		{{session()->forget('error')}}
	</div>
@endif


<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">
    Panel heading
    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal1">
  Add New Student
</button>
    <div class="clearfix"></div>  
  </div>

  <!-- Table -->
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Roll</th>
        <th>Subject Name</th>
        <th>Class</th>
        <th>Registration No</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>      
      @foreach($allStud as $stu)
        <tr>
          <td>{{$stu->roll}}</td>
          <td>{{$stu->name}}</td>
          <td>{{$allClss->find($stu->shreny_id)->first()->cls}}</td>
          <td>{{$stu->reg}}</td>
          <td>   
            <a href="{!! url('/editStudent',[$stu->id]) !!}" class="btn btn-primary">Edit</a>
            <a href="" class="btn btn-success">Update</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

</div>













<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    {!! Form::open(['url'=>'/addStudent','method'=>'get', 'class'=>'form-horizontal']) !!}
  
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Students Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      @foreach($errors->all() as $error)
        {{$error}}
      @endforeach


      <div class="form-group">
        <label class="control-label col-sm-1" for="name">Name:</label>
        <div class="col-sm-7">
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Students Name">
        </div>

        <label class="control-label col-sm-1" for="clss">Class:</label>
        <div class="col-sm-2">
      <select class="form-control" name="clss" id="cl">
              <option value="0"></option>
            @foreach($allClss as $cls)              
              <option value="{{$cls->id}}">{{$cls->cls}}</option>              
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-2" for="reg">Registration No:</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="reg" name="reg" placeholder="Enter Students Registraion No">
        </div>

        <label class="control-label col-sm-1" for="roll">Roll:</label>
        <div class="col-sm-2">
          <input type="text" class="form-control" id="roll" name="roll" placeholder="Enter Roll">
        </div>
      </div>

      
      <br>
      





      <br>
      <label><u> Subject Details</u> </label>
      <div class="container">
      <div class="row">


      
        <div class="form-group">
          <label class="control-label col-sm-1" for="sub1">Lang. 1:</label>
          <div class="col-md-2">
          <select class="form-control sub" name="sub1" id="sel1">
            <option value="0"></option>
            @foreach($allSubj as $sub)
              @if($sub->id == 1 or $sub->id == 2)
              <option value="{{$sub->id}}" @if($sub->id == 1) selected @endif {{ old('sub1') === $sub->id ? 'selected' : '' }}>
                {{$sub->subj}}
              </option>
              @endif
            @endforeach
          </select>
        </div>
      
        <label class="control-label col-sm-1" for="sub2">Lang. 2:</label>
        <div class="col-md-2">
          <select class="form-control sub" name="sub2" id="sel2">
            <option value="0"></option>
            @foreach($allSubj as $sub)
              @if($sub->id == 1 or $sub->id ==2)
              <option value="{{$sub->id}}" @if($sub->id == 2) selected @endif>
                {{$sub->subj}}
              </option>
              @endif
            @endforeach
          </select>
        </div>
        </div>

      </div><!-- end of 1st Row -->

      <div class="row">

      <div class="form-group">
        <label class="control-label col-sm-1" for="sub3">Elect. 1:</label>
        <div class="col-md-2">
          <select class="form-control sub" name="sub3" id="sel3">
            <option value="0"></option>
            @foreach($allSubj as $sub)
              @if($sub->id != 1 and $sub->id !=2)
              <option value="{{$sub->id}}">{{$sub->subj}}</option>
              @endif
            @endforeach
          </select>
        </div>
      

      
      
        <label class="control-label col-sm-1" for="sub4">Elect. 2:</label>
        <div class="col-md-2">
          <select class="form-control sub" name="sub4" id="sel4">
            <option value="0"></option>
            @foreach($allSubj as $sub)
              @if($sub->id != 1 and $sub->id !=2)
              <option value="{{$sub->id}}">{{$sub->subj}}</option>
              @endif
            @endforeach
          </select>
        </div>
      

      
      
        <label class="control-label col-sm-1" for="sub5">Elect. 3:</label>
        <div class="col-md-2">
          <select class="form-control sub" name="sub5" id="sel5">
            <option value="0"></option>
            @foreach($allSubj as $sub)
              @if($sub->id != 1 and $sub->id !=2)
              <option value="{{$sub->id}}">{{$sub->subj}}</option>
              @endif
            @endforeach
          </select>
        </div>      
      </div><!-- end of from group -->


      <div class="form-group">
        <label class="control-label col-sm-1" for="sub6">Opt. 1:</label>
        <div class="col-md-2">
          <select class="form-control sub" name="sub6" id="sel6">
            <option value="0"></option>
            @foreach($allSubj as $sub)
              @if($sub->id != 1 and $sub->id !=2)

              <option value="{{$sub->id}}">{{$sub->subj}}</option>
              @endif
            @endforeach
          </select>
        </div>
      </div><!-- end of from group -->

      </div><!-- end of 2nd Row -->

      </div><!-- end of Container -->


        <!-- <div class="form-group"> 
          <p class="form-control-static">Student Name:</p>
        </div>
        <div class="form-group">         
          <input type="text" class="form-control" id="newstd" name="newstd" placeholder="New Subject Name">
        </div>  -->
      

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add New Student</button>
      </div>


      {!! Form::close() !!}

    </div><!-- end of Modal Body -->
  </div> <!-- end of Modal Content -->
</div> <!-- end of Modal Dialog -->







<br>
<br>
<br>
<script type="text/javascript">
$(document).ready(function(){
var cSel, count;
$("select").on('change', function(){  
  cSel = this.value;
  count = 0;
    $(".sub").each(function(){
    
        if(cSel == this.value){
          count++;              
        }
        
    });
    if(count >1){
          alert("Matched");
    }
});
   
});
</script>




<script type="text/javascript">
@if (count($errors) > 0)
    $('#myModal1').modal('show');
@endif
</script>




@endsection


@section('footer')
	@include('layouts.footer')
@endsection
