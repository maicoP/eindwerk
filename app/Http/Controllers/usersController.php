<?php namespace eindwerk\Http\Controllers;

use eindwerk\Http\Requests;
use eindwerk\Http\Controllers\Controller;
use eindwerk\Http\Requests\createUserRequest;
use eindwerk\User;
use eindwerk\Kot;
use eindwerk\Http\Requests\createUser; 

class usersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$users =  User::where('type','user')->orderBy('name','asc')->get();
		return view('users.index',['users' => $users]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(createUser $request)
	{
		$user = new User;
		$user->fill($request->all());
		$user->password = bcrypt($request->get('password'));
		$user->type = 'user';
		$user->save();
		return redirect('/user');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		user::destroy($id);
		Kot::where('fk_userid',$id)->delete();
		//images nog mee verwijderen
		return redirect('/user');
	}

}
