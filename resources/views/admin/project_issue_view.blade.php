@extends('layouts_of_admin.master')

@section('content')

	<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-10 nav-link">
					@foreach($data['project'] as $pro)
					<h2>Issue of {{$pro->pname}} Project</h2>
					@endforeach	
				</div>
				<div class="col-2">
					<a href="{{ url()->previous() }}" class="btn btn-primary" style="float:right;">
						<i class="fas fa-arrow-circle-left"></i>&nbsp;&nbsp;Back</a>	
				</div>
			</div>
			<hr>
			<div class="box_detail">

				@foreach($data['issue'] as $issue)
					<div class="row">
						<div class="col-1">
							<b>{{$loop->iteration."."}}</b>
						</div>
						<div class="col-11">
							<div class="form-group">
								<textarea class="form-control" rows="4" disabled>{{$issue->issue}}
								</textarea>
								<!-- <span class="textarea" role="textbox" contenteditable>{{$issue->issue}}</span> -->
							</div>						
						</div>
					</div>
				@endforeach				

			</div>
		</div>
	</div>
</div>
@endsection