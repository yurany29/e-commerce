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
		'quantity'
	];


	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id', 'id');
	}


	public function user()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}
}

