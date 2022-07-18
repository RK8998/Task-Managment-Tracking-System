
@extends('layouts_of_employee.master')

@section('content')

<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
			<div class="col-6">
					<h2>My Task's</h2>
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
						<td><b>Task</b></td>
						<td><b>On Project</b></td>
						<td><b>Start Date</b></td>
						<td><b>Due Date</b></td>
						<td><b>Priority</b></td>
						<td><b>Status</b></td>
						<td><b>Action</b></td>
					</tr>
				</thead>
				<tbody>
					@foreach ($data['task'] as $task)
		 				<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$task->tname}}</td>
							<td>
								@foreach($data['project'] as $pro)
									@if($pro->pid == $task->pid)
										{{$pro->pname}}
									@endif
								@endforeach
							</td>
							<td>{{$task->sdate}}</td>
							<td>{{$task->edate}}</td>
							<td>
								@if($task->tpriority == 1)
									<div>High</div>
								@elseif($task->tpriority == 2)
									<div>Medium</div>
								@elseif($task->tpriority == 3)
									<div>Low</div>
								@endif
								
							</td>
							<td>
								@if($task->status == 1)
									<div class="btn btn-danger" style="cursor: context-menu;">To Do</div>
								@elseif($task->status == 2)
									<div class="btn btn-info" style="cursor: context-menu;">Start</div>
								@elseif($task->status == 3)
									<div class="btn btn-warning" style="cursor: context-menu;">Stop</div>
								@elseif($task->status == 4)
									<div class="btn btn-success" style="cursor: context-menu;">Complete</div>
								@endif
								
							</td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn dropdown-toggle btn btn-primary" 
									  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									    Action
									</button>
									<div class="dropdown-menu dropdown-menu-right">
								
									<a class="dropdown-item btn" href="{{url('edit_task_status',[$task->tid]) }}">
										<i class="fas fa-edit"></i>&nbsp;&nbsp;Status</a>
										
										<div class="dropdown-divider"></div>

									<a class="dropdown-item btn" 
									href="{{url('member_task_view',[$task->tid])}}">
									<i class="fas fa-eye"></i>&nbsp;&nbsp;View</a>
										
										<div class="dropdown-divider"></div>

									<a class="dropdown-item btn" href="{{url('create_issue_task',[$task->tid]) }}">
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