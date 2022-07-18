@extends('layouts_of_admin.master')

@section('content')

	<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-10 nav-link">
				@foreach($detail['project'] as $project)
					<h2>Details of <a href="" style="text-decoration:none;">{{ $project->pname }}</a> Project</h2>
				@endforeach
				</div>
				<div class="col-2">
					<a href="{{ url()->previous() }}" class="btn btn-primary" style="float:right;">
						<i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>	
				</div>
			</div>
			<hr>
			<div class="box_detail">

			@if($detail['pro_ass']->isNotEmpty())
				@foreach($detail['pro_ass'] as $pro)
					@if($pro->status == 1)
						<div class="btn btn-danger" style="cursor: context-menu;">To Do</div>
					@elseif($pro->status == 2)
						<div class="btn btn-info" style="cursor: context-menu;">In Progress</div>
					@elseif($pro->status == 3)
						<div class="btn btn-success" style="cursor: context-menu;">Done</div>
					@endif
				@endforeach				
				<br><br>
			@endif

			@foreach($detail['project'] as $project)
				<label>Project ID : </label>
				<input type="text" class="form-control" value="{{ $project->pkey }}" disabled><br>
				<label>Project Name : </label>
				<input type="text" class="form-control" value="{{ $project->pname }}" disabled><br>
				<label>Project Type : </label>
				<input type="text" class="form-control" value="{{ $project->ptype }}" disabled><br>
				<label>Create Date : </label>
				<input type="date" class="form-control" value="{{ $project->cdate }}" disabled><br>
				<label>Priority : </label>
				@if($project->priority == 1)
					<input type="text" class="form-control" value="High" disabled>
				@elseif($project->priority == 2)
					<input type="text" class="form-control" value="Medium" disabled>
				@elseif($project->priority == 3)
					<input type="text" class="form-control" value="Low" disabled>
				@endif
				<br>
			@endforeach

			@if($detail['pro_ass']->isNotEmpty())
				@foreach($detail['emp'] as $emp)
					<label>Assigned To : </label>
					<input type="text" class="form-control" value="{{ $emp->name }}" disabled><br>
					<label>Username : </label>
					<input type="text" class="form-control" value="{{ $emp->username }}" disabled><br>
				@endforeach

				@foreach($detail['pro_ass'] as $pro)
					<label>Starting Date : </label>
					<input type="date" class="form-control" value="{{ $pro->sdate }}" disabled><br>
					<label>Due Date : </label>
					<input type="date" class="form-control" value="{{ $pro->edate }}" disabled><br>
				@endforeach
			@endif

			@foreach($detail['project'] as $project)
				<label>Description : </label>
				@php $dec =  strip_tags($project->pdec) @endphp
				<textarea class="form-control" disabled rows="5">{{ $dec }}</textarea>
				<br>
			@endforeach
			</div>
		</div>
	</div>
</div>
@endsection