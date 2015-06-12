<?php namespace eindwerk;

use Illuminate\Database\Eloquent\Model;

class AppUser extends Model {

	protected $table = 'app_user';
	public $timestamps = false;

	public function filter(){
		return $this->hasOne('eindwerk\Filter','fk_app_userid');
	}

		public function school()
    {
        return $this->belongsTo('eindwerk\School','fk_schoolid','id');
    }
}
