@extends('layouts.baselayout')
@section('title','REPORT PAGE')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
	<h1>Result Table ...</h1>
	<table class="table table-bordered">
		<tr>
			<th>Sl</th>
			<th>Name</th>
			<th>Registraion No</th>
			<th>Class Roll No</th>
			<th>Action</th>
		</tr>
		<?php $sl = ($students->currentPage() * 10) - 9; ?>
		@foreach($students as $student)
		<tr>
			<td>{{$sl++}}</td>
			<td>{{$student->name}}</td>
			<td>{{$student->reg}}</td>
			<td>{{$student->roll}}</td>
			<td>
				<button class="btn btn-primary btn-sm btnGr" data-datac="{{$student->id}}">Get Result</button>

					<a  class="btn btn-info btn-sm dw{{$student->id}} dwn" href="http://localhost/l5/public/{{$student->reg}}.pdf" download>Download</a>

			</td>
		</tr>
		@endforeach

	</table>

	<!-- Pagination Starts -->


	<!-- Pagination Ends -->



<div class='pagination'>
	{{ $students->links() }}
	<p align='left'>{{ $students->total() }} students exists.</p>
</div>
	<!-- {{ $students->appends(Request::except('page'))->links() }}  -->













	<script type="text/javascript" src="{{url('bs337/js/jquery.bootstrap-grow.min.js')}}" integrity=""></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('a.dwn').each(function(index) {
    		$(this).hide();
			});



				$('.btnGr').click(function(){
					var x = $(this).data('datac');
					//alert(x);



					var u = '{{url("/downloadResult")}}';
					var t = '{{csrf_token()}}';

					var d = $(this).data('datac');
					$("#dwnld").find(".dw"+x).addClass("active");
					$('a.foo.bar[rel="123"]')
					$.ajax({
						method: 'post',
						url: u,
						data: {sid: d, _token: t},
						success: function(msg){
								console.log("ajax Invoked!"+msg['id']+", name:"+msg['name']);
								$.bootstrapGrowl(msg['name']+"'s Result in Pdf, Downloaded Successfully!",{
										type: 'success', // success, error, info, warning
										delay: 3000,
								});

								$('a.dw'+x).show();
						},
						error: function(data){

								$.bootstrapGrowl("Marks are not Updated at All!",{
										type: 'danger', // success, error, info, warning
										delay: 3000,
								});
								console.log("ajax Invoked error!!! occured"+data);
						}
					}); //end of ajax function




				});
		});

	</script>
@endsection

@section('footer')
	@include('layouts.footer')
@endsection
