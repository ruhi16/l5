@extends('layouts.baselayout')
@section('title','TEST PAGE')

@section('header')
	@include('layouts.navbar')
@endsection

@section('content')
	<h1>COMBINED TEST PAGE ...</h1>
	
<table class="table table-bordered" id="result">
<thead>
<tr>
  <th>ID</th>
  <th>Name</th>
	<th colspan="4" class="text-center">Language - I</th>
  <th colspan="4" class="text-center">Language - I</th>
	<th colspan="4" class="text-center">Elective - I</th>
	<th colspan="4" class="text-center">Elective - II</th>
	<th colspan="4" class="text-center">Elective - III</th>
	<th colspan="4" class="text-center">Optional - I</th>
	<th class="text-center">			Total</th>
	<th class="text-center">			Action</th>
</tr>
</thead>

<tbody>
@foreach($students as $student)	
	<?php $index = 0; $total = 0; ?>
  
	<tr id="{{$student->id}}tr">
		<td><small>{{$student->id}}</small></td>
    <td>{{$student->name}}<br><small>{{$student->reg}}</small></td>
			
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
				<!-- array_push($old_array, "new value") -->
				
				<?php $index++; ?>
				
				
			@endforeach	

			
			@for($i=0; $i<(6-$index); $i++)
				<td>NA</td>
        <td></td>
        <td></td>
        <td></td>
			@endfor
			<td><b>{{$total}}</b></td></td>
			<td><a href="{{ URL::to('/individualStudent')}}/{{$student->id}}" class="btn btn-warning">Edit</a></td>
			
	</tr>
	



@endforeach
</tbody>
</table>


<script type="text/javascript">
$(document).ready(function(){

  
  // //alert(myArr);
  // $.each(myArr, function(k, v) {
  //   //alert("id" + ' is ' + v.class);
  // });
  


	$('.open-modal').click(function(){ 
		

		  var v = $(this).val();
	    var value = $("#"+v+"tr #"+v+"name").text();
	    var s1 = $("#"+v+"tr #"+v+"sub0").text();
	    var s2 = $("#"+v+"tr #"+v+"sub1").text();
	    var s3 = $("#"+v+"tr #"+v+"sub2").text();
	    var s4 = $("#"+v+"tr #"+v+"sub3").text();
	    var s5 = $("#"+v+"tr #"+v+"sub4").text();
	    var s6 = $("#"+v+"tr #"+v+"sub5").text();
	    //alert($("#19tr #19sub2").text());
	    //alert(s1+s2+s3+s4+s5+s6);
	    //alert(v);
      var i = 0;  var c = [];
      $('table#result').find('tbody').find('tr#'+v+'tr').find('td').each(function(){
        var s = $('td#'+v+'sub'+i).text();
        if(s != ''){
          c.push(s);

          var x = $('td#'+v+'sub'+i+'th').text();
          if(x == '')x=0;
          c.push(x);

          var y = $('td#'+v+'sub'+i+'pr').text();
          if(y == '')y=0;
          c.push(y);          
        }
        i++;
        
        //alert(x+", i:"+i);
        //alert($(this).text());
      });
      for(var j=0; j<c.length; j++){
        if(j%3 == 0){
          $('#myModal #subject'+((j/3)+1)).html(c[j]);
          $('#myModal #subject'+((j/3)+1)+"th").val(c[j+1]);
          $('#myModal #subject'+((j/3)+1)+"pr").val(c[j+2]);

        }
      }
      // $.each(c, function(k,v){
      //   alert(k+" => "+v)
      // });
      //alert(c.length);
      // $.each(c,function(k,v){
      //   alert(k+"=>"+v);
      // });

      if(c.length < 18){
        $('#myModal #subject6').html("NA");
        $("#additional-sub").find("input,select,textarea,button").val(0);
        $("#additional-sub").find("input,select,textarea,button").prop("disabled",true);
      }else{
        $("#additional-sub").find("input,select,textarea,button").prop("disabled",false);
      }
      

		$('#myModal').modal('show');



	});

});
</script>


@endsection



@section('footer')
	@include('layouts.footer')
@endsection
