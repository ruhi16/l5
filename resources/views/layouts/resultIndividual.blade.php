<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title page-title></title>
    <link href='https://app.dayjibe.com/app/styles/fonts.googleapis.css' rel='stylesheet' type='text/css'>
    <link href="css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://app.dayjibe.com/app/styles/style.css" rel="stylesheet">
</head>
<body class="bodyopacity" landing-scrollspy id="page-top">
<!-- Main view  -->

	<h1>Result Page</h1>

	<table class="table table-bordered">
		<tr>
			<th>ID</th>
			<th>Name</th>
		</tr>
		@foreach($students as $student)
		<tr>
			<td>{{$student->id}}</td>
			<td>{{$student->name}}</td>
		</tr>
		@endforeach
	</table>


</body>
</html>