 @extends('layouts_of_admin.master')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-6">
					<h2><i class="fas fa-user-circle"></i>&nbsp;&nbsp;Profile</h2>				
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
			</div><hr>

			<div class="profile_img">
				<form action="{{url('admin_profile_img',[$data[0]->aid])}}" method="post" 
					enctype="multipart/form-data">
					@csrf
					@if($data[0]->img == NULL)
						<img src="{{Asset('img/default.jpg')}}" 
						width="250" height="270" class="img-circle cursor-pointer"><br><br>
					@else
						<img src="http://localhost/TMT/public/img/admin/{{ $data[0]->img}}" 
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

			<form action="{{url('admin_profile_update',[$data[0]->aid])}}" 
				method="post">
				@csrf
				
				<div class="form-group">
					<label>Username :</label>
					<input type="text" name="username" value="{{ $data[0]->username }}" 
					class="form-control" autocomplete="off">
						<div id="username_err" style="color:red;">
							@error('username'){{$message}} @enderror
						</div>
				</div>
				<div class="form-group">
					<label>Password :</label>
					<input type="password" name="password" value="{{ $data[0]->password }}" 
					class="form-control" id="password" autocomplete="off">
					<input type="checkbox" id="showPassword"> Show Password
						<div id="username_err" style="color:red;">
							@error('password'){{$message}} @enderror
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
					<label>Company :</label>
					<input type="text" name="company" value="{{ $data[0]->company }}" 
					class="form-control" autocomplete="off">
						<div id="username_err" style="color:red;">
							@error('company'){{$message}} @enderror
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
@endsection