<?php

namespace App\Http\Controllers;

use App\Enums\ExchangeStatusEnum;
use App\Http\Requests\StoreExchangeRequest;
use App\Http\Requests\UpdateExchangeRequest;
use App\Models\Exchange;
use App\Models\History;
use App\Services\ExchangeServices;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExchangeController extends Controller
{

    public function index()
    {
        return Exchange::all();
    }

    public function store(Request $request)
    {
        try {
            $exchange = new Exchange();
            $exchange
                ->fill([
                    'access'       => $request->get('access'),
                    'login'        => $request->get('login'),
                    'password'     => $request->get('password'),
                    'created_at'   => now(),
                ])
                ->save();

            return true;

        }catch (\Exception $e){
            Log::error($e->getMessage());

            return $e->getMessage();
        }
    }

    public function show(Exchange $exchange)
    {
        return $exchange->load('histories');
    }

    public function historiesByExchange(int $exchangeId)
    {
        return History::where('exchange_id', $exchangeId)->get();
    }


    public function claimExchange(String $access)
    {
        try {
            $exchange = Exchange::where('access', $access)->first();

            $history = new History;
            $history
                ->fill([
                    'status'      => ExchangeStatusEnum::Claimed,
                    'exchange_id' => $exchange->id,
                    'created_at'  => now(),
                ])
                ->save();

            // Get exchange already after his deletion
            $exchange->delete();

            return $exchange;


        }catch (\Exception $e)
        {
            Log::error($e->getMessage());

            return $e->getMessage();
        }
    }
}
