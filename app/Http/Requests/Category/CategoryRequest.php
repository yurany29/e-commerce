<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => ['required', 'string'],
        ];
    }

	public function messages()
	{
		return [
			'name.required' => 'EL nombre es requerido',
			'name.string' => 'El nombre debe ser valido',
		];
	}
}
