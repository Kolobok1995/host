<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $products =  \App\Models\Products::get();

            foreach ($products as $product) {
                $price = rand(1, 9999);

                \App\Models\ProductPrice::create([
                    'product_id' => $product->id,
                    'price' => $price,
                    'last_price' => $price,
                    'sale_price' => rand(0, 30),
                ]);
            }

        /*
        \App\Models\Products::factory(10)->create(
            ['category_id' => 4]
        );
        */

        /*
         \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
         ]);
         */
    }
}
