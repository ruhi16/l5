@extends('layouts.baselayout')
@section('title','Dashboard')

@section('header')
	@include('layouts.navbar')
@endsection



@section('content')

<!-- {!! Form::open(['url'=>'/rollUpdate','method'=>'post']) !!} -->
<table class="table table-bordered" id="studs">
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Reg No</th>
			<th>Roll</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@php $i=0; @endphp
		@foreach($students as $student)
		<tr id="{{$student->id}}">
			<td><input type="hidden" name="id[]" value="{{$student->id}}">{{++$i}}</td>
			<td id="name">{{$student->name}}</td>
			<td id="regn">{{$student->reg}}</td>
			<td id="roll"><input type="text" class="form-control" id="rollno" name="roll[]" value="{{$student->roll}}"></td>
			<td><button class="btn btn-success" data-datac="{{$student->id}}">Update</button></td>
		</tr>
		@endforeach
	</tbody>
</table>

		<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
    <!-- <button type="submit" class="btn btn-primary">Update All Students Roll Nos</button> -->
<!-- {!! Form::close() !!} -->
<script type="text/javascript" src="{{url('bs337/js/jquery.bootstrap-grow.min.js')}}" integrity=""></script>
<script type="text/javascript">
$(document).ready(function(){
	var nm;
	$('.btn').click(function() {
		var d = $(this).data('datac'); //collect the students table's id field no from 'data-datac' property

		nm = $('#studs #'+d+' #name').text();
		rg = $('#studs #'+d+' #regn').text();
		rl = $('#studs #'+d+' #roll #rollno').val();

		//alert("id:"+d+", name:"+nm+", reg:"+rg+", roll:"+rl);
		var u = '{{url("/updateRoll")}}';
		var t = '{{csrf_token()}}';


		// $.bootstrapGrowl('Record Updated Successfully!',{
    //         type: 'info', // success, error, info, warning
    //         delay: 1000,
    //     });


		$.ajax({
			method: 'post',
			url: u,
			data: {sid: d, name: nm, regn: rg, roll:rl, _token: t},
			success: function(msg){
					console.log("ajax Invoked!"+msg['id']+", name:"+msg['name']);
					$.bootstrapGrowl(msg['name']+"'s Record Updated Successfully!",{
			            type: 'info', // success, error, info, warning
			            delay: 1000,
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

	}); //end of btn clicked function
}); // end of document ready function

</script>
@endsection


@section('footer')
	@include('layouts.footer')
@endsection
