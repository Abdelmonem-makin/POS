<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class payment_methods extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payment_methods = ['كاش', 'بنكك'];
        foreach ($payment_methods as $payment_method) {
             \App\Models\payment_methods::create([
                'method_name' => $payment_method,
            ]);
        }
    }
}
