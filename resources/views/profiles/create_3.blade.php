@extends('layouts.app')
@section('content')
<div class="container card">
	<div class="col-sm-6 col-sm-offset-3">	
		<h1 class="instruction">Upload your picture so the world knows what you look like</h1>
		<div class="col-md-12 text-center">
			{!! Form::open(['url' => 'create_profile_3', 'files' => true]) !!}

			<div class="form-group">
			{!! Form::file('dp', ['class' => 'form-control']) !!}
			</div>
			<div class="col-sm-12 text-center">
				{!! Form::submit('Next', ['class' => 'btn button next']) !!}
			</div>
			{!! Form::close() !!}
			<a href="/create_profile_4" class="voffset-10">Skip</a>
			<div class="col-sm-12 text-center voffset-10">
				<a href=""><img src="images/progress_3.png" class="progress-icon" alt=""></a>
			</div>
		</div>
	</div>
</div>
@endsection