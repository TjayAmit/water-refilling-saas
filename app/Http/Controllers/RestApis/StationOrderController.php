<?php

namespace App\Http\Controllers\RestApis;

use App\Http\Controllers\Controller;
use App\Models\Station;
use App\Services\OrderService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StationOrderController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected OrderService $service
    ){}

    public function index(Station $station, Request $request): JsonResponse
    {
        return $this->apiResponse(function() use ($station, $request) {
            return $this->service->getOrderByStationIdAndStatus($station, $request);
        });
    }
}
