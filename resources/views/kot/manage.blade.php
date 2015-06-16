@extends('app')
@section('title')
	KOTTER - Kot toevoegen
@stop
@section('content')
				<ul class="breadcrumb">
					<li>
						<i class="icon-home"></i>
						<a href="/kot">Home</a>
						<i class="icon-angle-right"></i> 
					</li>
					<li><a href="#">Koten beheer</a></li>
				</ul>
				<h1>Nieuwe kotten</h1>
				<table class="table table-striped">
				  <tr>
				  	<th>link</th>
				  	<th>Adres</th>
				  	<th>Gebruiker</th>
				  	<th></th>
				  	<th></th>
				  </tr>
				  @foreach($kotenNew as $kot)
				  <tr>
				  	<td><a href="/kot/{{$kot->id}}">bekijken</a></td>
				  	<td>{{$kot->streatname.' '.$kot->housenumber.' '.$kot->city.' '.$kot->zipcode}}</td>
				  	<td>{{$kot->user->name}}</td>
				  	<td><a href="/accept/kot/{{$kot->id}}">toevoegen</a></td>
				  	<td><a href="/decline/kot/{{$kot->id}}">wijgeren</a></td>
				  </tr>
				  @endforeach
				</table>
				@if(!$kotenNew->isEmpty())
					{!!$kotenNew->render()!!}
				@endif	
				<h1>Geaccepteerde kotten</h1>
				<table class="table table-striped">
				  <tr>
				  	<th>link</th>
				  	<th>Adres</th>
				  	<th>Gebruiker</th>
				  	<th></th>
				  </tr>
				  @foreach($kotenAc as $kot)
				  <tr>
				  	<td><a href="/kot/{{$kot->id}}">bekijken</a></td>
				  	<td>{{$kot->streatname.' '.$kot->housenumber.' '.$kot->city.' '.$kot->zipcode}}</td>
				  	<td>{{$kot->user->name}}</td>
				  	<td><a href="/decline/kot/{{$kot->id}}">wijgeren</a></td>
				  </tr>
				  @endforeach
				</table>
				@if(!$kotenAc->isEmpty())
					{!!$kotenAc->render()!!}
				@endif
				<h1>Geweigerde kotten</h1>
				<table class="table table-striped">
				  <tr>
				  	<th>link</th>
				  	<th>Adres</th>
				  	<th>Gebruiker</th>
				  	<th></th>
				  </tr>
				  @foreach($kotenDe as $kot)
				  <tr>
				  	<td><a href="/kot/{{$kot->id}}">bekijken</a></td>
				  	<td>{{$kot->streatname.' '.$kot->housenumber.' '.$kot->city.' '.$kot->zipcode}}</td>
				  	<td>{{$kot->user->name}}</td>
				  	<td><a href="/accept/kot/{{$kot->id}}">toevoegen</a></td>
				  </tr>
				  @endforeach
				</table>
				@if(!$kotenDe->isEmpty())
					{!!$kotenDe->render()!!}
				@endif
			</div><!--end content-->
		</div><!--end row fluid-->
	</div><!--end container fluid-->

@endsection
