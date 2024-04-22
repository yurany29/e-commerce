<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
			'product_id' => $this->faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
        ];
    }
}
