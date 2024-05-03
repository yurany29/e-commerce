<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Cart\CartRequest;
use App\Http\Requests\Cart\CartUpdateRequest;

class CartController extends Controller
{
    public function index(Request $request)
    {
		$user_id = Auth::user()->id;
        $carts = Cart::has('product')->where('user_id', $user_id)->get();
		foreach ($carts as $cart){
			$cart->total_price = $cart->quantity * $cart->product->price;
			$cart->load(['product' => function ($query){
				$query->with('file');
			}]);
		}
		//dd($carts);
        return view('cart.index', compact('carts'));
    }



    public function store(CartRequest $request)
    {
		$user_id = Auth::user()->id;
		$product_id = $request->product_id;
		$amount = 1;
		Cart::create([
			'user_id' => $user_id,
			'product_id' => $product_id,
			'quantity' => $amount,
		]);
		if (!$request->ajax()) return back()->with('success', 'Cart crated');
		return response()->json([], 201);
    }



    public function updatePlus(CartUpdateRequest $request, Cart $cart)
    {
		//validar si esta asociado product y usuario con cart
		// Actualizar cantidad
		$cart->update(['quantity' => $cart->quantity + 1]);

		return back();
		return response()->json(['success' => true], 204);
    }

	public function updateMinus(CartUpdateRequest $request, Cart $cart)
    {
		// Actualizar cantidad
		$cart->update(['quantity' => $cart->quantity - 1]);

		if ('quantity' == 0){
			$cart->delete();
		}
		return back();
		return response()->json(['success' => true], 204);
    }


    public function destroy(Request $request, Cart $cart)
    {
        $cart->delete();
		if (!$request->ajax()) return back()->with('success', 'Cart deleted');
		return response()->json([], 204);
    }
}
