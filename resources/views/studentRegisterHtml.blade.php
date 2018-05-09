<!DOCTYPE html>
<html>
<head>
	<title>Register Sheet</title>
	<style>
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
		}
	</style>
</head>
<body>
<center>
<h1>Manikchak High Madrasah(H.S.)</h1>
<h2>Class XI - 2017-18 Students Registers Details</h2>
</center>
<table border="1">
	<thead>
		<tr>			
			<th>SL</th>
			<th>Student Name</th>
			<th>Class XI Roll No</th>			
            <th>Subject Details</th>
			<th>Registraion No</th>
			<th>Admit Roll-NO</th>
			<th>Signature for Reg Cert</th>
			<th>Signature for Admit Card</th>
			<th>Signature for Mark Sheet & Cert</th>			
		</tr>
	</thead>
	<tbody>		
		@php $i = 0; @endphp
		@foreach($stds as $st)
			@php $i++; @endphp
			<tr>
				<td>{{ $i }}</td>
				<td>{{ $st->name }}</td>
				<td align="center">{{ $st->roll }}</td>				
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
				<td></td>
				<td></td>
				<td></td>
				<td></td>				
			</tr>
		@endforeach
		
	</tbody>
	</table>


</body>
</html>