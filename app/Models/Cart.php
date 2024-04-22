<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'user_id',
		'product_id',
	];

	public function products()
	{
		return $this->hasMany(Product::class, 'product_id', 'id');
	}

	public function users()
	{
		return $this->hasMany(User::class, 'user_id', 'id');
	}
}

