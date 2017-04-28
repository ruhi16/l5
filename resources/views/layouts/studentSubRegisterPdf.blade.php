@extends('layouts.baselayout')
@section('title','Subject Register')

@section('header')
	
@endsection



@section('content')

<center>
			<h1><b>Manikchak High Madrasah(H.S.)</b></h1>
			<h5>Lalgola * Murshidabad</h5>
			<h4><b>Manual Marks Entry Sheet</b><br>for <b>Class XI Annual Exam-2017 Subject: <u>{{$sub}}</u></b></h4>
</center>

<br>
<table border="1" width="100%" class="" style="font-size:12px;">
	<thead>
		<tr>
			<th>Sl No</th>
			<th>Roll</th>
			<th>Name</th>
			<th>Registration No</th>
			<th>Theory</th>
			<th>Project</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>		
			@foreach($shreny as $shrn)	
				@foreach($shrn->subjects as $subject)
					@if($subject->subj == $sub)
					@php $i = 0 @endphp
					@foreach($subject->studies as $study)
					<tr>
						<td>{{++$i}}</td>
						<td></td>
						<td>{{$study->student->name}}</td>
						<td>{{$study->student->reg}}</td>
						<td></td>
						<td></td>
						<td></td>						
					</tr>
					@endforeach
					@endif
				@endforeach				
			@endforeach
		
	</tbody>
</table>


<script type="text/php">
    if (isset($pdf)) {
        $x = 250;
        $y = 10;
        $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
        $font = null;
        $size = 14;
        $color = array(255,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script>








@endsection

@section('footer')
		
@endsection
