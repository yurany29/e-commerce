<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{

    public function definition()
    {
        return [
            'category_id' => $this->faker->randomElement([1,2,3]),
            'name' => $this->faker->words(3, true),
			'price' => $this->faker->randomFloat(3),
			'description' => $this->faker->paragraph(),
            'stock' => $this->faker->randomDigit()
        ];
    }
}
