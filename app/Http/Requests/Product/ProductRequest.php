<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'category_id' => ['required', 'exists:categories,id'],
			'name' => ['required', 'string'],
			'price' => ['required', 'numeric'],
			'description' => ['required', 'string'],
			'stock' => ['required', 'numeric'],
        ];

		return $rules;
    }

	public function messages()
	{
		return [
			'category_id.required' => 'La categoria es requerida',
			'name.required' => 'EL nombre es requerido',
			'name.string' => 'El nombre debe ser valido',
			'price.require' => 'El precio es requerido',
			'price.numeric' => 'El precio debe ser valido',
			'description.required' => 'La descripcion es requerida',
			'description.string' => 'La descripcion debe ser valida',
			'stock.required' => 'El stock es requerido',
			'stock.numeric' => 'El stock debe ser valido',
		];
	}
}
