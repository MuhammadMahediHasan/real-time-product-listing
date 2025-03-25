<?php

namespace App\Http\Controllers;

use App\Action\FetchProductAndStoreAction;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::query()->orderByDesc('id')->get();

        return view('products.index', compact('products'));
    }

    public function store(): JsonResponse
    {
        try {
            DB::beginTransaction();
            FetchProductAndStoreAction::execute();
            DB::commit();

            return response()->json([
                'message' => 'Products fetched and stored successfully!'
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();

            return response()->json([
                'error' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
