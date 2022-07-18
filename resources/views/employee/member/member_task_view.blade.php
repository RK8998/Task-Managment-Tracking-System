@extends('layouts_of_employee.master')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-10 nav-link">
					<h2 style="color:black;">Detail's of Task</h2>
				</div>
				<div class="col-2">
					<a href="{{ url()->previous() }}" class="btn btn-primary" 
					style="float:right;"><i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;
					Back</a>	
				</div>
			</div>
			<hr>
			<div class="box_detail">

			@foreach($detail as $task)
				@if($task->status == 1)
					<div class="btn btn-danger">To Do</div>
				@elseif($task->status == 2)
					<div class="btn btn-info">Start</div>
				@elseif($task->status == 3)
					<div class="btn btn-warning">Stop</div>
				@elseif($task->status == 4)
					<div class="btn btn-success">Complete</div>
				@endif
				<br><br>
				<label>Task : </label>
				<input type="text" class="form-control" value="{{ $task->tname }}" disabled><br>
				<label>Task Priority: </label>
				@if($task->tpriority == 1)
					<input type="text" class="form-control" value="{{'High'}}" disabled><br>
				@elseif($task->tpriority == 2)
					<input type="text" class="form-control" value="{{'Medium'}}" disabled><br>
				@elseif($task->tpriority == 3)
					<input type="text" class="form-control" value="{{'Low'}}" disabled><br>
				@endif
				<label>Start Date : </label>
				<input type="date" class="form-control" value="{{ $task->sdate }}" disabled><br>
				<label>Due Date : </label>
				<input type="date" class="form-control" value="{{ $task->edate }}" disabled><br>
				<label>Description : </label>
				@php $dec =  strip_tags($task->tdec) @endphp
				<textarea class="form-control" disabled rows="5">{{ $dec }}</textarea>
				<br>
			@endforeach				
			</div>
		</div>
	</div>
</div>
@endsection