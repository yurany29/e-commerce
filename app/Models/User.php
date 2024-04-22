<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Cart;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, softDeletes;


    protected $fillable = [
        'number_id',
        'name',
		'last_name',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


	public function cart()
	{
		return $this->belongsTo(Cart::class, 'user_id', 'id');
	}


    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
