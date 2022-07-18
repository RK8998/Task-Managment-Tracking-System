
 @extends('layouts_of_admin.master')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-6">
					@foreach($detail['project'] as $project)
						<h2>Update {{$project->pname}} Project</h2>		
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
				<div class="col-2">
					<a href="{{ url()->previous() }}" class="btn btn-primary" style="float:right;">
						<i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>	
				</div>
			</div>
			<hr>
			@foreach($detail['project'] as $project)
			<form action="{{url('update_project',[$project->pid])}}" method="get" enctype="multipart/form-data">
				@csrf
				<!-- <div class="form-group">
					<label>&nbsp;Project ID : </label>
					<input type="text" name="pid" id="pid" class="form-control" value="{{old('pid')}}" disabled>
					<div style="color:red;">@error('pid'){{$message}} @enderror</div>
				</div> -->
				<input type="hidden" name="epid" value="{{$project->pid}}">
				<div class="form-group">
					<label>&nbsp;Project Name : </label>
					<input type="text" name="epname" id="epname" class="form-control" 
					placeholder="Enter Project Name" value="{{ $project->pname }}">
					<div style="color:red;">@error('epname'){{'The Project Name field is required'}} @enderror</div>
				</div>
				<div class="form-group">
					<label>Project Type:</label>
					<input type="text" name="eptype" id="eptype" class="form-control" 
					placeholder="Enter Project Type " value="{{$project->ptype}}">
					<div style="color:red;">@error('eptype'){{'The Project Type field is required'}} @enderror</div>
				</div>
				<div class="form-group">
					<label>&nbsp;Description : </label>
					<textarea name="epdec" rows="6" cols="35">{{$project->pdec}}</textarea>
					<div style="color:red;">@error('epdec'){{'The Project Description field is required'}} @enderror</div>
				</div>
				<div class="form-group">
					<label>Create Date :</label>
					<input type="date" name="ecdate" id="ecdate" class="form-control" value="{{$project->cdate}}">
					<div style="color:red;">@error('ecdate'){{ "The Create Date field is required" }} @enderror</div>
				</div>
				<div class="form-group">
					<label>Project Priority : </label>
					<select class="form-control" name="epriority" id="epriority" value="{{$project->priority}}">
						<option value="0">Select Priority</option>
						<option value="1" @if($project->priority==1) {{ 'selected' }} @endif> High</option>
						<option value="2" @if($project->priority==2) {{ 'selected' }} @endif> Medium</option>
						<option value="3" @if($project->priority==3) {{ 'selected' }} @endif> Low</option>
					</select>
					<div style="color:red;">@error('epriority'){{$message}} @enderror</div>
				</div>
				

				@if($detail['pro_ass']->isNotEmpty())
					@foreach($detail['pro_ass'] as $pro)	
						
						<label>Assigned To : </label>
						<select class="form-control" name="eeid" id="eeid" value="{{$pro->eid}}">
							<option value="0">Select Task Manager</option>
							@foreach($detail['emp'] as $emp)
								<option @if($emp->eid==$pro->eid) {{ 'selected' }} @endif value="{{$emp->eid}}">{{$emp->name}}</option>
							@endforeach
						</select>
						<div style="color:red;">@error('eeid'){{"The Task Manager field is required."}} @enderror
						</div>
						
					@endforeach
					<br/>
					@foreach($detail['pro_ass'] as $pro)
						<label>Starting Date : </label>
						<input type="date" name="esdate" class="form-control" value="{{ $pro->sdate }}">
						<div style="color:red;">@error('esdate'){{"The Starting Date field is required."}} @enderror</div><br>
						<label>Due Date : </label>
						<input type="date" name="eedate" class="form-control" value="{{ $pro->edate }}">
						<div style="color:red;">@error('eedate'){{"The Ending Date field is required."}} @enderror</div><br>
					@endforeach
				@endif

				<div class="form-group">
					<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Update">
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

<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready( function() {
		$('#msg').delay(2000).fadeOut();
    });
</script> -->

@endsection