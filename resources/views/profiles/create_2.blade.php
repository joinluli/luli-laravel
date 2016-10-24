@extends('layouts.app')
@section('content')
<div class="container card">
	<div class="col-sm-6 col-sm-offset-3">
		<h1 class="instruction">Lets get to know you some more</h1>
		<div class="col-md-12">
			{!! Form::open(['url' => 'create_profile_2']) !!}

			<div class="form-group col-sm-12">
			{!! Form::label('about_1','What are you most proud of?', ['class' => 'display']) !!}
			{!! Form::textarea('about_1', '', ['class' => 'form-control', 'rows' => '3', 'cols' => '60']) !!}
			</div>
			<div class="form-group col-sm-12">
			{!! Form::label('about_2',"I'm currently obsessed with...", ['class' => 'display']) !!}
			{!! Form::textarea('about_2', '', ['class' => 'form-control', 'rows' => '3', 'cols' => '60']) !!}
			</div>
			<div class="form-group col-sm-12">
			{!! Form::label('about_3','In a sentence, how would your colleagues descibe you?', ['class' => 'display']) !!}
			{!! Form::textarea('about_3', '', ['class' => 'form-control', 'rows' => '3', 'cols' => '60']) !!}
			</div>
			<div class="col-sm-12 text-center">
				{!! Form::submit('Next', ['class' => 'btn button next']) !!}
			</div>
			{!! Form::close() !!}
			<div class="col-sm-12 text-center">
				<a href="/create_profile_3">Skip</a>
			</div> 
			<div class="col-sm-12 text-center voffset-10">
				<a href=""><img src="images/progress_2.png" class="progress-icon" alt=""></a>
			</div>
		</div>
	</div>
</div>
@endsection