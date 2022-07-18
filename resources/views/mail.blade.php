<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	
	<style type="text/css">
		.box{
			border: 1px solid black;
			border-radius: 5px;
			padding: 25px;
			float: left;
			background-color: #DCDCDC;
			color: black;
		}
	</style>

</head>
<body>
	<div class="box">
		<p>Hello, {{$name}}</p><br><br>
		<p>Receive Your login Details From <b>{{$company}} </b>Company</p><br>
		<label>Username : </label><b>{{$username}}</b><br>
		<label>Password : </label><b>{{$password}}</b>
		<br><br>
		<p>You've joined our company from {{$jdate}} as a
			@if($role == 1)
				Manager
			@elseif($role == 2)
				Team Leader
			@elseif($role == 3)
				Team Member
			@endif
		</p><br><br><br>

		<p style="float:right">Thank You.</p>
	</div><br>
	<br>
</body>
</html>