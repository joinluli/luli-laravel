@extends('layouts.app')
@section('content')
	@foreach($errors->all() as $error)
		{!! $error !!}
	@endforeach
	<h1>You're almost done. Please share some infor about your most recent work experience</h1>
	<div class="col-md-6">
		{!! Form::open(['url' => 'create_profile_5']) !!}

		<div class="form-group">
		{!! Form::label('title','Professional title') !!}
		{!! Form::text('title', '', ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
		{!! Form::label('place',"Place of employment") !!}
		{!! Form::text('place', '', ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
		{!! Form::label('start_date','Start date') !!}
		{!! Form::date('start_date', '', ['class' => 'form-control']) !!}
		</div>
		
		<div class="form-group">
		{!! Form::label('end_date','End date') !!}
		{!! Form::date('end_date', '', ['class' => 'form-control']) !!}
		</div>

		{!! Form::submit('Done', ['class' => 'btn btn-default']) !!}
		
		{!! Form::close() !!}
		<a href="/create_3">Skip</a>
	</div>
@endsection