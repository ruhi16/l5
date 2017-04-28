@extends('layouts.baselayout')
@section('title','TEST PAGE')

@section('header')
	
@endsection

@section('content')
	<h1>Consolidated Students Marks Register ...</h1>
	
<table class="table table-bordered" id="result" style="font-size:10px;">
<thead>
<tr><th>Name</th>
	<th colspan="4" class="text-center">Language - I</th>
  	<th colspan="4" class="text-center">Language - I</th>
	<th colspan="4" class="text-center">Elective - I</th>
	<th colspan="4" class="text-center">Elective - II</th>
	<th colspan="4" class="text-center">Elective - III</th>
	<th colspan="4" class="text-center">Optional - I</th>
	<th class="text-center">			Total</th>
	<th class="text-center">			Remarks</th>
</tr>
</thead>

<tbody>
@foreach($students as $student)	
	<?php $index = 0; $total = 0; ?>
  
	<tr id="{{$student->id}}tr">
		<td>{{$student->name}}</td>
			
			@foreach($student->studies as $study)

				<td id="{{$student->id}}sub{{$index}}">{{$study->subject->subj or ''}}</td>
				

				@forelse($study->marks as $mark)
					<td id="{{$student->id}}sub{{$index}}th">{{(int)$mark->thmark}}</td>
          <td id="{{$student->id}}sub{{$index}}pr">{{(int)$mark->prmark}}</td>
          <td id="{{$student->id}}sub{{$index}}to">{{($mark->thmark+$mark->prmark)}}</td>
          <?php $total = $total + ($mark->thmark+$mark->prmark); ?>
        @empty
          <td></td><td></td><td></td>
					
				@endforelse
				
				
				<?php $index++; ?>
				
				
			@endforeach	

			
			@for($i=0; $i<(6-$index); $i++)
				<td>NA</td>
		        <td></td>
		        <td></td>
		        <td></td>
			@endfor
			<td><b>{{$total}}</b></td></td>
			<td></td>
			
	</tr>
	



@endforeach
</tbody>
</table>

@endsection



@section('footer')
	
@endsection
