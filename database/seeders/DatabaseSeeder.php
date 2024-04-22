<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
		$this->call(UserSeeder::class);
		$this->call(CategorySeeder::class);

        User::factory(10)->create();
		Product::factory(10)->create();
		Cart::factory(10)->create();

    }
}
