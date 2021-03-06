@extends('layouts.baselayout')
@section('title','TEST PAGE')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
	<a href="{{url('test2')}}" class="btn btn-warning pull-right">Back</a>
	<h1>Individual Resutlt ....</h1>
	<br>
	<h2>Name: <b>{{$student->name}}</b><br>Registraion No: {{$student->reg}} (ClassRoll: {{$student->roll}})</h2>
	{{--  <table class="table table-bordered" id="myTable">
	<caption></caption>
	<tr>
		<th>Subject</th>
		<th>Theory Marks</th>
		<th>Project Marks</th>
		<th>Actions</th>
	</tr>

	@foreach($student->studies as $std)
		@if(isset($std->subject->subj))
			<tr id="{{$std->subject_id}}tr">
				<td>{{$std->subject->subj}} (Id: {{$std->id}})</td>
				@php $flag = false; @endphp
				@foreach($std->marks as $s)
					@php $flag = true; @endphp
					<td id="{{$s->id}}th">{{$s->thmark}}</td>
					<td id="{{$s->id}}pr">{{$s->prmark}}</td>
					<td>
			
					<button class="btn btn-primary open-modal" value="{{$std->subject_id}}-{{$s->id}}">Update</button>
			
					</td>
				@endforeach

				@if($flag == false)
					<td id="th"></td>
					<td id="pr"></td>
					<td>
			
					<button class="btn btn-warning open-modal-ins" value="{{$std->id}}">Insert</button>
			
					<!-- <a href="{{ URL::to('/individualMarksInsert')}}" class="btn btn-success">Insert</a> -->
					</td>
				@endif
			</tr>
		@endif
	@endforeach
	</table>  --}}



<table class="table table-bordered" >	
	<tr>
		<th>Subject</th>
		<th>Marks ID</th>
		<th>Theory Marks</th>
		<th>Project Marks</th>
		<th>Actions</th>
	</tr>

	@foreach($student->studies as $std)
		@if(isset($std->subject->subj))
			<tr id="{{$std->subject_id}}tr">
				<td>{{$std->subject->subj}} (Id: {{$std->id}})</td>
				@php $flag = false; @endphp
				@foreach($std->marks as $s)
					@php $flag = true; @endphp
					<td>{{$s->id}}</td>
					<td>
						<input type="text" class="form-control" id="{{$s->id}}dirsubjectth" name="dirsubth" placeholder="" value="{{$s->thmark}}">
					</td>
					<td>
						<input type="text" class="form-control" id="{{$s->id}}dirsubjectpr" name="dirsubth" placeholder="" value="{{$s->prmark}}">
					</td>
					<td>
			
					<button class="btn btn-success updt-Marks-direct" 	data-datac="{{$std->subject_id}}-{{$s->id}}">Update</button>
			
					</td>
				@endforeach

				@if($flag == false)
					<td        ></td>
					<td id="th"></td>
					<td id="pr"></td>
					<td>
			
					<button class="btn btn-warning open-modal-ins" value="{{$std->id}}">Insert</button>
			
					<!-- <a href="{{ URL::to('/individualMarksInsert')}}" class="btn btn-success">Insert</a> -->
					</td>
				@endif
			</tr>
		@endif
	@endforeach
	</table>





















<script type="text/javascript" src="{{url('bs337/js/jquery.bootstrap-grow.min.js')}}" integrity=""></script>
<script type="text/javascript">


$(document).ready(function(){
  	var v;
  	var u;
  	var subId;
  	var mrkId;
  	$('.open-modal').click(function(){ 
  		var data = $(this).val();
  		var arr = data.split('-');
  		v = arr[1]; //subject id === mark id
  		u = '{{route("updateMarks")}}';

  		subId = arr[0];
  		mrkId = arr[1];
  		//alert(arr[0]+"<=>"+arr[1]);
  		sth = $("#"+arr[0]+"tr #"+arr[1]+"th").text();
  		spr = $("#"+arr[0]+"tr #"+arr[1]+"pr").text();
  		
  		//alert(sth);
  		$('#myModal #subjectth').val(sth);
  		$('#myModal #subjectpr').val(spr);  		
  		//$('#myModal #mark_id').val(v);

  		$('#myModal').modal('show');
	});


	$('.updt-Marks').click(function(){
		var st = $('#myModal #subjectth').val();
		var sp = $('#myModal #subjectpr').val();
		//var id = $('#myModal #mark_id').val();
		var tk = '{{csrf_token()}}';

		//alert(st+sp);
		$.ajax({
	      method:'post',
	      url: u,      
	      data: {val: v, sth: st, spr: sp, _token: tk}
	    }).done(function(msg){
    		console.log("Mark id:"+msg['mrkid']+"Th:"+msg['thm']+"Pr:"+msg['prm']);
            
            $("#myTable #"+subId+"tr #"+mrkId+"th").html(msg['thm']);
            $("#myTable #"+subId+"tr #"+mrkId+"pr").html(msg['prm']);
            
    	});

	});

//================== Update Marks Direct =======================================

	$('.updt-Marks-direct').click(function(){
		var data = $(this).data('datac');		

		var tk = '{{csrf_token()}}';

		var arr = data.split('-');
  		var v = arr[1]; //subject_id, mark_id
		var thmrk = $('#'+arr[1]+'dirsubjectth').val();
		var prmrk = $('#'+arr[1]+'dirsubjectpr').val();
		//alert(data+'-'+thmr+'-'+prmr+'-'+thmrk);
		

		u = '{{route("updateMarks")}}';

		$.ajax({
			method:'post',
			url: u,
			data: {val: v, sth: thmrk, spr: prmrk, _token: tk},
			success: function(msg){
				console.log("Mark id:"+msg['mrkid']+"Th:"+msg['thm']+"Pr:"+msg['prm']);
				$.bootstrapGrowl("Th:"+msg['thm']+", Pr:"+msg['prm']+" <br>Record Updated Successfully!",{
					type: 'info', // success, error, info, warning
					delay: 2000,
				});
			},
			error: function(data){
					console.log("ajax Invoked error!!! occured"+data);
					
					$.bootstrapGrowl("Updation Error Occured!",{
			            type: 'warning', // success, error, info, warning
			            delay: 2000,
			    	});
			}
		}); //end of ajax function
		
	});
//==============================================================================
	var stdyId;
	var ur;
	$('.open-modal-ins').click(function(){
		stdyId = $(this).val();

		$('#myModal2 #subjectth').val(0);
  		$('#myModal2 #subjectpr').val(0); 
		ur = '{{route("insertMarks")}}';
		$('#myModal2').modal('show');
	});


	$('.insrt-Marks').click(function(){

		var st = $('#myModal2 #subjectth').val();
		var sp = $('#myModal2 #subjectpr').val();
		var tk = '{{csrf_token()}}';

		//alert(stdyId+ur);
		$.ajax({
	      method:'post',
	      url: ur,      
	      data: {val:stdyId, sth:st, spr:sp, _token: tk}
	    }).done(function(msg){
    		//console.log("Sub id:"+msg['subid']+"Mark id:"+msg['mrkid']+"Th:"+msg['thm']+"Pr:"+msg['prm']);
            location.reload();
            //$("#myTable #"+msg['subid']+"tr #"+msg['mrkid']+"th").html(msg['thm']);
            //$("#myTable #"+subId+"tr #"+mrkId+"pr").html(msg['prm']);
            
    	});

	});


  
});
</script>



@endsection

<!-- Modal for Edit Marks List -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
{!! Form::open(['url'=>'/updateMarks','method'=>'post','class'=>'form-inline']) !!}
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      	<div class="row">
            <div class="form-group  col-sm-2"> 
              <p class="form-control-static text-center">Subject</p>
            </div>
            <div class="form-group col-sm-2">         
               <p class="form-control-static text-center">Th Marks</p>              
            </div> 
            <div class="form-group col-sm-offset-2 col-sm-2">         
               <p class="form-control-static text-Bold">Practical</p>
            </div> 
        </div>

      	<div class="row">
            <div class="form-group  col-sm-2"> 
              <p class="form-control-static text-right" id="subject">Bengali</p>
            </div>              
            <div class="form-group col-sm-2">         
              <input type="text" class="form-control" id="subjectth" name="subth" placeholder="">
            </div> 
            <div class="form-group col-sm-offset-2 col-sm-2">         
              <input type="text" class="form-control" id="subjectpr" name="subpr" placeholder="">
            </div> 
        </div>        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary updt-Marks" data-dismiss="modal" value="xx">Update Marks</button>

      </div>
      
    </div>
  </div>
{!! Form::close() !!}
</div>
<!-- end of Modal Update Marks -->


<!-- Modal for Insert Marks List -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
{!! Form::open(['url'=>'/insertMarks','method'=>'post','class'=>'form-inline']) !!}
  <div class="modal-dialog" role="document">
    <div class="modal-content">    

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      	<div class="row">
            <div class="form-group  col-sm-2"> 
              <p class="form-control-static text-center">Subject</p>
            </div>
            <div class="form-group col-sm-2">         
               <p class="form-control-static text-center">Th Marks</p>              
            </div> 
            <div class="form-group col-sm-offset-2 col-sm-2">         
               <p class="form-control-static text-Bold">Practical</p>
            </div> 
        </div>

      	<div class="row">
            <div class="form-group  col-sm-2"> 
              <p class="form-control-static text-right" id="subject">Bengali</p>
            </div>              
            <div class="form-group col-sm-2">         
              <input type="text" class="form-control" id="subjectth" name="subth" placeholder="">
            </div> 
            <div class="form-group col-sm-offset-2 col-sm-2">         
              <input type="text" class="form-control" id="subjectpr" name="subpr" placeholder="">
            </div> 
        </div>        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary insrt-Marks" data-dismiss="modal">Insert Marks</button>

      </div>
      
    </div>
  </div>
{!! Form::close() !!}
</div>
<!-- end of Modal Update Marks -->



@section('footer')
	@include('layouts.footer')
@endsection
