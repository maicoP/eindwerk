@extends('app')
@section('title')
	Home
@stop
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<a type="button" class="btn btn-primary" href='/kot/create'>Kot toevoegen</a>
		</div>
		<h1>U koten</h1>
		<div>
			@forelse($koten as $kot)
				<div>
				<a href="/kot/{{$kot->id}}">
					<div>
						{!!Form::open(['url' => 'kot/'.$kot->id.'/edit','method' => 'GET'])!!}
							{!!Form::submit('Edit',array('class' => 'btn btn-primary'))!!}
						{!!Form::close()!!}
						{!!Form::open(['url' => 'kot/'.$kot->id,'method' => 'DELETE'])!!}
							{!!Form::submit('Delete',array('class' => 'btn btn-danger'))!!}
						{!!Form::close()!!}
					</div>
						<img width="300px" src="{{URL::to('/').'/'.$kot->images[0]->image}}" alt="">
						<p>{{$kot->streatname}}  {{$kot->housenumber}} {{$kot->zipcode}} {{$kot->city}} </p>
						<p>€ {{$kot->price}}</p>
					</div>
				</a>
			@empty
			 <p>u hebt nog geen kotten toegevoegd</p>
			@endforelse
		</div>
	</div>
</div>
@endsection
