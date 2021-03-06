<?php namespace eindwerk;



use Illuminate\Database\Eloquent\Model as Eloquent;
use League\Geotools\Coordinate\Ellipsoid;
use Toin0u\Geotools\Facade\Geotools;


class Kot extends Eloquent{



	protected $table = 'kot';


	public function images()

    {

        return $this->hasMany('eindwerk\Image','fk_kotid');

    }

    public function appuserkot()

    {

        return $this->hasMany('eindwerk\AppUserKot','fk_kotid');

    }

    public function user()
    {

        return $this->belongsTo('eindwerk\User','fk_userid');

    }

    public function appUserKotCount()
    {
        return $this->hasMany('eindwerk\AppUserKot','fk_kotid')->selectRaw("fk_kotid, count(*) as count")->where('type','like')->groupBy('fk_kotid');
        // replace module_id with appropriate foreign key if needed
    }



	protected $fillable = ['city', 'streatname', 'housenumber','zipcode','price','size','info','email','telephonenumber','bikestands','seperatekitchen','seperatebathroom','furniture','begindate','enddate','fk_userid','lat','lng','name','estimateprice','kotnumber'];


    public static function getKot($userid,$kotid)
    {
        $filter = Filter::where('fk_app_userid',$userid)->first();
        $votedKotten = AppUserKot::where('fk_app_userid',$userid)->get();
        $votedKottenId = array();
        foreach($votedKotten as $kot)
        {
            $votedKottenId[] = $kot->fk_kotid;
        }

        $kot = Kot::with('images')->where('status','accepted')->whereNotIn('id',$votedKottenId)->whereNotIn('id',$kotid);
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
        if(count($kot) <= 0)
        {
            return false;
        }
        $user = AppUser::with('school')->find($userid);
        $coordA   = Geotools::coordinate([$kot->lat, $kot->lng]);
        $coordB   = Geotools::coordinate([$user->school->lat,$user->school->lng]);
        $distance = Geotools::distance()->setFrom($coordA)->setTo($coordB);
        $kot->distance = number_format($distance->in('km')->haversine(), 2, '.', '');
        if($kot->distance > $filter->distance)
        {
            $kotid[] = $kot->id;
            Kot::getKot($userid,$kotid);
        }
        else
        {
          return $kot;  
        }
        
    }


}

