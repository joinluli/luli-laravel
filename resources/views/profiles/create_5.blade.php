@extends('layouts.app')
@section('content')
<div class="container card">
	@foreach($errors->all() as $error)
		{!! $error !!}
	@endforeach
	<div class="col-sm-6 col-sm-offset-3">
		<h1 class="instruction">You're almost done. Please share some infor about your most recent work experience</h1>
		<div class="col-md-12">
			{!! Form::open(['url' => 'create_profile_5']) !!}

			<div class="form-group">
			{!! Form::label('title','Professional title', ['class' => 'display']) !!}
			{!! Form::text('title', '', ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
			{!! Form::label('place',"Place of employment", ['class' => 'display']) !!}
			{!! Form::text('place', '', ['class' => 'form-control']) !!}
			</div>

			<div class="row">
				<div class="form-group col-sm-6">
				{!! Form::label('start_date','Start date', ['class' => 'display']) !!}
				{!! Form::date('start_date', '', ['class' => 'form-control']) !!}
				</div>
				
				<div class="form-group col-sm-6">
				{!! Form::label('end_date','End date', ['class' => 'display']) !!}
				{!! Form::date('end_date', '', ['class' => 'form-control']) !!}
				</div>
			</div>
			<div class="col-sm-12 text-center">
				{!! Form::submit('Done', ['class' => 'btn button next']) !!}
			</div>
			{!! Form::close() !!}
			<div class="col-sm-12 text-center voffset-10">
				<a href="/my_profile">Skip</a>
			</div>
			<div class="col-sm-12 text-center voffset-10">
				<a href=""><img src="images/progress_5.png" class="progress-icon" alt=""></a>
			</div>
		</div>
	</div>
</div>
@endsection