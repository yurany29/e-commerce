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
        	'password' => ['confirmed', 'string', 'min:8'],
        ];

		if ($this->method() == 'POST'){
			array_push($rules['number_id'], 'unique:users,number_id');
			array_push($rules['email'], 'unique:users,email');
			array_push($rules['password'], 'required');
		}else{
			array_push($rules['number_id'], 'unique:users,number_id,' . $this->user->id);
			array_push($rules['email'], 'unique:users,email,' . $this->user->id);
			array_push($rules['password'], 'nullable');
		}

		return $rules;
    }

	public function messages()
	{
		return [
			'number_id.required' => 'El numero de identificación es requerido',
			'number_id.numeric' => 'La identificacion debe ser valida',
			'name.required' => 'EL nombre es requerido',
			'name.string' => 'El nombre debe ser valido',
			'last_name.require' => 'El apellido es requerido',
			'last_name.string' => 'El apellido debe ser valido',
			'email.required' => 'El email es requerido',
			'email.email' => 'El email debe ser valido',
			'password.required' => 'La conraseña es reuerida',
			'password.confirmed' => 'La contraseña debe ser confimada',
			'password.string' => 'La contraseña debe ser valida',
			'password.min:8' => 'La contraseña debe tener maximo 8 caracteres'
		];
	}
}
