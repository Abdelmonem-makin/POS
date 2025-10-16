<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Shift extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Shift = ['صباحيه'];
        foreach ($Shift as $Shift) {
            \App\Models\Shift::create([
                'name' => $Shift,
                'user_id' => 1
            ]);
        }
    }
}
