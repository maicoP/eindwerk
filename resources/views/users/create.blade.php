@extends('app')
@section('title')
	Gebruiker toevoegen
@stop
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
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

						<div class="form-group">
							<label class="col-md-4 control-label">Naam</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-mail adres</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Wachtwoord</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Wachtwoor bevestigen</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Registreer
								</button>
							</div>
						</div>
					{!!Form::close()!!}
		</div>
	</div>
</div>
@endsection
 