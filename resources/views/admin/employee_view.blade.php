
@extends('layouts_of_admin.master')

@section('content')

<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
			<div class="col-6">
				@foreach ($data as $emp)
					@if( $emp->role == 1)
						<h2>Task Manager</h2>
						@break 
					@endif
					@if( $emp->role == 2)
						<h2>Team Leader</h2>
						@break 
					@endif
					@if( $emp->role == 3)
						<h2>Team Member</h2>
						@break 
					@endif
				@endforeach
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
						<td><b>Name</b></td>
						<td><b>Email</b></td>
						<td><b>Phone No.</b></td>
						<!-- <td><b>Joining Date</b></td> -->
						<!-- <td><b>Birth Date</b></td> -->
						<!-- <td><b>Experiance</b></td> -->
						<td><b>Username</b></td>
						<!-- <td><b>Password</b></td> -->
						<!-- <td>Description</td> -->
						<td><b>Status</b></td>
						<td><b>Action</b></td>
					</tr>
				</thead>
				<tbody>
					@foreach ($data as $emp)
		 				<tr>
							<td>{{$loop->iteration}}</td>
							<td>
								{{$emp->name}}
								<b>@if($emp->role == 23){{'*'}}@endif</b>
								<!-- <h6>About us : </h6>
								<p>{{$emp->description}}</p> -->
							</td>
							<td>{{$emp->email}}</td>
							<td>{{$emp->mobile}}</td>
							<!-- <td>{{$emp->jdate}}</td> -->
							<!-- <td>{{$emp->bdate}}</td> -->
							<!-- <td>{{$emp->exp}}</td> -->
							<td>{{$emp->username}}</td>
							<!-- <td>{{$emp->password}}</td> -->
							<!-- <td>{{$emp->description}}</td> -->
							<td>
								@if($emp->status2 == 1)
									<div style="background-color: green;color: whitesmoke;
									border-radius: 5px;">Online</div>
								@elseif($emp->status2 == 0)
									<div style="background-color: gray;color: whitesmoke;
									border-radius: 5px;">Offline</div>
								@endif
							</td>
							<td>
								<div class="btn-group">
									<button type="button" class="btn dropdown-toggle btn btn-primary" 
									  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									    Action
									</button>
									<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item btn" href="{{url('edit_employee',[$emp->eid]) }}">
											<i class="fas fa-edit"></i>&nbsp;&nbsp;Edit</a>

											<div class="dropdown-divider"></div>

								<a class="dropdown-item btn" 
									href="{{url('delete_employee',[$emp->eid]) }}"
									onclick="return confirm('Are You Sure..?');">
											<i class="fas fa-trash-alt"></i>&nbsp;&nbsp;Delete</a>

											<div class="dropdown-divider"></div>

								<a class="dropdown-item btn" href="{{url('employee_view_detail',[$emp->eid]) }}">
											<i class="fas fa-eye"></i>&nbsp;&nbsp;View</a>

										<!-- <button class="btn" data-toggle="modal" data-target="#exampleModal">
										  <i class="fas fa-eye"></i>&nbsp;&nbsp;View
										</button> -->
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