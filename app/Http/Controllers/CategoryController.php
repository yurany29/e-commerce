<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::get();
        if (!$request->ajax()) return view();
		return response()->json(['Categories' => $categories], 200);
    }


    public function create()
    {
        //vista
    }


    public function store(Request $request)
    {
        $category = new Category($request->all());
		$category->save();
		if (!$request->ajax()) return back()->with('success', 'Category crated');
		return response()->json(['status' => 'category created', 'category' => $category], 201);
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
