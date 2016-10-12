@extends('layouts.app')
@section('content')
	<h1>Hello, let's get started by setting your unique username.</h1>
	@foreach($errors->all() as $error)
		{{ $error }}
	@endforeach
	{!! Form::open(['url' => 'create_social']) !!}

	{!! Form::label('username','Username') !!}
	{!! Form::text('username', $username, ['class' => 'form-input']) !!}
	<br><br>

	{!! Form::submit('Next') !!}

	{!! Form::close() !!}
	<br><br>
</script>
@endsection