@extends('layouts_of_admin.master')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-6">
					@foreach($data['teams'] as $team)
						<h2>Update <a href="" style="text-decoration:none">{{ $team->tname }}</a>
						</h2>
					@endforeach
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
				<div class="col-2">
					<a href="{{ url('team_view') }}" class="btn btn-primary" style="float:right;">
						<i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>	
				</div>
			</div>
			<hr>
			
			<b>Team Manager : </b><br><br>
			@foreach($data['teams'] as $team)
				<form action="{{url('edit_team_manager',[$team->tid])}}" method="post">
					@csrf
					<div class="row">
						<div class="col-5">
							<select class="form-control" name="team_manager">
								<option value="0">Select Team Manager</option>
								@foreach($data['emps'] as $emp)
									@if($emp->role == 1)
										<option value="{{$emp->eid}}"
											@if($team->manager == $emp->eid){{'selected'}}@endif>
											{{ $emp->name }}</option>
									@endif
								@endforeach	
							</select>		
							<div style="color:red;">@error('team_manager'){{$message}} @enderror</div>
						</div>
						<div class="col-5">
							<button type="submit" class="btn btn-success"><i class="fas fa-user-edit"></i>
							</button>
						</div>
					</div>
				</form>
			@endforeach

			<!-- <hr>
			<b>Team Leader : </b><br><br>
			@foreach($data['teams'] as $team)
				<form action="{{url('edit_team_leader',[$team->tid])}}" method="post">
					@csrf
					<div class="row">
						<div class="col-5">
							<select class="form-control" name="team_leader">
								<option value="0">Select Team Leader</option>
								@foreach($data['emps'] as $emp)
									@if($emp->role == 2)
										<option value="{{$emp->eid}}"
											@if($team->leader == $emp->eid){{'selected'}}@endif>
											{{ $emp->name }}</option>
									@endif
								@endforeach	
							</select>		
							<div style="color:red;">@error('team_leader'){{$message}} @enderror</div>
						</div>
						<div class="col-5">
							<button type="submit" class="btn btn-success"><i class="fas fa-user-edit"></i>
							</button>
						</div>
					</div>
				</form>
			@endforeach -->

			<hr>
			<b>Team Members : </b><br><br>
			
			@foreach($data['tms'] as $tm)
				@foreach($data['emps'] as $emp)
					<form action="{{url('edit_delete_team_member',[$emp->eid])}}" method="post">
					@csrf
					@if($tm->eid == $emp->eid)
						<div class="row">
							<div class="col-5">
								<input type="text" name="" value="{{$emp->name}}" class="form-control" disabled>	
							</div>
							<div class="col-5">
								<button type="submit" class="btn btn-danger" onclick="return confirm('are you sure ..?')"><i class="fas fa-minus-circle"></i></button>
							</div>
						</div><br>
					@endif
					</form>
				@endforeach	
			@endforeach
			<br>

			@foreach($data['teams'] as $team)
				<form action="{{ url('edit_add_team_member',[$team->tid]) }}" method="post">
				@csrf
				<div class="row">
					<div class="col-5">
						<select class="form-control" name="team_member">
							<option value="0">Select Team Member</option>	
							@foreach($data['emps'] as $emp)	
								@if($emp->role == 3)
									@if($emp->status == 0)
										<option value="{{$emp->eid}}">{{$emp->name}}</option>
									@endif
								@endif
							@endforeach
						</select>	
						<div style="color:red;">@error('team_member'){{$message}} @enderror</div>
					</div>
					<div class="col-5">
						<button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i></button>
					</div>
				</div>		
				</form>
			@endforeach
		</div>
	</div>
</div>
@endsection
