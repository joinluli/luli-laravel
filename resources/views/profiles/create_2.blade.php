@extends('layouts.app')
@section('content')
	<h1>Lets get to know you some more</h1>
	<div class="col-md-6">
		{!! Form::open(['url' => 'create_profile_2']) !!}

		<div class="form-group">
		{!! Form::label('about_1','What are you most proud of?') !!}
		{!! Form::textarea('about_1', '', ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
		{!! Form::label('about_2',"I'm currently obsessed with...") !!}
		{!! Form::textarea('about_2', '', ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
		{!! Form::label('about_3','In a sentence, how would your colleagues descibe you?') !!}
		{!! Form::textarea('about_3', '', ['class' => 'form-control']) !!}
		</div>

		{!! Form::submit('Next', ['class' => 'btn btn-default']) !!}
		
		{!! Form::close() !!}
		<a href="/create_3">Skip</a>
	</div>
@endsection