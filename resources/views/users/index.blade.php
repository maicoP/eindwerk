@extends('app')
@section('title')
	Gebruikers beheer
@stop
@section('content')
				<ul class="breadcrumb">
					<li>
						<i class="icon-home"></i>
						<a href="/kot">Home</a>
						<i class="icon-angle-right"></i> 
					</li>
					<li><a href="#">Gebruikers</a></li>
				</ul>
				<div><a class="btn btn-info" href="user/create">Gebruiker toevoegen</a></div>
				<table class="table table-striped">
				  <tr><br>
				  	<th>Naam</th>
				  	<th>email</th>
				  	<th></th>
				  </tr>
				  @foreach($users as $user)
				  <tr><td>{{$user->name}}</td>
				  	<td>{{$user->email}}</td>
				  	<td>{!!Form::open(['url' => 'user/'.$user->id,'method' => 'DELETE','class' => 'frm-edit_delete'])!!}
										{!!Form::submit('Delete',array('class' => 'btn btn-danger btn-edit_delete'))!!}
									{!!Form::close()!!}</td>
				  </tr>
				  @endforeach
				</table>
			</div><!--end content-->
		</div><!--end row fluid-->
	</div><!--end container fluid-->

@endsection
