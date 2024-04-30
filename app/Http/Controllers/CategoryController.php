<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Category\CategoryRequest;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::get();
        if (!$request->ajax()) return view('categories.index', compact('categories'));
		return response()->json(['Categories' => $categories], 200);
    }


    public function create()
    {
        //vista
    }


    public function store(CategoryRequest $request)
    {
        $category = new Category($request->all());
		$category->save();
		if (!$request->ajax()) return back()->with('success', 'Category crated');
		return response()->json(['status' => 'category created', 'category' => $category], 201);
    }


    public function show(Request $request, Category $category)
	{
		$products = Product::with('file')->where('category_id', $category->id)->get();
		$category = Category::whereHas('products')->get();
		if (!$request->ajax()) return view('products.all', compact('products', 'category'));
		return response()->json(['category' => $category], 200);
	}


    public function edit($id)
    {
        //
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());
		if (!$request->ajax()) return back()->with('success', 'Category updated');
		return response()->json([], 204);
    }

    public function destroy(Request $request, Category $category)
    {
        $category->delete();
		if (!$request->ajax()) return back()->with('success', 'Category deleted');
		return response()->json([], 204);
    }
}
