<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
	protected $rules = [
		'category_id' => ['required', 'exists:categories,id'],
		'name' => ['required', 'string'],
		'price' => ['required', 'numeric'],
		'description' => ['required', 'string'],
		'stock' => ['required', 'numeric'],
		'file' => ['required', 'image']
	];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {

		return $this->rules;
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
			'file.required' => 'La imagen es requerida',
			'file.image' => 'El archivo debe er imagen valida',
		];
	}
}
