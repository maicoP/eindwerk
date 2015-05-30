@extends('app')
@section('title')
	KOTTER - Overzicht koten
@stop
@section('content')
				<ul class="breadcrumb">
					<li>
						<i class="icon-home"></i>
						<a href="/kot">Home</a>
						<i class="icon-angle-right"></i> 
					</li>
					<li><a href="#">Koten overzicht</a></li>
				</ul>

				<div class="row-fluid">
					<div class="span13">
						
						<h1>Alle toegevoegde koten</h1>
						@if($koten->isEmpty() && $new->isEmpty() && $declined->isEmpty())
							<p><br>Er zijn geen koten beschikbaar omdat u er nog geen heeft toegevoegd.</p>
			  				<p>Een kot toevoegen doet u via de knop "<b>Kot toevoegen</b>" in de balk links opzij.</p>

			  				<p>Voor meer hulp en informatie navigeert u naar het menu "<b>Help</b>".</p>
						@endif
						
			@if(!$koten->isEmpty())
				<div class="status approved top_spacing"><span>Koten in het systeem</span></div>
			@endif
			@foreach($koten as $kot)
						
						<div class="kot approved">
							<div class="info">
								<a href="/kot/{{$kot->id}}"><div class="title">{{$kot->streatname}}  {{$kot->housenumber}} {{$kot->zipcode}} {{$kot->city}}</div>
								<div><img width="300" src="{{URL::to('/').'/'.$kot->images[0]->image}}"></div></a>
								<div>
									{!!Form::open(['url' => 'kot/'.$kot->id.'/edit','method' => 'GET','class' => 'frm-edit_delete'])!!}
										{!!Form::submit('Edit',array('class' => 'btn btn-primary btn-edit_delete'))!!}
									{!!Form::close()!!}
									{!!Form::open(['url' => 'kot/'.$kot->id,'method' => 'DELETE','class' => 'frm-edit_delete'])!!}
										{!!Form::submit('Delete',array('class' => 'btn btn-danger btn-edit_delete'))!!}
									{!!Form::close()!!}						
								</div>
								</div>
							<div class="details">
								<div class="price">€{{$kot->price}}</div>
								<div>{{$kot->size}}m²</div>
								<div class="kot_info"><br>{{$kot->info}}</div>
							</div>
						</div>
			@endforeach					
				@if(!$new->isEmpty())
					<div class="status pending"><span>Koten in review</span></div>
				@endif
				
					@foreach($new as $kot)
						<div class="kot pending">
							<div class="info">
								<a href="/kot/{{$kot->id}}"><div class="title">{{$kot->streatname}}  {{$kot->housenumber}} {{$kot->zipcode}} {{$kot->city}}</div>
								<div><img width="300" src="{{URL::to('/').'/'.$kot->images[0]->image}}"></div></a>
								<div>
									{!!Form::open(['url' => 'kot/'.$kot->id.'/edit','method' => 'GET','class' => 'frm-edit_delete'])!!}
										{!!Form::submit('Edit',array('class' => 'btn btn-primary btn-edit_delete'))!!}
									{!!Form::close()!!}
									{!!Form::open(['url' => 'kot/'.$kot->id,'method' => 'DELETE','class' => 'frm-edit_delete'])!!}
										{!!Form::submit('Delete',array('class' => 'btn btn-danger btn-edit_delete'))!!}
									{!!Form::close()!!}						
								</div>
								</div>
							<div class="details">
								<div class="price">€{{$kot->price}}</div>
								<div>{{$kot->size}}m²</div>
								<div class="kot_info"><br>{{$kot->info}}</div>
							</div>
						</div>
					@endforeach		

					@if(!$declined->isEmpty())
						<div class="status denied"><span>Geweigerde koten</span></div>
					@endif
					
					
						@foreach($declined as $kot)
							<div class="kot denied">
								<div class="info">
									<a href="/kot/{{$kot->id}}"><div class="title">{{$kot->streatname}}  {{$kot->housenumber}} {{$kot->zipcode}} {{$kot->city}}</div>
									<div><img width="300" src="{{URL::to('/').'/'.$kot->images[0]->image}}"></div></a>
									<div>
										{!!Form::open(['url' => 'kot/'.$kot->id.'/edit','method' => 'GET','class' => 'frm-edit_delete'])!!}
											{!!Form::submit('Edit',array('class' => 'btn btn-primary btn-edit_delete'))!!}
										{!!Form::close()!!}
										{!!Form::open(['url' => 'kot/'.$kot->id,'method' => 'DELETE','class' => 'frm-edit_delete'])!!}
											{!!Form::submit('Delete',array('class' => 'btn btn-danger btn-edit_delete'))!!}
										{!!Form::close()!!}						
									</div>
									</div>
								<div class="details">
									<div class="price">€{{$kot->price}}</div>
									<div>{{$kot->size}}m²</div>
									<div class="kot_info"><br>{{$kot->info}}</div>
								</div>
							</div>
						@endforeach	
										
					</div><!--end koten-->
				</div>
			</div><!--end content-->
		</div><!--end row fluid-->
	</div><!--end container fluid-->

@endsection
