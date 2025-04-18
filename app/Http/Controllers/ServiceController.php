<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;

class ServiceController extends Controller
{

    public function index()
    {
        return response()
            ->json([
                'services' => Service::where('proposed', 1)->get()
            ]);
    }


    public function show(Service $service)
    {
        return response()
            ->json([
                'service' => $service
            ]);
    }
}
