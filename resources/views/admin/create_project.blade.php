 @extends('layouts_of_admin.master')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-6">
					<h2>Create Project</h2>					
				</div>
				<div class="col-6">
					@if(Session::get('success'))
						<span id="msg" class="alert alert-success">{{Session::get('success')}}
						</span><br><br>
					@endif
					@if(Session::get('fail'))
						<span id="msg" class="alert alert-danger">{{Session::get('fail')}}
						</span><br><br>
					@endif					
				</div>
			</div>
			<hr>
			<form action="{{url('add_project')}}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label>&nbsp;Project ID : </label>
					<input type="text" name="pkey" id="pkey" class="form-control" value="{{$dt['pkey']}}"
					autocomplete="off">
					<div style="color:red;">@error('pkey'){{'The Project Key Do Not Change.'}} @enderror</div>
				</div>
				<div class="form-group">
					<label>&nbsp;Project Name : </label>
					<input type="text" name="pname" id="pname" class="form-control" 
					placeholder="Enter Project Name" value="{{old('pname')}}">
					<div style="color:red;">@error('pname'){{'The Project Name field is required'}} @enderror</div>
				</div>
				<div class="form-group">
					<label>Project Type:</label>
					<input type="text" name="ptype" id="ptype" class="form-control" 
					placeholder="Enter Project Type " value="{{old('ptype')}}">
					<div style="color:red;">@error('ptype'){{'The Project Type field is required'}} @enderror</div>
				</div>
				<div class="form-group">
					<label>&nbsp;Description : </label>
					<textarea name="pdec" rows="10" cols="35"></textarea>
					<div style="color:red;">@error('pdec'){{'The Project Description field is required'}} @enderror</div>
				</div>
				<div class="form-group">
					<label>Create Date :</label>
					<input type="date" name="cdate" id="cdate" class="form-control" value="{{$dt['cdate']}}">
					<div style="color:red;">@error('cdate'){{ "The Create Date field is required" }} @enderror</div>
				</div>
				<div class="form-group">
					<label>Project Priority : </label>
					<select class="form-control" name="priority" id="priority" value="{{old('priority')}}">
						<option value="0">Select Priority</option>
						<option value="1" @if(old('priority')==1) {{ 'selected' }} @endif> High</option>
						<option value="2" @if(old('priority')==2) {{ 'selected' }} @endif> Medium</option>
						<option value="3" @if(old('priority')==3) {{ 'selected' }} @endif> Low</option>
					</select>
					<div style="color:red;">@error('priority'){{$message}} @enderror</div>
				</div>
				<br>	
				<div class="form-group">
					<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
				</div>
			</form>
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