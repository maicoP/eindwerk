@extends('app')
@section('title')
	eindwerk|Home
@stop

@section('content')
	
	<header>
		<ul>
			<li>{!!Link_to('/auth/login','login')!!}</li>
			<li>Will jij jou kot in onze app {!!Link_to('/auth/register','registreer hier')!!}</li>
		</ul>
		
		
	</header>

	<div>
		<h1>Content</h1>
	</div>

@stop