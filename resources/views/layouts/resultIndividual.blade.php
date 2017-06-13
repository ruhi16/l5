<!DOCTYPE html>
<html>
<head>
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title page-title></title>
    <link href='https://app.dayjibe.com/app/styles/fonts.googleapis.css' rel='stylesheet' type='text/css'>
    <link href="css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://app.dayjibe.com/app/styles/style.css" rel="stylesheet"> -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title page-title></title>
    <link rel="stylesheet" type="text/css" href="{{url('bs337/css/bootstrap.min.css')}}" >
    <script src="{{url('jQ/jquery.min.js')}}"></script>
    <script src="{{url('bs337/js/bootstrap.min.js')}}" integrity=""></script>
</head>
<body class="bodyopacity" landing-scrollspy id="page-top">
<!-- Main view  -->


	<center><h1><b>Manikchak High Madrasah(H.S.)</b></h1>
    <h4>Lalgola * Murshidabad</h4>
    <b>Progress Report</b> for <b>Class XI Annual Exam-2017</b></center>

    @foreach($students as $student)
    {{qrTest($student->reg, $student->name)}}
    <table width='100%'><tr><td>
        <td><h3>Name: {{$student->name}} [Class Roll: {{$student->roll}} ]</h3>
        <h4>Registration No: {{$student->reg}}</h4></td>
        <td><div class='col-xs-4'><center><img src='{{$student->reg}}.png'></center></div></td></tr>
    </table>
    <!-- @endforeach -->



	<table class="table table-bordered">
		<tr>
			<th>Subject</th>
			<th>Theory</th>
			<th>Practical</th>
			<th>Total</th>
		</tr>
		<!-- @foreach($students as $student) -->
		<tr>
			<td>{{$student->subj}}</td>
			<td>{{(int)$student->thmark}}</td>
			<td>{{(int)$student->prmark}}</td>
			<td>{{$student->thmark+$student->prmark}}</td>
		</tr>
		@endforeach
	</table>


</body>
</html>
