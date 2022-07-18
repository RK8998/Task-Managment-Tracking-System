@extends('layouts_of_employee.master')

@section('content')

<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-5">
					<h2>Create issue</h2>					
				</div>
				<div class="col-5">
					@if(Session::get('success'))
						<span id="msg" class="alert alert-success">{{Session::get('success')}}
						</span><br><br>
					@endif
					@if(Session::get('fail'))
						<span id="msg" class="alert alert-danger">{{Session::get('fail')}}
						</span><br><br>
					@endif					
				</div>
				<div class="col-2">
					<a href="{{ url('taskmanager_projects') }}" class="btn btn-primary" 
					style="float:right;">
						<i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>	
				</div>
			</div>
			<hr>
			
			@foreach($data['issue'] as $issue)
				<form action="{{  url('edit_project_issue',[$issue->psid]) }}" method="post">
					@csrf
					<div class="row">
						<div class="col-1">
							<b>{{$loop->iteration}}</b>
						</div>
						<div class="col-9">
							<div class="form-group">
								<textarea class="form-control" name="eissue" rows=5>{{$issue->issue}}
								</textarea>
							</div>							
						</div>
						<div class="col-2">
							<div class="form-group">
								<button class="btn btn-success" type="Submit"><i class="fas fa-edit">
								</i></button>
								<a href="{{url('delete_project_issue',[$issue->psid])}}"
								class="btn btn-danger">
									<i class="fas fa-trash-alt"></i>
								</a>
							</div>	
						</div>
					</div>
				</form>
			@endforeach
			<hr>
			<form action="{{url('add_project_issue',[$data['pid']])}}" method="post">
				@csrf
				<label>Create New Issue : </label>
				<div class="row">
					<div class="col-10">
						<div class="form-group">
							<textarea placeholder="Type here..." name="issue" rows="5" id="issue" 
								class="form-control">
							</textarea>
							<div style="color:red;">@error('issue')
							{{'The Description field is required'}} @enderror</div>
						</div>		
					</div>
					<div class="col-2">
						<div class="form-group">
							<button class="btn btn-primary" type="Submit"><i class="fas fa-plus">
							</i></button>
						</div>	
					</div>
				</div>
			 </form>
		</div>
	</div>
</div>

@endsection