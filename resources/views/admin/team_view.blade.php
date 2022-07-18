@extends('layouts_of_admin.master')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-6">
					<h2>Teams</h2>
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
			<div class="box">
				<div class="row">
				@foreach($data['team'] as $team)
						<div class="col-4">
							<div class="team_box">
								<h4 class="team_name">{{ $team->tname }}</h4><hr>
								@foreach($data['emp'] as $emp)
									@if($team->manager == $emp->eid)
										<label>Task Manager : </label>
										<label style="color:gray">{{ $emp->name }}</label><br> 		
									@endif
								@endforeach
								<br>
							<div style="text-align: right;">
							<a href="{{ url('add_team_member',[$team->tid]) }}" class="btn btn-primary"
								title="Add Team Member"><i class="fas fa-plus"></i></a>

							<a href="{{ url('edit_team',[$team->tid]) }}" class="btn btn-success" title="Edit Team">
								<i class="fas fa-edit"></i></a>
							
							<a href="{{ url('delete_team',[$team->tid]) }}" class="btn btn-danger"
							onclick="return confirm('Are You Sure..?');" title="Remove Team">
							<i class="fas fa-trash-alt"></i></a>
							
							<a href="{{ url('team_view_detail',[$team->tid]) }}" class="btn btn-secondary"
								title="View Details of Team"><i class="far fa-eye"></i></a>
							</div>
							</div>
						</div>
				@endforeach
				</div>
			</div>
			<br>
		</div>
	</div>
</div>
@endsection