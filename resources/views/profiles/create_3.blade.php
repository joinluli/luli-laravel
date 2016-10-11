@extends('layouts.app')
@section('content')
	<h1>Upload your picture so the world knows what you look like</h1>
	<div class="col-md-6">
		{!! Form::open(['url' => 'create_profile_3', 'files' => true]) !!}

		<div class="form-group">
		{!! Form::file('dp', ['class' => 'form-control']) !!}
		</div>

		{!! Form::submit('Next', ['class' => 'btn btn-default']) !!}
		
		{!! Form::close() !!}
		<a href="/create_4">Skip</a>
	</div>
@endsection