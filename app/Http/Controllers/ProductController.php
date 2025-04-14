<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        return response()
            ->json([
                'products' => Product::all()
            ]);
    }


    public function show(Product $product)
    {
        return response()
            ->json([
                'product' => $product,
            ]);
    }
}
