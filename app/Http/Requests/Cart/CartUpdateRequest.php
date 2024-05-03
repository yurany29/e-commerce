<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CartUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => ['nullable', 'exists:users,id'],
			'product_id' => ['nullable', 'exists:products,id'],
			'quantity' => ['nullable', 'integer']
        ];
    }
}
