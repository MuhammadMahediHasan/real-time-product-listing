<?php

namespace App\Action;

use App\Events\ProductAdded;
use App\Models\Product;
use Illuminate\Support\Facades\Http;

class FetchProductAndStoreAction
{
    public static function execute(): void
    {
        $response = Http::get('https://fakestoreapi.com/products');
        $products = $response->json();

        Product::query()->truncate();
        foreach ($products as $item) {
            if (Product::query()->where("name", $item['title'])->exists()) {
                continue;
            };
            $product = Product::query()->create([
                'name' => $item['title'],
                'description' => $item['description'],
                'price' => $item['price'],
            ]);

            event(new ProductAdded($product));
        }
    }
}
