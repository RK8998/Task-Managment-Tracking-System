@extends('layouts_of_employee.master')

@section('content')

<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
			<div class="col-6">
					<h2>Task's</h2>
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

			<form action="{{ url('task_filter') }}" method="get">
				@csrf
				<label>Select Project :</label>
				<div class="row">
					<div class="col-10">
						<div class="form-group">
							<select class="form-control" name="project">
								<option value="0">All</option>
								@foreach($data['project'] as $project)
									<option value="{{$project->pid}}">
										{{ $project->pname }}
									</option>
								@endforeach
							</select>
						</div>					
					</div>
					<div class="col-2">
						<input type="submit" name="submit" value="Filter" class="btn btn-danger btn-block">
					</div>
				</div>
			</form>
			<hr style="border:1px solid black;">
				
				@if(empty($data['pname']))
					<h4>{{'All Task'}}</h4>
				@else
					@foreach($data['pname'] as $pname)
						<h4>{{$pname->pname}}</h4>
					@endforeach
				@endif
				
			<hr style="border:1px solid black;"><br>
			<table id="tbl" style="text-align: center"  class="display" width="100%">
				<thead>
					<tr>
						<td><b>No</b></td>
						<td><b>Task</b></td>
						<td><b>Assigned To.</b></td>
						<td><b>Start Date</b></td>
						<td><b>Due Date</b></td>
						<td><b>Priority</b></td>
						<td><b>Status</b></td>
						<td><b>Action</b></td>
					</tr>
				</thead>
				<tbody>
					@foreach($data['task'] as $task)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$task->tname}}</td>
							<td>{{$task->name}}</td>
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
									<div class="btn btn-danger">To Do</div>
								@elseif($task->status == 2)
									<div class="btn btn-info">Start</div>
								@elseif($task->status == 3)
									<div class="btn btn-warning">Stop</div>
								@elseif($task->status == 4)
									<div class="btn btn-success">Complete</div>
								@endif
							</td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn dropdown-toggle btn btn-primary" 
									  data-toggle="dropdown" aria-haspopup="true" 
									  aria-expanded="false">Action
									</button>
									<div class="dropdown-menu dropdown-menu-right">

									<a class="dropdown-item btn" href="{{ url('edit_task',[$task->tid]) }}">
										<i class="fas fa-edit"></i>&nbsp;&nbsp;Edit</a>

									<div class="dropdown-divider"></div>
									<a class="dropdown-item btn" 
												onclick="return confirm('Are You Sure..?');" 
												href="{{ url('delete_task',[$task->tid]) }}">
										<i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Delete</a>
									
									<div class="dropdown-divider"></div>
									<a class="dropdown-item btn" href="{{ url('task_view_detail',[$task->tid]) }}">
										<i class="fas fa-eye"></i>&nbsp;&nbsp;View</a>

									<div class="dropdown-divider"></div>
									<a class="dropdown-item btn" href="{{ url('task_issue_view',[$task->tid]) }}">
										<i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;View Issue</a>

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