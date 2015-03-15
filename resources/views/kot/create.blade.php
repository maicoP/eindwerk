@extends('app')
@section('tile')
	Kot toevoegen
@endsection
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
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

				<div class="form-group">
					<label class="col-md-4 control-label">Gemeenten</label>
					<div class="col-md-6">
						{!!Form::input('text','city','',array('class'=>'form-control'))!!}
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">Straatnaam</label>
					<div class="col-md-6">
						{!!Form::input('text','streatname','',array('class'=>'form-control'))!!}
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">Huisnummer</label>
					<div class="col-md-6">
						{!!Form::input('text','housenumber','',array('class'=>'form-control'))!!}
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">Postcode</label>
					<div class="col-md-6">
						{!!Form::input('text','zipcode','',array('class'=>'form-control'))!!}
					</div>
				</div>
				
				<h2>Contact gegevens</h2>
				<div class="form-group">
					<label class="col-md-4 control-label">E-mail adres</label>
					<div class="col-md-6">
						{!!Form::input('email','email','',array('class'=>'form-control'))!!}
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">Telefoon nummer</label>
					<div class="col-md-6">
						{!!Form::input('text','telephonenumber','',array('class'=>'form-control'))!!}
					</div>
				</div>

				<h2>Extra Info</h2>
				<div class="form-group">
					<label class="col-md-4 control-label">Oppervlakten</label>
					<div class="col-md-6">
						{!!Form::input('text','size','',array('class'=>'form-control'))!!}
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">Prijs</label>
					<div class="col-md-6">
						{!!Form::input('text','price','',array('class'=>'form-control'))!!}
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">Info</label>
					<div class="col-md-6">
						{!!Form::textarea('info','',array('class'=>'form-control'))!!}
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">Beschikbaar vanaf</label>
					<div class="col-md-6">
						<div class="input-append date">
							{!!Form::input('text','begindate','',array('class'=>'form-control date'))!!}
						    <span class="add-on"><i class="icon-th"></i></span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">Beschikbaar tot</label>
					<div class="col-md-6">
						<div class="input-append date">
							{!!Form::input('text','enddate','',array('class'=>'form-control date'))!!}
						    <span class="add-on"><i class="icon-th"></i></span>
						</div>
					</div>
				</div>

				<div class="checkbox col-md-6 col-md-offset-4">
				    <label class='col-md-3'>
				      <input type="checkbox" name='bikestands'> Fietsenstalling
				    </label>
				    <label class='col-md-3'>
				      <input type="checkbox" name='seperatekitchen'> Aparte keuken
				    </label>
				    <label class='col-md-3'>
				      <input type="checkbox" name='seperatebathroom'> Aparte badkamer
				    </label>
				    <label class='col-md-3'>
				      <input type="checkbox" name='furniture'> Bemeubeld
				    </label>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">Afbeeldingen</label>
					<div class="col-md-6" id='input-images'>
						<div id='img-1'>
							{!! Form::file('images[]', array('multiple'=>true,'class'=>'col-md-6')) !!}
							<button id='del-1' type="button" class="btn btn-danger img-del col-md-2 col-md-offset-4">x</button>
						</div>
					</div>
				</div>

				
				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<button type="button" class="btn btn-primary" id='add-image' style="margin-right: 15px;">
							Afbeelding toevoegen
						</button>
						<button type="submit" class="btn btn-primary" style="margin-right: 15px;">
							Toevoegen
						</button>
					</div>
				</div>
			{!!Form::close()!!}
		</div>
	</div>
</div>
@endsection
@section('scripts')
	<script src="/lib/pickadate/picker.js"></script>
	<script src="/lib/pickadate/picker.date.js"></script>
	<script src="/lib/pickadate/translations/nl_NL.js"></script>
	<script>
		$(document).ready(function(){
			$('.date').pickadate({
				format : 'dd-mm-yyyy',
		        formatSubmit : 'yyyy-mm-dd'
		        
		    });
		})
	</script>
@endsection
