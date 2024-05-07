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
    $carts = Cart::has('product')->where('user_id', $user_id)->with('product.file')->get();

    foreach ($carts as $cart) {
        $cart->total_price = $cart->quantity * $cart->product->price;
    }
    $total_sum = $carts->sum(function ($cart) {
        return $cart->total_price;
    });

    return view('cart.index', compact('carts', 'total_sum'));
}



    public function store(CartRequest $request, Cart $cart)
    {
		$user_id = Auth::user()->id;
		$product_id = $request->product_id;
		$amount = 1;

		$product = Product::find($request->product_id);
		$productCart = $cart->where('product_id', $product->id)->first();

		if ($productCart) {
			$newQuantity = $productCart->quantity + $amount;
        	if ($newQuantity > $product->stock) {
            return response()->json(['warning' => 'No hay stock suficiente'], 422);
        }
			$productCart->update(['quantity' => $newQuantity]);
			return response()->json(['success' => true], 204);

		}else{
			Cart::create([
				'user_id' => $user_id,
				'product_id' => $product_id,
				'quantity' => $amount,
			]);
		}
		return response()->json([], 201);


    }



    public function updatePlus(CartUpdateRequest $request, Cart $cart)
    {
		// $validationCart = $cart->where('product_id', $product->id)->first();
		$product = Product::find($request->product_id);
		$productCart = $cart->where('product_id', $product->id)->first();
		if ($productCart) {
			$newQuantity = $productCart->quantity + 1;
        	if ($newQuantity > $product->stock) {
            return response()->json(['warning' => 'No hay stock suficiente'], 422);
        }
			$productCart->update(['quantity' => $newQuantity]);
			return response()->json([], 204);
		}
    }

	public function updateMinus(CartUpdateRequest $request, Cart $cart)
    {
		$product = Product::find($request->product_id);
		$productCart = $cart->where('product_id', $product->id)->first();

		if ($productCart) {
			$newQuantity = $productCart->quantity - 1;
        	if ($newQuantity == 0) {
			$productCart->delete();
            return response()->json([], 204);
        	}
		}
		$productCart->update(['quantity' => $newQuantity]);
		return response()->json(['success' => true], 204);
    }


    public function destroy(Request $request, Cart $cart)
    {
        $cart->delete();
		if (!$request->ajax()) return back()->with('success', 'Cart deleted');
		return response()->json([], 204);
    }
}
