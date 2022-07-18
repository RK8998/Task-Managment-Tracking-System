@extends('layouts_of_employee.master')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-9">
					@if(empty($data['team']))
						<h5 style="color:red;">You are not in any team !</h5>
					@else
						@foreach($data['team'] as $team)
						<h2>Details of <a href="" style="text-decoration:none">{{ $team->tname }}</a>
						</h2>
						@endforeach
					@endif
				</div>
				<div class="col-3">
					<a href="{{ url()->previous() }}" class="btn btn-primary" style="float:right;">
						<i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>	
				</div>
			</div>
			<hr>
			@if(!empty($data['team']))
				@foreach($data['manager'] as $emp)
					<b>Team Manager : </b>
						<div class="btn-group dropright">
						  	<button type="button" class="btn">
								{{ $emp->name }}
								</button>
						  <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  	<span style="color: darkgray;">view details</span>
						    <span class="sr-only">Toggle Dropright</span>
						  </button>
						  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
						    <p class="dropdown-item" type="button">
						    	<i class="fas fa-envelope"></i>&nbsp;&nbsp;Email : {{$emp->email}}
						    </p>
						        <div class="dropdown-divider"></div>
						    <p class="dropdown-item" type="button">
						    	<i class="fas fa-phone"></i>&nbsp;&nbsp;Mobile : {{$emp->mobile}}
						    </p>
						        <div class="dropdown-divider"></div>
						    <p class="dropdown-item" type="button">
						    	<i class="fas fa-mars-stroke"></i>&nbsp;&nbsp;Gender : 
						    	{{$emp->gender}}
						    </p>
						    	<div class="dropdown-divider"></div>
						    <p class="dropdown-item" type="button">
						    	<i class="fa fa-child"></i>&nbsp;&nbsp;Age : 
						    	@if($emp->age == 0) @else {{$emp->age}} Year @endif
						    </p>
						        <div class="dropdown-divider"></div>
						    <p class="dropdown-item" type="button">
						    	<i class="fas fa-globe"></i>&nbsp;&nbsp;Experience : 
						    	@if($emp->exp == 0)	No @else {{$emp->exp}} Year @endif
						    </p>
						  </div>
						</div>
					<hr><br>
				@endforeach

				<b>Team Members : </b><br><br>
				@foreach($data['team_member'] as $tm)
					@foreach($data['employee'] as $emp)
						@if($tm->eid == $emp->eid && $emp->eid != Session::get('employee_login_session')[0]->eid)
							<div class="btn-group dropright">
							  	<button type="button" class="btn">
									{{ $emp->name }}
									</button>

							  <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							  	<span style="color: darkgray;">view details</span>
							    <span class="sr-only">Toggle Dropright</span>
							  </button>
							  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
							    <p class="dropdown-item" type="button">
							    	<i class="fas fa-envelope"></i>&nbsp;&nbsp;Email : {{$emp->email}}
							    </p>
							        <div class="dropdown-divider"></div>
							    <p class="dropdown-item" type="button">
							    	<i class="fas fa-phone"></i>&nbsp;&nbsp;Mobile : {{$emp->mobile}}
							    </p>
							        <div class="dropdown-divider"></div>
							    <p class="dropdown-item" type="button">
							    	<i class="fas fa-mars-stroke"></i>&nbsp;&nbsp;Gender : 
							    	{{$emp->gender}}
							    </p>
							    	<div class="dropdown-divider"></div>
							    <p class="dropdown-item" type="button">
							    	<i class="fa fa-child"></i>&nbsp;&nbsp;Age : 
							    	@if($emp->age == 0) @else {{$emp->age}} Year @endif
							    </p>
							  </div>
							</div><br><br>
						@endif
					@endforeach	
				@endforeach
			@endif
			<br>
			<!-- <div class="form-group">
				<a href="{{ url('dashboard') }}" class="btn btn-secondary">Close</a>
			</div><br> -->
		</div>
	</div>
</div>
@endsection