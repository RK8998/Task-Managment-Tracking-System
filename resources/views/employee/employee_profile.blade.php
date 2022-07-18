@extends('layouts_of_employee.master')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-8">
					<div class="row">
						<div class="col-3">
							<h2><i class="fas fa-user-circle"></i>&nbsp;&nbsp;Profile</h2>	
						</div>
						<div class="col-5">
							@if($data[0]->exp==0 || $data[0]->mobile==NULL || $data[0]->bdate==NULL ||
							$data[0]->img == NULL||$data[0]->name == " "||$data[0]->email == " ")
							<label style="color:red;background-color: lightgray;
							padding: 10px; border-radius: 10px;"><i class="fas fa-tasks"></i>&nbsp;&nbsp;
							{{ 'Please Complete Your Profile !' }}</label>
							@endif						
						</div>
					</div>
				</div>
				<div class="col-4">
					@if(Session::get('success'))
						<span id="msg" class="alert alert-success">{{Session::get('success')}}
						</span><br><br>
					@endif
					@if(Session::get('fail'))
						<span id="msg" class="alert alert-danger">{{Session::get('fail')}}
						</span><br><br>
					@endif
				</div>
			</div><hr>

			<div class="profile_img">
				<form action="{{url('employee_profile_img',[$data[0]->eid])}}" method="post" 
					enctype="multipart/form-data">
					@csrf
					@if($data[0]->img == NULL)
					<img src="{{Asset('img/default.jpg')}}" 
						width="250" height="270" class="img-circle cursor-pointer"><br><br>
					@else
					<img src="http://localhost/TMT/public/img/employee/{{ $data[0]->img }}" 
						width="250" height="270" class="img-circle cursor-pointer"><br><br>
					@endif
					
					<div class="form-group">
						<input type="file" name="img" class="form-control" 
						style="border-radius: 5px; color: gray;">
					</div>
					<div style="color:red;">@error('img'){{ 'Please Select file...!' }} @enderror</div>
					<div class="form-group">
						<input type="submit" name="update" value="Upload" class="btn btn-danger">
					</div>
				</form>
			</div>

			<br><hr>

			@if($data[0]->role == 1)
				<h3><a href="" style="text-decoration:none;">{{ 'Task Manager' }}</a></h3>
			@elseif($data[0]->role == 2)
				<h3><a href="" style="text-decoration:none;">{{ 'Team Leader' }}</a></h3>
			@elseif($data[0]->role == 3)
				<h3><a href="" style="text-decoration:none;">{{ 'Team Member' }}</a></h3>
			@endif
			<br>
			<form action="{{url('employee_profile_update',[$data[0]->eid])}}" 
				method="post">
				@csrf
				
				<div class="form-group">
					<label>Full Name :</label>
					<input type="text" name="name" value="{{ $data[0]->name }}" 
					class="form-control" autocomplete="off">
						<div id="username_err" style="color:red;">
							@error('name'){{$message}} @enderror
						</div>
				</div>
				<div class="form-group">
					<label>Email :</label>
					<input type="email" name="email"value="{{ $data[0]->email }}" 
					class="form-control" autocomplete="off">
						<div id="username_err" style="color:red;">
							@error('email'){{$message}} @enderror
						</div>
				</div>
				<div class="form-group">
					<label>Phone No :</label>
					<input type="text" name="mobile" value="{{ $data[0]->mobile }}" 
					class="form-control" autocomplete="off">
						<div id="username_err" style="color:red;">
							@error('mobile'){{$message}} @enderror
						</div>
				</div>
				<div class="form-group">
					<label>Birth Date :</label>
					<input type="date" name="bdate" value="{{ $data[0]->bdate }}" 
					class="form-control" autocomplete="off">
						<div id="username_err" style="color:red;">
							@error('bdate'){{'The Birth Date field is required.'}} @enderror
						</div>	
				</div>
				<div class="form-group">
					<label>Experience :</label> (In Year)
					<input type="number" name="exp" class="form-control" value="{{$data[0]->exp}}" autocomplete="off">					
					<div id="username_err" style="color:red;">
						@error('exp'){{'The Experience field is required.'}} @enderror
					</div>	
				</div>
				<div class="form-group">
					<label>Username :</label>
					<input type="text" name="username" value="{{ $data[0]->username }}" 
					class="form-control" autocomplete="off" disabled>
						<div id="username_err" style="color:red;">
							@error('username'){{$message}} @enderror
						</div>
				</div>
				<div class="form-group">
					<label>Password :</label>
					<input type="password" name="password" value="{{ $data[0]->password }}" 
					class="form-control" id="password" autocomplete="off" disabled>
					<input type="checkbox" id="showPassword"> Show Password
						<div id="username_err" style="color:red;">
							@error('password'){{$message}} @enderror
						</div>	
				</div>
				<div class="form-group">
					<label>About :</label>
					<textarea name="description" class="form-control">{{ $data[0]->description }}</textarea>
						<div id="username_err" style="color:red;">
							@error('description'){{'The Description field is required.'}} @enderror
						</div>	
				</div>
				<div class="form-group">
					<input type="submit" name="update" value="Update" class="btn btn-primary">
					<a href="{{url('dashboard')}}" class="btn btn-secondary">Cancel</a>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	document.getElementById('showPassword').onclick = function(){
      if(this.checked){
        document. getElementById('password').type="text";
      }else{
        document. getElementById('password').type="password";
      }
    };
</script>
@endsection