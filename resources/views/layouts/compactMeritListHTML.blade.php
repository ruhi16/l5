<!DOCTYPE html>
<html>
<head>
	<title>Register Sheet</title>
	<style>
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;            
            text-align="right";
        }
        
	</style>
</head>
<body>
<center>
<h1>Manikchak High Madrasah(H.S.)</h1>
<h2>Class XI - 2017-18 Students Merit List Details</h2>
</center>

<table border="1">

    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Reg No</th>
            <th>Roll</th>
            <th>Total 6 Subj</th>
            <th>Min Subj No</th>
            <th>Best of 5 Subj Total</th>
            <th>Rank</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 0; @endphp
        @foreach($meritlists as $merit)
        @php $i++; @endphp
        <tr>
            <td>{{ $i }}</td>
            <td align="left">{{ $merit->name }}</td>
            <td align="left">{{ $merit->reg }}</td>
            <td>{{ $merit->roll }}</td>
            <td>{{ $merit->tot6subj }}</td>
            <td>{{ $merit->totminsubj }}</td>
            <td>{{ $merit->tot5subj }}</td>
            <th>{{ $i }}</th>

        </tr>
        @endforeach
    </tbody>
    </table>



















</body>
</html>