<?php namespace eindwerk\Http\Requests;

use eindwerk\Http\Requests\Request;

class createUserRequest extends Request {

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
			'test' => 'required'
		];
	}

	public function forbiddenResponse()
	{
		return $this->redirector->to('/');
	}

}
