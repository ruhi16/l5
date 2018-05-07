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
<h2>Class XI - 2017-18 Students Marks Registers Details</h2>
</center>
	

    <table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>            
            <th>Roll</th>
            <th>Lang-I</th>
            <th>Lang-II</th>
            <th>Elec-I</th>
            <th>Elec-II</th>
            <th>Elec-III</th>
            <th>Optl-I</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <td>{{ $student->id }}</td>
            <td>{{ $student->name }}<br>
            Reg: <small>{{ $student->reg }}</small></td>
            <td>{{ $student->roll }}</td>
            @php $total = 0; @endphp
            @forelse($student->studies as $study)
                <td>
                <small>
                @foreach($study->marks as $mark)
                    
                        {{$study->subject->subj or ''}}<br>
                        {{(int)$mark->thmark}}+{{(int)$mark->prmark}}={{(int)$mark->thmark+(int)$mark->prmark}}
                        @php $total += (int)$mark->thmark+(int)$mark->prmark ; @endphp
                @endforeach
                </small>
                </td>
            @empty
                <th></th>
            @endforelse
            <td class="text-right"><b>{{ $total }}</b></td>
        </tr>
        @endforeach
    </tbody>
    </table>



</body>
</html>