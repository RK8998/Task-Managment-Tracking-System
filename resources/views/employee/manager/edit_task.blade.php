@extends('layouts_of_employee.master')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-10 nav-link">
					<h2 style="color:black;">Update Task</h2>
				</div>
				<div class="col-2">
					<a href="{{ url()->previous() }}" class="btn btn-primary" 
					style="float:right;"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;
					Back</a>	
				</div>
			</div>
			<hr>
			<div class="box_detail">
			@foreach($data['task'] as $task)
			<form action="{{url('update_task',[$task->tid])}}" method="post">
				@csrf
				<div class="form-group">
					<label>Task : </label>
					<input type="text" class="form-control" value="{{ $task->tname }}" name="etname">
					<div style="color:red;">@error('etname'){{'The Task field is required.'}}@enderror
					</div>
				</div>
				<div class="form-group">
					<label>Task Priority: </label>
					<select class="form-control" name="etpriority" value="{{$task->tpriority}}">
						<option value="0">Select Status</option>
						<option value="1" @if($task->tpriority == 1) {{'selected'}} @endif>High
						</option>
						<option value="2" @if($task->tpriority == 2) {{'selected'}} @endif>Medium
						</option>
						<option value="3" @if($task->tpriority == 3) {{'selected'}} @endif>Low</option>
					</select>
					<div style="color:red;">@error('etpriority'){{'The Task Priority field is required.'}}@enderror
					</div>
				</div>

				<div class="form-group">
					<label>Start Date : </label>
					<input type="date" class="form-control" name="esdate" value="{{ $task->sdate }}">
					<div style="color:red;">@error('esdate'){{'The Start Date is required.'}}@enderror
					</div>
				</div>
				<div class="form-group">
					<label>Due Date : </label>
					<input type="date" class="form-control" name="eedate" value="{{ $task->edate }}">
					<div style="color:red;">@error('esdate'){{'The End Date is required.'}}@enderror
					</div>
				</div>
				<div class="form-group">
					<label>Description : </label>
					<textarea class="form-control" rows="5" name="etdec">{{ $task->tdec }}</textarea>
					<div style="color:red;">@error('esdate'){{'The Description field is required.'}}@enderror
					</div>
				</div>
				<div class="form-group">
					<label>Assigned To : </label>
					<select class="form-control" name="eeid" value="{{$task->eid}}">
						<option value="0">Select Team Member</option>
						@foreach($data['member'] as $emp)
							<option value="{{$emp->eid}}" 
								@if($task->eid == $emp->eid) {{'selected'}} @endif>{{$emp->name}}
							</option>
						@endforeach
					</select>
					<div style="color:red;">@error('etpriority'){{'The Member field is required.'}}@enderror
					</div>
				</div>
				<div class="form-group">
					<input type="submit" name="update" value="Update" class="btn btn-primary">
				</div>
			</form>
			@endforeach				
		</div>
	</div>
</div>
@endsection