@extends('app')
@section('title')
	KOTTER - Overzicht koten
@stop
@section('content')

<li><a href="#">Koten overzicht</a></li>
				</ul>

				<div class="row-fluid">
					<div class="span13">
						
						<h1>Alle toegevoegde koten</h1>

			@forelse($koten as $kot)
					<div class="status approved top_spacing"><span>Koten in het systeem</span></div>
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
								<div>50m²</div>
								<div class="kot_info"><br>Ruim luxekot gelegen in de beste studentenbuurt van Antwerpen. Op 30m wandelafstand van UA.</div>
							</div>
						</div>

			@empty
				<p><br>Er zijn geen koten beschikbaar omdat u er nog geen heeft toegevoegd.</p>
  				<p>Een kot toevoegen doet u via de knop "<b>Kot toevoegen</b>" in de balk links opzij.</p>
			 	<img src="/app/img/kot.png" alt="">
  				<p>Voor meer hulp en informatie navigeert u naar het menu "<b>Help</b>".</p>
			@endforelse						

						<div class="status pending"><span>Koten in review</span></div>
						
						<div class="kot pending">
							<div class="info">
								<div class="title">Keizerlij 20 2960 Antwerpen</div>
								<div><img width="300" src="http://eindwerk.app:8000/kot_img/qqavL7FgWSRdC145GDBkasFlWDzjZmKstnkTExx5.png"></div>
								<div><input class="btn btn-primary btn-edit_delete" type="submit" value="Edit"><input class="btn btn-danger btn-edit_delete" type="submit" value="Delete"></div>
							</div>
							<div class="details">
								<div class="price">€450</div>
								<div>50m²</div>
								<div class="kot_info"><br>Ruim luxekot gelegen in de beste studentenbuurt van Antwerpen. Op 30m wandelafstand van UA.</div>
							</div>
						</div>
						<div class="kot pending last">
							<div class="info">
								<div class="title">Keizerlij 20 2960 Antwerpen</div>
								<div><img width="300" src="http://eindwerk.app:8000/kot_img/qqavL7FgWSRdC145GDBkasFlWDzjZmKstnkTExx5.png"></div>
								<div><input class="btn btn-primary btn-edit_delete" type="submit" value="Edit"><input class="btn btn-danger btn-edit_delete" type="submit" value="Delete"></div>
							</div>
							<div class="details">
								<div class="price">€450</div>
								<div>50m²</div>
								<div class="kot_info"><br>Ruim luxekot gelegen in de beste studentenbuurt van Antwerpen. Op 30m wandelafstand van UA.</div>
							</div>
						</div>

						<div class="status denied"><span>Geweigerde koten</span></div>
						
						<div class="kot denied">
							<div class="info">
								<div class="title">Keizerlij 20 2960 Antwerpen</div>
								<div><img width="300" src="http://eindwerk.app:8000/kot_img/qqavL7FgWSRdC145GDBkasFlWDzjZmKstnkTExx5.png"></div>
								<div><input class="btn btn-primary btn-edit_delete" type="submit" value="Edit"><input class="btn btn-danger btn-edit_delete" type="submit" value="Delete"></div>
							</div>
							<div class="details">
								<div class="price">€450</div>
								<div>50m²</div>
								<div class="kot_info"><br>Ruim luxekot gelegen in de beste studentenbuurt van Antwerpen. Op 30m wandelafstand van UA.</div>
							</div>
						</div>									
					</div><!--end koten-->
				</div>
			</div><!--end content-->
		</div><!--end row fluid-->
	</div><!--end container fluid-->

@endsection
