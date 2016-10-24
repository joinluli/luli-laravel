@extends('layouts.app')
@section('content')
	<div class="container card">
		
		<div class="col-sm-6 col-sm-offset-3">
		<h1 class="instruction">Hello, <br> let's start with the basics</h1>
		{!! Form::open(['url' => 'create_profile_1', 'class' => 'form']) !!}
		<div class="form-group col-sm-6">
			{!! Form::label('first_name','First Name', ['class' => 'display']) !!}
			{!! Form::text('first_name', $first_name, ['class' => 'form-control', 'required' => 'true']) !!}
		</div>
		<div class="form-group col-sm-6">
			{!! Form::label('last_name','Last Name', ['class' => 'display']) !!}
			{!! Form::text('last_name', $last_name, ['class' => 'form-control', 'required' => 'true']) !!}
		</div>

		<div class="form-group col-sm-12">
			{!! Form::label('speciality','Speciality', ['class' => 'display']) !!}
			{!! Form::text('speciality', '', ['class' => 'form-control', 'required' => 'true']) !!}
		</div>
		
		<div class="form-group col-sm-12">
			{!! Form::label('city','City', ['class' => 'display']) !!}
			{!! Form::text('city', '', ['class' => 'form-control', 'id' => 'autocomplete']) !!}
		</div>
		
		<div class="form-group">
		<div class="col-sm-12 text-center">
			{!! Form::submit('Next',['class' => 'btn button next']) !!}
		</div>
		</div>

		{!! Form::close() !!}
		<div class="col-sm-12 text-center">
			<a href=""><img src="images/progress_1.png" class="progress-icon" alt=""></a>
		</div>
		</div>
	</div>
	<script>
		$( "#autocomplete" ).autocomplete({
		  source: {!! $city !!}
		});
	</script>
@endsection