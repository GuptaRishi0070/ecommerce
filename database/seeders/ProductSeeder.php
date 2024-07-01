<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Sample Product',
            'description' => 'This is a sample product.',
            'price' => 19.99,
            'stock' => 100,
        ]);
    }
}
