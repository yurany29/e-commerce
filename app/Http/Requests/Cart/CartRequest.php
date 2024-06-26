<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => ['nullable', 'exists:users,id'],
			'product_id' => ['required', 'exists:products,id'],
			'quantity' => ['nullable', 'integer']
        ];
    }
}
