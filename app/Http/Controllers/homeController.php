<?php namespace eindwerk\Http\Controllers;

use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use eindwerk\Http\Requests\contactRequest;
use Mail;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	/*public function __construct()
	{
		$this->middleware('auth');
	}*/

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	
	public function index()
	{
		if (Auth::check())
		{
			return Redirect('/kot');
		}
		else
		{
			return view('index');
		}
		
	}


	public function sendMessage(contactRequest $request)
	{
		Mail::send('emails.contact', array('mes' => $request->get('boodschap'),'name' => $request->get('naam'),'email' => $request->get('email'),'company' =>$request->get('bedrijf')), function($message)
		{
		    $message->to('maicopaulussen@hotmail.be', 'Kotter contact')->subject('Contact kotter');
		});
		return response(['message' => 'U bericht is met succes verzonden']);
	}

}
