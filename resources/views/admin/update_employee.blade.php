@extends('layouts_of_admin.master')

@section('content')

<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-6 nav-link">
					<!-- <h2>Update Role of <a href="#" style="text-decoration: none;">{{ $edit[0]->name }}</a></h2> -->
					<h2>Update Role of <a href="" style="text-decoration:none">{{ $edit[0]->name }}</a>
					</h2>
				</div>
				<div class="col-3">
					@if(Session::get('success'))
						<span id="msg" class="alert alert-success">{{Session::get('success')}}
						</span>
					@endif
					@if(Session::get('fail'))
						<span id="msg" class="alert alert-danger">{{Session::get('fail')}}
						</span>
					@endif	
				</div>
				<div class="col-3">
					<a href="{{ url()->previous() }}" class="btn btn-primary" style="float:right;">
						<i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>	
				</div>
			</div>
			<hr>
			<form action="{{ url('update_employee',[$edit[0]->eid]) }}" method="post">
				@csrf
				<div class="form-group">
					<select class="form-control" name="role" value="{{$edit[0]->role}}">
						<option value="0">Select Role</option>
						<option value="1" @if($edit[0]->role == 1) {{'selected'}} @endif>
						Task Manager</option>
						
						<!-- <option value="2" @if($edit[0]->role == 2) {{'selected'}} @endif>
						Team Leader</option> -->
						
						<option value="3" @if($edit[0]->role == 3) {{'selected'}} @endif>
						Team Member</option>

						<!-- <option value="23" @if($edit[0]->role == 23) {{'selected'}} @endif>
						Team Leader & Member</option> -->
					</select>
					<div style="color:red;">@error('role'){{$message}} @enderror</div>
				</div>
				<div class="form-group">
					<input type="submit" name="update" value="Update" class="btn btn-primary">
					<a href="{{ url('dashboard') }}" class="btn btn-secondary">Cancel</a>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection