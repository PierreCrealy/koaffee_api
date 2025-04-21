<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLikedProductRequest;
use App\Http\Requests\UpdateLikedProductRequest;
use App\Models\LikedProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LikedProductController extends Controller
{

    public function indexByUser(int $userId)
    {
        return response()
            ->json([
                'likedProducts' => Product::whereIn('id', LikedProduct::where('user_id', 1)->pluck('product_id') )->get()
            ]);
    }

    public function store(Request $request)
    {
        try {
            $likedProduct = new LikedProduct();
            $likedProduct
                ->fill([
                    'user_id' => $request->get('userId'),
                    'product_id' => $request->get('productId'),
                ])
                ->save();

            return response()
                ->json([
                    'likedProduct' => $likedProduct
                ]);

        }catch (\Exception $e){
            Log::error($e->getMessage());

            return $e->getMessage();
        }
    }


    public function destroyLiked(int $userId, int $productId)
    {
        return response()
            ->json([
                'likedProductDelete' => (bool)LikedProduct::where(['user_id' => $userId, 'product_id' => $productId])->delete()
            ]);
    }
}
