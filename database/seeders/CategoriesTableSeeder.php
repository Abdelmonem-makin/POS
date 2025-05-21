<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $Categorys = ['مشروبات' , 'مالكولات'];
        foreach ($Categorys as $Category) {
            $user = \App\Models\Category::create([
                'name' => $Category,
                'status' =>1

            ]);
        }

    }
}
