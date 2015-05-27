<?php namespace eindwerk\Http\Controllers;

use Validator;
use eindwerk\Http\Requests;
use eindwerk\Http\Controllers\Controller;
use eindwerk\Kot;
use eindwerk\Image;
use eindwerk\Filter;
use eindwerk\AppUserKot;
use eindwerk\AppUser;
use eindwerk\School;
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
			$kot = $kot->where('size','>=',$filter->size);
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
		$favkotten = Kot::with('images')->whereHas('appuserkot',function($q){
			$q->where('type','like');
		})->get();
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
			$user->password = bcrypt($request->get('password'));
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

}
