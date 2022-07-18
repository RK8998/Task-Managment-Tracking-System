@extends('layouts_of_employee.master')

@section('content')

<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-7">
					@foreach($dt['project'] as $pro)
					<h2>Create Task of <a href="#" style="text-decoration:none">{{$pro->pname}}</a>
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
				<div class="col-1">
					<a href="{{ url('taskmanager_projects') }}" class="btn btn-primary" 
					style="float:right;">
						<i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>	
				</div>
			</div>
			<hr>
			@foreach($dt['project'] as $pro)
			<form action="{{url('add_task',[$pro->pid])}}" method="post" 
				enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label>&nbsp;Task : </label>
					<input type="text" name="tname" id="tname" class="form-control" autocomplete="off"
					placeholder="Enter Task Name (Limit 20)" value="{{old('tname')}}">
					<div style="color:red;">@error('tname'){{'The Task field is required'}} @enderror</div>
				</div>
				<div class="form-group">
					<label>&nbsp;Description : </label>
					<textarea name="tdec" rows="10" cols="35"></textarea>
					<div style="color:red;">@error('tdec'){{'The Task Description field is required'}} @enderror</div>
				</div>
				<div class="form-group">
					<label>Duration :</label>
					<div class="row">
						<div class="col-6">
							<input type="date" name="sdate" id="sdate" class="form-control" 
							value="{{$dt['cdate']}}">
							<div style="color:red;">@error('sdate'){{ "The Start Date field is required" }} @enderror</div>		
						</div>
						<div class="col-6">
							<input type="date" name="edate" id="edate" class="form-control" 
							value="{{old('edate')}}">
							<div style="color:red;">@error('edate'){{ "The End Date field is required" }} @enderror</div>		
						</div>
					</div>
					
				</div>
				<div class="form-group">
					<label>Task Priority : </label>
					<select class="form-control" name="tpriority" id="tpriority" value="{{old('tpriority')}}">
						<option value="0">Select Priority</option>
						<option value="1" @if(old('tpriority')==1) {{ 'selected' }} @endif> High
						</option>
						<option value="2" @if(old('tpriority')==2) {{ 'selected' }} @endif> Medium
						</option>
						<option value="3" @if(old('tpriority')==3) {{ 'selected' }} @endif> Low
						</option>
					</select>
					<div style="color:red;">@error('tpriority'){{"The Task Priority field is required"}} @enderror</div>
				</div>
				<div class="form-group">
					<label>Assign To : </label>
					<select class="form-control" name="eid" id="eid" value="{{old('eid')}}">
						<option value="0">Select Team Member</option>
						@foreach($dt['member'] as $emp)
							<option value="{{$emp->eid}}" @if(old('eid')==$emp->eid) {{ 'selected' }} @endif>{{$emp->name}}</option>
						@endforeach
					</select>
					<div style="color:red;">@error('eid'){{"The Task Assign is required"}} @enderror
					</div>
				</div>
				<div class="form-group">
					<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
				</div>
			</form>
			@endforeach
		</div>
	</div>
</div>

<!-- formating Option style-start -->
<script src="https://cdn.tiny.cloud/1/9zugir2szpsndwtwtcja1ljr3g6xgiokyqw0xzbl507x804a/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>tinymce.init({selector:'textarea'});</script>
<!-- formating Option style-end -->

@endsection