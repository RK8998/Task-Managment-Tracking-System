@extends('layouts_of_employee.master')

@section('content')

<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-6 nav-link">
			<h2>Update Status of <a href="#" style="text-decoration:none">{{ $data[0]->tname }}</a> Task</h2>
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
			<form action="{{ url('update_task_status',[$data[0]->tid]) }}" method="post">
				@csrf
				<div class="form-group">
					<label>Status :</label>
					<select class="form-control" name="estatus" value="{{$data[0]->status}}">
						<option value="0">Select Status</option>
							<option value="1" @if($data[0]->status == 1) {{'selected'}} @endif>To Do
							</option>
							<option value="2" @if($data[0]->status == 2) {{'selected'}} @endif>Start</option>
							<option value="3" @if($data[0]->status == 3) {{'selected'}} @endif>Stop</option>
							<option value="4" @if($data[0]->status == 4) {{'selected'}} @endif>Complete
							</option>
					</select>
					<div style="color:red;">
					@error('estatus'){{'The selected Status is invalid.'}}@enderror</div>
				</div>
				<div class="form-group">
					<input type="submit" name="update" value="Update" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
</div>

@endsection