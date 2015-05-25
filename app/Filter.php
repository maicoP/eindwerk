<?php namespace eindwerk;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model {

	protected $fillable = ['fk_app_userid','price','size','distance','startDate','endDate','bikestands','seperatekitchen','seperatebathroom','wifi','furniture'];

}
