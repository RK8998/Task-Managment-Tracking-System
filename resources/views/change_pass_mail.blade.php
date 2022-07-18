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
		<p>Take Your OTP For Change Passowrd...</p><br>
		<label>OTP : </label><b>{{$otp}}</b><br>
		<br><br>
		<p style="float:right">Thank You.</p>
	</div><br>
	<br>
</body>
</html>