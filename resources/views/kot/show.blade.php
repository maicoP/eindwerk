@extends('app')
@section('title')
	KOTTER - Kot detail
@stop
@section('content')
				<ul class="breadcrumb">
					<li>
						<i class="icon-home"></i>
						<a href="/kot">Home</a>
						<i class="icon-angle-right"></i> 
					</li>
					<li><a href="#">Kot detail</a></li>
				</ul>
				<div class="row-fluid sortable">
					<h1>Kot detail: {{$kot->streatname}}  {{$kot->housenumber}} {{$kot->zipcode}} {{$kot->city}}</h1>		
					<div class="top_spacing">	
						<div>
							{!!Form::open(['url' => 'kot/'.$kot->id.'/edit','method' => 'GET','class' => 'frm-edit_delete'])!!}
								{!!Form::submit('Edit',array('class' => 'btn btn-primary btn-edit_delete'))!!}
							{!!Form::close()!!}
							<button type="button" class="btn btn-danger btn-edit_delete" data-toggle="popover" data-placement="top" title="Bent u zeker dat u dit kot wild deleten" data-content="<input class='btn btn-danger btn-block' type='submit' value='Bevestigen' onclick='deleteKot({{$kot->id}})'>">Delete</button>							
						</div>
						@foreach($kot->images as $image)
							<img src="{{URL::to('/').'/'.$image->image}}" width="350" alt="">
						@endforeach
						<div>
							<h2>Info</h2>
							<p>Prijs (€): <b>{{$kot->price}}</b></p>
							<p>Oppervlakte (m²): <b>{{$kot->size}}</b></p>
							<p>Adres: <b>{{$kot->streatname}}  {{$kot->housenumber}} {{$kot->zipcode}} {{$kot->city}}</b></p>
							<p>Beschikbaar van <b>{{$kot->begindate}}</b> tot <b>{{$kot->enddate}}</b></p>
							<p>Beschrijving / Info: <b>{{$kot->info}}</b></p>
							<h2>Opties</h2>
							<ul> 				
								@if($kot->bikestands)
									<li>Fietsenstalling</li> 
								@endif
								@if($kot->seperatekitchen)
									<li>Aparte keuken</li>
								@endif
								@if($kot->seperatebathroom) 
									<li>Aparte Badkamer</li>
								@endif
								@if($kot->furniture)
									<li>Bemeubeld</li>
								@endif
							</ul>
							<h2>Contact</h2>
							<p>Naam: <b>{{$kot->name}}</b></p>
							<p>E-mail: <b>{{$kot->email}}</b></p>
							<p>Telefoonnummer: <b>{{$kot->telephonenumber}}</b></p>
						</div>
					</div>
				</div>
			</div><!--end content-->
		</div><!--end row fluid-->
	</div><!--end container fluid-->
@endsection