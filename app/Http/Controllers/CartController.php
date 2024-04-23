<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Requests\Cart\CartRequest;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $carts = Cart::get();
        if (!$request->ajax()) return view();
		return response()->json(['Carts' => $carts], 200);
    }


    public function create()
    {
        //vista
    }


    public function store(CartRequest $request)
    {
        $cart = new Cart($request->all());
		$cart->save();
		if (!$request->ajax()) return back()->with('success', 'Cart crated');
		return response()->json(['status' => 'Cart created', 'Cart' => $cart], 201);
    }


    public function show(Request $request, Cart $cart)
	{
		if (!$request->ajax()) return view();
		return response()->json(['cart' => $cart], 200);
	}


    public function edit($id)
    {
        //
    }

    public function update(CartRequest $request, Cart $cart)
    {
        $cart->update($request->all());
		if (!$request->ajax()) return back()->with('success', 'Cart updated');
		return response()->json([], 204);
    }

    public function destroy(Request $request, Cart $cart)
    {
        $cart->delete();
		if (!$request->ajax()) return back()->with('success', 'Cart deleted');
		return response()->json([], 204);
    }
}
