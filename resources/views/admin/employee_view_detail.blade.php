@extends('layouts_of_admin.master')

@section('content')

	<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-10 nav-link">
					<h2>Profile of <a href="" style="text-decoration:none;">{{ $detail[0]->name }}</a></h2>
				</div>
				<div class="col-2">
					<a href="{{ url()->previous() }}" class="btn btn-primary" style="float:right;">
						<i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>	
				</div>
			</div>
			<hr>
			<div class="box_detail">
				@if($detail[0]->img == NULL)
					<img src="{{Asset('img/default.jpg')}}" 
					width="250" height="270" class="img-circle cursor-pointer"><br><br>
				@else
					<img src="http://localhost/TMT/public/img/employee/{{ $detail[0]->img }}" 
					width="250" height="270" class="img-circle cursor-pointer"><br><br>
				@endif
				<hr>
				<label>Email : </label>
				<input type="email" class="form-control" value="{{ $detail[0]->email }}" disabled><br>
				<label>Phone No : </label>
				<input type="number" class="form-control" value="{{ $detail[0]->mobile }}" disabled><br>
				<label>Gender : </label>
				<input type="text" class="form-control" value="{{ $detail[0]->gender }}" disabled><br>
				<label>Role : </label>
				@if($detail[0]->role == 1)
					<input type="text" class="form-control" value="Task Manager" disabled>
				@elseif($detail[0]->role == 2)
					<input type="text" class="form-control" value="Team Leader" disabled>
				@elseif($detail[0]->role == 3)
					<input type="text" class="form-control" value="Team Member" disabled>
				@elseif($detail[0]->role == 23)
					<input type="text" class="form-control" value="Team Leader & Member" disabled>
				@endif
				<br>
				<label>Joining Date : </label>
				<input type="text" class="form-control" value="{{ $detail[0]->jdate }}" disabled><br>
				<label>Birthdate : </label>
				<input type="text" class="form-control" value="{{ $detail[0]->bdate }}" disabled><br>
				<label>Age : </label>
				@if($detail[0]->age == 0)
					<input type="text" class="form-control" value="{{ '' }}" disabled>
				@else
					<input type="text" class="form-control" value="{{ $detail[0]->age.' Year' }}" disabled>
				@endif
				<br>
				<label>Experiance : </label>
				@if($detail[0]->exp == 0)
					<input type="text" class="form-control" value="{{'No Experiance'}}" disabled><br>
				@elseif($detail[0]->exp == 1)
					<input type="text" class="form-control" value="{{$detail[0]->exp}} Year" disabled>
					<br>
				@else
					<input type="text" class="form-control" value="{{$detail[0]->exp}} Year's" disabled><br>
				@endif

				<label>Username : </label>
				<input type="text" class="form-control" value="{{ $detail[0]->username }}" disabled><br>
				<label>Password : </label>
				<input type="password" class="form-control" value="{{ $detail[0]->password }}" disabled><br>
				<label>About : </label> 
				<textarea class="form-control" disabled>{{ $detail[0]->description }}</textarea>
				<br>
			</div>
		</div>
	</div>
</div>
@endsection