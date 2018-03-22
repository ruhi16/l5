@extends('layouts.baselayout')
@section('title','Students Details')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
<h1>Students Details</h1>
@if(session()->has('error'))
	<div class="alert alert-success">
		<strong>Message! {{session()->get('error')}} </strong>		
	</div>
@endif

<!-- Table -->
	<table class="table table-bordered" id="tbl">
		<thead>
			<tr>
				<th>Roll</th>
        <th>Name</th>
        <th>Class</th>
        <th>Reg. No</th>
        <th>Lang 1</th>
        <th>Lang 2</th>
        <th>Elec 1</th>
        <th>Elec 2</th>
        <th>Elec 3</th>
        <th>Opt 1</th>        
        <th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach($allStud as $stud)
	    	<tr id="tr{{$stud->id}}">
	          <td id="td{{$stud->id}}roll">{{$stud->roll}}</td>
            <td id="td{{$stud->id}}name">{{$stud->name}}</td>
            <td id="td{{$stud->id}}clss">{{$stud->roll}}</td>
            <td id="td{{$stud->id}}reg" >{{$stud->reg}} </td>
            <?php $i=1;?>
        		@foreach($stud->studies as $sub)        			
                <td id="{{$i++}}td{{$stud->id}}">{{$sub->subject->subj or ''}}</td>	
        		@endforeach          
	          <td>
	          	<button class="btn btn-primary open-modal" value="{{$stud->id}}">Edit</button>            
	          </td>
	        </tr>
	    @endforeach
		</tbody>
	</table>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    {!! Form::open(['url'=>'/updateSubject','method'=>'get']) !!}
  
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Students Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
            
      <div class="form-group">
        <label class="control-label col-sm-1" for="name">Name:</label>
        <div class="col-sm-7">
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter Students Name">
        </div>

        <label class="control-label col-sm-1" for="clss">Class:</label>
        <div class="col-sm-2">
          <select class="form-control" name="clss" id="cl">
              <option value="0">                          </option>
            @foreach($allClss as $cls)              
              <option value="{{$cls->id}}">{{$cls->cls}}</option>              
            @endforeach
          </select>
        </div>
      </div>
<br><br>
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
<hr>
      
      <label><u> Subject Details</u> </label>
        <br><br>
      <div class="row">
      <div class="col-md-3">
      
        <div class="form-group">
        <input type="hidden" name="tsub1">
          <select class="form-control" name="sub1" id="sel1">
            <option value="0">                          </option>
            @foreach($allSubj as $sub)
              @if($sub->id == 1 or $sub->id == 2)
              <option value="{{$sub->id}}" >
                {{$sub->subj}}
              </option>
              @endif
            @endforeach
          </select>
        </div>

      </div>

      <div class="col-md-3">
      
        <div class="form-group">
        <input type="hidden" name="tsub2">
          <select class="form-control" name="sub2" id="sel2">
            <option value="0">                          </option>
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
      </div>

      <div class="row">
      <div class="col-md-3">
      
        <div class="form-group">
        <input type="hidden" name="tsub3">
          <select class="form-control" name="sub3" id="sel3">
            <option value="0">                          </option>
            @foreach($allSubj as $sub)
              @if($sub->id != 1 and $sub->id !=2)
              <option value="{{$sub->id}}">{{$sub->subj}}</option>
              @endif
            @endforeach
          </select>
        </div>

      </div>

      <div class="col-md-3">
      
        <div class="form-group">
        <input type="hidden" name="tsub4">
          <select class="form-control" name="sub4" id="sel4">
            <option value="0">                          </option>
            @foreach($allSubj as $sub)
              @if($sub->id != 1 and $sub->id !=2)
              <option value="{{$sub->id}}">{{$sub->subj}}</option>
              @endif
            @endforeach
          </select>
        </div>

      </div>
      <div class="col-md-3">
      
        <div class="form-group">
        <input type="hidden" name="tsub5">
          <select class="form-control" name="sub5" id="sel5">
            <option value="0">                          </option>
            @foreach($allSubj as $sub)
              @if($sub->id != 1 and $sub->id !=2)
              <option value="{{$sub->id}}">{{$sub->subj}}</option>
              @endif
            @endforeach
          </select>
        </div>

      </div>

      <div class="col-md-3">
      
        <div class="form-group">
        <input type="hidden" name="tsub6">
          <select class="form-control" name="sub6" id="sel6">
            <option value="0">                          </option>
            @foreach($allSubj as $sub)
              @if($sub->id != 1 and $sub->id !=2)
              <option value="{{$sub->id}}">{{$sub->subj}}</option>
              @endif
            @endforeach
          </select>
        </div>

      </div>
      </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update Student's Info</button>
      </div>
      {!! Form::close() !!}

    </div>
  </div>
</div>




<script type="text/javascript"> 
 var sb2, sb2, sb3, sb4, sb5, sb6;
  $(document).ready(function(){

  var v;
  
  $('.open-modal').click(function(){ 
    v = $(this).val(); 
    //alert(v);
    rl = $("#tbl #tr"+v+" #td"+v+"roll").text();
    nm = $("#tbl #tr"+v+" #td"+v+"name").text();
    cl = $("#tbl #tr"+v+" #td"+v+"clss").text();
    rg = $("#tbl #tr"+v+" #td"+v+"reg").text();
    //alert(rl+nm);


    sb1 = $("#tbl #tr"+v+" #1td"+v).text();
    sb2 = $("#tbl #tr"+v+" #2td"+v).text();
    sb3 = $("#tbl #tr"+v+" #3td"+v).text();
    sb4 = $("#tbl #tr"+v+" #4td"+v).text();
    sb5 = $("#tbl #tr"+v+" #5td"+v).text();
    sb6 = $("#tbl #tr"+v+" #6td"+v).text();
    var arr1 = sb1.split('-') ;
    var arr2 = sb2.split('-') ;
    var arr3 = sb3.split('-') ;
    var arr4 = sb4.split('-') ;
    var arr5 = sb5.split('-') ;
    var arr6 = sb6.split('-') ;
  //alert(sb1+sb2+sb3+sb4+sb5+sb6);
  //alert(arr1[1]);
  $('input[name="name"]').val(nm);  
  $('select[name="clss"]').find('option:contains('+cl+')').prop("selected",true);
	$('input[name="reg"]').val(rg);
  $('input[name="roll"]').val(rl);



  $('input[name="tsub1"]').val(arr1[0]);  
  $('input[name="tsub2"]').val(arr2[0]);  
  $('input[name="tsub3"]').val(arr3[0]);  
  $('input[name="tsub4"]').val(arr4[0]);  
  $('input[name="tsub5"]').val(arr5[0]);  
  $('input[name="tsub6"]').val(arr6[0]);  


  $('select[name="sub1"]').find('option:contains('+arr1[1]+')').prop("selected",true);
  $('select[name="sub2"]').find('option:contains('+arr2[1]+')').prop("selected",true);
	$('select[name="sub3"]').find('option:contains('+arr3[1]+')').prop("selected",true);
	$('select[name="sub4"]').find('option:contains('+arr4[1]+')').prop("selected",true);
	$('select[name="sub5"]').find('option:contains('+arr5[1]+')').prop("selected",true);
  if(arr6[1] != ''){
      $('select[name="sub6"]').find('option:contains('+arr6[1]+')').prop("selected",true);
	}else{
      $('select[name="sub6"]').prop("selectedIndex", 0);
  }






    $('#myModal').modal('show');
    }); 
});
</script>

@endsection

@section('footer')
	@include('layouts.footer')
@endsection