<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Feature;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::factory(6)->create();
        $features = Feature::factory(6)->create();

        // Crée les produits avec les catégories
        Product::factory(20)->create()->each(function ($product) use ($features) {
            $product->features()->attach(
                $features->random(rand(2, 4))->pluck('id')->toArray()
            );
            Review::factory(rand(1, 5))->create([
                'product_id' => $product->id,
            ]);
        });
    }
}
