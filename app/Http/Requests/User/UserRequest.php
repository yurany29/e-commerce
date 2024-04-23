<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'number_id' => ['required', 'numeric'],
        	'name' => ['required', 'string'],
			'last_name' => ['required', 'string'],
        	'email' => ['required', 'email'],
        	'password' => ['required', 'confirmed', 'string', 'min:8'],
        ];

		if ($this->method() == 'POST'){
			array_push($rules['number_id'], 'unique:users,number_id');
			array_push($rules['email'], 'unique:users,email');
		}else{
			array_push($rules['number_id'], 'unique:users,number_id,' . $this->id);
			array_push($rules['email'], 'unique:users,email,' . $this->id);
		}

		return $rules;
    }
}
