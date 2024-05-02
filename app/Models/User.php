<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Cart;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasRoles, HasFactory, Notifiable, softDeletes;


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

	//cear casteadores
    protected $casts = [
    	'created_at' => 'datetime:Y-m-d',
		'update_at' => 'datetime:Y-m-d'
    ];

	protected $appends = ['full_name'];

	//crear un accesor
    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->last_name}";
    }

    //crear un mutador
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

	public function setRememberTokenAttribute()
    {
        $this->attributes['remember_token'] = Str::random(20);
    }

	//crear las relaciones
	public function carts()
	{
		return $this->hasMany(Cart::class, 'user_id', 'id');
	}

}
