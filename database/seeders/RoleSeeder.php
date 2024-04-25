<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{

    public function run()
    {
        Role::create(['name' =>  'user']);
		Role::create(['name' =>  'admin']);
    }
}
