<!DOCTYPE html>
<html>
<head>
	<title>Register Sheet</title>
	<style>
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;            
            text-align="right";
            font-size: 15px;
        }
        
	</style>
</head>
<body>
<center>
<h1>Manikchak High Madrasah(H.S.)</h1>
<h2>Class XI - 2018-19 Students Merit List Details</h2>
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
            <th>Addl Subj</th>
            <th>Best 5 Total</th>
            <th>RANK</th>
        </tr>
    </thead>
    <tbody>
    @php $i = 0; @endphp
        
        @foreach($stbest5mrk->sortBy('reg') as $stmrkdetail)
            @if($stmrkdetail->roll != 0)
            @php $i++; @endphp
            <tr>
                <td>{{ $i }}</td>
                <td>
                    {{ $stmrkdetail->name }}<br>
                    <small>Reg. NO: {{ $stmrkdetail->reg }}</small>
                </td>
                <td>{{ $stmrkdetail->roll }}</td>
                {{--  @if(stmrkdetail->reg == $reg)  --}}
                @php
                    $abc = $stmrkdetails->where('reg', $stmrkdetail->reg);


                @endphp
                
                @foreach($abc->sortBy('subject_id') as $a)
                <td>
                    {{ $a->subject_shname }}<br>
                    <small>{{ (int)$a->thmark }}+{{ (int)$a->prmark }}={{ $a->thmark + $a->prmark }}</small>
                </td>
                @endforeach
                <td align="center"><b>{{ (int)$stmrkdetail->total6subject }}</b></td>
                <td align="center">{{ $stmrkdetail->subject_shname }}<br>
                    <small>{{ (int)$stmrkdetail->minOpmark }}</small>
                </td>
                <td align="center"><b>{{ (int)$stmrkdetail->total5subject }}</b></td>
                <td align="center"><b></b></td>
            </tr>
            @endif
        @endforeach  

    </tbody>
    </table>


  
    </body>
</html>