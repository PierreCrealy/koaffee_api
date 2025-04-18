<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLikedProductRequest;
use App\Http\Requests\UpdateLikedProductRequest;
use App\Models\LikedProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LikedProductController extends Controller
{

    public function indexByUser(int $userId)
    {
        return response()
            ->json([
                'likedProducts' => LikedProduct::where('user_id', $userId)->get()
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

    public function show(LikedProduct $likedProduct)
    {
        return response()
            ->json([
                'likedProduct' => $likedProduct
            ]);
    }


    public function destroy(LikedProduct $likedProduct)
    {
        return response()
            ->json([
                'likedProductDelete' => (bool)$likedProduct->delete()
            ]);
    }
}
