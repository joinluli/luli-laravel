@extends('layouts.app')
@section('content')
<div class="container card">
	<div class="col-sm-6 col-sm-offset-3">
		<h1 class="instruction">Hello, let's get started by setting your unique username.</h1>
		@foreach($errors->all() as $error)
			{{ $error }}
		@endforeach
		{!! Form::open(['url' => 'create_social']) !!}
		<div class="form-group col-sm-12">
			{!! Form::label('username','Username', ['class' => 'display']) !!}
			{!! Form::text('username', $username, ['class' => 'form-control', 'required' => 'true']) !!}
		</div>
		<br><br>
		<div class="col-sm-12 text-center">
			{!! Form::submit('Next',['class' => 'btn button next']) !!}
		</div>

		{!! Form::close() !!}
		<br><br>
	</div>
</div>
@endsection