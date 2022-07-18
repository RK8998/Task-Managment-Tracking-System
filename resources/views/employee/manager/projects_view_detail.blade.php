@extends('layouts_of_employee.master')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-10 nav-link">
				@foreach($detail['project'] as $project)
					<h2>Details of <a href="#" style="text-decoration:none;">{{ $project->pname }}</a>Project</h2>
				@endforeach
				</div>
				<div class="col-2">
					<a href="{{ url()->previous() }}" class="btn btn-primary" style="float:right;">
						<i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>	
				</div>
			</div>
			<hr>
			<div class="box_detail">

			@foreach($detail['project'] as $pro)
				@if($pro->priority == 1)
					<div class="btn btn-danger" style="cursor: context-menu;">High</div>
				@elseif($pro->priority == 2)
					<div class="btn btn-primary" style="cursor: context-menu;">Medium</div>
				@elseif($pro->priority == 3)
					<div class="btn btn-warning" style="cursor: context-menu;">Low</div>
				@endif
			@endforeach				
			<br><br>

			@foreach($detail['project'] as $project)
				<label>Project Name : </label>
				<input type="text" class="form-control" value="{{ $project->pname }}" disabled><br>
				<label>Project Type : </label>
				<input type="text" class="form-control" value="{{ $project->ptype }}" disabled><br>
			@endforeach


			@foreach($detail['project_ass'] as $pro)
				<label>Starting Date : </label>
				<input type="date" class="form-control" value="{{ $pro->sdate }}" disabled><br>
				<label>Due Date : </label>
				<input type="date" class="form-control" value="{{ $pro->edate }}" disabled><br>
			@endforeach


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