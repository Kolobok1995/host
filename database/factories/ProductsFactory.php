<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use \App\Models\Products;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ProductsFactory extends Factory
{
    protected $model = Products::class;

    /**
     * @return array<string, mixed>
     */
    public function definition()
    {
        $random = rand(1, 9999);

        return [
            'name' => 'Тестовый товар_' . $random,
            'article' => $random,
            'slug' => 'url-test-' . $random,
            'description' => $random . $random . $random . $random . $random . $random,
        ];
    }

    /**
     * @return static
     */
    public function unverified()
    {
        //
    }
}
