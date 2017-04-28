@extends('layouts.baselayout')
@section('title','Subjects Details')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
<h1>Subjects Details</h1>
@if(session()->has('error'))
	<div class="alert alert-success">
		<strong>Message! {{session()->get('error')}} </strong>		
	</div>
@endif




<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Subject Details
    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModalAddSubject">  Add New</button>
    <div class="clearfix"></div>  
  </div>

    <table class="table table-bordered" id="subject">
    <thead>
      <tr>
        <th>ID</th>
        <th>Subject Name</th>
        <th>Action</th>
      </tr>
    </thead>
      <tbody>
      @foreach($allSubj as $subject)
        <tr>
          <td>{{$subject->id}}</td>
          <td id="{{$subject->id}}">{{$subject->subj}}</td>
          <td>
            <button class="btn btn-primary open-modal" value="{{$subject->id}}">Edit</button> 
            <a href="" class="btn btn-success">Delete</a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
</div>
<!-- Modal for Add New Subject -->
<div class="modal fade" id="myModalAddSubject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    {!! Form::open(['url'=>'/addSubject','method'=>'get','class'=>'form-horizontal']) !!}
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        


      <div class="form-group">
        <label class="control-label col-sm-2" for="newsub">Subject:</label>
        <div class="col-sm-3">
          <input type="text" class="form-control" id="newsub" name="newsub" placeholder="Subject Name">
        </div>

        <label class="control-label col-sm-2" for="fc">for Class:</label>
        <!-- <div class="col-sm-3">
          <input type="text" class="form-control" id="forcls" name="forcls" placeholder="for Class">
        </div> -->
        <div class="col-sm-3">
          <select class="form-control" name="forcls" id="fc">
              <option value="0">                          </option>
            @foreach($allClss as $cls)              
              <option value="{{$cls->id}}-{{$cls->cls}}">{{$cls->cls}}</option>              
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-3" for="fmTh">Full Mark Theory:</label>
        <div class="col-sm-2">
          <input type="text" class="form-control" id="fmTh" name="fmTh" placeholder="Subject Name">
        </div>      

        <label class="control-label col-sm-3" for="fmPr">Full Mark Project:</label>
        <div class="col-sm-2">
          <input type="text" class="form-control" id="fmPr" name="fmPr" placeholder="Subject Name">
        </div>   
      </div>

      <div class="form-group">
        <label class="control-label col-sm-3" for="pmTh">Pass Mark Theory:</label>
        <div class="col-sm-2">
          <input type="text" class="form-control" id="pmTh" name="pmTh" placeholder="Subject Name">
        </div>      

        <label class="control-label col-sm-3" for="pmPr">Pass Mark Project:</label>
        <div class="col-sm-2">
          <input type="text" class="form-control" id="pmPr" name="pmPr" placeholder="Subject Name">
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


<!-- Modal for Edit Subject List -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    {!! Form::open(['url'=>'/xyz','method'=>'post','class'=>'form-inline']) !!}

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <div class="form-group"> 
          <p class="form-control-static">Subject Name:</p>
        </div>

        <div class="form-group">         
          <input type="text" class="form-control" id="editsub" name="editsub" placeholder="Edit Subject Name">
        </div>  

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary edit-sub" data-dismiss="modal">Add New Subject</button>

      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>




<script type="text/javascript">  
  $(document).ready(function(){});

  var v;
  var u;
  $('.open-modal').click(function(){ 
    v = $(this).val();   
    u = '{{route("xyz")}}'; 
    //alert(v);
    var osub = $("#subject #"+$(this).val()).text();
    
    $("#editsub").val(osub);
    $('#myModal').modal('show');
    }); 



  $('.edit-sub').click(function(){

    var s = $("#editsub").val();    
    var t = '{{csrf_token()}}';
    

    $.ajax({
      method:'post',
      url: u,      
      data: {val: v, sub: s, _token: t}
    }).done(function(msg){
            
            console.log('new Subject:'+msg['newsub'] + "/ new Subject Id: "+ msg['newsubid']+"/ old Subject:"+msg['oldsub']);
            
            $("#subject td:contains('"+msg['oldsub']+"')").html(msg['newsub']);
            //$("#subject #"+msg['newsubid']).html(msg['newsub']);
    });


    

  });

</script>

@endsection



@section('footer')
	@include('layouts.footer')
@endsection