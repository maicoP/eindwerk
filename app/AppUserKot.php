<?php namespace eindwerk;

use Illuminate\Database\Eloquent\Model;

class AppUserKot extends Model {

	protected $table = 'app_userkot';
	public $timestamps = false;

	public function kot()
    {

        return $this->belongsTo('eindwerk\Kot','fk_kotid');

    }
}
