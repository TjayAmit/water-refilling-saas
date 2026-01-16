<?php

namespace App\Http\Controllers\RestApis;

use App\Http\Controllers\Controller;
use App\Models\Station;
use App\Services\StationProductService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StationProductController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected StationProductService $service
    ){}

    public function index(Station $station, Request $request): JsonResponse
    {
        return $this->apiResponse(function() use ($station, $request) {
            return $this->service->getAll($station, $request);
        });
    }
}
