<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
	use HasFactory, softDeletes;

	protected $fillable = [
		'category_id',
		'name',
		'price',
		'description',
		'stock',
	];

	public function category()
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}
	
	public function cart()
	{
		return $this->belongsTo(Cart::class, 'product_id', 'id');
	}


}