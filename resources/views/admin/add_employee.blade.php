 @extends('layouts_of_admin.master')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-6">
					<h2>ADD Employee</h2>					
				</div>
				<div class="col-6">
					@if(Session::get('success'))
						<span id="msg" class="alert alert-success">{{Session::get('success')}}
						</span><br><br>
					@endif
					@if(Session::get('fail'))
						<span id="msg" class="alert alert-danger">{{Session::get('fail')}}
						</span><br><br>
					@endif					
				</div>
			</div>
			<hr>
			<form action="add_employee" method="post" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label>&nbsp;Name : </label>
					<input type="text" name="name" id="name" class="form-control" 
					placeholder="Enter Name of Employee" value="{{old('name')}}">
					<div style="color:red;">@error('name'){{$message}} @enderror</div>
				</div>
				<div class="form-group">
					<label>&nbsp;Email : </label>
					<input type="email" name="email" id="email" class="form-control" 
					placeholder="Enter Email" value="{{old('email')}}">
					<div style="color:red;">@error('email'){{$message}} @enderror</div>
				</div>
				<div class="form-group">
					<label>Role : </label>
					<select class="form-control" name="role" id="role" value="{{old('role')}}">
						<option value="0">Select Role</option>
						<option value="1" @if(old('role')==1) {{ 'selected' }} @endif>Task Manager</option>
						<!-- <option value="2" @if(old('role')==2) {{ 'selected' }} @endif>Team Leader</option> -->
						<option value="3" @if(old('role')==3) {{ 'selected' }} @endif>Team Member</option>
						<!-- <option value="23"@if(old('role')==23) {{ 'selected' }} @endif>Team Leader & Member
						</option> -->
					</select>
					<div style="color:red;">@error('role'){{$message}} @enderror</div>
				</div>
				<div class="form-group">
					<label>Joining Date :</label>
					<input type="date" name="jdate" id="jdate" class="form-control" value="{{old('jdate')}}">
					<div style="color:red;">@error('jdate'){{ "The Joining Date field is required" }} @enderror</div>
				</div>
				<div class="form-group">
					<label>&nbsp;Username : </label>
					<input type="text" name="username" id="username" class="form-control" 
					placeholder="Set Username (Enter Only name)" value="{{old('username')}}">
					<div style="color:red;">@error('username'){{$message}} @enderror</div>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="gender" id="" value="male" checked>
					<label class="form-check-label">
				   		Male
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="gender" id="" value="female">
					<label class="form-check-label">
				   		Female
					</label>
				</div>

				<br>	
				<div class="form-group">
					<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
				</div>
			</form>
		</div>
	</div>
</div>

<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready( function() {
		$('#msg').delay(2000).fadeOut();
    });
</script> -->

@endsection