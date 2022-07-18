<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TMT | Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
rel="stylesheet" 
integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
crossorigin="anonymous">

<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

</head>
<body>
	<div class="container">
		<br>
		<div class="row">
			<div class="col-10">
				<h2>Assign Project to Task Manager</h2>
			</div>
			<div class="col-2">
				<a href="{{ url('project_view') }}" class="btn btn-primary">
				<i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>
			</div>
		</div><hr>
		<form action="{{ url('add_project_assign',[$data['project']]) }}" method="post">
			@csrf
			<br>
			<div class="form-group">
				<label><b>Select Task Manager : </b></label><br>
				<select class="form-control" name="eid">
					<option value="0">Select Task Manager</option>
					@foreach($data['emp'] as $emp)
						<option value="{{ $emp->eid }}">{{ $emp->name }}</option>
					@endforeach
				</select>	
				<div style="color:red; margin-left: 3px;">
				@error('eid'){{ 'Please select valid Task Manager !' }} @enderror</div>
			</div>
			<br/>
			<div class="form-group">
				<label><b>Starting Date : </b></label><br>
				<input type="date" name="sdate" id="sdate" class="form-control">
				<div style="color:red; margin-left: 3px;">
				@error('sdate'){{ 'The Starting Date field is required' }} @enderror</div>
			</div><br/>
			<div class="form-group">
				<label><b>Due Date : </b></label><br>
				<input type="date" name="edate" id="edate" class="form-control">
				<div style="color:red; margin-left: 3px;">
				@error('edate'){{ 'The Ending Date field is required' }} @enderror</div>
			</div><br>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Assign</button>
			</div>	
		</form>
		<br><br>
	</div>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
		 $(document).ready( function() {
	      $('#msg').delay(2000).fadeOut();
	    });
	</script>
	
</body>
</html>