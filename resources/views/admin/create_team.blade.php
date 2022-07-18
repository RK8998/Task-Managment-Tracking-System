@extends('layouts_of_admin.master')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-6">
					<h2>Create Team</h2>
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
			<form action="{{ url('store_create_team') }}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label>&nbsp;Team Name : </label>
					<input type="text" name="tname" class="form-control" 
				 	value="{{ old('tname') }}" placeholder="Enter Name of Team">
				 	<div style="color:red;">@error('tname'){{ 'The Team name field is required.' }}@enderror
				 	</div>
				</div>
				<div class="form-group">
					<label>&nbsp; Team Manager : </label>
					<select class="form-control" name="manager">
						<option value="0">Select Team Manager</option>
						@foreach($data as $emp)
							@if($emp->role == 1)
								<option value="{{ $emp->eid }}">{{ $emp->name }}</option>
							@endif
						@endforeach
					</select>
					<div style="color:red;">@error('manager')
						{{ 'The Team manager field is required.' }}@enderror
				 	</div>
				</div>
				<!-- <div class="form-group">
					<label>&nbsp;Team Leader : </label>
					<select class="form-control" name="leader">
						<option value="0">Select Team Leader</option>
						@foreach($data as $emp)
							@if($emp->role == 2)
								@if($emp->status == 0)
									<option value="{{ $emp->eid }}">{{ $emp->name }}</option>
								@endif
							@elseif($emp->role == 23)
								@if($emp->status == 0)
									<option value="{{ $emp->eid }}">{{ $emp->name }}<b>*</b></option>
								@endif
							@endif
						@endforeach
					</select>
					<div style="color:red;">@error('leader')
						{{ 'The Team leader field is required.' }}@enderror
				 	</div>
				</div> -->

				<div class="form-group">
					<!-- <i class="fas fa-plus"></i>
					<input type="submit" name="submit" id="submit" class="btn btn-primary" 
					value='Create'> -->
					<button type="submit" class="btn btn-primary">
						<i class="fas fa-plus"></i>&nbsp;
						Create
					</button>
					<a href="{{ url()->previous() }}" class="btn btn-secondary">
					Cancel</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection