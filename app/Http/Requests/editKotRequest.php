<?php namespace eindwerk\Http\Requests;

use eindwerk\Http\Requests\Request;

class editKotRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'city' =>   'required',
            'streatname'    => 'required',
            'housenumber'   =>  'required',
            'zipcode'       => 'required',
            'price'    =>   'required',
            'size'  =>  'required',
            'telephonenumber'   =>  'required',
            'begindate'    =>  'required',
            'enddate'   =>  'required|after:begindate'
		];
	}

}
