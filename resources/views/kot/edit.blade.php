@extends('app')
@section('title')
	KOTTER - Kot bewerken
@stop
@section('content')
				<ul class="breadcrumb">
					<li>
						<i class="icon-home"></i>
						<a href="/kot">Home</a>
						<i class="icon-angle-right"></i> 
					</li>
					<li><a href="#">Kot bewerken</a></li>
				</ul>
			
				<div class="row-fluid sortable">
					
					<h1>Kot bewerken: {{$kot->streatname}}  {{$kot->housenumber}} {{$kot->zipcode}} {{$kot->city}}</h1>
					
					<div class="top_spacing">

					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Oeps!</strong> Er was een probleem met de gegevens.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
										<li>{{str_replace("file", "afbeelding", $error)}}</li>
								@endforeach
							</ul>
						</div>
					@endif

					{!!Form::open(['url' => 'kot/'.$kot->id,'method' => 'PUT','role' => 'form', 'class' => 'form-horizontal','files'=>true])!!}
						
						<h2>Adres</h2>

						<div class="control-group">
							<label class="control-label">Gemeente</label>
							<div class="controls">
								{!!Form::input('text','city',$kot->city,array('class'=>'form-control'))!!}
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Straatnaam</label>
							<div class="controls">
								{!!Form::input('text','streatname',$kot->streatname,array('class'=>'form-control'))!!}
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Huisnummer</label>
							<div class="controls">
								{!!Form::input('text','housenumber',$kot->housenumber,array('class'=>'form-control'))!!}
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Postcode</label>
							<div class="controls">
								{!!Form::input('text','zipcode',$kot->zipcode,array('class'=>'form-control'))!!}
							</div>
						</div>
						
						<h2>Contact</h2>
						<div class="control-group">
							<label class="control-label">E-mail</label>
							<div class="controls">
								{!!Form::input('email','email',$kot->email,array('class'=>'form-control'))!!}
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Telefoonnummer</label>
							<div class="controls">
								{!!Form::input('text','telephonenumber',$kot->telephonenumber,array('class'=>'form-control'))!!}
							</div>
						</div>

						<h2>Informatie</h2>
						<div class="control-group">
							<label class="control-label">Oppervlakte (in m²)</label>
							<div class="controls">
								{!!Form::input('text','size',$kot->size,array('class'=>'form-control'))!!}
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Prijs (in €)</label>
							<div class="controls">
								{!!Form::input('text','price',$kot->price,array('class'=>'form-control'))!!}
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Beschrijving</label>
							<div class="controls">
								{!!Form::textarea('info',$kot->info,array('class'=>'form-control'))!!}
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Beschikbaar vanaf</label>
							<div class="controls">
								<div class="input-append date">
									{!!Form::input('text','begindate',$kot->begindate,array('class'=>'form-control date'))!!}
								    <span class="add-on"><i class="icon-th"></i></span>
								</div>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Beschikbaar tot</label>
							<div class="controls">
								<div class="input-append date">
									{!!Form::input('text','enddate',$kot->enddate,array('class'=>'form-control date'))!!}
								    <span class="add-on"><i class="icon-th"></i></span>
								</div>
							</div>
						</div>

						<div class="checkbox controls col-md-offset-4">
						    <label class='col-md-3'>
						      <input type="checkbox" name='bikestands' {{($kot->bikestands ? 'checked' : '')}}> Fietsenstalling
						    </label>
						    <label class='col-md-3'>
						      <input type="checkbox" name='seperatekitchen' {{($kot->seperatekitchen ?  'checked' : '')}}> Aparte keuken
						    </label>
						    <label class='col-md-3'>
						      <input type="checkbox" name='seperatebathroom' {{($kot->seperatebathroom ?  'checked' : '')}}> Aparte badkamer
						    </label>
						    <label class='col-md-3'>
						      <input type="checkbox" name='furniture' {{($kot->furniture ?  'checked' : '')}}> Bemeubeld
						    </label>
						    <label class='col-md-3'>
						      <input type="checkbox" name='wifi' {{($kot->wifi ?  'checked' : '')}}> Internet inbegrepen
						    </label>
						</div>

						<div class="control-group">
							<label class="control-label">Afbeeldingen</label>
							<div class="controls" id='input-images'>
								<?php $i=0 ?>
								@foreach($kot->images as $image)
									<img width='300' src="{{URL::to('/').'/'.$image->image}}" alt="">
									<button id='{{$image->id}}' class="btn btn-danger delImg" type="button">x</button>
									<?php ++$i ?>
								@endforeach
								<div id='img-1'>
									@for($i;$i<4;++$i)
									{!! Form::file('images[]', array('multiple'=>true,'class'=>'img_up')) !!}
									@endfor
								</div>							
							</div>
						</div>
						<div class="control-group">
							<div class="controls col-md-offset-4">
								<button type="submit" class="btn btn-info" style="margin-right: 15px;">
									Wijzigingen opslaan
								</button>
							</div>
						</div>						
					{!!Form::close()!!}

					</div><!--end top spacing-->
				</div><!--end row fluid-->
			</div><!--end content-->
		</div><!--end row fluid-->
	</div><!--end container fluid-->

@endsection
