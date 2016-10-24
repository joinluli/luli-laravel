@extends('layouts.app')
@section('content')
<div class="container card">
		@foreach($errors->all() as $error)
			{!! $error !!}
		@endforeach
		<div class="col-sm-6 col-sm-offset-3">
			<h1 class="instruction">Upload up to 9 photos of your best work. Remember, quality photos are the best way to show off your work.</h1>
			<div class="col-md-12">
				{!! Form::open(['url' => 'create_profile_4', 'files' => true]) !!}

				<div class="form-group">
				{!! Form::file('images[]', ['multiple' => true, 'class' => 'form-control']) !!}
				</div>
				<div class="col-sm-12 text-center">
					{!! Form::submit('Next',['class' => 'btn button next']) !!}
				</div>
				{!! Form::close() !!}
				<div class="col-sm-12 text-center">
					<a href="/create_profile_5">Skip</a>
				</div>
				<div class="col-sm-12 text-center voffset-10">
					<a href=""><img src="images/progress_4.png" class="progress-icon" alt=""></a>
				</div>
			</div>
		</div>
</div>
@endsection