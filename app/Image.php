<?php namespace eindwerk;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {

	public function kot()
    {
        return $this->belongsTo('app\Kot', 'fk_kotid');
    }
	protected $fillable = ['image', 'fk_kotid'];

}
