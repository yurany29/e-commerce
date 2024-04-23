<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

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


    public function store(Request $request)
    {
        $cart = new Cart($request->all());
		$cart->save();
		if (!$request->ajax()) return back()->with('success', 'Cart crated');
		return response()->json(['status' => 'Cart created', 'Cart' => $cart], 201);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
