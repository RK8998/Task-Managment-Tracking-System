@extends('layouts_of_employee.master')

@section('content')

<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
			<div class="col-6">
					<h2>My Teams</h2>
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
			<div class="col-5" id="team">
				<a id="tg" role="button" data-toggle="collapse" href="#collapseExample" 
				aria-expanded="false" aria-controls="collapseExample">
					<i class="fas fa-plus" id="plus" style="font-size:25px;"></i>
					<i class="fas fa-minus" id="minus" style="font-size:25px;"></i>
				</a>						
			</div><br/>
			@foreach ($data['team'] as $team)
				<div class="row" id="myteams">
					<div class="col-2">{{$loop->iteration}}</div>
					<div class="col-5">
						{{$team->tname}}
					</div>
					@php $cnt=0 @endphp
					@foreach($data['team_m'] as $tm)
						@foreach($data['member'] as $member)
							@if($team->tid == $tm->tid && $tm->eid == $member->eid)
								@php $cnt++ @endphp
							@endif
						@endforeach
					@endforeach
					{{"Total Members :  ("}}{{$cnt}}{{")"}}
				</div>

				<br>
				<div class="collapse" id="collapseExample" style="margin-left: 38px;">
					<h4>Details of <a href="" style="text-decoration:none">{{ $team->tname }}</a>
						</h4><br>

						<b>Team Member's : </b><br/><br/>
					@foreach($data['team_m'] as $tm)
						@if($team->tid == $tm->tid)
							@foreach($data['member'] as $member)
								@if($tm->eid == $member->eid)

									<div class="btn-group dropright">
										<button type="button" class="btn">
										{{ $member->name }}
										</button>
							<!--  -->
										<button type="button" class="btn dropdown-toggle dropdown-toggle-split" 
										data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<span style="color: darkgray;">view details</span>
										<span class="sr-only">Toggle Dropright</span>
										</button>
							<!--  -->
										<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
										<p class="dropdown-item" type="button">
											<i class="fas fa-envelope"></i>&nbsp;&nbsp;Email : {{$member->email}}
										</p>
										    <div class="dropdown-divider"></div>
										<p class="dropdown-item" type="button">
											<i class="fas fa-phone"></i>&nbsp;&nbsp;Mobile : {{$member->mobile}}
										</p>
										    <div class="dropdown-divider"></div>
										<p class="dropdown-item" type="button">
											<i class="fas fa-mars-stroke"></i>&nbsp;&nbsp;Gender : {{$member->gender}}
										</p>
										 <div class="dropdown-divider"></div>
										<p class="dropdown-item" type="button">
											<i class="fa fa-child"></i>&nbsp;&nbsp;Age : 
											@if($member->age == 0) @else {{$member->age}} Year @endif
										</p>
										    <div class="dropdown-divider"></div>
										<p class="dropdown-item" type="button">
											<i class="fas fa-globe"></i>&nbsp;&nbsp;Experience : 
											@if($member->exp == 0)	No @else {{$member->exp}} Year @endif
										</p>
										
										</div>
									</div>
									<br/><br/>
								@endif
							@endforeach
						@endif
					@endforeach
				</div>

			@endforeach 
			<br/>
		</div>
	</div>
</div>

@endsection