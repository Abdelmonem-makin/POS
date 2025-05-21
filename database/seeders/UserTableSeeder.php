<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Role;
class UserTableSeeder extends Seeder
{

    public function run()
    {
        // Ensure the 'super_admin' role exists
        $role = Role::firstOrCreate(
            ['name' => 'super_admin'],
            ['display_name' => 'Super Admin', 'description' => 'User with full access']
        );

        $user = \App\Models\User::create([
            'name' => 'super_admin',
            'email' => 'super_admin@app.com',
            'password' => bcrypt('password')
        ]);

        $user->attachRole('super_admin');
    }
}
