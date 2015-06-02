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
					<li><a href="#">Kot toevoegen</a></li>
				</ul>
			
				<div class="row-fluid sortable">
					
					<h1>Kot toevoegen</h1>
					
					<div class="top_spacing">

						@if (count($errors) > 0)
							<div class="alert alert-danger">
								<strong>Oeps!</strong> Er was een probleem met de gegevens.<br><br>
								<ul>
									@foreach ($errors->all() as $error)
											<li>{{$error}}</li>
									@endforeach
								</ul>
							</div>
						@endif

						{!!Form::open(['route' => 'kot.store','action' => 'post','role' => 'form', 'class' => 'form-horizontal','files'=>true])!!}
							
							<h2>Adres</h2>

							<div class="control-group">
								<label class="control-label">Gemeente</label>
								<div class="controls">
									{!!Form::input('text','city','',array('class'=>'form-control'))!!}
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Straatnaam</label>
								<div class="controls">
									{!!Form::input('text','streatname','',array('class'=>'form-control'))!!}
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Huisnummer</label>
								<div class="controls">
									{!!Form::input('text','housenumber','',array('class'=>'form-control'))!!}
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Postcode</label>
								<div class="controls">
									{!!Form::input('text','zipcode','',array('class'=>'form-control'))!!}
								</div>
							</div>
							
							<h2>Contact</h2>
							<div class="control-group">
								<label class="control-label">E-mail</label>
								<div class="controls">
									{!!Form::input('email','email','',array('class'=>'form-control'))!!}
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Telefoonnummer</label>
								<div class="controls">
									{!!Form::input('text','telephonenumber','',array('class'=>'form-control'))!!}
								</div>
							</div>

							<h2>Informatie</h2>
							<div class="control-group">
								<label class="control-label">Oppervlakte (in m²)</label>
								<div class="controls">
									{!!Form::input('text','size','',array('class'=>'form-control'))!!}
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Prijs (in €)</label>
								<div class="controls">
									{!!Form::input('text','price','',array('class'=>'form-control'))!!}
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Beschrijving</label>
								<div class="controls">
									{!!Form::textarea('info','',array('class'=>'form-control'))!!}
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Beschikbaar vanaf</label>
								<div class="controls">
									<div class="input-append date">
										{!!Form::input('text','begindate','',array('class'=>'form-control date'))!!}
									    <span class="add-on"><i class="icon-th"></i></span>
									</div>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Beschikbaar tot</label>
								<div class="controls">
									<div class="input-append date">
										{!!Form::input('text','enddate','',array('class'=>'form-control date'))!!}
									    <span class="add-on"><i class="icon-th"></i></span>
									</div>
								</div>
							</div>

							<div class="checkbox controls col-md-offset-4">
							    <label class='col-md-3'>
							      <input type="checkbox" name='bikestands'/> Fietsenstalling
							    </label>
							    <label class='col-md-3'>
							      <input type="checkbox" name='seperatekitchen'/> Aparte keuken
							    </label>
							    <label class='col-md-3'>
							      <input type="checkbox" name='seperatebathroom'/> Aparte badkamer
							    </label>
							    <label class='col-md-3'>
							      <input type="checkbox" name='furniture'/> Bemeubeld
							    </label>
							    <label class='col-md-3'>
							      <input type="checkbox" name='wifi'/> Internet inbegrepen
							    </label>
							</div>

							<div class="control-group">
								<label class="control-label">Afbeeldingen</label>
								<div class="controls" id='input-images'>
									<div id='img-1' class="imgd">
										{!!Form::file('images[]', array('multiple'=>true,'class'=>'imgd'))!!}
										{!!Form::file('images[]', array('multiple'=>true,'class'=>'imgd'))!!}
										{!!Form::file('images[]', array('multiple'=>true,'class'=>'imgd'))!!}
										{!!Form::file('images[]', array('multiple'=>true,'class'=>'imgd'))!!}
									</div>
								</div>
							</div>
							<div class="control-group">
								<div class="controls col-md-offset-4">
									<button type="submit" class="btn btn-info" style="margin-right: 15px;">
										Kot toevoegen
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
