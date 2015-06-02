@extends('app')
@section('title')
	Gebruiker toevoegen
@stop
@section('content')
<div class="container-fluid">
				<ul class="breadcrumb">
					<li>
						<i class="icon-home"></i>
						<a href="/kot">Home</a>
						<i class="icon-angle-right"></i> 
					</li>
					<li><a href="#">Gebruiker Toevoegen</a></li>
				</ul>

				<div class="row-fluid sortable">
					
					<h1>Gebruiker toevoegen</h1>
					
					<div class="top_spacing">

						@if (count($errors) > 0)
							<div class="alert alert-danger">
								<strong>Oeps!</strong> Er was een probleem met jou gegevens.<br><br>
								<ul>
									@foreach($errors->all() as $error)
										<li>{{$error}}</li>
									@endforeach
								</ul>
							</div>
						@endif


					{!!Form::open(['route' => 'user.store' , 'action' => 'post' ,'class' => 'form-horizontal'])!!}

						<div class="control-group">
							<label class="control-label">Naam</label>
							<div class="controls">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">E-mail adres</label>
							<div class="controls">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Wachtwoord</label>
							<div class="controls">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Wachtwoor bevestigen</label>
							<div class="controls">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="control-group">
							<div class="controls col-md-offset-4">
								<button type="submit" class="btn btn-info" style="margin-right: 15px;">
									Gebruiker Toevoegen
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
