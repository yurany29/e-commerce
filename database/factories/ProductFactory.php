<?php

namespace Database\Factories;

use App\Models\File;
use App\Models\Product;
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

	public function configure()
    {
        return $this->afterCreating(function (Product $product){
            $file = new File(['route' => '/storage/images/products/default.png']);
			$product->file()->save($file);
        });
    }
}
