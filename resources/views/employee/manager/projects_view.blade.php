@extends('layouts_of_employee.master')

@section('content')

<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
			<div class="col-6">
					<h2>Project's</h2>
			</div>
			<div class="col-6">
				@if(Session::get('success'))
					<span id="msg" class="alert alert-success">{{Session::get('success')}}
					</span>
				@endif
				@if(Session::get('fail'))
					<span id="msg" class="alert alert-danger">{{Session::get('fail')}}
					</span>
				@endif	
			</div>
			</div>
			<hr>
			<br>
			<table id="tbl" style="text-align: center"  class="display" width="100%">
				<thead>
					<tr>
						<td><b>No</b></td>
						<td><b>Project Name</b></td>
						<td><b>Start Date</b></td>
						<td><b>Due Date</b></td>
						<td><b>Priority</b></td>
						<td><b>Status</b></td>
						<td><b>Action</b></td>
					</tr>
				</thead>
				<tbody>
					@foreach ($data as $projects)
		 				<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$projects->pname}}</td>
							<td>{{$projects->sdate}}</td>
							<td>{{$projects->edate}}</td>
							<td>
								@if($projects->priority == 1)
									<div>High</div>
								@elseif($projects->priority == 2)
									<div>Medium</div>
								@elseif($projects->priority == 3)
									<div>Low</div>
								@endif
								
							</td>
							<td>
								@if($projects->status == 1)
									<div class="btn btn-danger" style="cursor: context-menu;">To Do</div>
								@elseif($projects->status == 2)
									<div class="btn btn-info" style="cursor: context-menu;">In Progress</div>
								@elseif($projects->status == 3)
									<div class="btn btn-success" style="cursor: context-menu;">Done</div>
								@endif
								
							</td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn dropdown-toggle btn btn-primary" 
									  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									    Action
									</button>
									<div class="dropdown-menu dropdown-menu-right">
								
									<a class="dropdown-item btn" href="{{url('edit_project_status',[$projects->pid]) }}">
										<i class="fas fa-edit"></i>&nbsp;&nbsp;Status</a>
									<div class="dropdown-divider"></div>

									<a class="dropdown-item btn" 
									href="{{url('projects_view_detail',[$projects->pid])}}">
									<i class="fas fa-eye"></i>&nbsp;&nbsp;View</a>

											<div class="dropdown-divider"></div>

									<a class="dropdown-item btn" href="{{url('create_task',[$projects->pid]) }}">
										<i class="fas fa-plus-circle"></i>
										&nbsp;&nbsp;Create Task</a>

										<div class="dropdown-divider"></div>

									<a class="dropdown-item btn" href="{{url('create_issue_project',[$projects->pid]) }}">
										<i class="fas fa-exclamation-triangle"></i>
										&nbsp;&nbsp;Create Issue</a>
									</div>
								</div>
							</td>
						</tr>	
					@endforeach 
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection