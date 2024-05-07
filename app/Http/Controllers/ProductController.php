<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\UploadFile;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Requests\Search\SearchRequest;

class ProductController extends Controller
{
	use UploadFile;

	public function home()
	{
		$categories = Category::has('products')->select('id', 'name')->get();
		foreach ($categories as $category) {
			$category->load(['products' => function ($query) {
				$query->where('stock', '>', 0)
					->with('file')
					->limit(5);
			}]);
		}
		return view('index', compact('categories'));
	}

	public function index(Request $request)
	{
		$categories = Category::get();
		$products = Product::where('stock', '>', 0)->with('category', 'file')->whereHas('category')->get();
		return view('products.index', compact('products', 'categories'));
	}



	public function search(Request $request)
	{
		$search = $request->search;
		$products = Product::with('file')->where('name', 'LIKE', '%' . $search . '%')->whereHas('category')->get();
		return view('search.products', compact('products'));
	}


	public function store(ProductRequest $request)
	{
		try {
			DB::beginTransaction();
			$product = new Product($request->all());
			$product->save();
			$this->uploadFile($product, $request);
			DB::commit();
			return response()->json(['status' => 'product created', 'Product' => $product], 200);
		} catch (\Throwable $th) {
			DB::rollback();
			throw $th;
		}
	}


	public function show(Request $request, Product $product)
	{
		$product = Product::with('category', 'file')->whereHas('category')->where('id', $product->id)->first();
		if (!$request->ajax()) return view('products.show', compact('product'));
		return response()->json(['product' => $product], 201);
	}



	public function update(ProductUpdateRequest $request, Product $product)
	{
		try {
			DB::beginTransaction();
			$product->update($request->all());
			$this->uploadFile($product, $request);
			DB::commit();
			return response()->json([], 204);
		} catch (\Throwable $th) {
			DB::rollBack();
			throw $th;
		}
	}

	public function destroy(Request $request, Product $product)
	{
		$product->delete();
		$this->deleteFile($product);
		if (!$request->ajax()) return back()->with('success', 'Product deleted');
		return response()->json([], 204);
	}
}
