<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
	protected $model = User::class;
	
    public function definition()
    {
        return [
			'number_id' => $this->faker->unique()->randomNumber(9, true),
            'name' => fake()->name(),
			'last_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => bcrypt(123456789), // password
            'remember_token' => Str::random(10),

        ];
    }
	
	public function configure()
    {
        return $this->afterCreating(function (User $user){
            $user->assignRole('user');
        });
    }


}
