<?php namespace eindwerk\Http\Controllers;

use Validator;
use Hash;
use eindwerk\Http\Requests;
use eindwerk\Http\Controllers\Controller;
use eindwerk\Kot;
use eindwerk\Image;
use eindwerk\Filter;
use eindwerk\AppUserKot;
use eindwerk\AppUser;
use eindwerk\School;
use Illuminate\Http\Request;
use Toin0u\Geotools\Facade\Geotools;

class apiController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getKot(Request $request)
	{
		$userid = $request->get('userid'); 
		$kot = Kot::getKot($userid,array());
		return response()->json(['kot'=>$kot]);
	}

	public function vote(Request $request)
	{
		$vote = new AppUserKot;
		$vote->type = $request->get('vote');
		$vote->fk_kotid = $request->get('kotid');
		$vote->fk_app_userid = $request->get('userid');
		$vote->save();
		return response()->json(true);
	}

	public function changeVote(Request $request)
	{
		$vote = AppUserKot::where('fk_kotid',$request->get('kotid'))->where('fk_app_userid',$request->get('userid'))->first();
		$vote->type = $request->get('vote');
		$vote->fk_kotid = $request->get('kotid');
		$vote->fk_app_userid = $request->get('userid');
		$vote->save();
		return response()->json(true);
	}

	public function favKotten(Request $request)
	{
		$userid = $request->get('userid');
		$user = AppUser::find($userid);
		$favkotten = Kot::with('images')->whereHas('appuserkot',function($q) use($userid){
			$q->where('type','like');
			$q->where('fk_app_userid',$userid);
		})->get();
		foreach($favkotten as $kot)
		{
			$response = \Geocoder::geocode('json',['address' => $user->school]);
	        $response = json_decode($response);
	        $coordA   = Geotools::coordinate([$kot->lat, $kot->lng]);
	        $coordB   = Geotools::coordinate([$response->results[0]->geometry->location->lat,$response->results[0]->geometry->location->lng]);
	        $distance = Geotools::distance()->setFrom($coordA)->setTo($coordB);
	        $kot->distance = number_format($distance->in('km')->haversine(), 2, '.', '');
		}
		return response()->json(['kotten'=>$favkotten]);
	}

	public function changeFilter(Request $request)
	{
		$field = $request->get('field');
		$value = $request->get('value');
		$userid = $request->get('userid');
		if($field == 'school')
		{
			AppUser::where('id',$userid)->update(array($field => $value));
		}
		else if($field == 'email')
		{
			$validator = Validator::make($request->all(),
			    ['value' => 'required|email']
			);
			if($validator->fails())
			{
				return response()->json($validator->messages());
			}
			else
			{
				$appUser = AppUser::where('email',$value)->get();
				if(count($appUser) == 0)
				{
					AppUser::where('id',$userid)->update(array($field => $value));
				}
				else
				{
					return response()->json(['value' => array('email is al in gebruik')]);
				}
				
			}
			
		}
		else
		{
			filter::where('fk_app_userid',$userid)->update(array($field => $value));
		}

		return response()->json(true);
	}

	public function getAppUser(Request $request)
	{
		
		$appUser= AppUser::with('filter')->where('id',$request->get('userid'))->first();
		return response()->json(['succes' => true,'result' => $appUser]);
	}

	public function checkUser(Request $request)
	{
		$user = AppUser::where('id',$request->get('userid'))->get();
		if(count($user)>0)
		{
			return response()->json(['succes'=>true]);
		}
		else
		{
			return response()->json(['succes'=>false]);
		}
	}

	public function register(Request $request)
	{
		$validator = Validator::make($request->all(),
		    ['email' => 'required|email|unique:app_user']
		);
		if($validator->fails())
		{
			return response()->json($validator->messages());
		}
		else
		{
			$user = new AppUser;
			$user->email = $request->get('email');
			$user->password =  (($request->get('facebook') == 'true') ? '' : bcrypt($request->get('password') ));
			$user->save();
			return response()->json(['succes' => true,'email' => $user->email,'password' => $user->password,'id' => $user->id]);
		}
	}

	public function getSchools()
	{
		$schools = School::orderBy('name')->get();
		return response()->json($schools);
	}

	public function saveFilter(Request $request)
	{
		$userid = $request->get('userid');
		AppUser::where('id',$userid)->update(array('school'=>$request->get('school')));
		$filter = new Filter;
		$filter->fk_app_userid = $userid;
		$filter->price = $request->get('price');
		$filter->save();
		return response()->json(['succes'=>true]);
	}

	public function resetKotten(Request $request)
	{
		$userid = $request->get('userid');
		AppUserKot::where('fk_app_userid',$userid)->delete();
		return response()->json(['succes'=>true]);
	}

	public function login(Request $request){
		$email = $request->get('email');
		$password = $request->get('password');
		$user = AppUser::where('email',$email)->first();
		if(count($user) > 0)
		{
			if (Hash::check($password, $user->password))
			{
			    return response()->json(['succes' => true,'user' => $user]);
			}
		}
		
		return response()->json(['succes' => false]);
	}

	public function fbLogin(Request $request){
		$email = $request->get('email');
		$password = $request->get('password');
		$user = AppUser::where('email',$email)->first();
		if(count($user) > 0)
		{
			return response()->json(['succes' => true,'user' => $user]);
		}
		
		return response()->json(['succes' => false]);
	}		

}
