<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        return response()
            ->json([
                'orders' => Order::all()
            ]);
    }

    public function store(Request $request)
    {

        try {
            $order = new Order();
            $order
                ->fill([
                    'total' => $request->get('total'),
                    'table' => $request->get('table'),
                    'fidelity_pts_earned' => $request->get('fidelityPtsEarned'),
                    'user_id' => $request->get('userId'),
                ])
                ->save();

            if($request->get('productIds'))
            {

                if($request->get('method') == 2)
                {
                    $productIds = array_map(
                            'intval',
                                    explode(
                                        ',',
                                        trim($request->query('productIds'), '{}')
                                    )
                                );
                }else{
                    $productIds = $request->get('productIds');
                }

                foreach ($productIds as $productId)
                {
                    $orderProduct = new OrderProduct();
                    $orderProduct
                        ->fill([
                            'product_id' => $productId,
                            'order_id'   => $order->id
                        ])
                        ->save();
                }
            }

            return response()
                ->json([
                    'order' => $order
                ]);

        }catch (\Exception $e){
            Log::error($e->getMessage());

            return $e->getMessage();
        }
    }

    public function show(Order $order)
    {
        return response()
            ->json([
                'order' => $order->load('products')
            ]);
    }


    public function getGroupedByStatus()
    {
        return response()
            ->json([
                'orders' => Order::all()->groupBy('status'),
            ]);
    }

    public function getByStatus(string $status)
    {
        return response()
            ->json([
                'orders' => Order::where('status', $status)->get(),
            ]);
    }


}
