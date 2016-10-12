@extends('layouts.app')
@section('content')
	<h1>Hello, let's start with the basics</h1>
	{!! Form::open(['url' => 'create_profile_1']) !!}

	{!! Form::label('first_name','First Name') !!}
	{!! Form::text('first_name', $first_name, ['class' => 'form-input']) !!}
	<br><br>
	{!! Form::label('last_name','Last Name') !!}
	{!! Form::text('last_name', $last_name, ['class' => 'form-input']) !!}
	<br><br>
	{!! Form::label('speciality','Speciality') !!}
	{!! Form::text('speciality', '', ['class' => 'form-input']) !!}
	<br><br>
	{!! Form::label('city','City') !!}
	{!! Form::text('city', '', ['class' => 'form-input', 'id' => 'autocomplete']) !!}
	<br><br>

	{!! Form::submit('Next') !!}

	{!! Form::close() !!}
	<br><br>

	{{ $city }}

	<script>
$( "#autocomplete" ).autocomplete({
  source: {!! $city !!}
});
</script>
@endsection