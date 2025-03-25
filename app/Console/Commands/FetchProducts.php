<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use App\Events\ProductAdded;

class FetchProducts extends Command
{
    protected $signature = 'fetch:products';
    protected $description = 'Fetch products from Fake Store API';

    public function handle(): void
    {
        $response = Http::get('https://fakestoreapi.com/products');
        $products = $response->json();

        Product::query()->truncate();
        foreach ($products as $item) {
            $product = Product::query()->create([
                'name' => $item['title'],
                'description' => $item['description'],
                'price' => $item['price'],
            ]);

            event(new ProductAdded($product));
        }

        $this->info('Products fetched and stored.');
    }
}
