@extends('layouts.baselayout')
@section('title','TEST PAGE')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')	
	<h2>Marks Entry for Class: {{$clss}} and Subject:<em> {{$subj}}</em></h2>
	
<!-- <table class="table table-bordered" id="marks">
<thead>
	<tr>
		<th>Sl No</th>
		<th>Name</th>
		<th>Reg. No</th>
		<th>Th Marks</th>
		<th>Pr Marks</th>
		<th>Total</th>
		<th>Action</th>
	</tr>
</thead>
@foreach($clsses->subjects as $subject)
	@if($subject->subj == $subj)		
		@foreach($subject->studies as $study)
		<tbody>
			<tr id="{{$study->student->reg}}">
				<td id="stid"><input type="hidden" name="stid" id="sid" value="{{$study->id}}">{{$study->id}}</td>
				<td id="name">{{$study->student->name}}</td>
				<td id="regi">{{$study->student->reg}}</td>
				<td id="thmr"><input type="text" class="form-control input-sm" name="thmr" id="thm" value="{{$study->marks[0]->thmark or ''}}"></td>
				<td id="prmr"><input type="text" class="form-control" name="prmr" id="prm" value="{{$study->marks[0]->prmark or ''}}"></td>
				<td></td>
				<td id="action">
				@if(isset($study->marks[0]->thmark))
					<button class="btn btn-success" data-datac="{{$study->student->reg}}">Update</button>
				@else
					<button class="btn btn-primary" data-datac="{{$study->student->reg}}">Save</button>
				
				@endif
				</td>
			</tr>
		</tbody>
		@endforeach
		
	@endif
@endforeach
</table> -->


<h3>Total Students: {{$test->total()}}</h3>
<h6>This Page Contain Students, from <b>{{($test->currentPage()-1)*20+1}}</b> to <b>{{($test->currentPage()-1)*20+$test->count()}}</b> </h6>

<table class="table table-bordered" id="marks">
<thead>
	<tr>
		<th>Sl No</th>
		<th>Name</th>
		<th>Reg. No</th>
		<th>Th Marks</th>
		<th>Pr Marks</th>
		<th>Total</th>
		<th>Action</th>
	</tr>
</thead>
<?php $i = ($test->currentPage()-1)*20;?>
@foreach($test as $t)
	<tbody>
	<tr id="{{$t->reg}}">
		<td id="stid" class="text-center"><input type="hidden" name="stid" id="sid" value="{{$t->sid}}">{{++$i}}</td>
		<td>{{$t->name}}</td>
		<td>{{$t->reg}}</td>
		<td id="thmr"><input type="text" class="form-control input-sm" name="thmr" id="thm" value="{{$t->thmark or ''}}"></td>
		<td id="prmr"><input type="text" class="form-control input-sm" name="prmr" id="prm" value="{{$t->prmark or ''}}"></td>
		<td></td>
		<td id="action">
			@if(isset($t->thmark))
				<button class="btn btn-success" data-datac="{{$t->reg}}">Update</button>
			@else
				<button class="btn btn-primary" data-datac="{{$t->reg}}">Save</button>
			
			@endif
		</td>		
	</tr>
	</tbody>	
@endforeach
</table>







<?php
// config
$link_limit = 9; // maximum number of links (a little bit inaccurate, but will be ok for now)
?>
@if ($test->lastPage() > 1)
    <ul class="pagination">
    	<!-- if the current page is 1, first page -->
        <li class="{{ ($test->currentPage() == 1) ? ' disabled' : '' }}">
        <?php   $x = $test->url(1); $a = explode('?', $x); $y = $a[0].'?cls='.$clss.'&sub='.$subj.'&'.$a[1]; //echo $y;  ?>
            <a href="{{ $y }}">First</a>
         </li>
         <!--  -->
        @for ($i = 1; $i <= $test->lastPage(); $i++)
            <?php
            $half_total_links = floor($link_limit / 2);
            $from = $test->currentPage() - $half_total_links;
            $to   = $test->currentPage() + $half_total_links;
            if ($test->currentPage() < $half_total_links) {
               $to += $half_total_links - $test->currentPage();
            }
            if ($test->lastPage() - $test->currentPage() < $half_total_links) {
                $from -= $half_total_links - ($test->lastPage() - $test->currentPage()) - 1;
            }
            ?>
            @if ($from < $i && $i < $to)
                <li class="{{ ($test->currentPage() == $i) ? ' active' : '' }}">
                <?php   $x = $test->url($i); $a = explode('?', $x); $y = $a[0].'?cls='.$clss.'&sub='.$subj.'&'.$a[1]; //echo $y;  ?>
                    <a href="{{ $y }}">{{ $i }}</a>
                </li>
            @endif
        @endfor
        <!-- if the current page is 1, first page -->
        <li class="{{ ($test->currentPage() == $test->lastPage()) ? ' disabled' : '' }}">
        <?php   $x = $test->url($test->lastPage()); $a = explode('?', $x); $y = $a[0].'?cls='.$clss.'&sub='.$subj.'&'.$a[1]; //echo $y;  ?>
            <a href="{{ $y }}">Last</a>
        </li>
        <!--  -->
    </ul>
@endif

<!-- {{$test->links()}} -->











<script type="text/javascript">
	$(document).ready(function(){
		var si;
		var th;
		var pr;

		$('.btn').click(function() {
			var d = $(this).data('datac'); //collect the student registration no from 'data-datac' property
			si = $('#marks #'+d+' #stid #sid').val();
			th = $('#marks #'+d+' #thmr #thm').val();
			pr = $('#marks #'+d+' #prmr #prm').val();
      		//var d = $(this).data('datac');#marks #12345 #name 
      		if(th == '') th = 0;     
      		if(pr == '') pr = 0;
      		//alert("#marks #"+d+" #action");
      		//alert(si+th+pr);   
		


			var u = '{{url("/AddSubMrk")}}';
			var t = '{{csrf_token()}}';

	 		$.ajax({
		      	method:'post',
		      	url: u,      
		      	data: {sid: si, thm: th, prm: pr, _token: t},
		      	success: function(msg){	    	
		            console.log(msg['oval']+"XX"+msg['nval']);

		            $("#marks #"+d+" #action").html("<button class='btn btn-success' data-datac='"+d+"'>Update</button>");
		    	},
		    	error: function (data) {
	                console.log('Error:', data);
	            }
		    }); //end of ajax 

		}); // end of button click function
	}); //end of document ready function

	

</script>	
@endsection





@section('footer')
	@include('layouts.footer')
@endsection