<?php

namespace App\Http\Controllers\RestApis;

use App\Http\Controllers\Controller;
use App\Services\StationService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StationController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected StationService $service
    ){}

    public function index(Request $request): JsonResponse
    {
        return $this->apiResponse(function() use ($request) {
            return $this->service->getAll($request);
        });
    }
}
