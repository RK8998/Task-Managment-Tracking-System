<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Login</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
	integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
	crossorigin="anonymous">

	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

	<style type="text/css">
		*{
			margin: 0px;
			padding: 0px;
		}
		Html, body{
			height:100%;
			margin: 0px;
			padding: 0px;
			/*background-color: #D6E6F3;*/
			background-color: #e6e6ff;
		}

		.grandParentContaniner{
			display:table; height:100%; margin: 0 auto;
		}

		.parentContainer{
			display:table-cell; vertical-align:middle;
		}
		.Login_form{
			background-color: white;
			border-top: 4px solid #0F7DD3;
			/*margin-top: 100px;*/
			padding: 20px;
			width: 450px;
			max-width: auto;
			max-height: auto;
			height: auto;
			border-radius: 5px;
			box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
		}
		input[type=text],input[type=password]{
			background-color: white;
		}
		.parent_container{
			display: table-cell;
			vertical-align: middle;
		}
		.grandparent_container{
			display: table;
			height: 100%;
			margin: 0 auto;
		}
		.logo{
			font-size: 20px; 
			font-weight: bold;
			margin-left: 5px;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<div class="grandparent_container">
		<div class="parent_container">
			<div class="row">
				<div class="col-9">
					<label class="logo">Task Managment & Tracking</label>
				</div>
				<div class="col-3">
					<label class="btn btn-primary" style="float: right;">Admin</label>	
				</div>
			</div>
			<div class="Login_form">
				<form action="admin_Login" method="post">
					@csrf
					<div class="form-group">
						<label><i class="fa fa-user"></i>&nbsp;&nbsp;Username </label>
						<input type="text" name="username" class="form-control" placeholder="Enter Username" 
						autocomplete="off" value="{{old('username')}}">
						<div style="color:red;">@error('username'){{$message}} @enderror</div>
					</div>
					<div class="form-group">
						<label><i class="fa fa-lock"></i>&nbsp;&nbsp;Password </label>
						<input type="password" name="password" class="form-control" placeholder="●●●●●"
						autocomplete="off" value="{{old('password')}}">
						<div style="color:red;">@error('password'){{$message}} @enderror</div>
					</div>
					<!-- <br> -->
					<div class="row">
						<div class="col-9">
							@if(Session::get('fail'))
								<div class="alert alert-danger">
									{{ Session::get('fail') }}
								</div>
							@endif				
						</div>
						<div class="col-3">
							<div class="form-group">
								<button type="submit" class="btn btn-primary" style="float:right;">
								<i class="fa fa-sign-in-alt"></i>&nbsp;&nbsp;Sign In</button>
							</div>		
						</div>
					</div>
					<!-- <br>&nbsp; -->
				</form>
			</div>
			
		</div>
	</div>		
</body>
</html>