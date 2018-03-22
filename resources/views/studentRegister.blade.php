@extends('layouts.baselayout')
@section('title','REPORT PAGE')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
	<h1>Student Registration No Master Role</h1>
	<table class="table table-bordered">
	<thead>
		<tr>
			<th>SL</th>
			<th>Name</th>
			<th>Class Roll No</th>
			<th>Father Name</th>
			<th>Subjects Tacken</th>
			<th>Registraion No</th>
			<th>Admit Roll-NO</th>
			<th>Signature for Reg Cert</th>
			<th>Signature for Admit Card</th>
			<th>Signature for Mark Sheet & Cert</th>
			
		</tr>
	</thead>
	<tbody>		
		@foreach($stds as $st)
			<tr>
				<td>{{$st->id}}</td>
				<td>{{$st->name}}</td>
				<td></td>
				<td></td>
				<td>
					@foreach($st->studies as $s)
						<!-- {{ $s->subject_id }} -->
						{{ 
							$subjs->where('id',$s->subject_id)
							->pluck('shsubj')->first()
						}},
					@endforeach
				</td>
				<td>{{$st->reg}}</td>
				<td>{{$st->roll}}</td>				
				<td></td>
				<td></td>
				<td></td>
			</tr>
		@endforeach
		
	</tbody>
	</table>
@endsection




@section('footer')
	@include('layouts.footer')
@endsection
