
@extends('layouts_of_admin.master')

@section('content')

<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
			<div class="col-6">
					<h2>Projects</h2>
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
						<td><b>Project ID</b></td>
						<td><b>Project Name</b></td>
						<td><b>Project Type</b></td>
						<td><b>Create Date</b></td>
						<td><b>Status</b></td>
						<td><b>Action</b></td>
					</tr>
				</thead>
				<tbody>
					@foreach ($data as $prj)
		 				<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$prj->pkey}}</td>
							<td>{{$prj->pname}}</td>
							<td>{{$prj->ptype}}</td>
							<td>{{$prj->cdate}}</td>

							<td>
								@if($prj->status == 1)
									<div class="btn btn-danger" style="cursor: context-menu;">Not assign
									</div>
								@elseif($prj->status == 2)
									<div class="btn btn-warning" style="cursor: context-menu;">Assign</div>
								@elseif($prj->status == 3)
									<div class="btn btn-success" style="cursor: context-menu;">Completed</div>
								@endif
								
							</td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn dropdown-toggle btn btn-primary" 
									  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									    Action
									</button>
									<div class="dropdown-menu dropdown-menu-right">
				<!-- Edit -->	@if($prj->status == 3) 
									<a class="dropdown-item btn" href="{{url('not_edit') }}"
										disabled="disabled">
											<i class="fas fa-edit"></i>&nbsp;&nbsp;Edit</a>
								@else
									<a class="dropdown-item btn" href="{{url('edit_project',[$prj->pid]) }}">
										<i class="fas fa-edit"></i>&nbsp;&nbsp;Edit</a>
								@endif
									<div class="dropdown-divider"></div>

				<!-- Delete -->		<a class="dropdown-item btn" 
									href="{{url('delete_project',[$prj->pid]) }}"
									onclick="return confirm('Are You Sure..?');">
											<i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Delete</a>

											<div class="dropdown-divider"></div>

				<!-- View -->	<a class="dropdown-item btn" 
								href="{{url('project_view_detail',[$prj->pid])}}"><i class="fas fa-eye"></i>
								&nbsp;&nbsp;View</a>

								<div class="dropdown-divider"></div>

		<!-- View issue -->		<a class="dropdown-item btn" 
								href="{{url('project_issue_view',[$prj->pid])}}">
								<i class="fas fa-exclamation-triangle"></i>
								&nbsp;&nbsp;View Issue</a>
											<div class="dropdown-divider"></div>

				<!-- Assign -->	@if($prj->status == 2 || $prj->status == 3)
									<a class="dropdown-item btn" href="{{url('already_assign')}}" 
										disabled="disabled">
											<i class="fa fa-user-alt-slash"></i>&nbsp;&nbsp;Not Assign</a>
								@else
									<a class="dropdown-item btn" href="{{url('project_assign',[$prj->pid]) }}"><i class="fa fa-user-edit"></i>&nbsp;&nbsp;Assign</a>
								@endif
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