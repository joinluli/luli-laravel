@extends('layouts.app')
@section('content')
	@foreach($errors->all() as $error)
		{!! $error !!}
	@endforeach
	<h1>Upload up to 9 photos of your best work. Remember, quality photos are the best way to show off your work.</h1>
	<div class="col-md-6">
		{!! Form::open(['url' => 'create_profile_4', 'files' => true]) !!}

		<div class="form-group">
		{!! Form::file('images[]', ['multiple' => true, 'class' => 'form-control']) !!}
		</div>

		{!! Form::submit('Next', ['class' => 'btn btn-default']) !!}
		
		{!! Form::close() !!}
		<a href="/create_5">Skip</a>
	</div>
@endsection