<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = new User([
			'number_id' => '1055478258',
            'name' => 'Yurany',
            'last_name' => 'Henao',
            'email' => 'henaoyurany.29@gmail.com',
            'password' => 'yurany2005',
            'remember_token' => Str::random(10),
        ]);
		$user->save();
    }
}
