@extends('app')
@section('title')
	KOTTER - Kot detail
@stop
@section('content')

<li><a href="#">Kot toevoegen</a></li>
				</ul>
			
				<div class="row-fluid sortable">
					
					<h1>Kot detail: {{$kot->streatname}}  {{$kot->housenumber}} {{$kot->zipcode}} {{$kot->city}}</h1>
					
					<div class="top_spacing">
					<div>
						{!!Form::open(['url' => 'kot/'.$kot->id.'/edit','method' => 'GET','class' => 'frm-edit_delete'])!!}
							{!!Form::submit('Edit',array('class' => 'btn btn-primary btn-edit_delete'))!!}
						{!!Form::close()!!}
						{!!Form::open(['url' => 'kot/'.$kot->id,'method' => 'DELETE'])!!}
							{!!Form::submit('Delete',array('class' => 'btn btn-danger btn-edit_delete'))!!}
						{!!Form::close()!!}							
					</div>


<div class="container-fluid">
	<div class="row">
		@foreach($kot->images as $image)
			<img src="{{URL::to('/').'/'.$image->image}}" width="350" alt="">
		@endforeach
		<div>

		</div>
		<div>
			<h2>Info</h2>
			<p>Prijs (€): <b>{{$kot->price}}</b></p>
			<p>Oppervlakte (m²): <b>{{$kot->size}}</b></p>
			<p>Adres: <b>{{$kot->streatname}}  {{$kot->housenumber}} {{$kot->zipcode}} {{$kot->city}}</b></p>
			<p>Beschikbaar van <b>{{$kot->begindate}}</b> tot <b>{{$kot->enddate}}</b></p>
			<p>Beschrijving / Info: <b>{{$kot->info}}</b></p>
			<h2>Opties</h2>
			<ul>
				<li>{{($kot->bikestands ? 'Fietsenstalling' : '')}}</li> 
				<li>{{($kot->seperatekitchen ? 'Aparte keuken' : '')}}</li> 
				<li>{{($kot->seperatebathroom ? 'Aparte Badkamer' : '')}}</li>
				<li>{{($kot->furniture ? 'Bemeubeld' : '')}}</li>
			</ul>
			<h2>Contact</h2>
			<p>E-mail: <b>{{$kot->email}}</b></p>
			<p>Telefoonnummer: <b>{{$kot->telephonenumber}}</b></p>

		</div>
	</div>
</div>


					</div><!--end top spacing-->
				</div><!--end row fluid-->
			</div><!--end content-->
		</div><!--end row fluid-->
	</div><!--end container fluid-->

@endsection
