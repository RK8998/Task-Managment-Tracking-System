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
				@foreach($data['team'] as $team)
					<h3>Add Team Member In <a href="" style="text-decoration:none;">{{ $team->tname }}</a>
					</h3>	
				@endforeach
			</div>
			<div class="col-2">
				<a href="{{ url('team_view') }}" class="btn btn-primary">
				<i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>

				<!-- <a href="{{ url('dashboard') }}" class="btn" style="font-size:20px;">
				<i class="fas fa-times-circle"></i></a> -->
			</div>
		</div><hr>
		<form action="{{ url('store_team_member',[$team->tid]) }}" method="post">
			@csrf
			<br>
			<div class="row">
				<div class="col-10">
					<div class="form-group">
						<select class="form-control" name="team_member">
							<option value="0">Select Team Member</option>
							@foreach($data['emp'] as $emp)
								@if($emp->role == 3)
									@if($emp->status == 0)
										<option value="{{ $emp->eid }}">{{ $emp->name }}</option>
									@endif
								@endif
							@endforeach
						</select>	
					</div>
					<div style="color:red; margin-left: 3px;">
					@error('team_member'){{ 'Please select valid team member !' }} @enderror</div>
				</div>
				<div class="col-2">
					<div class="form-group">
						<button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i></button>
					</div>	
				</div>
			</div>
		</form>
		<br><br>
		@if(Session::get('success'))
			<span id="msg" class="alert alert-success">{{Session::get('success')}}
			</span><br><br>
		@endif
		@if(Session::get('fail'))
			<span id="msg" class="alert alert-danger">{{Session::get('fail')}}
			</span><br><br>
		@endif
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