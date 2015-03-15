@extends('app')
@section('tile')
	Overzicht
@endsection
@section('content')
<div class="container-fluid">
	<div class="row">
		@foreach($kot->images as $image)
			<img src="{{URL::to('/').'/'.$image->image}}" alt="">
		@endforeach
		<div>
			{!!Form::open(['url' => 'kot/'.$kot->id.'/edit','method' => 'GET'])!!}
				{!!Form::submit('Edit',array('class' => 'btn btn-primary'))!!}
			{!!Form::close()!!}
			{!!Form::open(['url' => 'kot/'.$kot->id,'method' => 'DELETE'])!!}
				{!!Form::submit('Delete',array('class' => 'btn btn-danger'))!!}
			{!!Form::close()!!}
		</div>
		<div>
			<h2>Info</h2>
			<p>Price: €{{$kot->price}}</p>
			<p>Size: {{$kot->size}}</p>
			<p>Adres :  {{$kot->streatname}}  {{$kot->housenumber}} {{$kot->zipcode}} {{$kot->city}}</p>
			<p>beschikbaar van {{$kot->begindate}} tot {{$kot->enddate}}</p>
			<p>{{$kot->info}}</p>
			<p>{{($kot->bikestands ? 'Fietsenstalling' : '')}} {{($kot->seperatekitchen ? 'Aparte keuken' : '')}} {{($kot->seperatebathroom ? 'Aparte Badkamer' : '')}} {{($kot->furniture ? 'Bemeubeld' : '')}}</p>
			<h2>Contact</h2>
			<p>E-mai: {{$kot->email}}</p>
			<p>Telefoon nummer: {{$kot->telephonenumber}}</p>

		</div>
	</div>
</div>
@endsection
