<?php namespace eindwerk;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Kot extends Eloquent{

	protected $table = 'kot';

	public function images()
    {
        return $this->hasMany('eindwerk\Image','fk_kotid');
    }

	protected $fillable = ['city', 'streatname', 'housenumber','zipcode','price','size','info','email','telephonenumber','bikestands','seperatekitchen','seperatebathroom','furniture','begindate','enddate','fk_userid'];


}
