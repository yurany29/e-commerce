<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\File;
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

	public function carts()
	{
		return $this->hasMany(Cart::class, 'product_id', 'id');
	}

	public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }


}
