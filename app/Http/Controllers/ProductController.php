<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::get();
        if (!$request->ajax()) return view();
		return response()->json(['Products' => $products], 200);
    }


    public function create()
    {
        //vista
    }


    public function store(Request $request)
    {
        $product = new Product($request->all());
		$product->save();
		if (!$request->ajax()) return back()->with('success', 'Product crated');
		return response()->json(['status' => 'product created', 'Product' => $product], 201);
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
