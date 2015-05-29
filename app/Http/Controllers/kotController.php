<?php namespace eindwerk\Http\Controllers;

use eindwerk\Http\Requests;
use eindwerk\Http\Controllers\Controller;
use Illuminate\Http\Request;
use eindwerk\Http\Requests\addKotRequest;
use eindwerk\Http\Requests\editKotRequest;
use eindwerk\Kot;
use eindwerk\Image;
use Illuminate\Contracts\Auth\Guard;



class kotController extends Controller {

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
		$koten = Kot::with('images')->where('fk_userid','=',\Auth::user()->id)->get();
		return view('kot.index',['koten' => $koten]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('kot.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(addKotRequest $request,Kot $kot)
	{
		$kot->fill($request->all());

		$param = array("address"=> $request->get('streatname').' '.$request->get('housenumber').' '.$request->get('zipcode').' '.$request->get('city'));
		$response = \Geocoder::geocode('json', $param);
		$response = json_decode($response);

		$kot->fk_userid = \Auth::user()->id;
		$kot->begindate = $request->begindate;
		$kot->enddate = $request->enddate;
		$kot->bikestands = ($request->get('bikestands') == 'on' ? true :false );
		$kot->seperatekitchen = ($request->get('seperatekitchen') == 'on' ? true :false );
		$kot->seperatebathroom = ($request->get('seperatebathroom') == 'on' ? true :false );
		$kot->furniture = ($request->get('furniture') == 'on' ? true :false );
		$kot->wifi = ($request->get('wifi') == 'on' ? true :false );
		$kot->lat = $response->results[0]->geometry->location->lat;
		$kot->lng = $response->results[0]->geometry->location->lng;
		$kot->status = 'new';
		$kot->save();
		foreach( $request->file('images') as $image)
		{
			$filename = str_random(40).'.png';
			$destination = 'kot_img/';
			$image->move($destination, $filename);
			$image = new Image;
			$image->image = $destination.$filename;
			$image->fk_kotid = $kot->id;
			$image->save();

		}

		return Redirect('/kot'); 
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$kot =  Kot::find($id);
		return view('kot.show',['kot' => $kot]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$kot =  Kot::find($id);
		return view('kot.edit',['kot' => $kot]);
	}

	public function help()
	{
		return view('kot.help');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(editKotRequest $request,$id)
	{
		$kot =  Kot::find($id);
		$kot->fill($request->all());

		$param = array("address"=> $request->get('streatname').' '.$request->get('housenumber').' '.$request->get('zipcode').' '.$request->get('city'));
		$response = \Geocoder::geocode('json', $param);
		$response = json_decode($response);

		$kot->begindate = $request->begindate;
		$kot->enddate = $request->enddate;
		$kot->bikestands = ($request->get('bikestands') == 'on' ? true :false );
		$kot->seperatekitchen = ($request->get('seperatekitchen') == 'on' ? true :false );
		$kot->seperatebathroom = ($request->get('seperatebathroom') == 'on' ? true :false );
		$kot->furniture = ($request->get('furniture') == 'on' ? true :false );
		$kot->wifi = ($request->get('wifi') == 'on' ? true :false );
		$kot->lat = $response->results[0]->geometry->location->lat;
		$kot->lng = $response->results[0]->geometry->location->lng;
		$kot->save();
		if($request->hasFile('images'))
		{
			foreach( $request->file('images') as $image)
			{
				$filename = str_random(40).'.png';
				$destination = 'kot_img/';
				$image->move($destination, $filename);
				$image = new Image;
				$image->image = $destination.$filename;
				$image->fk_kotid = $kot->id;
				$image->save();

			}
		}
		

		return Redirect('/kot');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Image::where('fk_kotid','=',$id)->delete();
		Kot::destroy($id);
		return Redirect('/kot');
	}

	public function deleteImage($id)
	{
		Image::destroy($id);
	}

}
