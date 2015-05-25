<?php namespace eindwerk\Http\Controllers;

use eindwerk\Http\Requests;
use eindwerk\Http\Controllers\Controller;
use eindwerk\Kot;
use eindwerk\Image;
use eindwerk\Filter;
use eindwerk\AppUserKot;
use Illuminate\Http\Request;

class apiController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getKot(Request $request)
	{
		$userid = $request->get('userid'); 
		$filter = Filter::where('fk_app_userid',$userid)->first();
		$votedKotten = AppUserKot::where('fk_app_userid',$userid)->get();
		$votedKottenId = array();
		foreach($votedKotten as $kot)
		{
			$votedKottenId[] = $kot->fk_kotid;
		}

		$kot = Kot::with('images')->whereNotIn('id',$votedKottenId);
		if($filter->bikestands == true)
		{
			$kot = $kot->where('bikestands',true);
		}
		if($filter->seperatebathroom == true)
		{
			$kot = $kot->where('seperatebathroom',true);
		}
		if($filter->seperatekitchen == true)
		{
			$kot = $kot->where('seperatekitchen',true);
		}
		if($filter->wifi == true)
		{
			$kot = $kot->where('wifi',true);
		}
		if($filter->furniture == true)
		{
			$kot = $kot->where('furniture',true);
		}
		if($filter->price > 0)
		{
			$kot = $kot->where('price','<=',$filter->price);
		}
		if($filter->size > 0)
		{
			$kot = $kot->where('price','>=',$filter->size);
		}
		if($filter->startDate != 0)
		{
			$kot = $kot->where('begindate','<=',$filter->startDate);
		}
		if($filter->endDate != 0)
		{
			$kot = $kot->where('enddate','>=',$filter->endDate);
		}
		$kot = $kot->first();
		return response()->json(['filter'=> $filter,'kot'=>$kot]);
	}

}
