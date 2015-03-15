@extends('layouts')
@section('title')
	Register
@stop

@section('content')

	{!!Form::open(['route' => 'user.store','method' =>'POST'])!!}
		
		@foreach ($errors->all() as $error)
			<li>{{$error}}</li>
		@endforeach
		<div>
			{!!Form::label('test')!!}
			{!!Form::input('text','test')!!}
		</div>
		
		{!!Form::submit('verzenden')!!}
	{!!Form::close()!!}

@stop