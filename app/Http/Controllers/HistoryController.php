<?php

namespace App\Http\Controllers;

use App\Enums\ExchangeStatusEnum;
use App\Http\Requests\UpdateHistoryRequest;
use App\Models\Exchange;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HistoryController extends Controller
{
    public function index()
    {
        return History::all();
    }

    public function store(Request $request)
    {
        try {
            $history = new History;
            $history
                ->fill([
                    'status'      => ExchangeStatusEnum::Pending,
                    'exchange_id' => $request->get('exchange_id'),
                    'created_at'  => now(),
                ])
                ->save();

            return true;

        }catch (\Exception $e){
            Log::error($e->getMessage());

            return $e->getMessage();
        }
    }

    public function show(History $history)
    {
        return $history->load('exchange');
    }

    public function update(Request $request, History $history)
    {
        //
    }

    public function exchangeByHistory(int $historyId)
    {
        return History::find($historyId)->exchange;
    }
}
