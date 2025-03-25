<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::query()->orderByDesc('id')->get();

        return view('products.index', compact('products'));
    }
}
